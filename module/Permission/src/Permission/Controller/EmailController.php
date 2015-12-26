<?php 
namespace Permission\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class EmailController extends AbstractActionController
{
	public function index01Action(){
		//cấu hình mail \Zend\Mail\Transport\SmtpOptions()
		$smtpOption = new \Zend\Mail\Transport\SmtpOptions(array(
			"name" => "localhost",
			"connectionClass" => "login",
			"host" => "smtp.gmail.com",
			"port" => 587,   //465 25 587
			"connectionConfig" => array(//người gửi (là mình)
				"username" => "trongle171192@gmail.com",
				"password" => "Quenroi3",
				"ssl"      => "tls"
			)
		));
		$message = new \Zend\Mail();
		$message->setFrom("trongle171192@gmail.com","abc");
		$message->setTo("trongle1711@gmail.com","def");
		$message->setSubject("hello test mail");
		$message->setBody("nhận được không ku");
		$transport->send($message);
		return false;
	}


	public function index02Action(){
		$message = new \Zend\Mail\Message();
		$message->setBody('This is the text of the email.');
		$message->setFrom('trongle1711@gmail.com', 'Sender\'s name');
		$message->addTo('trongle171192@gmail.com', 'Name of recipient');
		$message->setSubject('TestSubject');

		$transport = new \Zend\Mail\Transport\Sendmail();
		$transport->send($message);
	}
}
?>