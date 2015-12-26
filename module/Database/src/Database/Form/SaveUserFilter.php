<?php 
namespace Database\Form;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\InputFilter\InputFilter;

class SaveUserFilter extends InputFilter{
	public function __construct($id = null){
		if($id == null){
			$this->add(array(
					"name" => "name",
					"required" => true,
					"validators" => array(

					array(
						"name"    => "NotEmpty",
						"options" => array(
							"messages" => array(
								\Zend\Validator\NotEmpty::IS_EMPTY => "Username không được rỗng"
							)
						),
						"break_chain_on_failure" => true,
					),
					array(
						"name" => "dbNoRecordExists",
						"options" => array(
							"messages" => array(
								\Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => "Username này đã tồn tại",
							),
							"table" => "user",
							"field" => "name",
							"adapter" =>  GlobalAdapterFeature::getStaticAdapter()
						)
					)
				)	
			));

			$this->add(array(
					"name" => "email",
					"required" => true,
					"validators" =>array(
						array(
							"name"    => "NotEmpty",
							"options" => array(
								"messages" => array(
									\Zend\Validator\NotEmpty::IS_EMPTY => "Email không được rỗng"
								)
							),
							"break_chain_on_failure" => true,		
						),
						array(
							"name"    => "EmailAddress",
							"options" => array(
								"messages" => array(
									\Zend\Validator\EmailAddress::INVALID_FORMAT => "Email không đúng quy định"
								),
							),
							"break_chain_on_failure" => true,
						),	
						array(
							"name" => "dbNoRecordExists",
							"options" => array(
								"messages" => array(
									\Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => "Email này đã tồn tại",
								),
								"table" => "user",
								"field" => "email",
								"adapter" => GlobalAdapterFeature::getStaticAdapter()
							)
						)
				)	
			));
		}else{
			$this->add(array(
					"name" => "name",
					"required" => true,
					"validators" => array(

					array(
						"name"    => "NotEmpty",
						"options" => array(
							"messages" => array(
								\Zend\Validator\NotEmpty::IS_EMPTY => "Username không được rỗng"
							)
						),
						"break_chain_on_failure" => true,
					),
					array(
						"name" => "dbNoRecordExists",
						"options" => array(
							"messages" => array(
								\Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => "Username này đã tồn tại",
							),
							"table" => "user",
							"field" => "name",
							"adapter" => GlobalAdapterFeature::getStaticAdapter(),
							"exclude" => array(
								"field" => "id",
								"value" => $id
							) 
						)
					)
				)	
			));

			$this->add(array(
					"name" => "email",
					"required" => true,
					"validators" =>array(
						array(
							"name"    => "NotEmpty",
							"options" => array(
								"messages" => array(
									\Zend\Validator\NotEmpty::IS_EMPTY => "Email không được rỗng"
								)
							),
							"break_chain_on_failure" => true,		
						),
						array(
							"name"    => "EmailAddress",
							"options" => array(
								"messages" => array(
									\Zend\Validator\EmailAddress::INVALID_FORMAT => "Email không đúng quy định"
								),
							),
							"break_chain_on_failure" => true,
						),	
						array(
							"name" => "dbNoRecordExists",
							"options" => array(
								"messages" => array(
									\Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => "Email này đã tồn tại",
								),
								"table" => "user",
								"field" => "email",
								"adapter" => GlobalAdapterFeature::getStaticAdapter(),
								"exclude" => array(
									"field" => "id",
									"value" => $id
								) 
							)
						)
				)	
			));
		}
	
	}
}
?>