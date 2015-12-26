<?php


namespace Database\Controller;

use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Sql ;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SqlController extends AbstractActionController
{
	//introduce
	public function index01Action(){
		$sqlObj    = new \Zend\db\Sql\Sql(); //Sql = insert + delete + update + select

		$insertObj = new \Zend\db\Sql\Insert();
		$deleteObj = new \Zend\db\Sql\Delete();
		$updateObj = new \Zend\db\Sql\Update();
		$selectObj = new \Zend\db\Sql\Select();
    	return false;
    }

    //introduce
    public function index02Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObj = new \Zend\db\Sql\Sql($adapter);
    	$selectObj = $sqlObj->select("products");
    	$stringSql = $sqlObj->getSqlStringForSqlObject($selectObj);
    	echo $stringSql;
    	return false;
    }

    //FROM-->lấy kết quả trả về
    public function index03Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObj = new \Zend\db\Sql\Sql($adapter);
    	$selectObj = $sqlObj->select();
    	$selectObj->from("products");

    	//return Statement
    	$statement = $sqlObj->prepareStatementForSqlObject($selectObj);
    	$result = $statement->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";

    	}

    	$stringSql = $sqlObj->getSqlStringForSqlObject($selectObj);
    	echo $stringSql;
    	return false;
    }

    //FROM dặt tên mới cho bảng
    public function index04Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObj = new \Zend\db\Sql\Sql($adapter);
    	$selectObj = $sqlObj->select();
    	$selectObj->from(array("p"=>"products"));

    	$stringSql = $sqlObj->getSqlStringForSqlObject($selectObj);
    	echo $stringSql;
    	return false;
    }

    //FROM Xác định các cột cần hiển thị
    public function index05Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObj = new \Zend\db\Sql\Sql($adapter);
    	$selectObj = $sqlObj->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array("id","name","picture"));	

    	$stringSql = $sqlObj->getSqlStringForSqlObject($selectObj);
    	echo $stringSql;
    	return false;
    }

     //FROM Đặt tên mới cho các cột
    public function index06Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObj = new \Zend\db\Sql\Sql($adapter);
    	$selectObj = $sqlObj->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array("i"=>"id","n"=>"name","pi"=>"picture"));	

    	$stringSql = $sqlObj->getSqlStringForSqlObject($selectObj);
    	echo $stringSql;
    	return false;
    }

    //EXPRESSION ->đếm tổng số phần tử
    public function index07Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObj = new \Zend\db\Sql\Sql($adapter);
    	$selectObj = $sqlObj->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"total" => new \Zend\Db\Sql\Expression("COUNT(*)"),
    			  	));	

    	$stringSql = $sqlObj->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

    //EXPRESSION 
    //[ky tu hoa]-[ky tu thuong]-[id-name]
    public function index08Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObj = new \Zend\db\Sql\Sql($adapter);
    	$selectObj = $sqlObj->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"name_lower" => new \Zend\Db\Sql\Expression("LOWER(name)"),
    			  		"name_upper" => new \Zend\Db\Sql\Expression("UPPER(name)"),
    			  		"id-name" => new \Zend\Db\Sql\Expression("CONCAT(id,'-',name)"),
    			  	));	

    	$stringSql = $sqlObj->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }


    //Sử dụng thông qua Zend\Db\Sql\Select
    public function index09Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");

    	$selectObj = new \Zend\Db\Sql\Select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"name_lower" => new \Zend\Db\Sql\Expression("LOWER(name)"),
    			  		"name_upper" => new \Zend\Db\Sql\Expression("UPPER(name)"),
    			  		"id-name" => new \Zend\Db\Sql\Expression("CONCAT(id,'-',name)"),
    			  	));	

    	$stringSql = $selectObj->getSqlString($adapter->getPlatForm());
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

    //Sử dụng ORDER
    public function index10Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");

    	$selectObj = new \Zend\Db\Sql\Select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"id","name","cat_id"
    			  	))
    			  // ->order("cat_id ASC , id ASC");
    			  // ->order("id ASC")
    			  ->order(array("cat_id ASC","id ASC"));

    	$stringSql = $selectObj->getSqlString($adapter->getPlatForm());
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

    //Sử dụng LIMIT và OFFSET
    public function index11Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new \Zend\Db\Sql\Sql($adapter);
    	$selectObj = $sqlObject->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"id","name","cat_id"
    			  	))
    			  ->limit(3)
    			  ->offset(2);

    	$stringSql = $sqlObject->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

    //Sử dụng WHERE (WHERE AND ; WHERE OR) 
    public function index12Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new \Zend\Db\Sql\Sql($adapter);
    	$selectObj = $sqlObject->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"id","name","cat_id"
    			  	))
    			  //->where("id > 2 AND cat_id = 19	")//AND - mặc định
    			  ->where("id =2")
    			  ->where("cat_id > 19", \Zend\Db\Sql\Predicate\Predicate::OP_OR)
    			  ->limit(6);

    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

     //Sử dụng JOIN
    public function index13Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new \Zend\Db\Sql\Sql($adapter);
    	$selectObj = $sqlObject->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"id","name","cat_id"
    			  	))
    			  ->join(array("u"=>"user"),
    			  		 "p.created_by = u.id",
    			  		 array("name","u_id"=>"id"),
    			  		 $selectObj::JOIN_LEFT
    			  	);

    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }


     //Sử dụng GOUP BY , HAVING
    public function index14Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new \Zend\Db\Sql\Sql($adapter);
    	$selectObj = $sqlObject->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"total" => new \Zend\Db\Sql\Expression("COUNT(p.id)"),
    			  		"name"
    			  	))
    			  ->join(array("u"=>"user"),
    			  		 "p.created_by = u.id",
    			  		 array("name","u_id"=>"id"),
    			  		 $selectObj::JOIN_LEFT
    			  	)
    			   ->group("u.name")
    			   ->having("u.id >1")
    			  ;

    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

     //loại bỏ thành phần trong sql
    public function index15Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new \Zend\Db\Sql\Sql($adapter);
    	$selectObj = $sqlObject->select();
    	$selectObj->from(array("p"=>"products"))
    			  ->columns(array(
    			  		"total" => new \Zend\Db\Sql\Expression("COUNT(p.id)"),
    			  		"name"
    			  	))
    			  ->join(array("u"=>"user"),
    			  		 "p.created_by = u.id",
    			  		 array("name","u_id"=>"id"),
    			  		 $selectObj::JOIN_LEFT
    			  	)
    			   ->group("u.name")
    			   ->having("u.id >1")
    			  ;
    	$selectObj->reset("having");
    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }


     //WHERE: Predicate()
    public function index16Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new \Zend\Db\Sql\Sql($adapter);
    	$selectObj = $sqlObject->select();
    	$selectObj->from("products")
    			  ->columns(array("id","name"))	
    			  // ->where(new Predicate\Between("id","5","10"))	  
    			  
    			  // ->where(new Predicate\Expression("id > 2"))	  
    			  // /->where(new Predicate\Expression("id > ?",array("2")))	  

    			  //->where(new Predicate\In("id",array(2,7,11)))	 

    			  // ->where(new Predicate\IsNotNull("name"))
    			  // ->where(new Predicate\IsNull("name")) 

    			  // ->where(new Predicate\Like("name","%PHP%"))

    			  // ->where(new Predicate\Literal("id = 2"))

    			  // ->where(new Predicate\NotIn("id",array(1,2,3,4)))
    			  
    			  ->where(new Predicate\NotLike("name","%PHP%"))
    			  ;
    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

     //WHERE: where("id >2" AND id IN [2,3,4]) OR (id between  10 AND 11)
    public function index17Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new Sql($adapter);
    	$selectObj = $sqlObject->select();
    	$where = new \Zend\db\sql\Where();
    	$where->nest()//tao ra dấu (
    		  ->expression("id > ?",array(6))
    		  ->or
    		  ->in("id",array(3,4,5))
    		  ->unnest()//tạo ra dấu )
    		  ->and 
    		  ->between("id","9",12);
    		  
    	$selectObj->from("products")
    			  ->columns(array("id","name"))
    			  ->where($where)	
    			  ;
    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($selectObj);
    	$result = $adapter->query($stringSql)->execute();
    	foreach($result as $row){
    		echo "<pre style='font-weight:bold'>";
    		print_r($row);
    		echo "</pre>";
    	}
    	return false;
    }

    //INSERT
    public function index18Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new Sql($adapter);
    	$insertObj = $sqlObject->insert("user");
    	$insertObj->values(array(
    		"name" => "henrik",
    		"email" => "henrik@hotmail.com"
    	));

    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($insertObj);
    	$adapter->query($stringSql)->execute();
   
    	return false;
    }

    //UPDATE
    public function index19Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new Sql($adapter);
    	$updateObj = $sqlObject->update("user");
    	$updateObj->set(array(
    		"email" => "henrik@gmail.com"
    	))->where("name = 'henrik'");

    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($updateObj);
    	$adapter->query($stringSql)->execute();
   
    	return false;
    }

     //DELETE
    public function index20Action(){
    	$adapter = $this->getServiceLocator()->get("dbConfig");
    	$sqlObject = new Sql($adapter);
    	$deleteObj = $sqlObject->delete("user");
    	$deleteObj->where(new Predicate\In("name",array("henrik")));
    	echo $stringSql = $sqlObject->getSqlStringForSqlObject($deleteObj	);
    	$adapter->query($stringSql)->execute();
   
    	return false;
    }
}
