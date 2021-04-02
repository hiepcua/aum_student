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
	
	$sql="SELECT `id_khoa`,`id_he`,`id_nganh` FROM tbl_dangky_tuyensinh WHERE masv='$masv'";

	$obj->Query($sql);
	$r=$obj->Fetch_Assoc();
	$id_he=$r['id_he'];
	$id_nganh=$r['id_nganh'];
	// lay du lieu hoc phan khung
	$sql="SELECT * FROM tbl_hocphan_khung WHERE id_he='$id_he' AND id_nganh='$id_nganh' AND id_monhoc='$id_mon'";

	$obj->Query($sql);
	$arrHP = array();
	while($r=$obj->Fetch_Assoc()) $arrHP=$r;
	
	//var_dump($arrHP); die();
	if(count($arrHP)==0) $str.="Không có học phần khung!";
	// lay du lieu diem cu
	$sql="SELECT diem FROM tbl_hoctap WHERE id='$ht_id'";
	$obj->Query($sql);
	$r = $obj->Fetch_Assoc();
	$diem = json_decode($r['diem'],true); 
	$diem1 = isset($diem['chuyencan']) ? $diem['chuyencan'] : "";
	$diem2 = isset($diem['diemkt']) ? $diem['diemkt'] : "";
	$diem3 = isset($diem['diemthi']) ? $diem['diemthi'] : "";
	
	if($diem1=='' || $diem2=='' || $diem3=='') die('Học viên chưa có điểm!');

	$kq=0;
	$diem_chuyencan = $arrHP['diem_chuyencan'];
	$diem_kiemtra = $arrHP['diem_kiemtra'];
	$diem_thi = $arrHP['diem_thi'];
	$diem_pass = $arrHP['total'];
	
	if($diem_chuyencan>=0) $kq  = $diem_chuyencan/100*$diem1;
	if($diem_kiemtra>=0) $kq += $diem_kiemtra/100*$diem2;
	if($diem_thi>=0) $kq += $diem_thi/100*$diem3;
	
	$pass=0; $str='';
	if($kq>$diem_pass) {
		$pass=1; $str.="SV #$masv Đạt";
		$note = "KQ: Đạt môn $id_mon"; 
	}else {
		$str.="SV #$masv Không đạt";
		$note = "KQ: Không đạt môn $id_mon"; 
	}
	
	// tien hanh update status bang hoc tap
	$cdate = time();
	$sql = "UPDATE tbl_hoctap SET ketqua=$kq,status='$pass',mdate=$cdate WHERE id=$ht_id";
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