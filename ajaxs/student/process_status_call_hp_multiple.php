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

$ids = isset($_POST['ids']) ? antiData($_POST['ids']) : '';
if($ids!=='') {
	$ids = substr($ids,0,strlen($ids)-1);
	$ids = str_replace(",","','",$ids);
	
	$last_contact = time();
	$note = isset($_POST['note']) ? antiData($_POST['note']) : '';
	$status_call = isset($_POST['cbo_status_call_hp'])? antiData($_POST['cbo_status_call_hp']) : '';
	$result = SysEdit('tbl_dangky_tuyensinh', array('tinhtrang_call_hp'=> $status_call, 'last_contact'=> $last_contact), "id IN ('".$ids."')");

	if($note==""){
		$note = "Cập nhật tình trạng cuộc gọi học phí: (".$txt_tinhtrang_call_new.")";
	}

	$arr = array();
	$arr['id_hoso'] = $id_hoso;
	$arr['masv'] = $masv;
	$arr['date'] = $last_contact;
	$arr['noidung'] = $note;
	$arr['ketqua'] = "Hoàn thành";
	$arr['type'] = "hocphi";
	$arr['finish'] = 1;
	$arr['author'] = $user;
	$arr['cdate'] = $last_contact;
	SysAdd('tbl_working_log', $arr);

	if($result){
		die('success');
	}else{
		die('error');
	}
}?>