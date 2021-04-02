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

if(isset($_POST['id_dkts'])) {
	$id_dkts = isset($_POST['id_dkts'])?(int)$_POST['id_dkts']:'';
	$id_hoso = isset($_POST['id_hoso'])? antiData($_POST['id_hoso']):'';
	$status = isset($_POST['status'])?addslashes(strip_tags($_POST['status'])):'';
	
	$obj->Exec("BEGIN"); $cdate =time();
	$sql = "UPDATE tbl_dangky_tuyensinh SET status='$status' WHERE id=$id_dkts";
	// echo $sql;
	$result1 = $obj->Exec($sql);
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$id_hoso','','Hồ sơ #$id_hoso cập nhật trạng thái thành công',$cdate,'$user')";
	$result2 = $obj->Exec($sql);
	
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>