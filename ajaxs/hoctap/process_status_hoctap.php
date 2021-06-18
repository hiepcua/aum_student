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

$id = isset($_POST['id']) ? antiData($_POST['id']) : '';
if($id!=='') {
	$status = isset($_POST['cbo_status_hoctap'])? antiData($_POST['cbo_status_hoctap']) : '';
	$result = SysEdit('tbl_hoctap', array('status'=> $status), "id='".$id."'");
	if($result){
		die('success');
	}else{
		die('error');
	}
}?>