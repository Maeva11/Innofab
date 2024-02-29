<?php


class Pagebuilder extends Controller
{
    protected $table;
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'page');
        $this->db = parent::getModel()->getDb();
    }

    public function setNavigation($post)
    {
        for ($i = 0; $i < count($post["id"]); $i++) {
            parent::set(["id" => $post['id'][$i], "parent" => $post['parent'][$i], "menu" => $post['menu'][$i], "footer" => $post['footer'][$i]]);
        }
    }

    public function set($post, $files = [])
    {
        $Bbuilder = new Blockbuilder();
        $params['id'] = $post['id_page'];
        unset($post['id_page']);
        $params['nom'] = $post['nom_page'];
        $params['url'] = $post['url_page'];
        $params['parent'] = $post['parent'];
        (empty($params['id'])) ? $params['url'] = Tools::slug($post['nom_page']) : "";
        unset($post['nom_page']);
        unset($post['url_page']);
        unset($post['parent']);
        $json = "";
        foreach ($post['id_block'] as $blocks) {
            (empty($json)) ? $sep = "" : $sep = ",";
            if ($Bbuilder->get($blocks)->crud || !$Bbuilder->get(explode("_", $blocks)[0])->duplicable) {
                $notDuplicable = [];
                foreach ($post as $key => $value) {
                    if (!empty($value[$blocks])) {
                        $notDuplicable[$key] = $value[$blocks];
                    }
                    if (!empty($files[$key]['name'][$blocks])) {
                        $result = (new Upload())->upload_image_builder($files, '../', $key, $blocks);
                        ($result !== false) ? $notDuplicable[$key] = $result : "";
                    }
                }
                if (!empty($notDuplicable) or $Bbuilder->get($blocks)->crud) {
                    $json .= $sep . '{"id_block" : "' . $blocks . '", "datas" : [' . json_encode(@$notDuplicable) . ']}';
                }
            } else {
                $duplicable = [];
                foreach ($post as $key => $value) {
                    for ($i = 0; $i < @count($value[$blocks]); $i++) {
                        $duplicable[$i][$key] = @$value[$blocks][$i];
                        if (!empty($files[$key]['name'][$blocks][$i])) {
                            $result = (new Upload())->upload_image_builder($files, '../', $key, $blocks);
                            ($result !== false) ? $duplicable[$i][$key] = $result : "";
                        }
                    }
                }
                $el = "";
                if (!empty($duplicable)) {
                    foreach ($duplicable as $data) {
                        (empty($el)) ? $elsep = "" : $elsep = ",";
                        $el .= $elsep . json_encode($data);
                    }
                    $json .= $sep . '{"id_block" : "' . explode("_", $blocks)[0] . '", "datas" : [' . $el . ']}';
                }
            }
        }
        if (@$post['trad'] == "en") {
            $params['datas_en'] = "[$json]";
        } else {
            $params['datas'] = "[$json]";
        }
        if (empty($params['id'])) {
            $params['datas_en'] = "[$json]";
            $params['datas'] = "[$json]";
        }
        parent::set($params);
    }

    public function duplicatePage($id)
    {
        $req = $this->db->prepare("INSERT INTO " . $this->table . "  (`nom`, `url`,  `datas`, `datas_en`, `parent`) SELECT CONCAT('[copie] ', nom), CONCAT('copie_', url), datas, datas_en, parent FROM " . $this->table . " WHERE id= ?");
        return $req->execute([$id]);
    }

    public function getPageByURL($url = "")
    {
        if (!empty($page = @$this->getBy(['url' => "$url"])[0])) {
            $data['PageName'] = @$page->nom;
            $datas = $page->{"datas"._PREFIX_LANG_};
            foreach (json_decode($datas) as $el) {
                $data['block'][] = $el;
            }
            return $data;
        }
        return [];
    }

    public function getChildren($id = 0, $pageName="")
    {
        if(!empty($pageName) && $id = 0){
            $id = $this->getBy(['nom' => $pageName])[0]->id;
        }
        return $this->getBy(['parent' => $id], "menu", "asc");
    }

    public function generateBlocks($block)
    {
        $Bbuilder = new Blockbuilder();
        $rand = Tools::strRandom(3);
        if (empty($block)) {
            return false;
        }
        (!empty($block->id_block)) ? $id = $block->id_block : $id = $block;
        $Block = @$Bbuilder->get($id);
        if ($Block->crud) {
            $formDatas = @$block->datas[0];
            $html = '<div class="blocks col-12 deletable row" data-id_block="' . $id . '">';
            $html .= Tools::generateInput("hidden", "", "id_block[]", $id) .
                Tools::generateInput('submit', '', '', '+ Dupliquer', 'btn-style2 btn-dupliquer') . '
                        <i class="fas fa-arrows-alt drop-btn">&nbsp;&nbsp;&nbsp;'.ucfirst($Block->nom).'</i>
                        <a href="' . strtolower($Block->crud_url) . '" target="_blank" class="col-12">
                        <h1>' . $Block->nom . '</h1>
                        <p>' . $Block->description . '</p>
                        </a><br>';
            foreach (json_decode($Block->datas) as $data) {
                $class = "";
                $name = $data->name;
                if (!empty($data->type)) {
                    $type = $data->type;
                } else {
                    $type = $data->balise;
                }
                $html .= Tools::generateInput($type, $data->label, $name . "[$id]", @$formDatas->$name, "", @$data->placeholder, "", "", "", "", @$data->largeur, @$data->masque);

            }
            $html .= '</div>';

        } else {
            if ($Block->duplicable) {
                $id = $id . "_" . $rand;
                $html = '<div class="blocks col-12 deletable row" data-id_block="' . $id . '">';
                $html .= Tools::generateInput("hidden", "", "id_block[]", $id) . '
                    <i class="fas fa-arrows-alt drop-btn">&nbsp;&nbsp;&nbsp;'.ucfirst($Block->nom).'</i>'
                    . Tools::generateInput('submit', '', '', '+ Dupliquer', 'btn-style2 btn-dupliquer') .
                    '<div class="dragDrop col-12 row">';
                (empty($block->datas)) ? $datas = [[]] : $datas = $block->datas;
                foreach ($datas as $formDatas) {
                    $html .= '<div class="blocks-el deletable row">
                        <i class="fas fa-arrows-alt drop-btn">'.$Block->nom.'</i>
                        <a class="btn-dupliquer"><i class="fas fa-plus-circle"></i></a>';
                    foreach (json_decode($Block->datas) as $data) {
                        $name = $data->name;
                        if (!empty($data->type)) {
                            $type = $data->type;
                        } else {
                            $type = $data->balise;
                        }
                        $html .= Tools::generateInput($type, $data->label, $name . "[$id][]", @$formDatas->$name, "", @$data->placeholder, "", "", "", "", @$data->largeur, @$data->masque);
                    }
                    $html .= "</div>";
                }
                $html .= '</div></div>';

            } else {
                $formDatas = @$block->datas[0];

                $html = '<div class="blocks col-12 deletable row">';
                $html .= Tools::generateInput("hidden", "", "id_block[]", $id) . '
                    <i class="fas fa-arrows-alt drop-btn">&nbsp;&nbsp;&nbsp;'.ucfirst($Block->nom).'</i>'
                    . Tools::generateInput('submit', '', '', '+ Dupliquer', 'btn-style2 btn-dupliquer');
                foreach (json_decode($Block->datas) as $data) {
                    $class = "";
                    $name = $data->name;
                    if (!empty($data->type)) {
                        $type = $data->type;
                    } else {
                        $type = $data->balise;
                    }
                    $html .= Tools::generateInput($type, $data->label, $name . "[$id]", @$formDatas->$name, "", @$data->placeholder, "", "", "", "", @$data->largeur, @$data->masque);

                }
                $html .= '</div>';
            }
        }
        return $html;
    }
}
