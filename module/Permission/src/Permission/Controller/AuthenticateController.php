<?php 
namespace Permission\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AuthenticateController extends AbstractActionController
{
	public function index01Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$dbTableAdapter = new \Zend\Authentication\Adapter\DbTable($adapter);
		$dbTableAdapter->setTableName("user");
		$dbTableAdapter->setIdentityColumn("email");
		$dbTableAdapter->setCredentialColumn("fullname");

		//nhận kết quả trả về từ FORM -để kiểm tra với email va fullname
		$dbTableAdapter->setIdentity("iron@gmail.com");
		$dbTableAdapter->setCredential("Stark");
		// case 1
		// $authenticateObj = new \Zend\Authentication\AuthenticationService(null,$dbTableAdapter);

		// case 2
		$authenticateObj = new \Zend\Authentication\AuthenticationService();
		$authenticateObj->setAdapter($dbTableAdapter);

			//authen
		$result = $authenticateObj->authenticate();
		// $result->getCode(); //lấy mã chứng thực
		// $result->getMessages(); //lấy message nếu có lỗi 
		// $result->isValid();
		
		if(!$result->isValid()){
			echo "<pre style='font-weight:bold'>";
			print_r($result->getMessages());
			echo "</pre>";
		}else{
			echo "good";
		}

		return false;
	}

	//Cách viết khác
	public function index02Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$dbTableAdapter = new \Zend\Authentication\Adapter\DbTable($adapter,"user","email","fullname");

		//nhận kết quả trả về từ FORM -để kiểm tra với email va fullname
		$dbTableAdapter->setIdentity("iron@gmail.com");
		$dbTableAdapter->setCredential("Stark");

		$authenticateObj = new \Zend\Authentication\AuthenticationService();
		$authenticateObj->setAdapter($dbTableAdapter);

			//authen
		$result = $authenticateObj->authenticate();
		
		if(!$result->isValid()){
			echo "<pre style='font-weight:bold'>";
			print_r($result->getMessages());
			echo "</pre>";
		}else{
			echo "good";
		}

		return false;
	}

	//Cách viết khác
	public function index03Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$dbTableAdapter = new \Zend\Authentication\Adapter\DbTable($adapter,"user","email","fullname");


		$authenticateObj = new \Zend\Authentication\AuthenticationService(null,$dbTableAdapter);
		$authenticateObj->getAdapter()->setIdentity("iron@gmail.com");
		$authenticateObj->getAdapter()->setCredential("Stark");
			//authen
		$result = $authenticateObj->authenticate();
		
		if(!$result->isValid()){
			echo "<pre style='font-weight:bold'>";
			print_r($result->getMessages());
			echo "</pre>";
		}else{
			echo "good";
		}

		return false;
	}

	//Thêm điều kiện kt status cho chứng thực
	public function index04Action(){
		$adapter = $this->getServiceLocator()->get("db_books");
		$dbTableAdapter = new \Zend\Authentication\Adapter\DbTable($adapter,"user","email","fullname");
	//	$select = $dbTableAdapter->getDbSelect();
		

		$authenticateObj = new \Zend\Authentication\AuthenticationService(null,$dbTableAdapter);
		$authenticateObj->getAdapter()->setIdentity("iron@gmail.com");
		$authenticateObj->getAdapter()->setCredential("Stark");
		$select = $authenticateObj->getAdapter()->getDbSelect();
		$select->where->equalTo("status","0");
			//authen
		$result = $authenticateObj->authenticate();
		
		if(!$result->isValid()){
			echo "<pre style='font-weight:bold'>";
			print_r($result->getMessages());
			echo "</pre>";
		}else{
			echo "good";
			//thêm nhiều column 
			//$data = $authenticateObj->getAdapter()->getResultRowObject();
			$data = $dbTableAdapter->getResultRowObject();//agr 1:chọn column muốn lấy  ,agr 2 :chọn column không muốn lấy
			//ghi thông tin vào session
			$authenticateObj->getStorage()->write($data);
			echo "<pre style='font-weight:bold'>";
			print_r($data);
			echo "</pre>";
		}

		return false;
	}

	//kiểm tra tài khoản đã được chứng thực chua        hasIdentity()
	//lấy thông tin(email) của user đã d chứng thực     getIdentity()
	public function index05Action(){
		$authenticateObj = new \Zend\Authentication\AuthenticationService();
		
		if($authenticateObj->hasIdentity()){
			echo "<pre style='font-weight:bold'>";
			print_r($authenticateObj->getIdentity());
			echo "</pre>";
		}

		return false;
	}

	//Xóa chứng thực tài khoản
	public function index06Action(){
		$authenticateObj = new \Zend\Authentication\AuthenticationService();
		
		$authenticateObj->clearIdentity();

		return false;
	}

	//tìm hiểu controller plugin identity()
	public function index07Action(){

		if(!$this->identity()){
			echo "<h3 style='color:red;font-weight:bold'>Đăng nhập thất bại</h3>";
		}else{
			echo "<h3 style='color:red;font-weight:bold'>Đăng nhập thành công</h3>";
			echo "<pre style='font-weight:bold'>";
			print_r($this->identity());
			echo "</pre>";
		}

		return false;
	}

	//tìm hiểu view helper identity()
	public function index08Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";	
	}


	// đăng ký Authenticate qua service Manager
	public function index09Action(){
		$myAuth = $this->getServiceLocator()->get("myAuthenticate");

		$myAuth->getAdapter()->setIdentity("iron@gmail.com")
		       				 ->setCredential("Stark");

		$result = $myAuth->authenticate();
		if(!$result->isValid()){
			echo "<pre style='font-weight:bold'>";
			print_r($result->getMessages());
			echo "</pre>";
		}else{

			$data = $myAuth->getAdapter()->getResultRowObject();
		
			$myAuth->getStorage()->write($data);
			echo "<pre style='font-weight:bold'>";
			print_r($data);
			echo "</pre>";
		}
		return false;
	}

	public function loginAction(){
		//đăng nhập rồi còn quay lại đây làm gì
		if($this->identity()) $this->redirect()->toRoute("permissionRoute/default",array(
			"controller" => "authenticate",
			"action"     => "home"
		));
		$form = $this->serviceLocator->get("FormElementManager")->get("loginForm");

		if($this->request->isPost()){
			$data = $this->request->getPost();
			;
			$form->setData($data);
			if($form->isValid()){
				$authen = $this->getServiceLocator()->get("myAuthenticate");
				$authen->getAdapter()->setIdentity($data["my-email"]);
				$authen->getAdapter()->setCredential(md5($data["my-password"]));

				$result = $authen->authenticate();
				if(!$result->isValid()){
					echo "<h3 style='color:red;font-weight:bold'>Đăng nhập không thành công</h3>";
					echo current($result->getMessages());
				}else{
					//lưu thông tin User vào Session
					$userInfo = $authen->getAdapter()->getResultRowObject(array("id","email","name"));
					$authen->getStorage()->write($userInfo);
					$this->redirect()->toRoute("permissionRoute/default",array(
						"action"     => "home",
						"controller" => "authenticate"
					));
				}
			}
		}
		return array(
			"formLogin" => $form
		);
	}

	public function homeAction(){
		if(!$this->identity()) $this->redirect()->toRoute("permissionRoute/default",array(
			"controller" => "authenticate",
			"action"     => "login"
		));
	}

	public function logoutAction(){
		$authen = $this->getServiceLocator()->get("myAuthenticate");
		$authen->clearIdentity();
		$this->redirect()->toRoute("permissionRoute/default",array(
			"controller" => "authenticate",
			"action"     => "login"
		));
	}
}
?>