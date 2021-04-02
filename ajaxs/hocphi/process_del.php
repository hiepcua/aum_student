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
if(isset($_POST['id'])) {
	$id  = isset($_POST['id'])?(int)$_POST['id']:0;	
	$name  = isset($_POST['name'])?strip_tags(addslashes($_POST['name'])):'';	
	$masv  = isset($_POST['masv'])?strip_tags(addslashes($_POST['masv'])):'';	
	
	$obj->Exec("BEGIN");
	$sql = "DELETE FROM tbl_hocphi WHERE id=$id AND masv='$masv'";
	$result1 = $obj->Exec($sql);
	
	$sql="INSERT INTO tbl_notify (masv,notes,cdate,author) VALUES('$masv','Xóa danh mục học phí $name',".time().",'$user')";
	$result2 = $obj->Exec($sql);
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>