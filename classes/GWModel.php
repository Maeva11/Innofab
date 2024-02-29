<?php
class GWModel extends Controller{

	public $db;
    protected $table;
    private $i18n_fields;

	function __construct(){
		$this->db = $this->connectDatabase();
	}

	private function connectDatabase(){
		$conn = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		return $conn;
	}
	
	public function getDb(){
		return $this->db;
	}

	public function getTable(){
	    return $this->table;
    }
    public function setTable($table){
        return $this->table = $table;
    }
	public function getDbColumns(){
		$q = $this->db->prepare("DESCRIBE ".$this->table);
		$q->execute();
		return $q->fetchAll(PDO::FETCH_COLUMN);
	}

	
	public function delete($where_params){
		if(empty($where_params)) return false;
		$where='';
		foreach($where_params as $key=>$value)
			$where .= 'AND '.$key.'=:'.$key.' ';
		$req = $this->db->prepare('DELETE FROM '.$this->table.' WHERE 1=1 '.$where);
		$req->execute($where_params);
		return true;
	}
	
	public function select($where_params=array(), $order_by='id', $order_sort='DESC', $limit=false){
		$where='';
		foreach($where_params as $key=>$value)
			$where .= 'AND '.$key.'=:'.$key.' ';
		$sql = 'SELECT * ';
		if($this->i18n_fields){
			foreach($this->i18n_fields as $i18n_field){
				$sql .= ', '.$i18n_field.'_'.LANG.' as '.$i18n_field.' ';
			}
		}
		$sql .= ' FROM '.$this->table.' WHERE 1=1 '.$where.' ORDER BY '.$order_by.' '.$order_sort;
		if($limit) $sql .= ' LIMIT '.$limit;
		$req = $this->db->prepare($sql);
		$req->execute($where_params);
		return $req->fetchAll();
	}

	public function insert($set_params){
		$set = '';
		foreach($set_params as $key=>$value)
			$set .= ($set != ''?',':'').''.$key.'=:'.$key.'';
		$req = $this->db->prepare('INSERT INTO '.$this->table.' SET '.$set);
		if($req->execute($set_params))
			return true;
		return false;
	}
	public function insertUnique($set_params){
        if(empty($this->select($set_params))){
            $this->insert($set_params);
        }
    }
	public function update($set_params, $where_params){
		$where = '';
		$set = '';
		foreach($where_params as $key=>$value)
			$where .= 'AND '.$key.'=:'.$key.' ';
		foreach($set_params as $key=>$value)
			$set .= ($set != ''?',':'').''.$key.'=:'.$key.'';
		$req = $this->db->prepare('UPDATE '.$this->table.' SET '.$set.' WHERE 1=1 '.$where);
		$req->execute(array_merge($set_params, $where_params));
	}
	
	public function lastInsertId(){
		return $this->db->lastInsertId();
	}


    public function addi18nfield($field){
        $this->i18n_fields[]=$field;
    }
	
	public function seti18n($fields=array()){
		if($fields && is_array($fields) && count($fields) > 0){
			$this->i18n_fields=$fields;
		}
	}

	public function query($sql, $params = []){
        $req = $this->db->prepare($sql);
        $req->execute($params);
        return $req;
    }

}
