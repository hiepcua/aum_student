<?php 
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once("../../libs/cls.mysql.php");
require_once("../../libs/cls.users.php");
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$objmysql =  new CLS_MYSQL;

if(isset($_POST['identify'])) {
	$identify = $_POST['identify'];
	$sql = "SELECT * FROM tbl_user  WHERE identify='$identify'";
	$objmysql->Query($sql);	
	$r=$objmysql->Fetch_Assoc();
	$id=$r['id'];
	$json = "[";
	if ($objmysql->Num_rows() > 0)  {
		$json.= "{\"rep\":\"yes\", \"id\": \"$id\"}";
	} 
	else {
		$json.= "{\"rep\":\"no\", \"id\": \"\"}";
	}
	echo $json."]";
	
} else if (isset($_POST['userID'])) {
	$userID = $_POST['userID'];
	$sql = "SELECT * FROM tbl_user  WHERE id=$userID";
	$objmysql->Query($sql);	
	$r=$objmysql->Fetch_Assoc();
	$id=$r['id'];
	
	if($r['avatar']!='') $avatar=$r['avatar'];
	else $avatar = ROOTHOST.'uploads/user.png';
	
	$name=$r['fullname'];
	$identify=$r['identify'];
	$gender=$r['gender']==0 ? 'Nữ' : 'Nam';
	$phone=$r['phone'];
	$address=$r['address'];

	$json = "[";
	if ($objmysql->Num_rows() > 0)  {
		$json.= "{\"rep\":\"yes\", 
				\"id\": \"$id\",
				\"avatar\": \"$avatar\",
				\"name\": \"$name\",
				\"identify\": \"$identify\",
				\"gender\": \"$gender\",
				\"phone\": \"$phone\",
				\"address\": \"$address\"}";
	} 
	else {
		$json.= "{\"rep\":\"no\", \"id\": \"\"}";
	}
	echo $json."]";

} else {
	$json = "[";
	$json.= "{\"rep\":\"no\", \"id\": \"\"}]";
	echo $json."]";
}

?>