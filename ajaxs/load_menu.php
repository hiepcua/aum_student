<?php
session_start();
require_once('../global/libs/gfconfig.php');
require_once('../global/libs/gfinit.php');
require_once('../global/libs/gffunc.php');
require_once('../includes/gfconfig.php');
require_once('../libs/cls.mysql.php');
require_once('../libs/cls.users.php');

$obju = new CLS_USER;
if(!$obju->isLogin()) die('Vui lòng đăng nhập');

$cur_year = isset($_GET['year']) && $_GET['year']!='' ? addslashes(strip_tags($_GET['year'])): '';
$cur_nganh = isset($_GET['nganh']) && $_GET['nganh']!='' ? (int)$_GET['nganh']: '';
$cur_bac = isset($_GET['bac']) && $_GET['bac']!='' ? addslashes(strip_tags($_GET['bac'])): '';
$_SESSION['THIS_YEAR'] = $cur_year;
$_SESSION['THIS_BAC'] = $cur_bac;
$_SESSION['THIS_NGANH'] = $cur_nganh;

// $res_bac = SysGetList('tbl_he',array(),"");
// if(count($res_bac) > 0){
// 	foreach ($res_bac as $key => $value) {
// 		$value['id'];
// 		echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
// 	}
// }


// $res_nganh = SysGetList('tbl_nganh',array(),"");
// if(count($res_nganh) > 0){
// 	foreach ($res_nganh as $key => $value) {
// 		$nganh_id = $value['id']; 
// 		if($key == 0 && $cur_nganh == '') $_SESSION['THIS_NGANH'] = $nganh_id;
// 		echo '<option value="'.$nganh_id.'">'.$value['name'].'</option>';
// 	}
// }
// if($cur_nganh > 0) $_SESSION['THIS_NGANH'] = $cur_nganh;
?>