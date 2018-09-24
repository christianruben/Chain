<?php

namespace System;
use System\URI;

class Request{

	private $uri;

	private $guestAddr;

	private $guestPort;

	private $keepAlive;

	private $userAgent;

	private $gate;

	private $protocol;

	private $host;

	private $settings;

	public $session;

	public function __construct($settings){
		$this->settings = $settings;

		$this->_render_();
	}

	private function _render_(){
		$this->_uri_render();

	}

	private function _uri_render(){
		$this->uri = new URI($this->settings);
	}

	public function getUri(){
		return $this->uri;
	}

	public function getMethod(){
		if(isset($_SERVER["REQUEST_METHOD"])){
			return $_SERVER["REQUEST_METHOD"];
		}
		return "GET";
	}

	public function Post($key){
		if(isset($_POST[$key])){
			return $_POST[$key];
		}
		return null;
	}

	public function Get($key){
		if(isset($_GET[$key])){
			return $_GET[$key];
		}
		return null;
	}

	public function setSession($session){
		$this->session = $session;
	}
}