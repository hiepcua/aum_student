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
$url='http://uid.aumsys.net/api/edu/nganh';
$json = array();
$json['key'] = PIT_API_KEY;
$json['id'] = '';

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$res_nganh = isset($res_data['data']) ? $res_data['data'] : array();

if(is_array($res_nganh) && count($res_nganh)>0){
	// Import data to json file
	$url_file = DOCUMENT_ROOT.'jsons/nganh.json';
	file_put_contents($url_file, json_encode($res_nganh));
	die('success');
}
die('error');
?>