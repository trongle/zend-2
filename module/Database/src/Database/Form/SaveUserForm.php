<?php 
namespace Database\Form;

use Zend\Form\Form;

class SaveUserForm extends Form{
	public function __construct(){
		parent::__construct();	
		$this->setAttributes(array(
			"action" => "#",
			"method" => "POST",
			"class"  => "form-horizontal",
			"role"   => "form"
		));

		//name
		$this->add(array(
			"name"  => "name",
			"type"  => "text",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "username",
				"placeholder" => "Username"
			),
			"options"   => array(
				"label"  => "User name",
				"label_attributes" => array(
					"class"  => "col-sm-3 control-label"
				)  				
			)
		));

		//fullname
		$this->add(array(
			"name"  => "fullname",
			"type"  => "text",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "fullname",
				"placeholder" => "Full name"
			),
			"options" => array(
				"label"  => "Full name",
				"label_attributes" => array(
					"class"  => "col-sm-3 control-label"
				)  
			)
		));

		//email
		$this->add(array(
			"name"  => "email",
			"type"  => "text",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "email",
				"placeholder" => "Email"
			),
			"options" => array(
				"label"  => "Email",
				"label_attributes" => array(
					"class"  => "col-sm-3 control-label"
				)  
			)
		));

		//submit
		$this->add(array(
			"name" => "submit",
			"type" => "button",
			"attributes" => array(
				"class" => "btn btn-info",
				"type"  => "submit"
			),
			"options" => array(
				"label" => "submit"
			)
		));

		//reset
		$this->add(array(
			"name" => "cancel",
			"type" => "button",
			"attributes" => array(
				"class" => "btn btn-default",
				"type"  => "reset",
				"onclick" => "resetForm()"
			),
			"options" => array(
				"label" => "cancel"
			)
		));

	}
}
?>