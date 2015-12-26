<?php 
namespace Database\Model\Entity;

class User
{
	public $id;
	public $name;
	public $email;
	public $avatar;
	public $created;
	public $fullname;

	public $product;
	public function exchangeArray($data){
	
		$this->id       = (!empty($data['id']))? $data['id']:"";
		$this->name     = (!empty($data['name']))? $data['name']:"";
		$this->email    = (!empty($data['email']))? $data['email']:"";
		$this->product  = (!empty($data['product']))? $data['product']:"";
		$this->avatar   = (!empty($data['avatar']))? $data['avatar']:"";
		$this->created  = (!empty($data['created']))? $data['created']:"";
		$this->fullname = (!empty($data['fullname']))? $data['fullname']:"";
	}

	public function getArrayCopy(){
		return get_object_vars($this);
	}
}
?>