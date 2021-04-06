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
	$id = isset($_POST['id'])?(int)$_POST['id']:-1;
	$id_khoa = isset($_POST['id_khoa'])?addslashes(strip_tags($_POST['id_khoa'])):"";
	$id_he = isset($_POST['id_he'])?addslashes(strip_tags($_POST['id_he'])):"";
	$id_nganh = isset($_POST['id_nganh'])?addslashes(strip_tags($_POST['id_nganh'])):"";
	$masv = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):"";
	$lop = isset($_POST['lop'])?addslashes(strip_tags($_POST['lop'])):"";
	if($lop=="") die("nodata");
	
	// update dữ liệu malop cho sinh viên
	$cdate = time();
	$sql="UPDATE tbl_dangky_tuyensinh SET malop='$lop',mdate='$cdate' WHERE id='$id'";
	$obj = new CLS_MYSQL;
	$result1 = $obj->Query($sql); //echo $sql.' \n';
	
	// note notify
	$note = "Mã SV #$masv đã được thêm vào lớp $lop";
	$sql = "INSERT INTO tbl_notify (masv,notes,cdate,author) VALUES('$masv','$note',$cdate,'$user')";
	$result2 = $obj->Exec($sql); //echo $sql.' \n';
	
	// lấy dữ liệu học phí tín chỉ
	$sql="SELECT hocphi FROM tbl_he WHERE id='$id_he'";
	$obj->Query($sql);   
	$r = $obj->Fetch_Assoc();
	$hocphi=$r['hocphi'];
	// select chương trình học của lớp đó
	$sql = "SELECT * FROM tbl_chuongtrinhhoc WHERE id_lop='$lop'";
	$obj->Query($sql);  
	while($r = $obj->Fetch_Assoc()) {
		$mon = $r['id_monhoc'];
		$tc = $r['tinchi'];
		$hk	= $r['hocky'];
		// Tạo chương trình học cho sinh viên
		$sql="INSERT INTO tbl_hoctap(`masv`,`id_monhoc`,`tinchi`,status) 
				VAlUES('$masv','$mon','$tc',null)";
		$obj->Exec($sql); //echo $sql.' \n';

		// Tạo học phí theo tín chỉ cho sinh viên 
		$ma_hp=$mon;
		$type_hp='hoc_phan';
		$ten_hp='hoc chinh';
		$money=$hocphi*$tc;
		$sql="INSERT INTO tbl_hocphi(`masv`,`hocky`,`hocphi`,`ma_hp`,`ten_hp`,`type_hp`,`ispay`) 
		VAlUES('$masv','$hk','$money','$ma_hp','$ten_hp','$type_hp','0')";
		$obj->Exec($sql); //echo $sql.' \n';
	}
	
	echo "success";

} ?>