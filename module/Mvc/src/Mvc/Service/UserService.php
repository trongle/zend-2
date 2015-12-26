<?php 
namespace Mvc\Service;

class UserService{
	protected $_faceBook;
	protected $_twitter;
	public function __construct($fbAcc = "abc",$ttAcc = "def"){
		$this->_faceBook = $fbAcc;
		$this->_twitter  = $ttAcc; 
	}

	public function setFaceBook($fbAcc){
		$this->_faceBook = $fbAcc;
	}
}