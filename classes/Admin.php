<?php

use Ifsnop\Mysqldump as IMysqldump;

class Admin extends Controller
{
    protected $table;
    public $db;
    public $block;

    public function __construct($block = "")
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'adminbuilder');
        $this->db = parent::getModel()->getDb();
        $this->block = $block;
    }

    public function set($params, $files = [])
    {
        $datas = "";
        if (!empty($params['label']) and $params['block'] == "configuration") {
            for ($i = 0; $i < count(@$params['label']); $i++) {
                (!empty($datas)) ? $s = ',' : $s = '';
                $datas .= $s . '{"label":"' . $params['label'][$i] . '", "value" : "' . @$params['contenu'][$i] . '"}';
            }
        } elseif (!empty($params['nom']) and $params['block'] == "menu") {
            for ($i = 0; $i < count(@$params['nom']); $i++) {
                (!empty($datas)) ? $s = ',' : $s = '';
                $datas .= $s . '{"nom":"' . $params['nom'][$i] . '","url":"' . @$params['url'][$i] . '", "icone" : "' . @$params['icone'][$i] . '"}';
            }
        } elseif ($params['block'] == "deleteAuth") {
            $params['block'] = "auth";
            return parent::set($params, $files);
        }
        if ($params['block'] != "auth") {
            $params['datas'] = [];
            (!empty($datas)) ? $params['datas'] = "[$datas]" : '';
            return parent::set($params, $files);
        } else {
            for ($i = 0; $i < count(@$params['identifiant']); $i++) {
                if (!empty($params['password'][$i]) and !empty($params['identifiant'][$i]) and !empty($params['role'][$i])) {
                    (!empty($datas)) ? $s = ',' : $s = '';
                    $params['password'][$i] = password_hash($params['password'][$i], PASSWORD_DEFAULT);
                    $datas .= $s . '{"identifiant":"' . $params['identifiant'][$i] . '","password":"' . @$params['password'][$i] . '", "role" : "' . @$params['role'][$i] . '"}';
                }
            }
            $lastJson = substr($this->getBy(['block' => 'auth'])[0]->datas, 1, -1);
            (!empty($datas)) ? $s = ',' : $s = '';
            (!empty($lastJson)) ? $datas .= $s . $lastJson : '';
            if (!empty($datas)) {
                $params['datas'] = "[" . $datas . "]";
                return parent::set($params, $files);
            }
        }
    }

    public function getDatas($label = '', $block = 'configuration')
    {
        $Admin = $this->getBy(['block' => $block])[0];
        $datas['datas'] = json_decode($Admin->datas);
        if ($block == "configuration") {
            foreach ($datas['datas'] as $el) {
                if ($el->label == $label) {
                    return $el->value;
                }
            }
        } else {
            $datas['id'] = $Admin->id;
            (empty($datas['datas'])) ? $datas['datas'] = [] : '';
            return $datas;
        }
    }

    public function deleteAdmin($identifiant = "")
    {
        $Admin = $this->getBy(['block' => "auth"])[0];
        $i = 0;
        $json = "";
        foreach (json_decode($Admin->datas) as $el) {
            if ($el->identifiant != $identifiant) {
                (empty($json)) ? $s = "" : $s = ",";
                $json .= $s . json_encode($el);
            }
            $i++;
        }
        return $this->set(["id" => $Admin->id, "block" => "deleteAuth", "datas" => "[$json]"]);
    }

    public function connexion($identifiant, $password)
    {
        foreach (json_decode($this->getBy(['block' => "auth"])[0]->datas) as $el) {
            if ($el->identifiant == $identifiant) {
                if (password_verify($password, $el->password)) {
                    session_start();
                    $_SESSION["auth"] = 'true';
                    $_SESSION["role"] = $el->role;
                    header('Location: ' . ADMIN_URL);
                }
            }
        }
        header('Location: ' . ADMIN_URL . 'login.php');
    }

    public function archiveSQL()
    {

        fopen('../archive/' . date("YmdHis") . '.sql', 'w');
        $dump = new IMysqldump\Mysqldump('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '', '' . DB_USER . '', '' . DB_PASSWORD . '');
        $dump->start('../archive/' . date("YmdHis") . '.sql');
        Tools::redirect(ADMIN_URL . 'console/archive');

    }

    /******TinyPNG*****/
    public function initTinyPNG($dir = "../")
    {
        require_once($dir . "vendor/tinify/tinify/lib/Tinify/Exception.php");
        require_once($dir . "vendor/tinify/tinify/lib/Tinify/ResultMeta.php");
        require_once($dir . "vendor/tinify/tinify/lib/Tinify/Result.php");
        require_once($dir . "vendor/tinify/tinify/lib/Tinify/Source.php");
        require_once($dir . "vendor/tinify/tinify/lib/Tinify/Client.php");
        require_once($dir . "vendor/tinify/tinify/lib/Tinify.php");
        Tinify\setKey(API_TPNG);
    }

    public function countImages()
    {
        /**-2 pour ne pas avoir les fichiers de base '.' et '..' **/
        $datas['global'] = count(scandir("../themes/assets/images")) - 2;//total d'images
        $datas['globalNO'] = $datas['global'] - count(scandir("../themes/assets/optimize/images")) + 2;//total non optimisées
        $datas['upload'] = count(scandir("../themes/assets/upload")) - 2;//total d'images
        $datas['uploadNO'] = $datas['upload'] - count(scandir("../themes/assets/optimize/upload")) + 2;//total non optimisées
        $datas['totalOptimize'] = ($datas['global'] - $datas['globalNO']) + ($datas['upload'] - $datas['uploadNO']);//Total optimisées
        return $datas;
    }

    public function Compressing($dir = ["images/", "upload/"])
    {
        foreach ($dir as $dir) {
            $images = array_diff(scandir('../themes/assets/' . $dir), scandir('../themes/assets/optimize/' . $dir));
            foreach ($images as $el) {
                $path = "../themes/assets/" . $dir;
                $source = \Tinify\fromFile($path . $el);
                $source->toFile($path . 'optimize_' . $el);
                copy($path . $el, '../themes/assets/optimize/' . $dir . $el);
                rename($path . 'optimize_' . $el, $path . $el);
            }
        }
        return true;
    }

    public function debugCompressing($dir, $file, $type = "optimize")
    {
        if ($type == "optimize") {
            $this->initTinyPNG("");
            $path = "./themes/assets/" . $dir . "/";
            $source = \Tinify\fromFile($path . $file);
            $source->toFile($path . 'optimize_' . $file);
            copy($path . $file, './themes/assets/optimize/' . $dir . '/' . $file);
            rename($path . 'optimize_' . $file, $path . $file);
        } else {
            $path = "./themes/assets/optimize/" . $dir . "/";
            copy($path . $file, $path . "duplicate_" . $file);
            copy($path . $file, "./themes/assets/" . $dir . "/" . $file);
            rename($path . 'duplicate_' . $file, $path . $file);

        }
        return true;
    }

    /***LANGUAGE***/
    public function setLANG($post)
    {
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'trad');
        for ($i = 0; $i < count($_POST['id']); $i++) {
            $params['id'] = $_POST['id'][$i];
            $params['FR'] = $_POST['FR'][$i];
            $params['EN'] = $_POST['EN'][$i];
            parent::set($params);
        }
    }

    public function getAllLANG()
    {
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'trad');
        return $this->getAll("id", "desc");
    }

    public function translate($word, $from = "FR", $to = "EN")
    {
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'trad');
        return $this->getBy(["$from" => "$word"])[0]->$to ?? $this->insertTrad(["$from" => "$word"]);
    }
    public function insertTrad($params = []){
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'trad');
        parent::getModel()->insertUnique($params);
    }
    public function getAllTrad(){
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'trad');
        return $this->getAll();
    }
    public function deleteTrad($id)
    {
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'trad');
        return $this->remove($id);
    }
    /***TERMS***/
    public function getTerms(){
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'terms');
        return $this->getAll("id", "asc");
    }
    public function setTerms($post){
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'terms');
        for($i = 0; $i < count($post['id']); $i++){
            $params['id'] = $post['id'][0];
            $params['titre'] = $post['titre'][0];
            $params['sous_titre'] = $post['sous_titre'][0];
            $params['contenu'] = $post['contenu'][0];
            parent::set($params);
        }
    }
}