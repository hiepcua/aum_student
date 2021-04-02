<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['value'])) {
	$id = isset($_POST['value'])?addslashes(strip_tags($_POST['value'])):'';
	$year = isset($_POST['year'])?addslashes(strip_tags($_POST['year'])):'';
	$name = isset($_POST['name'])?addslashes(strip_tags($_POST['name'])):'';
	$ngay = isset($_POST['ngay'])?addslashes(strip_tags($_POST['ngay'])):'';
	$startDay = strtotime($ngay);
	$sl = isset($_POST['sl'])?(int)$_POST['sl']:0;
	$sql = "UPDATE tbl_khoa SET name='$name',startDay='$startDay',quan='$sl'
	WHERE id='$id'"; //echo $sql;
	$obj = new CLS_MYSQL;
	$result = $obj->Exec($sql);
	if($result) echo "success";
}?>