<?php
use Main\Common\Data_CountyTool;
$ss =  Data_CountyTool::getCountySpellingToNameObj();
$dd = $ss[COUNTY_SPELLING];

return array(
	//'配置项'=>'配置值'
    //'SHOW_PAGE_TRACE' =>false, 
    
    'DEFAULT_MODULE'        =>  'Main',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Main', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'Index', // 默认操作名称
    "COUNTY_NAME" 			=> $dd
);
?>