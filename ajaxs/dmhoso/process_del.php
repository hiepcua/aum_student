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
	$id=addslashes(htmlentities(strip_tags($_POST['id'])));
	$obj=new CLS_MYSQL;
	$sql="DELETE FROM tbl_dmhoso WHERE id='$id'";
	$obj->Exec($sql);
	die('success');
}?>