<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj=new CLS_MYSQL;
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$nganh=isset($_GET['nganh'])?$_GET['nganh']:'';
$he=isset($_GET['he'])?$_GET['he']:'';
$monhoc=isset($_GET['monhoc'])?$_GET['monhoc']:'';

/* Get all môn học */
$json_monhoc = file_get_contents(DOCUMENT_ROOT.'jsons/monhoc.json');
$res_monhoc = json_decode($json_monhoc, true);

/* Lấy tất cả môn học đã được tạo với hệ `$he` trong tbl_hocphan_khung */
$arr_exist = array();
$res_hochphankhung = SysGetList('tbl_hocphan_khung', array(), "AND id_nganh='".$nganh."' AND id_he='".$he."'");
if(count($res_hochphankhung)>0){
	foreach ($res_hochphankhung as $key => $value) {
		$arr_exist[] = $value['id_monhoc'];
	}
}
?>
<option value="">Chọn học phần</option>
<?php 
if(is_array($res_monhoc) && count($res_monhoc)>0){
	foreach ($res_monhoc as $key => $value) {
		$id = stripslashes($value['id']);
		$name = stripslashes($value['name']);
		$select = $monhoc == $id ? "selected=true" : '';
		$disable = '';
		if(in_array($id, $arr_exist) && $id !== $monhoc){
			$disable = "disabled='true' class='disabled'";
		}
		echo "<option $select value='$id' ".$disable.">$name</option>";
	}
}
?>