<?php 
namespace Database\Controller;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate as Pre;
use Zend\Db\Sql\Predicate\Literal;
use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;

class ExerciseSqlController extends AbstractActionController{
	protected $_table = "architect";
	protected function showResult($selectObj){
		$adapter = $this->getServiceLocator()->get("db_qlxd");	
		echo $stringSql = $selectObj->getSqlString($adapter->getPlatForm());
		$result = $adapter->query($stringSql)->execute();
		foreach ($result as $row) {
			echo "<pre style='font-weight:bold'>";
			print_r($row);
			echo "</pre>";
		}
	}

	protected function createSqlString($selectObj){
		$adapter = $this->getServiceLocator()->get("db_qlxd");
		return  $selectObj->getSqlString($adapter->getPlatForm());
	}
	//SELECT
	//hiển thị những năm sinh có thể có của kiến trúc sư
	public function index01Action(){
		$selectObj = new \Zend\Db\Sql\Select($this->_table);
		$selectObj->columns(array(
						"birthday" => new Expression('DISTINCT (birthday)')
						
						))
					;
		$this->showResult($selectObj);
		return false;
	}
	//ORDER
	//Hiển thị danh sách công trình có chi phi từ thấp đến cao
	public function index02Action(){
		$selectObj = new \Zend\Db\Sql\Select("building");
		$selectObj->columns(array("id","name","cost"))
				  ->order("cost ASC")
					;
		$this->showResult($selectObj);
		return false;
	}
	//ORDER
	//Nếu 2 công trình có chi phí bằng nhau sắp xếp tên thành phố theo thứ tự ngược của bảng chữ cái
	public function index03Action(){
		$selectObj = new \Zend\Db\Sql\Select("building");
		$selectObj->columns(array("id","name","cost","address","city"))
				  ->order(array("cost ASC","city DESC"))
					;
		$this->showResult($selectObj);
		return false;
	}

	//WHERE
	//Hiển thị công nhân có chuyên môn hàn hoặc diện và năm sinh lớn hơn 1945
	public function index04Action(){
		$selectObj = new \Zend\Db\Sql\Select("worker");
		$selectObj->columns(array("id","name","skill","birthday"))
				  ->where(new Predicate\In("skill",array("han","dien")))
				  ->where("birthday > 1945")
					;
		$this->showResult($selectObj);
		return false;
	}

	//WHERE
	//Hiển thị công nhân có chuyên môn hàn hoặc diện và năm sinh lớn hơn 1945
	//có tên bắt đầu bằng TH và có 3 ký tự
	public function index05Action(){
		$selectObj = new \Zend\Db\Sql\Select("worker");
		$selectObj->columns(array("id","name","skill","birthday"))
				  ->where(array(
				  		new Pre\In("skill",array("han","dien")),
				  		new Pre\Expression("birthday > ?",array(1945)),
				  		new Pre\Like("name","%th_")

				  	))
					;
		$this->showResult($selectObj);
		return false;
	}

	//MIN ,MAX ,COUNT ,SUM ,AVG...
	//Đối với mỗi công nhân cho biết số ngày tham gia công trình ít nhất,nhiều nhất	
	public function index06Action(){
		$selectObj = new \Zend\Db\Sql\Select("work");
		$selectObj->columns(array(
						"worker_id",
						"min_day" => new Expression("MIN(total)"),
						"max_day" => new Expression("MAX(total)")
						))
				  ->group("worker_id")
				  
					;
		$this->showResult($selectObj);
		return false;
	}

	//MIN ,MAX ,COUNT ,SUM ,AVG...
	//Tổng số ngày tham gia cho tất cả công trình,trung bình số ngày tham gia đối với mỗi công trình
	public function index07Action(){
		$selectObj = new \Zend\Db\Sql\Select("work");
		$selectObj->columns(array(
						"worker_id",
						"total _day" => new Expression("SUM(total)"),
						"avg_day"    => new Expression("ROUND(AVG(total))")	
						))
				  ->group("worker_id")
				
				  
					;
		$this->showResult($selectObj);
		return false;
	}


	//SELECT CHILD
	//Hiển thị thông tin công trình chưa có kiến trúc sư thiết kế
	public function index08Action(){
		$subObj = new Select("design");
		$subObj->columns(array(
			"building_id" => new Expression("DISTINCT(building_id)")
		));
		$stringSql = $this->createSqlString($subObj);

		$selectObj = new Select("building");
		$selectObj->columns(array("id","name","address"))
				  ->where(new Literal(sprintf("id NOT IN (%s)",$stringSql)));

		$this->showResult($selectObj);
		return false;
	}

	//SELECT CHILD
	//Hiển thị thông tin công trình có chi phí lớn hơn tất cả các công trình được xây dựng ở cần thơ
	public function index09Action(){
		$subObj = new Select("building");
		$subObj->columns(array(
					"max_cost" => new Pre\Expression("MAX(cost)")
				))
			   ->where(new Pre\Expression("city = ?",array("can tho")))
		;
		$stringSql = $this->createSqlString($subObj);

		$selectObj = new Select("building");

		$where = new \Zend\Db\Sql\Where();
		$where->literal(sprintf("cost > (%s)",$stringSql));

		$selectObj->columns(array("id","name","address","cost"))
				  ->where($where);

		$this->showResult($selectObj);
		return false;
	}

	//SELECT CHILD
	//Hiển thị thông tin công trình có chi phí lớn hơn một trong các công trình được xây dựng ở cần thơ
	public function index10Action(){
		$subObj = new Select("building");
		$subObj->columns(array(
					"cost"
				))
			   ->where(new Pre\Expression("city = ?",array("can tho")))
		;
		$stringSql = $this->createSqlString($subObj);

		$selectObj = new Select("building");

		$where = new \Zend\Db\Sql\Where();
		$where->literal(sprintf("cost > ANY (%s)",$stringSql))
		      ->notEqualTo("city","can tho");
		
		$selectObj->columns(array("id","name","address","cost"))
				  ->where($where);

		$this->showResult($selectObj);
		return false;
	}

	//SELECT MULTI
	//Hiển thị công trình(building),tên kiến trúc sư(artchitect),và thù lao của mỗi kiến trúc sư ở mỗi công trình(benefit)
	public function index11Action(){
		$subObj = new Select("building");
	

		$selectObj = new Select(array("d"=>"design"));		
		$selectObj->columns(array(
						"benefit" => new Expression("benefit * 100000")
					))
		          ->join(array("ar"=>"architect"),"ar.id = d.architect_id",array("architect_name"=>"name"))
		          ->join(array("bu"=>"building"),"bu.id = d.building_id",array("building_name"=>"name"));
				  // ->where($where);

		$this->showResult($selectObj);
		return false;
	}

	//SELECT MULTI
	//Tìm họ tên và chuyên môn của các công nhân (worker) tham gia (work) các công trình do kiến trúc sư lê thanh tung thiết kế
	public function index12Action(){
		$subObj = new Select(array("d"=>"design"));
		$subObj->columns(array("building_id"))
			   ->join(array("ar"=>"architect"),"ar.id = d.architect_id",array(),$subObj::JOIN_LEFT)
			   ->where(new literal("name = 'le thanh tung'"));
		$stringSql = $this->createSqlString($subObj);

		$selectObj = new Select(array("w"=>"worker"));		
		$selectObj->columns(array("id","name","skill"))
				  ->join(array("wo"=>"work"),"w.id = wo.worker_id",array(),$selectObj::JOIN_LEFT)	
		          ->where(new Literal(sprintf("wo.building_id IN (%s)",$stringSql)));

		$this->showResult($selectObj);
		return false;
	}
}
?>