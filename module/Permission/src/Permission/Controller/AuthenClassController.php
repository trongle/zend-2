<?php 
namespace Permission\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AuthenClassController extends AbstractActionController{
	public function loginAction(){
		$form = $this->serviceLocator->get("FormElementManager")->get("loginForm");
		$authenticateLogin = $this->getServiceLocator()->get("authenticateLogin");
		if($this->request->isPost()){
			$form->setData($this->params()->fromPost());
			if($form->isValid()){
				$arrParams = array(
					"email"    => $this->params()->fromPost("my-email"),
					"password" => $this->params()->fromPost("my-password")
				);
				if($authenticateLogin->login($arrParams)){
					$this->redirect()->toRoute("permissionRoute/default",array(
						"controller" => "AuthenClass","action" => "home"
					));
				}else{
					$messageError = $authenticateLogin->getMessages();
				}
			}
		}
		return array(
			"formLogin"    => $form,
			"messageError" => $messageError
		);
	}

	public function homeAction(){
		if(!$this->identity()) $this->redirect()->toRoute("permissionRoute/default",array(
			"controller" => "AuthenClass",
			"action"     => "login"
		));
	}

	public function logoutAction(){
		$authenticateLogin = $this->getServiceLocator()->get("authenticateLogin");
		$authenticateLogin->logout();
		$this->redirect()->toRoute("permissionRoute/default",array(
			"controller" => "AuthenClass",
			"action"     => "login"
		));
	}
}
?>