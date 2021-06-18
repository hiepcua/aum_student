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
	$obj=new CLS_MYSQL;
	$id=addslashes(strip_tags($_POST['id']));
	$name=addslashes(strip_tags($_POST['name']));
	$hocky=(int)$_POST['hocky'];
	$hocphi=(int)$_POST['hocphi'];
	$hocphi_thilai=(int)$_POST['hocphi_thilai'];
	$hocphi_thict=(int)$_POST['hocphi_thict'];
	$hocphi_hoclai=(int)$_POST['hocphi_hoclai'];
	$hocphi_hocct=(int)$_POST['hocphi_hocct'];
	
	$sql="UPDATE tbl_he SET `name`='$name',`hocphi`='$hocphi',`hocphi_thilai`='$hocphi_thilai',
	`hocphi_thict`='$hocphi_thict',`hocphi_hoclai`='$hocphi_hoclai',
	`hocphi_hocct`='$hocphi_hocct',`sohocky`='$hocky' WHERE id='$id'";
	$obj->Exec($sql);

	// Import data to json file
	$url_file = DOCUMENT_ROOT.'jsons/he.json';
	$json = file_get_contents($url_file);
	$arr_json = json_decode($json, true);

	$arr_new = array();
	if(count($arr_json)>0){
		foreach ($arr_json as $key => $value) {
			$tmp = array();
			$tmp['id'] = $id;
			$tmp['name'] = $name;
			$tmp['hocphi'] = $hocphi;
			$tmp['hocphi_thilai'] = $hocphi_thilai;
			$tmp['hocphi_thict'] = $hocphi_thict;
			$tmp['hocphi_hoclai'] = $hocphi_hoclai;
			$tmp['hocphi_hocct'] = $hocphi_hocct;
			$tmp['sohocky'] = $hocky;
			$tmp['isactive'] = $value['isactive'];

			if($value['id'] == $id){
				$arr_new[] = $tmp;
			}else{
				$arr_new[] = $value;
			}
		}
		$arr_json = $arr_new;
	}
	file_put_contents($url_file, json_encode($arr_json));
	die('success');
}?>