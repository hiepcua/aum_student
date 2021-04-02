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
$user = $objuser->getInfo('username');

if(isset($_POST['id'])){
	$id 	= isset($_POST['id'])?addslashes($_POST['id']):'';
	// 
	$sql = "select count(id) as total FROM tbl_dangky_tuyensinh 
			WHERE malop IN (SELECT id FROM tbl_lop WHERE id='$id')
			group by malop";
	$obj->Query($sql);
	$r = $obj->Fetch_Assoc();
	if($r['total']>0) die("notdel");
	
	$sql="DELETE FROM tbl_lop WHERE id='$id'";
	$result1 = $obj->Exec($sql);
	echo "success";
}