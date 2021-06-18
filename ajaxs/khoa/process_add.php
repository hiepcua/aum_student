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
if(isset($_POST['type'])) {
	$type = isset($_POST['type'])?(int)$_POST['type']:1;
	$year = isset($_POST['year'])?addslashes(strip_tags($_POST['year'])):'';

	$res_khoa = SysGetList('tbl_khoa', array(), 'AND id='.$year);
	if(count($res_khoa) > 0){
		die("E02");
	}else{
		//if($year>0) $id = "Y".$type.$year; else $id=-1;
		$id=$year;
		$name = isset($_POST['name'])?addslashes(strip_tags($_POST['name'])):'';
		$ngay = isset($_POST['ngay'])?addslashes(strip_tags($_POST['ngay'])):'';
		$startDay = strtotime($ngay);
		$sl = isset($_POST['sl'])?(int)$_POST['sl']:0;

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
				$tmp['type'] = $type;

				if($value['id'] == $id){
					$arr_new[] = $value;
				}else{
					$arr_new[] = $tmp;
				}
			}
			$arr_json = $arr_new;
		}
		file_put_contents($url_file, json_encode($arr_json));

		$sql = "INSERT INTO tbl_khoa (id,name,startDay,quan,`type`) 
		VALUES('$id','$name',$startDay,$sl,$type)"; //echo $sql;
		$obj = new CLS_MYSQL;
		$result = $obj->Exec($sql);
		if($result) echo "success";
	}
}?>