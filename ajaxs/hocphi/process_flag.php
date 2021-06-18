<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('user');

$id_order_detail = isset($_POST['id_order_detail']) ? antiData($_POST['id_order_detail']) : "";
$flag = isset($_POST['cbo_flag']) ? antiData($_POST['cbo_flag'], 'int') : "0";
$content = isset($_POST['content']) ? antiData($_POST['content']) : "";

if($id_order_detail!=="") {
	$url='http://uid.aumsys.net/api/student/order_edit';
	$json = array();
	$json['key'] = PIT_API_KEY;
	$json['id_detail'] = $id_order_detail;
	$json['flag'] = $flag;
	$json['ghichu'] = $content;

	$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
	$params = json_encode(array('data'=>$jsondata));
	$res_data = Curl_Post($url, $params);
	$response = isset($res_data['data']) ? $res_data['data'] : "no";

	if($response=="Success"){
		die("success");
	}else{
		die("error");
	}
}?>