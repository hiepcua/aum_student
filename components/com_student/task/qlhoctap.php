<?php
defined('ISHOME') or die("You can't access this page!");
$objmysql=new CLS_MYSQL;
$THIS_HE=$THIS_NGANH=$THIS_KHOA=$strWhere=$id_lop=$id_partner=$id_mon=$diem='';
$DKTS = $HOCTAP = array();
$ARR_STATUS_SV = array(); // Tình trạng sinh viên theo từng mã sinh viên
$MONHOC = array(); // Tất cả môn học
$THIS_STAFF = isset($_SESSION['THIS_STAFF']) ? $_SESSION['THIS_STAFF'] : ''; // ID nhân viên đăng nhập
$arr_data = array(); // Mảng chứa tất cả thông tin được dùng để in ra màn hình
// -----------------------------------------------

/* Get all hồ sơ */
$HOCSINH = array();
$res_hosoSV = SysGetList('tbl_hocsinh', array());
if(count($res_hosoSV)>0){
	foreach ($res_hosoSV as $key => $value) {
		$HOCSINH[$value['ma']] = $value;
	}
}

// Get all môn học
$res_monhoc = SysGetList('tbl_monhoc', array());
if(count($res_monhoc)>0){
	foreach ($res_monhoc as $key => $value) {
		$MONHOC[$value['id']] = $value;
	}
}

// -----------------------------------------------
$res_hoctap = SysGetList('tbl_hoctap', array());
if(count($res_hoctap)>0){
	foreach ($res_hoctap as $key => $value) {
		$HOCTAP[$value['id']] = $value;
	}
}

// Get môn học theo mã sv
$SV_MONHOC = array();
$sql="SELECT GROUP_CONCAT(id) AS ids, masv FROM tbl_hoctap GROUP BY(masv)";
$objmysql->Query($sql);
while ($row_hoctap = $objmysql->Fetch_Assoc()) {
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

// -------------- Xử lý GET parameter --------------
$_staff 	= $THIS_STAFF;
$THIS_KHOA 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$THIS_HE 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$THIS_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$_khoa 		= isset($_GET['khoa']) ? antiData($_GET['khoa']):'';
$_hoten 	= isset($_GET['hoten']) ? antiData($_GET['hoten']) : '';
$_masv 		= isset($_GET['masv']) && $_GET['masv'] !== 'undefined' ? antiData($_GET['masv']):'';
$_phone 	= isset($_GET['phone']) ? antiData($_GET['phone']):'';
$_id_lop 	= isset($_GET['malop']) ? antiData($_GET['malop']):'';
$_birthday 	= isset($_GET['birthday']) && $_GET['birthday']!="" ? strtotime($_GET['birthday']):'';
$_email 	= isset($_GET['email']) ? antiData($_GET['email']):'';
$_qdtrungtuyen 	= isset($_GET['qdtrungtuyen']) ? antiData($_GET['qdtrungtuyen']):'';
$_flag 		= isset($_GET['flag']) ? antiData($_GET['flag']):'';
$_level 	= isset($_GET['level']) ? antiData($_GET['level']):'';
$_statusSV 	= isset($_GET['statusSV']) ? antiData($_GET['statusSV']) : '';
$_statusHP 	= isset($_GET['statusHP']) ? antiData($_GET['statusHP']) : '';
$get_startdate 	= isset($_GET['startdate']) && $_GET['startdate']!="" ? antiData($_GET['startdate'], 'int') : '';
$get_enddate 	= isset($_GET['enddate']) && $_GET['enddate']!="" ? antiData($_GET['enddate'], 'int') : '';
$get_sdatelv 	= isset($_GET['sdatelv']) && $_GET['sdatelv']!="" ? strtotime($_GET['sdatelv']) : '';
$get_edatelv 	= isset($_GET['edatelv']) && $_GET['edatelv']!="" ? strtotime($_GET['edatelv']) : '';
$_status 	= isset($_GET['status']) ? antiData($_GET['status']) : ''; // Trạng thái cờ học tập



if($_masv!=''){
	$strWhere.=" AND masv='".$_masv."'";
}
if($_level!=''){
	$strWhere.=" AND status='".$_level."'";
}
if($THIS_NGANH!=''){
	$strWhere.=" AND id_nganh='".$THIS_NGANH."'";
}
if($THIS_HE!=''){
	$strWhere.=" AND id_he='".$THIS_HE."'";
}
if($_khoa!=''){
	$strWhere.=" AND id_khoa='".$_khoa."'";
}
if($_staff!='' && $_staff!='all'){
	$strWhere.=" AND id_staff='".$_staff."'";
}
if($_id_lop!=''){
	$strWhere.=" AND malop='".$_id_lop."'";
}
if($_statusSV!=''){
	$strWhere.=" AND tinhtrang_sv='$_statusSV'";
}
if($_statusHP!=''){
	$strWhere.=" AND tinhtrang_hocphi='$_statusHP'";
}
if($get_sdatelv!=""){
	$strWhere.=" AND date_level_up>='$get_sdatelv'";
}
if($get_edatelv!=""){
	$strWhere.=" AND date_level_up<='$get_edatelv'";
}

// Get đăng ký tuyển sinh
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), $strWhere);
if(count($res_dkts)>0){
	foreach ($res_dkts as $key => $value) {
		$DKTS[$value['masv']] = $value;
	}
}
$arr_data = $DKTS;

