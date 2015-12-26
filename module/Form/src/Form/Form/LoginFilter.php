<?php 
namespace Form\Form;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter{
	public function __construct(){
		//EMAIL
		$this->add(array(
			'name'    => "my-email",
			"filters" =>array(
				array( "name" => "StringToUpper" ),
				array( "name" => "StringTrim" ),
				array( "name" => "PregReplace",
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
						"messages" => array(
							\Zend\Validator\NotEmpty::IS_EMPTY => "Dữ liệu không được rỗng"
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
				),
				array(
					"name" => "EmailAddress",
				)
				
			)
			
		));

		//PASSWORD
		$this->add(array(
			'name'    => "my-password",
			"filters" =>array(
				array( "name" => "ZendVN\Filter\RemoveCircumPlex" )
			),
			"validators" => array(
				array(
					"name" => "NotEmpty",
					"options" => array(
						"messages" => array(
							\Zend\Validator\NotEmpty::IS_EMPTY => "Dữ liệu không được rỗng"	
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
		));
	}
}
?>