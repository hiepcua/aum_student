<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$objMySql=new CLS_MYSQL;
$id_order = (isset($_POST['id_order'])) ? $_POST['id_order'] : '';
$txt_note = (isset($_POST['txt_note'])) ? $_POST['txt_note'] : '';
$UserLogin=new CLS_USER;
$username=$UserLogin->getInfo('username');
$cdate=time();
$sql="INSERT INTO tbl_order_note(`oid`,`uid`,`cdate`,`note`) VALUES('$id_order','$username','$cdate','$txt_note')";
$objMySql->Exec($sql);
echo 'success';
?>