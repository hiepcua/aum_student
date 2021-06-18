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
if(isset($_POST['value'])) {
	$id = isset($_POST['value'])?addslashes(strip_tags($_POST['value'])):'';
	$year = isset($_POST['year'])?addslashes(strip_tags($_POST['year'])):'';
	$name = isset($_POST['name'])?addslashes(strip_tags($_POST['name'])):'';
	$ngay = isset($_POST['ngay'])?addslashes(strip_tags($_POST['ngay'])):'';
	$startDay = strtotime($ngay);
	$sl = isset($_POST['sl'])?(int)$_POST['sl']:0;
	$sql = "UPDATE tbl_khoa SET name='$name',startDay='$startDay',quan='$sl'
	WHERE id='$id'";
	$obj = new CLS_MYSQL;
	$result = $obj->Exec($sql);

	// Import data to json file
	$url_file = DOCUMENT_ROOT.'jsons/khoa.json';
	$json = file_get_contents($url_file);
	$arr_json = json_decode($json, true);

	$arr_new = array();
	if(count($arr_json)>0){
		foreach ($arr_json as $key => $value) {
			$tmp = array();
			$tmp['id'] = $id;
			$tmp['name'] = $name;
			$tmp['startDay'] = $startDay;
			$tmp['quan'] = $sl;
			$tmp['type'] = $value['type'];

			if($value['id'] == $id){
				$arr_new[] = $tmp;
			}else{
				$arr_new[] = $value;
			}
		}
		$arr_json = $arr_new;
	}
	file_put_contents($url_file, json_encode($arr_json));

	if($result) echo "success";
}?>