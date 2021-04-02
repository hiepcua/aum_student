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
if(isset($_POST['masv'])) {
	$ma  = isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$masv  = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$name = isset($_POST['name'])?addslashes(strip_tags($_POST['name'])):'';
	$hocky = isset($_POST['hocky'])?(int)$_POST['hocky']:'';
	$money = isset($_POST['money'])?(int)$_POST['money']:0;
	$obj->Exec("BEGIN");
	$sql = "INSERT INTO tbl_hocphi (masv,hocky,hocphi,ten_hp,type_hp) 
	VALUES('$masv','$hocky','$money','$name','khac')";
	$result1 = $obj->Exec($sql); //echo $sql;
	
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','$masv','Thêm khoản học phí: $name, số tiền ".number_format($money)." VNĐ',".time().",'$user')";
	$result2 = $obj->Exec($sql); //echo $sql;
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>