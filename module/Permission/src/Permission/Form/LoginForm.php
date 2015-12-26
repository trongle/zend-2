<?php 
namespace Permission\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
	public function __construct(){
		parent::__construct();
		$this->setAttributes(array(
			"action" => "#",
			"method" => "POST",
			"class"  => "form-horizontal",
			"role"   => "form",
			"name"   => "login-form",
			"id"     => "login-form"
		));
		$this->add(array(
			"type" => "text",
			"name" => "my-email",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "inputEmail3",
				"placeholder" => "Email",
				"value"       => "",
				"required"    => false
			),
			"options" => array(
				"label" => "Email ",
				"label_attributes" => array(
					"class" => "col-sm-3 control-label"
				),
			)	
		));

		$this->add(array(
			"type" => "password",
			"name" => "my-password",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "inputPassword3",
				"placeholder" => "Password",
				"value"       => "",
			),
			"options" => array(
				"label" => "Password ",
				"label_attributes" => array(
					"class" => "col-sm-3 control-label"
				),
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