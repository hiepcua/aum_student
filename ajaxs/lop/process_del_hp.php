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
$obj=new CLS_MYSQL;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');

if(isset($_POST['id'])){
	$id 	= isset($_POST['id'])?(int)$_POST['id']:0;
	$lop 	= isset($_POST['lop'])?addslashes($_POST['lop']):'';
	$mon 	= isset($_POST['mon'])?addslashes($_POST['mon']):'';
	if($id==0 || $lop=='' || $mon=='') die("empty");
	
	// xóa chuongtrinhhoc
	$sql="DELETE FROM tbl_chuongtrinhhoc WHERE id=$id";
	$result1 = $obj->Exec($sql); 
	//echo $sql.' ; ';
	
	//get masv
	$arr_ma = getMaSV($lop); 
	if(count($arr_ma)>0) {
		$str_masv = implode("','",$arr_ma);
		$str_masv = substr($str_masv,0,-3);
		// check chuongtrinhhoc này đã có sinh viên đóng học chưa?
		$sql = "SELECT count(*) AS dem FROM tbl_hocphi 
				WHERE ispay=1 AND ma_hp='$mon' AND masv IN ('$str_masv')";
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		if ($r['dem']>0) die("notdel");
		
		foreach($arr_ma as $ma) {
			// xóa học phí của sinh viên
			$sql = "DELETE FROM tbl_hocphi WHERE masv='$ma' AND ma_hp='$mon'";
			$result2 = $obj->Exec($sql);
		
			// xóa nội dung học của sinh viên
			$sql = "DELETE FROM tbl_hoctap WHERE masv='$ma' AND id_monhoc='$mon'";
			$result3 = $obj->Exec($sql);
		}
	}
	echo "success";
} ?>