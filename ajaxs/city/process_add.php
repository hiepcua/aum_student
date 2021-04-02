<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['name'])) {
	$obj=new CLS_MYSQL;
	$name=addslashes(strip_tags($_POST['name']));
	$sql="INSERT INTO tbl_city(`name`) VALUES ('$name')";
	$obj->Exec($sql);
	die('success');
}?>