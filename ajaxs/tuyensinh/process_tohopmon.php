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
$user = $objuser->getInfo('username');
if(isset($_POST['id_nganh'])) {
	$id_tohopmon = isset($_POST['id_tohopmon'])?(int)$_POST['id_tohopmon']:0;
	$id_nganh = isset($_POST['id_nganh'])?addslashes(strip_tags($_POST['id_nganh'])):'';
	$ma = isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$mon = isset($_POST['mon'])?addslashes(strip_tags($_POST['mon'])):'';
	if($id_tohopmon>0)
		$sql = "UPDATE tbl_config_monthi SET mdate=".time().",id_nganh='$id_nganh',
		id_tohop='$ma',tohopmon='$mon',author='$user' WHERE id=$id_tohopmon";
	else
		$sql = "INSERT INTO tbl_config_monthi (cdate,id_nganh,id_tohop,tohopmon,author) 
		VALUES(".time().",'$id_nganh','$ma','$mon','$user')"; 
	//echo $sql;
	$obj = new CLS_MYSQL;
	$result = $obj->Exec($sql);
	if($result) echo "success";
}?>