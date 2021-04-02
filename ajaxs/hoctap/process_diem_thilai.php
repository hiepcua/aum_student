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
	$thilai = isset($_POST['thilai'])?(float)$_POST['thilai']:'';
	
	// lay du lieu diem cu
	$sql="SELECT diem FROM tbl_hoctap WHERE id='$ht_id'";
	$obj->Query($sql);
	$r = $obj->Fetch_Assoc();
	$diem = json_decode($r['diem'],true); 
	$diem1 = isset($diem['chuyencan'])?$diem['chuyencan']:'';
	$diem2 = isset($diem['diemkt'])?$diem['diemkt']:'';
	$diem3 = isset($diem['diemthi'])?$diem['diemthi']:'';
	$arr_diem['chuyencan'] 	= $diem1;
	$arr_diem['diemkt'] 	= $diem2;
	$arr_diem['diemthi'] 	= $diem3;
	$arr_diem['thilai'] 	= $thilai;
	$json = json_encode($arr_diem,JSON_UNESCAPED_UNICODE);
	
	$cdate =time();
	$sql = "UPDATE tbl_hoctap SET diem='$json',mdate=$cdate WHERE id='$ht_id'";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql); //echo $sql." ; ";
	
	$note = "Nhập điểm thi lại: $thilai"; 
	$sql = "INSERT INTO tbl_hoctap_note (id_hoctap,masv,id_monhoc,notes,cdate,author) 
	VALUES('$ht_id','$masv','$id_mon','$note',$cdate,'$user')";
	$result2 = $obj->Exec($sql); //echo $sql;
	
	$note = "#$masv Nhập điểm thi lại: $thilai"; 
	$sql = "INSERT INTO tbl_notify (masv,notes,cdate,author) VALUES('$masv','$note',$cdate,'$user')";
	$result3 = $obj->Exec($sql); //echo $sql;
	
	if($result1 && $result2 && $result3) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>