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
if(isset($_POST['id_hoso'])) {
	$id_dky = isset($_POST['id_dky'])?(int)$_POST['id_dky']:0;
	$id_hoso = isset($_POST['id_hoso'])?addslashes(strip_tags($_POST['id_hoso'])):'';
	$sbd = isset($_POST['sbd'])?addslashes(strip_tags($_POST['sbd'])):'';
	$mon1 = isset($_POST['mon1'])?(float)$_POST['mon1']:'';
	$mon2 = isset($_POST['mon2'])?(float)$_POST['mon2']:'';
	$mon3 = isset($_POST['mon3'])?(float)$_POST['mon3']:'';
	$cdate = time();
	if($id_dky>0)
		$sql = "UPDATE tbl_dangky_tuyensinh SET mdate=$cdate,sbd='$sbd',mon1='$mon1',
		mon2='$mon2',mon3='$mon3',author='$user' WHERE id=$id_dky";
	else
		$sql = "INSERT INTO tbl_dangky_tuyensinh (cdate,sbd,mon1,mon2,mon3,author,id_hoso) 
		VALUES($cdate,'$sbd','$mon1','$mon2','$mon3','$user','$id_hoso')"; 
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql);
	
	// dang ky note
	$sql = "INSERT INTO tbl_dangky_note (id_hoso,masv,notes,cdate,author) 
	VALUES('$id_hoso','','Hồ sơ #$id_hoso đã cập nhật điểm: ($mon1),($mon2),($mon3)',$cdate,'$user')";
	$result2 = $obj->Exec($sql); //echo $sql;
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$id_hoso','','Hồ sơ #$id_hoso cập nhật điểm: ($mon1),($mon2),($mon3)',$cdate,'$user')";
	$result3 = $obj->Exec($sql);
	
	if($result1 && $result2 && $result3) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>