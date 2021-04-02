<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../global/libs/gffunc_edu.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
$obj=new CLS_MYSQL;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');

if(isset($_POST['mon'])){
	$he 	= isset($_POST['he'])?$_POST['he']:"";
	$nganh 	= isset($_POST['nganh'])?(int)$_POST['nganh']:"";
	$lop 	= isset($_POST['lop'])?addslashes(strip_tags($_POST['lop'])):"";
	$mon 	= isset($_POST['mon'])?addslashes(strip_tags($_POST['mon'])):"";
	$hk 	= isset($_POST['hk'])?(int)$_POST['hk']:1;
	$tc 	= isset($_POST['tc'])?(int)$_POST['tc']:1;
	if($lop=="" || $mon=="" || $hk=="" || $tc=="") die("nodata");
	//tbl_chuongtrinhhoc
	$obj->Exec("BEGIN");
	$sql="INSERT INTO tbl_chuongtrinhhoc(`id_lop`,`id_monhoc`,`hocky`,`tinchi`) 
		  VALUES('$lop','$mon','$hk','$tc')";
	$result1 = $obj->Exec($sql); 
	
	//get masv
	$arr_ma = getMaSV($lop); 

	$sql="SELECT hocphi FROM tbl_he WHERE id='$he'";
	$obj->Query($sql);  
	$r = $obj->Fetch_Assoc();
	$hocphi=$r['hocphi'];
	$money=$hocphi*$tc;
	foreach($arr_ma as $ma) {
		// Tạo chương trình học cho sinh viên trong lớp
		$sql = "INSERT INTO tbl_hoctap(`masv`,`id_monhoc`,`tinchi`,`status`) 
				VAlUES('$ma','$mon','$tc','-1')";
		$result2 = $obj->Exec($sql); 

		// Tạo học phí theo tín chỉ
		$ma_hp=$mon;
		$type_hp='hoc_phan';
		$ten_hp='hoc chinh';
		$sql="INSERT INTO tbl_hocphi(`masv`,`hocky`,`hocphi`,`ma_hp`,`ten_hp`,`type_hp`,`ispay`) 
		VAlUES('$ma','$hk','$money','$ma_hp','$ten_hp','$type_hp','0')";
		$result3 = $obj->Exec($sql); 
	}
	
	if($result1) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
	
} ?>