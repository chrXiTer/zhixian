<?php
namespace Home\Controller;
use Think\Controller;
use Common\Common\AccountTool;
use Home\Common\ServiceTool;
use Home\Common\AffairTool;
use Home\Common\NeedTool;

class NeedController extends Controller {
    public function index(){
        $this->needs = NeedTool::getAllNeeds();
        $this->currentUserIsAdmin = AccountTool::currentUserIsAdmin();
        $this->display();
	}
    
    public function AddANeed(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === NULL){ 
            $returnUrl = $_SERVER['PATH_INFO'];
            $this->error("您还未登录，情先登陆", '/'."/Home/Account/Login?returnUrl=$returnUrl",3);
        }
        $this->PublisherId = $currentUser["id"];
        if (IS_GET){
            $this->display();
        }else if(IS_POST){

        }
    }

    public function DisplayANeed(){
        $_id = (int)I("path.2");
        $this->viewData = NeedTool::getANeed($_id);
        $this->display();
    }
}
?>