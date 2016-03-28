<?php
namespace Common\Common;

use Common\Common\AesTool;

class AccountTool{
    
    static public function setCurrentUser($aUserInfoInTable){
        session("currentUser.Id", $aUserInfoInTable["id"]);
        session("currentUser.UserName", $aUserInfoInTable["username"]);
    }
    
    static private function findAUserById($userId){
        $User = M('User');
        $_id = (int)$userId;
        $result = $User->where("id=".$_id)->select();
        return $result;
    }
    
    static private function findAUser($UserName){
        $User = M('User');
        $where['UserName'] = ':UserName';
        $bind[':UserName'] = $UserName;
        $result = $User->where($where)->bind($bind)->select();
        if($result === false){
            error_log("数据库查询发生错误:".$User->getDbError()."uuu".$User->getLastSql());
        }
        return $result;
    } 
    
   static private function getUserByName($userName){//在isLogin中通过传递$this(控制器)参数调用error，success函数，会找不到
        $result = AccountTool::findAUser($userName);
        if($result === false || count($result) === 0){
            return null;
        }else{
            return $result[0];
        }
    }
    
    /////////////////////////////
    ////
    //////////////////////////////
    static public function getCurrentUser(){
        $currentUserName = session("currentUser.UserName");
        if(isset($currentUserName)){
            $currentUser = AccountTool::getUserByName($currentUserName);
        }
        if(!isset($currentUser) && isset($_SERVER["PHP_AUTH_USER"])){
            $userNamePassword = $_SERVER["PHP_AUTH_USER"];
            $timestamp = $_SERVER["PHP_AUTH_PW"];
            $currentUser = AccountTool::getUserFromHttpAuthorization($userNamePassword, $timestamp);
        }
        if(!isset($currentUser)){
            $currentUser = null;
        }
        return $currentUser;
    }

    static public function getUserById($userId){
        $result = AccountTool::findAUserById($userId);
        if(count($result) === 0){
            return null;
        }else{
            return $result[0];
        }
    }
   
    
    static public function clearCurrentUser(){
        session('currentUser',null);
    }

    static public function getUserFromHttpAuthorization($userNamePassword,$timestamp){
        $userNamePasswordArray = explode("#",$userNamePassword);
        $userNameBase64 = $userNamePasswordArray[0];
        $passwordTimestampMd5 = $userNamePasswordArray[1];
        $userName = base64_decode($userNameBase64);
        
        $user_inServer = AccountTool::getUserByName($userName);
        $passwordTimestampMd5_inServer = md5(
            $user_inServer["password"]."#".$timestamp
        );
        $isCheckSuccess = $passwordTimestampMd5 == $passwordTimestampMd5_inServer;
        if($isCheckSuccess){
            return $user_inServer;
        }else{
            return null;
        } 
    }
 
    static public function register($userName, $password){
        $data = (object)null;
        $result = AccountTool::findAUser($userName);
        if(count($result) !== 0){
            $data->status = "error";
            $data->info = "用户名已经存在。";
            return $data;
        }

        $UserM = M('user');
        $UserData['UserName'] = $userName;
        $UserData['Password'] = $password;
        $result = $UserM->add($UserData); // 写入数据到数据库 
        if($result){
            $insertId = $result;// 如果主键是自动增长型,成功后返回值就是最新插入的值
            AccountTool::setCurrentUser(array(
                id=>$insertId,
                username=>$userName
            ));
            $data->status = "success";
            $data->info = "注册成功";
            return $data;
        }else{
            $data->status = "error";
            $data->info = "数据库操作发生错误:".$UserM->getDbError()."   ".$UserM->getLastSql();
            return $data;
        }
    }
    
    static public function login($userName, $password){
        $user = AccountTool::getUserByName($userName);
        if(!empty($user) && $user['password'] === $password){
            AccountTool::setCurrentUser($user);
            return $user;
        }else{
            return null;
        }
    }
    
    static public function getProfile($userName){
        $data = (object)null;
        $currentUser = AccountTool::getCurrentUser();
        $data->isMyself = false; //发现是显示自己信息时将会改为true
        if($currentUser !== NULL){
            if(!isset($userName) or empty($userName)){
                $userName = $currentUser["username"];
            }
            if($userName === $currentUser["username"]){
                $data->isMyself = true;
            }
        }
        $userToShow = AccountTool::getUserByName($userName);
        $data->UserName = $userToShow["username"];
        $data->RealName = $userToShow["realname"];
        $data->Phone = $userToShow["phone"];
        $data->isAdmin = ($userToShow["role"] === "admin");
        return $data;
    }
    
    static public function currentUserIsAdmin(){
        $currentUser = AccountTool::getCurrentUser();
        if(isset($currentUser) && $currentUser["role"] === "admin"){
            return true;
        }else{
            return false;
        }
    }
    
    static public function getTokenToChatRoom(){
        $key = "zxcghjkl234rfv098ygvyhb876tfvbj876trfdx";
        $currentUser = AccountTool::getCurrentUser();
        $data = array(
            userId => $currentUser["id"],
            userName => $currentUser["username"],
            fromSite => "zhixian"
        );
        $dataJson = json_encode($data);
        echo "******* ".$dataJson." *****<br/ >";
        $token = AesTool::decode($key, $dataJson);
        echo "******* ".$token." *****<br/ >";
        return $token;
    }
};
?>