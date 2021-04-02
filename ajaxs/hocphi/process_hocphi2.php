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
if(isset($_POST['ids'])) {
	$ma  = isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$masv  = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$ids = isset($_POST['ids'])?addslashes(strip_tags($_POST['ids'])):'';
	if($ids=="") die();
	$ids =substr($ids,0,strlen($ids)-1);
	$ids = str_replace(",","','",$ids);
	
	$sql = "SELECT sum(hocphi) as total FROM tbl_hocphi WHERE id IN ('$ids')";
	$obj->Query($sql);
	$rs = $obj->Fetch_Assoc();
	$total = $rs['total']+0;
	$cdate = time();
	$sql = "UPDATE tbl_hocphi SET ispay=1,date_pay=$cdate WHERE id IN ('$ids')";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql);//echo $sql;
	
	$ids = isset($_POST['ids'])?addslashes(strip_tags($_POST['ids'])):'';
	$sql = "INSERT INTO tbl_hocphi_note (masv,hocphi_ids,money,notes,cdate,author) 
	VALUES('$masv','$ids','$total','Đã đóng ".number_format($total)." VNĐ',$cdate,'$user')";
	$result2 = $obj->Exec($sql);
	
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','$masv','Đã đóng ".number_format($total)." VNĐ',$cdate,'$user')";
	$result3 = $obj->Exec($sql);
	if($result1 && $result2 && $result3) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>