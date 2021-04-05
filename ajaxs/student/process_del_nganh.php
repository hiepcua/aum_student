<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$id_dkts = isset($_POST['id_dkts']) && $_POST['id_dkts']!='' ? antiData($_POST['id_dkts']) : '';
if($id_dkts !== ''){
	SysDel('tbl_dangky_tuyensinh', "id='".$id_dkts."'");
	die('success');
}
?>