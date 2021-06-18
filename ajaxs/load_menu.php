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

$cur_year = isset($_GET['year']) && $_GET['year']!='' ? antiData($_GET['year']): '';
$cur_nganh = isset($_GET['nganh']) && $_GET['nganh']!='' ? antiData($_GET['nganh']): '';
$cur_bac = isset($_GET['bac']) && $_GET['bac']!='' ? antiData($_GET['bac']): '';
$cur_staff = isset($_GET['staff']) && $_GET['staff']!='' ? antiData($_GET['staff']): '';

$_SESSION['THIS_YEAR'] = $cur_year;
$_SESSION['THIS_BAC'] = $cur_bac;
$_SESSION['THIS_NGANH'] = $cur_nganh;
$_SESSION['THIS_STAFF'] = $cur_staff;
?>