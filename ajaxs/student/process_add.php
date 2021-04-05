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
$user = $objuser->getInfo('username');
if(isset($_POST['ma'])){
	$partner 	= 0;
	$ma 		= isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$masv 		= isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$hoten 		= isset($_POST['hoten'])?addslashes(strip_tags($_POST['hoten'])):'';
	$name 		= explode(" ",$hoten);
	$name 		= $name[count($name)-1];
	$ho_dem 	= trim(str_replace($name,"",$hoten));
	$tengoi 	= isset($_POST['tengoi'])?addslashes(strip_tags($_POST['tengoi'])):'';
	$quoctich 	= isset($_POST['quoctich'])?addslashes(strip_tags($_POST['quoctich'])):'';
	$ngaysinh	= !empty($_POST['ngaysinh'])?strtotime($_POST['ngaysinh']):null;
	$noisinh 	= isset($_POST['noisinh'])?addslashes(strip_tags($_POST['noisinh'])):'';
	$gioitinh 	= isset($_POST['gender'])?(int)$_POST['gender']:0;
	$nguyenquan	= isset($_POST['nguyenquan'])?addslashes(strip_tags($_POST['nguyenquan'])):'';
	$hokhau		= isset($_POST['hokhau'])?addslashes(strip_tags($_POST['hokhau'])):'';
	$city		= isset($_POST['cbo_city'])?(int)$_POST['cbo_city']:'';
	$dantoc		= isset($_POST['dantoc'])?addslashes(strip_tags($_POST['dantoc'])):'';
	$tongiao	= isset($_POST['tongiao'])?addslashes(strip_tags($_POST['tongiao'])):'';
	$khuvuc		= isset($_POST['khuvuc'])?addslashes(strip_tags($_POST['khuvuc'])):'';
	$doituong	= isset($_POST['doituong'])?addslashes(strip_tags($_POST['doituong'])):'';
	$daoduc		= isset($_POST['daoduc'])?addslashes(strip_tags($_POST['daoduc'])):'';
	$trinhdo	= isset($_POST['trinhdo'])?addslashes(strip_tags($_POST['trinhdo'])):'';
	$diencs		= isset($_POST['diencs'])?addslashes(strip_tags($_POST['diencs'])):'';
	$thanhphan	= isset($_POST['thanhphan'])?addslashes(strip_tags($_POST['thanhphan'])):'';
	$doan		= isset($_POST['doan'])?addslashes(strip_tags($_POST['doan'])):'';
	$dang		= isset($_POST['dang'])?addslashes(strip_tags($_POST['dang'])):'';
	$ngayct		= !empty($_POST['ngayct'])?strtotime($_POST['ngayct']):null;
	$cmnd		= isset($_POST['cmnd'])?addslashes(strip_tags($_POST['cmnd'])):'';
	$ngaycap	= !empty($_POST['ngaycap'])?strtotime($_POST['ngaycap']):null;
	$noicap		= isset($_POST['noicap'])?addslashes(strip_tags($_POST['noicap'])):'';
	$stk		= isset($_POST['stk'])?addslashes(strip_tags($_POST['stk'])):'';
	$email		= isset($_POST['email'])?addslashes(strip_tags($_POST['email'])):'';
	$diachi		= isset($_POST['diachi'])?addslashes(strip_tags($_POST['diachi'])):'';
	$dienthoai	= isset($_POST['dienthoai'])?addslashes(strip_tags($_POST['dienthoai'])):'';
	$ghichu		= isset($_POST['ghichu'])?addslashes(strip_tags($_POST['ghichu'])):'';
	$author		= $objuser->getInfo('username');
	$cdate 		= time();
	$qhgd = "";
	
	if(isset($_SESSION["SV$ma"]['TAB_QHGD'])) $qhgd=json_encode($_SESSION["SV$ma"]['TAB_QHGD'],JSON_UNESCAPED_UNICODE);
	$qtht = "";
	if(isset($_SESSION["SV$ma"]['TAB_QTHT'])) $qtht=json_encode($_SESSION["SV$ma"]['TAB_QTHT'],JSON_UNESCAPED_UNICODE);
	$qthoc = "";
	if(isset($_SESSION["SV$ma"]['TAB_QTHOC'])) $qthoc=json_encode($_SESSION["SV$ma"]['TAB_QTHOC'],JSON_UNESCAPED_UNICODE);
	$khenthuong = "";
	if(isset($_SESSION["SV$ma"]['TAB_KHENTHUONG'])) $khenthuong=json_encode($_SESSION["SV$ma"]['TAB_KHENTHUONG'],JSON_UNESCAPED_UNICODE);
	$kyluat = "";
	if(isset($_SESSION["SV$ma"]['TAB_KYLUAT'])) $kyluat=json_encode($_SESSION["SV$ma"]['TAB_KYLUAT'],JSON_UNESCAPED_UNICODE);
	
	if(isset($_SESSION["SV$ma"]['TAB_QHGD'])) unset($_SESSION["SV$ma"]['TAB_QHGD']);
	if(isset($_SESSION["SV$ma"]['TAB_QHHT'])) unset($_SESSION["SV$ma"]['TAB_QHHT']);
	if(isset($_SESSION["SV$ma"]['TAB_QHHOC'])) unset($_SESSION["SV$ma"]['TAB_QHHOC']);
	if(isset($_SESSION["SV$ma"]['TAB_KHENTHUONG'])) unset($_SESSION["SV$ma"]['TAB_KHENTHUONG']);
	if(isset($_SESSION["SV$ma"]['TAB_KYLUAT'])) unset($_SESSION["SV$ma"]['TAB_KYLUAT']);
	
	$obj=new CLS_MYSQL;
	$obj->Exec("BEGIN");
	$sql = "INSERT INTO tbl_hocsinh (`partner_id`,`ma`,`masv`,ho_dem,name,nickname,ngaysinh,noisinh,
	gioitinh,diachi,dienthoai,`cmt`,ngaycap_cmt,noicap_cmt,
	quoctich,nguyenquan,hktt,city,
	dantoc,tongiao,	khuvucTS,doituongUT,
	daoduc,trinhdo,diencs,thanhphan,
	doan,dang,ngayct,stk,email,note,
	qhgiadinh,qthoctap,qthoc,khenthuong,kyluat,
	partner,author,cdate,mdate,isactive) 
	VALUES('$partner','$ma','$masv','$ho_dem','$name','$tengoi',$ngaysinh,'$noisinh',
	'$gioitinh','$diachi','$dienthoai','$cmnd','$ngaycap','$noicap',
	'$quoctich','$nguyenquan','$hokhau','$city',
	'$dantoc','$tongiao','$khuvuc','$doituong',
	'$daoduc','$trinhdo','$diencs','$thanhphan',
	'$doan','$dang','$ngayct','$stk','$email','$ghichu',
	'$qhgd','$qtht','$qthoc','$khenthuong','$kyluat',
	'$partner','$author',$cdate,$cdate,1)";
	$result1=$obj->Exec($sql); //echo $sql;

	$sql = "INSERT INTO tbl_dangky_tuyensinh (cdate,id_hoso,nhaphoc,author,status,isactive) 
		VALUES($cdate,'$ma',1,'$user','L0',1)"; 
	$result2 = $obj->Exec($sql); //echo $sql;
	
	// dang ky note
	$sql = "INSERT INTO tbl_dangky_note (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','$masv','Hồ sơ #$ma ($ho_dem $name) tạo mới thành công',$cdate,'$user')";
	$result4 = $obj->Exec($sql); //echo $sql;
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','','Hồ sơ #$ma ($ho_dem $name) tạo mới thành công',$cdate,'$user')";
	$result3 = $obj->Exec($sql); //echo $sql;
	
	if($result1 && $result2 && $result3 && $result4) {
		$obj->Exec("COMMIT"); echo $ma;
	}else {
		$obj->Exec("ROLLBACK"); echo "error";
	}
}