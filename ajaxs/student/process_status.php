<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');

if(isset($_POST['masv']) && $_POST['masv']!=='') {
	$masv = $_POST['masv'];
	$id_dkts = isset($_POST['id_dkts'])? antiData($_POST['id_dkts']) : '';
	$id_hoso = isset($_POST['id_hoso'])? antiData($_POST['id_hoso']) : '';
	$status = isset($_POST['cbo_status']) ? antiData($_POST['cbo_status']):'';

	$chk_done = isset($_POST['chk_done']) && $_POST['chk_done']=='on' ? 1:0;
	$date_done = isset($_POST['date_done']) ? strtotime($_POST['date_done']):null;
	$noidung_done = isset($_POST['noidung_done']) ? antiData($_POST['noidung_done']):'';
	$ketqua_done = isset($_POST['ketqua_done']) ? antiData($_POST['ketqua_done']):'';

	$chk_kehoach = isset($_POST['chk_kehoach']) && $_POST['chk_kehoach']=='on' ? 1:0;
	$date_kehoach = isset($_POST['date_kehoach']) ? strtotime($_POST['date_kehoach']):null;
	$noidung_kehoach = isset($_POST['noidung_kehoach']) ? antiData($_POST['noidung_kehoach']):'';
	$ketqua_kehoach = isset($_POST['ketqua_kehoach']) ? antiData($_POST['ketqua_kehoach']):'';
	
	$obj->Exec("BEGIN"); $cdate =time();
	$sql = "UPDATE tbl_dangky_tuyensinh SET status='$status' WHERE id=$id_dkts";
	// echo $sql;
	$result1 = $obj->Exec($sql);

	// Insert dang_ky_note
	$sql = "INSERT INTO tbl_dangky_note (id_hoso, masv, notes, cdate, author) VALUES ('$id_hoso','$masv','Sinh viên #$masv cập nhật trạng thái thành công',$cdate,'$user')";
	// echo $sql;
	$result3 = $obj->Exec($sql);

	// Insert working_log
	$sql = "INSERT INTO tbl_working_log (id_hoso, masv, `date`, noidung, ketqua, finish, author, cdate) VALUES ('$id_hoso','$masv','$date_done','Sinh viên #$masv cập nhật tương tác','$ketqua_done','$chk_done','$user',$cdate)";
	$result4 = $obj->Exec($sql);

	// Insert dang_ky_note
	$sql = "INSERT INTO tbl_working_log (id_hoso, masv, `date`, noidung, ketqua, finish, author, cdate) VALUES ('$id_hoso','$masv','$date_kehoach','Sinh viên #$masv thêm kế hoạch tương tác','$ketqua_kehoach','$chk_kehoach','$user',$cdate)";
	$result5 = $obj->Exec($sql);
	
	// notify
	$sql = "INSERT INTO tbl_notify (id_hoso,masv,notes,cdate,author) 
	VALUES('$id_hoso','','Hồ sơ #$id_hoso cập nhật trạng thái thành công',$cdate,'$user')";
	$result2 = $obj->Exec($sql);
	
	if($result1 && $result2 && $result3) {
		$obj->Exec("COMMIT"); echo "success";
	}else { 
		$obj->Exec("ROLLBACK"); echo "error";
	}
}?>