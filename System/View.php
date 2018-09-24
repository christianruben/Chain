<?php

namespace System;

class View{
	private $obj;
	public function __construct($obj){
		$this->obj =& $obj;
	}
	public function status($code){
		http_response_code($code);
	}
	public function render($view, $data = array()){
		$path = APP.DS."View".DS.$view.".php";
		if(file_exists($path)){
			extract($data);

			ob_start();
			include($path);

			$strView = ob_get_contents();

			ob_end_clean();
			echo $this->parser($strView, $data);
		}
	}

	protected function parser($template, $data){
		$matches = array();
		preg_match_all('/{{include+\s+[\w\/]+}}/', $template, $matches);
			extract($data);
		foreach ($matches[0] as $key => $value) {
			$include_file = str_replace(array("{{include ", "}}"), "", $value);
			
			$path = APP.DS."View".DS.$include_file.".php";
			ob_start();
			include($path);
			$view = ob_get_contents();
			ob_end_clean();
			$template = str_replace($value, $view, $template);
		}

		return $template;
	}

	public function json($data=array()){
		echo json_decode($data);
	}

	public function redirect($path){
		$url = str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]);
		header("Location: ".$url.$path);
	}
}