<?php
namespace Main\Controller;
use Think\Controller;
use Common\Data_CountyTool;

class MainController extends Controller {
    public function Index(){
        $this->display();
    }
    
    public function GoOut(){
        $data = Data_CountyTool::getAllCounty();
        $this->viewData = array(
            existedCountysJson => json_encode($data["existedCountys"]),
            allCountysJson => json_encode($data["allCountys"])
        );
        $this->display();
    }
}
?>