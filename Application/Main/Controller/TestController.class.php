<?php
namespace Main\Controller;
use Think\Controller;

class TestController extends Controller {
    public function Index(){
        echo '<br/><br/><br/><br/>';
        echo "服务器地址 SAE_MYSQL_HOST_M: ".SAE_MYSQL_HOST_M.','.SAE_MYSQL_HOST_S.'<br/>';
        echo "数据库名 SAE_MYSQL_DB: ".SAE_MYSQL_DB.'<br/>';
        echo "用户名 SAE_MYSQL_USER: ".SAE_MYSQL_USER.'<br/>';
        echo "密码 SAE_MYSQL_PASS: ".SAE_MYSQL_PASS.'<br/>';
        echo "端口 SAE_MYSQL_PORT: ".SAE_MYSQL_PORT.'<br/>';
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