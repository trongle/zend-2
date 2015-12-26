<?php 
namespace Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PluginController extends AbstractActionController{
	public function index01Action(){
		
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		return false;
	}


//forward();
	public function forwardAction(){
		
		
		//echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		return $this->forward()->dispatch("Mvc\Controller\Plugin",array(
				"action"=>"detail",
				"course"=>array("PHP","Zend","CI")
			)
		);
	}

	public function detailAction(){
		
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		echo "<pre style='font-weight:bold'>";
		print_r($this->params("course"));
		echo "</pre>";

	}

	//params();
	public function ParamsAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		// $params = new \Zend\Mvc\Controller\Plugin\Params();
		// $params->fromQuery();

		//fromQuery--->GET
		$getType = $this->params();
		echo "<pre style='font-weight:bold'>";
		print_r($getType->fromQuery());
		echo "</pre>";
		echo $getType->fromQuery("emails","tronglehandsome");

		//fromPOST--->POST
		$getType = $this->params();
		echo "<pre style='font-weight:bold'>";
		print_r($getType->fromPost());
		echo "</pre>";
		echo $getType->fromPost("emails","tronglehandsome");

		//fromRoute--->Router info
		$getType = $this->params();
		echo "<pre style='font-weight:bold'>";
		print_r($getType->fromRoute());
		echo "</pre>";
		//echo $getType->fromRoute("emails","tronglehandsome");
		

		////fromHeader--->Router info
		$getType = $this->params();
		echo "<pre style='font-weight:bold'>";
		print_r($getType->fromHeader());
		echo "</pre>";

		////fromFiles-->FILE
		$getType = $this->params();
		echo "<pre style='font-weight:bold'>";
		print_r($getType->fromFiles());
		echo "</pre>";
	}

	//redirect
	public function redirectAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//$this->redirect()->toUrl("http://zend.vn");
		$this->redirect()->toRoute("regexType",array("name"=>"trongle","id"=>"1","extension"=>"php"));
		return false;
	}

	//url
	public function urlAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$params = array("name"=>"trongle","id"=>"1","extension"=>"php");

		$router = $this->getEvent()->getRouter();
		echo $url = $router->assemble($params, array('name' => 'regexType'));

		echo $this->url()->fromRoute("regexType",$params);
		return false;
	}

	//flashmessenger()-->show ++ check
	public function flashMessengerAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$flashMessenger = $this->flashMessenger();
		$flashMessenger->addSuccessMessage("success Messege");
		if($flashMessenger->hasSuccessMessages()){
			echo "<pre style='font-weight:bold'>";
			print_r($flashMessenger->getSuccessMessages());
			echo "</pre>";
		}else{
			echo "<h3 style='color:red;font-weight:bold'>no messege</h3>";
		}
		
		return false;
	}

	//flashmessenger()-->clear
	public function flashMessenger02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$flashMessenger = $this->flashMessenger();

		$flashMessenger->addSuccessMessage("success Messege");
		$flashMessenger->addSuccessMessage("success Messege 02");

		$flashMessenger->addInfoMessage("info Messege");

		echo "<pre style='font-weight:bold'>";
		print_r($flashMessenger->getSuccessMessages());
		echo "</pre>";

		echo "<pre style='font-weight:bold'>";
		print_r($flashMessenger->getInfoMessages());
		echo "</pre>";

		//$flashMessenger->clearMessagesFromNamespace("success");
		$flashMessenger->clearMessagesFromContainer();

		echo "<pre style='font-weight:bold'>";
		print_r($flashMessenger->getSuccessMessages());
		echo "</pre>";

		echo "<pre style='font-weight:bold'>";
		print_r($flashMessenger->getInfoMessages());
		echo "</pre>";
	
		return false;
	}

	//flashmessenger()-->namepsace()
	public function flashMessenger03Action(){
		$flashMessenger = $this->flashMessenger();
//namespace = trongle
		echo $flashMessenger->getNamespace();
		
		$flashMessenger->setNamespace("trongle");

		$flashMessenger->addMessage("success message");

		echo "<pre style='font-weight:bold'>";
		print_r($flashMessenger->getMessages());
		echo "</pre>";

//namespace = trongle
		
		$flashMessenger->setNamespace("letrong");

		$flashMessenger->addMessage("taltgif");

		$flashMessenger->clearMessagesFromNamespace("letrong");

		echo "<pre style='font-weight:bold'>";
		print_r($flashMessenger->getMessages());
		echo "</pre>";
		return false;
	}

	//flashmassenger()-->advance
	public function flashMessenger04Action(){
		$this->flashMessenger()->addSuccessMessage("BẠn đã đăng nhập thành công")
							   ->addSuccessMessage("BẠn đã đăng nhập thành công")
							   ->addSuccessMessage("BẠn đã đăng nhập thành công");
		return $this->redirect()->toRoute("literalType");
	}

	public function loginAction(){
		//echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$flashMessenger = $this->flashMessenger();
		if($flashMessenger->hasSuccessMessages()){
			$result['successMess'] = $flashMessenger->getSuccessMessages();
		}
		// echo "<pre style='font-weight:bold'>";
		// print_r($result);
		// echo "</pre>";

		return $result;
	}

	//create Plugin
	public function myPluginAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$this->myOwnPlugin("<h1>TrongLe</h1>")->showInfo();
		return false;
	}
}