<?php session_start();
require_once('../global/libs/gfconfig.php');
require_once('../global/libs/gfinit.php');
require_once('../global/libs/gffunc.php');
require_once('../includes/gfconfig.php');
require_once('../libs/cls.mysql.php');
require_once('../libs/cls.users.php');
$obj = new CLS_MYSQL; 
if(isset($_GET['cmnd'])) {
	$cmt = addslashes(strip_tags($_GET['cmnd']));
	$ma_mon = isset($_GET['ma_mon'])?addslashes(strip_tags($_GET['ma_mon'])):'';
	$sql="SELECT a.masv FROM tbl_dangky_tuyensinh AS a 
		INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.cmt='$cmt'"; 
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc($sql);
	$masv=$r['masv'];
	$sql = "SELECT `diem`,`id_monhoc` FROM tbl_hoctap WHERE masv='$masv' ";
	if($ma_mon!='') $sql.=" AND id_monhoc='$ma_mon' "; 
	$sql.=" ORDER BY id_monhoc ASC "; 
	$obj->Query($sql);
	$arr = array();
	while($r=$obj->Fetch_Assoc()) {
		$arr[$r['id_monhoc']]=json_decode($r['diem'],true);
	}
	echo json_encode($arr,JSON_UNESCAPED_UNICODE);
} ?>