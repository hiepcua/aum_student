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
if(isset($_POST['ht_id'])) {
	$masv = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$ht_id = isset($_POST['ht_id'])?(int)$_POST['ht_id']:-1;
	$id_mon = isset($_POST['id_mon'])?addslashes(strip_tags($_POST['id_mon'])):'';
	if($ht_id<0) die();
	$chuyencan = isset($_POST['chuyencan'])?(float)$_POST['chuyencan']:'';
	$diemkt = isset($_POST['diemkt'])?(float)$_POST['diemkt']:'';
	$diemthi = isset($_POST['diemthi'])?(float)$_POST['diemthi']:'';
	$arr_diem['chuyencan'] = $chuyencan;
	$arr_diem['diemkt'] = $diemkt;
	$arr_diem['diemthi'] = $diemthi;
	
	$json = json_encode($arr_diem,JSON_UNESCAPED_UNICODE);
	$cdate =time();
	$sql = "UPDATE tbl_hoctap SET diem='$json',mdate=$cdate WHERE id IN ('$ht_id')";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql); //echo $sql;
	
	$note = "Cập nhật điểm:"; 
	if($chuyencan!='') $note.=" chuyên cần ($chuyencan)";
	if($diemkt!='') $note.=" điểm kiểm tra ($diemkt)";
	if($diemthi!='') $note.=" điểm thi ($diemthi)";
	$sql = "INSERT INTO tbl_hoctap_note (masv,id_monhoc,notes,cdate,author) 
	VALUES('$masv','$id_mon','$note',$cdate,'$user')";
	$result2 = $obj->Exec($sql); //echo $sql;
	
	$note = "#$masv cập nhật điểm:"; 
	if($chuyencan!='') $note.=" chuyên cần ($chuyencan)";
	if($diemkt!='') $note.=" điểm kiểm tra ($diemkt)";
	if($diemthi!='') $note.=" điểm thi ($diemthi)";
	$sql = "INSERT INTO tbl_notify (masv,notes,cdate,author) VALUES('$masv','$note',$cdate,'$user')";
	$result3 = $obj->Exec($sql); //echo $sql;
	
	if($result1 && $result2 && $result3) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>