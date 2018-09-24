<?php

namespace System;
use System\Database as Database;
class Model{
    public $db;

    public function setDB($settings){
        $database = new Database($settings);
        $this->db = $database->getDB();
    }
}