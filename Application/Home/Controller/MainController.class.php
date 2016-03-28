<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\ServiceTool;
use Home\Common\AffairTool;
use Home\Common\NeedTool;

class MainController extends Controller {
    public function Index(){
        $this->affair_hot = AffairTool::getAllAffairs();
        $this->services_hot = ServiceTool::getAllServices();
        $this->needs_hot = NeedTool::getAllNeeds();
        $this->display();
    }
    
    public function StartACounty(){
        $this->display();
    }
    
    public function Navigation(){
        $this->display();
    }
    
    public function SuggestSite(){
        $this->display();
    }
}
?>