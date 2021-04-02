<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');

if(isset($_POST['ma']) && $_POST['ma']!='') { //print_r($_POST);
	$ma = isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$status = isset($_POST['status'])?addslashes(strip_tags($_POST['status'])):'';
	
	$obj = new CLS_MYSQL; $obj->Exec("BEGIN");
	if($status=="")
		$sql = "UPDATE `tbl_dangky_tuyensinh` SET `trungtuyen`=if(`trungtuyen`=1,0,1), `status`=if(`status`='TS4','TS5','TS4'),nhaphoc=0,`isactive`=1 WHERE `id_hoso` in ('$ma')";
	else {
		$status=(int)$status;
		if($status==0){
			$sql = "UPDATE `tbl_dangky_tuyensinh` SET `trungtuyen`='$status',nhaphoc=0,`isactive`=1,status='TS5' WHERE `id_hoso` in ('$ma')";
		}else{
			$sql = "UPDATE `tbl_dangky_tuyensinh` SET `trungtuyen`='$status',nhaphoc=0,`isactive`=1,status='TS4' WHERE `id_hoso` in ('$ma')";	
		}
	}
	$result1 = $obj->Exec($sql); //echo $sql;
	$cdate=time();
	// dang ky note
	if($status==1)
		$note = "Hồ sơ #$ma đã trúng tuyển";
	else $note = "Hồ sơ #$ma hủy trúng tuyển";
	$sql = "INSERT INTO tbl_dangky_note (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','','$note',$cdate,'$user')"; //echo $sql;
	$result2 = $obj->Exec($sql); 
	
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','','$note',$cdate,'$user')";
	$result3 = $obj->Exec($sql); //echo $sql;
	
	if($result2 && $result3) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}else{
	die('error');
}?>