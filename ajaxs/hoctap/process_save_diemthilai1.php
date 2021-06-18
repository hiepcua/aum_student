<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj = new CLS_MYSQL; 
$objuser = new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('user');

$id_hoctap = isset($_POST['id_hoctap']) ? antiData($_POST['id_hoctap']) : '';
$diemthi = isset($_POST['diemthi']) ? antiData($_POST['diemthi']) : '';

if($id_hoctap!=="") {
	$sql="UPDATE tbl_hoctap SET ketqua2='".$diemthi."' WHERE id='$id_hoctap'";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql);
	
	$note = "#$masv cập nhật điểm thi lại lần 1"; 
	$sql="INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) VALUES('','$masv','$note',".time().",'$user')";
	$result2 = $obj->Exec($sql);
	
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>