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
if(isset($_POST['id_hoso'])) {
	$id_hoso = isset($_POST['id_hoso'])?addslashes(strip_tags($_POST['id_hoso'])):'';
	$ma_nganh = isset($_POST['ma_nganh'])?addslashes(strip_tags($_POST['ma_nganh'])):'';
	$bac = isset($_POST['bac'])?addslashes(strip_tags($_POST['bac'])):'';
	$khoa = isset($_POST['khoa'])?addslashes(strip_tags($_POST['khoa'])):'';
	$ptxt = isset($_POST['ptxt'])?(int)$_POST['ptxt']:'';
	$diadiem = isset($_POST['diadiem'])?addslashes(strip_tags($_POST['diadiem'])):'';
	
	$obj->Exec("BEGIN"); $cdate =time();
	$sql = "INSERT INTO tbl_dangky_tuyensinh (cdate,id_khoa,id_he,id_nganh,id_hoso,xettuyen,diadiemhoc,author,status) 
	VALUES($cdate,'$khoa','$bac','$ma_nganh','$id_hoso','$ptxt','$diadiem','$user','TS1')"; 
	
	//echo $sql;
	$result1 = $obj->Exec($sql);
	
	// dang ky note
	$sql = "INSERT INTO tbl_dangky_note (id_hoso,masv,notes,cdate,author) 
	VALUES('$id_hoso','','Hồ sơ #$id_hoso đăng ký ngành thành công',$cdate,'$user')";
	$result2 = $obj->Exec($sql); //echo $sql;
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$id_hoso','','Hồ sơ #$id_hoso đăng ký ngành thành công',$cdate,'$user')";
	$result3 = $obj->Exec($sql);
	
	if($result1 && $result2 && $result3) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>