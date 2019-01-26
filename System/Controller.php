<?php

namespace System;

class Controller{
	public $req;
	public $res;
	protected $dbsetting;

	public function initController($req, $res){
		$this->req = $req;
		$this->res = $res;
	}

	public function load($name, $class){
		$this->$name = $class;
	}

	public function autoloadLib($autoload){
		foreach($autoload as $name => $classLib){
			$class = "App\\Library\\".$classLib;
			$this->$name = new $class();
		}
	}

	public function setDBSetting($dbsetting){
		$this->dbsetting = $dbsetting;
	}

	public function loadModel($name, $class){
		$this->$name = $class;
		$this->$name->setDB($this->dbsetting);
	}
	public function NotFound(){
		$this->res->status(404);
		$this->res->render("page404", array("title"=>"404"));
	}
}