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

if(isset($_POST['ht_id'])) {
	$masv = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$ht_id = isset($_POST['ht_id'])?(int)$_POST['ht_id']:-1;
	$id_mon = isset($_POST['id_mon'])?addslashes(strip_tags($_POST['id_mon'])):'';
	$id_he = isset($_POST['id_he'])?addslashes(strip_tags($_POST['id_he'])):'';
	$id_nganh = isset($_POST['id_nganh'])?addslashes(strip_tags($_POST['id_nganh'])):'';
	if($ht_id<0) die();
	
	// lay du lieu hoc phan khung
	$sql="SELECT * FROM tbl_hocphan_khung WHERE id_he='$id_he' AND id_nganh='$id_nganh' AND id_monhoc='$id_mon'";
	$obj->Query($sql);
	$arrHP = array();
	while($r=$obj->Fetch_Assoc()) $arrHP=$r;
	
	// lay du lieu diem cu
	$sql="SELECT diem FROM tbl_hoctap WHERE id='$ht_id'";
	$obj->Query($sql);
	$r = $obj->Fetch_Assoc();
	$diem = json_decode($r['diem'],true); 
	$diem1 = isset($diem['chuyencan']) ? $diem['chuyencan'] : '';
	$diem2 = isset($diem['diemkt']) && $diem['diemkt'] !='' ? $diem['diemkt'] : 0;
	$diem3 = isset($diem['diemthi']) && $diem['diemthi']!='' ? $diem['diemthi'] : 0;
	$thilai = isset($diem['thilai']) && $diem['thilai']!='' ? $diem['thilai'] : 0;
	
	$kq2=0;
	$diem_chuyencan = $arrHP['diem_chuyencan'];
	$diem_kiemtra = $arrHP['diem_kiemtra'];
	$diem_thi = $arrHP['diem_thi'];
	$diem_pass = $arrHP['total'];
	if($diem_chuyencan>=0) $kq2  = $diem_chuyencan/100*$diem1;
	if($diem_kiemtra>=0) $kq2 += $diem_kiemtra/100*$diem2;
	if($diem_thi>=0) $kq2 += $diem_thi/100*$thilai;
	
	$pass=0; $str='';
	if($kq2>$diem_pass) {
		$pass=1; $str.="SV #$masv Đạt";
		$note = "KQ lần 2: Đạt môn $id_mon"; 
	}else {
		$str.="SV #$masv Không đạt";
		$note = "KQ lần 2: Không đạt môn $id_mon"; 
	}
	
	// tien hanh update status bang hoc tap
	$cdate = time();
	$sql = "UPDATE tbl_hoctap SET ketqua2=$kq2,status='$pass',mdate=$cdate WHERE id=$ht_id";
	$result1 = $obj->Exec($sql); //echo $sql.' ; ';
	
	// Note bảng tbl_hoctap_note
	$sql = "INSERT INTO tbl_hoctap_note (id_hoctap,masv,id_monhoc,notes,cdate,author) 
	VALUES('$ht_id','$masv','$id_mon','$note',$cdate,'$user')";
	$result2 = $obj->Exec($sql); //echo $sql.' ; ';
	
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('','','#$masv $note',$cdate,'$user')";
	$result3 = $obj->Exec($sql); //echo $sql.' ; ';
	
	if($result1 && $result2 && $result3) {
		$obj->Exec("COMMIT"); echo $str;
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>