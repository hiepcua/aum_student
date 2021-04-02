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
$obj=new CLS_MYSQL;
if(isset($_POST['ma'])){	//print_r($_POST);
	$partner 	= 0;
	$ma 		= isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
	$masv 		= isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';
	$hoten 		= isset($_POST['hoten'])?addslashes(strip_tags($_POST['hoten'])):'';
	$name = explode(" ",$hoten);
	$name = $name[count($name)-1];
	$ho_dem = trim(str_replace($name,"",$hoten));
	$tengoi 	= isset($_POST['tengoi'])?addslashes(strip_tags($_POST['tengoi'])):'';
	$quoctich 	= isset($_POST['quoctich'])?addslashes(strip_tags($_POST['quoctich'])):'';
	$ngaysinh	= isset($_POST['ngaysinh'])?addslashes(strip_tags($_POST['ngaysinh'])):'';
	$ngaysinh 	= strtotime($ngaysinh);
	$noisinh 	= isset($_POST['noisinh'])?addslashes(strip_tags($_POST['noisinh'])):'';
	$gioitinh 	= isset($_POST['gender'])?(int)$_POST['gender']:0;
	$nguyenquan	= isset($_POST['nguyenquan'])?addslashes(strip_tags($_POST['nguyenquan'])):'';
	$hokhau		= isset($_POST['hokhau'])?addslashes(strip_tags($_POST['hokhau'])):'';
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
	$ngayct		= isset($_POST['ngayct'])?addslashes(strip_tags($_POST['ngayct'])):'';
	$cmnd		= isset($_POST['cmnd'])?addslashes(strip_tags($_POST['cmnd'])):'';
	$ngaycap	= isset($_POST['ngaycap'])?addslashes(strip_tags($_POST['ngaycap'])):'';
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

	$id_dky = isset($_POST['id_dky'])?(int)$_POST['id_dky']:0;
	$ma_nganh = isset($_POST['ma_nganh'])?addslashes(strip_tags($_POST['ma_nganh'])):'';
	$bac = isset($_POST['cbobac'])?addslashes(strip_tags($_POST['cbobac'])):'';
	$khoa = isset($_POST['cbokhoa'])?addslashes(strip_tags($_POST['cbokhoa'])):'';
	$xettuyen = isset($_POST['tk_xettuyen'])? (int)$_POST['tk_xettuyen']:1;
	
	$dmhoso=array();
	$chk_hoso = isset($_POST['chk_hoso'])?$_POST['chk_hoso']:array();
	$date_hoso = isset($_POST['date_hoso'])?$_POST['date_hoso']:array();
	$dmhoso_ids = isset($_POST['dmhoso_ids'])?explode(",",$_POST['dmhoso_ids']):array();
	
	$sql="SELECT * FROM tbl_dmhoso WHERE id_he=$bac";
	$obj->Query($sql);
	while($r = $obj->Fetch_Assoc()){
		$id=$r['id'];
		$dmhoso[$id]['id']=$id;
		$dmhoso[$id]['name']=$r['name'];
		if(in_array($id, $dmhoso_ids)){
			$dmhoso[$id]['status']=1;
			if($date_hoso[$id]=='') $dmhoso[$id]['date']=date("d/m/Y");
			else $dmhoso[$id]['date']=$date_hoso[$id];
		}else{ 
			$dmhoso[$id]['status']=0;
			$dmhoso[$id]['date']='';
		}
	}
	$dmhoso = json_encode($dmhoso,JSON_UNESCAPED_UNICODE);
	
	$obj=new CLS_MYSQL;
	$obj->Exec("BEGIN");
	$sql = "UPDATE tbl_hocsinh SET `partner_id`='$partner',`masv`='$masv',
	ho_dem='$ho_dem',name='$name',nickname='$tengoi',
	ngaysinh='$ngaysinh',noisinh='$noisinh',gioitinh='$gioitinh',
	diachi='$diachi',dienthoai='$dienthoai',cmt='$cmnd',ngaycap_cmt='$ngaycap',
	noicap_cmt='$noicap',quoctich='$quoctich',nguyenquan='$nguyenquan',hktt='$hokhau',
	dantoc='$dantoc',tongiao='$tongiao',khuvucTS='$khuvuc',doituongUT='$doituong',
	daoduc='$daoduc',trinhdo='$trinhdo',diencs='$diencs',thanhphan='$thanhphan',
	doan='$doan',dang='$dang',ngayct='$ngayct',stk='$stk',email='$email',
	note='$ghichu',dmhoso='$dmhoso',qhgiadinh='$qhgd',qthoctap='$qtht',qthoc='$qthoc',
	khenthuong='$khenthuong',kyluat='$kyluat',author='$author',mdate='$cdate' WHERE ma='$ma'";
	$result1=$obj->Exec($sql); //echo $sql.'<br> ';

	$sbd 		= isset($_POST['sbd'])?addslashes(strip_tags($_POST['sbd'])):'';
	//$diem_ut 	= isset($_POST['diem_ut'])?(float)$_POST['diem_ut']:0;
	$mon1 		= isset($_POST['mon1'])?addslashes(strip_tags($_POST['mon1'])):'';
	$mon2 		= isset($_POST['mon2'])?addslashes(strip_tags($_POST['mon2'])):'';
	$mon3 		= isset($_POST['mon3'])?addslashes(strip_tags($_POST['mon3'])):'';
	//$diem_thuong= isset($_POST['diem_thuong'])?(float)$_POST['diem_thuong']:0;
	//$tong_diem	= isset($_POST['tong_diem'])?(float)$_POST['tong_diem']:0;
	
	if($id_dky>0){
		$sql = "UPDATE tbl_dangky_tuyensinh SET mdate=$cdate,id_khoa='$khoa',id_he='$bac',id_nganh='$ma_nganh',xettuyen='$xettuyen'";
		if($sbd!=='') $sql.=",sbd='$sbd'"; else $sql.=",sbd=null";
		if($mon1!=='') $sql.=",mon1='$mon1'"; else $sql.=",mon1=null";
		if($mon2!=='') $sql.=",mon2='$mon2'"; else $sql.=",mon2=null";
		if($mon3!=='') $sql.=",mon3='$mon3'"; else $sql.=",mon3=null";
		$sql.=",author='$user' WHERE id=$id_dky";
	}else{
		$sql = "INSERT INTO tbl_dangky_tuyensinh (cdate,id_khoa,id_he,id_nganh,id_hoso,xettuyen,diadiemhoc,sbd,mon1,mon2,mon3,author,status) 
		VALUES($cdate,'$khoa','$bac','$ma_nganh','$ma','$xettuyen',''";
		if($sbd!=='') $sql.=",'$sbd'"; else $sql.=",null";
		if($mon1!=='') $sql.=",'$mon1'"; else $sql.=",null";
		if($mon2!=='') $sql.=",'$mon2'"; else $sql.=",null";
		if($mon3!=='') $sql.=",'$mon3'"; else $sql.=",null";
		$sql.=",'$user','TS1')"; 
	}
	$result2 = $obj->Exec($sql); //echo $sql.'<br> ';
	
	// dang ky note
	$sql = "INSERT INTO tbl_dangky_note (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','$masv','Hồ sơ #$ma đã cập nhật thông tin',$cdate,'$user')";
	$result3 = $obj->Exec($sql); //echo $sql;
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$ma','','Hồ sơ #$ma đã cập nhật thông tin',$cdate,'$user')";
	$result4 = $obj->Exec($sql); //echo $sql.'<br> ';
	
	if($result3 && $result4) {
		$obj->Exec("COMMIT"); echo "success";
	}else {
		$obj->Exec("ROLLBACK"); echo "error";
	}			
}