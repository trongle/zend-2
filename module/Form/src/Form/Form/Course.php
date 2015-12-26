<?php 
namespace Form\Form;

class Course extends \Zend\Form\Form{
	public function __construct(){
		parent::__construct();
//<form action="check-login.html" method="GET" class="form-horizontal" role="form" name="login-form" id="login-form">
		//Form Attribute
		$this->setAttributes(array(
				"action" => "#",
				"method" => "POST",
				"class"  => "form-horizontal",
				"role"   => "form",
				"name"   => "login-form",
				"id"     => "login-form"
		));

		$this->add(array(
			"type" => "Select",
			"name" => "my-type",

			"attributes" => array(
				"style" => "padding:4px 8px; width:300px",
				"id"    => "my-type",
				"value" => "web"
			),
			"options"  => array(
				"empty_option" => "Hãy chọn lĩnh vực",
				"label" => "Chọn lĩnh vực",
				"value_options" => array(
					"web"    => "Lập trình web",
					"mobile" => "Lập trình di động",
					"design" => "Thiết kế"
				)
			)
		));

		$this->add(array(
			"type" => "Select",
			"name" => "my-course",
			"attributes" => array(
				"style" => "padding:4px 8px; width:300px",
				"id"    => "my-course",
			),
			"options"  => array(
				"label" => "Chọn khóa học",
				"value_options" => array()
			)
		));

		$this->add(array(
			"type" => "button",
			"name" => "my-button-submit",
			"attributes" => array(
				"type"        => "submit",
				"class"       => "btn btn-success btn-sm",
				"value"       => "",
			),
			"options" => array(
				"label" => "Sign in"
			)	
		));

		
	}
}
?>