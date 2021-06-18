<?php
defined('ISHOME') or die("You can't access this page!");
$strWhere="";
$obj = new CLS_MYSQL;
$id_he=$id_nganh=$id_khoa=$id_lop=$id_partner='';$arr_param=array();
$hocky=8; $slot=24; $get_hocky=''; $get_slot=''; $get_name=''; $get_startdate=''; $get_enddate=''; $get_flag='';
$THIS_STAFF = isset($_SESSION['THIS_STAFF']) ? $_SESSION['THIS_STAFF'] : '';
$arr_data = array(); // Mảng lưu tất cả các thông tin cần để hiển thị ra bên ngoài

// ----------------------------------------------
$_staff 		= $THIS_STAFF;
$id_he 			= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$id_nganh 		= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$get_hocky 		= isset($_GET['hocky']) ? antiData($_GET['hocky'], 'int') : '';
$get_slot 		= isset($_GET['slot']) ? antiData($_GET['slot'], 'int') : '';
$get_order 		= isset($_GET['order']) && $_GET['order']!=="" ? antiData($_GET['order']) : '';
$_id_lop 		= isset($_GET['malop']) && $_GET['malop']!=="" ? antiData($_GET['malop']) : '';
$_masv 			= isset($_GET['masv']) && $_GET['masv']!=="" ? antiData($_GET['masv']) : '';
$_khoa 			= isset($_GET['khoa']) ? antiData($_GET['khoa']):'';
$_hoten 		= isset($_GET['hoten']) ? antiData($_GET['hoten']) : '';
$_phone 		= isset($_GET['phone']) ? antiData($_GET['phone']):'';
$_birthday 		= isset($_GET['birthday']) && $_GET['birthday']!="" ? strtotime($_GET['birthday']):'';
$_email 		= isset($_GET['email']) ? antiData($_GET['email']):'';
$_level 		= isset($_GET['level']) ? antiData($_GET['level']):'';
$_statusSV 		= isset($_GET['statusSV']) ? antiData($_GET['statusSV']) : '';
$_statusHP 		= isset($_GET['statusHP']) ? antiData($_GET['statusHP']) : '';
$get_status 	= isset($_GET['status']) && $_GET['status']!=="" ? antiData($_GET['status']) : '';
$get_startdate 	= isset($_GET['startdate']) && $_GET['startdate']!="" ? antiData($_GET['startdate'], 'int') : '';
$get_enddate 	= isset($_GET['enddate']) && $_GET['enddate']!="" ? antiData($_GET['enddate'], 'int') : '';
$get_sdatelv 	= isset($_GET['sdatelv']) && $_GET['sdatelv']!="" ? strtotime($_GET['sdatelv']) : '';
$get_edatelv 	= isset($_GET['edatelv']) && $_GET['edatelv']!="" ? strtotime($_GET['edatelv']) : '';


/* Set params */
$arr_param['start_date'] = $get_startdate;
$arr_param['end_date'] 	= $get_enddate;
$arr_param['name'] 		= $get_name;
$arr_param['masv'] 		= $_masv;
$arr_param['id_order']	= $get_order;
$arr_param['hoten'] 	= $_hoten;
$arr_param['ngaysinh']	= $_birthday;
$arr_param['ma_he']		= $id_he;
$arr_param['ma_nganh']	= $id_nganh;
$arr_param['ma_lop']	= $_id_lop;
$arr_param['hocky'] 	= $get_hocky;
$arr_param['slot'] 		= $get_slot;
$arr_param['flag'] 		= $get_flag;
$arr_param['status']	= $get_status;
$json_param = json_encode($arr_param, JSON_UNESCAPED_UNICODE);

// Tình trạng HV theo mã sinh viên
$_ARR_STATUS_SV = $DKTS = array(); $arr_masv_staff = array();
if(!$IS_NV){
	$res_dkts = SysGetList('tbl_dangky_tuyensinh', array());
	foreach ($res_dkts as $key => $value) {
		$_ARR_STATUS_SV[$value['masv']] = $value['tinhtrang_sv'];
		$DKTS[$value['masv']] = $value;
	}
}else{
	$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND id_staff='".$THIS_STAFF."'");
	foreach ($res_dkts as $key => $value) {
		$_ARR_STATUS_SV[$value['masv']] = $value['tinhtrang_sv'];
		$DKTS[$value['masv']] = $value;
		$arr_masv_staff[] = $value['masv'];
	}
}

// Thông tin hồ sơ sinh viên
$HOCSINH = array();
$res_hssv = SysGetList('tbl_hocsinh', array());
if(count($res_hssv)>0){
	foreach ($res_hssv as $key => $value) {
		$HOCSINH[$value['ma']] = $value;
	}
}

// Get đăng ký tuyển sinh
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), $strWhere);
if(count($res_dkts)>0){
	foreach ($res_dkts as $key => $value) {
		$DKTS[$value['masv']] = $value;
	}
}

