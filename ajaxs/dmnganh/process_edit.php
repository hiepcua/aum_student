<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('user');

if(isset($_POST['id'])) {
	$obj = new CLS_MYSQL;
	$obj->Exec("BEGIN");
	$id = antiData($_POST['id']);
	$id_bo = antiData($_POST['id_bo']);
	$name = antiData($_POST['name']);

	$sql="UPDATE tbl_nganh SET `id_bo`='$id_bo',`name`='$name' WHERE id='$id'";
	$result1 = $obj->Exec($sql);
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('','','Mã ngành $id vừa cập nhật',".time().",'$user')";
	$result2 = $obj->Exec($sql);

	// Import data to json file
	$url_file = DOCUMENT_ROOT.'jsons/nganh.json';
	$json = file_get_contents($url_file);
	$arr_json = json_decode($json, true);

	$arr_new = array();
	if(count($arr_json)>0){
		foreach ($arr_json as $key => $value) {
			$tmp = array();
			$tmp['id'] = $id;
			$tmp['id_bo'] = $id_bo;
			$tmp['name'] = $name;

			if($value['id'] == $id){
				$arr_new[] = $tmp;
			}else{
				$arr_new[] = $value;
			}
		}
		$arr_json = $arr_new;
	}
	file_put_contents($url_file, json_encode($arr_json));
	
	if($result1 && $result2) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>