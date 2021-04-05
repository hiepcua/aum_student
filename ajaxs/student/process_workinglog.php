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

if(isset($_POST['id_working_log']) && $_POST['id_working_log']!=='') {
	$id_working_log = $_POST['id_working_log'];
	$chk_done = isset($_POST['chk_done']) && $_POST['chk_done']=='on' ? 1:0;
	$date_done = isset($_POST['date_done']) ? strtotime($_POST['date_done']):null;
	$noidung_done = isset($_POST['noidung_done']) ? antiData($_POST['noidung_done']):'';
	$ketqua_done = isset($_POST['ketqua_done']) ? antiData($_POST['ketqua_done']):'';
	$cdate = time();

	$sql = "UPDATE tbl_working_log SET `date`=$date_done, noidung='$noidung_done', ketqua='$ketqua_done', finish='$chk_done', author='$user', mdate='$cdate' WHERE id=$id_working_log";
	$result1 = $obj->Exec($sql);
	if($result1) {
		echo "success";
	}else { 
		echo "error";
	}
}?>