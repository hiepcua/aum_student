<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../global/libs/gffunc_edu.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$obj = new CLS_MYSQL;
$user = $objuser->getInfo('username');
if(isset($_POST['ma'])) { //print_r($_POST);
	$ma = isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$status = isset($_POST['status'])?(int)$_POST['status']:0;
	// tạo mã sv
	$sql="SELECT * FROM tbl_dangky_tuyensinh WHERE id_hoso='$ma'";
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc();
	$khoa=$r['id_khoa'];
	$he=$r['id_he'];
	$nganh=$r['id_nganh'];
	$cdate=time();
	if($status===1){
		$stt=$r['id'];
		$masv=create_masv($khoa,$he,$nganh,$stt);
		$obj->Exec("BEGIN");
		$sql="UPDATE `tbl_dangky_tuyensinh` SET `masv`='$masv',`nhaphoc`=1,date_nhaphoc=$cdate ,status='HS1' 
		WHERE `id_hoso` in ('$ma')";
		$result1 = $obj->Exec($sql); //echo $sql.' / ';
		
		// Tạo học phí khác
		$arr_hocphi=getHocphikhac($he,$nganh);
		innit_hocphi_khac($masv,$arr_hocphi);
		
		// dang ky note
		$sql = "INSERT INTO tbl_dangky_note (id_hoso,masv,notes,cdate,author) 
		VALUES('$ma','$masv','Hồ sơ #$ma đã nhập học',$cdate,'$user')";
		$result2 = $obj->Exec($sql); //echo $sql;
		
		// notify
		$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
		VALUES('$ma','$masv','Hồ sơ #$ma đã nhập học',$cdate,'$user')";
		$result3 = $obj->Exec($sql); //echo $sql;
		
		if($result1 && $result2 && $result3) {
			$obj->Exec("COMMIT"); echo "success";
		}else{ 
			$obj->Exec("ROLLBACK"); echo "error";
		}
	}else{
		$masv=$r['masv'];
		$lydo = isset($_POST['lydo'])?addslashes(strip_tags($_POST['lydo'])):'';
		$sql="DELETE FROM tbl_hocphi WHERE masv='$masv'";
		$result1 = $obj->Exec($sql); //echo $sql;
		
		$sql="DELETE FROM tbl_hoctap WHERE masv='$masv'";
		$result2 = $obj->Exec($sql); //echo $sql;
		
		$sql="UPDATE `tbl_dangky_tuyensinh` SET `nhaphoc`=0 WHERE `id_hoso` = '$ma'";
		$result3 = $obj->Exec($sql); //echo $sql;
		
		$sql = "INSERT INTO tbl_dangky_note (id_hoso,masv,notes,cdate,author) 
		VALUES('$ma','$masv','Hủy nhập học hồ sơ #$ma. Lý do: $lydo',$cdate,'$user')";
		$result4 = $obj->Exec($sql); //echo $sql;
		
		$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
		VALUES('$ma','$masv','Hủy nhập học hồ sơ #$ma. Lý do: $lydo',$cdate,'$user')";
		$result5 = $obj->Exec($sql); //echo $sql;
		
		if($result1 && $result2 && $result3 && $result4 && $result5) {
			$obj->Exec("COMMIT"); echo "success";
		}else{ 
			$obj->Exec("ROLLBACK"); echo "error";
		}
	}
}
?>