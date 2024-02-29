<?php


class GenerateForm extends Controller
{
    protected $table;
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'formfields');
        $this->db = parent::getModel()->getDb();
    }

    public function getAll($balise = '', $order_by = 'id', $order_sort = 'DESC')
    {
        ($balise == '') ? $where = "1" : $where = "balise = '" . $balise . "'";
        $req = $this->db->prepare("SELECT * from $this->table WHERE $where ");
        $req->execute();
        if ($data = $req->fetchAll()) {
            return $data;
        }
    }

    public function getId($id)
    {
        $req = $this->db->prepare("SELECT * from $this->table WHERE id = ? ");
        $req->execute([$id]);
        if ($data = $req->fetch()) {
            return $data;
        }
    }

    public function generateInputBuilder($id = 0, $datas = [])
    {
        if ($id > 0 and $datas == []) {
            $data = $this->getId($id);
            $balise = $data->balise;
            $type = $data->type;
        }else{
            $balise = @$datas->balise;
            $type = @$datas->type;

        }
        $html = '<tr data-position="'.@$datas->position.'" data-balise="' . @$balise . '" data-type="' . @$type . '" >';
        $html .= '<td colspan="1"><i class="fas fa-arrows-alt"></i></td>';
        $html .= '<td colspan="2">' . $balise . ' ' . $type . '</td>';
        $html .= '<td colspan="2"><input class="form-control" type="text" id="label" placeholder="label" value ="'.@$datas->label.'"></td>';
        if ($balise == "select") {
            $html .= '<td colspan="4"><input class="form-control" type="text" id="datas" placeholder="label,label,label,label" value ="'.@$datas->datas.'"></td>';
        } else {
            (@$data->placeholder or @$datas->placeholder) ? $disabled = "" : $disabled = 'disabled';
            $html .= '<td colspan="2"><input class="form-control" type="text" id="placeholder" value = "'.@$datas->placeholder.'" placeholder="placeholder" ' . $disabled . '></td>';
            (@$data->masque or @$datas->masque) ? $disabled = "" : $disabled = 'disabled';
            $html .= '<td colspan="2"><input class="form-control" type="text" id="masque" value = "'.@$datas->masque.'" placeholder="masque" ' . $disabled . '></td>';
        }
        $html .= '<td colspan="2"><input class="form-control" type="text" value = "'.@$datas->largeur.'" id="largeur" placeholder="largeur"></td>';
        $html .= '<td><a class="delete btn btn-danger btn-link btn-lg"><i class="fas fa-times"></i></a></td>';
        $html .= '</tr>';
        return $html;
    }
}