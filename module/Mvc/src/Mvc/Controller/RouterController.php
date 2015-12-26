<?php 
namespace Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class RouterController extends AbstractActionController{

	public function showRouterInfo(){
		//get info Router
		$routerMatch = $this->getEvent()->getRouteMatch();
		//routername
		echo $routerName  = $routerMatch->getMatchedRouteName(); 
		//param
		$param = $routerMatch->getParams();
		echo "<pre style='font-weight:bold'>";
		print_r($param);
		echo "</pre>";
	}
	public function index01Action(){
		//get param
		//controller-action-module
		$controllerName = $this->params("controller");
		$actionName = $this->params("action");

		//get info Router
		$routerMatch = $this->getEvent()->getRouteMatch();
		echo $routerName  = $routerMatch->getMatchedRouteName(); 
		$param = $routerMatch->getParams();
		echo "<pre style='font-weight:bold'>";
		print_r($param);
		echo "</pre>";
		return false;
	}

	public function contactAction(){
		//get param
		//controller-action-module
		$controllerName = $this->params("controller");
		$actionName = $this->params("action");

		$this->showRouterInfo();
		return false;
	}

	public function loginAction(){
		//get param
		//controller-action-module
		$controllerName = $this->params("controller");
		$actionName = $this->params("action");

		$this->showRouterInfo();
		return false;
	}

	public function editAction(){
		//get param
		//controller-action-module
		$controllerName = $this->params("controller");
		$actionName = $this->params("action");

		$this->showRouterInfo();
		return false;
	}

	public function addAction(){
		//get param
		//controller-action-module
		$controllerName = $this->params("controller");
		$actionName = $this->params("action");

		$this->showRouterInfo();
		return false;
	}

	public function courseAction(){
		//get param
		//controller-action-module
		$controllerName = $this->params("controller");
		$actionName = $this->params("action");
		echo $this->params()->fromRoute('name')."<br />";
		echo $this->params('id')."<br />";

		$this->showRouterInfo();
	
	}
}
?>