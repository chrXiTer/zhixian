<?php
use Home\Common\Data_CountyTool;

$st =   new SaeStorage();
$cc = COUNTY_SPELLING;

return array(

//配置数据库信息
'DB_PREFIX' => 'cx_', // 数据库表前缀 
'DB_CHARSET'=> 'utf8', // 字符集
'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志

'TMPL_PARSE_STRING'=>array(
	//'/Public/upload' => $st->getUrl('zhixin001','upload'),
	'COUNTY_SPELLING' => $cc
	),


);
?>

