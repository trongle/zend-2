<?php 
namespace Form\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
* 
*/
class FormFilterController extends AbstractActionController
{
	
	public function index01Action(){
		$form = new \Form\Form\Login();
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			// $data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myFormLogin" => $form
		));

	}

	public function index02Action(){
		$form = new \Form\Form\studyFour();
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			// $data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myForm" => $form
		));

	}

	public function index03Action(){
		$form = new \Form\Form\Register();
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			// $data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myFormRegister" => $form
		));

	}

	public function index04Action(){
		$form = new \Form\Form\StudyFour();
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			// $data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myForm" => $form
		));
	}

	public function index05Action(){
		$form = new \Form\Form\StudyFour();
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			// $data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myForm" => $form
		));
	}

	public function exerciseOneAction(){
		$form = $this->serviceLocator->get("FormElementManager")->get("loginForm");
		if($this->request->isPost()){
			$data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myFormLogin" => $form
		));

	}

	public function exerciseTwoAction(){
		$form = new \Form\Form\Login();
		if($this->request->isPost()){
			$data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myFormLogin" => $form
		));

	}

	public function exerciseThreeAction(){
		$form = new \Form\Form\Login();
		if($this->request->isPost()){
			$data = $this->request->getPost();
			$form->setData($data);
			if($form->isValid()){
				echo "<pre style='font-weight:bold'>";
				print_r($form->getData());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myFormLogin" => $form
		));

	}

	public function ajax01Action(){
		
	}

	public function ajax02Action(){
		$myForm = new \Form\Form\Course();
		$viewModel = new ViewModel(array(
			"myForm" => $myForm,
		));
	
		return $viewModel;
	}

	public function ajaxData01Action(){
		$data = null;
		$isXmlHttpRequest = false;
		if($this->request->isXmlHttpRequest()){
			$arrType = array(
				"php"    => "PHP Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, dolore.",
				"zend"   => "Zend Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, voluptatum.",
				"jquery" => "Jquery Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, earum?"
			);	
			$isXmlHttpRequest = true;
			$type = $this->params()->fromQuery('type','php');
		}
		
		$viewModel = new ViewModel(array(
			"data"             => $arrType[$type],
			"isXmlHttpRequest" => $isXmlHttpRequest
		));
		$viewModel->setTerminal(true);
		return $viewModel;
	}

	public function ajaxData02Action(){
		$data = null;
		$isXmlHttpRequest = false;
		if($this->request->isXmlHttpRequest()){
			$arrType = array(
				array("id" => 1,"name" => "Lập trình PHP","type" => "web"),
				array("id" => 2,"name" => "Lập trình jQuery","type" => "web"),
				array("id" => 3,"name" => "Lập trình ZF 2","type" => "web"),
				array("id" => 4,"name" => "Lập trình Android","type" => "mobile"),
				array("id" => 5,"name" => "Lập trình Ios","type" => "mobile"),
				array("id" => 5,"name" => "Thiết kế web bằng Photoshop","type" => "design"),
			);	
			$isXmlHttpRequest = true;
			$type = $this->params()->fromQuery('type','ewb');
			foreach($arrType as $key => $val){
				if($val['type'] === $type) $data[] = $val;
			}
		}
		
		$viewModel = new ViewModel(array(
			"data"             => $data,
			"isXmlHttpRequest" => $isXmlHttpRequest
		));
		$viewModel->setTerminal(true);
		return $viewModel;
	}

	public function ajax03ValidateAction(){
		$myForm = $this->serviceLocator->get("FormElementManager")->get("loginForm");

		return  new ViewModel(array(
			"myForm" => $myForm,
		));
	}

	public function doValidateAction(){
		$myForm = $this->serviceLocator->get("FormElementManager")->get("loginForm");
		if($this->request->isPost()){
			$data = $this->request->getPost();
			$myForm->setData($data);
			if($myForm->isValid()){
				$result['status'] = "success";
			}else{
				$result['status'] = "error";
				$result['message']['email'] = "Email : " .current($myForm->getMessages("my-email"));
				$result['message']['password'] = "Password : " .current($myForm->getMessages("my-password"));		
			}
		}
		echo \Zend\Json\Json::encode($result);
		return $this->response;
	}
}
?>