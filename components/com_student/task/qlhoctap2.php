<?php
defined('ISHOME') or die("You can't access this page!");
$obj=new CLS_MYSQL;
$THIS_HE=$THIS_NGANH=$THIS_KHOA=$id_lop=$id_partner=$id_mon=$diem='';
$DKTS = $HOCTAP = array();
$ARR_STATUS_SV = array(); // Tình trạng sinh viên theo từng mã sinh viên
$HOCTAP_BY_MASV = array(); // Tất cả môn học theo mã sinh viên
$THIS_STAFF = isset($_SESSION['THIS_STAFF']) ? $_SESSION['THIS_STAFF'] : ''; // ID nhân viên đăng nhập
// -----------------------------------------------

/* Get all hồ sơ */
$HOCSINH = array();
$res_hosoSV = SysGetList('tbl_hocsinh', array());
if(count($res_hosoSV)>0){
	foreach ($res_hosoSV as $key => $value) {
		$HOCSINH[$value['ma']] = $value;
	}
}

// Get all đăng ký tuyển sinh
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array());
if(count($res_dkts)>0){
	// Tình trạng SV theo mã sinh viên
	foreach ($res_dkts as $key => $value) {
		$DKTS[$value['masv']] = $value;
		$ARR_STATUS_SV[$value['masv']] = $value['tinhtrang_sv'];
	}
}

// -----------------------------------------------
$sql="SELECT masv, GROUP_CONCAT(id_monhoc) AS monhoc FROM tbl_hoctap GROUP BY masv";
$obj->Query($sql);
while ($row_hoctap = $obj->Fetch_Assoc()) {
	$HOCTAP_BY_MASV[$value['masv']] = $row_hoctap['monhoc'];
}

/* Get working log group by mã sinh viên */
$WORK_LOG = array();
$res_log = SysGetList('tbl_working_log', array(), "AND ketqua>''");
if(count($res_log)>0){
	foreach ($res_log as $key => $value) {
		if(isset($WORK_LOG[$value['masv']])){
			$date = $WORK_LOG[$value['masv']]['date'];
			if($date < $value['date']) $WORK_LOG[$value['masv']] = $value;
		}else{
			$WORK_LOG[$value['masv']] = $value;
		}
	}
}

// -------------- Xử lý GET parameter --------------
$_staff = "";
if(!$IS_NV){
	$_staff = isset($_GET['staff']) ? antiData($_GET['staff']) : '';
}else{
	$_staff = $THIS_STAFF;
}

$THIS_KHOA 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$THIS_HE 		= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$THIS_NGANH 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$id_lop 	= isset($_GET['malop']) ? antiData(strip_tags($_GET['malop'])):'';
$id_mon 	= isset($_GET['mamon']) ? antiData(strip_tags($_GET['mamon'])):'';
$id_hoso 	= isset($_GET['mahoso']) ? antiData(strip_tags($_GET['mahoso'])):'';
$masv 		= isset($_GET['masv']) && $_GET['masv'] !== 'undefined' ? antiData($_GET['masv']):'';
$tensv 		= isset($_GET['ten']) && $_GET['ten'] !== 'undefined' ? antiData($_GET['ten']):'';
$_statusHT 	= isset($_GET['statusHT']) ? antiData($_GET['statusHT']) : 'all';
$_statusCall = isset($_GET['statusCall']) ? antiData($_GET['statusCall']) : 'all';
$lastcontact = isset($_GET['lastcontact']) && antiData($_GET['lastcontact']) > 0 ? antiData($_GET['lastcontact']) : '';

$sql="SELECT * FROM tbl_monhoc";
$obj->Query($sql);
$arrMon=array();
while($r=$obj->Fetch_Assoc()){
	$arrMon[$r['id']]=$r;
}

