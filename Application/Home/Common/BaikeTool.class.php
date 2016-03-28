<?php
namespace Home\Common;

class BaikeTool{
	static public function getAEntry($entryId){
        $baikeM = M('x_'.COUNTY_SPELLING."_baike");
        $data = $baikeM->where("id=$entryId")->select();
		return $data[0];
	}
	
	static public function updataAEntry($entryId, $newData){
		$baikeM = M('x_'.COUNTY_SPELLING."_baike");
		$dataOld = $baikeM->where("id=$entryId")->select();
		$dataOld = $dataOld[0];
		
		$dataToHistory["BaikeId"] = $dataOld["id"];
		$dataToHistory["Version"] = $dataOld["version"];
		$dataToHistory["EditorId"] = $dataOld["editorid"];
		$dataToHistory["Title"] = $dataOld["title"];
		$dataToHistory["Content"] = $dataOld["content"];
        $dataToHistory["Type"] = $dataOld["type"];
		$baikeHistoryM = M('x_'.COUNTY_SPELLING."_baike_history");
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
		$baikeM = M('x_'.COUNTY_SPELLING."_baike");
		$data = $baikeM->field('Id,Title,Type')->select();
		return $data;
	}
	
	static public function AddAEntry($title, $content){
		$currentUser = AccountTool::getCurrentUser();

		$baikeM = M('x_'.COUNTY_SPELLING."_baike");
        $data["Title"] = $title;
		$data["Content"] = $content;
		$data["EditorId"] = $currentUser["id"];
		$addedEntryId = $baikeM->add($data);
		return $addedEntryId;
	}
};

?>
