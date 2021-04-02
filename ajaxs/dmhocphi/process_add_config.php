<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
if(isset($_POST['name'])) {
	$obj=new CLS_MYSQL;
	$obj->Exec("BEGIN");
	$name=addslashes(strip_tags($_POST['name']));
	$hocphi=(int)$_POST['hocphi'];
	$sql="INSERT INTO tbl_dmhocphi(`name`,`hocphi`,`all`) VALUES ('$name','$hocphi',1)";
	$result1 = $obj->Exec($sql);
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('','','Thêm dm học phí chung: $name',".time().",'$user')";
	$result2 = $obj->Exec($sql);
	
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>