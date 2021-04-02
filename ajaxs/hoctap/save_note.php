<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$objMySql=new CLS_MYSQL;
$id_ht = (isset($_POST['id_ht'])) ? $_POST['id_ht'] : '';
$txt_note = (isset($_POST['txt_note'])) ? $_POST['txt_note'] : '';
$UserLogin=new CLS_USER;
$username=$UserLogin->getInfo('username');
$cdate=time();
$sql="INSERT INTO tbl_hoctap_note(`id_hoctap`,`cdate`,`notes`,`author`) 
VALUES('$id_ht','$cdate','$txt_note','$username')";
$objMySql->Exec($sql); //echo $sql;
echo 'success';
?>