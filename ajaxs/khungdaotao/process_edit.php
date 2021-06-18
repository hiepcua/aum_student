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

$id = isset($_POST['txtid']) && $_POST['txtid']!=='' ? antiData($_POST['txtid'], 'int') : '';
if($id!=='') {
	$nganh = antiData($_POST['nganh']);
	$he = antiData($_POST['he']);
	$monhoc = antiData($_POST['monhoc']);
	$hocky = antiData($_POST['hocky'], 'int');
	$slot = antiData($_POST['slot'], 'int');
	$tinchi = antiData($_POST['txttinchi'], 'int');
	$chuyencan = antiData($_POST['txtchuyencan'], 'int');
	$kiemtra = antiData($_POST['txtkiemtra'], 'int');
	$thi = antiData($_POST['txtthi'], 'int');
	$tong = antiData($_POST['txttong'], 'int');
	$arr_tuan = isset($_POST['tuan']) ? $_POST['tuan'] : '';
	$arr_noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';

	$arr_lotrinh = array();
	if(is_array($arr_tuan) && is_array($arr_noidung) && count($arr_tuan) > 0){
		foreach ($arr_tuan as $key => $value) {
			$arr_tmp = array();
			$arr_tmp['tuan'] = $value;
			$arr_tmp['noidung'] = isset($arr_noidung[$key]) ? $arr_noidung[$key] : '';
			array_push($arr_lotrinh, $arr_tmp);
		}
	}
	$lotrinh = addslashes(json_encode($arr_lotrinh));

	$obj=new CLS_MYSQL;
	$obj->Exec("BEGIN");
	$sql="UPDATE tbl_hocphan_khung SET `id_nganh`='$nganh',`id_he`='$he',`id_monhoc`='$monhoc',
	`tinchi`='$tinchi',`diem_chuyencan`='$chuyencan',`diem_kiemtra`='$kiemtra',
	`diem_thi`='$thi',`total`='$tong',`hocky`='$hocky',`slot`='$slot',`lotrinh`='$lotrinh' WHERE id='$id'";
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
}else{
	die('Không tồn tại ID');
}?>