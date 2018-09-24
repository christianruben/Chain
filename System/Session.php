<?php

namespace System;

class Session{
	protected $settings;
	public function __construct($settings){
		$this->settings = $settings;
		$this->StartSession();
	}

	protected function StartSession(){
		session_start();
		if(isset($this->settings) || $this->settings != 0){
			$timeout = $this->settings['timeout'] * 60; // Converts minutes to seconds
			if (isset($_SESSION['start_time'])) {
				$elapsed_time = time() - $_SESSION['start_time'];
				if ($elapsed_time >= $timeout) {
					session_destroy();
					session_start();
				}
			}
			$this->set('start_time', time());
		}
	}

	protected function setTimeout($timeout){
		$this->set("timeout", $timeout);
	}

	protected function get($key){
		if(isset($_SESSION[$key])){
			return $_SESSION;
		}
		return null;
	}

	protected function set($key, $value){
		$_SESSION[$key] = $value;
	}

	protected function remove($key){
		unset($_SESSION[$key]);
	}

	public function removeAll(){
		session_unset();
	}

	public function destroy(){
		return session_destroy();
	}

	public function set_userdata($data, $value=NULL){
		if(is_array($data)){
			foreach ($data as $key => &$value) {
				$this->set($key, $value);
			}
			return;
		}

		$this->set($data, $value);
	}

	public function remove_userdata($key){
		if(is_array($key)){
			foreach ($key as $k) {
				$this->remove($k);
			}

			return;
		}
		$this->remove($key);
	}

	public function userdata($key = NULL){
		if(isset($key)){
			return $this->get($key);
		}elseif(empty($_SESSION)){
			return array();
		}

		$userdata = array();
		
	}

	public function all_datauser(){

	}
}