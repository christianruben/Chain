<?php
namespace App\Controller;
use System\Controller as Controller;

class Ap extends Controller{
	public function __construct(){
		echo "JELL";
	}
	public function index(){
        if($this->req->session->userdata("islogged")){
            $this->res->render("main", array("title"=>"Main"));
        }else{
            // $this->res->redirect("login");
            echo "SA";
        }
    }
}