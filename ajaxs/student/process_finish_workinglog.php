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

if(isset($_POST['id_working_log']) && $_POST['id_working_log']!=='') {
	$id_working_log = $_POST['id_working_log'];
	$cdate = time();

	$sql = "UPDATE tbl_working_log SET finish=1, author='$user', mdate='$cdate' WHERE id=$id_working_log";
	$result1 = $obj->Exec($sql);
	if($result1) {
		echo "success";
	}else { 
		echo "error";
	}
}?>