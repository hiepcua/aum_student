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
$user = $objuser->getInfo('user');

$_ma_monhoc = isset($_POST['mon']) ? antiData($_POST['mon']) : '';
if($_ma_monhoc!==''){
	$_ma_he 	= isset($_POST['he']) ? $_POST['he'] : "";
	$_ma_nganh 	= isset($_POST['nganh']) ? antiData($_POST['nganh'], 'int') : "";
	$_ma_lop 	= isset($_POST['lop']) ? antiData($_POST['lop']) : "";
	$_tc 		= isset($_POST['tc']) ? antiData($_POST['tc'], 'int') : 1;
	$_hocky 	= isset($_POST['hk']) && antiData($_POST['hk'], 'int') > 0 ? antiData($_POST['hk'], 'int') : 0;
	$_slot 		= isset($_POST['slot']) && antiData($_POST['slot'], 'int') > 0 ? antiData($_POST['slot'], 'int') : 0;
	$_start_date = isset($_POST['start_date']) ? strtotime($_POST['start_date']) : 0;
	$_cdate = time();

	if($_ma_lop=="" || $_ma_monhoc=="" || $_tc=="" || ($_hocky==0 && $_slot==0) || $_start_date=="") die("nodata");

	/* Thêm chương trình học cho lớp */
	$obj->Exec("BEGIN");
	$sql="INSERT INTO tbl_chuongtrinhhoc(`id_lop`,`id_monhoc`,`hocky`,`slot`,`tinchi`,`start_date`,`cdate`) 
		VALUES('$_ma_lop','$_ma_monhoc','$_hocky','$_slot','$_tc','$_start_date','$_cdate')";
	$result1 = $obj->Exec($sql); 

	/* Get lộ trình khung của học phần */
	$res_hpk = SysGetList('tbl_hocphan_khung', array(), "AND id_nganh='".$_ma_nganh."' AND id_he='".$_ma_he."' AND id_monhoc='".$_ma_monhoc."'");
	$row_hpk = isset($res_hpk[0]) ? $res_hpk[0] : '';

	$arr_lotrinh = '';
	if($row_hpk!==''){
 		$arr_lotrinh = strlen($row_hpk['lotrinh'])>0 ? json_decode($row_hpk['lotrinh'], true) : '';
	}

	/* Get all môn học */
	$_arr_monhoc = array();
	$json_monhoc = file_get_contents(DOCUMENT_ROOT.'jsons/monhoc.json');
	$arr_monhoc = json_decode($json_monhoc, true);
	foreach ($arr_monhoc as $key => $value) {
		$_arr_monhoc[$value['id']] = $value;
	}
	
	/* Tính tổng học phí phải thu tạm tính */
	$res_he = SysGetList('tbl_he', array('hocphi'), "AND id='".$_ma_he."'");
	$row_he = $res_he[0];
	$hocphi = $row_he['hocphi'];
	$money = $hocphi * $_tc;

	/* Get masv theo mã lớp */
	$arr_masv = getMaSV($_ma_lop); 
	foreach($arr_masv as $masv) {
		/* Tạo chương trình học cho sinh viên trong lớp */
		$sql = "INSERT INTO tbl_hoctap(`masv`,`id_monhoc`,`tinchi`,`status`) VAlUES('$masv','$_ma_monhoc','$_tc','-1')";
		$result2 = $obj->Exec($sql); 

		/* Tạo học phí theo tín chỉ */
		$ma_truong = '';
		$masv_edu = '';
		$ma_lop = $_ma_lop;
		$ma_hp = $_ma_monhoc;
		$ten_hp = isset($_arr_monhoc[$_ma_monhoc]) ? $_arr_monhoc[$_ma_monhoc]['name'] : '';
		$slot = $_slot;
		$hocky = $_hocky;
		$hocphi = $money;
		$dadong = 0;
		$conlai = $hocphi;

		$sql="INSERT INTO tbl_hocphi (`masv`,`ma_truong`,`masv_edu`,`ma_lop`,`ma_hp`,`ten_hp`,`slot`,`hocky`,`hocphi`,`dadong`,`conlai`) VAlUES ('$masv','$ma_truong', '$masv_edu','$_ma_lop','$_ma_monhoc','$ten_hp','$_slot','$_hocky','$hocphi','$dadong','$conlai')";
		$result3 = $obj->Exec($sql); 

		/* Thêm lộ trình chăm sóc học tập cho từng sinh viên trong lớp */
		if($arr_lotrinh!==''){
 			foreach ($arr_lotrinh as $key => $value) {
 				$tuan = $value['tuan'];
 				$noidung = $value['noidung'];
 				/* Ngày bắt đầu chăm sóc = Ngày bắt đầu học phần + lộ trình khung */
 				$date = $_start_date + 7*86400*$tuan; 
 				$arr_log = array();
 				$arr_log['masv'] = $masv;
 				$arr_log['ma_mon'] = $_ma_monhoc;
 				$arr_log['date'] = $date;
 				$arr_log['noidung'] = $noidung;
 				$arr_log['cdate'] = time();
 				$arr_log['author'] = $user;
 				$arr_log['type'] = 'hoctap';
 				SysAdd('tbl_working_log', $arr_log);
 			}
 		}
	}
	
	if($result1) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}	
} ?>