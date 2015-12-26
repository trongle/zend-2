<?php

namespace Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
	
class IndexController extends AbstractActionController{
	public function indexAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		return false;
	}
}