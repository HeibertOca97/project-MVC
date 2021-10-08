<?php namespace models;

use core\ModelBase;

class User extends ModelBase{
    public $username = "username test";
    private $table = "table_name";
    
    public function __construct(){
        parent::__construct($this->table);
    }

    public function personas(){
        return $this->getAll();
    }

}