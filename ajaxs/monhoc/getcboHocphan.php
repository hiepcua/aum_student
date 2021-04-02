<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj=new CLS_MYSQL;
$objuser=new CLS_USER;
$nganh=isset($_GET['nganh'])?$_GET['nganh']:'';
$he=isset($_GET['he'])?$_GET['he']:'';
$monhoc=isset($_GET['monhoc'])?$_GET['monhoc']:'';;
$sql="SELECT * FROM tbl_monhoc WHERE id NOT IN (SELECT id_monhoc FROM tbl_hocphan_khung WHERE id_nganh='$nganh' AND id_he='$he')";
// echo $sql;
if(!$objuser->isLogin()) die("E01");
?>
<option value=''>Chọn học phần</option>
<?php 
$obj->Query($sql);
while($r=$obj->Fetch_Assoc()){
	$id=stripslashes($r['id']);
	$name=stripslashes($r['name']);
	$select=$monhoc==$id?"selected=true":'';
	echo "<option $select value='$id'>$name</option>";
}
?>