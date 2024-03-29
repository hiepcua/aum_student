<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.configsite.php');
$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('user');

// get config
$hp_thilai=$hp_thict=$hp_hoclai=$hp_hocct=0;
$objconf = new CLS_CONFIG; $objconf->getList();
$r_config = $objconf->Fetch_Assoc(); 
if( $r_config['thilai']>0) 		$hp_thilai = $r_config['thilai'];
if( $r_config['thicaithien']>0) $hp_thict = $r_config['thicaithien'];
if( $r_config['hoclai']>0) 		$hp_hoclai = $r_config['hoclai'];
if( $r_config['hoccaithien']>0) $hp_hocct = $r_config['hoccaithien'];

if(isset($_POST['ht_id'])) {
	$masv = isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$id_mon = isset($_POST['id_mon'])?addslashes(strip_tags($_POST['id_mon'])):'';
	$ht_id = isset($_POST['ht_id'])?(int)$_POST['ht_id']:-1;
	$type = isset($_POST['type'])?(int)$_POST['type']:1;
	$hocky = isset($_POST['hocky'])?(int)$_POST['hocky']:1;
	if($ht_id<0) die();
	
	// lay thong tin le phi thi lai tu bảng hệ đào tạo
	$sql = "SELECT * FROM tbl_he WHERE id IN (SELECT id_he FROM tbl_dangky_tuyensinh WHERE masv='$masv')";
	$obj->Query($sql);
	if($obj->Num_rows()>0) {
		$r_he = $obj->Fetch_Assoc(); 
		if( $r_he['hocphi_thilai']>0) $hp_thilai = $r_he['hocphi_thilai'];
		if( $r_he['hocphi_thict']>0) $hp_thict = $r_he['hocphi_thict'];
		if( $r_he['hocphi_hoclai']>0) $hp_hoclai = $r_he['hocphi_hoclai'];
		if( $r_he['hocphi_hocct']>0) $hp_hocct = $r_he['hocphi_hocct'];
	}

	// lay du lieu diem cu
	$sql="SELECT diem FROM tbl_hoctap WHERE id='$ht_id'";
	$obj->Query($sql);
	$r = $obj->Fetch_Assoc();
	$diem = json_decode($r['diem'],true); 
	$diem1 = isset($diem['chuyencan'])?$diem['chuyencan']:'';
	$diem2 = isset($diem['diemkt'])?$diem['diemkt']:'';
	$diem3 = isset($diem['diemthi'])?$diem['diemthi']:'';
	$thilai = isset($diem['thilai'])?$diem['thilai']:'';
	$arr_diem['chuyencan'] 	= $diem1;
	$arr_diem['diemkt'] 	= $diem2;
	$arr_diem['diemthi'] 	= $diem3;
	$arr_diem['thilai'] 	= $thilai;
	$json = json_encode($arr_diem,JSON_UNESCAPED_UNICODE);
	
	// Update thi lại, status=2: thi lại
	$cdate = time(); 
	// $status=2; // thi lại
	$status = 'HT06'; // thi lại
	if($type==2) $status=3; // thi cải thiện
	$sql = "UPDATE tbl_hoctap SET diem='$json',mdate=$cdate,status=$status WHERE id='$ht_id'";
	$obj->Exec("BEGIN");
	$result1 = $obj->Exec($sql); //echo $sql;
	
	// // Thêm khoản phí thi lại/thi cải thiện
	// $sql = "INSERT INTO tbl_hocphi (masv,hocky,hocphi,ten_hp,type_hp) 
	// VALUES('$masv','$hocky','$hp_thilai','Lệ phí thi lại môn $id_mon','khac')";
	// if($type==2)
	// 	$sql = "INSERT INTO tbl_hocphi (masv,hocky,hocphi,ten_hp,type_hp) 
	// 	VALUES('$masv','$hocky','$hp_thict','Lệ phí thi cải thiện môn $id_mon','khac')";
	// $result2 = $obj->Exec($sql); //echo $sql." ; ";
	
	// Note bảng tbl_hoctap_note
	$note = "Đăng ký thi lại môn $id_mon"; 
	if($type==2) $note = "Đăng ký thi cải thiện điểm môn $id_mon"; 
	$sql = "INSERT INTO tbl_hoctap_note (id_hoctap,masv,id_monhoc,notes,cdate,author) 
	VALUES('$ht_id','$masv','$id_mon','$note',$cdate,'$user')";
	$result3 = $obj->Exec($sql); //echo $sql;
	
	// note bảng tbl_notify
	$note = "#$masv đăng ký thi lại."; 
	if($type==2) $note = "#$masv đăng ký thi cải thiện điểm."; 
	$sql = "INSERT INTO tbl_notify (masv,notes,cdate,author) VALUES('$masv','$note',$cdate,'$user')";
	$result4 = $obj->Exec($sql); //echo $sql." ; ";
	
	if($result1 && $result3 && $result4) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>