$SUM_hoanthanh = $SUM_nguyco = $SUM_chuahoanthanh = $SUM_baodong = 0;
foreach ($arr_data as $key => $value) {
	$masv = $key;
	$ma_hoso = $value['id_hoso'];
	$hodem = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['ho_dem'] : "";
	$tensv = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['name'] : "";
	$email = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['email'] : "";
	$sodienthoai = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['dienthoai'] : "";
	$ngaysinh = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['ngaysinh'] : "";
	$id_nganh = $value['id_nganh'];
	$id_khoa = $value['id_khoa'];
	$id_staff = $value['id_staff'];
	$name_staff = isset($STAFF_ALL[$id_staff]) ? $STAFF_ALL[$id_staff]['fullname'] : "";
	$name_nganh = isset($NGANH[$id_nganh]) ? $NGANH[$id_nganh]['name'] : "";
	$name_khoa = isset($KHOA[$id_khoa]) ? $KHOA[$id_khoa]['name'] : "";
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

	$arr_data[$key]['hodem'] = $hodem;
	$arr_data[$key]['tensv'] = $tensv;
	$arr_data[$key]['hoten'] = $hodem.' '.$tensv;
	$arr_data[$key]['email'] = $email;
	$arr_data[$key]['sodienthoai'] = $sodienthoai;
	$arr_data[$key]['ngaysinh'] = $ngaysinh;
	$arr_data[$key]['name_staff'] = $name_staff;
	$arr_data[$key]['name_nganh'] = $name_nganh;
	$arr_data[$key]['name_khoa'] = $name_khoa;
	$arr_data[$key]['slmon_danghoc'] = $slmon_danghoc;
	$arr_data[$key]['slmon_dahoc'] = $slmon_dahoc;
	$arr_data[$key]['slmon_chuahoc'] = $slmon_chuahoc;
	$arr_data[$key]['slmon_codo'] = $slmon_codo;
	$arr_data[$key]['slmon_coxanh'] = $slmon_coxanh;
	$arr_data[$key]['slmon_covang'] = $slmon_covang;
	$arr_data[$key]['last_date_contact'] = $last_date_contact;
	$arr_data[$key]['noidung_contact'] = $noidung_last_contact;
	$arr_data[$key]['noidung_contact_ht'] = $noidung_contact_ht;
	$arr_data[$key]['noidung_contact_hp'] = $noidung_contact_hp;
}

