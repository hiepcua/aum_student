<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$objmysql = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('user');

$masv = isset($_POST['masv']) ? antiData($_POST['masv']) : '';
if($masv!=='') {
	$ma_hoso = isset($_POST['ma_hoso']) ? antiData($_POST['ma_hoso']) : '';
	$level = isset($_POST['cbo_level'])? antiData($_POST['cbo_level']) : '';
	$status_sv = isset($_POST['cbo_status_sv'])? antiData($_POST['cbo_status_sv']) : '';
	$status_hp = isset($_POST['cbo_status_hp'])? antiData($_POST['cbo_status_hp']) : '';
	$status_call = isset($_POST['cbo_status_call'])? antiData($_POST['cbo_status_call']) : '';
	$status_call_hp = isset($_POST['cbo_status_call_hp'])? antiData($_POST['cbo_status_call_hp']) : '';

	$arr_log = array();
	if(isset($_POST['noidung']) && $_POST['noidung']!=""){
		foreach ($_POST['noidung'] as $key => $value) {
			$tmp = array();
			$tmp['id_hoso'] = $ma_hoso;
			$tmp['masv'] = $masv;
			$tmp['noidung'] = isset($_POST['noidung'][$key]) ? antiData($_POST['noidung'][$key]) : '';
			$tmp['date'] = isset($_POST['startdate'][$key]) ? strtotime($_POST['startdate'][$key]) : '';
			$tmp['finish'] = isset($_POST['finish'][$key]) ? antiData($_POST['finish'][$key]) : '';
			$tmp['cdate'] = time();
			$tmp['author'] = $user;
			$arr_log[] = $tmp;
		}
	}

	$values_log = "";
	if(count($arr_log)>0){
		foreach ($arr_log as $key => $log) {
			if(count($log)>0){
				$str_log="";
				foreach ($log as $key => $value) {
					$str_log.="'$value',";
				}
				if($str_log!==""){
					$values_log.="(".substr($str_log,0,-1)."),";
				}
			}
		}
	}

	if($values_log!==""){
		$values_log = substr($values_log,0, strlen($values_log)-1).";";
	}

	$objmysql->Exec("BEGIN");
	$sql="UPDATE tbl_dangky_tuyensinh SET `tinhtrang_sv` = '".$status_sv."',`tinhtrang_hocphi` = '".$status_hp."', `tinhtrang_call` = '".$status_call."', `status` = '".$level."', `tinhtrang_call_hp` = '".$status_call_hp."' WHERE masv='".$masv."'";
	$result = $objmysql->Exec($sql);

	$sql="INSERT INTO tbl_working_log (`id_hoso`,`masv`,`noidung`,`date`,`finish`,`cdate`,`author`) VALUES".$values_log;
	$result1 = $objmysql->Exec($sql);

	if($result && $result1) {
		$objmysql->Exec("COMMIT"); 
		die('success');
	}else { 
		$objmysql->Exec("ROLLBACK"); 
		die('error');
	}
}?>