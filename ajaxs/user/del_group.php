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

$id=isset($_GET['id'])?(int)$_GET['id']:0;

$res_user = SysGetList('tbl_user', array(), 'AND gid='.$id);
if(count($res_user)>0) die('E03');

$objuser->getListGroup(" AND id=$id");
$r=$objuser->Fetch_Assoc();

$sql="DELETE FROM tbl_user_group WHERE id='$id'";
$objdata->Exec($sql);
$objuser->getGroupUser(0);
?>