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
if(isset($_POST['khoa'])) {
	$khoa = (int)$_POST['khoa'];
	$he = addslashes(strip_tags($_POST['he']));
	$nganh = addslashes(strip_tags($_POST['nganh']));
		
	$sql = "SELECT count( id_hoso) as total
			FROM tbl_dangky_tuyensinh 
			WHERE trungtuyen=1 AND nhaphoc=1 AND (malop is null OR malop='')
			AND id_khoa=$khoa AND id_nganh=$nganh  AND id_he='$he' 
			GROUP BY id_nganh";
	$obj = new CLS_MYSQL;
	$obj->Query($sql);
	$r = $obj->Fetch_Assoc();
	echo $r['total']+0;
}