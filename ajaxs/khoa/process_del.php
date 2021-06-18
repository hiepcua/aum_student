<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['id'])) {
	$id=addslashes(htmlentities(strip_tags($_POST['id'])));

	$obj=new CLS_MYSQL;
	$sql="DELETE FROM tbl_khoa WHERE id='$id'";
	$obj->Exec($sql);

	// Import data to json file
	$url_file = DOCUMENT_ROOT.'jsons/khoa.json';
	$json = file_get_contents($url_file);
	$arr_json = json_decode($json, true);

	$arr_new = array();
	if(count($arr_json)>0){
		foreach ($arr_json as $key => $value) {
			if($value['id'] !== $id){
				$arr_new[] = $value;
			}
		}
		$arr_json = $arr_new;
	}
	file_put_contents($url_file, json_encode($arr_json));

	die('success');
}?>