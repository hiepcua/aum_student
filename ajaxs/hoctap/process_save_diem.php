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
if(isset($_POST['arr_masv'])) {
	$arr_masv = isset($_POST['arr_masv'])?addslashes(strip_tags($_POST['arr_masv'])):'';
	$arr_diem = isset($_POST['arr_diem'])?addslashes(strip_tags($_POST['arr_diem'])):'';
	$arr_ids = isset($_POST['arr_ids'])?addslashes(strip_tags($_POST['arr_ids'])):'';
	
	$json = json_encode($arr_diem,JSON_UNESCAPED_UNICODE);
	
	$sql = "UPDATE tbl_hoctap SET diem='$json',mdate=".time()." WHERE id IN ('$ht_id')";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql); //echo $sql;
	
	$note = "#$masv cập nhật điểm:"; 
	if($chuyencan!='') $note.=" chuyên cần ($chuyencan)";
	if($diemkt!='') $note.=" điểm kiểm tra ($diemkt)";
	if($diemthi!='') $note.=" điểm thi ($diemthi)";
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) VALUES('','$masv','$note',".time().",'$user')";
	$result2 = $obj->Exec($sql); //echo $sql;
	
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>