$target_file=''; $target_dir = "temp/"; $data_import=array();
$msg='';
if(isset($_FILES["txtfile"]["type"]) && $_FILES["txtfile"]["type"]!=''){
	$validextensions = array("csv", "xls", "xlsx");
	$temporary = explode(".", $_FILES["txtfile"]["name"]);
	$file_extension = end($temporary);
	if (in_array($file_extension, $validextensions)) {
		if ($_FILES["txtfile"]["size"] < 10485760) { //10MB
			if ($_FILES["txtfile"]["error"] > 0){
				$msg="File Error";
			}else{
				$target_file = $target_dir . basename($_FILES["txtfile"]["name"]);
				// Check if file already exists
				if (file_exists($target_file)) {
					$file_name=basename($_FILES["txtfile"]["name"]);
					$temp = explode(".",$file_name);
					$newfilename = $temp[0].'_'.date('Ymd-His').'.'.$temp[1];
					$target_file=$target_dir.$newfilename;
				}
				// save file on server
				if (move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_file)) {
					chmod("$target_file", 0755); 
					require('extensions/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
					require('extensions/spreadsheet-reader-master/SpreadsheetReader.php');
					$Reader = new SpreadsheetReader($target_file);
					$i=0;
					$obj->Exec("BEGIN"); $flag_result=true;
					foreach ($Reader as $Row){
						$i++;						
						if($i>1 && trim($Row[1])!='') {
							$num=count($data_import);
							$arr_diem['chuyencan'] = trim($Row[2]);
							$arr_diem['diemkt'] = trim($Row[3]);
							$arr_diem['diemthi'] = trim($Row[4]);
							$json = json_encode($arr_diem,JSON_UNESCAPED_UNICODE);
							$sql = "UPDATE tbl_hoctap SET diem='$json',mdate=".time()." WHERE masv='".trim($Row[1])."' AND id_monhoc='$id_mon'";
							$result = $obj->Exec($sql);
							if(!$result) $flag_result=false;
						}
					}
					if($flag_result==true){
						$obj->Exec("COMMIT"); $msg="Lưu điểm thành công";
					}else {
						$obj->Exec("ROLLBACK"); $msg="Lỗi trong quá trình lưu trữ dữ liệu";
					}
					unlink($target_file);
				} else $msg="Tải file không thành công";		
			}
		}else $msg="Dung lượng file không vượt quá 10MB.";
	}
	else{
		$msg="Kiểu file phải là .csv";
	}
}?>
<style type="text/css">
.label{
	display: inline-block;
}
input[type="number"]{
	width: 65px;
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
							<label>Mã SV</label>
							<input type="text" id="tk_masv" name="masv" class="form-control" value="<?php echo $masv?>" placeholder="Mã sinh viên">
						</div>

						<div class="col-md-2 col-xs-6">
							<label>Tên SV</label>
							<input type="text" id="tk_tensv" name="ten" class="form-control" value="<?php echo $tensv?>" placeholder="Tên sinh viên">
						</div>

						<div class="col-md-2 col-xs-6">
							<label>Môn học</label>
							<select name="mamon" id="ma_mon" class="form-control">
								<option value="">Môn học</option>
							</select>
						</div>

						<div class="col-md-2 col-xs-6">
							<label>Lớp</label>
							<input type="text" id="ma_lop" class="form-control" name="malop" value="<?php echo $id_lop;?>" placeholder="Mã lớp">
						</div>

						<?php if(!$IS_NV){ ?>
							<div class="col-md-2 col-xs-6">
								<label>Người quản lý</label>
								<select class="form-control" name='staff' id="cbo_staff">
									<option value="all">-- Người quản lý --</option>
									<?php
									foreach ($STAFF_NV as $key => $value) {
										$selected = ($_staff == $key) ? 'selected' : '';
										echo '<option '.$selected.' value="'.$key.'">'.$value['fullname'].'</option>';
									}
									?>
								</select>
							</div>
						<?php } ?>

						<div class="col-md-2 col-xs-6">
							<label>Tình trạng cuộc gọi</label>
							<select class="form-control" name='statusCall' id="cbo_statusCall">
								<option value="all">-- Tình trạng cuộc gọi --</option>
								<?php
								foreach ($STATUS_CALL as $key => $value) {
									$selected = ($_statusCall == $key) ? 'selected' : '';
									echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
								}
								?>
							</select>
						</div>

						<div class="col-md-2 col-xs-6">
							<label>Trạng thái học tập</label>
							<select class="form-control" name='statusHT' id="cbo_statusHT">
								<option value="all">-- Trạng thái HT --</option>
								<?php
								foreach ($STATUS_HOCTAP as $key => $value) {
									$selected = ($_statusHT == $key) ? 'selected' : '';
									echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
								}
								?>
							</select>
						</div>

						<div class="col-md-2 col-xs-6 time">
							<label>.</label>
							<select class="form-control" name="lastcontact">
								<option value="" <?php if($lastcontact=='') echo "selected";?>>-- Liên hệ cuối --</option>
								<option value="1" <?php if($lastcontact=='1') echo "selected";?>>1 ngày</option>
								<option value="3" <?php if($lastcontact=='3') echo "selected";?>>3 ngày</option>
								<option value="7" <?php if($lastcontact=='7') echo "selected";?>>1 tuần</option>
								<option value="14" <?php if($lastcontact=='14') echo "selected";?>>2 tuần</option>
								<option value="30" <?php if($lastcontact=='30') echo "selected";?>>1 tháng</option>
								<option value="oldest" <?php if($lastcontact=='oldest') echo "selected";?>>Trước 1 tháng</option>
							</select>
						</div>

						<div class="col-md-2 col-xs-6">
							<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<button type="button" id="tk_btnsearch" class="btn btn-primary form-control"><i class="fa fa-search"></i> Lọc</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-6 col-xs-12">
			Vui lòng nhấn Enter để lưu khi nhập từng ô điểm. Hoặc tải lên file điểm (.CSV). 
			<a href="<?php echo ROOTHOST;?>/temp/mau/import_diem.csv" id="download_file_diem">Download File mẫu tại đây <i class="fa fa-download"></i></a> <?php if($msg!="") echo "<div><label class='label label-warning'>".$msg."</label></div>";?>
		</div>
		<div class="col-md-6 col-xs-12">
			<!-- <button type="button" class="pull-right btn btn-primary" onclick="pass_multiple_subject()" style="margin-left:10px"><i class="fa fa-tasks"></i> Xét Đạt/Không Đạt</button> -->

			<button type="button" class="pull-right btn btn-success import_diem3" style="margin-left:10px"><i class="fa fa-upload"></i> Tải file điểm</button>
			<input type="hidden" id="txtids" name="txtids">
			<a href="javascript:void(0)" class="pull-right btn btn-primary" onclick="frm_status_hoctap_multiple()" title="Cập nhật trạng thái học tập"><i class="fa fa-refresh" aria-hidden="true"></i> Cập nhật trạng thái học tập</a>

			<form name="frm_import" id="frm_import" method="POST"  enctype="multipart/form-data">
				<input type="file" id="txtfile" name="txtfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none" />
				<input type="hidden" id="txttype" name="txttype" value=""> 
			</form>
		</div>
	</div>

	<table class="table table-bordered" id="tbl_hocphan">
		<thead>
			<tr> 
				<th width="30">STT</th>
				<th width="30" class="text-center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);"/></th>
				<th class="text-center">Sinh viên</th>
				<th class='text-center'>Tình trạng SV</th>
				<th class="text-center">Tình trạng cuộc gọi</th>
				<th class='text-center'>Trạng thái học tập</th>
				<th class='text-center'>Người phụ trách</th>
				<th>Thông tin đào tạo</th>
				<th>Điểm</th>
				<th class='text-center'>Note</th>
				<th class='text-center'>Ngày cập nhập</th>
				<!-- <th class='text-center' width="80">Xét đạt/ không đạt</th> -->
			</tr>
		</thead>
		<tbody>
			<?php 
			$where = '';
			if($THIS_HE!='') 	$where.=" AND id_he='$THIS_HE'";
			if($THIS_NGANH!='') $where.=" AND id_nganh='$THIS_NGANH'";
			if($id_mon!='') 	$where.=" AND id_monhoc='$id_mon'";

			$sql="SELECT * FROM tbl_hocphan_khung WHERE 1=1 ";
			$obj->Query($sql.$where);
			$arrHP = array(); $hocky='';
			while($r=$obj->Fetch_Assoc()) {
				$arrHP=$r;
				$hocky = $arrHP['hocky'];
			}

			/*-------------------------------------*/
			$sql="SELECT a.*, b.*, b.id as id_ht, b.status as statusHT FROM tbl_dangky_tuyensinh AS a 
			INNER JOIN tbl_hoctap AS b ON a.masv=b.masv 
			WHERE 1=1 $where ORDER BY a.masv ASC,id_ht DESC";
			$obj->Query($sql); 

			$arr_list=array(); $str_ma = '';
			while($r=$obj->Fetch_Assoc()){
				$idhoso = $r['id_hoso'];
				$id_monhoc = $r['id_monhoc'];
				$arr_list[] = $r;
				$str_ma .=$idhoso."','";
			}

			if($str_ma!='') $str_ma = substr($str_ma,0,-3);
			$sql = "SELECT ma, ho_dem, name FROM tbl_hocsinh WHERE ma IN ('$str_ma')";
			$obj->Query($sql); 
			$info_sv = array();
			while($r=$obj->Fetch_Assoc()){
				$idhoso = $r['ma']; 
				$info_sv[$idhoso]['ho_dem']=$r['ho_dem'];
				$info_sv[$idhoso]['name']=$r['name'];
			}

			// Add ho_dem, ten vào mảng array_list
			foreach ($arr_list as $key => $value) {
				$idhoso = $value['id_hoso'];
				if(isset($info_sv[$idhoso])){
					$arr_list[$key]['hodem'] = $info_sv[$idhoso]['ho_dem'];
					$arr_list[$key]['ten'] = $info_sv[$idhoso]['name'];
				}
			}

			if($THIS_KHOA!=''){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					if(strcasecmp($value['id_khoa'], $THIS_KHOA) == 0) $new_array[] = $value;
				}
				$arr_list = $new_array;
			}

			if($id_lop!=''){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					if(strcasecmp($value['malop'], $id_lop) == 0) $new_array[] = $value;
				}
				$arr_list = $new_array;
			}

			if($id_hoso!=''){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					if(strcasecmp($value['id_hoso'], $id_hoso) == 0) $new_array[] = $value;
				}
				$arr_list = $new_array;
			}

			if($masv!=''){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					if(strcasecmp($value['masv'], $masv) == 0) $new_array[] = $value;
				}
				$arr_list = $new_array;
			}

			if($tensv!=''){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					$idhoso = $value['id_hoso'];
					if(strcasecmp($info_sv[$idhoso]['ho_dem'], $tensv) == 0 || strcasecmp($info_sv[$idhoso]['name'], $tensv) == 0){
						$new_array[] = $value;
					}
				}
				$arr_list = $new_array;
			}

			if($_statusCall!='' && $_statusCall!=='all'){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					if(strcasecmp($value['tinhtrang_call'], $_statusCall) == 0) $new_array[] = $value;
				}
				$arr_list = $new_array;
			}

			if($_statusHT!='' && $_statusHT!=='all'){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					if(strcasecmp($value['statusHT'], $_statusHT) == 0) $new_array[] = $value;
				}
				$arr_list = $new_array;
			}

			if($_staff!='' && $_staff!=='all'){
				$new_array = array();
				foreach ($arr_list as $key => $value) {
					if($value['id_staff'] == $_staff) $new_array[] = $value;
				}
				$arr_list = $new_array;
			}

			if($lastcontact!=''){
				$current_time = time();
				$day_1 = strtotime("-1 day");
				$day_3 = strtotime("-3 day");
				$day_7 = strtotime("-1 week");
				$day_14 = strtotime("-2 week");
				$day_30 = strtotime("-1 month");

				$new_array = array();
				switch ($lastcontact) {
					case '1': 
					foreach ($arr_list as $key => $value) {
						if($value['last_contact']>=$day_1 && $value['last_contact']<=$current_time){
							$new_array[] = $value;
						}
					}
					$arr_list = $new_array;
					break;

					case '3':
					foreach ($arr_list as $key => $value) {
						if($value['last_contact']>=$day_3 && $value['last_contact']<=$current_time){
							$new_array[] = $value;
						}
					}
					$arr_list = $new_array;
					break;

					case '7': 
					foreach ($arr_list as $key => $value) {
						if($value['last_contact']>=$day_7 && $value['last_contact']<=$current_time){
							$new_array[] = $value;
						}
					}
					$arr_list = $new_array;
					break;

					case '14': 
					foreach ($arr_list as $key => $value) {
						if($value['last_contact']>=$day_14 && $value['last_contact']<=$current_time){
							$new_array[] = $value;
						}
					}
					$arr_list = $new_array;
					break;

					case '30': 
					foreach ($arr_list as $key => $value) {
						if($value['last_contact']>=$day_30 && $value['last_contact']<=$current_time){
							$new_array[] = $value;
						}
					}
					$arr_list = $new_array;
					break;

					default: 
					foreach ($arr_list as $key => $value) {
						if($value['last_contact']<=$day_30){
							$new_array[] = $value;
						}
					}
					$arr_list = $new_array;
					break;
				}
			}

			$stt=0; $ids='';$tinchi=1;
			foreach($arr_list as $r){ 
				$stt++;
				$id_hoso = $r['id_hoso'];
				$masv = $r['masv'];
				$hodem = $r['hodem'];
				$name = $r['ten'];
				$hovaten = $hodem.' '.$name;
				$name_nganh = isset($_NGANH['N'.$r['id_nganh']]) ? $_NGANH['N'.$r['id_nganh']] : '';
				$name_he = isset($_HE['H'.$r['id_he']]) ? $_HE['H'.$r['id_he']] : '';
				$dienthoai = $HOCSINH[$id_hoso]['dienthoai']>0 ? $HOCSINH[$id_hoso]['dienthoai'] : '';

				$id_ht = $r['id_ht']; 
				$ids.= $id_ht.",";
				$tinchi = $r['tinchi'];
				$diem = json_decode($r['diem'],true); 
				$status = $r['status'];
				$ketqua = $r['ketqua']; 
				$ketqua2 = $r['ketqua2'];
				$ketqua3 = $r['ketqua3'];
				$diem_pass = 4;

				if($r['status']!==null) { 
					/* Chỉ xét khi đã có kết quả Đạt/không đạt*/
					$diem_pass = $arrHP['total'];
					switch($r['status']){
						case 'HT01': $html_status="<a class='label other' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Chưa học</a>"; break;
						case 'HT02': $html_status="<a class='label label-success' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Đang học</a>"; break;
						case 'HT03': $html_status="<a class='label label-success' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Đang thi</a>"; break;
						case 'HT04': $html_status="<a class='label label-warning' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Không đạt</a>"; break;
						case 'HT05': $html_status="<a class='label label-success' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Đạt</a>"; break;
						case 'HT06': $html_status="<a class='label label-danger' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Thi lại</a>"; break;
						default: $html_status="<a class='label other' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Chưa học</a>"; break;
					}
				}

				$name_khoa = isset($KHOA[$r['id_khoa']])? $KHOA[$r['id_khoa']]['name'] : '';
				$name_he = isset($HE[$r['id_he']])? $HE[$r['id_he']]['name'] : '';
				$name_nganh = isset($NGANH[$r['id_nganh']])? $NGANH[$r['id_nganh']]['name'] : '';
				$nguoiphutrach = $r['id_staff'];
				$lophoc = $r['malop'];
				
				$songay = $noidung_lienhecuoi = "";
				$last_contact = isset($WORK_LOG[$masv]) ? (int)$WORK_LOG[$masv]['date'] : 0;
				if($last_contact>0){
					$date1 = date("Y-m-d H:i:s", time());
					$date2 = date("Y-m-d H:i:s", $last_contact);
					$dtNow = new DateTime($date1);
					$dtToCompare = new DateTime($date2);
					$diff = $dtNow->diff($dtToCompare);
					if($diff->days > 0){
						$songay = $diff->days.' ngày trước';
					}
					$noidung_lienhecuoi = isset($WORK_LOG[$masv]) ? $WORK_LOG[$masv]['noidung'] : "";
				}else{
					$songay = "Chưa liên hệ";
				}

				$id_staff = $r['id_staff'];
				$staff = isset($STAFF_NV[$r['id_staff']]) ? $STAFF_NV[$r['id_staff']]['fullname'] : "";

				if($staff!==""){
					$nguoiphutrach = '<a href="javascript:void(0)" class="label label-success" data-masv="'.$masv.'" data-staff="'.$id_staff.'" onclick="frm_select_staff(this)" title="Chọn người phụ trách">'.$staff.'</a>';
				}else{
					$nguoiphutrach = '<a href="javascript:void(0)" class="label label-success" data-masv="'.$masv.'" data-staff="" onclick="frm_select_staff(this)" title="Chọn người phụ trách">---</a>';
				}

				$tinhtrang_sv = isset($ARR_STATUS_SV[$masv]) ? $ARR_STATUS_SV[$masv] : '---';
				$txt_tinhtrang_sv = $tinhtrang_sv!=='---' && isset($STATUS_SV[$tinhtrang_sv]) ? $STATUS_SV[$tinhtrang_sv]:'';

				$tinhtrang_call = strlen($r['tinhtrang_call'])>0 ? $r['tinhtrang_call'] : '---';
				$txt_tinhtrang_call = $tinhtrang_call!=='---' ? $STATUS_CALL[$tinhtrang_call] : '';
				
				$last_comment = '';
				$res_hoctap_note = SysGetList('tbl_hoctap_note', array(), "AND id_hoctap='".$id_ht."'");
				$num_note = count($res_hoctap_note);
				if($num_note>0){
					$key_note = $num_note-1;
					$last_comment = Substring($res_hoctap_note[$key_note]['notes'], 0, 15);
				}

				/* Mảng các giá trị sẽ ẩn box nhập điểm */
				$arr_status_hide_box = array('HT01','HT04','HT05');
				?>
				<tr dataid="<?php echo $id_ht;?>" datama="<?php echo $masv;?>" datamon="<?php echo $r['id_monhoc'];?>">
					<td align="center"><?php echo $stt;?></td>
					<td align="center" width="30">
						<label class="action" style="border:0px">
							<input type='checkbox' name='chk' id='chk' onclick="docheckonce('chk');" value='<?php echo $id_ht;?>'/>
						</label>
					</td>

					<td>
						<div class="infoSV">
							<div class="masv"><a href="<?php echo ROOTHOST.'student/diem/'.$masv;?>" title=""><strong><?php echo $masv;?></strong></a></div>
							<div class="name"><a href="<?php echo ROOTHOST.'student/diem/'.$masv;?>" class="cblack" title=""><?php echo $hovaten;?></a></div>
							<div class="phone"><span class="cblack">SĐT: </span><?php echo $dienthoai;?></div>
						</div>
					</td>

					<td align="center" title="<?php echo $txt_tinhtrang_sv;?>">
						<a href="javascript:void(0)" class="label label-success" onclick="frm_status_sv(this)" data-masv="<?php echo $masv;?>" data-status-sv="<?php echo $tinhtrang_sv;?>"><?php echo $tinhtrang_sv;?></a>
						<div class="txt_status"><?php echo $txt_tinhtrang_sv;?></div>
					</td>

					<td align="center" width="180" title="<?php echo $txt_tinhtrang_call;?>">
						<a href="javascript:void(0)" class="label label-success" onclick="frm_status_call(this)" data-masv="<?php echo $masv;?>" data-status-call="<?php echo $tinhtrang_call;?>"><?php echo $tinhtrang_call;?></a>
						<div class="txt_status"><?php echo $txt_tinhtrang_call;?></div>
						<div class="lienhecuoi"><?php echo $songay;?></div>
						<div class="noidung_lienhecuoi"><?php echo $noidung_lienhecuoi;?></div>
					</td>

					<td align="center"><?php echo $html_status;?></td>
					<td align="center"><?php echo $nguoiphutrach;?></td>

					<td>
						<div class="daotao-info">
							<div class="el lop">Lớp: <?php echo $lophoc;?></div>
							<div class="el tinchi">Số tín chỉ: <?php echo $r['tinchi'];?></div>
							<div class="el monhoc"><?php echo $arrMon[$r['id_monhoc']]['name'];?></div>
						</div>

					</td>

					<td align="center" width="150">
						<div class="box-diem">
							<span class="cblack">Chuyên cần: </span>
							<div class="chuyencan">
								<?php
								if(in_array($status, $arr_status_hide_box)) {
									if(isset($diem['chuyencan'])) echo $diem['chuyencan']; 
								} else {
									$diemchuyencan = isset($diem['chuyencan']) ? $diem['chuyencan'] : '';
									echo '<input type="text" name="chuyencan" class="nhapdiem chuyencan form-control" value="'.$diemchuyencan.'" dataid="'.$id_ht.'" datama="'.$r['masv'].'">';
								}?>
							</div>
							<span class="cblack">Kiểm tra: </span>
							<div class="kiemtra">
								<?php
								if(in_array($status, $arr_status_hide_box)) {
									if(isset($diem['diemkt'])) echo $diem['diemkt']; 
								}else {
									$diemkt = isset($diem['diemkt']) ? $diem['diemkt'] : '';
									echo '<input type="text" name="diemkt" class="nhapdiem diemkt form-control" value="'.$diemkt.'" dataid="'.$id_ht.'" datama="'.$r['masv'].'">';
								}?>
							</div>
							<span class="cblack">Thi: </span>
							<div class="thi">
								<?php
								if(in_array($status, $arr_status_hide_box)) {
									if(isset($diem['diemthi'])) echo $diem['diemthi']; 
								}else {
									$diemthi = isset($diem['diemthi']) ? $diem['diemthi'] : '';
									echo '<input type="text" name="diemthi" class="nhapdiem diemthi form-control" value="'.$diemthi.'" dataid="'.$id_ht.'" datama="'.$r['masv'].'">';
								}?>
							</div>
						</div>
					</td>

					<td align="center" width="150">
						<a dataid='<?php echo $id_ht;?>' title='Note' class="btn_readNote"><i class="fa fa-commenting-o" aria-hidden="true"> <span class='label_number' id='id_<?php echo $id_ht;?>'>0</span></i></a>
						<div class="last-comment"><?php echo $last_comment;?></div>
					</td>

					<td align="center">
						<div class="time"><?php if($r['mdate']!='') echo date("d/m/y H:i",$r['mdate']);?></div>
						<button class='btn btn-default btn_capnhap_diem' data_mon='<?php echo $r['id_monhoc'];?>' data_masv='<?php echo $r['masv'];?>'>Cập nhập điểm</button>
					</td>

					<!-- <td class='text-center'>
						<?php
						// if($status=='HT01'){
						// 	echo '';
						// }elseif ($status=='HT02') {
						// 	echo '<button type="button" class="btn btn-status btn-warning btn_xet_dat">Xét</button>';
						// }elseif ($status=='HT03') {
						// 	echo '<button type="button" class="btn btn-status btn-warning btn_xet_dat">Xét</button>';
						// }elseif ($status=='HT04') {
						// 	echo '';
						// }elseif ($status=='HT05') {
						// 	echo '';
						// }elseif ($status=='HT06') {
						// 	// if()
						// 	echo '<button type="button" class="btn btn-status btn-warning btn_xet_dat">Xét</button>';
						// }
						?>
					</td> -->
				</tr>
			<?php } ?>
		</tbody>
	</table>
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

		$("#tk_btnsearch").click(function(){
			$("#frm_search").submit();
		});

		$('.btn_capnhap_diem').click(function(){ // tự động từ hệ thống
			var _url='<?php echo ROOTHOST;?>ajaxs/hoctap/frm_update_diem.php';
			var _masv=$(this).attr('data_masv');
			var _mon=$(this).attr('data_mon');
			$.get(_url,{'masv':_masv,'mon':_mon},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-title').html('Cập nhập điểm');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		});

		$(".nhapdiem").keypress(function(e){
			if(e.which==13) {
				var ht_row = $(this).parent().parent();
				var ht_id = ht_row.attr('dataid');
				var masv = ht_row.attr('datama');
				var id_mon = ht_row.attr('datamon');
				var chuyencan = ht_row.find('.chuyencan').val();
				var diemkt = ht_row.find('.diemkt').val();
				var diemthi = ht_row.find('.diemthi').val();
				save_diem(masv,ht_id,id_mon,chuyencan,diemkt,diemthi);
			}
		});

		$(".import_diem1").click(function(){
			if(checkinput()==true) {
				$("#txttype").val(1);
				$("#txtfile").trigger('click');
			}else alert("Vui lòng chọn đầy đủ thông tin tìm kiếm trước khi import file");
		});

		$(".import_diem2").click(function(){
			if(checkinput()==true) {
				$("#txttype").val(2);
				$("#txtfile").trigger('click');
			}else alert("Vui lòng chọn đầy đủ thông tin tìm kiếm trước khi import file");
		});

		$(".import_diem3").click(function(){
			if(checkinput()==true) {
				$("#txttype").val(3);
				$("#txtfile").trigger('click');
			}else alert("Vui lòng chọn đầy đủ thông tin tìm kiếm trước khi import file");
		});

		$('#txtfile').change(function(){
			$('#frm_import').submit();
		});

		// read note hoctap
		$('.btn_readNote').click(function(){
			var ht_id=$(this).attr('dataid');
			$.get('<?php echo ROOTHOST;?>ajaxs/hoctap/get_note.php',{'ht_id':ht_id},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-title').html('Ghi chú');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		});


		/* Các chức năng tạm không dùng trong quản lý học viên */
		$(".btn_thilai1").keypress(function(e){
			if(e.which==13) {
				var id_ht = $(this).attr('dataid');
				var diemthi = $(this).val();
				if(id_ht!=="" && diemthi!==""){
					save_diemthilai1(id_ht, diemthi);
				}
			}
		});

		$(".btn_thilai2").keypress(function(e){
			if(e.which==13) {
				var id_ht = $(this).attr('dataid');
				var diemthi = $(this).val();
				if(id_ht!=="" && diemthi!==""){
					save_diemthilai2(id_ht, diemthi);
				}
			}
		});

		$(".btn_thilai").click(function(){
			if(confirm("Bạn có chắc chắn thực hiện đăng ký thi lại cho SV này?")) {
				var ht_row = $(this).parent().parent();
				var ht_id = ht_row.attr('dataid');
				var masv = ht_row.attr('datama');
				var id_mon = ht_row.attr('datamon');
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_thilai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'type':1,'hocky':'<?php echo $hocky;?>'},function(req){
					if(req=="error") showMess("Lỗi trong quá trình đăng ký thi lại.","error");
					else if(req=="success") {
						showMess("Đăng ký thi lại thành công","");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}else {
						showMess(req,"");
					}
				})
			}
		});

		$(".btn_thicaithien").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			var _data = {
				'masv':masv,
				'ht_id':ht_id,
				'id_mon':id_mon,
				'type':2,
				'hocky':'<?php echo $hocky;?>'
			}
			if(confirm("Bạn có chắc chắn thực hiện đăng ký thi cải thiện cho SV #"+masv+"?")) {
				var _url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_thilai.php";
				$.post(_url, _data, function(req){
					if(req=="error") showMess("Lỗi trong quá trình đăng ký thi cải thiện điểm.","error");
					else if(req=="success") {
						showMess("Đăng ký thi cải thiện điểm thành công","");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}else {
						showMess(req,"");
					}
				})
			}
		});

		$(".thilai").keypress(function(e){
			if(e.which==13) {
				var ht_row = $(this).parent().parent();
				var ht_id = ht_row.attr('dataid');
				var masv = ht_row.attr('datama');
				var id_mon = ht_row.attr('datamon');
				var thilai = $(this).val();
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_diem_thilai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'thilai':thilai},function(req){
					if(req=="error") {
						showMess("Lỗi nhập điểm thi lại.","error");
					} else if(req=="success") {
						showMess("Đã nhập điểm thi lại thành công.","");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}else {
						showMess(req,"");
					}
				}) 
			}
		});

		$(".btn_xet_thilai").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			if(confirm("Bạn có chắc chắn thực hiện Xét Đạt/Không Đạt cho SV #"+masv+"?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_xet_thilai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'id_mon':id_mon,
					'id_he':'<?php echo $THIS_HE;?>','id_nganh':'<?php echo $THIS_NGANH;?>'},function(req){
						console.log(req);
						debugger;
						// if(req=="error") {
						// 	showMess("Lỗi trong quá trình xét đạt/không đạt cho SV #"+masv,"error");
						// } else {
						// 	showMess(req,"");
						// 	setTimeout(function(){ window.location.reload(); }, 3000);
						// }
					})
			}
		});

		$(".btn_xet_dat").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			var _data = {
				'masv':masv,
				'ht_id':ht_id,
				'id_mon':id_mon
			};
			if(confirm("Bạn có chắc chắn thực hiện Xét Đạt/Không Đạt cho SV #"+masv+"?")) {
				var _url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_xet_dat.php";
				$.post(_url, _data, function(req){
					if(req=="error") {
						showMess("Lỗi trong quá trình xét đạt/không đạt cho SV #"+masv,"error");
					} else {
						showMess(req,"");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}
				})
			}
		});
		
		$(".btn_hoclai").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			var _data = {
				'masv':masv,
				'ht_id':ht_id,
				'id_mon':id_mon,
				'type':1,
				'hocky':'<?php echo $hocky;?>',
				'tinchi':'<?php echo $tinchi;?>'
			}
			if(confirm("Bạn có chắc chắn thực hiện đăng ký học lại cho SV #"+masv+"?")) {
				var _url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_hoclai.php";
				$.post(_url, _data, function(req){
					if(req=="error") showMess("Lỗi trong quá trình đăng ký học lại.","error");
					else if(req=="success") {
						showMess("Đăng ký học lại thành công","");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}else {
						showMess(req,"");
					}
				})
			}
		});

		$(".btn_hoccaithien").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			if(confirm("Bạn có chắc chắn thực hiện đăng ký học học cải thiện cho SV #"+masv+"?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_hoclai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'type':2,
					'hocky':'<?php echo $hocky;?>','tinchi':'<?php echo $tinchi;?>'},function(req){
						if(req=="error") showMess("Lỗi trong quá trình đăng ký học cải thiện.","error");
						else if(req=="success") {
							showMess("Đăng ký học cải thiện thành công","");
							setTimeout(function(){ window.location.reload(); }, 3000);
						}else {
							showMess(req,"");
						}
					})
			}
		});
		/* /.Các chức năng tạm không dùng trong quản lý học viên */
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

