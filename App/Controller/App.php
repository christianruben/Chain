<?php
namespace App\Controller;
use System\Controller as Controller;

class App extends Controller{
	public function __construct(){
		
	}
	public function index(){
        $this->res->render("home", array("title"=>"Main"));
    }
    public function main(){
    	echo "Main";
    }
}