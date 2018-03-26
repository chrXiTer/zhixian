<?php
namespace Home\Common;

use Common\Common\AccountTool;

class ServiceTool{
    static private function getAService($serviceId){
        $data = array();
        $currentUser = AccountTool::getCurrentUser();
        $data["service"] = ServiceTool::getServiceById($serviceId);
        $data["service"]["publisher"] = AccountTool::getUserById($data["service"]["publisherid"]);
        $data["service"]["currentSeviceType"] = ServiceTool::getAServiceType($data["service"]["typeid"]);
        $data["isLogin"] = isset($currentUser);
        $data["isMyself"] = ($currentUser["username"] === $data["service"]["publisher"]["username"]);
        $imgsUrl = explode(";", $data["service"]["imgsurl"]);
        array_pop($imgsUrl); //直接使用$this->ImgsUrl进行pop操作会无效。
        $data["service"]["ImgsUrl"] = $imgsUrl;
        return $data;
    }
    
    static private function getAllCommentOfAService($serviceId){
        $serviceM = M();
        $result= $serviceM->query('
            SELECT c.* , u1.UserName AS Author, u2.UserName AS PreCommentName
            FROM (       
                SELECT * 
                FROM cx_x_service_comment
                WHERE ServiceId = '.$serviceId.'
            ) AS c
            INNER JOIN cx_x_user AS u1 ON u1.Id = c.AuthorId
            LEFT JOIN cx_x_user AS u2 ON u2.Id = c.PreCommentId
        ');
        return $result;
    }

    /////////////////////////////////////////
    ////////
    ////////////////////////
	static public function getAllServices(){
		$serviceM = M("x_service");
        $services = $serviceM->select();
		return $services;
	}
    
    static public function getServiceById($id){
        $id = (int)$id;
        $Service = M("x_service");
        $result = $Service->where("id=".$id)->select();
        if($result === false){//数据库查询发生错误
            return null;
        }else if(count($result)===0) {//服务未找到:
            return null;
        }else{
            return $result[0];
        }
    }
    
    
    static public function getAserviceToDisplay($serviceId){
        $data = ServiceTool::getAService($serviceId);
        $data["comments"] = ServiceTool::getAllCommentOfAService($serviceId);
        return $data;
    }
    
    static public function getAServiceToEdite($serviceId){
        $data = ServiceTool::getAService($serviceId);
        $data["serviceTypes"] = ServiceTool::getAllServiceTypes();
        return $data;
    }

    static public function DeleteAServiceById($serviceId){
		$serviceM = M("x_service");
		$result = $serviceM->where('Id='.$serviceId)->delete();
		return $result;
	}

    static public function UpdataAService($entryId, $newData){
		$serviceM = M("x_service");
		$dataOld = $serviceM->where("id=$entryId")->select();
		$dataOld = $dataOld[0];
		
        $dataToHistory['Name'] = $dataOld['name'];
        $dataToHistory['TypeId'] = $dataOld['typeid'];
        $dataToHistory['Introduction'] = $dataOld['introduction'];
        $dataToHistory['Contacts'] = $dataOld['contacts'];
        $dataToHistory['Phone'] = $dataOld['phone'];
        $dataToHistory['Address'] = $dataOld['address'];
        $dataToHistory['ImgsUrl'] = $dataOld['imgsurl'];
        
		$serviceHistoryM = M("x_service_history");
		$result_1 = $serviceHistoryM->add($dataToHistory);
        
        $data['Name'] = $newData['Name'];
        $data['ServiceId'] = $entryId;
        $data['TypeId'] = $newData['TypeId'];
        $data['Introduction'] = $newData['Introduction'];
        $data['Contacts'] = $newData['Contacts'];
        $data['Phone'] = $newData['Phone'];
        $data['Address'] = $newData['Address'];
        $data['ImgsUrl'] = $newData['ImgsUrl'];
		
		$result_2 = $serviceM->where("id=$entryId")->save($data);

		if($result_1 == null  || $result_2 == null){
			return null;
		}else{
			return $result_2;
		}
	}
/////////////////////////////////////////
////////
////////////////////////
	static public function getAllServiceTypes($orderStr = null, $whereStr = null){
        $ServiceType = M("x_service_type");
        $result = $ServiceType;
        if(!empty($whereStr)){
            $result = $ServiceType->where($whereStr);
        }
        if(!empty($orderStr)){
            $result = $result->order($orderStr);
        }
        $result = $result->select();
        if($result === false){
            //数据库查询发生错误:
            return null;
        }else{
            return $result;
        }
    }
    
    static public function getServiceTypesUsing($allServiceTypes){
        $result = array_filter($allServiceTypes, function($var){
                return $var["status"] === "使用中";
            });
        return array_values(array_values);
    }
    
    static public function getServiceTypesNotUsed($allServiceTypes){
        $result = array_filter($allServiceTypes, function($var){
            return $var["status"] === "未启用";
            });
        return array_values(array_values);
    }
    
    static public function getServiceTypesHasStoped($allServiceTypes){
        $result = array_filter($allServiceTypes, function($var){
                return $var["status"] === "已停用";
            });
        return array_values(array_values);
    }
    
    static public function getRootServiceTypes(){
        $serviceTypes = ServiceTool::getAllServiceTypes();
        $rootServiceTypes = array_filter($serviceTypes, function($var){
            return $var["parentid"] == 0;
        });
        return array_values($rootServiceTypes);//数组的key值无用，且必须保证数组转换为json之后还是🔢。
    }
    
    static public function getAServiceType($typeId){
        $typeId = (int)$typeId;
        $serviceTypeM = M("x_service_type");
        $result = $serviceTypeM->where("id=".$typeId)->select();
        if($result === false){
           // 数据库查询发生错误
            return null;
        }else if(count($result)===0) {
            //服务类型未找到
            return null;
        }else{
            return $result[0];
        }
    }
     
    //参数$serviceTypes：  一个数组，每个元素对应一个分类
    //返回值：    一个数组，每个元素（0）是同一分类下的所有子类元素（1）的数组。
    //           元素（1）包括value和child两个属性，child为元素（1）的各个子类元素（2）组成的数组。
    //           元素（2）形式与元素（1）相同
    //    returnValue[0] 正好为所有元素组成的树    returnValue[typeId] 正好为type类元素组成的树
    static public function getTypeTree($serviceTypes){  
        //echo "<br/><br/><br/><br/><br/><br/>";
        //print_r($serviceTypes);
        $arrayRoot_a = array();
        $n = count($serviceTypes);
        foreach($serviceTypes as $var){
            if(!isset($arrayRoot_a[$var["parentid"]])){
                $arrayRoot_a[$var["parentid"]] = array();
            }
            $arrayRoot_a[$var["parentid"]][] = array(
                "value" => $var,
                "child" => null
            );
        }
        foreach($arrayRoot_a as $key => &$var){
            foreach($arrayRoot_a[$key] as &$var2){
                $id = $var2['value']["id"];
                if($var2['value']["id"] != 0 //id == 0 表示“未分类”，没有子分类。 ParentId == 0 表示一级分类，没有父分类
                and array_key_exists($id,$arrayRoot_a)){ //要求一个类型存在子类，才把子类挂载上来
                    $var2["child"] = $arrayRoot_a[$id];
                }
            }
        }
        return $arrayRoot_a;
    }
    
    static public function getAllChildrenFromTree_a($serviceTypes_one){
        $children = array();
        $oldAdd = array_filter($serviceTypes_one);
        $newAdd = array();
        while(count($oldAdd) > 0){
            foreach($oldAdd as $var){
                if($var["child"] != null ){
                    $newAdd = array_merge($newAdd, $var["child"]);
                    //print_r($newAdd);
                }
            }
            $children = array_merge($children, $newAdd);
            $oldAdd = $newAdd;
            $newAdd = array();
        }
        return $children;
    }
};

?>