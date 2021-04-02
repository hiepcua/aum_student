<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.lop.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');

if(isset($_POST['lop'])){
	$id_khoa 	= isset($_POST['id_khoa'])?addslashes(strip_tags($_POST['id_khoa'])):"";
	$id_he 		= isset($_POST['id_he'])?addslashes(strip_tags($_POST['id_he'])):"";
	$id_nganh 	= isset($_POST['id_nganh'])?addslashes(strip_tags($_POST['id_nganh'])):"";
	$lop 		= isset($_POST['lop'])?addslashes(strip_tags(trim($_POST['lop']))):"";
	if($lop=="") die("nodata");
	$lop = un_unicode($lop);
	$obj = new CLS_MYSQL;
	// check lớp đã có chưa
	$sql = "SELECT id FROM tbl_lop 
			WHERE id_khoa='$id_khoa' AND id_he='$id_he' AND id_nganh='$id_nganh' AND id='$lop' ";
	$obj->Query($sql); 
	if($obj->Num_rows()>0) die("exist");
	
	// insert
	$cdate = time();
	$sql="INSERT INTO tbl_lop (id,id_nganh,id_he,id_khoa,cdate) 
			VALUES ('$lop','$id_nganh','$id_he','$id_khoa',$cdate)";
	$obj = new CLS_MYSQL;
	$result1 = $obj->Query($sql);

	if($result1) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
} ?>