<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$obj=new CLS_MYSQL;
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
if(isset($_POST['nganh'])) {
	$khoa = isset($_POST['khoa'])?addslashes(strip_tags($_POST['khoa'])):'';
	$he = isset($_POST['he'])?addslashes(strip_tags($_POST['he'])):'';
	$nganh = isset($_POST['nganh'])?addslashes(strip_tags($_POST['nganh'])):'';
	$siso = isset($_POST['siso'])?(int)$_POST['siso']:30;
	$count_hoso = isset($_POST['count_hoso'])?(int)$_POST['count_hoso']:1;
	$solop = isset($_POST['solop'])?(int)$_POST['solop']:1;
	$malop_1 = isset($_POST['malop_1'])?addslashes(strip_tags($_POST['malop_1'])):'';
	$malop_2 = isset($_POST['malop_2'])?addslashes(strip_tags($_POST['malop_2'])):'';
	$malop_3 = isset($_POST['malop_3'])?addslashes(strip_tags($_POST['malop_3'])):'';
	$malop = $malop_1.$malop_2.$malop_3;
	$malop_arr = explode("@",$malop); // @ là Giá trị tự động tăng 1,2,3...
	if(isset($malop_arr[0])) $ma1 = $malop_arr[0]; else $ma1=$malop;
	if(isset($malop_arr[1])) $ma2 = $malop_arr[1]; else $ma2='';
	
	// Lấy tất cả danh sách hồ sơ cần phân lớp
	$sql = "SELECT id_khoa,id_he,id_nganh,id_hoso FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.isactive=1 AND trungtuyen=1 AND nhaphoc=1 AND malop is null AND id_nganh='$nganh' AND id_khoa='$khoa' AND id_he='$he'";
	$obj->Query($sql); //echo $sql.' || ';
	$arr_hoso=array(); $id_he=$id_khoa='';
	while($r=$obj->Fetch_Assoc()) {
		$arr_hoso[]=$r['id_hoso'];
		$id_he =$r['id_he'];
		$id_khoa =$r['id_khoa'];
	}
	
	// Đếm tổng mã lớp đang có thuộc khóa,hệ,ngành
	$sql = "SELECT count(*) as total FROM tbl_lop 
			WHERE id_khoa='$khoa' AND id_nganh='$nganh'";
	$obj->Query($sql); 
	$total_lop=0;
	if($obj->Num_rows()>0) {
		$r=$obj->Fetch_Assoc();
		$total_lop =$r['total']+0;
	}
	$total_lop++;
	for($i=1;$i<=$solop;$i++) {
		$idlop = $ma1.$total_lop.$ma2; $total_lop++;
		// Tạo danh sách mã lớp mới
		$obj=new CLS_MYSQL;
		$cdate = time();
		$sql = "INSERT INTO tbl_lop(id,id_nganh,id_he,id_khoa,cdate) VALUES('$idlop','$nganh','$id_he','$id_khoa',$cdate)";
		$result1 = $obj->Exec($sql); //echo $sql.' || ';
		
		// Update mã lớp cho danh sách hồ sơ
		$ids = ""; $from =($i-1)*$siso; $to = $i*$siso-1;
		if($to>$count_hoso) $to=$count_hoso-1;
		for($k=$from;$k<=$to;$k++) $ids.= $arr_hoso[$k]."','";
		if($ids!="") $ids=substr($ids,0,strlen($ids)-3);
		
		$sql = "UPDATE tbl_dangky_tuyensinh SET malop='$idlop' WHERE id_hoso IN ('$ids')";
		$result2 = $obj->Exec($sql); //echo $sql.' || ';
		
		$ids = str_replace("'","",$ids);
		$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
		VALUES('','','$count_hoso hồ sơ được phân lớp $idlop',$cdate,'$user')";
		$result3 = $obj->Exec($sql); //echo $sql.' || ';
		
		$sql="SELECT hocphi FROM tbl_he WHERE id=$id_he";
		$obj->Query($sql);   
		$r = $obj->Fetch_Assoc();
		$hocphi=$r['hocphi'];
		
		// select chương trình học của lớp đó
		$sql = "SELECT id_monhoc,tinchi FROM tbl_chuongtrinhhoc WHERE id_lop='$lop'";
		$obj->Query($sql);  
		
		while($r = $obj->Fetch_Assoc()) {
			$mon = $r['id_monhoc'];
			$tc = $r['tinchi'];
			$hk	= $r['hocky'];
			// Tạo chương trình học cho sinh viên
			$sql = "INSERT INTO tbl_hoctap(`masv`,`id_monhoc`,`tinchi`,status) 
					VAlUES('$masv','$mon','$tc',null)";
			$obj->Exec($sql);

			// Tạo học phí theo tín chỉ cho sinh viên 
			$ma_hp=$mon;
			$type_hp='hoc_phan';
			$ten_hp='hoc chinh';
			$money=$hocphi*$tc;
			$sql="INSERT INTO tbl_hocphi(`masv`,`hocky`,`hocphi`,`ma_hp`,`ten_hp`,`type_hp`,`ispay`) 
			VAlUES('$masv','$hk','$money','$ma_hp','$ten_hp','$type_hp','0')";
			$obj->Exec($sql); //echo $sql.' \n';
		}
		echo "success";
	}
}?>