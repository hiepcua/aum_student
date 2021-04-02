<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once("../../libs/cls.mysql.php");
require_once("../../libs/cls.users.php");
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$objdata=new CLS_MYSQL;
$check_permission = $objuser->Permission('user');
if($check_permission==false) die('E02');

$userid=isset($_POST['userid'])?(int)$_POST['userid']:0;
$sql="DELETE FROM `tbl_user` WHERE `id`=$userid";
if($objdata->Query($sql)){}
else{die('E04');}
?>