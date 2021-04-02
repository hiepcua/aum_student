<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../global/libs/gffunc_edu.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$obj=new CLS_MYSQL;
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
if(isset($_POST['sophong'])) {
	$sophong = isset($_POST['sophong'])?(int)$_POST['sophong']:1;
	$sots 	= isset($_POST['sots'])?(int)$_POST['sots']:1;
	$tiento = isset($_POST['tiento'])?addslashes(strip_tags($_POST['tiento'])):'';
	$start 	= isset($_POST['start'])?addslashes(strip_tags($_POST['start'])):'';
	$num_char = strlen($start);
	$start = (int)$start;
	
	// Lấy tất cả danh sách hồ sơ cần phân phòng thi
	$sql = "SELECT a.* FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.isactive=1 and b.masv='' 
		HAVING a.trungtuyen is null and (a.sbd is null or a.sbd='') ";
		
	$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.city,c.name as city_name, b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		INNER JOIN tbl_city AS c ON b.city=c.id
		WHERE a.xettuyen=0 AND (sbd='' OR sbd is null) ";
		
	$nganh=isset($_POST['nganh'])?addslashes(strip_tags($_POST['nganh'])):'';
	$khoa=isset($_POST['khoa'])?addslashes(strip_tags($_POST['khoa'])):'';
	$he=isset($_POST['he'])?addslashes(strip_tags($_POST['he'])):'';

	if($nganh!='') $sql.=" AND a.id_nganh='$nganh'";
	if($khoa!='') $sql.=" AND a.id_khoa='$khoa'";
	if($he!='') $sql.=" AND a.id_he='$he'";
	$sql.=" ORDER BY a.id DESC, a.id_nganh ASC";
	$obj->Query($sql);
	$count_hoso = $obj->Num_rows();
	$arr_hoso=array();
	while($r=$obj->Fetch_Assoc()) $arr_hoso[]=$r['id_hoso'];
	//print_r($arr_hoso);
	
	for($i=1;$i<=$sophong;$i++) {
		$phong = "P".$i;
		// Update sbd+phòng thi cho danh sách hồ sơ
		$from =($i-1)*$sots; $to = $i*$sots-1;
		if($to>$count_hoso) $to=$count_hoso-1;
		for($k=$from;$k<=$to;$k++){
			$item = $arr_hoso[$k];
			$stt = create_sbd($start,$num_char);
			$sbd = $tiento.$stt;
			
			$sql2 = "UPDATE tbl_dangky_tuyensinh SET sbd='$sbd',phongthi='$phong',`status`='TS2' WHERE id_hoso='$item'";
			$result = $obj->Exec($sql2); //echo $sql2.' || ';
			$start++;
		}
		// notify
		$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
		VALUES('','','$count_hoso Hồ sơ đã cập nhật sbd & phòng thi',".time().",'$user')";
		$result2 = $obj->Exec($sql);
	}
	echo "success";
}?>