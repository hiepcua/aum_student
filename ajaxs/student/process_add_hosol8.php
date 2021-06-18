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

$ma_hoso = isset($_POST['ma_hoso']) ? antiData($_POST['ma_hoso']) : '';
if($ma_hoso!==''){
	$arr = $arr2 = array();
	$exist_hoso = isset($_POST['exist_hoso']) ? antiData($_POST['exist_hoso']) : 'yes';
	$arr['ma']	= $ma_hoso;
	$hoten 		= isset($_POST['hoten']) ? antiData($_POST['hoten']) : '';
	$name 		= explode(" ",$hoten);
	$arr['name']	= $name[count($name)-1];
	$arr['ho_dem'] 	= trim(str_replace($arr['name'],"",$hoten));
	$arr['email']	= isset($_POST['email']) ? antiData($_POST['email']) : '';
	$arr['dienthoai'] = isset($_POST['dienthoai']) ? (int)$_POST['dienthoai'] : '';
	$arr['gioitinh'] = isset($_POST['gender']) ? antiData($_POST['gender']) : 'nam';
	$arr['ngaysinh'] = !empty($_POST['ngaysinh']) ? antiData($_POST['ngaysinh'],'time') : '';
	$arr['noisinh']	 = isset($_POST['noisinh']) ? antiData($_POST['noisinh']) : '';
	$arr['cdate']	= time();

	/* Bảng học sinh */
	if($exist_hoso=='yes'){
		SysEdit('tbl_hocsinh',$arr, "ma='".$arr['ma']."'");
	}else{
		SysAdd('tbl_hocsinh',$arr);
	}
	die('success');

	/* Bảng đăng ký tuyển sinh */
	// $arr2['id_hoso'] = $ma_hoso;

	// if((int)$exist <= 0){
	// 	$result = SysAdd('tbl_hocsinh', $arr);
	// 	if($result){
	// 		die('success');
	// 	}else{
	// 		die('error');
	// 	}
	// }else die('exist');
}