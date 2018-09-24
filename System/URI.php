<?php

namespace System;

class URI{

	private $path = "";

	private $segments = array();

	private $main_segment = "";

	private $second_segment = "";

	private $params_segment = array();

	private $pathsettings;

	private $uri_string = "";

	private $_permitted_uri_chars;

	public function __construct($pathsettings){
		$this->pathsettings = $pathsettings;
		$this->_permitted_uri_chars = $pathsettings['permitted_uri_chars'];
		if(is_cli()){
			$this->_parse_uri($this->_parse_argv(), TRUE);
		}else{
			$this->_parse_uri($this->_parse_request_uri(), FALSE);
		}
	}

	protected function _parse_uri($str, $cli=FALSE){
		if($cli){
			if(trim($str, "/") === ""){
				return;
			}

			foreach (explode("/", $str) as $segment) {
				if(trim($segment) !== ""){
					if(empty($this->main_segment)){
						$this->main_segment = $segment;
					}elseif(empty($this->second_segment)){
						$this->second_segment = $segment;
					}else{
						array_push($this->params_segment,$segment);
					}
					array_push($this->segments, $segment);
				}
			}
			return;
		}else{

			$this->uri_string = trim(remove_invisible_characters($str, FALSE), '/');

			if ($this->uri_string === '')
			{
				return;
			}

			// Remove the URL suffix, if present
			if (($suffix = (string) $this->pathsettings['url_suffix']) !== '')
			{
				$slen = strlen($suffix);

				if (substr($this->uri_string, -$slen) === $suffix)
				{
					$this->uri_string = substr($this->uri_string, 0, -$slen);
				}
			}

			foreach (explode('/', trim($this->uri_string, '/')) as $segment)
			{
				$segment = trim($segment);
				// Filter segments for security
				$this->filter_uri($segment);

				if ($segment !== '')
				{
					if(empty($this->main_segment)){
						$this->main_segment = $segment;
					}elseif(empty($this->second_segment)){
						$this->second_segment = $segment;
					}else{
						array_push($this->params_segment,$segment);
					}
					array_push($this->segments, $segment);
				}
			}
		}
	}

	protected function _parse_argv(){
		$args = array_slice($_SERVER['argv'], 1);
		return $args ? implode('/', $args) : '';
	}

	protected function _parse_request_uri(){
		if(!isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME'])){
			return '';
		}

		$uri = parse_url("http://localhost".$_SERVER['REQUEST_URI']);
		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';

		if(isset($_SERVER['SCRIPT_NAME'][0])){
			if(strpos($uri, $_SERVER['SCRIPT_NAME']) === 0){
				$uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}elseif(strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0){
				$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}

		if(trim($uri, '/') === '' && strncmp($query, '/', 1) === 0){
			$query = explode("?", $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		}else{
			$_SERVER['QUERY_STRING'] = $query;
		}

		parse_str($_SERVER['QUERY_STRING'], $_GET);

		if($uri === "/" || $uri === ''){
			return '/';
		}

		return $this->_remove_relative_directory($uri);
	}

	protected function _remove_relative_directory($uri)
	{
		$uris = array();
		$tok = strtok($uri, '/');
		while ($tok !== FALSE)
		{
			if (( ! empty($tok) OR $tok === '0') && $tok !== '..')
			{
				$uris[] = $tok;
			}
			$tok = strtok('/');
		}

		return implode('/', $uris);
	}

	public function filter_uri(&$str)
	{
		if ( ! empty($str) && ! empty($this->_permitted_uri_chars) && ! preg_match('/^['.$this->_permitted_uri_chars.']+$/i'.'u', $str))
		{
			die('The URI you submitted has disallowed characters.');
		}
	}

	public function getSegment($index){
		if(isset($this->segments[$index])){
			return $this->segments[$index];
		}
		return null;
	}

	public function getMainPath(){
		return $this->main_segment;
	}

	public function getSecondPath(){
		return $this->second_segment;
	}

	public function getParamsPaths(){
		return $this->params_segment;
	}
}