<?php 
namespace Mvc\Service;

class FaceBookService{
	protected $_facebook;
	public function __construct($fbLogin = "www.facebook.com/login"){
		$this->_facebook = $fbLogin;
	}
}