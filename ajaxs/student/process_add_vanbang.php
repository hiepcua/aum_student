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
if(isset($_POST['ma'])){
	$arr			= array();
	$arr['id_hoso']	= isset($_POST['ma']) ? antiData($_POST['ma']) : '';
	$arr['masv']	= isset($_POST['masv']) ? antiData($_POST['masv']) : '';
	$arr['type']  	= 1;
	$id_khoa		= isset($_POST['cbokhoa']) ? explode("-",antiData($_POST['cbokhoa'])) : '';
	$arr['id_khoa'] = $id_khoa[0];
	$id_he			= isset($_POST['cbobac']) ? explode("-",antiData($_POST['cbobac'])) : '';
	$arr['id_he'] 	= $id_he[0];
	$id_nganh		= isset($_POST['cbonganh']) ? explode("-",antiData($_POST['cbonganh'])) : '';
	$arr['id_nganh']= $id_nganh[0];
	
	$arr['hetotnghiep']	= isset($_POST['hetotnghiep']) ? antiData($_POST['hetotnghiep']) : '';
	$arr['dotnhaphoc']	= isset($_POST['dotnhaphoc']) ? (int)$_POST['dotnhaphoc'] : 0;
	$arr['kyhoc']	= isset($_POST['kyhoc']) ? antiData($_POST['kyhoc']) : '';
	$arr['malop'] 	= isset($_POST['cbolop']) ? antiData($_POST['cbolop']) : '';
	$arr['id_staff']= isset($_POST['nguoiphutrach']) ? (int)$_POST['nguoiphutrach'] : '';
	$arr['ngayBG']	= isset($_POST['ngayBG']) ? antiData($_POST['ngayBG'],'time') : '';
	$arr['tinhtrangBG'] = isset($_POST['tinhtrangBG']) ? antiData($_POST['tinhtrangBG']) : '';
	$arr['lydoBG']	= isset($_POST['lydoBG']) ? antiData($_POST['lydoBG']) : '';
	
	$arr['hs_tinhtrang'] = isset($_POST['HStinhtrang']) ? antiData($_POST['HStinhtrang']) : '';
	$arr['hs_vo'] 	= isset($_POST['hsvo']) ? antiData($_POST['hsvo']) : 0;
	$arr['hs_anh'] 	= isset($_POST['hsanh']) ? antiData($_POST['hsanh']) : 0;
	$arr['hs_bang'] = isset($_POST['hsbang']) ? antiData($_POST['hsbang']) : 0;
	$arr['hs_cn_totnghiep'] = isset($_POST['hscntn']) ? antiData($_POST['hscntn']) : 0;
	$arr['hs_bangdiem'] = isset($_POST['hsbangdiem']) ? antiData($_POST['hsbangdiem']) : 0;
	$arr['hs_hocba']= isset($_POST['hshocba']) ? antiData($_POST['hshocba']) : 0;
	$arr['hs_pdk'] 	= isset($_POST['hspdk']) ? antiData($_POST['hspdk']) : 0;
	$arr['hs_giay_ks'] 	= isset($_POST['hsksk']) ? antiData($_POST['hsksk']) : 0;
	$arr['hs_cmt'] 	= isset($_POST['hscmt']) ? antiData($_POST['hscmt']) : 0;
	$arr['hs_syll'] = isset($_POST['hssyll']) ? antiData($_POST['hssyll']) : 0;
	
	$arr['qd_trungtuyen'] = isset($_POST['qdtrungtuyen']) ? antiData($_POST['qdtrungtuyen']) : '';
	$arr['qd_congnhansv'] = isset($_POST['qd_congnhansv']) ? antiData($_POST['qd_congnhansv']) : '';
	$arr['tinhtrang_sv']  = isset($_POST['tinhtranghv']) ? antiData($_POST['tinhtranghv']) : '';
	$arr['tinhtrang_hocphi'] = isset($_POST['tinhtranghp']) ? antiData($_POST['tinhtranghp']) : '';
	
	$arr['author']	= $objuser->getInfo('username');
	
	$exist = SysCount('tbl_dangky_tuyensinh', "AND id_hoso='".$arr['id_hoso']."' AND masv='".$arr['masv']."'");
	if((int)$exist <= 0){
		$arr['cdate']	= time();
		$result = SysAdd('tbl_dangky_tuyensinh', $arr);
		if($result){
			die('success');
		}else{
			die('error');
		}
	}else {
		$arr['mdate']	= time();
		$result = SysEdit('tbl_dangky_tuyensinh', $arr, " id_hoso='".$arr['id_hoso']."' AND masv='".$arr['masv']."'");
		if($result){
			die('success');
		}else{
			die('error');
		}
	}
}