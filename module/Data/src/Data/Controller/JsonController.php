<?php

namespace Data\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class JsonController extends AbstractActionController{
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		$arr = array(
		"invokables" => array(
            "Data\Controller\Index"      => "Data\Controller\IndexController",
            "Data\Controller\Filter"     => "Data\Controller\FilterController",
            "Data\Controller\Serializer" => "Data\Controller\SerializerController",
            "Data\Controller\Escaper"    => "Data\Controller\EscaperController",
            "Data\Controller\Purifier"   => "Data\Controller\PurifierController",
            "Data\Controller\Dom"        => "Data\Controller\DomController",
            "Data\Controller\Json"       => "Data\Controller\JsonController",
            ));

		$json = \Zend\Json\Json::encode($arr);
		//echo $json;
		echo \Zend\Json\Json::prettyPrint($json,array("indent"=>"\n"));

		$obj = \Zend\Json\Json::decode($json,\Zend\Json\Json::TYPE_ARRAY);
		echo "<pre style='font-weight:bold'>";
		print_r($obj);
		echo "</pre>";
		return false;
	}

	public function index02Action(){
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
		
	}
}