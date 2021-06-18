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
$user = $objuser->getInfo('username');
if(isset($_POST['ma'])){
	$arr		= array();
	$arr['ma']	= isset($_POST['ma']) ? antiData($_POST['ma']) : '';
	$hoten 		= isset($_POST['hoten']) ? antiData($_POST['hoten']) : '';
	$name 		= explode(" ",$hoten);
	$arr['name']	= $name[count($name)-1];
	$arr['ho_dem'] 	= trim(str_replace($arr['name'],"",$hoten));
	$arr['nickname']= isset($_POST['tengoi']) ? antiData($_POST['tengoi']) : '';
	$arr['quoctich']= isset($_POST['quoctich']) ? antiData($_POST['quoctich']) : '';
	$arr['ngaysinh']= !empty($_POST['ngaysinh']) ? antiData($_POST['ngaysinh'],'time') : null;
	$arr['noisinh']	= isset($_POST['noisinh']) ? antiData($_POST['noisinh']) : '';
	$arr['gioitinh']= isset($_POST['gender']) ? (int)$_POST['gender'] : 0;
	$arr['nguyenquan']= isset($_POST['nguyenquan']) ? antiData($_POST['nguyenquan']) : '';
	$arr['hktt'] 	= isset($_POST['hokhau']) ? antiData($_POST['hokhau']) : '';
	$arr['city']	= isset($_POST['cbo_city']) ? (int)$_POST['cbo_city'] : '';
	$arr['email']	= isset($_POST['email']) ? antiData($_POST['email']) : '';
	$arr['dienthoai']= isset($_POST['dienthoai']) ? (int)$_POST['dienthoai'] : '';
	$arr['author']	= $objuser->getInfo('username');
	$arr['cdate']	= time();	
	$arr['mdate']	= time();	
	
	$exist = SysCount('tbl_hocsinh', "AND ma='".$arr['ma']."'");
	if((int)$exist <= 0){
		$result = SysAdd('tbl_hocsinh', $arr);
		if($result){
			die('success');
		}else{
			die('error');
		}
	}else die('exist');
}