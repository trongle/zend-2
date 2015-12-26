<?php 
namespace Database\Controller;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;

class TableGatewayController extends AbstractActionController
{	
	//SELECT -resultSet
	public function index01Action(){
		

		$resultSetPrototype = new ResultSet();// dành cho tham số thu 4 của tableGateway
		$resultSetPrototype->setArrayObjectPrototype(new \Database\Model\Entity\User());// dành cho tham số thu 4 của tableGateway
		
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		
		$tableGateway = new TableGateway($table,$adapter,null,$resultSetPrototype);

		// $where = new Where();
		// $where->notEqualTo("id","1");
		
		$resultSet = $tableGateway->select();
		foreach($resultSet as $row){
			echo "<pre style='font-weight:bold'>";
			print_r($row);
			echo "</pre>";
		}
	
		return false;
	}

	//SELECT -clorsure
	public function index02Action(){
		

		$resultSetPrototype = new ResultSet();// dành cho tham số thu 4 của tableGateway
		$resultSetPrototype->setArrayObjectPrototype(new \Database\Model\Entity\User());// dành cho tham số thu 4 của tableGateway
		
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		
		$tableGateway = new TableGateway($table,$adapter,null,$resultSetPrototype);

		// $where = new Where();
		// $where->notEqualTo("id","1");
		
		//SELECT * FROM user WHERE (name NOT NULL) AND (id #1)
		//ORDER BY email
		$resultSet = $tableGateway->select(function (Select $select){//closure
			$select->where->isNotNull("id")
			              ->notEqualTo("id","1");
			$select->order("email DESC");
		});
		foreach($resultSet as $row){
			echo "<pre style='font-weight:bold'>";
			print_r($row);
			echo "</pre>";
		}
	
		return false;
	}

	//SELECT WITH
	public function index03Action(){
		

		$resultSetPrototype = new ResultSet();// dành cho tham số thu 4 của tableGateway
		$resultSetPrototype->setArrayObjectPrototype(new \Database\Model\Entity\User());// dành cho tham số thu 4 của tableGateway
		
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		
		$tableGateway = new TableGateway($table,$adapter,null,$resultSetPrototype);

		$sql = new Sql($adapter);
		$select = $sql->select();
		$select->from("user")
		       ->where("id <> 2");

		$selectWith = $tableGateway->selectWith($select);
		foreach ($selectWith as $row) {
			echo "<pre style='font-weight:bold'>";
			print_r($row);
			echo "</pre>";
		}
	
		return false;
	}


	//INSERT
	public function index04Action(){
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		$tableGateway = new TableGateway($table,$adapter);



		$tableGateway->insert(array(
			"name" => "henrik",
			"email" => "hr@hotmail.com"
		));

		//last record inserted
		echo $tableGateway->getLastInsertValue();

		return false;
	}

	//INSERT WITH
	public function index05Action(){
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		$tableGateway = new TableGateway($table,$adapter);

		$insertObj = new Insert("user");
		$insertObj->columns(array("name","email"))
		          ->values(array(
						"name"  =>"Armasky",
						"email" =>"ak@hotmail.com"
		          	));
		$tableGateway->insertWith($insertObj);

		//last record inserted
		echo $tableGateway->getLastInsertValue();

		return false;
	}

	//UPDATE
	public function index06Action(){
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		$tableGateway = new TableGateway($table,$adapter);

		$tableGateway->update(array(
			"name" => "armansky"
		),array(
			"name" => "Armasky"
		));

		return false;
	}

	//UPDATE WITH
	public function index07Action(){
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		$tableGateway = new TableGateway($table,$adapter);

		$updateObj = new Update("user");
		$updateObj->set(array(
			"name" => "mentos"
		))->where->greaterThan("id","5");

		$tableGateway->updateWith($updateObj);

		return false;
	}

	//DELETE
	public function index08Action(){
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		$tableGateway = new TableGateway($table,$adapter);

		echo $tableGateway->delete(array("id"=> "5"));

		return false;
	}

	//DELETE WITH
	public function index09Action(){
		$table = "user";
		$adapter = $this->getServiceLocator()->get("db_books");
		$tableGateway = new TableGateway($table,$adapter);

		$deleteObj = new Delete("user");
		$deleteObj->where->equalTo("id","6");

		echo $tableGateway->deleteWith($deleteObj);

		return false;
	}


	//class TableGateway 
	//Xây dựng MenuTable.php thao tác với bảng dữ liệu menu
	public function index10Action(){
		$adapter = $this->getServiceLocator()->get("db_books");

		$resultSetPrototype = new ResultSet();// dành cho tham số thu 4 của tableGateway
		$resultSetPrototype->setArrayObjectPrototype(new \Database\Model\Entity\User());// dành
		$tableGateway = new TableGateway("user",$adapter,null,$resultSetPrototype);

		$userTable = new \Database\Model\UserTable($tableGateway);
		$result = $userTable->listItem();
		foreach($result as $row){
			echo "<pre style='font-weight:bold'>";
			print_r($row);
			echo "</pre>";
		}

		return false;
	}

	//class TableGateway 
	//Đăng ký qua service
	public function index11Action(){

		/*----------------------chuyển qua getserviceConfig()[module.php]
		$adapter = $this->getServiceLocator()->get("db_books");

		$resultSetPrototype = new ResultSet();// dành cho tham số thu 4 của tableGateway
		$resultSetPrototype->setArrayObjectPrototype(new \Database\Model\Entity\User());
		$tableGateway = new TableGateway("user",$adapter,null,$resultSetPrototype);

		$userTable = new \Database\Model\UserTable($tableGateway);
		---------------------------*/

		$userTable = $this->getServiceLocator()->get("UserTable");
		$result = $userTable->listItem();
		foreach($result as $row){
			echo "<pre style='font-weight:bold'>";
			print_r($row);
			echo "</pre>";
		}

		return false;
	}

	//class TableGateway 
	//listItem
	public function index12Action(){
		$userTable = $this->getServiceLocator()->get("UserTable");
		
		//$result = $userTable->listItem(array("id"=>"1"),array("task"=>"list-item"));//list-item
		// $result = $userTable->getItem(array("id"=>"1"),array("task"=>"get-item"));//getItem
		//$result = $userTable->deleteItem(array("id"=>"11"),array("task"=>"delete-item"));//delete-item
		
		//saveItem
		$arrParam = array(
			"id" => "101",
			"name"=> "credit123",
			"email" => "credit123@hotmail.com"
		);

		$userTable->saveItem($arrParam,array("task"=>"save-item"));




		// echo "<pre style='font-weight:bold'>";
		// print_r($result);
		// echo "</pre>";
		
		// foreach($result as $row){
		// 	echo "<pre style='font-weight:bold'>";
		// 	print_r($row);
		// 	echo "</pre>";
		// }

		return false;
	}
}
?>