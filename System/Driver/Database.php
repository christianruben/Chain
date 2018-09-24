<?php

namespace System\Driver;

class Database{
    public $dbname;
    public $host;
    public $username;
    public $password;
    public $port;
    public $charset;
    public $collate;

    public function __construct($dbsetting){
        $this->dbname = $dbsetting['dbname'];
        $this->host = $dbsetting['hostname'];
        $this->username = $dbsetting['username'];
        $this->password = $dbsetting['password'];
        $this->port = $dbsetting['port'];
        $this->charset = $dbsetting['charset'];
        $this->collate = $dbsetting['collate'];
    }
}