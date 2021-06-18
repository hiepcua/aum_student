<?php
session_start();
ini_set('display_errors',1);
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(incl_path.'gffunc_member.php');
require_once(libs_path.'cls.mysql.php');

if($key==PIT_API_KEY){
	$data = array();
	$flag = true;
	if(is_array($data) && count($data)>0){
		foreach ($data as $key => $value) {
			$masv = $key;
			$status_HP = $value['tinhtrang_hocphi']!="" ? $value['tinhtrang_hocphi'] : "";
			$status_call_HP = $value['tinhtrang_call_hp']!="" ? $value['tinhtrang_call_hp'] : "";
			$result = SysEdit("tbl_dangky_tuyensinh", array('tinhtrang_hocphi'=>$status_HP, 'tinhtrang_call_hp'=>$status_call_HP), "masv='".$masv."'");
			if(!$result) $flag==false;
		}
	}
	if ($flag==false) echo 'error';
	else echo 'success';
}else{
	echo 'error';
}
die();