<?php
session_start();
ini_set('display_errors',1);
define('incl_path','../../global/libs/');
define('libs_path','../../libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
// require_once(incl_path.'gffunc_member.php');
// callback responsive
if(!isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN'])){
	if(isset($_SESSION['SESSION_LOGIN']) && intval($_SESSION['SESSION_LOGIN'])>0){
		$user = isset($_GET['user'])?$_GET['user']:'';
		$pass = isset($_GET['pass'])?$_GET['pass']:'';
		$sig  = isset($_GET['sig'])?$_GET['sig']:'';
		$status  = isset($_GET['status'])?$_GET['status']:'no';
		$gcode  = isset($_GET['gcode'])?$_GET['gcode']:'';
		$pcode  = isset($_GET['pcode'])?$_GET['pcode']:'';
		$permiss  = isset($_GET['permiss'])?$_GET['permiss']:'';
		$uid  = isset($_GET['uid'])?$_GET['uid']:'';
		if($user!=''){ // chưa đăng nhập
			
			if (hash_equals(hash('sha256', $user.$pass.$status, APP_SECRET), $sig)) {
				if($status=='yes'){
					$user=antiData($user);
					$pass=antiData($pass);
					$status=antiData($status);
					$gcode=antiData($gcode);
					$pcode=antiData($pcode);
					$permiss=antiData($permiss);
					$uid=antiData($uid);
					$arr=array('user'=>$user,'pass'=>$pass,'status'=>$status,'islogin'=>true,'gcode'=>$gcode,'pcode'=>$pcode,'permiss'=>$permiss,'uid'=>$uid);
					$_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']=$arr;
					
					// echo "Login success!"; // redirect to homepage
					header("location:".ROOTHOST);
				}else{
					echo "Login failse";
				}
			}else{
				echo "Thông tin bị chỉnh sửa"; // dữ liệu đã bị chỉnh sửa
			}
		}else{
			echo "user is empty!";
		}
	}else{
		die('Login incorrectly');
	}
	unset($_SESSION['SESSION_LOGIN']);
}else{
	header("location:".ROOTHOST);
}
?>