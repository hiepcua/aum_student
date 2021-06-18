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
$user = $objuser->getInfo('user');

$ma_lop = isset($_POST['ma_lop']) ? antiData($_POST['ma_lop']) : '';
$ma_khoa = isset($_POST['cbo_khoa']) ? antiData($_POST['cbo_khoa']) : '';
if($ma_lop!=='' && $ma_khoa!=='') {
	$result = SysEdit('tbl_lop', array('id_khoa'=> $ma_khoa), "id='".$ma_lop."'");
	if($result){
		die('success');
	}else{
		die('error');
	}
}?>