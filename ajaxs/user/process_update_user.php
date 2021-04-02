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

$gid = $_POST['txt_gid'];
$userid=isset($_POST['txt_user_id'])?(int)$_POST['txt_user_id']:0;
$first_name = addslashes($_POST['txt_firstname']);
$username = isset($_POST['txt_username'])?$_POST['txt_username']:'';
$password = isset($_POST['txt_password'])?$_POST['txt_password']:'';
$password=hash('sha512',trim($password));
$password=md5($password);
$phone = addslashes($_POST['txt_phone']);
$date = date('Y-m-d H:i:s');
if(isset($_POST['cmd_update_user'])) {
	$sql="UPDATE tbl_user SET 
	`firstname`='$first_name',
	`phone`='$phone'
	WHERE id=$userid"; echo $sql;
	if($objdata->Exec($sql)){echo "success!";}
	else{echo 'E04';}
}else{
	$sql="INSERT INTO tbl_user(`username`,`password`,`firstname`,`phone`,`joindate`,`gid`,`isactive`) VALUES('$username','$password','$first_name','$phone','$date','$gid',1)";
	echo $sql;
	if($objdata->Exec($sql)){}
		else{echo 'E04';}
}
?>