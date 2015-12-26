<?php


namespace Database\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	echo "<h3 style='color:red;font-weight:bold'>Bạn có quyền truy cập : ".__METHOD__."</h3>";
        return new ViewModel();
    }

     public function infoAction()
    {
    	echo "<h3 style='color:red;font-weight:bold'>Bạn có quyền truy cập : ".__METHOD__."</h3>";
        return new ViewModel();
    }
}
