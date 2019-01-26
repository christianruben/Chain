<?php
namespace App\Controller;
use System\Controller as Controller;

class Contact extends Controller{
    public function index(){
        $this->res->render("contactus", array("head"=>"Contact Us"));
    }
}