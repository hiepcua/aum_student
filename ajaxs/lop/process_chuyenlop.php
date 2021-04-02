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

if(isset($_POST['lop_moi'])){
	$id = isset($_POST['id'])?(int)$_POST['id']:-1;
	$masv = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):"";
	$lop_cu = isset($_POST['lop_cu'])?addslashes(strip_tags($_POST['lop_cu'])):"";
	$lop_moi = isset($_POST['lop_moi'])?addslashes(strip_tags($_POST['lop_moi'])):"";
	if($lop_cu=="" || $lop_moi=="") die("nodata");
	
	// update dữ liệu malop mới
	$cdate = time();
	$sql="UPDATE tbl_dangky_tuyensinh SET malop='$lop_moi',mdate='$cdate' WHERE id='$id'";
	$obj = new CLS_MYSQL;
	$obj->Query($sql);
	
	// note notify
	$note = "Mã SV #$masv chuyển từ lớp $lop_cu sang lớp $lop_moi";
	$sql = "INSERT INTO tbl_notify (masv,notes,cdate,author) VALUES('$masv','$note',$cdate,'$user')";
	$obj->Exec($sql); //echo $sql;
	
	// cập nhập lại học phí. lấy các học phí đã nộp bên lớp cũ (hủy học phí chưa nộp)
	$sql = "DELETE FROM tbl_hocphi WHERE masv='$masv' AND ispay=0";
	$obj->Exec($sql);
	
	// lấy danh mục học phí đã nộp
	$sql = "SELECT * FROM tbl_hocphi WHERE masv='$masv' AND ispay=1";
	$obj->Query($sql);
	$arrHocPhiCu=array();
	while($r=$obj->Fetch_Assoc()){
		$arrHocPhiCu[$r['ma_hp']]=$r;
	}
	// cập nhập học phí chưa nộp tồn tài ở lớp mới
	$sql="SELECT hocphi FROM tbl_he WHERE id='$id_he'";
	$obj->Query($sql);   
	$r = $obj->Fetch_Assoc();
	$hocphi=$r['hocphi'];
	
	// select chương trình học của lớp đó
	$sql = "SELECT * FROM tbl_chuongtrinhhoc WHERE id_lop='$lop_moi'";
	$obj->Query($sql);  
	
	while($r = $obj->Fetch_Assoc()) {
		$mon = $r['id_monhoc'];
		$tc = $r['tinchi'];
		$hk	= $r['hocky'];
		if(!isset($arrHocPhiCu[$mon])){
		// Tạo chương trình học cho sinh viên
		$sql = "INSERT INTO tbl_hoctap(`masv`,`id_monhoc`,`tinchi`,status) VAlUES ('$masv','$mon','$tc',null)";
		$obj->Exec($sql);
		}
		// Tạo học phí theo tín chỉ cho sinh viên 
		$ma_hp=$mon;
		$type_hp='hoc_phan';
		$ten_hp='hoc chinh';
		$money=$hocphi*$tc;
		if(!isset($arrHocPhiCu[$mon])){
			$sql="INSERT INTO tbl_hocphi(`masv`,`hocky`,`hocphi`,`ma_hp`,`ten_hp`,`type_hp`,`ispay`) 
			VAlUES('$masv','$hk','$money','$ma_hp','$ten_hp','$type_hp','0')";
			$obj->Exec($sql);
		}
	}
	
	echo "success";
} ?>