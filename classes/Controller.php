<?php

/* controller recoit données et communique à GWModel.php */

class Controller
{

    protected $model;
    protected $allowFileNames = ["illustration", "image", "image_1", "image_2", "image_3", "image_4", "drapeau", "logo", 'pdf', "profil, image_service"];
    protected $i18n = false;

    function __construct()
    {
        $this->model = new GWModel();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setI18n($bool = true)
    {
        $this->model->i18n = $bool;
        $this->i18n = $bool;
    }

    /*public function i18nfield($field)
    {
        $this->model->addi18nfield($field);
    }

    public function i18nfields($fields)
    {
        $this->model->seti18n($fields);
    }*/

    public function getWithPaging($page = 1, $per_page = 10, $order_by = 'date', $order_sort = 'DESC')
    {
        $params = [];
        return $this->model->select($params, $order_by, $order_sort, (((int)$page - 1) * $per_page) . ' , ' . $per_page);
    }

    public function getBy($params, $order_by = 'id', $order_sort = 'ASC', $limit = false)
    {
        $aDatas = $this->model->select($params, $order_by, $order_sort, $limit);
        return $aDatas;
    }


    public function copy($lang_from, $lang_to)
    {
        $id_lang_from = Tools::getLangId($lang_from);
        $id_lang_to = Tools::getLangId($lang_to);
        $this->setI18n(false);
        $datas = $this->getBy(['id_lang' => $id_lang_from]);
        foreach($datas as $data){
            unset($data->id);
            $data->id_lang = $id_lang_to;
            $this->set((array)$data);
        }
    }
    public function remove($id = 0)
    {
        if ($id == 0) return false;
        $this->model->delete(['id' => $id]);
        return true;
    }

    public function get($id = 0)
    {
        if ($id == 0) return array();
        if ($aDatas = $this->model->select(['id' => $id])) {
            return $aDatas[0];
        };

        return false;
    }

    public function getAll($order_by = 'id', $order_sort = 'DESC')
    {
        $params = [];
        $datas = $this->getBy($params, $order_by, $order_sort);
        if ($datas)
            foreach ($datas as &$data)
                if (!empty($data->datas))
                    $data->datas = json_decode($data->datas);
        return $datas;
    }

    public function set($params, $files = [])
    {
        (isset($params['password'])) ? $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT) : '';
        (isset($params['date'])) ? $params['date'] = implode('-', array_reverse(explode('/', $params['date']))) : '';
        $sSQLChamps = '';
        //get db columns
        foreach ($this->model->getDbColumns() as $sChamps) {
            if (isset($params[$sChamps]) && $sChamps != 'id') {
                $aDatas[$sChamps] = (empty($params[$sChamps]) && $params[$sChamps] != '0') ? ('') : ($params[$sChamps]);
                $sSQLChamps .= ((@empty($sSQLChamps)) ? ('') : (',')) . $sChamps . '=:' . $sChamps;
            }
        }
        if (!empty($files)) {
            if (!empty($this->allowFileNames)) {
                foreach ($this->allowFileNames as $fileName) {
                    if (!empty($files[$fileName]['name'])) {
                        $result = (new Upload())->upload_file($files, '../', $fileName);
                        if ($result !== false) {
                            $aDatas[$fileName] = $result;
                        }
                    }
                }
            }
        }

        if (!empty($params['id'])) {
            $sql = 'UPDATE ' . $this->model->getTable() . ' SET ' . $sSQLChamps . ' WHERE id=' . $params['id'];
        } else {
            $sql = 'INSERT INTO ' . $this->model->getTable() . ' SET ' . $sSQLChamps;
        }


        $this->model->query($sql, $aDatas);
        return $this->model->lastInsertId();
    }

    public function count()
    {
        return count($this->getBy());
    }

    public function AddImage($id_cible, $block, $files)
    {
        if ($files !== false) {
            if (isset($this->allowFileNames) && count($this->allowFileNames) > 0) {
                require_once(DIRNAME(__FILE__) . '/class.upload.php');
                $upload = new Upload();
                $link = null;
                foreach ($this->allowFileNames as $fileName) {
                    if (!empty($files[$fileName]['name'])) {
                        $result = $upload->upload_image($files, '../', $fileName);
                        if ($result !== false) $aDatas[$fileName] = $result;
                        $link = $result;
                    }
                }
                $req = $this->model->getDb()->prepare("INSERT INTO `gw_image`(`id_cible`, `lien`, `type`) VALUES ('$id_cible','$link','$block')");
                $req->execute();
            }
        }
    }

    public function GetAllImage($block, $cible)
    {
        $req = $this->model->getDb()->prepare("SELECT * FROM `" . DB_PREFIX . "image` WHERE `type` = '$block' and `id_cible` = $cible ");
        $req->execute();
        return $req->fetchAll();
    }

    public function removeImage($block, $cible = 0)
    {
        $req = $this->model->getDb()->prepare("DELETE FROM `" . DB_PREFIX . "image` WHERE `type` = '$block' and `id` = $cible");
    }

    public function lastInsertId()
    {
        return $this->model->getDb()->lastInsertId();
    }
}