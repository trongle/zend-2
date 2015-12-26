<?php 
namespace Form\Form;

class StudyOne extends \Zend\Form\Form{
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

		//create TextBox
		// $textBox = new \Zend\Form\Element\Text("my-textbox");
		// //$textBox->setName("my-textbox");
		// $textBox->setLabel("input_text : ")
		// 		->setLabelAttributes(array(
		// 			"id"=>"my-label",
		// 			"class"=>"my-label"
		// 		))
		// 		->setAttributes(array(
		// 			"placeholder" => "this is a textbox",
		// 			"required"    => "required"
		// 		));

		//text box cách 2
		$this->add(array(
			"type" => "text",
			"name" => "my-textbox",
			"attributes" => array(
				"class"       => "my-class",
				"id"          => "my-id",
				"placeholder" => " this is a textbox",
				"style"       => "margin-left:5px",
				"required"    => "required",
				"pattern"     => "[a-zA-Z]{3}-[\d]{2}",
				"title"       => "XXX-XX"
			),
			"options" => array(
				"label" => "textbox : ",
				"label_attributes" => array(
					"class" => "my-class-od-label"
				),
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

		//number
		$this->add(array(
			"type" => "number",
			"name" => "my-number",
			"attributes" => array(
				"min" => 0,
				"max" => 100
			),
			"options" => array(
				"label" => "My number : ",
			),
			
		));

		//password
		$this->add(array(
			"type" => "password",
			"name" => "my-password",
			"options" => array(
				"label" => "My password : ",
			),
		));

		//textarea
		$this->add(array(
			"type" => "textarea",
			"name" => "my-area",
			"attributes" => array(
				"cols" => 50,
				"rows" => 5,
				"style" => "resize:none"
			),
			"options" => array(
				"label" => "My textarea : ",
			),
		));

		//button
		$this->add(array(
			"type" => "button",
			"name" => "my-button",
			"attributes" => array(
			),
			"options" => array(
				"label" => "Button",
			),
		));

		//file
		$this->add(array(
			"type" => "file",
			"name" => "my-file",
			"attributes" => array(
				"multiple" => true
			),
			"options" => array(
				"label" => "My file : ",
			),
		));

		//checkbox
		$checkbox = new \Zend\Form\Element\Checkbox("my-checkbox");
		$checkbox->setLabel("my checkbox")
		         ->setCheckedValue("checked")
		         ->setUnCheckedValue("unchecked")
		         ->setChecked(true);
		$this->add($checkbox);




		// $this->add(array(
		// 	"type" => "checkbox",
		// 	"name" => "my-checkbox",
		// 	"attributes" => array(
		// 		"checked" => true,
		// 	),
		// 	"options" => array(
		// 		"checked_value"   => "checked",
		// 		"unchecked_value" => "unchecked",
		// 		"label"           => "My Checkbox"
		// 	),
		// ));
		

		//multy checkbox
		// $multicheckbox = new \Zend\Form\Element\MultiCheckbox("my-multycheckbox");
		// $multicheckbox->setLabel("my checkbox")
		// 			  	->setAttributes(array(
		// 			  		"value" => array("php","zend"),//thiết lập checked mặc định
		// 			  		"class" => "abc"
		// 			  	))
		// 			  	->setOptions(array(
		// 			  		"value_options" => array(
		// 						"php"  => "lập trình PHP",
		// 						"zend" => "framework Zend",
		// 						"CI"   => "framework CodeIgniter"
		// 			  		),
		// 			  	));
		       
		// $this->add($multicheckbox);

		//multy checkbox(2)
		// $this->add(array(
		// 	"type" => "multicheckbox",
		// 	"name" => "my-multycheckbox",
		// 	"attributes" => array(
		// 		"value" => array("php","zend"),//thiết lập checked mặc định
		// 	),
		// 	"options" => array(
		// 		"value_options" => array(
		// 			"php"  => "lập trình PHP",
		// 			"zend" => "framework Zend",
		// 			"CI"   => "framework CodeIgniter"
		//   		),
		// 	)
		// ));


		//multy checkbox(3)
		$this->add(array(
			"type" => "multicheckbox",
			"name" => "my-multycheckbox",
			"attributes" => array(
				"class" => "abc"
			),
			"options" => array(
				"value_options" => array(
					array(
						"value" => "php",
						"label" => "lập trình PHP",
						"selected" => false,
						"attributes" => array(
							"class" => "not abc"
						)
					),
					array(
						"value" => "zend",
						"label" => "framework Zend",
						"selected" => false
					),
					array(
						"value" => "CI",
						"label" => "framework CodeIgniter",
						"selected" => true
					)
		  		),
			)
		));
		
		
		






		
	}
}
?>