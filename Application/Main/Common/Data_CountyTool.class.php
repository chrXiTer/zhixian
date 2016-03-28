<?php
namespace Main\Common;

class Data_CountyTool{
	static public function getAllCounty(){
		$filenameProvinceCodeToName = __ROOT__."Application/Home/Common/positionJson/provinceCodeToName.json";
		$jsonStrProvinceCodeToName = file_get_contents($filenameProvinceCodeToName);
		$provinceCodeToNameObj = json_decode($jsonStrProvinceCodeToName);
		$countyNameToSpellingObj = Data_CountyTool::getCountyNameToSpellingObj();

		$allCountys = array();
		foreach($provinceCodeToNameObj as $provinceCode => $provinceName){
			$countyFilename = __ROOT__."Application/Home/Common/positionJson/county/$provinceCode.json";
			$countyJsonStr = file_get_contents($countyFilename);
			$countyArray = json_decode($countyJsonStr);
			$countyInProvince = array();
			foreach($countyArray as $countyValue){
				$countyName = $countyValue->county_name;
				$countySpelling = $countyNameToSpellingObj[$countyName];
				if(!isset($countySpelling)){
					$countySpelling = "sss";
				}
				$countyInProvince[$countyValue->city_name][$countyName] = "$countySpelling"; //数组会自动创建
			}
			$allCountys[$provinceName] = $countyInProvince;
		}
		$x_exist = M();
		$existedCountys = $x_exist->query("SHOW TABLES Like 'cx_x_%_service'");
		$existedCountysObj = array();
		foreach($existedCountys as $item){
			$countyName = $item["tables_in_app_hyfww (cx_x_%_service)"];
			$existedCountysObj[$countyName] = $countyName;
		}
		$data["existedCountys"] = $existedCountysObj;
		$data["allCountys"]= $allCountys;
	    return $data;
	}

	static public function getCountyNameToSpellingObj(){
		$filenameCountyNameToSpelling = __ROOT__."Application/Home/Common/positionJson/countyNameToSpelling.json";
		$jsonStrCountyNameToSpelling = file_get_contents($filenameCountyNameToSpelling);
		$countyNameToSpellingObj = json_decode($jsonStrCountyNameToSpelling,true);
		return $countyNameToSpellingObj;
	}
	
	static public function getCountySpellingToNameObj(){
		$filenameCountyNameToSpelling = __ROOT__."Application/Home/Common/positionJson/countySpellingToName.json";
		$jsonStrCountyNameToSpelling = file_get_contents($filenameCountyNameToSpelling);
		$countyNameToSpellingObj = json_decode($jsonStrCountyNameToSpelling,true);
		return $countyNameToSpellingObj;
	}
};
?>