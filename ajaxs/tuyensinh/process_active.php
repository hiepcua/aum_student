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
$ma=isset($_GET['ma'])?addslashes($_GET['ma']):'';
$sql="UPDATE tbl_hocsinh SET isactive=if(isactive=1,0,1) WHERE ma='$ma'";
$obj->Exec($sql);
die('ok');