<?php 
namespace Database\Form;

use Zend\Form\Form;

class FindUserForm extends Form{
	public function __construct(){
		parent::__construct();
		$this->setAttributes(array(
			"action" => "#",
			"method" => "POST",
			"class"  => "form-horizontal",
			"id"     => "login-form",
			"name"   => "login-form"
		));

		$this->add(array(
			"type" => "text",
			"name" => "my-email",
			"attributes" => array(
				"class" => "form-control",
				"id"    => "inputEmail3",
				"placeholder" => "Email:..."
			),
			"options" => array(
				"label" => "Email : ",
				"label_attributes" => array(
					"class" => "col-sm-3 control-label"
				)
			)
		));

		$this->add(array(
			"type" => "button",
			"name" => "my-submit",
			"attributes" => array(
				"type"  => "submit",
				"class" => "btn btn-success btn-sm",
			),
			"options" => array(
				"label" => "Sign in",
			)
		));

		$this->add(array(
			"type" => "button",
			"name" => "my-reset",
			"attributes" => array(
				"type"  => "reset",
				"class" => "btn btn-success btn-sm",
				"onclick" => "resetForm()"
			),
			"options" => array(
				"label" => "Reset",
			)
		));
	}
}
?>