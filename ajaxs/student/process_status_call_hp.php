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
$user = $objuser->getInfo('user');

$masv = isset($_POST['masv']) ? antiData($_POST['masv']) : '';
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array('id_hoso', 'tinhtrang_call_hp'), "AND masv='".$masv."'");
if($masv!=='') {
	$last_contact = time();
	$status_call_hp = isset($_POST['cbo_status_call_hp'])? antiData($_POST['cbo_status_call_hp']) : '';
	$note = isset($_POST['note']) ? antiData($_POST['note']) : '';
	$result = SysEdit('tbl_dangky_tuyensinh', array('tinhtrang_call_hp'=> $status_call_hp, 'last_contact'=> $last_contact), "masv='".$masv."'");

	$id_hoso = isset($res_dkts[0]['id_hoso']) ? $res_dkts[0]['id_hoso'] : "";
	$tinhtrang_call_hp = isset($res_dkts[0]['tinhtrang_call_hp']) ? $res_dkts[0]['tinhtrang_call_hp'] : "";
	$txt_tinhtrang_call_hp = isset($STATUS_CALL_HP[$tinhtrang_call_hp]) ? $STATUS_CALL_HP[$tinhtrang_call_hp] : "";
	$txt_tinhtrang_call_new = isset($STATUS_CALL_HP[$status_call_hp]) ? $STATUS_CALL_HP[$status_call_hp] : "";

	if($note==""){
		$note = "Chuyển tình trạng cuộc gọi học phí từ: (".$txt_tinhtrang_call_hp.") sang: (".$txt_tinhtrang_call_new.")";
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