// Get môn học theo mã sv
$SV_MONHOC = array();
$sql="SELECT GROUP_CONCAT(id) AS ids, masv FROM tbl_hoctap GROUP BY(masv)";
$obj->Query($sql);
while ($row_hoctap = $obj->Fetch_Assoc()) {
	$SV_MONHOC[$row_hoctap['masv']] = $row_hoctap['ids'];
}

$SV_HOCTAP = array();
if(count($SV_MONHOC)>0){
	foreach ($SV_MONHOC as $key => $value) {
		$masv = $key;
		$arr_tmp = array();
		$hoctap_ids = $value!="" ? explode(',', $value) : array();

		if(is_array($hoctap_ids) && count($hoctap_ids)>0){
			foreach ($hoctap_ids as $k_IDhoctap => $v_IDhoctap) {
				$hoctap = isset($HOCTAP[$v_IDhoctap]) ? $HOCTAP[$v_IDhoctap] : "";
				if($hoctap!=""){
					$flag_status_monhoc = "NA";
					$flag_ktra = $flag_chuyencan = $flag_dkthi = "NA";
					$diem_chuyencan = $diem_kiemtra = $diem_thi = "";

					$dkthi = $hoctap['dieukienthi']!="" ? $hoctap['dieukienthi'] : "NA";
					if($dkthi==0){
						$HOCTAP[$v_IDhoctap]['flag_dkthi'] = 'do';
					}elseif($dkthi==1){
						$HOCTAP[$v_IDhoctap]['flag_dkthi'] = 'xanh';
					}else{
						$HOCTAP[$v_IDhoctap]['flag_dkthi'] = 'NA';
					}

					$arr_diem = $hoctap['diem']!="" ? json_decode($hoctap['diem'], true) : array();
					if(is_array($arr_diem) && count($arr_diem)>0){
						$diem_chuyencan = isset($arr_diem['chuyencan']) ? $arr_diem['chuyencan'] : "";
						$diem_kiemtra = isset($arr_diem['diemkt']) ? $arr_diem['diemkt'] : "";
						$diem_thi = isset($arr_diem['diemthi']) ? $arr_diem['diemthi'] : "";

						// Cờ điểm chuyên cần
						if($diem_chuyencan < 2){
							$flag_chuyencan = 'do';
						}
						else if($diem_chuyencan >= 2 && $diem_chuyencan < 5){
							$flag_chuyencan = 'vang';
						}
						else if($diem_chuyencan >= 5 && $diem_chuyencan <= 10){
							$flag_chuyencan = 'xanh';
						}

						// Cờ điểm kiểm tra
						if($diem_kiemtra < 2){
							$flag_ktra = 'do';
						}
						else if($diem_kiemtra >= 2 && $diem_kiemtra < 5){
							$flag_ktra = 'vang';
						}
						else if($diem_kiemtra >= 5 && $diem_kiemtra <= 10){
							$flag_ktra = 'xanh';
						}

						// Cờ trạng thái môn học
						if($dkthi=='do' || $flag_chuyencan=='do' || $flag_ktra=='do'){
							$flag_status_monhoc = 'do';
						}elseif ($dkthi=='xanh' && $flag_chuyencan=='xanh' && $flag_ktra=='xanh') {
							$flag_status_monhoc = 'xanh';
						}else{
							$flag_status_monhoc = 'vang';
						}

						// Gán cờ vào từng id học tập
						$HOCTAP[$v_IDhoctap]['flag_ktra'] = $flag_ktra;
						$HOCTAP[$v_IDhoctap]['flag_chuyencan'] = $flag_chuyencan;
						$HOCTAP[$v_IDhoctap]['flag_status_monhoc'] = $flag_status_monhoc;
					}else{
						// Gán cờ vào từng id học tập
						$HOCTAP[$v_IDhoctap]['flag_ktra'] = $flag_ktra;
						$HOCTAP[$v_IDhoctap]['flag_chuyencan'] = $flag_chuyencan;
						$HOCTAP[$v_IDhoctap]['flag_status_monhoc'] = $flag_status_monhoc;
					}

					$arr_tmp[] = $HOCTAP[$v_IDhoctap];
				}
			}
		}

		$SV_HOCTAP[$key] = $arr_tmp;
	}
}

/* Get tương tác cuối cùng theo từng sinh viên */
$WORK_LOG = array(); // Mảng lưu logs theo từng sinh viên
$WORK_LOG_DATE = array(); // Mảng lưu tất cả time tương tác theo từng sinh viênS
$WORK_LOG_NOIDUNG = array(); // Mảng lưu tất cả nội dung tương tác theo từng sinh viênS
$current_time = time();
$res_log = SysGetList('tbl_working_log', array(), "AND finish=1 AND `date`<=".$current_time." ORDER BY cdate DESC");
if(count($res_log)>0){
	foreach ($res_log as $key => $value) {
		$WORK_LOG[$value['masv']][] = $value;
		$WORK_LOG_DATE[$value['masv']][] = $value['date'];
		$WORK_LOG_NOIDUNG[$value['masv']][] = $value['noidung'];
	}
}