// Xử lý tìm kiếm
if($_hoten!=''){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		$position = stripos($value['hoten'], $_hoten);
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
if($_flag!=""){
	$new_array = array();
	switch ($_flag) {
		case 'do':
		foreach ($arr_data as $key => $value) {
			if($value['slmon_codo']>0) $new_array[] = $value;
		}
		break;
		case 'vang':
		foreach ($arr_data as $key => $value) {
			if($value['slmon_covang']>0) $new_array[] = $value;
		}
		break;
		case 'xanh':
		foreach ($arr_data as $key => $value) {
			if($value['slmon_coxanh']>0) $new_array[] = $value;
		}
		break;
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

if($_status!=''){
	$new_array = array();
	switch ($_status) {
		case 'hoanthanh':
		foreach ($arr_data as $key => $value) {
			if($value['slmon_coxanh']==3 && $value['slmon_covang']==0 && $value['slmon_codo']==0) 
				$new_array[] = $value;
		}
		break;

		case 'nguyco':
		foreach ($arr_data as $key => $value) {
			if($value['slmon_covang']>0 && $value['slmon_codo']==0) $new_array[] = $value;
		}
		break;

		case 'chuahoanthanh':
		foreach ($arr_data as $key => $value) {
			if($value['slmon_codo']<2) $new_array[] = $value;
		}
		break;

		case 'baodong':
		foreach ($arr_data as $key => $value) {
			if($value['slmon_codo']>=2) $new_array[] = $value;
		}
		break;

		default:
		foreach ($arr_data as $key => $value) {
			if($value['slmon_codo']<2) $new_array[] = $value;
		}
		break;
	}

	$arr_data = $new_array;
}

$total_rows = count($arr_data);
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$end = $start + MAX_ROWS;
$stt=$start; $ids='';$tinchi=1;
?>
<style type="text/css">
.label{
	display: inline-block;
}
input.nhapdiem{
	width: 50px;
}
.btn-status{
	margin-top:5px;
	padding:2px 4px;
}
.last-comment {
	font-size: 12px;
}
.collapse{
	overflow: hidden;
}
</style>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý học tập</div>
			</div>
		</div>
	</div>

	<div class="search_box panel panel-warning">
		<div class="panel-body">
			<div class="media row">
				<form name="frm_search" id="frm_search" method="get" action="#">
					<div class="form-group">
						<input type="hidden" name="com" value="student"/>
						<input type="hidden" name="task" value="qlhoctap"/>
						
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
									<span>Cờ</span>
									<select class="form-control" name='flag' id="cbo_flag">
										<option value="">-- Cờ --</option>
										<?php
										$arr_flag = array("do"=>"Đỏ","vang"=>"Vàng","xanh"=>"Xanh");
										foreach ($arr_flag as $key => $value) {
											$selected = ($_flag == $key) ? 'selected' : '';
											echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
										}
										?>
									</select>
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Level</span>
									<select class="form-control" name='level' id="cbo_level">
										<option value="">Level</option>
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
										<option value="">Tình trạng SV</option>
										<?php
										foreach ($STATUS_SV as $key => $value) {
											$selected = ($_statusSV == $key) ? 'selected' : '';
											echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
										}
										?>
									</select>
								</div>

								<div class="col-md-2 col-xs-6">
									<span>Tình trạng HP</span>
									<select class="form-control" name='statusHP' id="cbo_statusHP">
										<option value="">Tình trạng học phí</option>
										<?php
										foreach ($STATUS_HOCPHI as $key => $value) {
											$selected = ($_statusHP == $key) ? 'selected' : '';
											echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
										}
										?>
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
										<span>Ngày lên level từ ngày -> ngày</span>
										<div class="row">
											<div class="col-md-6 col-xs-6">
												<input type="date" name="sdatelv" value="<?php echo $get_sdatelv!=''? date("Y-m-d", $get_sdatelv) : "";?>" class="form-control" placeholder="Số ngày">
											</div>

											<div class="col-md-6 col-xs-6">
												<input type="date" name="edatelv" value="<?php echo $get_edatelv!=''? date("Y-m-d", $get_edatelv) : "";?>" class="form-control" placeholder="Số ngày">
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

	<div class="row form-group">
		<div class="col-md-12 col-xs-12">
			Vui lòng nhấn Enter để lưu khi nhập từng ô điểm. Hoặc tải lên file điểm (.CSV).
		</div>

		<div class="col-md-6 col-xs-12">
			<a href="<?php echo ROOTHOST;?>student/qlhoctap?status=hoanthanh" class="btn btn-success btn-tinhtrang">Hoàn thành (<?php echo $SUM_hoanthanh;?>)</a>&nbsp&nbsp
			<a href="<?php echo ROOTHOST;?>student/qlhoctap?status=nguyco" class="btn btn-warning btn-tinhtrang">Có nguy cơ (<?php echo $SUM_nguyco;?>)</a>&nbsp&nbsp
			<a href="<?php echo ROOTHOST;?>student/qlhoctap?status=chuahoanthanh" class="btn btn-secondary btn-tinhtrang">Chưa hoàn thành (<?php echo $SUM_chuahoanthanh;?>)</a>&nbsp&nbsp
			<a href="<?php echo ROOTHOST;?>student/qlhoctap?status=baodong" class="btn btn-danger btn-tinhtrang">Báo động (<?php echo $SUM_baodong;?>)</a>
		</div>

		<div class="col-md-6 col-xs-12">
			<a href="<?php echo ROOTHOST;?>?com=student&task=import_diem" class="pull-right btn btn-success import_diem3" style="margin-left:10px"><i class="fa fa-upload"></i> Import file điểm</a>

			<form name="frm_import" id="frm_import" method="POST"  enctype="multipart/form-data">
				<input type="file" id="txtfile" name="txtfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none" />
				<input type="hidden" id="txttype" name="txttype" value=""> 
			</form>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<th>STT</th>
				<th>Liên hệ cuối</th>
				<th>Sinh viên</th>
				<th></th>
				<th>Tình trạng SV</th>
				<th>Tình trạng gọi HT</th>
				<th>Tình trạng gọi HP</th>
				<th>Số lượng môn</th>
				<th>Số lượng cờ</th>
				<th>Thông tin đào tạo</th>
			</thead>
			<tbody id="list_students">
				<?php
				if($total_rows>0){
					$i=0;
					foreach ($arr_data as $key => $value) {
						if($i>=$start && $i<=$end):
							$stt = $stt+1;
							$id_collsapse = $masv = $value['masv'];
							$hodem = $value['hodem'];
							$tensv = $value['tensv'];
							$sodienthoai = $value['sodienthoai'];
							$link_diem = ROOTHOST.'student/diem/'.$masv;
							$id_staff = $value['id_staff'];
							$name_staff = $value['name_staff'];
							$name_nganh = $value['name_nganh'];
							$name_khoa = $value['name_khoa']!="" ? $value['name_khoa'] : '<a href="" class="btn btn-default" data-masv="'.$masv.'" onclick="frm_select_khoa(this)"></a>';
							$noidung_contact = $value['noidung_contact'];
							$noidung_contact_hp = $value['noidung_contact_hp'];
							$noidung_contact_ht = $value['noidung_contact_ht'];

							$last_contact = $value['last_date_contact'];
							if($last_contact>0){
								$date1 = date("Y-m-d H:i:s", time());
								$date2 = date("Y-m-d H:i:s", $last_contact);
								$dtNow = new DateTime($date1);
								$dtToCompare = new DateTime($date2);
								$diff = $dtNow->diff($dtToCompare);
								if($diff->days > 0){
									$songay = '<div class="number">'.$diff->days.'</div>';
								}else{
									$songay = "Hôm nay";
								}
							}else{
								$songay = '<div class="not">Chưa liên hệ</div>';
							}

							$tinhtrang_sv = strlen($value['tinhtrang_sv'])>0 ? $value['tinhtrang_sv'] : '---';
							$txt_tinhtrang_sv = $tinhtrang_sv!=='---' ? $STATUS_SV[$tinhtrang_sv] : '';

							$tinhtrang_call_ht = strlen($value['tinhtrang_call'])>0 ? $value['tinhtrang_call'] : '---';
							$txt_tinhtrang_call_ht = $tinhtrang_call_ht!=='---' && isset($STATUS_CALL[$tinhtrang_call_ht]) ? $STATUS_CALL[$tinhtrang_call_ht] : '';

							$tinhtrang_call_hp = strlen($value['tinhtrang_call'])>0 ? $value['tinhtrang_call'] : '---';
							$txt_tinhtrang_call_hp = $tinhtrang_call_hp!=='---' && isset($STATUS_CALL_HP[$tinhtrang_call_hp]) ? $STATUS_CALL_HP[$tinhtrang_call_hp] : '';

							echo '<tr class="sinhvien" data-masv="'.$masv.'" data-malop="'.$value['malop'].'" data-toggle="collapse" data-target="#collapse_'.$id_collsapse.'" aria-controls="collapse_'.$id_collsapse.'">';
							echo '<td align="center" width="30">'.$stt.'</td>';

							echo '<td>
							<div class="td-lienhecuoi">
							<div class="numday">'.$songay.'</div>
							<div class="txt">'.$noidung_contact.'</div>
							<a href="javascript:void(0)" onclick="frm_tuongtac(this)" class="label label-success mt-1" data-masv="'.$masv.'"><i class="fa fa-plus" aria-hidden="true"></i> Tương tác</a>
							</div>
							</td>';

							echo '<td>
							<div class="infoSV">
							<div class="masv"><a href="'.$link_diem.'" title="Quản lý điểm">'.$masv.'</a></div>
							<div class="name">'.$hodem.' '.$tensv.'</div>
							<div class="phone">'.$value['sodienthoai'].'</div>
							<div class="email">'.$value['email'].'</div>
							</div>
							</td>';

							echo '<td>
							<div><a href="'.ROOTHOST.'student/hocphi/'.$masv.'" class="label label-success">Học phí</a></div>
							<div class="mt-1"><a href="'.ROOTHOST.'student/profile/'.$value['id_hoso'].'" class="label label-success">Hồ sơ</a></div>
							</td>';

							echo '<td>'.$txt_tinhtrang_sv.'</td>';
							echo '<td width="200">'.$txt_tinhtrang_call_ht.'</td>';
							echo '<td width="200">'.$txt_tinhtrang_call_hp.'</td>';

							echo '<td>
							<ul class="list-unstyle">
							<li><span class="txt">Đang học: </span>'.$value["slmon_danghoc"].'</li>
							<li><span class="txt">Đã học: </span>'.$value["slmon_dahoc"].'</li>
							<li><span class="txt">Chưa học: </span>'.$value["slmon_chuahoc"].'</li>
							</ul>
							</td>';

							echo '<td align="center">
							<ul class="list-unstyle">
							<li><span class="flagnumber">'.$value["slmon_codo"].'</span> <i class="fa fa-flag cred" aria-hidden="true"></i></li>
							<li><span class="flagnumber">'.$value["slmon_covang"].'</span> <i class="fa fa-flag cyellow" aria-hidden="true"></i></li>
							<li><span class="flagnumber">'.$value["slmon_coxanh"].'</span> <i class="fa fa-flag cgreen" aria-hidden="true"></i></li>
							</ul>
							</td>';

							echo '<td>
							<div class="daotao-info">
							<div class="el nganh"><strong>'.$name_nganh.'</strong></div>
							<div class="el khoa">Khóa: <strong>'.$name_khoa.'</strong></div>
							<div class="el lop">Lớp: <strong>'.$value['malop'].'</strong></div>
							</div>
							</td>';
							echo '</tr>';
							// Card collapse
							echo '<tr id="collapse_'.$id_collsapse.'" class="card-collapse collapse" aria-labelledby="heading'.$id_collsapse.'" data-parent="#list_students">
							<td id="masv_'.$masv.'" class="card-body" colspan="10"></td>
							</tr>';
						endif;
						$i=$i+1;
					}
				}
				?>
			</tbody>
		</table>
	</div>
	<nav class="paging text-center"><?php paging($total_rows,MAX_ROWS,$cur_page); ?></nav>
</div>
<script type="text/javascript">
	getMonHoc();
	// get all note count
	$.get('<?php echo ROOTHOST;?>ajaxs/hoctap/count_note.php',function(req){
		var object=JSON.parse(req);
		for(key in object){
			$('#'+key).html(object[key].num);
		}
	})

	$(document).ready(function(){
		$(".sinhvien").click(function(e){
			var _masv = $(this).attr('data-masv');
			var _malop = $(this).attr('data-malop');
			if(_masv.length>0){
				if($(this).hasClass('active')==false){
					$(".sinhvien").removeClass('active');
					$(".card-collapse .card-body").html();
					$(this).addClass('active');
					get_hoctap(_masv, _malop);
				}
			}
		});

		var $myGroup = $('#list_students');
		$myGroup.on('show.bs.collapse','.collapse', function() {
			$myGroup.find('.collapse.in').collapse('hide');
		});

		$("#cbo_bac_menu").change(function(){
			getMonHoc(); getLop();
		});

		$("#cbo_nganh_menu").change(function(){
			getMonHoc(); getLop();
		});

		$("#tk_masv").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		});

		$("#tk_tensv").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		});

		$(".btn-refresh").on("click", function(){
			$("#frm_search").find(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
			$("#frm_search").find(':checkbox, :radio').prop('checked', false);
		});

		$("#dropdownFillter").click(function(){
			$(this).toggleClass("open");
			$("#fillter_advance").toggleClass("active");
		});
	});

	function getMonHoc(){
		var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/getmon.php";
		var he = "<?php echo $THIS_HE;?>";
		var nganh = "<?php echo $THIS_NGANH;?>";
		$.post(url,{'he':he,'nganh':nganh,'mon':'<?php echo $id_mon;?>'},function(req){
			$("#ma_mon").html(req);
		})
	}

	function getLop(){
		var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/getlop.php";
		var he = "<?php echo $THIS_HE;?>";
		var nganh = "<?php echo $THIS_NGANH;?>";
		$.post(url,{'he':he,'nganh':nganh},function(req){
			$("#ma_lop").html(req);
		})
	}

	function frm_status_hoctap(e){
		var _id = e.getAttribute('data-id');
		var _status = e.getAttribute('data-status');
		if(_status.length>0 && _id.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/hoctap/frm_status_hoctap.php';
			var _data = {
				'id' : _id,
				'status' : _status,
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật trạng thái học tập');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function frm_status_hoctap_multiple(){
		var _ids = $('#txtids').val();
		if(_ids.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/hoctap/frm_status_hoctap_multiple.php';
			var _data = {
				'ids' : _ids
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật trạng thái học tập');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}else{
			alert('Chưa lựa chọn đối tượng nào.');
		}
	}

	function pass_multiple_subject(e){
		var flag = true,
		txt_mess = '',
		_ids = '<?php echo $ids;?>',
		_id_he = '<?php echo $THIS_HE;?>',
		_id_nganh = '<?php echo $THIS_NGANH;?>',
		_id_mon = '<?php echo $id_mon;?>',
		_id_lop = '<?php echo $id_lop;?>',
		_data = {
			'ids': _ids,
			'id_he': _id_he,
			'id_nganh': _id_nganh,
			'id_mon': _id_mon,
			'id_lop': _id_lop,
		};

		if(_ids.length<=0) flag = false;
		if(_id_he.length<=0) flag = false;
		if(_id_nganh.length<=0) flag = false;
		if(_id_mon.length<=0) flag = false;
		if(_id_lop.length<=0) flag = false;

		if(flag == true){
			if(confirm("Bạn có chắc chắn thực hiện Xét Đạt/Không Đạt cho toàn bộ sinh viên lớp "+_id_lop)){
				var _url = "<?php echo ROOTHOST;?>ajaxs/hoctap/update_auto.php";
				$.post(_url, _data, function(req){
				// console.log(req);
				if(req=="error") showMess("Lỗi trong quá trình xét duyệt điểm.","error");
				if(req=="nodata") showMess("Không có dữ liệu xét duyệt.","error");
				if(req=="empty") showMess("Không có thông tin SV cần xét duyệt.","error");
				else {
					showMess(req,"");
					setTimeout(function(){ window.location.reload(); }, 3000);
				}
			})
			}
		}else{
			alert("Để xét Đạt/Không đạt cho nhiều đối tượng, cần lựa chọn ngành đào tạo, hệ/bậc đào tạo, môn học và lớp");
		}
	};

	function frm_status_sv(e){
		var _masv = e.getAttribute('data-masv');
		var _status_sv = e.getAttribute('data-status-sv');
		if(_masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_sv.php';
			var _data = {
				'masv' : _masv,
				'status_sv' : _status_sv
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật tình trạng học viên');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	};

	function frm_status_call(e){
		var _masv = e.getAttribute('data-masv');
		var _status_call = e.getAttribute('data-status-call');
		if(_status_call.length>0 && _masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_call.php';
			var _data = {
				'masv' : _masv,
				'status_call' : _status_call
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật tình trạng cuộc gọi');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function frm_select_staff(e){
		var _masv = e.getAttribute('data-masv');
		var _id_staff = e.getAttribute('data-staff');
		if(_masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_select_staff.php';
			var _data = {
				'masv' : _masv,
				'id_staff' : _id_staff,
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Chọn người phụ trách');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function get_hoctap(masv,malop){
		if(masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/hoctap/get_hoctap.php';
			var _data = {
				'masv' : masv,
				'malop' : malop,
			};
			$.post(_url, _data, function(res){
				$('#masv_'+masv).html(res);
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

	function frm_select_khoa(e){
		var masv = e.getAttribute('data-masv');
		if(masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/khoa/frm_select_khoa.php';
			var _data = {
				'masv' : masv,
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Chọn khóa');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function frm_status_hocphi(e){
		var _masv = e.getAttribute('data-masv');
		var _status_hp = e.getAttribute('data-status-hp');
		if(_status_hp.length>0 && _masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_hocphi.php';
			var _data = {
				'masv' : _masv,
				'status_hp' : _status_hp
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật tình trạng học phí');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}
</script>