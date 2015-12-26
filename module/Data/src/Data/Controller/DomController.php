<?php

namespace Data\Controller;

use Zend\Mvc\Controller\AbstractActionController;
	
class DomController extends AbstractActionController{
	protected $_html = '<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>PHP Show Data</title>
					<link href="css/bootstrap.min.css" rel="stylesheet">
					<link href="css/style.css" rel="stylesheet">
				</head>		
				<body>
					<div class="container list-quiz">
						<h1 class="page-header">Danh sách phim</h1>
						<div class="row">
							<div class="col-md-3">
								<div class="thumbnail">
									<img src="data/face-reader.jpg" alt="Image 01">
									<div class="caption">
										<h3>The Face Reader</h3>
										<p>2013</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="thumbnail">
									<img src="data/pirate-fairy.jpg" alt="Image 01">
									<div class="caption">
										<h3>The Pirate Fairy</h3>
										<p>2014</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="thumbnail">
									<img src="data/sadako.jpg" alt="Image 01">
									<div class="caption">
										<h3>Sadako</h3>
										<p>2013</p>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="thumbnail">
									<img src="data/american-pie-7.jpg" alt="Image 01">
									<div class="caption">
										<h3>American Pie 7</h3>
										<p>2013</p>
									</div>
								</div>
							</div>
						</div>					
					</div>
				</body>
				</html>';
	public function index01Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		

		$dom = new \Zend\Dom\Query($this->_html);
		$nameNodes = $dom->execute("div[class='caption'] h3");
		$imgNodes  = $dom->execute("div[class='thumbnail'] img");
		$yearNodes = $dom->execute("div[class='caption'] p");

		$i = 0;
		$result =array();
		foreach($nameNodes as $nameNode){
			$result[$i]['name'] =  $nameNode->nodeValue;
			$i++;
		}

		$i = 0;
		foreach($imgNodes as $imgNode){
			$result[$i]['image'] =  $imgNode->getAttribute("src");
			$i++;
		}

		$i = 0;
		foreach($yearNodes as $yearNode){
			$result[$i]['year'] =  $yearNode->nodeValue;
			$i++;
		}
		echo "<pre style='font-weight:bold'>";
		print_r($result);
		echo "</pre>";
		return false;
	}

	public function index02Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		

		$dom = new \Zend\Dom\Query($this->_html);
		$allNodes = $dom->execute("div[class='caption'] h3 ,div[class='thumbnail'] img , div[class='caption'] p");

		$result = array();
		$i=0;
		$k=0;
		foreach($allNodes as $value){

			if($i == 0) $result[$k]['img']  = $value->getAttribute("src");
			if($i == 1) $result[$k]['name'] = $value->nodeValue;
			if($i == 2) $result[$k]['year'] = $value->nodeValue;
			if($i == 2){
				$i = 0;
				$k++;
			}else{
				$i++;
			}
			

		}
		echo "<pre style='font-weight:bold'>";
		print_r($result);
		echo "</pre>";
	
		return false;
	}

	public function index03Action(){
		echo "<h3 style='color:red;font-weight:bold'>".__METHOD__."</h3>";
		

		$dom = new \Zend\Dom\Query($this->_html);
		$nameNodes = $dom->execute("div[class='caption'] h3");
		$imgNodes  = $dom->execute("div[class='thumbnail'] img");
		$yearNodes = $dom->execute("div[class='caption'] p");

		echo $totalItems = $nameNodes->count();
		$result = array();
		for($i = 0; $i < $totalItems; $i++){
			$result[$i]['name'] = $nameNodes[$i]->nodeValue;
			$result[$i]['year'] = $yearNodes[$i]->nodeValue;
			$result[$i]['image'] = $imgNodes[$i]->getAttribute("src");

		}
		echo "<pre style='font-weight:bold'>";
		print_r($result);
		echo "</pre>";
	
		return false;
	}
}