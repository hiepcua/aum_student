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

if(isset($_POST['id'])) {
	$obj=new CLS_MYSQL;
	$obj->Exec("BEGIN");
	$id=addslashes(strip_tags($_POST['id']));
	$id_bo=addslashes(strip_tags($_POST['id_bo']));
	$name=addslashes(strip_tags($_POST['name']));
	$sql="UPDATE tbl_nganh SET `id_bo`='$id_bo',`name`='$name' WHERE id='$id'";
	$result1 = $obj->Exec($sql);
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('','','Mã ngành $id vừa cập nhật',".time().",'$user')";
	$result2 = $obj->Exec($sql);
	
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>