//---- Lấy danh sách đợt đóng học phí ---------
$url='http://uid.aumsys.net/api/student/order';
$json = array();
$json['key'] = PIT_API_KEY;
$json['id_school'] = SCHOOL_CODE;
$json['name'] = $get_name;
$json['hocky'] = $get_hocky;
$json['slot'] = $get_slot;
$json['start_date'] = $get_startdate;
$json['end_date'] = $get_enddate;

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$res_order = $res_data['data'];
$arr_order = array();
if(is_array($res_order) && count($res_order)>0){
	foreach ($res_order as $key => $value) {
		$arr_order[$value['id']] = $value;
	}
}

//---- Lấy danh sách order detail ---------
$url='http://uid.aumsys.net/api/student/order_detail';
$json = array();
$json['key'] = PIT_API_KEY;
$json['masv'] 		= $_masv; 			// varchar
$json['id_order']	= $get_order; 			// varchar
$json['hoten'] 		= $_hoten; 			// varchar
$json['ngaysinh']	= $_birthday; 		// int
$json['ma_he']		= $id_he; 				// varchar
$json['ma_nganh']	= $id_nganh; 			// varchar
$json['ma_lop']		= $_id_lop; 			// varchar
$json['hocky'] 		= $get_hocky;			// int
$json['slot'] 		= $get_slot;			// int
$json['flag'] 		= $get_flag; 			// int
$json['status']		= $get_status; 			// varchar

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$res_order_detail = $res_data['data'];

//---- Lấy lịch sử đóng học phí của tất cả sinh viên ---------
$url='http://uid.aumsys.net/api/student/order_pay';
$json = array();
$json['key'] = PIT_API_KEY;

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$row_order_history = $res_data['data'];

/* Mảng số tiền đã đóng theo id order detail */
$arr_sotien_dathu = array(); 
foreach ($row_order_history as $key => $value) {
	$sotien = $value['sotien'];
	$id_detail = $value['id_order_detail'];

	if(!array_key_exists($id_detail, $arr_sotien_dathu)){
		$arr_sotien_dathu[$id_detail] = $sotien;
	}else{
		$arr_sotien_dathu[$id_detail] = $arr_sotien_dathu[$id_detail] + $sotien;
	}
}

// ---- Gán ngày bắt đầu, ngày kết thúc thu học phí vào mảng order detail ------------
foreach ($res_order_detail as $key => $value) {
	$id_order = $value['id_order'];
	if(isset($arr_order[$id_order])){
		$res_order_detail[$key]['start_date'] = $arr_order[$id_order]['start_date']!="" ? $arr_order[$id_order]['start_date'] : "";
		$res_order_detail[$key]['end_date'] = $arr_order[$id_order]['end_date']!="" ? $arr_order[$id_order]['end_date'] : "";
		$res_order_detail[$key]['order_name'] = $arr_order[$id_order]['name']!="" ? $arr_order[$id_order]['name'] : "";
	}
}

