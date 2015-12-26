<?php 
namespace Mvc\Service;

use Mvc\Service\FaceBookService;
use Mvc\Service\MailService;

class SocialService{
	public function __construct(FaceBookService $fbSer,MailService $mSer){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
	}
}