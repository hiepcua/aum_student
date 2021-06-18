<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.configsite.php');
$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('user');

$ht_id = isset($_POST['ht_id']) ? (int)$_POST['ht_id'] : '';
if($ht_id!=="") {
	$masv = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$id_mon = isset($_POST['id_mon'])?addslashes(strip_tags($_POST['id_mon'])):'';
	$type = isset($_POST['type'])?(int)$_POST['type']:1;
	$hocky = isset($_POST['hocky'])?(int)$_POST['hocky']:1;
	$tinchi = isset($_POST['tinchi'])?(int)$_POST['tinchi']:1;

	$cdate = time(); 
	$status = 'HT04';
	$sql="UPDATE tbl_hoctap SET mdate=$cdate, status='$status' WHERE id='$ht_id'";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql);
	
	// Insert 1 rows mới tương tự rows cũ 
	$sql="INSERT INTO tbl_hoctap (masv,id_monhoc,tinchi,type,status,hoclai) SELECT masv,id_monhoc,tinchi,1,'HT01',1 FROM tbl_hoctap WHERE id=$ht_id";
	$result2 = $obj->Exec($sql);
	
	// Note bảng tbl_hoctap_note
	$note = "Đăng ký học lại môn $id_mon"; 
	if($type==2) $note = "Đăng ký học cải thiện môn $id_mon"; 
	$sql = "INSERT INTO tbl_hoctap_note (id_hoctap,masv,id_monhoc,notes,cdate,author) VALUES ('$ht_id','$masv','$id_mon','$note',$cdate,'$user')";
	$result4 = $obj->Exec($sql);
	
	// note bảng tbl_notify
	$note = "#$masv đăng ký học lại."; 
	if($type==2) $note = "#$masv đăng ký học cải thiện."; 
	$sql = "INSERT INTO tbl_notify (masv,notes,cdate,author) VALUES('$masv','$note',$cdate,'$user')";
	$result5 = $obj->Exec($sql);
	
	if($result1 && $result2 && $result4 && $result5) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>