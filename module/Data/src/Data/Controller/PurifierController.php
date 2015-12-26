<?php

namespace Data\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class PurifierController extends AbstractActionController
{
	public function index01Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		$config->set("HTML.AllowedElements","div,p");

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input = "<h3>Helo</h3>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index02Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		// cho phép tất cả các class
		//$config->set("Attr.AllowedClasses",null);
		// không cho phép xài class abc
		$config->set("Attr.AllowedClasses",array("abc"));

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input = "<h3 class='abc content'>Helo</h3>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index03Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		//chặn tất cả ID
		//$config->set("Attr.EnableID",false);

		//cho phép tất cả ID
		//$config->set("Attr.EnableID",true);

		//cho phép một số ID
		// $config->set("Attr.EnableID",true);
		// $config->set("Attr.IDBlacklist",array("content"));

		//thêm prefix cho id
		// $config->set("Attr.EnableID",true);
		// $config->set("Attr.IDPrefix","lui_");

		//thêm prefix cho id
		$config->set("Attr.DefaultImageAlt","trongle");


		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		// $input = "<h3 id='trong' class='abc content'>Helo</h3><p id='content'>TrongLe</p>";
		$input = "<img src='trongle.png'>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index04Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		//xóa phần href trong tag <a>
		$config->set("AutoFormat.DisplayLinkURI",true);

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input = "<a href='www.thisIsTheLink'>Link</a>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index05Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		//element nào khong có content thì xóa
		$config->set("AutoFormat.RemoveEmpty",false);

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input = "<a href='www.thisIsTheLink'>Link</a><p></p>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index06Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		//cho phép sử dụng một số tag html được chỉ định
		$config->set("HTML.Allowed","p");

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input = "<a href='www.thisIsTheLink'>Link</a><p></p>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index07Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		//Không cho phép sử dung !important trong CSS
		$config->set("CSS.AllowImportant",false);

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input = "<p style='color:blue !important'>TrongBlue</p>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index08Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		//Cho phép sử dụng những attr trong HTML dc chỉ định
		//$config->set("Attr.EnableID",true);
		$config->set("HTML.AllowedAttributes",array("class","id"));

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input = "<p class='trong' id='le' style='color:blue !important'>TrongBlue</p>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index09Action(){
		$config =  \HTMLPurifier_Config::createDefault();
		//Cho phép sử dụng những attr trong HTML dc chỉ định
		$config->set("Attr.EnableID",true);
		$config->set("Output.SortAttr",true);

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input  = "<p id='le' class='trong' style='color:blue !important'>TrongBlue</p>";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index10Action(){
		$config =  \HTMLPurifier_Config::createDefault();

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input  = "<script>alert(\"flash light\")</script>";
		$output = $purifier->purify($input);

		//echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index11Action(){
		$config =  \HTMLPurifier_Config::createDefault();
	

		$purifier = new \HTMLPurifier_HTMLPurifier($config);
		$input  = "<h4>TRongLE";
		$output = $purifier->purify($input);

		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}

	public function index12Action(){
		$input  = "<p id='le' class='trong' style='color:blue !important'>TrongBlue</p>";
		$options = array(
				"Attr.EnableID"          => true,
				"Output.SortAttr"        => true,
				"HTML.AllowedAttributes" =>array("class","id")
			);
		
		$filter = new \ZendVN\Filter\Purifier($options);
		$output = $filter->filter($input);
		echo "<h3 style='color:red;font-weight:bold'>input : </h3>".$input."<br>";
		echo "<h3 style='color:red;font-weight:bold'>output : </h3>".$output;
		return false;
	}
}
?>