<?php

class tarifs extends Controller
{
    protected $table;
    public $db;
    public $block;

    public function __construct($block = "")
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'tarifs');
        $this->db = parent::getModel()->getDb();
        $this->block = $block;
    }
}
