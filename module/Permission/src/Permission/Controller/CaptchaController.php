<?php 
namespace Permission\Controller;

use Zend\Captcha\AbstractWord;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CaptchaController extends AbstractActionController
{
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";

		//Tạo đối tượng chaptcha Image
		$captchaImg = new \Zend\Captcha\Image();

		//Thiết lập đường dẫn đấn thư mục hình ảnh chứa captcha
		$captchaImg->setImgDir(CAPTCHA_PATH."images");
		//Thiết lập url cho hình ảnh captcha
		$captchaImg->setImgUrl(CAPTCHA_URL."images");

		//Thiết lập font
		$captchaImg->setFont(CAPTCHA_PATH."fonts/Vharis.ttf");
		//font-size
		$captchaImg->setFontSize(30);
		//length-char
		$captchaImg->setWordlen(5);

		//width-height cho captcha
		$captchaImg->setWidth(180);
		$captchaImg->setHeight(70);

		//set dấu chấm và đường chéo
		$captchaImg->setDotNoiseLevel(70);
		$captchaImg->setLineNoiseLevel(5);

		//Thiết lập ký tự xuất hiện
		AbstractWord::$VN = array("t");
		AbstractWord::$CN = array("r");

		//Phát sinh captcha
		$captchaImg->generate();

		$imgUrl = $captchaImg->getImgUrl().$captchaImg->getId().$captchaImg->getSuffix();
		return new ViewModel(array(
			"imgUrl" => $imgUrl,
		));
	}
	//tạo class captcha và validate captcha
	public function index02Action(){
		$captchaImg = new \ZendVN\Captcha\Image(70,250,array("wordlen"=>"5"));
		$imgUrl     = $captchaImg->getImgUrl().$captchaImg->getId().$captchaImg->getSuffix();
			
		if($this->request->isPost()){
			$captcha_user = $this->request->getPost("captcha_user");
			$captcha_hidden = $this->request->getPost("captcha_id");
			//session
			$captchaSession = new \Zend\Session\Container("Zend_Form_Captcha_".$captcha_hidden);
			// echo "<br />".$captchaSession->word;
			if(strcmp($captchaSession->word,$captcha_user) === 0){
				echo "OK BEDE";
			}else{
				echo "NO OK";
			}
			
		}
		return new ViewModel(array(
			"imgUrl"     => $imgUrl,
			"captcha_id" => $captchaImg->getId()
		));
	}

	//tạo class captcha và validate captcha
		//Refresh captcha bang ajax
	public function index03Action(){
		$captchaImg = new \ZendVN\Captcha\Image(70,250,array("wordlen"=>"5"));
		$imgUrl     = $captchaImg->getImgUrl().$captchaImg->getId().$captchaImg->getSuffix();
		

		if($this->request->isPost()){
			$captcha_user = $this->request->getPost("captcha_user");
			$captcha_hidden = $this->request->getPost("captcha_id");
			$validate = new \ZendVN\Validator\Captcha($captcha_hidden);
			if($validate->isValid($captcha_user)){
				echo "OK";
			}else{
				echo "<pre style='font-weight:bold'>";
				print_r($validate->getMessages());
				echo "</pre>";
			}

			$captchaImg->removeOldCaptcha($captcha_hidden);
		}
		return new ViewModel(array(
			"imgUrl"     => $imgUrl,
			"captcha_id" => $captchaImg->getId()
		));
	}

	public function refreshCaptchaAction(){
		$viewModel = new ViewModel();
		$isXmlHttpRequest = false;
		if($this->request->isXmlHttpRequest()){
			$isXmlHttpRequest = true;
			$captchaOldId = $this->request->getQuery("captchaOldId");
			$captchaImg = new \ZendVN\Captcha\Image(70,250,array("wordlen"=>5));

			$captchaID = $captchaImg->getId();
			$imgUrl = $captchaImg->getImgUrl().$captchaID.$captchaImg->getSuffix();

			//delete old captcha
			$captchaImg->removeOldCaptcha($captchaOldId);
		}



		$viewModel->setTerminal(true);
		$viewModel->setVariables(array(
			"isXmlHttpRequest" => $isXmlHttpRequest,
			"captchaID"        => $captchaID,
			"imgUrl"           => $imgUrl
		));

		return $viewModel;
	}

	//captcha trong zendForm
	public function index04Action(){
		$myForm = new \Permission\Form\CaptchaForm();
		if($this->request->isPost()){
			$data = $this->request->getPost();
			$myForm->setData($data);
			if($myForm->isValid()){
				echo "OK";
			}else{
				echo "<pre style='font-weight:bold'>";
				print_r($myForm->getMessages());
				echo "</pre>";
			}
		}
		return new ViewModel(array(
			"myForm"     => $myForm
		));
	}

}
?>