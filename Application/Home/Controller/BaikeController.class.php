<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\BaikeTool;
use Common\Common\AccountTool;

class BaikeController extends Controller {
    public function index(){
        $this->data = BaikeTool::getAEntry(1);
        if(empty($this->data)){
            $addedEntryId = BaikeTool::AddAEntry("本县简介", "123");
            $this->data = BaikeTool::getAEntry(1);
        }
        $this->display();
    }
    
    public function Edit(){
        if(IS_GET){
            $currentUser = AccountTool::getCurrentUser();
            if($currentUser === NULL){ 
                $returnUrl = $_SERVER['PATH_INFO'];
                $this->error("您还未登录，情先登陆", '/'."/Home/Account/Login?returnUrl=$returnUrl",3);
            }
            $entryId = (int)I("path.2");
            $this->data = BaikeTool::getAEntry($entryId);
            $this->display();
        }else{
            echo "Http Method Error!";
        }
    }
    
    public function AllEntry(){
        $data = BaikeTool::getAllEntryForTitle();
        $dataJson = json_encode($data);
        $this->data = $dataJson;
        $this->display();
    }
    
    public function DisplayAEntry(){
        $entryId = (int)I('path.2');
        $this->data = BaikeTool::getAEntry($entryId);
        $this->display();
    }
    
    public function AddAEntry(){
        $this->display();
    }
}
?>