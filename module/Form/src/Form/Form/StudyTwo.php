<?php 
namespace Form\Form;

class StudyTwo extends \Zend\Form\Form{
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

		//hidden
		$hidden = new \Zend\Form\Element\Hidden("my-hidden");
		$hidden->setValue("123456");
		$this->add($hidden);

		//radio
		// $radio = new \Zend\Form\Element\Radio("my-radio");
		// $radio->setLabel("language")
		// 	   ->setValue("vi")
		// 	   ->setValueOptions(array(
		// 	   		"vi"=>"Vietnam",
		// 	   		"en"=>"English",
		// 	   		"jp"=>"Japan"
		// 	   	));
		// $this->add($radio);
		

		$this->add(array(
			"name"       => "my-radio",
			"type"       => "radio",
			"attributes" => array(
				"value" => "jp"
			),
			"options"    => array(
				"value_options" => array(
					"vi"=>"Vietnam",
			   		"en"=>"English",
			   		"jp"=>"Japan"
				),
				"label" => "language"
			),
		)); 


		//selecbox
		// $select = new \Zend\Form\Element\Select("my-select");
		// $select->setLabel("List course")
		// 	   ->setEmptyOption("Please choose a course")
		// 	   ->setValue("ci")
		// 	   ->setValueOptions(array(
		// 	   		"Web" => array(
		// 	   			"label" => "web",
		// 	   			"options" => array(
		// 					"zend"   =>"Framework Zend 2",
		// 					"ci"     =>"Framework CodeIgniter",
		// 					"jquery" =>"Lập trình jQuery master"
		// 				)
		// 			),
		// 			"Mobile" => array(
		// 				"label" => "mobile",
		// 				"options" => array(
		// 					"ios"     => "Lập trình IOS",
		// 					"android" => "Lập trình Android"
		// 				)
		// 			)
		// 	   	));
		// $this->add($select);


		$this->add(array(
			"name"       => "my-select",
			"type"       => "select",
			"attributes" => array(
				
			),
			"options"    => array(
				"value_options" => array(
					"Web" => array(
			   			"label" => "web",
			   			"options" => array(
							"zend"   =>"Framework Zend 2",
							"ci"     =>"Framework CodeIgniter",
							"jquery" =>"Lập trình jQuery master"
						)
					),
					"Mobile" => array(
						"label" => "mobile",
						"options" => array(
							"ios"     => "Lập trình IOS",
							"android" => "Lập trình Android"
						)
					)
				),
				"label" => "List course",
				"empty_option" => "Please choose a course"
			),

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