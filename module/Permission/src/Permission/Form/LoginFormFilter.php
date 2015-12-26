<?php 
namespace Permission\Form;

use Zend\InputFilter\InputFilter;

class LoginFormFilter extends InputFilter
{
	public function __construct(){

		$this->add(array(
			"name" => "my-email",
			"validators" => array(
				array(
					"name" => "NotEmpty",
					"options" => array(
						"messages" => array(
							\Zend\Validator\NotEmpty::IS_EMPTY => "Email không được rỗng"
						)
					),
					"break_chain_on_failure" => true
				),
				array(
					"name" => "EmailAddress",
					"options" => array(
						"messages" => array(
							\Zend\Validator\EmailAddress::INVALID_FORMAT => "Email không hợp lệ"
						)
					),
					"break_chain_on_failure" => true
				)
				
			)
		));


		$this->add(array(
			"name" => "my-password",
			"validators" => array(
				array(
					"name" => "NotEmpty",
					"options" => array(
						"messages" => array(
							\Zend\Validator\NotEmpty::IS_EMPTY => "Password không được rỗng"
						)
					),
					"break_chain_on_failure" => true
				),
				array(
					"name" => "StringLength",
					"options" => array(
						"min" => 3,
						"max" => 8,
						"messages" => array(
							\Zend\Validator\StringLength::TOO_LONG  => "mật khẩu không được dài quá 8 ký tự",
							\Zend\Validator\StringLength::TOO_SHORT => "mật khẩu không được ngắn hơn 3 ký tự"
						)
					),
					"break_chain_on_failure" => true
				)
				
			)
		));
	}
}
?>