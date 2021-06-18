<?php
session_start();
ini_set("display_errors",1);
require_once('global/libs/gfconfig.php');
require_once('global/libs/gfinit.php');
require_once('global/libs/gffunc.php');
require_once('includes/gfconfig.php');
require_once('libs/cls.mysql.php');

/* Config */
$_LOP = 'AUM0220HNCNBC';
/* Đơn giá một tín chỉ */
$res_he = SysGetList('tbl_he', array('hocphi'), "AND id='AUM'");
$row_he = $res_he[0];
$_HOCPHI = $row_he['hocphi'];

// Get all khoa đã có
$arr_khoa = array();
$res_khoa = SysGetList('tbl_khoa', array('id'), '');
if(count($res_khoa)>0){
	foreach ($res_khoa as $key => $value) {
		$arr_khoa[] = $value['id'];
	}
}

// Get all lop đã có
$arr_lop = array();
$res_lop = SysGetList('tbl_lop', array('id'), '');
if(count($res_lop)>0){
	foreach ($res_lop as $key => $value) {
		$arr_lop[] = $value['id'];
	}
}

// Get all mã hồ sơ đã có
$arr_mahoso = array();
$res_hocsinh = SysGetList('tbl_hocsinh', array('ma'), '');
if(count($res_hocsinh)>0){
	foreach ($res_hocsinh as $key => $value) {
		$arr_mahoso[] = $value['ma'];
	}
}

// Get all mã học viên đã có
$arr_masv = array();
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array('masv'), '');
if(count($res_dkts)>0){
	foreach ($res_dkts as $key => $value) {
		$arr_masv[] = $value['masv'];
	}
}

// Get tổng học phí theo từng mã sinh viên
$sql = "select masv,sum(hocphi) as total,ispay from tbl_hocphi";
if($id_hocky!=='') {
	$params.="&hocky=$id_hocky";
	$id_hocky=(int)$id_hocky;
	$sql.=" WHERE hocky='$id_hocky'"; 
}
$sql.=" GROUP BY masv,ispay"; 

$obj->Query($sql);
$arrHP = array(); $tonghp=0;
while($rs=$obj->Fetch_Assoc()) {
	$arrHP[$rs['masv']]=$rs['total']+0;
}

/* ----------------------------------------------- */
?>