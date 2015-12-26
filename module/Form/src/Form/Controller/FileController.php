<?php 
namespace Form\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class FileController extends AbstractActionController{

	// upload nhiều tập tin
	public function index01Action(){
		if($this->request->isPost()){
			$upload = new \Zend\File\Transfer\Adapter\Http();
			$info = $upload->getFileInfo("image");
			$name = $upload->getFileName("image");
			$size = $upload->getFileSize("image");
			// echo "<pre style='font-weight:bold'>";
			// print_r($info);
			// echo "</pre>";

			// echo "<pre style='font-weight:bold'>";
			// print_r($name);
			// echo "</pre>";

			// echo "<pre style='font-weight:bold'>";
			// print_r($size);
			// echo "</pre>";
			$upload->setDestination(FILES_PATH."images","image");
			$upload->setDestination(FILES_PATH."zip","zip");

			$upload->receive("image");
		}
	}

	// validate tập tin upload
	public function index02Action(){
		if($this->request->isPost()){
			$upload = new \Zend\File\Transfer\Adapter\Http();

			$upload->addValidator("Extension",false,array("png","jpg"),"image");
			$upload->addValidator("Size",true,array("min"=>"100KB","max"=>"1MB"),"zip");

			if($upload->isValid()){
				$upload->setDestination(FILES_PATH."images","image");
				$upload->setDestination(FILES_PATH."zip","zip");
				$upload->receive();
			}else{
				$message = $upload->getMessages();
				echo "<pre style='font-weight:bold'>";
				print_r($message);
				echo "</pre>";
			}			
		}
	}

	// filter thay đổi tên tập tin
	public function index03Action(){
		if($this->request->isPost()){
			$upload = new \Zend\File\Transfer\Adapter\Http();
			$upload->addFilter("Rename",array(
					"target" => FILES_PATH."images/my_file.jpg",
					"overwrite" => true,
					"randomize" => true
				),"image");
			$upload->receive("image");			
		}
	}


	// class Validate
	public function index04Action(){
		if($this->request->isPost()){
			$upload = new \ZendVN\File\Upload();
			$upload->addValidator("Extension",true,array("png","jpg"),"image")
				   ->addValidator("Size",false,array("min"=>"100KB","max"=>"1MB"),"image");


			if($upload->isValid("image")){
				$upload->uploadFile("image",FILES_PATH."images",array("task"=>"rename"));
			}else{
				$message = $upload->getMessages();
				echo "<pre style='font-weight:bold'>";
				print_r($message);
				echo "</pre>";
			}	
		}	
	}

	// class Validate
	public function index05Action(){
		if($this->request->isPost()){
			$upload = new \ZendVN\File\Upload();
			$fileName = $upload->getFileName();
		
			$upload->addValidator("Extension",true,array("png","jpg"),"image")
				   ->addValidator("Size",false,array("min"=>"100KB","max"=>"1MB"),"zip");

			foreach ($fileName as $key => $value) {
				if($upload->isValid($key)){
					$prefix = ($key == "image")? "img_":"file_";
					$upload->uploadFile($key,FILES_PATH.$key,array("task"=>"rename"),$prefix);
				}else{
					$message = $upload->getMessages();
					echo "<pre style='font-weight:bold'>";
					print_r($message);
					echo "</pre>";
				}	
			}	
		}	
	}
}
?>