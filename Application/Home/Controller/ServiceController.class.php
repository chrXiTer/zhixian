<?php
namespace Home\Controller;
use Think\Controller;
use Common\Common\AccountTool;
use Home\Common\ServiceTool;
use Home\Common\AffairTool;

class ServiceController extends Controller {
    public function index(){
        $this->services = ServiceTool::getAllServices();
        $this->currentUserIsAdmin = AccountTool::currentUserIsAdmin();
        $this->display();
    }
    
    public function DisplayAService(){
        $serviceId = (int)I("path.2");
        $this->viewData = ServiceTool::getAserviceToDisplay($serviceId);
        $this->display();
    }

    public function AddAService(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === NULL){ 
            $returnUrl = $_SERVER['PATH_INFO'];
            $this->error("您还未登录，情先登陆", '/'.COUNTY_SPELLING."/Home/Account/Login?returnUrl=$returnUrl",3);
            return;
        }
        if (IS_GET){
            $this->PublisherId = $currentUser["id"];
            $this->serviceTypes = ServiceTool::getAllServiceTypes();
            $this->display();
        }else if(IS_POST){
           echo "error methon";
        }
    }

    public function EditAService(){
        $_id = (int)I("path.2");
        if(IS_GET){
            $viewData = ServiceTool::getAServiceToEdite($_id);
            if(!$viewData["isMyself"]){
                redirect('/'.COUNTY_SPELLING."/Home/Service/DisplayAService", 2, "只有信息发布者才可以编辑");
                return;
            }
            $this->viewData = $viewData;
            $this->display();
        }else if(IS_POST){
            echo "error methon";
        }
    }

    /////////////////////////////////////
    ////  服务类型相关功能
    /////////////////////////////////////
    public function DisplayAServiceType(){
        $typeId = (int)I("path.2");
        $serviceM = M('x_'.COUNTY_SPELLING."_service");
        $serviceTypeM = M('x_'.COUNTY_SPELLING."_service_type");
        $this->serviceType = ServiceTool::getAServiceType($typeId);
        $this->childrenServiceTypes = $serviceTypeM->where("ParentId=".$typeId)->select();
        $this->childrenServices = $serviceM->where("TypeId=".$typeId)->select();
        $this->display();
    }
    
    public function SuggestAddAServiceType(){
        if(IS_GET){
            $this->allServiceTypes = ServiceTool::getAllServiceTypes("'ParentId' desc");
            $this->serviceTypesInUsing = ServiceTool::getServiceTypesUsing($this->allServiceTypes);
            $this->serviceTypesNotUsed = ServiceTool::getServiceTypesNotUsed($this->allServiceTypes);
            $this->serviceTypesHasStoped = ServiceTool::getServiceTypesHasStoped($this->allServiceTypes);
            $this->display();
        }else if(IS_POST){
            $serviceType = M('x_'.COUNTY_SPELLING.'_service_type');
            if($serviceType->create()){
                $result = $serviceType->add(); // 写入数据到数据库 
                if($result){
                    $insertId = $result;// 如果主键是自动增长型 成功后返回值就是最新插入的值
                    redirect('/'.COUNTY_SPELLING."/Home/Service/",2,"申请添加类型成功");
                }else {
                    redirect('/'.COUNTY_SPELLING."/Home/Service/",2,"没有要申请添加的类型");
                }
            }
        }
    }

    public function ManagementServiceType(){
        if(IS_GET){
            $this->allServiceTypes = ServiceTool::getAllServiceTypes("'ParentId' desc");
            $this->serviceTypesInUsing = ServiceTool::getServiceTypesUsing($this->allServiceTypes);
            $this->serviceTypesNotUsed = ServiceTool::getServiceTypesNotUsed($this->allServiceTypes);
            $this->display();
        }else{
            echo "error methon";
        }
    }
}

?>