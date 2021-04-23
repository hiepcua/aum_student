<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../libs/cls.mysql.php");

$_API_SOURCE="http://uid.aumsys.net/sso/login";
$_CALL_BACK	= ROOTHOST.'ajaxs/user/login_callback.php';
// $user='nxtuyen.pro@gmail.com';
// $pass='123456';

$user=isset($_POST['txtuser'])?antiData($_POST['txtuser']):"";
$pass=isset($_POST['txtpass'])?antiData($_POST['txtpass']):"";

$sig = hash(
	'sha256',
	$user.$pass,
	APP_SECRET
);
$source = parse_url($_API_SOURCE);
$target =in_array($source['host'], $_HOST_LIST)?'http://'.$source['host'].$source['path']:'';
if($target!=''){
	$_SESSION['SESSION_LOGIN']=time();
	$url=$target.'?'.'user='.urlencode($user).'&pass='.urlencode($pass).'&sourse='.urlencode($_CALL_BACK).'&sig='.urlencode($sig);
	header('location:'.$url);
}else{
	die('Api source is empty!');
}