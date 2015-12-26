<?php

namespace Data\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class IndexController extends AbstractActionController
{
	public function indexAction(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		return false;
	}
}
?>