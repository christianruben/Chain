<?php
namespace App\Library;

class Template{
    public $public;
    public $path = "/Chain/Chain";
    public $url;

    public function __construct(){
        $this->public = "http://".$_SERVER['HTTP_HOST'].$this->path.DS."public/";
        
        $this->url = explode("?", $_SERVER['REQUEST_URI'], 2)[0];
    }
}