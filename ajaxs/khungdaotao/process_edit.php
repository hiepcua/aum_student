<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
if(isset($_POST['id'])) {
	$obj=new CLS_MYSQL;
	$obj->Exec("BEGIN");
	$id=addslashes(strip_tags($_POST['id']));
	$monhoc=addslashes(strip_tags($_POST['monhoc']));
	$nganh=addslashes(strip_tags($_POST['nganh']));
	$he=addslashes(strip_tags($_POST['he']));
	//$hocky=(int)$_POST['hocky'];
	$tinchi=(int)$_POST['tinchi'];
	$chuyencan=(int)$_POST['chuyencan'];
	$kiemtra=(int)$_POST['kiemtra'];
	$thi=(int)$_POST['thi'];
	$tong=$_POST['tong'];
	$sql="UPDATE tbl_hocphan_khung SET `id_nganh`='$nganh',`id_he`='$he',`id_monhoc`='$monhoc',
	`tinchi`='$tinchi',`diem_chuyencan`='$chuyencan',`diem_kiemtra`='$kiemtra',
	`diem_thi`='$thi',`total`='$tong' WHERE id='$id'";
	$result1 = $obj->Exec($sql);
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('','','Cập nhật chương trình khung: $monhoc (ngành $nganh, hệ $he)',".time().",'$user')";
	$result2 = $obj->Exec($sql);
	
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>