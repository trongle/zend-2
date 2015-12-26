<?php 
namespace Permission\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

class SessionController extends AbstractActionController
{	
	//offsetSet()
	public function index01Action(){
		$ssUser = new Container("user");
		$ssUser->offsetSet("name","trongle");
		return false;
	}

	//offsetGet và  offsetExists
	public function index02Action(){
		$ssUser = new Container("user");
		if($ssUser->offsetExists("mail")){
			echo $ssUser->offsetGet("name");
		}else{
			echo "Noooooooo session";
		}
		return false;
	}

	public function index03Action(){
		$ssUser = new Container("user");
		$ssUser->offsetUnset("name");
		if($ssUser->offsetExists("name")){
			echo $ssUser->offsetGet("name");
		}else{
			echo "Noooooooo session";
		}
		return false;
	}


	//setExperation
	public function index04Action(){
		$ssUser = new Container("user");
		//$ssUser->offsetSet("fullname" , "trong handsome");
		echo $ssUser->offsetGet("fullname");
		$ssUser->setExpirationSeconds(5,array("fullname"));
		return false;
	}

	//clear() hết
	public function index05Action(){
		$ssUser  = new Container("user");
		$ssGroup = new Container("group");
	    
	    $ssUser->offsetSet("fullname","trongle");
	    $ssGroup->offsetSet("groupname","sasfsaf");
	    	$ssUser->getManager()->getStorage()->clear("group");
		echo $ssUser->offsetGet("fullname");
		echo $ssGroup->offsetGet("groupname");


		return false;
	}
}
?>