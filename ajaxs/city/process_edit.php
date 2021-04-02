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
	$name=addslashes(strip_tags($_POST['name']);
	$sql="UPDATE tbl_city SET `name`='$name' WHERE id='$id'";
	$obj->Exec($sql);
	echo 'success';
}?>