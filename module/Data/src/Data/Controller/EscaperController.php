<?php 

namespace Data\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \Zend\Escaper\Escaper;

class EscaperController extends AbstractActionController{
	public function index01Action(){
		$escaper = new Escaper();
		$input = "<script>alert12</script>";
		echo $escaper->escapeHtml($input);
		return false;
	}

	public function index02Action(){
		$input = <<<INPUT
		' onmouseover='alert(/ZF2!/);
INPUT;
		$output = htmlspecialchars($input);
		echo "<span title='$output'>ZendVN</span>";
		return false;
	}

	public function index03Action(){
		$input = <<<INPUT
		' onmouseover='alert(/ZF2!/);
INPUT;
		$escaper = new Escaper();
		$output = $escaper->escapeHtmlAttr($input);
		echo "<span title='$output'>ZendVN</span>";
		return false;
	}

	public function index04Action(){
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
	}

	public function index05Action(){
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
	}

	public function index06Action(){
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);
		return $viewModel;
	}
}