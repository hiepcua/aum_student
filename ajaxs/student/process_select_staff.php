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
$id_staff = isset($_POST['cbo_staff']) ? antiData($_POST['cbo_staff']) : '';
if($masv!=='') {
	$result = SysEdit('tbl_dangky_tuyensinh', array('id_staff'=> $id_staff), "masv='".$masv."'");
	
	if($result){
		die('success');
	}else{
		die('error');
	}
}?>