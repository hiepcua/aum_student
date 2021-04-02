<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
mb_internal_encoding('UTF-8');
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['id'])) {
	$obj=new CLS_MYSQL;
	$id=addslashes(strip_tags($_POST['id']));
	$name=addslashes(strip_tags($_POST['name']));
	$ttn=(int)$_POST['ttn'];
	$sql="UPDATE tbl_monhoc SET `name`='$name',`ttn`='$ttn' WHERE id='$id'";
	$obj->Exec($sql);
	die('success');
}?>