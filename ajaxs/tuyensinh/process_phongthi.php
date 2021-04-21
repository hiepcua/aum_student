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
if(isset($_POST['masv'])) {
	$masv = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$phongthi = isset($_POST['phongthi'])?addslashes(strip_tags($_POST['phongthi'])):'';
	
	$obj = new CLS_MYSQL; $obj->Exec("BEGIN");
	$sql = "UPDATE tbl_dangky_tuyensinh SET mdate=".time().",phongthi='$phongthi',author='$user' WHERE masv='$masv'";
	$result1 = $obj->Exec($sql);//echo $sql;
	
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('','$masv','Hồ sơ #$masv thiết lập phòng thi: $sbd',".time().",'$user')";
	$result2 = $obj->Exec($sql);
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>