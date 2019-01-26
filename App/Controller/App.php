<?php
namespace App\Controller;
use System\Controller as Controller;

class App extends Controller{
	public function __construct(){
		
	}
	public function index(){
        if($this->req->session->userdata("islogged")){
            $this->res->render("main", array("title"=>"Main"));
        }else{
            // $this->res->redirect("login");
            echo "SA";
        }
    }
    public function main(){
    	echo "Main";
    }
}