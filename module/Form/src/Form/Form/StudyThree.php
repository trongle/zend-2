<?php 
namespace Form\Form;

class StudyThree extends \Zend\Form\Form{
	public function __construct(){
		parent::__construct();

		//Form Attribute
		$this->setName("my-form")
			 ->setAttribute("action","#")
			 ->setAttributes(array(
			 	"enctype" => "multipart/form-data",
			 	"class"   => "my-form",
			
			 ));

		//number
		$this->add(array(
			"name" => "my-number",
			"type" => "number",
			"attributes" => array(
				"min" => "1",
				"max" => "12",
				"value" => "4"
			),
			"options" => array(
				"label" => "my number : "
			)
		));

		//color
		$this->add(array(
			"name" => "my-color",
			"type" => "color",
			"options" => array(
				"label" => "my color : "
			)
		));

		//date
		$this->add(array(
			"name" => "my-date",
			"type" => "date",
			"options" => array(
				"label" => "my date : "
			),
			"attributes" => array(
				"min" => "01/01/2000",
				"required" => true
			)
		));

		//email
		$this->add(array(
			"name" => "my-email",
			"type" => "email",
			"options" => array(
				"label" => "my email : "
			),
		));

		//range
		$this->add(array(
			"name" => "my-range",
			"type" => "range",
			"options" => array(
				"label" => "my range : "
			),
			"attributes" => array(
				"min" => 10,
				"max" => 100,
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
	}
}
?>