<?php 
namespace Form\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ValidatorController extends AbstractActionController{

	//between
	// @requirement :Int
	// @kiểm tra số nằm trong khoảng nào đó
	// @inculsive cho dk <= |>=
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//case 1
		// $validator = new \Zend\Validator\Between(2,5,false);

		//case 2 
		// $validator = new \Zend\Validator\Between(array("min"=>"2","max"=>5,"inclusive"=>false));

		//case 3
		$validator = new \Zend\Validator\Between(5,6);
		$validator->setMin(1)
				  ->setMax(3)
		          ->setInclusive(true);	

		$input = "3a";
		$input = "a3a";
		$input = 4;
		if(!$validator->isValid($input)){
				$message = $validator->getMessages();
				echo "<pre style='font-weight:bold'>";
				print_r($message);
				echo "</pre>";
				echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// date()
	// @ kiểm tra định dạng ngày tháng
	// Mặc định Y-m-d
	public function index02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\Date("Y.m.d");
		$input = "1992-11-17";
		$input = "1992.01.17";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// Digits()
	// @ kiểm tra số tự nhiên

	public function index03Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\Digits();
		$input = "1"; //ok
		$input = -1; //not
		$input = 0; //ok
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// Email()
	// @ kiểm tra email hợp lệ

	public function index04Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\EmailAddress();
		$input = "trongle@gmail.com";//ok
		$input = "trongle@gmail";//not ok
		$input = "trongle@.com"; //not ok
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// File\Extendsion()
	// @ kiểm tra extension

	public function index05Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\File\Extension("php,html,wmv");
		$validator = new \Zend\Validator\File\Extension("php,html,WMV",true); // mac dinh false
		$input = PUBLIC_PATH."files/Wildlife.wmv";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// File\Exists()
	// @ kiểm tra tồn tại file

	public function index06Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\File\Exists();
		$input = PUBLIC_PATH."files/Wildlife.wmv";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}


	// File\Size()
	// @ kiểm tra kích thước file

	public function index07Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\File\Size(array("min"=>"6KB","max"=>"30MB"));
		$input = PUBLIC_PATH."files/Wildlife.wmv";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// File\WordCount()
	// @ kiểm tra số từ của file

	public function index08Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\File\WordCount(2,5);
		$input = PUBLIC_PATH."files/test.txt";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// File\Isimage()
	// @ kiểm tra co phai file hình

	public function index09Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\File\IsImage();
		$input = PUBLIC_PATH."files/Penguins.jpg";
		$input = PUBLIC_PATH."files/test.txt";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// File\ImageSize()
	// @ kiểm tra co phai file hình

	public function index10Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\File\ImageSize(array("minHeight"=>"100","minWidth"=>"2000"));
		$input = PUBLIC_PATH."files/Penguins.jpg";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// GreatThan()
	// @ lớn hơn

	public function index11Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\GreaterThan(100,true);
		$input = "100";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// LessThan()
	// @ nhỏ hơn

	public function index12Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \Zend\Validator\LessThan(100,true);
		$input = "101";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// InArray()
	// @

	public function index13Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		// $validator = new \Zend\Validator\InArray(array(
		// 	"haystack" => array("php","zend","joomla"),
		// ));

		$validator = new \Zend\Validator\InArray(array(
		"haystack" => array(
				"one" => array("php","zend","joomla"),
				"two" => array("jquery",'html')
			),
		"recursive" => true
		));
		$input = "jquery";
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// NotEmpty()
	// @ không duoc rong

	public function index14Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		$validator = new \Zend\Validator\NotEmpty();
		$input = "";
		$input = "     ";
		$input = null;
		$input = array();
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// Regex()
	// @

	public function index15Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//lap-trinh-2.php
		//laptrinh-2.html
		$patern = "#^[a-zA-Z0-9_-]+\.(php|html)$#imsU";
		$validator = new \Zend\Validator\Regex($patern);
		$input = "lap-trinh-2.phtml";
	
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// StringLenght()
	// @ chieu dai chuoi

	public function index16Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//lap-trinh-2.php
		//laptrinh-2.html
	
		// $validator = new \Zend\Validator\StringLength(10);
		$validator = new \Zend\Validator\StringLength(10,15);
		$input = "lap-trinh-2.phtml";
	
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// Reset message Error

	public function index17Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//lap-trinh-2.php
		//laptrinh-2.html
	
		$validator = new \Zend\Validator\StringLength(10,15);
		$validator->setMessages(array(
			\zend\Validator\StringLength::INVALID   => "Dữ liệu không hơp lệ",
			\zend\Validator\StringLength::TOO_SHORT => "Chiều dài của '%value%' phải lớn hơn %min%",
			\zend\Validator\StringLength::TOO_LONG  => "Chiều dài của '%value%' phải nhỏ hon %max%",
		));
		$input = "trongle";
	
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// Reset message Error

	public function index18Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//lap-trinh-2.php
		//laptrinh-2.html
	
		$validator = new \ZendVN\Validator\StringLength(10,15);
		$input = "trongle";
	
		if(!$validator->isValid($input)){
			$message = $validator->getMessages();
			echo current($message);
		}else{
			echo "ok";
		}
		return false;
	}

	// validatorChain()

	public function index19Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		
		//username
		//khong duoc rong
		//chieu dai tu 5 -8
		//bat dau bang Z ket thuc bang 1 số
		$validator = new \Zend\Validator\ValidatorChain();
		if($this->getRequest()->isPost()){
			$username = $this->params()->fromPost("username");
			$validator->attach(new \Zend\Validator\NotEmpty(),true)
					  ->attach(new \Zend\Validator\StringLength(5,8),true)
					  ->attach(new \Zend\Validator\Regex("#^z[a-zA-Z0-9_-]{3,6}[0-9]{1}$#imsU"));

			if(!$validator->isValid($username)){
				$message = $validator->getMessages();
				echo "<pre style='font-weight:bold'>";
				print_r($message);
				echo "</pre>";
			}else{
				echo "ok";
			}
		}

	}

	// Create Class Validator()
	// check ID pattern 3 chu dầu là chữ - 2 chữ cuối là số
	public function index20Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$validator = new \ZendVN\Validator\CheckCourse();
		$validator->setPattern("#^[a-zA-Z]{3}-[\d]{2}$#");
		$IDcourse = "abc-09";

		if(!$validator->isValid($IDcourse)){
			$message = $validator->getMessages();
			echo "<pre style='font-weight:bold'>";
			print_r($message);
			echo "</pre>";
		}else{
			echo "ok";
		}
		return false;
	}

	// Create Class Validator()
	// kiem tra 2 password có giống nhau 
	public function index21Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		if($this->request->isPost()){
			$password = $this->params()->fromPost("pass");
			$re_password = $this->params()->fromPost("pass2");


			$validator = new \ZendVN\Validator\ConfirmPassword($re_password);
			//$validator->setRePassword();

			if(!$validator->isValid($password)){
				$message = $validator->getMessages();
				echo "<pre style='font-weight:bold'>";
				print_r($message);
				echo "</pre>";
			}else{
				echo "ok";
			}
		}
	}
}
?>