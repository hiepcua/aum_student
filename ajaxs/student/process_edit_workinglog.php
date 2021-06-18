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

if(isset($_POST['id_log']) && $_POST['id_log']!=='') {
	$arr = array();
	$id_log			= (int)$_POST['id_log'];
	$arr['id_hoso']	= antiData($_POST['ma_hoso']);
	$arr['masv']	= isset($_POST['cbo_masv']) ? antiData($_POST['cbo_masv']):'';
	$arr['noidung']	= isset($_POST['nd_tuongtac']) ? antiData($_POST['nd_tuongtac']):'';
	$arr['date']	= isset($_POST['ngay_lienhe']) ? strtotime($_POST['ngay_lienhe']):'';
	$arr['ketqua'] 	= isset($_POST['ketqua']) ? antiData($_POST['ketqua']):'';
	$arr['finish'] 	= isset($_POST['hoanthanh']) ? (int)$_POST['hoanthanh']:0;
	$arr['cdate']	= time();
	$arr['author']	= $user;
	$arr['type']	= 'hoctap';

	if($arr['ketqua']!==""){
		SysEdit('tbl_dangky_tuyensinh', array('last_contact'=>$arr['date']), "AND masv='".$arr['masv']."'");
	}
	
	$result1 = SysEdit('tbl_working_log',$arr," id=".$id_log);
	if($result1) {
		echo "success";
	}else { 
		echo "error";
	}
}?>