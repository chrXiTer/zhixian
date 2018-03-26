<?php
namespace Home\Controller;
use Think\Controller;
use Common\Common\AccountTool;
use Home\Common\AffairTool;

class AffairController extends Controller {
	public function index(){
        $this->affairs = AffairTool::getAllAffairs();
		$this->currentUserIsAdmin = AccountTool::currentUserIsAdmin();
        $this->display();
	}
	
	public function DisplayAAffair(){
		$affairId = (int)I("path.2");
        $affairM = M('x_'."Affair");
        $this->affair = $affairM->where("id=".$affairId)->select()[0];
		$this->currentUserIsAdmin = AccountTool::currentUserIsAdmin();
		
		$Model = new \Think\Model();
		$result = $Model->query(
			"SELECT * FROM cx_x_service_type WHERE id IN "
				."(SELECT serviceTypeId FROM cx_x_affair_service_type WHERE affairId =".$affairId.")"
		);
		$this->neededServiceTypes = $result;
        $this->display();
	}
	
	public function AddAServiceToAffair(){
		$affairId = (int)I("path.2");
		if(IS_GET){
			$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
			$result = $Model->query(
				'SELECT * FROM cx_x_service_type WHERE id NOT IN '
					.'(SELECT serviceTypeId FROM cx_x_affair_service_type WHERE affairId ='.$affairId.')'
			);
			$this->serviceTypesToSelect = $result;
			$this->display();
		}else if(IS_POST){
			$serviceTypeId = (int)I("ServiceTypeId");
			$result = AffairTool::AddAServiceToAffair($affairId, $serviceTypeId);
			if($result){
				$resyltStr = '添加服务到事务成功';
			}else {
				$resyltStr = '添加服务到事务未成功';
			}
			redirect('/'."/Home/Affair/DisplayAAffair/".$affairId, 2, $resyltStr);
		}
	}

	public function AddAAffair(){
        if(IS_GET){
            $this->display();
        }else if(IS_POST){
			$affairM = M('x_affair');
            if($affairM->create()){
                $result = $affairM->add(); // 写入数据到数据库 
                if($result){
                    $insertId = $result;// 如果主键是自动增长型 成功后返回值就是最新插入的值
                    redirect('/'."/Home/Service/",2,"申请添加事务成功");
                }else {
                    redirect('/'."/Home/Service/",2,"没有要申请添加的事务");
                }
            }
        }
	}
}
?>