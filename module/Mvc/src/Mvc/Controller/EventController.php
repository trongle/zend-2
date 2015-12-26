<?php

namespace Mvc\Controller;

use ZendVN\Event\Foo;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\SharedEventManager;
use Zend\Mvc\Controller\AbstractActionController;

class EventController extends AbstractActionController{
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		$eventManager = new \Zend\EventManager\EventManager();
		// Event One	
		$eventManager->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 1</h3>";
		});
		//$eventManager->trigger("eventOne");

		// Event Two		
		$eventManager->attach("eventTwo",function(){
			echo "<h3/ style='color:red;font-weight:bold'>eventTwo - Do 1</h3>";
		});
		//eventManager->trigger("eventTwo");

		// Thêm công việc cho event One		
		$eventManager->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 2</h3>";
		});
		//$eventManager->trigger("eventOne");

		// Thêm sự kiện cho Công việc(Callback)		
		$eventManager->attach(array("eventOne","eventTwo"),function(){
			echo "<h3 style='color:red;font-weight:bold'>event One and Two - Do Together</h3>";
		});

		// Thêm Công việc cho tất cả các sự kiện		
		$eventManager->attach("*",function(){
			echo "<h3 style='color:red;font-weight:bold'>event One and Two - Do Together and again</h3>";
		});
		$eventManager->trigger("eventOne");
		//	$eventManager->trigger("eventTwo");
		return $this->response;
	}

	public function index02Action(){
		$eventManager = $this->getEventManager();
		//callback case 1
		$eventManager->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 1</h3>";
		});

		//callback case 2
		$listener = function(){
			echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 2</h3>";
		};
		$eventManager->attach("eventOne",$listener);

		//callback case 3
		// $eventManager->attach("eventOne",'\ZendVN\Event\Callback::funcOne');
		$eventManager->attach("eventOne",array('ZendVN\Event\Callback','funcOne'));

		//callback case 4
		$eventManager->attach("eventOne",array('ZendVN\Event\Callback',"funcTwo"));
		$eventManager->trigger("eventOne");

		return false;
	}

	public function index03Action(){
		/////////////////////
		// Priority hàng đợi //
		/////////////////////
		$eventManager = $this->getEventManager();
		//callback case 1
		$eventManager->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 1</h3>";
		},1000);

		//callback case 2
		$listener = function(){
			echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 2</h3>";
		};
		$eventManager->attach("eventOne",$listener,-1000);

		//callback case 3
		// $eventManager->attach("eventOne",'\ZendVN\Event\Callback::funcOne');
		$eventManager->attach("eventOne",array('ZendVN\Event\Callback','funcOne'));

		//callback case 4
		$eventManager->attach("eventOne",array('ZendVN\Event\Callback',"funcTwo"),500);
		$eventManager->trigger("eventOne");

		return false;
	}

	public function index04Action(){
		/////////////////////
		// $e //
		/////////////////////
		$eventManager = $this->getEventManager();
		//callback case 1
		$eventManager->attach("eventOne",function(EventInterface $e){
			echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 1</h3>";
			echo "<pre style='font-weight:bold'>";
			print_r($e);
			echo "</pre>";
			echo $e->getName()."<br />";
			echo $e->getTarget()."<br />";
			echo $e->getParams()."<br />";
			echo $e->getParam("name")."<br />";
		});

		// $listener = function(EventInterface $e){
		// 	echo "<h3 style='color:red;font-weight:bold'>eventOne - Do 2</h3>";
		// 	echo "<pre style='font-weight:bold'>";
		// 	print_r($e);
		// 	echo "</pre>";
		// };

		//$eventManager->attach("eventOne",$listener);

		$param = array("name"=>"trongLe","age"=>"23");
		$eventManager->trigger("eventOne",this,$param);

		return false;
	}

	//////////////
	// getEvent -> lấy danh sách các event của 1 eventManager //
	//////////////
	public function index05Action(){
		$eventManagerOne = new \Zend\EventManager\EventManager();
		$eventManagerTwo = new \Zend\EventManager\EventManager();


		$eventManagerOne->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 1</h3>";
		});

		$eventManagerOne->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 2</h3>";
		});

		$eventManagerOne->attach("eventTwo",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventTwo - Do 2</h3>";
		});




		$eventManagerTwo->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerTwo - evenOne - Do 1</h3>";
		});

		$eventManagerTwo->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerTwo - evenOne - Do 2</h3>";
		});

		// echo "<pre style='font-weight:bold'>";
		// print_r($eventManagerOne->getEvents());
		// echo "</pre>";
		
		$eventManagerTwo->trigger("eventOne");

		$listEventOne = $eventManagerOne->getEvents();
		echo "<pre style='font-weight:bold'>";
		print_r($listEventOne);
		echo "</pre>";

		return false;
	}

	//xóa các event 
	public function index06Action(){
		$eventManagerOne = new \Zend\EventManager\EventManager();
		$eventManagerTwo = new \Zend\EventManager\EventManager();


		$eventManagerOne->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 1</h3>";
		});

		$eventManagerOne->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 2</h3>";
		});

		$eventManagerOne->attach("eventTwo",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventTwo - Do 2</h3>";
		});



		$eventManagerOne->clearListeners("eventOne");
		$eventManagerOne->trigger("eventTwo");

		return false;
	}
	
	// dừng công việc của event --- stopPropagation() 
	public function index07Action(){
		$eventManagerOne = new \Zend\EventManager\EventManager();

		$eventManagerOne->attach("eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 1</h3>";
			$e->stopPropagation(true);
		});

		$eventManagerOne->attach("eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 2</h3>";
			
		});

		$eventManagerOne->attach("eventOne",function(){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 3</h3>";
		});


		$eventManagerOne->trigger("eventOne");

		return false;
	}

	// dừng một event nào đó detach
	public function index08Action(){
		$eventManagerOne = new \Zend\EventManager\EventManager();

		$listener1 = $eventManagerOne->attach("eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 1</h3>";
			$e->stopPropagation(true);
		});

		$listener2 = $eventManagerOne->attach("eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 2</h3>";
			
		});

		$listener3 = $eventManagerOne->attach("eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 3</h3>";
		});

		$eventManagerOne->detach($listener1);
		$eventManagerOne->trigger("eventOne");

		return false;
	}

	// getIdenifier - setIdenifier
	public function index09Action(){
		$eventManagerOne = new EventManager();
		//$eventManagerOne = new EventManager(array("emOne","emTwo"));
		$eventManagerOne->setIdentifiers(array("emOne","emTwo"));

		$listener1 = $eventManagerOne->attach("eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 1</h3>";
		});

		$eventManagerOne->trigger("eventOne");

		$ids = $eventManagerOne->getIdentifiers();
		echo "<pre style='font-weight:bold'>";
		print_r($ids);
		echo "</pre>";

		return false;
	}

	// shareEventManager
	public function index10Action(){
		$shareEventManager = new SharedEventManager();
		//Giống abstract
		$shareEventManager->attach("emOne","eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 1</h3>";
		});

		$shareEventManager->attach(array("emTwo","emThree"),"eventNew",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventNew - Do 1</h3>";
		});


		$eventManager = new EventManager(array("emOne","emThree"));
		$eventManager->setSharedManager($shareEventManager);
		$eventManager->trigger("eventOne");
		$eventManager->trigger("eventNew");

		$eventManager = new EventManager("emTwo");
		$eventManager->setSharedManager($shareEventManager);
		$eventManager->trigger("eventNew");

		return false;
	}

	// create class EventManager
	public function index11Action(){	
		$fooObj = new Foo();
		$fooObj->getEventManager()->attach("showInfo",function($e){
			echo "<h3 style='color:red;font-weight:bold'>showInfo - do 1</h3>";
			echo "<pre style='font-weight:bold'>";
			print_r($e->getParams());
			echo "</pre>";
		});

		$fooObj->getEventManager()->attach("showInfo",function(){
			echo "<h3 style='color:red;font-weight:bold'>showInfo - do 2</h3>";
		});

		$fooObj->showInfo("trong","23");
		//$ids = $fooObj->getEventManager()->getIdentifiers();
		// echo "<pre style='font-weight:bold'>";
		// print_r($ids);
		// echo "</pre>";
		return false;
	}

	//getShareEventManager()
	public function index12Action(){
		$eventHost = new EventManager();
		$shareEventManager = $eventHost->getSharedManager();

		$shareEventManager->attach("emOne","eventOne",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventOne - Do 1</h3>";
		});

		$shareEventManager->attach(array("emTwo","emThree"),"eventNew",function($e){
			echo "<h3 style='color:red;font-weight:bold'>eventManagerOne - eventNew - Do 1</h3>";
		});


		$eventManager = new EventManager(array("emOne","emThree"));
		//$eventManager->setSharedManager($shareEventManager);<---không cần thiết xem lại action 10
		$eventManager->trigger("eventOne");
		$eventManager->trigger("eventNew");

		$eventManager = new EventManager("emTwo");
		//$eventManager->setSharedManager($shareEventManager);<---không cần thiết xem lại action 10
		$eventManager->trigger("eventNew");

		return false;
	}

	//Event Advance
	public function index13Action(){
		$fooObj = new Foo();

		$fooObj->showInfo("trong","23");

		return false;
	}

	//create Listener
	public function index14Action(){
		$fooObj = new Foo();

		$fooObj->showInfo("trong","23");

		return false;
	}


}