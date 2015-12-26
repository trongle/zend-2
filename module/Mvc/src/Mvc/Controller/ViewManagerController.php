<?php 
namespace Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewManagerController extends AbstractActionController{
	public function index01Action(){
		
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		return false;
	}


	//truyền biến
	public function index02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$name = "trongle";
		$info = array(
			"nick" => "trongle,trongno1",
			"age"  => "24",
			"skill"=> "PHP,Jquery,Zend,Ci,Css,Boostrap,Linux,Git,"
		);
		return array("name" => $name,"info" => $info);
	}

	public function index03Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$view = new ViewModel();
	
		$name = "trongle";
		$info = array(
			"nick" => "trongle,trongno1",
			"age"  => "24",
			"skill"=> "PHP,Jquery,Zend,Ci,Css,Boostrap,Linux,Git,"
		);
		//change View()
		$view->setTemplate("mvc/view-manager/index02.phtml");
		//$view->setVariable("name",$name);
		$view->setVariables(array("info"=>$info,"name"=>$name));

		return $view;
	}

	public function homeAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$viewHome = new ViewModel();

		//header view
		$viewHeader = new ViewModel(array("content"=>"This is the header"));
		$viewHeader->setTemplate("mvc/view-manager/header.phtml");

		//main view
		$viewMain = new ViewModel();
		$viewMain->setTemplate("mvc/view-manager/main.phtml");

		//mainview/leftview
		$viewLeft = new ViewModel();
		$viewLeft->setTemplate("mvc/view-manager/left.phtml");

		//mainview/leftright
		$viewRight = new ViewModel();
		$viewRight->setTemplate("mvc/view-manager/right.phtml");

		$viewMain->addChild($viewRight,"rightV")
				 ->addChild($viewLeft,"leftV");

		//Add nested view
		$viewHome->addChild($viewHeader,"headerV")
				 ->addChild($viewMain,"mainV");
		return $viewHome;	
	}

	public function setNestedForLayoutAction(){
		$layout = $this->layout();

		$viewHeader = new ViewModel(array("content"=>"This is the header"));
		$viewHeader->setTemplate("view/header");

		$layout->addChild($viewHeader,"headerV");
		return false;
	}

	public function changeLayoutAction(){
		$layout = $this->layout();

		$layout->setTemplate("view/header");
		$view = new ViewModel(array("trong"=>"trongle"));
		return $view;
		
	}


}