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

if(isset($_POST['ma_hoso'])) {
	$arr = array();
	$arr['id_hoso']	= antiData($_POST['ma_hoso']);
	$arr['masv']	= isset($_POST['cbo_masv']) ? antiData($_POST['cbo_masv']):'';
	$arr['noidung']	= isset($_POST['nd_tuongtac']) ? antiData($_POST['nd_tuongtac']):'';
	$arr['date']	= isset($_POST['ngay_lienhe']) ? strtotime($_POST['ngay_lienhe']):'';
	$arr['ketqua'] 	= "";
	$arr['finish'] 	= isset($_POST['hoanthanh']) ? (int)$_POST['hoanthanh']:0;
	$arr['cdate']	= time();
	$arr['author']	= $user;
	$arr['type']	= 'hoctap';

	if($arr['finish']!==0){
		SysEdit('tbl_dangky_tuyensinh', array('last_contact'=>$arr['date']), "AND masv='".$arr['masv']."'");
	}
	
	$result1 = SysAdd('tbl_working_log',$arr);
	if($result1) {
		echo "success";
	}else { 
		echo "error";
	}
}?>