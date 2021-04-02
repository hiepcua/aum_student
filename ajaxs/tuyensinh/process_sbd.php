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
if(isset($_POST['ma'])) {
	$ma = isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$sbd = isset($_POST['sbd'])?addslashes(strip_tags($_POST['sbd'])):'';
	
	$obj = new CLS_MYSQL; $obj->Exec("BEGIN");
	$sql = "UPDATE tbl_dangky_tuyensinh SET mdate=".time().",sbd='$sbd',author='$user',status='TS2' WHERE id_hoso='$ma'";
	$result1 = $obj->Exec($sql); //echo $sql;
	
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author,status) 
	VALUES('$ma','','Hồ sơ #$ma đánh SBD: $sbd',".time().",'$user','TS2')";
	$result2 = $obj->Exec($sql);
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>