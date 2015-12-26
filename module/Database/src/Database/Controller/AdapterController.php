<?php 
namespace Database\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AdapterController extends AbstractActionController
{
	//Adapter
	public function index01Action(){
		$adapter = new \Zend\Db\Adapter\Adapter(array(
			"driver"   => "Pdo_Mysql",
			"database" => "books",
			"username" => "root",
			"password" => "",
			"hostname" => "localhost",
			"charset"  => "utf8"
		));
		$sql = "SELECT * FROM `products`";
		$statement = $adapter->query($sql);
		$result = $statement->execute();
		
		foreach ($result as $row) {
			echo "<pre style='font-weight:bold;color:red'>";
			print_r($row);
			echo "</pre>";
		}
		return $this->response;
	}

	//SQL Simple
	public function index02Action(){
		$adapter = new \Zend\Db\Adapter\Adapter(array(
			"driver"   => "Pdo_Mysql",
			"database" => "books",
			"username" => "root",
			"password" => "",
			"hostname" => "localhost",
			"charset"  => "utf8"
		));
		$sql = "SELECT * FROM `products` WHERE `id` = '2'";
		$statement = $adapter->query($sql); //Zend\Db\Adapter\Driver\Pdo\Statement Object
		// echo "<pre style='font-weight:bold'>";
		// print_r($statement);
		// echo "</pre>";
		$result = $statement->execute();
		
		foreach ($result as $row) {
			echo "<pre style='font-weight:bold;color:red'>";
			print_r($row);
			echo "</pre>";
		}
		return $this->response;
	}

	
	//SQL Simple
	public function index03Action(){
		$adapter = new \Zend\Db\Adapter\Adapter(array(
			"driver"   => "Pdo_Mysql",
			"database" => "books",
			"username" => "root",
			"password" => "",
			"hostname" => "localhost",
			"charset"  => "utf8"
		));
		//Zend\Db\ResultSet\ResultSet Object
		$result = $adapter->query("SELECT * FROM `products` WHERE `id` = ?",array(2)); 
		
		foreach ($result as $row) {
			echo "<pre style='font-weight:bold;color:red'>";
			print_r($row);
			echo "</pre>";
		}
		return $this->response;
	}

	//SQL Simple
	public function index04Action(){
		$adapter = new \Zend\Db\Adapter\Adapter(array(
			"driver"   => "Pdo_Mysql",
			"database" => "books",
			"username" => "root",
			"password" => "",
			"hostname" => "localhost",
			"charset"  => "utf8"
		));
		$sql = "SELECT * FROM `products` WHERE `id` = :id";
		$statement = $adapter->query($sql); //Zend\Db\Adapter\Driver\Pdo\Statement Object
		$result = $statement->execute(array("id"=> "3"));
		echo "<pre style='font-weight:bold'>";
		 print_r($result->current());
		 echo "</pre>"; 
		// foreach ($result as $row) {
		// 	echo "<pre style='font-weight:bold;color:red'>";
		// 	print_r($row);
		// 	echo "</pre>";
		// }
		return $this->response;
	}

	//SQl Advance
	public function index05Action(){
		$adapter = $this->getServiceLocator()->get("dbConfig");	

		// echo $adapter->platform->quoteIdentifier('products');
		/* closure*/	
		$qi = function($name) use($adapter){
			return $adapter->platform->quoteIdentifier($name);
		};


		// echo $adapter->driver->formatParameterName("id");
		/* closure*/
		$fp = function($name) use($adapter){
			return $adapter->driver->formatParameterName($name);
		};

		$sql = sprintf("SELECT * FROM %s WHERE %s < %s",$qi("products"),$qi("id"),$fp("id"));

		$statement = $adapter->query($sql); //Zend\Db\Adapter\Driver\Pdo\Statement Object
		$result = $statement->execute(array("id"=> "10"));
	
		foreach ($result as $row) {
			echo "<pre style='font-weight:bold;color:red'>";
			print_r($row);
			echo "</pre>";
		}
		return $this->response;
	}
}
?>