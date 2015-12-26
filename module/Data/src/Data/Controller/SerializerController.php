<?php

namespace Data\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class SerializerController extends AbstractActionController
{
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		// $serializer = new \Zend\Serializer\Adapter\PhpSerialize();
		$serializer = \Zend\Serializer\Serializer::factory("PhpSerialize");
		$array = array(
			"name"=> "trongle",
			"age" => "23",
			"IQ"  => 10,
			"handsome" => 10,
			"talent"   => 10,
		);
		$serialize = $serializer->serialize($array);
		echo $serialize;

		$arr = $serializer->unserialize($serialize);
		echo "<pre style='font-weight:bold'>";
		print_r($arr);
		echo "</pre>";
		return false;
	}

	public function index02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$serializer = new \Zend\Serializer\Adapter\PhpCode();
		$array = array(
			"name"=> "trongle",
			"age" => "23",
			"IQ"  => 10,
			"handsome" => 10,
			"talent"   => 10,
		);
		$serialize = $serializer->serialize($array);
		echo $serialize;

		$arr = $serializer->unserialize($serialize);
		echo "<pre style='font-weight:bold'>";
		print_r($arr);
		echo "</pre>";
		return false;
	}
}
?>