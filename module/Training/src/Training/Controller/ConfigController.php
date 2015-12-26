<?php
namespace Training\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class ConfigController extends AbstractActionController
{
	public function indexAction(){
		echo "<h3 style='color:red;font-weight:bold'>".__DIR__."</h3>";
		$configArr = array(
				"website"  => "<h3>zend.vn</h3>",
				"account"  => array(
					"email"    => "trongle@gmail.com",
					"password" => "12345",
					"title"    => "zendConfig"
				)
			);
	
		// 01 --Convert mảng config thành đối tượng config
		// $config = new \Zend\Config\Config($configArr);
		// echo "<pre>";
		// print_r($config->get("account")->get("email"));
		// echo "</pre>";

		// 02 --Convert mảng config thành đối tượng config
		//$config = new \Zend\Config\Config(include __DIR__."/../../../config/module.config.php");
		

		// 03 --\Zend\Config\Process thực hiện một số hành động trên đối tượng config
			//-- \Zend\Config\Process\Constant ---- định nghĩa hằng số trong $config
				// define("MYCONST","this is my constant");
				// $config = new \Zend\Config\Config(array("const"=>"MYCONST"),true);
				// $process = new \Zend\Config\Processor\Constant();
				// echo "<pre style='font-weight:bold'>";
				// print_r($process->process($config));
				// echo "</pre>";
	

			//-- \Zend\Config\Process\Filter
				// $config = new \Zend\Config\Config($configArr,true);
				// $filterUp = new \Zend\Filter\StringToUpper();
				// $process = new \Zend\Config\Processor\Filter($filterUp);
				// $process->process($config);
				// echo "<pre style='font-weight:bold'>";
				// print_r($config);
				// echo "</pre>";	 
				

			//-- \Zend\Config\Process\Queue
				//--Rule--queue--FIFO(first In First Out)
				// $config            = new \Zend\Config\Config($configArr,true);
				
				// $filterStripTags   = new \Zend\Filter\StripTags();
				// $filterUp          = new \Zend\Filter\StringToUpper();
				
				// $proccessStripTags = new \Zend\Config\Processor\Filter($filterStripTags);
				// $proccessUp        = new \Zend\Config\Processor\Filter($filterUp);

				// $queue = new \Zend\Config\Processor\Queue();
				// $queue->insert($proccessStripTags);
				// $queue->insert($proccessUp);

				// $queue->process($config);

			//-- \Zend\Config\Process\Tonken-----thay thế ký tự trong chuỗi
				$config            = new \Zend\Config\Config(array("TOKEN"=>"this is a Token"),true);
				$token = new \Zend\Config\Processor\Token();
				$token->addToken("To","1234");
				$token->process($config);
				echo "<pre style='font-weight:bold'>";
				print_r($config);
				echo "</pre>";
		return false;
	}

	public function index2Action(){
		// $reader = new \Zend\Config\Reader\Ini();
		// // thay đổi ký tự tạo mảng trong file ini
		// //$reader->setNestSeparator("-");
		// $config = $reader->fromFile(__DIR__."/../../../config/ini/module.config.ini");
		

		$config = new \Zend\Config\Config(array(),true);
		$config->prodution = array();
		$config->prodution->website = "zing.vn";
		$config->prodution->account = array();
		$config->prodution->account->name = "trongle";
		$config->prodution->account->email = "trongle@gmail.com";

		$writer = new \Zend\Config\Writer\Ini();
		$writer->setNestSeparator("-");
		$writer->toFile(__DIR__."/../../../config/ini/config.ini",$config);

	
		//return false;
	}

	public function index3Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		//$reader = new \Zend\Config\Reader\Xml();
		// thay đổi ký tự tạo mảng trong file ini

		// $config = $reader->fromFile(__DIR__."/../../../config/xml/config.xml");
		// echo "<pre style='font-weight:bold'>";
		// print_r($config);
		// echo "</pre>";
		

		$config = new \Zend\Config\Config(array(),true);
		$config->prodution = array();
		$config->prodution->website = "zing.vn";
		$config->prodution->account = array();
		$config->prodution->account->name = "trongle";
		$config->prodution->account->email = "trongle@gmail.com";

		$writer = new \Zend\Config\Writer\Xml();

		$writer->toFile(__DIR__."/../../../config/xml/config2.xml",$config);

	
		return false;
	}
}
?>