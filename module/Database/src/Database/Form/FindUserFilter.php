<?php 
namespace Database\Form;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\InputFilter\InputFilter;

class FindUSerFilter extends InputFilter{
	public function __construct(){
		$this->add(array(
			"name" => "my-email", 
			"required" => true,
			"validators" => array(
				array(
					"name" => "NotEmpty",
					"options" => array(
						"messages" => array(
							 \Zend\Validator\NotEmpty::IS_EMPTY => "Dữ liệu không được rỗng"
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
					)
				),
				array(
					"name" => "DbRecordExists",
					"options" => array(
						"messages" => array(
							\Zend\Validator\Db\RecordExists::ERROR_NO_RECORD_FOUND => "Email không tồn tại",
						),
						"table" => "user",
						"field" => "email",
						"adapter" => GlobalAdapterFeature::getStaticAdapter()
					)
				),
			)
		));
	}
}
?>