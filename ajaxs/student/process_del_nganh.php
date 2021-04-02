<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$id_hoso = isset($_POST['hoso']) && $_POST['hoso']!='' ? antiData($_POST['hoso']) : '';
$nganh = isset($_POST['nganh']) && $_POST['nganh']!='' ? antiData($_POST['nganh']) : '';

if($id_hoso !== '' && $nganh !== ''){
	SysDel('tbl_dangky_tuyensinh', "id_hoso='".$id_hoso."' AND id_nganh='".$nganh."'");
	die('success');
}
?>