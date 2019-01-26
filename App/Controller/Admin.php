<?php
namespace App\Controller;
use System\Controller as Controller;

class Admin extends Controller{
	public function __construct(){
		
	}
	public function index(){
        $this->res->render("main", array("title"=>"Main"));
    }
    
    public function login(){
        if(!$this->req->session->userdata("islogged")){
            $this->res->render("login-page", array("title"=>"Login"));
        }else{
            $this->res->redirect("");
        }
    }
}