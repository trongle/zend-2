<?php 
namespace Mvc\Controller;

use Mvc\Service\FaceBookService;
use Mvc\Service\UserService;
use Zend\Mvc\Controller\AbstractActionController;

class ServiceController extends AbstractActionController{
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$userService  = new UserService("trongle","trongle2015");
		$userService2 = new FaceBookService();

		echo "<pre style='font-weight:bold'>";
		print_r($userService);
		echo "</pre>";

		echo "<pre style='font-weight:bold'>";
		print_r($userService2);
		echo "</pre>";
		return false;
	}

	// use Singleton Pattern
	public function index02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		
		$serviceManager = $this->getServiceLocator();
		$userService = $serviceManager->get("Mvc\Service\User");

		$userService->setFaceBook("trongle");
		echo "<pre style='font-weight:bold'>";
		print_r($userService);
		echo "</pre>";

		$userService2 = $serviceManager->get("Mvc\Service\User");
		echo "<pre style='font-weight:bold'>";
		print_r($userService2);
		echo "</pre>";
		
		return false;
	}

	// Another Service
	public function index03Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		
		$serviceManager  = $this->getServiceLocator();
		$userService     = $serviceManager->get("Mvc\Service\User");
		$facebookService = $serviceManager->get("Mvc\Service\FaceBook");

		$facebookService->setFaceBook("trongle");
		echo "<pre style='font-weight:bold'>";
		print_r($userService);
		echo "</pre>";

		
		echo "<pre style='font-weight:bold'>";
		print_r($facebookService);
		echo "</pre>";
		
		return false;
	}

	// Set service on Module.php
	public function index04Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		
		return false;
	}
}