// ---- Lấy tổng học phí đã thu theo từng đợt của từng học sinh ------------
$arr_data = $res_order_detail; $SUM_hoanthanh = $SUM_nguyco = $SUM_chuahoanthanh = $SUM_baodong = 0;
foreach ($arr_data as $key => $value) {
	$masv = $value['masv'];
	$ma_hoso = isset($DKTS[$masv]) ? $DKTS[$masv]['id_hoso'] : "";
	$hodem = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['ho_dem'] : "";
	$tensv = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['name'] : "";
	$email = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['email'] : "";
	$sodienthoai = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['dienthoai'] : "";
	$ngaysinh = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['ngaysinh'] : "";
	$hotensv = $hodem.' '.$tensv;
	$id_nganh = $value['ma_nganh'];
	$id_khoa = isset($DKTS[$masv]) ? $DKTS[$masv]['id_khoa'] : "";
	$id_he = $value['ma_he'];
	$id_lop = $value['ma_lop'];
	$id_staff = isset($DKTS[$masv]) ? $DKTS[$masv]['id_staff'] : "";
	$name_staff = isset($STAFF_ALL[$id_staff]) ? $STAFF_ALL[$id_staff]['fullname'] : "";
	$name_nganh = isset($NGANH[$id_nganh]) ? $NGANH[$id_nganh]['name'] : "";
	$name_khoa = isset($KHOA[$id_khoa]) ? $KHOA[$id_khoa]['name'] : "";
	$name_he = isset($HE[$id_he]) ? $HE[$id_he]['name'] : "";
	$name_lop = $id_lop;

	$slmon_danghoc = $slmon_dahoc = $slmon_chuahoc = 0;
	$slmon_codo = $slmon_covang = $slmon_coxanh = 0;
	if(isset($SV_HOCTAP[$masv])){
		$arr_svhoctap = $SV_HOCTAP[$masv];
		foreach ($arr_svhoctap as $k_hoctap => $v_hoctap) {
			if($v_hoctap['status']=="HT01") $slmon_chuahoc = (int)$slmon_chuahoc + 1;
			if($v_hoctap['status']=="HT05") $slmon_dahoc = (int)$slmon_dahoc + 1;
			if($v_hoctap['status']=="HT02") $slmon_danghoc = (int)$slmon_danghoc + 1;

			if($v_hoctap['flag_status_monhoc']=='do') $slmon_codo = $slmon_codo + 1;
			if($v_hoctap['flag_status_monhoc']=='xanh') $slmon_coxanh = $slmon_coxanh + 1;
			if($v_hoctap['flag_status_monhoc']=='vang') $slmon_covang = $slmon_covang + 1;
		}
	}

	if($slmon_coxanh==3 && $slmon_covang==0 && $slmon_codo==0) $SUM_hoanthanh = $SUM_hoanthanh + 1;
	if($slmon_covang>0 && $slmon_codo==0) $SUM_nguyco = $SUM_nguyco + 1;
	if($slmon_codo<2) $SUM_chuahoanthanh = $SUM_chuahoanthanh + 1;
	if($slmon_codo>=2) $SUM_baodong = $SUM_baodong + 1;

	$last_date_contact = $noidung_last_contact = $noidung_contact_ht = $noidung_contact_hp = "";
	if(isset($WORK_LOG[$masv])){
		$arr_last_contact_ht = array();
		$arr_last_contact_hp = array();
		foreach ($WORK_LOG[$masv] as $k => $v) {
			if($v["type"] == "hoctap") $arr_last_contact_ht[] = $v["noidung"];
			if($v["type"] == "hocphi") $arr_last_contact_hp[] = $v["noidung"];
		}

		$last_date_contact = max($WORK_LOG_DATE[$masv]);
		$noidung_last_contact = $WORK_LOG_NOIDUNG[$masv][0];
		$noidung_contact_ht = isset($arr_last_contact_ht[0]) ? $arr_last_contact_ht[0] : "";
		$noidung_contact_hp = isset($arr_last_contact_hp[0]) ? $arr_last_contact_hp[0] : "";
	}

	$arr_data[$key]['ma_hoso'] = $ma_hoso;
	$arr_data[$key]['hotensv'] = $hotensv;
	$arr_data[$key]['email'] = $email;
	$arr_data[$key]['ngaysinh'] = $ngaysinh;
	$arr_data[$key]['sodienthoai'] = $sodienthoai;
	$arr_data[$key]['name_staff'] = $name_staff;
	$arr_data[$key]['name_nganh'] = $name_nganh;
	$arr_data[$key]['name_khoa'] = $name_khoa;
	$arr_data[$key]['name_he'] = $name_he;
	$arr_data[$key]['name_lop'] = $name_lop;
	$arr_data[$key]['id_staff'] = $id_staff;
	$arr_data[$key]['last_date_contact'] = $last_date_contact;
	$arr_data[$key]['noidung_contact'] = $noidung_last_contact;
	$arr_data[$key]['noidung_contact_ht'] = $noidung_contact_ht;
	$arr_data[$key]['noidung_contact_hp'] = $noidung_contact_hp;
	$arr_data[$key]['slmon_danghoc'] = $slmon_danghoc;
	$arr_data[$key]['slmon_dahoc'] = $slmon_dahoc;
	$arr_data[$key]['slmon_chuahoc'] = $slmon_chuahoc;
	$arr_data[$key]['slmon_codo'] = $slmon_codo;
	$arr_data[$key]['slmon_coxanh'] = $slmon_coxanh;
	$arr_data[$key]['slmon_covang'] = $slmon_covang;

	// Đăng ký tuyển sinh
	$arr_data[$key]['level'] = isset($DKTS[$masv]) ? $DKTS[$masv]['status'] : "L0";
	$arr_data[$key]['tinhtrang_sv'] = isset($DKTS[$masv]) ? $DKTS[$masv]['tinhtrang_sv'] : "L0";
	$arr_data[$key]['tinhtrang_hocphi'] = isset($DKTS[$masv]) ? $DKTS[$masv]['tinhtrang_hocphi'] : "";
	$arr_data[$key]['tinhtrang_call_hp'] = isset($DKTS[$masv]) ? $DKTS[$masv]['tinhtrang_call_hp'] : "";

	// ------------------------------------------
	$id_order = $value['id_order'];
	$id_order_detail = $value['id'];
	$dathu = 0;
	if(isset($arr_sotien_dathu[$id_order_detail])){
		$dathu = $arr_sotien_dathu[$id_order_detail];
	}
	$arr_data[$key]['dathu'] = $dathu;
	$arr_data[$key]['order_name'] = isset($arr_order[$id_order]) ? $arr_order[$id_order]['name'] : "";
}

