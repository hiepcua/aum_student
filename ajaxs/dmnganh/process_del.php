<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['id'])) {
	$id=addslashes(htmlentities(strip_tags($_POST['id'])));
	$obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_lop WHERE id_nganh='$id'";
	$obj->Query($sql);
	if($obj->Num_rows()<=0){
		$sql="DELETE FROM tbl_nganh WHERE id='$id'";
		$obj->Exec($sql);
		die('success');
	}else{
		die('Vẫn còn lớp học!');
	}
}?>