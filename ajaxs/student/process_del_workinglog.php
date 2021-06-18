<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if($id !== ''){
	SysDel('tbl_working_log', "id='".$id."'");
	die('success');
}
?>