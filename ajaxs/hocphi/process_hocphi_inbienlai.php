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

if(isset($_POST['masv']) && $_POST['masv']!='') {
	$masv = isset($_POST['masv']) ? addslashes(strip_tags($_POST['masv'])) : '';
	$id_hoso = isset($_POST['id_hoso']) ? addslashes(strip_tags($_POST['id_hoso'])) : '';
	$sotien = isset($_POST['sotien']) ? floatval($_POST['sotien']) : 0;
	$noidung = isset($_POST['noidung']) ? addslashes($_POST['noidung']) : 'Đóng học phí & in biên lai';
	$cdate = time();

	$sql = "INSERT INTO tbl_hocphi_pay (masv, sotien, noidung, date_pay, author) VALUES ('$masv', '$sotien', '$noidung', '$cdate', '$user')";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql);
	$last_insert_id = $obj->LastInsertID();
	
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$id_hoso','$masv','Đã đóng ".number_format($sotien)." VNĐ',".$cdate.",'$user')";
	$result2 = $obj->Exec($sql);
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo $last_insert_id;
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>