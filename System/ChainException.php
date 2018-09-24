<?php

namespace System;

class ChainException extends \Exception{
	// public function __construct($msg, $code){
	// 	parent::__construct($msg, $code);
	// }

	public function getErrorMessage(){
		$errorMsg = '<div style="background:#E11B1B;height:40px;width:50%;vertical-align:middle">Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$this->getMessage().'</b></div>';
		return $errorMsg;
	}
}