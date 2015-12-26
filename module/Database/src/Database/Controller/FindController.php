<?php 
namespace Database\Controller;

use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\Db\RecordExists;
use Zend\View\Model\ViewModel;

class FindController extends AbstractActionController
{
	protected $_table;
	//recordExists
	public function index01Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$validate = new RecordExists(array(
			"table" => "user",
			"field" => "email",
			"adapter" => $adapter
		));

		$email = "trongle@gmail.com";
		if(!$validate->isValid($email)){
			echo "<pre style='font-weight:bold'>";
			print_r($validate->getMessages());
			echo "</pre>";
		}
		return false;
	}

	//recordExists
	public function index02Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$validate = new NoRecordExists(array(
			"table" => "user",
			"field" => "email",
			"adapter" => $adapter
		));

		$email = "mentos@gmail.com";
		if(!$validate->isValid($email)){
			echo "<pre style='font-weight:bold'>";
			print_r($validate->getMessages());
			echo "</pre>";
		}
		return false;
	}

	//exclude --loại trừ
	public function index03Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$validate = new RecordExists(array(
			"table" => "user",
			"field" => "email",
			"adapter" => $adapter,
			"exclude" =>array(
				"field" => "id",
				"value" => "1"
			)
		));

		$email = "mentos@gmail.com";
		if(!$validate->isValid($email)){
			echo "<pre style='font-weight:bold'>";
			print_r($validate->getMessages());
			echo "</pre>";
		}
		return false;
	}
	public function getTable(){
		if(empty($this->_table)){
			$this->_table = $this->getServiceLocator()->get("UserTable");
		}
		return $this->_table;
	}

	//FindUser
	public function findUSerAction(){
		$form = $this->serviceLocator->get("FormElementManager")->get("FindForm");
		if($this->request->isPost()){
			$data = $this->params()->fromPost();
			$form->setData($data);

			if($form->isValid()){
				$userTable = $this->getServiceLocator()->get("UserTable");
				$result = $userTable->listItem($data,array("task"=>"get-user-by-email"));
			}
		}
		return new ViewModel(array("myForm"=>$form,"items" => $result));	
	}
}
?>