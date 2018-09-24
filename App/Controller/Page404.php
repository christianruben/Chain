<?php
namespace App\Controller;

use System\Controller as Controller;
use System\View as view;

class Page404 extends Controller{
	public function index(){
		$this->res->status(404);
		$this->res->render("page404", array("title"=>"404"));
	}
}