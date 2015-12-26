<?php
namespace Training\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class IndexController extends AbstractActionController
{
	public function indexAction(){
		/*
		Display view
		 */
		
		// 1- return false;
		// 2- return "";
		
		/*
		Display layout
		 */
		// $viewModel = new ViewModel();
		// $viewModel->setTerminal(true);
		// return $viewModel;

		/*
		Display layout and View
		 */
		echo "<h3>Bla bla bla</h3>";
		//return $this->getResponse();
		return $this->response;
	}
}
?>