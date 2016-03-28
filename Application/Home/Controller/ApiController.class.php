<?php
namespace Home\Controller;
use Think\Controller;
use Common\Common\AccountTool;
use Home\Common\ServiceTool;
use Home\Common\AffairTool;
use Home\Common\BaikeTool;
use Home\Common\NewsTool;
use Home\Common\NeedTool;

class ApiController extends Controller {
    public function UploadFile(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->rootPath  =     './zhixian001/'; // 设置附件上传根目录
        $savePath = I("path");
        if($savePath === "AddAService"){
            $userId = AccountTool::getCurrentUser()["id"];
            $savePath = "/Public/upload/".$userId."/".$savePath."/";
        }else{
            $savePath = "/Public/upload/".$savePath."/";
        }
        $upload->savePath = $savePath; // 设置附件上传（子）目录
        $upload->subName = '';//默认会在最后一个目录中间加日期, 如果前面的$SavePath没有以/结尾（设为‘’最底层目录不好创建，设为“／”保存目录会多一个／）
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            echo $upload->getError();
        }else{// 上传成功
            $JSONReturn =   
                json_encode(array(
                    "status" => "ok",
                    "imgUrl" => $info["fileToUpload"]["url"],
                    "savename" => $info["fileToUpload"]["savename"],
                    "savepath" => $info["fileToUpload"]["savepath"],
                    )); 
            echo $JSONReturn;
        }
    }
    
    public function GetIndex(){
        $affair_hot = AffairTool::getAllAffairs();
        $services_hot = ServiceTool::getAllServices();
        $serviceTypes_root = ServiceTool::getRootServiceTypes();
        $resultJsonStr = json_encode(array(
            "affair_hot"=>$affair_hot,
            "services_hot"=>$services_hot,
            "serviceTypes_root"=>$serviceTypes_root
        ));
        echo $resultJsonStr;
    }
    
    public function GetServiceTypes(){
        $serviceTypes = ServiceTool::getAllServiceTypes();
        $resultJsonStr = json_encode($serviceTypes);
        echo $resultJsonStr;
    }
    
    public function GetAAffair(){
        $affairId = (int)I("path.2");
        $affairM = M('x_'.COUNTY_SPELLING."_Affair");
        $affair = $affairM->where("id=".$affairId)->select()[0];
		
		$Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
		$neededServiceTypes = $Model->query(
			"SELECT * FROM cx_service_type WHERE id IN "
				."(SELECT serviceTypeId FROM cx_x_".COUNTY_SPELLING."_affair_service_type WHERE affairId =".$affairId.")"
		);
        $resultJsonStr = json_encode(array(
            "affair"=>$affair,
            "neededServiceTypes"=>$neededServiceTypes,
        ));
        echo $resultJsonStr;
    }
    
    public function GetAService(){
        $_id = (int)I("path.2");
        $data = (object)null;
        $data->service = ServiceTool::getServiceById($_id);
        $data->currentSeviceType = ServiceTool::getAServiceType($data->service["typeid"]);
        $data->publisher = AccountTool::getUserById($data->service["publisherid"]);
        $currentUser = AccountTool::getCurrentUser();
        $data->isMyself = ($currentUser["username"] === $data->publisher["username"]);
        $imgsUrl = explode(";", $data->service["imgsurl"]);
        array_pop($imgsUrl); //直接使用$this->ImgsUrl进行pop操作会无效。
        $data->ImgsUrl = $imgsUrl;
        $resultJsonStr = json_encode($data);
        echo $resultJsonStr;
    }
    
    public function GetAServiceType(){
        $data = (object)null;
        $typeId = (int)I("path.2");
        $serviceM = M('x_'.COUNTY_SPELLING."_service");
        $serviceTypeM = M('x_'.COUNTY_SPELLING."_service_type");
        
        $data->serviceType = ServiceTool::getAServiceType($typeId);
        $data->childrenServiceTypes = $serviceTypeM->where("ParentId=".$typeId)->select();
        $data->childrenServices = $serviceM->where("TypeId=".$typeId)->select();
        
        $resultJsonStr = json_encode($data);
        echo $resultJsonStr;
    }
    
    public function GetAUserProfile(){
        $userName = I("path.2");//要显示的用户
        $data = AccountTool::getProfile($userName);
        $resultJsonStr = json_encode($data);
        echo $resultJsonStr;
    }

    public function AddAService(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        
        $postJsonStr = file_get_contents("php://input");
        $serviceM = M('x_'.COUNTY_SPELLING.'_service');
        $postObj = json_decode($postJsonStr);
        if($serviceM->data($postObj)){
            $serviceM->PublisherId = $currentUser["id"];
            $newServiceId = $serviceM->add(); // 写入数据到数据库 
            if($newServiceId){
                echo '{"status": "success", "newServiceId": '.$newServiceId.'}';
            }else{
                echo '{"status": "error", "info": "no info"}';
            }
        }
    }
    
    public function AddANeed(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        
        $postJsonStr = file_get_contents("php://input");
        $postObj = json_decode($postJsonStr);
        $NeedM = M('x_'.COUNTY_SPELLING.'_need');
        if($NeedM->data($postObj)){
            $NeedM->PublisherId = $currentUser["id"];
            $newNeedId = $NeedM->add(); // 写入数据到数据库 
            if($newNeedId){
                echo '{"status": "success", "newNeedId": '.$newNeedId.'}';
            }else{
                echo '{"status": "error", "info": "no info"}';
            }
        }
    }
    
    public function AddANews(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        
        $postJsonStr = file_get_contents("php://input");
        $postObj = json_decode($postJsonStr);
        $addedNewsId = NewsTool::AddANews($postObj->title, $postObj->content);
        if(isset($addedNewsId)){
            echo '{"status": "success", "addedNewsId": '.$addedNewsId.'}';
        }else{
            echo '{"status": "error", "info": "no info"}';
        }
    }

    public function AddACommentInService(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        $postJsonStr = file_get_contents("php://input");
        $postObj = json_decode($postJsonStr);
        if($postObj->commentContent){
            $serviceCommentM = M('x_'.COUNTY_SPELLING."_service_comment");
            $currentUser = AccountTool::getCurrentUser();
            $data["Content"] = $postObj->commentContent;
            $data["ServiceId"] = $postObj->serviceId;
            $data["AuthorId"] = $currentUser["id"];
            $serviceCommentM->add($data);
            $resultObj = array(
                authorId => $currentUser["id"],
                authorName => $currentUser["username"],
                content => $postObj->commentContent
            );
            $resultJsonStr = json_encode($resultObj);
            echo $resultJsonStr;
        } 
    }
    
    public function AddACommentInNeed(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        $postJsonStr = file_get_contents("php://input");
        $postObj = json_decode($postJsonStr);
        if($postObj->commentContent){
            $serviceCommentM = M('x_'.COUNTY_SPELLING."_need_comment");
            $currentUser = AccountTool::getCurrentUser();
            $data["Content"] = $postObj->commentContent;
            $data["NeedId"] = $postObj->needId;
            $data["AuthorId"] = $currentUser["id"];
            $serviceCommentM->add($data);
            $resultObj = array(
                authorId => $currentUser["id"],
                authorName => $currentUser["username"],
                content => $postObj->commentContent
            );
            $resultJsonStr = json_encode($resultObj);
            echo $resultJsonStr;
        }
    }
    
    public function UserCheck(){ //相当与移动端的login，
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            echo '{"status" : "fail"}';
        }else{
            echo '{"status" : "success"}';
        }
    }
    
    public function Register(){
    }
       
    public function EditBaike(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        
        $entryId = I("path.2");
        $postJsonStr = file_get_contents("php://input");
        $postObj = json_decode($postJsonStr, true);
        $result = BaikeTool::updataAEntry($entryId, $postObj);
        if($result === null){
            echo '{"status": "error"}';
        }else{
            echo '{"status": "success"}';
        }
    }
    
    public function EditAService(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        
        $serviceId = I("path.2");
        $postJsonStr = file_get_contents("php://input");
        $postObj = json_decode($postJsonStr, true);
        $result = ServiceTool::updataAService($serviceId, $postObj);
        if($result === null){
            echo '{"status": "error"}';
        }else{
            echo '{"status": "success"}';
        }
    }
    
    public function DeleteAAfairById(){
        $Id = (int)I("path.2");
        $result = AffairTool::DeleteAAfairById($Id);
        if($result == 1){
            echo '{"status": "ok"}';
        }else if($result == 0){
            echo '{"status": "no record deleted"}';
        }else{
            echo '{"status": "error"}';
        }
    }
    
    public function DeleteAServiceTypeFromAfair(){
        $AffairId = (int)I("path.2");
        $serviceTypeId = (int)I("path.3");
        $result = AffairTool::DeleteAServiceTypeFromAfair($AffairId, $serviceTypeId);
        if($result == 1){
            echo '{"status": "ok"}';
        }else if($result == 0){
            echo '{"status": "no record deleted"}';
        }else{
            echo '{"status": "error"}';
        }
    }
    
    public function DeleteANeedById(){
        $Id = (int)I("path.2");
        $result = NeedTool::DeleteANeedById($Id);
        if($result == 1){
            echo '{"status": "ok"}';
        }else if($result == 0){
            echo '{"status": "no record deleted"}';
        }else{
            echo '{"status": "error"}';
        }
    }
    
    public function DeleteAServiceById(){
        $Id = (int)I("path.2");
        $result = ServiceTool::DeleteAServiceById($Id);
        if($result == 1){
            echo '{"status": "ok"}';
        }else if($result == 0){
            echo '{"status": "no record deleted"}';
        }else{
            echo '{"status": "error"}';
        }
    }
    
    public function DeleteANewsById(){
        $Id = (int)I("path.2");
        $result = NewsTool::DeleteANewsById($Id);
        if($result == 1){
            echo '{"status": "ok"}';
        }else if($result == 0){
            echo '{"status": "no record deleted"}';
        }else{
            echo '{"status": "error"}';
        }
    }
    
    public function AddAEntry(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === null){
            exit('{"error"：“User Not Login”}');
        }
        
        $postJsonStr = file_get_contents("php://input");
        $postObj = json_decode($postJsonStr);
        $addedEntryId = BaikeTool::AddAEntry($postObj->title, $postObj->content);
        if(isset($addedEntryId)){
            echo '{"status": "success", "addedEntryId": '.$addedEntryId.'}';
        }else{
            echo '{"status": "error", "info": "no info"}';
        }
    }
    
}
?>