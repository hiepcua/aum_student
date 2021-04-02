<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once("../../libs/cls.mysql.php");
require_once("../../libs/cls.users.php");
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$username=isset($_POST['username'])?addslashes(strip_tags($_POST['username'])):'';
$objmysql = new CLS_MYSQL();
$sql="SELECT * FROM tbl_user WHERE isactive=1 AND `username`='$username' ";
$objmysql->Query($sql);
if($objmysql->Num_rows()>0){
	echo 'ERR';
}else{
	echo 'SUCCESS';
}
?>
