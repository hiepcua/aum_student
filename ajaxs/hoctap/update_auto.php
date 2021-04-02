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
	$ids = isset($_POST['ids'])?addslashes(strip_tags($_POST['ids'])):'';
	$id_he = isset($_POST['id_he'])?addslashes(strip_tags($_POST['id_he'])):'';
	$id_nganh = isset($_POST['id_nganh'])?addslashes(strip_tags($_POST['id_nganh'])):'';
	$id_mon = isset($_POST['id_mon'])?addslashes(strip_tags($_POST['id_mon'])):'';
	$id_lop = isset($_POST['id_lop'])?addslashes(strip_tags($_POST['id_lop'])):'';
	if($ids=="") die("nodata");
	$arr_ids=explode(",",$ids);
	$ids = str_replace(",","','",$ids);
	// lay du lieu diem cu
	$sql="SELECT * FROM tbl_hoctap WHERE id IN ('$ids')";
	$obj->Query($sql);
	if($obj->Num_rows()==0) die("empty");
	$arrHT = array();
	while($r=$obj->Fetch_Assoc()) $arrHT[$r['id']]=$r;
	
	
	// lay du lieu hoc phan khung
	$sql="SELECT * FROM tbl_hocphan_khung WHERE id_he='$id_he' AND id_nganh='$id_nganh' AND id_monhoc='$id_mon'";
	$obj->Query($sql);
	$arrHP = array();
	while($r=$obj->Fetch_Assoc()) $arrHP=$r;
	
	// tien hanh update status bang hoc tap
	$obj->Exec("BEGIN"); $flag_result=true; $str='';
	$cdate=time();
	foreach($arr_ids as $item) {
		if($item=="") continue;
		if(!isset($arrHT[$item])) continue;
		$r=$arrHT[$item];
		$diem = json_decode($r['diem'],true); 
		$diem1 = isset($diem['chuyencan'])?$diem['chuyencan']:'';
		$diem2 = isset($diem['diemkt'])?$diem['diemkt']:'';
		$diem3 = isset($diem['diemthi'])?$diem['diemthi']:'';
		$kq=0;
		//if($diem3!=='') {
			$diem_chuyencan = $arrHP['diem_chuyencan'];
			$diem_kiemtra = $arrHP['diem_kiemtra'];
			$diem_thi = $arrHP['diem_thi'];
			$diem_pass = $arrHP['total'];
			if($diem_chuyencan>=0) $kq  = $diem_chuyencan/100*$diem1;
			if($diem_kiemtra>=0) $kq += $diem_kiemtra/100*$diem2;
			if($diem_thi>=0) $kq += $diem_thi/100*$diem3;
		//}
		$pass=0; 
		if($kq>$diem_pass) {
			$pass=1; $str.="SV #".$r['masv']." Đạt<br>";
			$note = "KQ: Đạt môn $id_mon"; 
		}else {
			$str.="SV #".$r['masv']." Không đạt<br>";
			$note = "KQ: Không đạt môn $id_mon"; 
		}
		$str.="<div class='cleafix'></div>";
		$sql = "UPDATE tbl_hoctap SET ketqua=$kq,status='$pass',mdate=$cdate WHERE id=$item";
		$result = $obj->Exec($sql); //echo $sql.' ; ';
		if(!$result) $flag_result=false;
		
		// Note bảng tbl_hoctap_note
		$sql = "INSERT INTO tbl_hoctap_note (id_hoctap,masv,id_monhoc,notes,cdate,author) 
		VALUES('$item','".$r['masv']."','$id_mon','$note',$cdate,'$user')";
		$result2 = $obj->Exec($sql); 
		if(!$result2) $flag_result=false;
	}
	
	// note bảng tbl_notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('','','Lớp $id_lop thực hiện Xét Đạt/Không Đạt môn $id_mon',$cdate,'$user')";
	$result3 = $obj->Exec($sql);
	
	if($flag_result==true && $result3) {
		$obj->Exec("COMMIT"); echo $str;
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>