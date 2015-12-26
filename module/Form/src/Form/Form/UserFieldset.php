<?php 
namespace Form\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class UserFieldset extends Fieldset implements InputFilterProviderInterface{
	public function __construct(){
		parent::__construct("user");
		$this->add(array(
			"type" => "text",
			"name" => "my-email",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "inputEmail3",
				"placeholder" => "Email",
				"value"       => "",
				"required"    => "required",
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
	}
	public function getInputFilterSpecification(){
		return array (
			"my-email" => array(
				"filters" =>array(
					array( "name" => "StringToUpper" ),
					array( "name" => "StringTrim" ),
					array( 
						"name" => "PregReplace",
						"options" => array(
						   		"pattern" => "#[\d]#",
						   		"replacement" => "."
						)
					)
				),
				"validators" => array(
					array(
						"name" => "NotEmpty",
						"options" => array(
							"message" => array(
								\Zend\Validator\NotEmpty::INVALID => "Dữ liệu không được rỗng",
							)
						),
						"break_chain_on_failure" => "true"
					),
					array(
						"name" => "StringLength",
						"options" => array(
							"min" => "3",
							"max" => "10",
							"messages" => array(
								\Zend\Validator\StringLength::TOO_SHORT => "Số ký tự phải lớn hơn hoặc bằng %min%",
								\Zend\Validator\StringLength::TOO_LONG => "Số ký tự phải nhỏ hơn hoặc bằng %max%",
							)
						)
					)
				)
			),

			"my-password" => array(
				"filters" =>array(
					array( "name" => "ZendVN\Filter\RemoveCircumPlex" )
				),
				"validators" => array(
					array(
						"name" => "NotEmpty",
						"options" => array(
							"message" => array(
								\Zend\Validator\NotEmpty::INVALID => "Dữ liệu không được rỗng",
							)
						),
						"break_chain_on_failure" => "true"
					),
					array(
						"name" => "ZendVN\Validator\CheckCourse",
						"options" => array(
							"pattern" => "#[A-Z]#"
						),
						"break_chain_on_failure" => "true"
					),
				)
			)
		);
	}
}
?>