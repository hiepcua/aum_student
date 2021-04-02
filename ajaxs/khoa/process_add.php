<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['type'])) {
	$type = isset($_POST['type'])?(int)$_POST['type']:1;
	$year = isset($_POST['year'])?addslashes(strip_tags($_POST['year'])):'';

	$res_khoa = SysGetList('tbl_khoa', array(), 'AND id='.$year);
	if(count($res_khoa) > 0){
		die("E02");
	}else{
		//if($year>0) $id = "Y".$type.$year; else $id=-1;
		$id=$year;
		$name = isset($_POST['name'])?addslashes(strip_tags($_POST['name'])):'';
		$ngay = isset($_POST['ngay'])?addslashes(strip_tags($_POST['ngay'])):'';
		$startDay = strtotime($ngay);
		$sl = isset($_POST['sl'])?(int)$_POST['sl']:0;
		$sql = "INSERT INTO tbl_khoa (id,name,startDay,quan,`type`) 
		VALUES('$id','$name',$startDay,$sl,$type)"; //echo $sql;
		$obj = new CLS_MYSQL;
		$result = $obj->Exec($sql);
		if($result) echo "success";
	}
}?>