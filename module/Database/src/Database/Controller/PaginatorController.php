<?php 
namespace Database\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class PaginatorController extends AbstractActionController
{
	protected $configPaginator = array(
		"ItemCountPerPage" => 2,
		"PageRange"        => 3
	);
	//paginator
		//totalItem
		//pageRange
		//currentPage
	public function index01Action(){
		$arrData = array(
			array("id" => 1,"name" => "Zend 2"),
			array("id" => 2,"name" => "Jquery"),
			array("id" => 3,"name" => "Bootstrap"),
			array("id" => 4,"name" => "PHP"),
			array("id" => 5,"name" => "CodeIgniter"),
			array("id" => 6,"name" => "HTML"),
			array("id" => 7,"name" => "CSS")
		);

		$adapter = new \Zend\Paginator\Adapter\ArrayAdapter($arrData);
		$paginator = new \Zend\Paginator\Paginator($adapter);

		$currentPage = $this->params()->fromRoute("page");
		$paginator->setItemCountPerPage(3)
		          ->setCurrentPageNumber($currentPage)
		          ->setPageRange(3);


		return array(
			"paginator" => $paginator
		);
	}


	//paginator
		//adapter
			//iterator	
	public function index02Action(){
		$userTable = $this->getServiceLocator()->get("userTable");
		$result = $userTable->listItem();

		$adapter = new \Zend\Paginator\Adapter\Iterator($result);
		$paginator = new \Zend\Paginator\Paginator($adapter);

		$currentPage = $this->params()->fromRoute("page");
		$paginator->setItemCountPerPage(3)
		          ->setCurrentPageNumber($currentPage)
		          ->setPageRange(3);


		return array(
			"paginator" => $paginator
		);
	}

	//paginator
		//adapter
			//dbSelect	
	public function index03Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$selectObj = new \Zend\Db\Sql\Select("user");
		$selectObj->columns(array("id","name"))
		          ->order(array("id DESC"));


		$adapterPaginator = new \Zend\Paginator\Adapter\DbSelect($selectObj,$adapter);
		$paginator = new \Zend\Paginator\Paginator($adapterPaginator);

		$currentPage = $this->params()->fromRoute("page");
		$paginator->setItemCountPerPage(3)
		          ->setCurrentPageNumber($currentPage)
		          ->setPageRange(3);


		return array(
			"paginator" => $paginator
		);
	}

	//paginator
		//adapter
			//Null	
	public function index04Action(){
		$this->configPaginator['currentPage'] = $this->params()->fromRoute("page",1);
		$userTable = $this->getServiceLocator()->get("userTable");
		$totalItem = $userTable->countItem();
		$items     = $userTable->listItem($this->configPaginator,array("task"=>"list-item-for-paginator"));


		$adapterPaginator = new \Zend\Paginator\Adapter\NullFill($totalItem);
		$paginator        = new \Zend\Paginator\Paginator($adapterPaginator);
		$paginator->setItemCountPerPage($this->configPaginator['ItemCountPerPage'])
		          ->setCurrentPageNumber($this->configPaginator['currentPage'])
		          ->setPageRange($this->configPaginator['PageRange']);


		return array(
			"paginator" => $paginator,
			"items"     => $items
		);
	}

	//paginator
	// create Class paginator
	public function index05Action(){
		$this->configPaginator['currentPage'] = $this->params()->fromRoute("page",1);
		$userTable = $this->getServiceLocator()->get("userTable");
		$totalItem = $userTable->countItem();
		$items     = $userTable->listItem($this->configPaginator,array("task"=>"list-item-for-paginator"));

		$paginator = new \ZendVN\Paginator\Paginator();

		return array(
			"paginator" => $paginator->createPagination($totalItem,$this->configPaginator),
			"items"     => $items
		);
	}
}
?>