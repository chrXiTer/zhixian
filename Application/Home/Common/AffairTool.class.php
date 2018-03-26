<?php
namespace Home\Common;

class AffairTool{
	static public function getAllAffairs(){
		$affairM = M("x_affair");
        $affairs = $affairM->select();
		return $affairs;
	}
	
	static public function AddAServiceToAffair($affairId,$serviceTypeId){
		$data['AffairId'] = $affairId;
		$data['ServiceTypeId'] = $serviceTypeId;
		$affairServiceType = M("x_affair_service_type");
		$result = $affairServiceType->add($data);
		return $result;
	}

	static public function DeleteAAfairById($affairId){
		$affairM = M("x_affair");
		$result = $affairM->where('Id='.$affairId)->delete();
		return $result;
	}

	static public function DeleteAServiceTypeFromAfair($AffairId, $serviceTypeId){
		$affairServiceTypeM = M("x_affair_service_type");
		$result = $affairServiceTypeM->where('AffairId='.$AffairId.' and ServiceTypeId='.$serviceTypeId)->delete();
		return $result;
	}
};

?>