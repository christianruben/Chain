<?php
namespace App\Controller;
use System\Controller as Controller;

class User extends Controller{
    public function insert(){
        if($this->req->getMethod() == "POST"){
            $name = $this->req->Post("name");
            $account = $this->req->Post("account");
            $username = $this->req->Post("username");
            $password = $this->req->Post("password");
            
        }
    }
}