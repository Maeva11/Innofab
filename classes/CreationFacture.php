<?php

class CreationFacture extends Controller
{
    protected $table;
    public $db;
    public $block;

    public function __construct($block = "")
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'creation_facture');
        $this->db = parent::getModel()->getDb();
        $this->block = $block;
    }
}
