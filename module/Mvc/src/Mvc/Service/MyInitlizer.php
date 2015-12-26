<?php 
namespace Mvc\Service;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MyInitlizer implements InitializerInterface{
	public function initialize($instance, ServiceLocatorInterface $serviceLocator){
		if($instance instanceof  \Mvc\Service\UserService ){
			$instance->setFaceBook("trongleno1");
		}
	}
}