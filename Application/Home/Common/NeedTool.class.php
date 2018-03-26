<?php
namespace Home\Common;

use Common\Common\AccountTool;

class NeedTool{
        
    static private function getNeedById($id){
        $id = (int)$id;
        $needM = M("x_need");
        $result = $needM->where("id=".$id)->select();
        if($result === false){
            return null;
        }else if(count($result)===0) {
            return null;
        }else{
            return $result[0];
        }
    }
    
    static private function getAllCommentOfANeed($needId){
        $needM = M();
        $result= $needM->query('
            SELECT c.* , u1.UserName AS Author, u2.UserName AS PreCommentName
            FROM (       
                SELECT * 
                FROM cx_x_need_comment
                WHERE NeedId = '.$needId.'
            ) AS c
            INNER JOIN cx_x_user AS u1 ON u1.Id = c.AuthorId
            LEFT JOIN cx_x_user AS u2 ON u2.Id = c.PreCommentId
        ');
        return $result;
    }
    
    //////////////////////////////////////////////////////////
    ///  public api ⬇️
    ///////////////////////////////////////////////////////////
    static public function getAllNeeds(){
        $needM = M("x_need");
        $needs = $needM->select();
		return $needs;
    }
    
    static public function getANeed($needId){
        $data = array();
        $data["need"] = NeedTool::getNeedById($needId);
        $data["comments"] = NeedTool::getAllCommentOfANeed($needId);
                
        $data["publisher"] = AccountTool::getUserById($data["need"]["publisherid"]);
        $currentUser = AccountTool::getCurrentUser();
        $data["isLogin"] = isset($currentUser);
        $data["isMyself"] = ($currentUser["username"] === $data["need"]["publisher"]["username"]);
        return $data;
    }
    
    static public function AddANeed($data){
        $needM = M('x_need');
        if($Service->create()){
            $Service->PublisherId = $data->PublisherId;
            $result = $Service->add(); // 写入数据到数据库 
            if($result){
                $insertId = $result;// 如果主键是自动增长型 成功后返回值就是最新插入的值
                redirect("/Home/Service/DisplayAService/".$insertId,2,"服务发布成功");
            }
        }
    }
    
    static public function DeleteANeedById($needId){
		$needM = M("x_need");
		$result = $needM->where('Id='.$needId)->delete();
		return $result;
	}
}
?>