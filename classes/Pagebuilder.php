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

        (empty($post['id'])) ? $post['url'] = Tools::slug($post['nom']) : "";
        parent::set($post);
    }

    public function getParentRecursive($id, $tree = [])
    {
        $page = $this->get($id);
        $tree[] = $page;
        if ($page->parent != 0) {
            $tree = $this->getParentRecursive($page->parent, $tree);
        }
        return $tree;
    }

    public function duplicatePage($id)
    {
        $req = $this->db->prepare("INSERT INTO " . $this->table . "  (`nom`, `url`,  `parent`) SELECT CONCAT('[copie] ', nom), CONCAT('copie_', url), parent FROM " . $this->table . " WHERE id= ?");
        $req->execute([$id]);
        $page_id = $this->db->lastInsertId();
        $req = $this->db->prepare("SELECT * FROM gd_structure WHERE id_page = ?");
        $req->execute([$id]);
        $i = 0;
        foreach ($req->fetchAll() as $section) {
            $i++;
            $req = $this->db->prepare("INSERT INTO gd_structure (`id_page`, `value`, `id_block`, `field`, `position`, `json`) VALUES (?,?,?,?,?,?)");
            $req->execute([$page_id, $section->value, $section->id_block, $section->field, $i, $section->json]);
        }
        return true;
    }

    public function getPageByURL($url = "")
    {
        return @$this->getBy(['url' => "$url"])[0] ?? [];
    }

    public function getChildren($id = 0, $pageName = "")
    {
        if (!empty($pageName) && $id = 0) {
            $id = $this->getBy(['nom' => $pageName])[0]->id;
        }
        return $this->getBy(['parent' => $id], "menu", "asc");
    }

    public function getBreadcrumb($page, $id_data = 0)
    {
        $breadcrumb = ['Accueil' => '/'];

        if ($page->url == 'article') {
            $breadcrumb['Les actualités'] = '/les-actualites';
            $Articles = new Articles();
            $article = $Articles->get($id_data);
            $page->nom = $article->title;
        }

        $breadcrumb[$page->nom] = '';

        return $breadcrumb;
    }
}