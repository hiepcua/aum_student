<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['id'])) {
	$obj=new CLS_MYSQL;
	$id=(int)$_POST['id'];
	$name=addslashes(strip_tags($_POST['name']));
	$diachi=addslashes(strip_tags($_POST['diachi']));
	$phone=addslashes(strip_tags($_POST['phone']));
	$sql="UPDATE tbl_partner SET `name`='$name',`diachi`='$diachi',`phone`='$phone' WHERE id='$id'";
	$obj->Exec($sql);
	die('success');
}?>