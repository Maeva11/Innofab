<?php

class users extends Controller
{
    protected $table;
    public $db;
    public $block;

    public function __construct($block = "")
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'users');
        $this->db = parent::getModel()->getDb();
        $this->block = $block;
    }

    function verifyPassword($email, $password) {

        $conn = $this->db;
        $stmt = $conn->prepare("SELECT id, password FROM gd_users WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            return $result['id']; 
        } else {
            return false;
        }
    }
}
