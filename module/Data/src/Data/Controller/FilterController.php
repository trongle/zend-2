<?php

namespace Data\Controller;

use Zend\Filter\StaticFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Filter as ZFilter;



class FilterController extends AbstractActionController
{
	// Zend\I18n\Filter\Alnum
	public function index01Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\I18n\Filter\Alnum();
	$input  = "abc !#$&^% 123"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\I18n\Filter\Alpha
	public function index02Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\I18n\Filter\Alpha();
	$input  = "abc !#$&^% 123"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\Basename
	public function index03Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\BaseName();
	$input  = "http://zend.vn/trongle.html"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\Dir
	public function index04Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\Dir();
	$input  = "http://zend.vn/trongle.html"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\Calback
	public function index05Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\Callback("strtoupper");
	$input  = "http://zend.vn/trongle.html"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\Digits
	public function index06Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\Digits();
	$input  = "$%#$$%dsgsdgs123"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\Tolower
	public function index07Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\StringToLower();
	$filter->setEncoding("UTF-8");
	//$filter = new \Zend\Filter\StringToLower("UTF-8");
	$input  = "SDGDSGSGSG"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\Toupper
	public function index08Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\StringToUpper();
	$input  = "$%#$$%dsgsdgs123"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\StringTrim
	public function index09Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\StringTrim();
	$input  = "             $%#$$%dsgsdgs123              "; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\StripsTag
	public function index10Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\StripTags();
	$input  = "<h3 style='color:red'>$%#$$%dsgsdgs123</h3>"; 
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\Compress
	public function index11Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$option = array(
		"adapter" => "zip",
		"options" => array("archive" => PUBLIC_PATH."/zip/compress.zip"),
	);
	$input = PUBLIC_PATH."/zip/application.config.php";
	$filter = new \Zend\Filter\Compress($option);
	$filter->filter($input);

	return false;
	}

	// Zend\Filter\Compress
	public function index12Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$option = array(
		"adapter" => "zip",
		"options" => array("target" => PUBLIC_PATH."/unzip"),
	);
	$input = PUBLIC_PATH."/zip/compress.zip";
	$filter = new \Zend\Filter\Decompress($option);
	$filter->filter($input);

	return false;
	}

	// Zend\Filter\PregReplace
	public function index13Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\PregReplace(array("pattern"=>"#[0-9]#","replacement"=>"x"));
	$input 	= "trongle123";
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	// Zend\Filter\HtmlEntities
	public function index14Action(){
	echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	$filter = new \Zend\Filter\HtmlEntities();
	$input 	= "trongle123>>!&";
	$output = $filter->filter($input);

	echo "<h2>Input: $input</h2><br>";
	echo "<h2>Output : $output</h2>";

	return false;
	}

	public function index15Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$filter = new \Zend\Filter\Word\CamelCaseToSeparator("-");
		$input 	= "TrongleHandsomeTalent";
		$output = $filter->filter($input);

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output : $output</h2>";

		return false;
	}

	public function index16Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "Trongle123sHandsomeTalent";
		$output = StaticFilter::execute($input,"PregReplace",array("pattern"=>"#[0-9]#","replacement"=>"x"));

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output : $output</h2>";

		return false;
	}

	public function index17Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "            Trongle123123-Handsome-Talent         ";
		$filterChain = new  ZFilter\FilterChain();
		$filterChain->attach(new ZFilter\StringTrim());
		$filterChain->attach(new ZFilter\PregReplace(array("pattern"=>"#[0-9]#","replacement"=>"x")));
		$filterChain->attach(new ZFilter\Word\DashToUnderscore());
		$output = $filterChain->filter($input);

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output : $output</h2>";

		return false;
	}

	public function index18Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "            Trongle123123-Handsome-Talent         ";
		$filterChain = new  ZFilter\FilterChain();
		$filterChain->attachByName("StringTrim");
		$filterChain->attachByName("PregReplace",array("pattern"=>"#[0-9]#","replacement"=>"!"));
		$filterChain->attachByName("Word\DashToUnderscore");
		$output = $filterChain->filter($input);

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output : $output</h2>";

		return false;
	}

	public function index19Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "Khóa học lập trình Zend Framework cung cấp kiến thức căn bản và chuyên sâu về Zend Framework";
		$options = array(
			"patern"      => "Zend Framework",
			"replacement" => "www.zend.vn"
		);
		$filter = new \ZendVN\Filter\AddLink($options);
		$output = $filter->filter($input);

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output : $output</h2>";

		return false;
	}

	public function index20Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "Khóa học lập trình Zend Framework cung CẤP kiến thức căn bản và chuyên sâu về Zend Framework";
		$filter = new \ZendVN\Filter\RemoveCircumPlex();
		$output = $filter->filter($input);

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output : $output</h2>";

		return false;
	}

	public function index21Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "www.zend.vn/             Khóa học            lập trình Zend Framework $#%#$%@ cung CẤP kiến thức căn bản và chuyên sâu về Zend Framework";
		// $input 	= "www.zend.vn/khoa-hoc-lap-trinh-zend-framework-cung-cap-kien-thuc-can-ban-va-chuyen-sau-ve-zend-framework";
		// bo ky tu dac biet --> alnum
		// xoa khoang trang du thua -->stringTrim,preg_replace
		// chueyn thanh chu thuong -->stringtolower
		// cach nhau bang dau -  -->separatortoDash
		// them .html
		$arr = explode(".vn/",$input);
		$filter = new \ZendVN\Filter\CreateLinkFriendly();
		$output = $arr[0].".vn/".$filter->filter($arr[1]).".html";

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output :$output</h2>";

		return false;
	}

	public function index22Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "www.zend.vn/             Khóa học            lập trình Zend Framework $#%#$%@ cung CẤP kiến thức căn bản và chuyên sâu về Zend Framework";
	
		$arr = explode(".vn/",$input);
		StaticFilter::getPluginManager()->setInvokableClass("CreateLinkFriendly","\ZendVN\Filter\CreateLinkFriendly");
		$output = $arr[0].".vn/".StaticFilter::execute($arr[1],"CreateLinkFriendly").".html";

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output :$output</h2>";

		return false;
	}

	// register plugin at module.php -->method onBootstrap()
	public function index23Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$input 	= "www.zend.vn/             Khóa học            lập trình Zend Framework $#%#$%@ cung CẤP kiến thức căn bản và chuyên sâu về Zend Framework";
	
		$arr = explode(".vn/",$input);
	
		$output = $arr[0].".vn/".StaticFilter::execute($arr[1],"CreateLinkFriendly").".html";

		echo "<h2>Input: $input</h2><br>";
		echo "<h2>Output :$output</h2>";

		return false;
	}


}
?>