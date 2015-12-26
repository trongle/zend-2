<?php 
namespace Database\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController
{
	protected $_userTable;
	protected $_configPaginator = array(
		"ItemCountPerPage"  => 3,
		"PageRange"    => 3
	);
	public function getTable(){
		if(!$this->_userTable){
			$this->_userTable = $this->getServiceLocator()->get("userTable");
		}
		return $this->_userTable;
	}
	public function indexAction(){
		$this->_configPaginator['currentPage'] = $this->params()->fromRoute('page',1);
		$userTable = $this->getTable();
		$totalItem = $userTable->countItem();
		$items     = $userTable->listItem($this->_configPaginator,array("task"=>"list-item-for-paginator")); 

		return array(
			"paginator" => \ZendVN\Paginator\Paginator::createPagination($totalItem,$this->_configPaginator),
			"items"     => $items
		);
	}

	public function infoAction(){
		$this->headTitle("Info user");
		$id = $this->params()->fromRoute('id',0);
		if($id == 0) return $this->redirect()->toRoute("manageUser");//làm gi có id nao bang 0
		
		$item = $this->getTable()->getItem(array("id"=>$id));
	    return array(
	    	"item" => $item
	    );
	}

	public function addAction(){
		$this->headTitle("Add user");
		$myForm = $this->getServiceLocator()->get("FormElementManager")->get("SaveForm");
		if($this->request->isPost()){
			$data = $this->request->getPost();
			$myForm->setData($data);
			$data = "";
			if($myForm->isValid()){
				$data['name'] = $myForm->getData()['name'];
				$data['email'] = $myForm->getData()['email'];
				$data['fullname'] = $myForm->getData()['fullname'];
				$data['created'] = date("Y-m-d");
				$this->getTable()->saveItem($data); 
				$this->flashMessenger()->addMessage("Dữ liệu đã được thêm thành công !");
				return $this->redirect()->toRoute("manageUser");		
			}
		}
		return array("form" => $myForm);
	}

	public function deleteAction(){
		$id = $this->params()->fromRoute("id",0);
		if($id == 0) return $this->redirect()->toRoute("manageUser");

		$this->getTable()->deleteItem(array("id"=>$id),array("task"=>"delete-item"));
		$this->flashMessenger()->addMessage("Dữ liệu đã được xóa thành công !");	
		return $this->redirect()->toRoute("manageUser");
	}

	public function editAction(){
		$this->headTitle("Edit user");
		$id = $this->params()->fromRoute("id",0);
		if($id == 0) return $this->redirect()->toRoute("manageUser");

		$item = $this->getTable()->getItem(array("id"=>$id));
		$myForm = $this->getServiceLocator()->get("FormElementManager")->get("SaveForm");
		//sua lai valiadate đối với edit
		$myForm->setInputFilter(new \Database\Form\SaveUserFilter($id) );
		$myForm->bind($item);
		
		if($this->request->isPost()){
			$data = $this->request->getPost();
			$myForm->setData($data);
			$data = "";
			if($myForm->isValid()){
				$data['name'] = $myForm->getData()->name;
				$data['email'] = $myForm->getData()->email;
				$data['fullname'] = $myForm->getData()->fullname;
				$data['id'] = $id;

				$this->getTable()->saveItem($data); 
				$this->flashMessenger()->addMessage("Dữ liệu đã được cập nhật thành công !");
				return $this->redirect()->toRoute("manageUser");		
			}
		}
		return array("form" => $myForm);
	}
}
?>