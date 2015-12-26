<?php
namespace Training\Controller;


use Zend\Mvc\Controller\AbstractActionController;




class AutoloaderController extends AbstractActionController
{
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$autoLoader = new \Zend\Loader\StandardAutoloader(array("autoregister_zf" => true));
		$autoLoader->registerNamespace("Database",LIB_PATH."/Database");
		$autoLoader->registerPrefix("Mail",LIB_PATH."/Mail");
		$autoLoader->register();

		$student = new \Database\Student();
		$teacher = new \Database\Teacher();
		$people  = new \Database\basetada\People();

		$sender = new \Mail_Sender();
		$google_sender = new \Mail_google_sender();
		return false;
	}

	public function index02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$autoLoader = new \Zend\Loader\StandardAutoloader(
			array(
				"autoregister_zf" => true,
				"namespaces" => array(
					"Database" => LIB_PATH."/Database",
					"Art"  	   => LIB_PATH."/Art"
				),
				"prefixes"  => array(
					"Mail" => LIB_PATH."/Mail",
				),
			)
		);
		

		$autoLoader->register();

		$student = new \Database\Student();
		$teacher = new \Database\Teacher();
		$people  = new \Database\basetada\People();

		$sontung_m = new \Art\Singer();

		$sender = new \Mail_Sender();
		$google_sender = new \Mail_google_sender();
		return false;
	}

	public function index03Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		\Zend\Loader\AutoloaderFactory::factory(
			array(
				'Zend\Loader\StandardAutoloader' => array(
					"autoregister_zf" => true,
					"namespaces" => array(
						"Database" => LIB_PATH."/Database",
						"Art"  	   => LIB_PATH."/Art"
					),
					"prefixes"  => array(
						"Mail" => LIB_PATH."/Mail",
					),
				),
			)
		);


		$student = new \Database\Student();
		$teacher = new \Database\Teacher();
		$people  = new \Database\basetada\People();

		$sontung_m = new \Art\Singer();

		$sender = new \Mail_Sender();
		$google_sender = new \Mail_google_sender();
		return false;
	}

	public function index04Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$autoLoader = new \Zend\Loader\ClassMapAutoloader();
		$autoLoader->registerAutoloadMap(LIB_PATH."/ClassMap/AutoLoader.php");
		$autoLoader->register();

		$student = new \Database\Student();
		$teacher = new \Database\Teacher();

		$sender = new \Mail_Sender();
		return false;
	}

	public function index05Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$autoLoader = new \Zend\Loader\ClassMapAutoloader(
			array(
				LIB_PATH."/ClassMap/AutoLoader.php",
				LIB_PATH."/AutoLoader2.php",
			)
		);
		$autoLoader->register();

		$student = new \Database\Student();
		$teacher = new \Database\Teacher();
		$people  = new \Database\basetada\People();

		$sontung_m = new \Art\Singer();

		$sender = new \Mail_Sender();
		return false;
	}

	public function index06Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		\Zend\Loader\AutoloaderFactory::factory(
			array(
				"\Zend\Loader\ClassMapAutoloader" => array(
					LIB_PATH."/ClassMap/AutoLoader.php",
					LIB_PATH."/AutoLoader2.php",
				),
			)
		);

		$student = new \Database\Student();
		$teacher = new \Database\Teacher();
		$people  = new \Database\basetada\People();

		$sontung_m = new \Art\Singer();

		$sender = new \Mail_Sender();
		return false;
	}
}
?>