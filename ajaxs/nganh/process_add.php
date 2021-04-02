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
if(isset($_POST['ma_nganh'])) {
	$ma_nganh = isset($_POST['ma_nganh'])?addslashes(strip_tags($_POST['ma_nganh'])):'';
	$code = isset($_POST['code'])?addslashes(strip_tags($_POST['code'])):'';
	$name = isset($_POST['name'])?addslashes(strip_tags($_POST['name'])):'';
	$bac = isset($_POST['bac'])?addslashes(strip_tags($_POST['bac'])):'';
	$khoa = isset($_POST['khoa'])?addslashes(strip_tags($_POST['khoa'])):'';
	$sql = "INSERT INTO tbl_khoa_nganh (name,id_nganh,id_he,id_khoa) 
	VALUES('$name','$ma_nganh','$bac','$khoa')"; //echo $sql;
	$obj = new CLS_MYSQL;
	$result = $obj->Exec($sql);
	if($result) echo "success";
}?>