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
	$obj=new CLS_MYSQL;
	$he=addslashes(htmlentities(strip_tags($_POST['id'])));
	$sql="SELECT * FROM tbl_he WHERE id='$he'";
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc();
	$sohocky=$r['sohocky']; 
	for($i=1;$i<=$sohocky;$i++){
		echo "<option value='$i'>Học kỳ $i</option>";
	}
} ?>