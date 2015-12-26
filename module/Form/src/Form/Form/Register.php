<?php 
namespace Form\Form;

class Register extends \Zend\Form\Form{
	public function __construct(){
		parent::__construct();

		$this->setAttributes(array(
				"action" => "check-login.html",
				"method" => "GET",
				"class"  => "form-horizontal",
				"role"   => "form",
				"name"   => "login-form",
				"id"     => "login-form"
			));

		$this->add(new \Form\Form\UserFieldset());
		//text box cách 2
		//<label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
		// <div class="col-sm-9">
		// 	<input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
		// </div>
		$this->add(array(
			"type" => "text",
			"name" => "card-holder-name",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "card-holder-name",
				"placeholder" => "Card Holder's Name",
			),
			"options" => array(
				"label" => "Name on Card",
				"label_attributes" => array(
					"class" => "col-sm-3 control-label"
				),
			)	
		));

		//<label class="col-sm-3 control-label" for="card-number">Card Number</label>
		// <div class="col-sm-9">
		// 	<input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
		// </div>
		$this->add(array(
			"type" => "text",
			"name" => "card-number",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "card-number",
				"placeholder" => "Debit/Credit Card Number",
			),
			"options" => array(
				"label" => "Card Number",
				"label_attributes" => array(
					"class" => "col-sm-3 control-label"
				),
			)	
		));

		//<div class="form-group">
	// 	<label class="col-sm-3 control-label" for="cvv">Card CVV</label>
	// 	<div class="col-sm-3">
	// 		<input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
	// 	</div>
	// </div>
		$this->add(array(
			"type" => "text",
			"name" => "cvv",
			"attributes" => array(
				"class"       => "form-control",
				"id"          => "cvv",
				"placeholder" => "Security Code",
			),
			"options" => array(
				"label" => "Card CVV",
				"label_attributes" => array(
					"class" => "col-sm-3 control-label"
				),
			)	
		));

	// <div class="form-group">
	// 	<div class="col-sm-offset-3 col-sm-9">
	// 		<button type="button" class="btn btn-success">Pay Now</button>
	// 	</div>
	// </div>
		$this->add(array(
			"type" => "button",
			"name" => "pay-now",
			"attributes" => array(
				"class"       => "btn btn-success",
			),	
			"options" => array(
				"label" => "Pay now"
			)	
		));


		$this->add(array(
			"type" => "select",
			"name" => "expiry-month",
			"attributes" => array(
				"class"       => "form-control col-sm-2",
				"id"          => "expiry-month",
			),
			"options" => array(
				"empty_option"  => "month",
				"value_options" => array(
					"01" => "Jan (01)",
					"02" => "Feb (02)",
					"03" => "Mar (03)",
					"04" => "Apr (04)",
					"05" => "May (05)",
					"06" => "June (06)",
					"07" => "July (07)",
					"08" => "Aug (08)",
					"09" => "Sep (09)",
					"10" => "Oct (10)",
					"11" => "Nov (11)",
					"12" => "Dev (12)",
				),
				"label" => "Expiration Date",
				"label_attributes" => array(
					"class" =>	"col-sm-3 control-label"
				)
			)	
		));


		$this->add(array(
			"type" => "select",
			"name" => "expiry-year",
			"attributes" => array(
				"class"       => "form-control",
			),
			"options" => array(
				"value_options" => array(
					"13" => "2013",
					"14" => "2014",
					"15" => "2015",
					"16" => "2016",
					"17" => "2017",
					"18" => "2018",
					"19" => "2019",
					"20" => "2020",
					"21" => "2021",
					"22" => "2022",
					"23" => "2023",
					"24" => "2024",
				)
			)	
		));

	}
}
?>