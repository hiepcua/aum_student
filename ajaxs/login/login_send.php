<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');

$_API_SOURCE="http://uid.aumsys.net/sso/login";
//----------------
$_CALL_BACK	= ROOTHOST."ajaxs/login/login_callback.php";
$user=isset($_POST['username'])?antiData($_POST['username']):"";
$pass=isset($_POST['password'])?antiData($_POST['password']):"";

$pass=hash('sha256', $user).'|'.hash('sha256', $pass);
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
?>