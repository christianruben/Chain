<?php

namespace System;

class Routes{
	private $_routelist = array();
	private $_callbacks = array();

	public function __construct(){

	}

	public function addRoute($uri, $callback){
		if(!empty($uri) && !is_null($uri)){
			$this->_routelist[] = $uri;
		}
		if(!is_null($callback) || !empty($callback)){
			$this->_callbacks[] = $callback;
		}
	}
}