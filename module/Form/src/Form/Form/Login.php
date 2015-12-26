<?php 
namespace Form\Form;

class Login extends \Zend\Form\Form{
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
		//  $this->setInputFilter(new \Form\Form\LoginFilter());
		//  $this->add(new \Form\Form\UserFieldset());
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

		//<label for="my-checkbox"><input type="checkbox" name="my-checkbox" value="1">Remember me </label>
		$this->add(array(
			"type" => "checkbox",
			"name" => "my-checkbox",
			"attributes" => array(
				"value"       => "1",
			),
			"options" => array(
				"label" => "Remember me ",
			)	
		));

		// <div class="form-group">
		// 	<div class="col-sm-offset-3 col-sm-9">
		// 		<button type="submit" name="my-button-submit" class="btn btn-success btn-sm" value="">Sign in</button>
		// 		<button type="reset" name="my-button-reset" class="btn btn-default btn-sm" value="">Reset</button>
		// 	</div>
		// </div>
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

		$this->add(array(
			"type" => "button",
			"name" => "my-button-reset",
			"attributes" => array(
				"type"        => "reset",
				"class"       => "btn btn-default btn-sm",
				"value"       => "",
			),	
			"options" => array(
				"label" => "Reset"
			)
		));
	}
}
?>