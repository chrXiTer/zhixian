<?php
namespace Home\Common;
use Common\Common\AccountTool;

class BaikeTool{
	static public function getAEntry($entryId){
        $baikeM = M("x_baike");
        $data = $baikeM->where("id=$entryId")->select();
		return $data[0];
	}
	
	static public function updataAEntry($entryId, $newData){
		$baikeM = M("x_baike");
		$dataOld = $baikeM->where("id=$entryId")->select();
		$dataOld = $dataOld[0];
		
		$dataToHistory["BaikeId"] = $dataOld["id"];
		$dataToHistory["Version"] = $dataOld["version"];
		$dataToHistory["EditorId"] = $dataOld["editorid"];
		$dataToHistory["Title"] = $dataOld["title"];
		$dataToHistory["Content"] = $dataOld["content"];
        $dataToHistory["Type"] = $dataOld["type"];
		$baikeHistoryM = M("x_baike_history");
		$result_1 = $baikeHistoryM->add($dataToHistory);
		
		$data["Titile"] = $newData["title"];
		$data["Content"] = $newData["content"];
		$data["Version"] = $dataOld["version"] + 1;
		$result_2 = $baikeM->where("id=$entryId")->save($data);

		if($result_1 == null  || $result_2 == null){
			return null;
		}else{
			return $result_2;
		}
	}
	
	static public function getAllEntryForTitle(){
		$baikeM = M("x_baike");
		$data = $baikeM->field('Id,Title,Type')->select();
		return $data;
	}
	
	static public function AddAEntry($title, $content){
		$currentUser = AccountTool::getCurrentUser();

		$baikeM = M("x_baike");
        $data["Title"] = $title;
		$data["Content"] = $content;
		$data["EditorId"] = $currentUser["id"];
		$addedEntryId = $baikeM->add($data);
		return $addedEntryId;
	}
};

?>
