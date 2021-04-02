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
$objdata=new CLS_MYSQL;

// Check quyền
$check_permission = $objuser->Permission('user');
$check_permis_group = $objuser->Permission('gusers');
if($check_permission==false || $check_permis_group==false) die('E02');

$gid=isset($_POST['txt_gid'])?(int)$_POST['txt_gid']:0;
$parid=isset($_POST['cbo_parid'])?(int)$_POST['cbo_parid']:0;
$name=isset($_POST['txtname'])?addslashes($_POST['txtname']):'';
$intro=isset($_POST['txtdesc'])?addslashes($_POST['txtdesc']):'';

$total=0;
if(isset($_POST['permission'])){
	foreach($_POST['permission'] as $item)
		$total+=$item;
}

if(isset($_POST['cmd_update'])){
	$sql="UPDATE `tbl_user_group` SET `par_id`='$parid',`name`='$name',`intro`='$intro',`permission`='$total' WHERE id='$gid'"; 
	$objdata->Query($sql); //echo $sql;
}else{
	$sql="INSERT INTO tbl_user_group(par_id,`name`,`intro`,permission) VALUES ($parid,'$name','$intro',$total)";
	$objdata->Query($sql); //echo $sql;
}
$objuser->getGroupUser(0);
?>