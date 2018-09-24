<?php
namespace System;
use System\Driver\PDODriver;

class Database{
    private $db;
    public function __construct($settings){
        $this->db = new PDODriver($settings);
    }

    public function getDB(){
        return $this->db;
    }
}