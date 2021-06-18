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

//---- Lấy danh sách ngành ---------
$url='http://uid.aumsys.net/api/hedaotao';
$json = array();
$json['key'] = PIT_API_KEY;
$json['id_school'] = SCHOOL_CODE;
$json['id'] = '';

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$res_he = isset($res_data['data']) ? $res_data['data'] : array();

if(is_array($res_he) && count($res_he)>0){
	// Import data to json file
	$url_file = DOCUMENT_ROOT.'jsons/he.json';
	file_put_contents($url_file, json_encode($res_he));
	die('success');
}
die('error');
?>