<?php
namespace Home\Common;

use Common\Common\AccountTool;

class NewsTool{
	static private function getANewsById($newsId){
		$newsId = (int)$newsId;
		$newsM = M('x_'.COUNTY_SPELLING."_news");
		$result = $newsM->where("id=$newsId")->select();
		if($result === false){//数据库查询发生错误
            return null;
        }else if(count($result)===0) {//服务未找到:
            return null;
        }else{
            return $result[0];
        }
	}
	
/////////////////////////////////////////
///
////////////////////////	
	static public function getAllNews(){
		$newsM = M('x_'.COUNTY_SPELLING."_news");
		$result = $newsM->select();
		return $result;
	}
	
	static public function getAllNewsFromCurrentUser(){
		$newsM = M('x_'.COUNTY_SPELLING."_news");
		$currentUser = AccountTool::getCurrentUser();
		$result = $newsM->where('PublisherId = '.$currentUser["id"])->select();
		return $result;
	}

	static public function getANews($newsId){
        $data = array();
        $data["news"] = NewsTool::getANewsById($newsId);                
        $data["publisher"] = AccountTool::getUserById($data["news"]["publisherid"]);
        $currentUser = AccountTool::getCurrentUser();
        $data["isLogin"] = isset($currentUser);
        $data["isMyself"] = ($currentUser["username"] === $data["news"]["publisher"]["username"]);
        return $data;
    }

	static public function AddANews($title, $content){
		$currentUser = AccountTool::getCurrentUser();

		$newsM = M('x_'.COUNTY_SPELLING."_news");
        $data["Title"] = $title;
		$data["Content"] = $content;
		$data["PublisherId"] = $currentUser["id"];
		$addedNewsId = $newsM->add($data);
		return $addedNewsId;
	}
	
	static public function DeleteANewsById($newsId){
		$newsId = (int)$newsId;
		$newsM = M('x_'.COUNTY_SPELLING."_news");
		$result = $newsM->where('Id='.$newsId)->delete();
		return $result;
	}
}

?>