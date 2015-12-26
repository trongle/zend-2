<?php 
namespace Form\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ArrayObject;
use Zend\View\Model\ViewModel;

class FormElementController extends AbstractActionController{
	public function index01Action(){
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			$file = $this->params()->fromFiles();
			echo "<pre style='font-weight:bold'>";
			print_r($data);
			echo "</pre>";
			echo "<pre style='font-weight:bold'>";
			print_r($file);
			echo "</pre>";
		}


		return new ViewModel(array(
			"form" => new \Form\Form\StudyOne(),
		));

	}


	public function index02Action(){
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			$file = $this->params()->fromFiles();
			echo "<pre style='font-weight:bold'>";
			print_r($data);
			echo "</pre>";
			echo "<pre style='font-weight:bold'>";
			print_r($file);
			echo "</pre>";
		}


		return new ViewModel(array(
			"form" => new \Form\Form\StudyTwo(),
		));

	}

	public function index03Action(){
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			$file = $this->params()->fromFiles();
			echo "<pre style='font-weight:bold'>";
			print_r($data);
			echo "</pre>";
		}

		return new ViewModel(array(
			"form" => new \Form\Form\StudyThree(),
		));

	}

	public function index04Action(){
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			$file = $this->params()->fromFiles();
			echo "<pre style='font-weight:bold'>";
			print_r($data);
			echo "</pre>";
			echo "<pre style='font-weight:bold'>";
			print_r($file);
			echo "</pre>";
		}


		return new ViewModel(array(
			"form" => new \Form\Form\StudyOne(),
		));

	}

	public function index05Action(){
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			$file = $this->params()->fromFiles();
		}

		return new ViewModel(array(
			"form" => new \Form\Form\StudyOne(),
		));

	}

	public function index06Action(){
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			$file = $this->params()->fromFiles();
		}

		return new ViewModel(array(
			"form" => new \Form\Form\StudyOne(),
		));

	}

	public function exerciseOneAction(){
		return new ViewModel(array(
			"myFormLogin" => new \Form\Form\Login(),
		));

	}

	public function exerciseTwoAction(){
		$myForm = new \Form\Form\Register();
		$object = new ArrayObject(array(
			"card-holder-name" => "Trọng Boss",
			"card-number" => "024729523",
			"expiry-month" => "11",
			"expiry-year" => "15",
		));
		$myForm->bind($object);
		return new ViewModel(array(
			"myFormRegister" => $myForm,
		));

	}

}
?>