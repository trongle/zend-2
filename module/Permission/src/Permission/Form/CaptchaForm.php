<?php 
namespace Permission\Form;

use Zend\Form\Form;

class CaptchaForm extends Form
{
	public function __construct(){
		parent::__construct();
		$this->setAttributes(array(
			"action" => "#",
			"method" => "POST",
			"name"   => "my-form",
			"id"     => "my-form"
		));
		$captchaImg = new \ZendVN\Captcha\Image(70,250,array("wordlen"=>5));
		$this->add(array(
			"name" => "my-captcha",
			"type" => "Captcha",
			"options" => array(
				"label" => "Secure code :",
				"captcha" => $captchaImg
			)
		));
		$this->add(array(
			"name" => "my-submit",
			"type" => "button",
			"attributes" => array(
				"type"  => "submit",
				"value" => "submit"
			)
		));
	}
}
?>