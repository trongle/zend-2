<?php

namespace Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
	
class ViewHelperController extends AbstractActionController{
	// About Layout
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$this->layout("layout/mvc");
	}

	// About BasePath()
	public function index02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$this->layout("layout/mvc");
	}

	// About Cycle
	public function index03Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$arrCourse = array(
				array( "name" => "PHP2015","qty" =>"200"),
				array( "name" => "Zend" ,  "qty" => "500"),
				array( "name" => "Jquery" ,"qty" => "300")
			);
		$viewModel = new ViewModel(
			array(
				"course" => $arrCourse,
			)
		);
		$this->layout("layout/mvc");
		return $viewModel;
	}

	// About Doctype() and Escape and Gravatar
	public function index04Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$this->layout("layout/mvc");
	}

	// About headTitle()
	public function index05Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//use by sevice
		// $render = $this->getServiceLocator()->get("Zend\View\Renderer\PhpRenderer");
		// $render->headTitle("trongle");
		// $render->headTitle()->append("handsome");
		// $render->headTitle()->setSeparator(" - ");
		$this->layout("layout/mvc");
	}

	// About headMeta()
	public function index06Action(){
		//echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$render = $this->getServiceLocator()->get("Zend\View\Renderer\PhpRenderer");
		//////////////
		//MetaEquiv //
		//////////////
		
		//them meta
		$render->headMeta()->appendHttpEquiv("Content-Type","text/html; charset=iso-8859-1");
		$render->headMeta()->prependHttpEquiv("Content-Language","vi");

		//sua bang offet
		$render->headMeta()->offsetSetHttpEquiv(1,"X-UA-Compatible","requiresActiveX=true");
		//sua bang ten
		$render->headMeta()->setHttpEquiv("Content-Type","text/html; charset=utf-8");

		//////////////
		//MetaName //
		//////////////
		
		/////them meta
		$render->headMeta()->appendName("description","Nghe bài hát Taking Back My Love 320kbps ca sĩ Enrique Iglesias");
		$render->headMeta()->prependName("copyright","NhacCuaTui.Com");

		//sua bang offet
		$render->headMeta()->offsetSetName(2,"author","Enrique Iglesias, Ciara");


		//Xoa het Meta
		$render->headMeta()->getContainer()->exchangeArray(array());


		$this->layout("layout/mvc");
	}

	// About headLink()
	public function index07Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		$viewHelperManager = $this->getServiceLocator()->get("viewhelpermanager");
		$headLink = $viewHelperManager->get("headLink");

		$headLink->appendStylesheet(PUBLIC_URL."css/style.css","screen");

		//dieu kien 
		//$headLink->appendStylesheet(PUBLIC_URL."css/style.css","screen","lte IE6");
		//$headLink->getContainer()->exchangeArray(array());
		$this->layout("layout/mvc");
	}

	// About headScript()
	public function index08Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		$viewHelperManager = $this->getServiceLocator()->get("viewhelpermanager");
		$headScript = $viewHelperManager->get("headScript");

		$headScript->appendFile(PUBLIC_URL."js/jquery.min.js","text/javascript");

		$this->layout("layout/mvc");
	}

	// About inlineScript()
	public function index09Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		$viewHelperManager = $this->getServiceLocator()->get("viewhelpermanager");
		$headScript = $viewHelperManager->get("inlineScript");


		$headScript->appendFile(PUBLIC_URL."js/jquery.min.js","text/javascript");

		$headScript->appendScript(
			'$(document).ready(function() { alert("Hello"); });',
			'text/javascript',
			array('noescape' => true)// Disable CDATA comments
		); 


		$this->layout("layout/mvc");
	}

	// About ()
	public function index10Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 
		$this->layout("layout/mvc");
		return false;
	}

	// About htmlList()
	public function index11Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		$arr = array(
			"Zend Framework",
			array(
				"HTML","CSS","JS"
			),
			"CodeIgniter"
		);
		$viewModel = new ViewModel(array("data"=>$arr));
		return $viewModel;
	}

	// About htmlFlash()
	public function index12Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About json()
	public function index13Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About partial()
	public function index14Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About partial()
	public function index15Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About partial()
	public function index16Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About partial()
	public function index17Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About placeholder()
	public function index18Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About ...Format()
	public function index19Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		
		$this->layout("layout/mvc");
		
	}

	// About serverURL()
	public function index20Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
 		$serverURL = new \Zend\View\Helper\ServerUrl();
 		//getHost()
 		echo $serverURL->getHost()."<br />";
 		//getPort()
 		echo $serverURL->getPort()."<br />";
 		//getScheme()
 		echo $serverURL->getScheme()."<br />";
		$this->layout("layout/mvc");
		return false;
		
	}

	// Đăng ký helper riêng
	public function index21Action(){
		
		$this->layout("layout/mvc");	
	}
}