<?php 
namespace Form\Form;

class StudyFour extends \Zend\Form\Form{
	public function __construct(){
		parent::__construct();

		//Form Attribute
		$this->setName("my-form")
			 ->setAttribute("action","#")
			 ->setAttributes(array(
			 	"enctype" => "multipart/form-data",
			 	"class"   => "my-form",
			 	"novalidate" => "true"
			 ));
		$this->setInputFilter(new \Form\Form\StudyFilter());
		$this->add(new \Form\Form\UserFieldset());
		//text box cách 2
		$this->add(array(
			"type" => "text",
			"name" => "my-email",
			"options" => array(
				"label" => "email : ",
			)	
		));

		//submit
		$this->add(array(
			"type" => "submit",
			"name" => "my-submit",
			"attributes" => array(
				"value" => "Gửi",
			)
		));

	

		//password
		$this->add(array(
			"type" => "password",
			"name" => "my-password",
			"options" => array(
				"label" => "Password : ",
			),
		));		
	}
}
?>