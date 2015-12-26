<?php 
namespace Mvc\Controller\plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class myPlugin extends AbstractPlugin{
	public function __invoke($name){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		echo $name;
		return $this;
	}

	public function showInfo(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	}
}
?>