<?php


class Structure extends Controller
{
    protected $table;
    public $db;
    public $block;

    public function __construct($block = "")
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'structure');
        $this->db = parent::getModel()->getDb();
        $this->block = $block;
    }

    public function generateHtml($url, $app, $params)
    {

        $html = "";
        $PageBuilder = new Pagebuilder();
        if ($page = $PageBuilder->getPageByURL($url)) {
            $page_id = $page->id;
            $elements = $this->getBy(["id_page" => $page_id, 'id_structure' => 0], "position", "ASC");
        }
        foreach ($elements ?? [] as $element) {
            $element = $this->getLastRevision($element->id);
            $html .= $this->generateStructure($element->id, $app, $params);
        }

        return $html;
    }

    public function cleanImages($html)
    {
        $images = [];
        $replaces = [];

        preg_match_all('/<img\s+[^>]*\/?>/', $html, $images);

        foreach ($images as $imageList) {
            foreach ($imageList as $intialImg) {
                $img = $intialImg . "";
                $matches = [];

                // add loading="lazy" if not already
                if (!preg_match("/loading=\"lazy\"/", $img)) {
                    $img = str_replace("<img", "<img loading=\"lazy\"", $img);
                }

                // check if contain alt attribute
                if (!preg_match("/alt=\"([^\"]*)\"/", $img)) {
                    $img = str_replace("<img", "<img alt=\"Insérer un texte\"", $img);
                } else {
                    $img = str_replace('alt=""', 'alt="Insérer un texte"', $img);
                }

                if (preg_match('/src="([\.\/a-zA-Z0-9_-]+)"/', $img, $matches) && isset($matches[1])) {
                    $src = $matches[1];

                    // ignore if img is a svg
                    if (preg_match("/\.svg$/", $src))
                        continue;

                    // on vérifie si l'image est déjà thumbs
                    if (!preg_match("/\/thumbs\//", $src)) {
                        $widthMatches = [];
                        $heightMatches = [];

                        if (
                            preg_match('/width="([0-9]+)%?"/', $img, $widthMatches) &&
                            preg_match('/height="([0-9]+)%?"/', $img, $heightMatches)) {

                            $width = $widthMatches[1];
                            $height = $heightMatches[1];

                            if ($width == "100%")
                                $width = 1400;
                            if ($height == "100%")
                                $height = 1400;

                            // preg match is mode attribut
                            $mode = "default";
                            $modeMatchess = [];
                            if (preg_match('/mode="([a-z]+)"/', $img, $modeMatchess) && isset($modeMatchess[1])) {
                                $mode = $modeMatchess[1];
                            } else {
                                if ($width == $height)
                                    $mode = "zoom";
                                else if ($width > $height)
                                    $mode = "maxwidth";
                                else
                                    $mode = "maxheight";
                            }

                            // get extension of the image
                            $extension = pathinfo($src, PATHINFO_EXTENSION);

//                            echo $extension."<br>";

                            $src_path = $src[0] != '/' ? '/' . $src : $src;
                            $thumb_url = '/imagev2/' . $width . 'x' . $height . '_' . $mode . $src_path . ".webp";

                            $img = str_replace($src, $thumb_url, $img);
                        }
                    }
                }

                $html = str_replace($intialImg, $img, $html);
            }
        }

        return $html;
    }

    public function generateStructure($id, $app, $params)
    {

        $html = "";

        if ($element = $this->get($id)) {


            $element->value = $this->remplaceInclude($element->value, $app, $params);
            $element->value = $this->remplaceTrad($element->value, $app);

            $BlockBuilder = new Blockbuilder();
            $cloned = $BlockBuilder->getBy(['id' => $element->id_block, 'clone' => 1]);

            if ($cloned) {
                $all_structure = $this->getBy(['id_block' => $cloned[0]->id]);
                $all_structure = $this->getLastRevision($all_structure[0]->id);
            }

            if (!empty($all_structure)) {
                $element->value = $all_structure->value;
            }

            $delete = "";

            if (ROOT) {
                $delete = '<span class="deleteBlock">+</span>';
                //add block id on html
                $html .= '<div class="display-block"><a href="/gdadmin/blockBuilder/set/'.$element->id_block.'">id_block: ' . $element->id_block . '</a> / id : ' . $element->id . '</div>';
            }

            if (ADMIN) {
                $html .= '<div  class="el-wrapper" data-id="' . $element->id . '">' . $delete . $element->value . '</div>';
            } else {
                $html .= $element->value;
            }
        }

        $html = $this->cleanImages($html);
        $html = preg_replace('/<a(.*?)>/', '<a$1 href="#">', $html);

        return htmlspecialchars_decode($html);
    }

//nouvelle fonction
    public function remplaceInclude($string, $app, $params)
    {
        $start = strpos($string, 'include:');
        if ($start !== false) {
            $end = strpos($string, '.php') + 4;
            $filename_start = $start + 8;
            $file = substr($string, $filename_start, $end - $filename_start);
            ob_start();
            $data = $params;
            include(__DIR__ . '/../themes/blocks/' . $file);
            $data = ob_get_clean();
            $string = str_replace('include:' . $file, $data, $string);
            $string = $this->remplaceInclude($string, $app, $params);
        }
        return $string;
    }

    public function remplaceTrad($string, $app)
    {
        $start = strpos($string, 'trad:');
        if ($start !== false) {
            $end = strpos($string, '/trad');
            $word_start = $start + 5;
            $word = substr($string, $word_start, $end - $word_start);
            $string = str_replace('trad:' . $word . '/trad', __($word), $string);

            $string = $this->remplaceTrad($string, $app);
        }

        return $string;
    }

    public function getLastRevision($id, $lang = LANG)
    {
        if ($lang != LANG) $this->setI18n(false);

        $datas = $this->getBy(['id_structure' => $id, 'id_lang' => 1], 'revision', 'DESC');
        if (empty($datas)) {
            $structure = $this->get($id);
            if ($structure->id_structure == 0) {
                return $structure;
            } else {
                return $this->getLastRevision($structure->id_structure, $lang);
            }
        }
        return $datas[0];
    }

    public function removebyIdBlock($id_block)
    {
        $this->model->delete(['id' => $id_block]);
    }

    public function removeByIdStructure($id_structure)
    {
        $this->model->delete(['id_structure' => $id_structure]);
    }

    public function copyStructure($id_page, $lang_from, $lang_to)
    {
        $this->setI18n(false);
        $structure = $this->getBy(['id_page' => $id_page, 'id_lang' => Tools::getLangId($lang_from), 'revision' => 0]);
        //now get only the last revision
        $structure_did = [];
        foreach ($structure as $item) {
            $copy = $this->getLastRevision($item->id, $lang_from);
            if (!in_array($copy->id, $structure_did)) {
                $structure_did[$copy->id] = $copy->id;
                $this->model->insert(['id_lang' => Tools::getLangId($lang_to), 'revision' => 1, 'id_structure' => 0, 'id_block' => $copy->id_block, 'id_page' => $copy->id_page, 'value' => $copy->value, 'position' => $copy->position]);
            }
        }
    }
}
