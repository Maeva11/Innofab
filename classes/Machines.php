<?php

class machines extends Controller
{
    protected $table;
    public $db;
    public $block;

    public function __construct($block = "")
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'machines');
        $this->db = parent::getModel()->getDb();
        $this->block = $block;
    }
}
