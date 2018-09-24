<?php

namespace System;
use System\View;
class Core{
	protected $uri;
	protected $_c;
	protected $_m;
	protected $_p;
	protected $_default = "";
	protected $_404 = "";
	protected $loadClass;
	protected $req;

	protected $autoload;

	protected $dbsetting;

	public function __construct($req){
		$this->req = $req;
		$this->uri = $req->getUri();
	}

	public function bootstrap($path, $autoload, $dbsetting){
		$this->autoload = $autoload;
		$this->dbsetting = $dbsetting;
		$this->_default = $path['default'];
		$this->_404 = $path['404'];

		$this->_c = ucfirst(strtolower($this->uri->getMainPath()));
		$this->_m = strtolower($this->uri->getSecondPath());
		$this->_p = $this->uri->getParamsPaths();

		if(empty($this->_c)){
			$this->_c = $this->_default;
		}

		if(empty($this->_m)){
			$this->_m = "index";
		}

		$path = APP.DS.'Controller'.DS.$this->_c.".php";
		if(!file_exists($path)){
			$this->_c = $this->_404;
		}

		$class = "App\\Controller\\".$this->_c;
		$this->loadClass = new $class();
		if(!method_exists($this->loadClass, $this->_m)){
			$this->_c = $this->_404;
			$this->_m = "index";
		}
		$class = "App\\Controller\\".$this->_c;
		$this->loadClass = new $class();

		$this->LoadRender();
	}

	private function LoadRender(){
		$this->loadClass->initController($this->req, new View($this->loadClass));
		$this->loadClass->autoloadLib($this->autoload);
		$this->loadClass->setDBSetting($this->dbsetting);
		call_user_func_array(array($this->loadClass, $this->_m), $this->_p);
	}
}