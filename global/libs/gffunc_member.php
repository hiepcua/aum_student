<?php
function isLogin(){
	if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']) && $_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']['islogin']){
		/* $user=getInfo('username');
		if(checkExpires($user)===true) return false; */
		return true;
	}
	return false;
}
function getSessionLogin(){
	if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']) && $_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']['islogin']){
		return $_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN'];
	}
	return null;
}
function setSessionLogin($data){
	if(is_array($data)){ $_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']=$data;}
	else {$_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']=null;}
}
function getInfo($field){
	$info=isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN'][$field])?$_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN'][$field]:'N/a';
	return $info;
}
function setInfo($field,$val){
	if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']))$_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN'][$field]=$val;
}
function checkExpires($user){
	// get session login
	$now=time();
	if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']) && $now-$_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']['action_time']>=ACTION_TIMEOUT){
		$obj=new CLS_POSTGRES;
		$sql="SELECT session FROM aum_uid_login WHERE username='$user' AND isactive=1 ORDER BY id DESC";
		$obj->Query($sql);
		if($obj->Num_rows()>0){
			$r=$obj->Fetch_Assoc();
			if($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']['session']!=$r['session']){
				LogOut($user);
				return true;
			}
		}else{
			die('Check Expire error. Please contact administrator!');
		}
	}
	// check time out login
	if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']) && $now-$_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']['action_time']>=MEMBER_TIMEOUT){
		LogOut();
	}
	return false;
}
function LogIn($user,$pass){
	$arr=array('status'=>'no','data'=>null);
	if($user==''||$pass=='')	return $arr;
	$fields=array();
	$obj=new CLS_POSTGRES;
	if(SysCount("aum_uid"," AND (username='$user' OR id='$user') AND isactive='yes'")!=1) return $arr;
	$r=SysGetList("aum_uid",$fields," AND (id='$user' OR username='$user') AND isactive='yes'");
	// echo $pass;
	if($r[0]['password']!=$pass) return $arr;
	$arr['status']='yes';
	$arr['data']=$r[0];
	return $arr;
}
function LogOut($user){
	if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN'])){
		unset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']);
		unset($_SESSION['USER_INFO']);
	}
}