// Xử lý tìm kiếm
if($_hoten!=''){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		$position = stripos($value['hotensv'], $_hoten);
		if($position!==false){
			$new_array[] = $value;
		}
	}
	$arr_data = $new_array;
}
if($_phone!=''){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if($value['sodienthoai'] == $_phone) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($_birthday!=''){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if($value['ngaysinh'] == $_birthday) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($_email!=''){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if($value['email'] == $_email) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($IS_NV){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if(in_array($value['masv'], $arr_masv_staff)){
			$new_array[] = $value;
		}
	}
	$arr_data = $new_array;
}
if($_staff!=''){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if($value['id_staff']==$_staff) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($get_startdate!=""){
	$new_array = array();
	$startDate = strtotime("-".$get_startdate." day");
	
	foreach ($arr_data as $key => $value) {
		if($value['last_date_contact']>=$startDate) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($get_enddate!=""){
	$new_array = array();
	$endDate = strtotime("-".$get_enddate." day");
	
	foreach ($arr_data as $key => $value) {
		if($value['last_date_contact']<=$endDate) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($_statusSV!=""){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if($value['tinhtrang_sv']==$_statusSV) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($_statusHP!=""){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if($value['tinhtrang_hocphi']==$_statusHP) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
if($_level!=""){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		if($value['status']==$_statusHP) $new_array[] = $value;
	}
	$arr_data = $new_array;
}
?>
<style type="text/css">
#frm_search .form-control {
	margin-bottom: 10px;
}
select.status {
	margin-bottom: 10px;
}
</style>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý học phí</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<button type="button" class="btn btn-warning btn-print" title="In hồ sơ"><i class="fa fa-print"></i> In</button>
				</li>
				<li>
					<a href="#" class="btn btn-info btn-excel" title="Xuất File Excel">
						<i class="fa fa-excel"></i> Xuất File Excel
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="search_box panel panel-warning">
		<div class="panel-body">
			<div class="media row">
				<form name="frm_search" id="frm_search" method="get" action="#">
					<div class="form-group">
						<div class="col-md-2 col-xs-6">
							<select name="order" id="cbo_order" class="form-control" >
								<option value="">-- Đợt đóng --</option>
								<?php
								foreach ($arr_order as $key => $value) {
									$selected = $get_order==$key ? 'selected' : '';
									echo '<option value="'.$key.'" '.$selected.'>'.$value['name'].'</option>';
								}
								?>
							</select>
						</div>
						
						<div class="col-md-2 col-xs-6">
							<input type="text" id="tk_hoten" name="hoten" class="form-control" value="<?php echo $_hoten?>" placeholder="Họ tên SV">
						</div>

						<div class="col-md-2 col-xs-6">
							<input type="text" id="tk_masv" name="masv" class="form-control" value="<?php echo $_masv?>" placeholder="Mã AUM">
						</div>

						<div class="col-md-2 col-xs-6">
							<input type="text" id="tk_phone" name="phone" class="form-control" value="<?php echo $_phone?>" placeholder="Điện thoại">
						</div>

						<div class="col-md-2 col-xs-6">
							<input type="text" id="ma_lop" class="form-control" name="malop" value="<?php echo $_id_lop;?>" placeholder="Mã lớp">
						</div>

						<div class="col-md-2 col-xs-6">
							<div class="wr-btnsearch btn-group">
								<button type="submit" name="tk_btnsearch" id="tk_btnsearch" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownFillter"><i class="fa fa-caret-down"></i></button>
								<button type="button" class="btn btn-primary btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>

					<div id="fillter_advance">
						<div class="scroll" class="over400">
							<div class="common_fillter">
								<div class="col-md-2 col-xs-6">
									<span>Level</span>
									<select class="form-control" name='level' id="cbo_level">
										<option value="">-- Level --</option>
										<?php
										foreach ($LEVEL_STUDENT as $key => $value) {
											$selected = ($_level == $key) ? 'selected' : '';
											echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
										}
										?>
									</select>
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Tình trạng SV</span>
									<select class="form-control" name='statusSV' id="cbo_statusSV">
										<option value="">-- Tình trạng SV --</option>
										<?php
										foreach ($STATUS_SV as $key => $value) {
											$selected = ($_statusSV == $key) ? 'selected' : '';
											echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
										}
										?>
									</select>
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Tình trạng học phí</span>
									<select class="form-control" name='statusHP' id="cbo_statusHP">
										<option value="">-- Tình trạng HP --</option>
										<?php
										foreach ($STATUS_HOCPHI as $key => $value) {
											$selected = ($_statusHP == $key) ? 'selected' : '';
											echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
										}
										?>
									</select>
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Ngày sinh</span>
									<input type="date" id="tk_birthday" name="birthday" class="form-control" value="<?php echo $_birthday!="" ? date("Y-m-d", $_birthday) : "";?>" placeholder="Ngày sinh">
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Email</span>
									<input type="text" id="tk_email" name="email" class="form-control" value="<?php echo $_email?>" placeholder="Email">
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Khóa đào tạo</span>
									<input type="text" id="tk_khoa" name="khoa" class="form-control" value="<?php echo $_khoa?>" placeholder="Khóa đào tạo">
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Trạng thái đóng HP</span>
									<select name="status" id="cbo_status" class="form-control" >
										<option value="">-- Trạng thái đóng HP --</option>
										<option value="yes" <?php echo $get_status=='yes'?'selected':'';?>>Đủ</option>
										<option value="no" <?php echo $get_status=='no'?'selected':'';?>>Còn thiếu</option>
									</select>
								</div>

								<div class="col-md-4 col-xs-12">
									<div class="box-search-date">
										<span>Khoảng liên hệ cuối từ ngày -> ngày</span>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<input type="number" name="startdate" value="<?php echo $get_startdate;?>" class="form-control" placeholder="Số ngày">
											</div>

											<div class="col-md-6 col-xs-6">
												<input type="number" name="enddate" value="<?php echo $get_enddate;?>" class="form-control" placeholder="Số ngày">
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-4 col-xs-12">
									<div class="box-search-date">
										<span>Đợt đóng học phí từ ngày -> ngày</span>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<input type="number" name="startdate" value="<?php echo $get_startdate;?>" class="form-control" placeholder="Số ngày">
											</div>

											<div class="col-md-6 col-xs-6">
												<input type="number" name="enddate" value="<?php echo $get_enddate;?>" class="form-control" placeholder="Số ngày">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php 
	$html.='<div class="page-bar">
	<div class="page-title-breadcrumb">
	<div class="page-title">DANH SÁCH HỌC PHÍ</div>
	</div>
	</div>'; 
	$html.='<table class="table table-striped table-bordered">
	<thead><tr class="header">
	<th class="text-center">STT</th>
	<th>Đợt học phí</th>
	<th>Mã sinh viên</th>
	<th>Họ tên SV</th>
	<th>Ngành</th>
	<th>Mã lớp</th>
	<th class="text-center">Học kỳ</th>
	<th class="text-center">Slot</th>
	<th>Hạn đóng HP</th>
	<th>Tổng học phí</th>
	<th>Đã đóng</th>
	<th>Phải thu</th>
	<th class="text-center">Tình trạng SV</th>
	<th class="text-center">Flag</th>
	<th class="text-center">Trạng thái</th>
	</tr></thead>
	<tbody>';
	?>
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead>
				<tr class="header">
					<th class="text-center" width="50">STT</th>
					<th>Liên hệ cuối</th>
					<th>Thông tin SV</th>
					<th>Tình trạng</th>
					<th>Học phí</th>
					<th>Còn lại phải thu</th>
					<th>Số lượng môn</th>
					<th class="text-center">Cờ học tập</th>
					<th>Thông tin đào tạo</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$max_rows = 10;
				$total_rows = count($arr_data);
				$max_pages = ceil($total_rows/$max_rows);
				$cur_page = getCurentPage($max_pages);
				$start = ($cur_page - 1) * $max_rows;
				$end = $start + $max_rows;
				$stt=$start;

				if($total_rows>0){ 
					$i=0;
					foreach ($arr_data as $key => $row) {
						if($i>=$start && $i<=$end):
							$stt = $stt+1;
							$ma_lop = $row['ma_lop'];
							$masv = $row['masv'];
							$id_order = $row['id_order'];
							$order_name = $row['order_name'];
							$id_order_detail = $row['id'];
							$name_nganh = $row['name_nganh'];
							$name_khoa = $row['name_khoa'];
							$name_he = $row['name_he'];
							$hotenSV = $row['hotensv'];
							$status = $row['status'];
							$ghichu = $row['ghichu'];
							$flag_class = $row['flag']=='0' ? 'other' : 'label-primary';
							$tonghocphi = number_format($row['hocphi']);
							$dadong = $row['dadong']!=="" ? number_format($row['dadong']) : '0';
							$phaithu = $row['conlai']!=="" ? $row['conlai'] : '0';
							$dathu = $row['dathu']!=="" ? $row['dathu'] : '0';
							$conlai = $phaithu - $dathu;
							$sdate = isset($row['start_date']) && $row['start_date']!=="" ? date('d/m/Y',$row['start_date']):"";
							$edate = isset($row['end_date']) && $row['end_date']!=="" ? date('d/m/Y',$row['end_date']):"";
							$ngaysinh = isset($row['ngaysinh']) && $row['ngaysinh']!=="" ? date('d/m/Y',$row['ngaysinh']):"";
							$link_detail = ROOTHOST.'student/hocphi/'.$masv;

							$sodienthoai = $row['sodienthoai'];
							$ma_hoso = $row['ma_hoso'];

							$noidung_lienhecuoi = $row['noidung_contact'];
							$noidung_contact_hp = $row['noidung_contact_hp'];
							$noidung_contact_ht = $row['noidung_contact_ht'];

							$last_date = $row['last_date_contact'];
							if($last_date>0){
								$date1 = date("Y-m-d H:i:s", time());
								$date2 = date("Y-m-d H:i:s", $last_date);
								$dtNow = new DateTime($date1);
								$dtToCompare = new DateTime($date2);
								$diff = $dtNow->diff($dtToCompare);
								if($diff->days > 0){
									$songay = $diff->days.' ngày trước';
								}else if($diff->days == 0){
									$songay = "Hôm nay";
								}
							}else{
								$songay = "Chưa liên hệ";
							}

							$id_staff = $row['id_staff'];
							$tinhtrang_sv = isset($_ARR_STATUS_SV[$masv]) ? $_ARR_STATUS_SV[$masv] : 'S01';
							$level = isset($DKTS[$masv]) ? $DKTS[$masv]['status'] : "L0";
							$tinhtrang_hocphi = isset($DKTS[$masv]['tinhtrang_hocphi']) ? $DKTS[$masv]['tinhtrang_hocphi'] : '---';

							$level = isset($LEVEL_STUDENT[$level]) ? $LEVEL_STUDENT[$level] : "";
							$txt_tinhtrang_sv = isset($STATUS_SV[$tinhtrang_sv]) ? $STATUS_SV[$tinhtrang_sv] : "";

							$call_HP = $row['tinhtrang_call_hp']!="" ? $row['tinhtrang_call_hp'] : '---';
							$txt_call_HP = $call_HP!=='---' && isset($STATUS_CALL_HP[$call_HP]) ? $STATUS_CALL_HP[$call_HP] : '';

							echo '<tr>
							<td align="center">'.$stt.'</td>';

							echo '<td>
							<div class="td-lienhecuoi">
							<div class="numday">'.$songay.'</div>
							<div class="txt">'.$noidung_lienhecuoi.'</div>
							<div class="mt-1"><a href="javascript:void(0)" onclick="frm_tuongtac(this)" class="label label-success" data-masv="'.$masv.'"><i class="fa fa-plus" aria-hidden="true"></i> Tương tác</a></div>
							</div>
							</td>';

							echo '<td width="200">
							<div class="infoSV">
							<div class="masv"><a href="'.$link_detail.'"><strong>'.$masv.'</strong></a></div>
							<div class="name"><a href="'.$link_detail.'" class="cblack">'.$hotenSV.'</a></div>
							<div class="phone">Phone: '.$sodienthoai.'</div>
							<div class="level">Level: <b>'.$level.'</b></div>
							<div class="phone">Tình trạng SV: <b>'.$txt_tinhtrang_sv.'</b></div>
							</div>

							<div class="staff">
							<select name="cbo_staff" data-masv="'.$masv.'" class="status cbo_staff form-control">
							<option value="">-- Chọn một --</option>';
							if(!$IS_NV){
								if(count($STAFF_ALL)>0){
									foreach ($STAFF_ALL as $key => $value) {
										$checked = $value['username']==$id_staff ? 'selected' : '';
										echo '<option value="'.$value['id'].'" '.$checked.'>'.$value['fullname'].'</option>';
									}
								}
							}else{
								foreach ($STAFF_NV as $key => $value) {
									if($value['id']== $_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']['uid']){
										echo '<option value="'.$value['id'].'" selected>'.$value['fullname'].'</option>';
									}
								}
							}
							echo '</select></div>
							</td>';

							echo '<td>
							<ul class="list-unstyle">
							<li>
							<label>Tình trạng HP:</label>
							<select class="status cbo_statusHP form-control" data-masv="<?php echo $masv;?>" name="cbo_statusHP">';
							foreach ($STATUS_HOCPHI as $key => $value) {
								$checked = $key==$tinhtrang_hocphi ? 'selected' : '';
								echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
							}
							echo '</select>
							</li>
							<li>
							<label>Tình trạng gọi HP:</label>
							<div><a href="javascript:void(0)" class="label label-success" onclick="frm_status_call_hp(this)" data-masv="'.$masv.'" data-status-call="'.$call_HP.'">'.$call_HP.'</a></div>
							<div class="txt_status">'.$txt_call_HP.'</div>
							</li>
							</ul>
							</td>';

							echo '
							<td style="width: 200px;">
							<div class="order_name bg-blue">'.$order_name.'</div>
							<div class="box-tonghocphi">
							<div class="el tonghocphi"><span class="cblack">Tổng: </span><strong>'.$tonghocphi.'</strong></div>
							<div class="el dadong"><span class="cblack">Đã đóng: </span><strong>'.$dadong.'</strong></div>
							<div class="el phaithu"><span class="cblack">Phải thu: </span><strong class="cred">'.number_format($phaithu).'</strong></div>
							<div class="el dathu"><span class="cblack">Đã thu: </span><strong>'.number_format($dathu).'</strong></div>
							</div>
							</td>';

							echo '<td align="center">';
							if($conlai <= 0){
								echo '<strong class="cgreen">Đủ</strong>';
							}else{
								if($status=="no"){
									echo '<div class="mt-1"><strong class="cred">'.number_format($conlai).'</strong></div>';
									echo '<a href="javascript:void(0)" data-id-order-detail="'.$id_order_detail.'" onclick="note_flag(this)" class="label '.$flag_class.'">Complaint</a>
									<div class="txt_ghichu">'.$ghichu.'</div>
									<div><strong>Thiếu</strong></div>';
								}else{
									echo '<strong class="cgreen">Đủ</strong>';
								}
							}
							echo '</td>';

							echo '<td width="120">
							<ul class="list-unstyle">
							<li><span class="txt">Đang học: </span>'.$row["slmon_danghoc"].'</li>
							<li><span class="txt">Đã học: </span>'.$row["slmon_dahoc"].'</li>
							<li><span class="txt">Chưa học: </span>'.$row["slmon_chuahoc"].'</li>
							</ul>
							</td>';

							echo '<td align="center" width="120">
							<ul class="list-unstyle">
							<li><span class="flagnumber">'.$row["slmon_codo"].'</span> <i class="fa fa-flag cred" aria-hidden="true"></i></li>
							<li><span class="flagnumber">'.$row["slmon_covang"].'</span> <i class="fa fa-flag cyellow" aria-hidden="true"></i></li>
							<li><span class="flagnumber">'.$row["slmon_coxanh"].'</span> <i class="fa fa-flag cgreen" aria-hidden="true"></i></li>
							</ul>
							</td>';

							echo '<td>
							<div class="daotao-info">
							<div class="el nganh"><strong>'.$name_nganh.'</strong></div>
							<div class="el khoa">Khóa: <strong>'.$name_khoa.'</strong></div>
							<div class="el lop">Lớp: <strong>'.$ma_lop.'</strong></div>
							</div>
							</td>
							</tr>';
						endif;
						$i=$i+1;
					}
				}
				$html.="</tbody></table>";
				?>
			</tbody>
		</table>
	</div>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr><td align="center">
			<?php paging($total_rows,$max_rows,$cur_page); ?>
		</td></tr>
	</table>
</div>
<div id="divToPrint" style="display:none;"><?php echo $html; ?></div>
<script>
	$(document).ready(function(){
		$(".btn-excel").click(function(){
			showLoading(); 
			var _data = '<?php echo $json_param;?>';
			var link="<?php echo ROOTHOST;?>excel/export_qlhocphi.php";
			$.get(link, function(req){
				// console.log(req);
				hideLoading();
				if(req=="E01") showMess('Vui lòng đăng nhập hệ thống.');
				else if(req=="empty") showMess('Dữ liệu trống.');
				else {
					str='<a href="<?php echo ROOTHOST;?>excel/'+req+'">Download link tại đây</a>';
					showMess(str);
				}
			})
		});

		$(".btn-print").click(function(){
			showLoading();
			var screenW =screen.width;
			var screenH =screen.height; console.log(screenW+' / '+screenH);
			var divToPrint = document.getElementById('divToPrint');
			var popupWin = window.open('', '_blank','toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width='+screenW+',height='+screenH);
			popupWin.document.open();
			popupWin.document.write('<html><head><title>Danh sách học phí</title>');
			popupWin.document.write('</head><body onload="window.print();">');
			popupWin.document.write(divToPrint.innerHTML);
			popupWin.document.write('</body></html>');
			popupWin.document.close();
			hideLoading();
		});

		$(".btn-refresh").on("click", function(){
			$("#frm_search").find(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
			$("#frm_search").find(':checkbox, :radio').prop('checked', false);
		});

		$("#dropdownFillter").click(function(){
			$(this).toggleClass("open");
			$("#fillter_advance").toggleClass("active");
		});

		$(".cbo_level").change(function(){
			var masv = $(this).attr("data-masv");
			var level = $(this).val();
			var _data = {
				"masv": masv,
				"cbo_level": level,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_level.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!",""); 
					setTimeout(function(){ 
						window.location.reload(); 
					}, 1000);
				}
			});
		});

		$(".cbo_statusSV").change(function(){
			var masv = $(this).attr("data-masv");
			var statusSV = $(this).val();
			var _data = {
				"masv": masv,
				"cbo_status_sv": statusSV,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_sv.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!","");
				}
			});
		});

		$(".cbo_statusHP").change(function(){
			var _masv = $(this).attr("data-masv");
			var _status_hp = $(this).val();
			var _data = {
				"masv": _masv,
				"cbo_status_hp": _status_hp,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_hocphi.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!","");
				}
			});
		});

		$(".cbo_staff").change(function(){
			var _masv = $(this).attr("data-masv");
			var _staff = $(this).val();
			var _data = {
				"masv": _masv,
				"cbo_staff": _staff,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_select_staff.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!","");
				}
			});
		});
	});

	function note_flag(e){
		var _id_order_detail = e.getAttribute('data-id-order-detail');
		if(_id_order_detail.length > 0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/hocphi/frm_note_flag.php';
			var _data = {
				'id_order_detail' : _id_order_detail,
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Xác nhận học phí');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function frm_tuongtac(e){
		var masv = e.getAttribute('data-masv');
		if(masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_tuongtac.php';
			var _data = {
				'masv' : masv,
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-md modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-lg');
				$('#myModalPopup .modal-title').html('Tương tác sinh viên');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function frm_status_call_hp(e){
		var _masv = e.getAttribute('data-masv');
		var _status_call = e.getAttribute('data-status-call');
		if(_status_call.length>0 && _masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_call_hp.php';
			var _data = {
				'masv' : _masv,
				'status_call_hp' : _status_call
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật tình trạng cuộc gọi học phí');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}
</script>