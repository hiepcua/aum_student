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

$masv = isset($_POST['masv']) ? antiData($_POST['masv']) : '';
$ma_monhoc = isset($_POST['ma_monhoc']) ? antiData($_POST['ma_monhoc']) : '';
if($masv!=='' || $ma_monhoc!=='') {
	$mdate = time();
	$status_hoctap = isset($_POST['cbo_status_hoctap'])? antiData($_POST['cbo_status_hoctap']) : '';
	$result = SysEdit('tbl_hoctap', array('status'=> $status_hoctap, 'mdate'=> $mdate), "masv='".$masv."' AND id_monhoc='".$ma_monhoc."'");
	if($result){
		die('success');
	}else{
		die('error');
	}
}?>