<?php
namespace Home\Controller;
use Think\Controller;
use Common\Common\AccountTool;

class AccountController extends Controller {
    public function Index(){
        redirect('/'.COUNTY_SPELLING.'/Home/Account/Profile', 1, '页面跳转中...');
    }

    public function Profile(){
        $userName = I("path.2");//要显示的用户
        $this->data = AccountTool::getProfile($userName);
        $this->display();
    }

    public function Register(){
        if (IS_GET){
            $this->display();
            return;
        }
        if(IS_POST){
            $userName = I('UserName');
            $password = I('Password');
            $registerResult = AccountTool::register($userName, $password);
            if($registerResult->status == "error"){
                $this->error($registerResult->info, '/'.COUNTY_SPELLING."/Home/Account/Register");
            }else{
                $this->success($registerResult->info, '/'.COUNTY_SPELLING."/Home/Account/Profile", 3);
            }
            return;
        }
    }

    public function Login(){
        if (IS_GET){
            $this->display();
        }else if(IS_POST){
            $returnUrl = I('get.returnUrl');
            $userName = I('UserName');
            $password = I('Password');
            $loginResult = AccountTool::login($userName, $password);
            if( empty($loginResult) ){//用户名不存在，或者密码错误
                $this->error("用户名或者密码错误", '/'.COUNTY_SPELLING.'/Home/Account/Login?returnUrl='.$returnUrl, 3);
            }else{ //登录成功
                $this->success("登录成功", $returnUrl, 3);
            }
        }else{
             $this->error('非法请求');
        }
    }
    
    public function LogOff(){
        if(IS_POST){
            AccountTool::clearCurrentUser();
            redirect('/'.COUNTY_SPELLING."/Home/Main/index", 1, "退出成功，页面跳转中...");
        }else{
            $this->error('非法请求');
        }
    }
}
?>