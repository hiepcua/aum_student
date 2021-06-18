<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');

$ids = isset($_POST['ids']) ? antiData($_POST['ids']) : '';
if($ids!=='') {
	$ids = substr($ids,0,strlen($ids)-1);
	$ids = str_replace(",","','",$ids);

	$date_level_up = time();
	$level = isset($_POST['cbo_status_level'])? antiData($_POST['cbo_status_level']) : '';
	$result = SysEdit('tbl_dangky_tuyensinh', array('status'=> $level, 'date_level_up'=> $date_level_up), "id IN ('".$ids."')");
	if($result){
		die('success');
	}else{
		die('error');
	}
}?>