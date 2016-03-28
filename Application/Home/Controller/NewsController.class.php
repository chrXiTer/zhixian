<?php
namespace Home\Controller;
use Think\Controller;
use Common\Common\AccountTool;
use Home\Common\NewsTool;

class NewsController extends Controller {
    public function index(){
        $this->newsList = NewsTool::getAllNews();
        $this->isLogin = (null != AccountTool::getCurrentUser());
        $this->display();
    }
    
    public function AddANews(){
       if (IS_GET){
           $this->display();
       }else{
           echo "error methon";
       }
    }
    
    public function DisplayANews(){
        $newsId = (int)I("path.2");
        $this->viewData = NewsTool::GetANews($newsId);
        $this->display();
    }
    
    public function MyNews(){
        $this->display();
        $this->viewData = NewsTool::getAllNewsFromCurrentUser();
        $this->display();
    }
}
?>