function checkinput(){
	var lop = $("#ma_lop option:selected").val();
	if(lop=="") {
		$("#ma_lop").addClass('novalid');
		$("#ma_lop").focus();
		return false;
	}else {
		$("#ma_lop").removeClass('novalid');
		return true;
	}
}

function save_diem(masv,ht_id,id_mon,chuyencan,diemkt,diemthi) {
	var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_diem.php";
	var _data = {
		'masv':masv,
		'ht_id':ht_id,
		'id_mon':id_mon,
		'chuyencan':chuyencan,
		'diemkt':diemkt,
		'diemthi':diemthi,
	};
	$.post(url, _data,function(req){
		if(req=="success") {
			showMess("Đã lưu thành công");
			setTimeout(function(){ window.location.reload(); }, 1000);
		}
	}) 
}

function save_diemthilai1(id_hoctap,diemthi){
	var _url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_save_diemthilai1.php";
	var _data = {
		'id_hoctap':id_hoctap,
		'diemthi':diemthi,
	};
	$.post(_url, _data,function(req){
		if(req=="success") {
			showMess("Đã lưu thành công");
			setTimeout(function(){ window.location.reload(); }, 1000);
		}
	}) 
}

function save_diemthilai2(id_hoctap,diemthi){
	var _url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_save_diemthilai2.php";
	var _data = {
		'id_hoctap':id_hoctap,
		'diemthi':diemthi,
	};
	$.post(_url, _data,function(req){
		if(req=="success") {
			showMess("Đã lưu thành công");
			setTimeout(function(){ window.location.reload(); }, 1000);
		}
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
</script>