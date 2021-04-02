<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
if(isset($_POST['field'])) {
	$code = "hoso";
	$field = isset($_POST['field'])?addslashes(strip_tags($_POST['field'])):'';
	// select config 
	$objdata=new CLS_MYSQL;
	$sql = "SELECT `config` FROM tbl_config_hoso WHERE `code`='$code'";
	$objdata->Query($sql);
	$r = $objdata->Fetch_Assoc();
	$n=0;
	if($r['config']!='') {
		$json_hoso = json_decode($r['config'],true);
		$n = count($json_hoso);
	}
	$json_hoso[$n]=$field;
	
	// update config
	$json_hoso = json_encode($json_hoso,JSON_UNESCAPED_UNICODE);
	$sql = "UPDATE tbl_config_hoso SET config='$json_hoso' WHERE `code`='$code'";
	$obj = new CLS_MYSQL;
	$result = $obj->Exec($sql);
	if($result) echo "success";
}?>