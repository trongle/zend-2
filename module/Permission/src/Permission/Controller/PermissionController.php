<?php 
namespace Permission\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Permissions\Acl\Acl;

class PermissionController extends AbstractActionController
{
	//permission cơ bản
	public function index01Action(){
		$aclObj = new Acl();

		$aclObj->addRole("member")
		       ->addRole("manager","member")
		       ->addRole("admin","manager");

		if($aclObj->hasRole("member")){
			echo "<h3 style='color:red;font-weight:bold'>OK</h3>";
		}

		$aclObj->removeRole("member");
		echo "<pre style='font-weight:bold'>";
		print_r($aclObj);
		echo "</pre>";
		return false;
	}

	//permission
	//add quyền cho các role  : allow
	//deny quyền cho các role : deny
	public function index02Action(){
		$aclObj = new Acl();

		$aclObj->addRole("member")
		       ->addRole("manager","member")
		       ->addRole("admin","manager");

		//tưởng tượng NewsController
		//----Action----
		//Role member : info index
		//Role manager : info index add edit
		//Role admin : info index add edit delete
		$aclObj->allow("member",null,array("info","index"));
		$aclObj->allow("manager",null,array("add","edit"));
		$aclObj->allow("admin",null,array("delete"));

		$aclObj->deny("member",null,array("add","edit","delete"));
		$aclObj->deny("manager",null,array("delete"));

		echo "<pre style='font-weight:bold'>";
		print_r($aclObj);
		echo "</pre>";
		return false;
	}

	//kiểm tra role có quyền truy cập vào action nào đó không : isAllowed
	public function index03Action(){
		$aclObj = new Acl();

		$aclObj->addRole("member")
		       ->addRole("manager","member")
		       ->addRole("admin","manager");

		$aclObj->allow("member",null,array("info","index"));
		$aclObj->allow("manager",null,array("add","edit"));
		$aclObj->allow("admin",null,array("delete"));

		$role       = "admin";
		$privileges = "info";

		if($aclObj->isAllowed($role,null,$privileges)){
			echo "<h3 style='color:red;font-weight:bold'>Được quyền truy cập</h3>";
		}else{
			echo "<h3 style='color:red;font-weight:bold'>Không được quyền truy cập</h3>";
		}

	
		echo "<pre style='font-weight:bold'>";
		print_r($aclObj);
		echo "</pre>";
		return false;
	}

	//kiểm tra role có quyền truy cập vào action nào đó không : isAllowed
	//removeAllow || removeDeny
	public function index04Action(){
		$aclObj = new Acl();

		$aclObj->addRole("member")
		       ->addRole("manager","member")
		       ->addRole("admin","manager");

		$aclObj->allow("member",null,array("info","index"));
		$aclObj->allow("manager",null,array("add","edit"));
		$aclObj->allow("admin",null,array("delete"));

		$aclObj->deny("admin",null,array("info"));
		$aclObj->removeAllow("manager",null,array("add","edit"));
		$aclObj->removeDeny("admin",null,array("info"));

		$role       = "admin";
		$privileges = array("info","index","add","edit","delete");
		if($aclObj->hasRole($role)){
			foreach($privileges as $privilege){
				if($aclObj->isAllowed($role,null,$privilege)){
					echo sprintf("<h3 style='color:red;font-weight:bold'>%s : Được quyền truy cập %s</h3>",$role,$privilege);
				}else{
					echo sprintf("<h3 style='color:red;font-weight:bold'>%s : Không được quyền truy cập %s</h3>",$role,$privilege);
				}
			}
		}	
		return false;
	}

	//Phân quyền trên nhiều controller trong mot module
	public function index05Action(){
		$aclObj = new Acl();

		$aclObj->addRole("member")
		       ->addRole("manager","member")
		       ->addRole("admin","manager");
		//add controller
		$aclObj->addResource("news")
		       ->addResource("books");

		//it's mean Role member có thể truy cập vào action "info,index" trong controller news
		$aclObj->allow("member","news",array("info","index"));
		$aclObj->allow("manager","news",array("add","edit"));	
		$aclObj->allow("admin",null,array("delete"));

		$aclObj->allow("manager","books",array("info","index","edit","add"));



		// $aclObj->deny("admin",null,array("info"));
		// $aclObj->removeAllow("manager",null,array("add","edit"));
		// $aclObj->removeDeny("admin",null,array("info"));

		$role       = "manager";
		$resource   = "books";
		$privileges = array("info","index","add","edit","delete");
		if($aclObj->hasRole($role)){
			foreach($privileges as $privilege){
				if($aclObj->isAllowed($role,$resource,$privilege)){
					echo sprintf("<h3 style='color:red;font-weight:bold'>%s : Được quyền truy cập %s - %s</h3>",$role,$resource,$privilege);
				}else{
					echo sprintf("<h3 style='color:red;font-weight:bold'>%s : Không được quyền truy cập %s - %s</h3>",$role,$resource,$privilege);
				}
			}
		}	
		return false;
	}


	//Phân quyền trên nhiều controller trong nhiều module
	public function index06Action(){
		$aclObj = new Acl();

		$aclObj->addRole("member")
		       ->addRole("manager","member")
		       ->addRole("admin","manager");
		//add controller
		//module abc
		$aclObj->addResource("abc:news")
		       ->addResource("def:books");

		//it's mean Role member có thể truy cập vào action "info,index" trong controller news
		$aclObj->allow("member","abc:news",array("info","index"));
		$aclObj->allow("member","def:books",array("info","index","edit","add"));

		$role       = "member";
		$resource   = "def:books";
		$privileges = array("info","index","add","edit","delete");
		if($aclObj->hasRole($role)){
			foreach($privileges as $privilege){
				if($aclObj->isAllowed($role,$resource,$privilege)){
					echo sprintf("<h3 style='color:red;font-weight:bold'>%s : Được quyền truy cập %s - %s</h3>",$role,$resource,$privilege);
				}else{
					echo sprintf("<h3 style='color:red;font-weight:bold'>%s : Không được quyền truy cập %s - %s</h3>",$role,$resource,$privilege);
				}
			}
		}	
		return false;
	}
}
?>