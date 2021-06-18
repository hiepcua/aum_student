<?php
defined('ISHOME') or die("You can't access this page!");
$obj=new CLS_MYSQL;
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

/* Get tương tác cuối cùng theo từng sinh viên */
$WORK_LOG = array();
$current_time = time();
$res_log = SysGetList('tbl_working_log', array(), "AND finish=1 AND `date`<=".$current_time." ORDER BY cdate DESC");
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
$_staff 	= $THIS_STAFF;
$THIS_KHOA 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$THIS_HE 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$THIS_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$_id_lop 	= isset($_GET['malop']) ? antiData(strip_tags($_GET['malop'])):'';
$id_mon 	= isset($_GET['mamon']) ? antiData(strip_tags($_GET['mamon'])):'';
$id_hoso 	= isset($_GET['mahoso']) ? antiData(strip_tags($_GET['mahoso'])):'';
$_masv 		= isset($_GET['masv']) && $_GET['masv'] !== 'undefined' ? antiData($_GET['masv']):'';
$_tensv 	= isset($_GET['ten']) && $_GET['ten'] !== 'undefined' ? antiData($_GET['ten']):'';
$_statusHT 	= isset($_GET['statusHT']) ? antiData($_GET['statusHT']) : 'all';
$_statusCall = isset($_GET['statusCall']) ? antiData($_GET['statusCall']) : 'all';
$lastcontact = isset($_GET['lastcontact']) ? antiData($_GET['lastcontact']) : '';
$get_startdate 	= isset($_GET['startdate']) && $_GET['startdate']!=="" ? strtotime($_GET['startdate']) : '';
$get_enddate 	= isset($_GET['enddate']) && $_GET['enddate']!=="" ? strtotime($_GET['enddate']) : '';
$_startdate 	= $get_startdate!=="" ? date('Y-m-d', $get_startdate) : '';
$_enddate 		= $get_enddate!=="" ? date('Y-m-d', $get_enddate) : '';

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
}


if($_masv!=''){
	$strWhere.=" AND masv='".$_masv."'";
}
if($THIS_NGANH!=''){
	$strWhere.=" AND id_nganh='".$THIS_NGANH."'";
}
if($THIS_HE!=''){
	$strWhere.=" AND id_he='".$THIS_HE."'";
}
if($_staff!='' && $_staff!='all'){
	$strWhere.=" AND id_staff='".$_staff."'";
}
if($_id_lop!=''){
	$strWhere.=" AND malop='".$_id_lop."'";
}
if($_statusCall!='' && $_statusCall!='all'){
	$strWhere.=" AND tinhtrang_call='".$_statusCall."'";
}

// Get đăng ký tuyển sinh
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), $strWhere);
if(count($res_dkts)>0){
	foreach ($res_dkts as $key => $value) {
		$DKTS[$value['masv']] = $value;
	}
}
$arr_data = $DKTS;

foreach ($arr_data as $key => $value) {
	$masv = $key;
	$ma_hoso = $value['id_hoso'];
	$hodem = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['ho_dem'] : "";
	$tensv = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['name'] : "";
	$sodienthoai = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['dienthoai'] : "";
	$hotensv = $hodem.' '.$tensv;
	$id_nganh = $value['id_nganh'];
	$id_staff = $value['id_staff'];
	$name_staff = isset($STAFF_ALL[$id_staff]) ? $STAFF_ALL[$id_staff]['fullname'] : "";
	$name_nganh = isset($NGANH[$id_nganh]) ? $NGANH[$id_nganh]['name'] : "";

	$last_date_contact = $noidung_contact = "";
	if(isset($WORK_LOG[$masv])){
		$last_date_contact = (int)$WORK_LOG[$masv]['date']>0 ? $WORK_LOG[$masv]['date'] : "";
		$noidung_contact = $WORK_LOG[$masv]['noidung'];
	}

	$arr_data[$key]['hotensv'] = $hotensv;
	$arr_data[$key]['sodienthoai'] = $sodienthoai;
	$arr_data[$key]['name_staff'] = $name_staff;
	$arr_data[$key]['name_nganh'] = $name_nganh;
	$arr_data[$key]['last_date_contact'] = $last_date_contact;
	$arr_data[$key]['noidung_contact'] = $noidung_contact;
}
?>
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
							<label>Mã SV</label>
							<input type="text" id="tk_masv" name="masv" class="form-control" value="<?php echo $_masv?>" placeholder="Mã sinh viên">
						</div>

						<div class="col-md-2 col-xs-6">
							<label>Tên SV</label>
							<input type="text" id="tk_tensv" name="ten" class="form-control" value="<?php echo $_tensv?>" placeholder="Tên sinh viên">
						</div>

						<!-- <div class="col-md-2 col-xs-6">
							<label>Môn học</label>
							<select name="mamon" id="ma_mon" class="form-control">
								<option value="">Môn học</option>
							</select>
						</div> -->

						<div class="col-md-2 col-xs-6">
							<label>Lớp</label>
							<input type="text" id="ma_lop" class="form-control" name="malop" value="<?php echo $_id_lop;?>" placeholder="Mã lớp">
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

						<!-- <div class="col-md-2 col-xs-6">
							<label>Trạng thái học tập</label>
							<select class="form-control" name='statusHT' id="cbo_statusHT">
								<option value="all">-- Trạng thái HT --</option>
								<?php
								// foreach ($STATUS_HOCTAP as $key => $value) {
								// 	$selected = ($_statusHT == $key) ? 'selected' : '';
								// 	echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
								// }
								?>
							</select>
						</div> -->

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

						<div class="col-md-3 col-xs-6">
							<label>.</label>
							<div class="box-search-date">
								<span class="text">Start date:</span>
								<input type="date" name="startdate" value="<?php echo $_startdate;?>" class="form-control">
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<label>.</label>
							<div class="box-search-date">
								<span class="text">End date:</span>
								<input type="date" name="enddate" value="<?php echo $_enddate;?>" class="form-control">
							</div>
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

	<div class="accordion" id="list_students">
		<?php
		// Xử lý tìm kiếm
		if($_tensv!=''){
			$new_array = array();
			foreach ($arr_data as $key => $value) {
				if(strcasecmp($value['hotensv'], $_tensv) == 0) $new_array[] = $value;
			}
			$arr_data = $new_array;
		}
		if($lastcontact!=''){
			$new_array = array();
			$current_time = time();
			$day_1 = strtotime("-1 day");
			$day_3 = strtotime("-3 day");
			$day_7 = strtotime("-1 week");
			$day_14 = strtotime("-2 week");
			$day_30 = strtotime("-1 month");

			if($lastcontact=="oldest"){
				foreach ($arr_data as $key => $value) {
					if($value['last_date_contact']<=$day_30) $new_array[] = $value;
				}
			}else{
				switch ($lastcontact) {
					case '1': 
					foreach ($arr_data as $key => $value) {
						if($value['last_date_contact']>=$day_1 && $value['last_date_contact']<=$current_time) $new_array[] = $value;
					}
					break;
					case '3': 
					foreach ($arr_data as $key => $value) {
						if($value['last_date_contact']>=$day_3 && $value['last_date_contact']<=$current_time) $new_array[] = $value;
					}
					break;
					case '7': 
					foreach ($arr_data as $key => $value) {
						if($value['last_date_contact']>=$day_7 && $value['last_date_contact']<=$current_time) $new_array[] = $value;
					}
					break;
					case '14': 
					foreach ($arr_data as $key => $value) {
						if($value['last_date_contact']>=$day_14 && $value['last_date_contact']<=$current_time) $new_array[] = $value;
					}
					break;
					case '30':
					foreach ($arr_data as $key => $value) {
						if($value['last_date_contact']>=$day_30 && $value['last_date_contact']<=$current_time) $new_array[] = $value;
					}
					break;
					default: 
					foreach ($arr_data as $key => $value) {
						if($value['last_date_contact']>=$day_30 && $value['last_date_contact']<=$current_time) $new_array[] = $value;
					}
					break;
				}
			}
			$arr_data = $new_array;
		}
		if($get_startdate!=""){
			$new_array = array();
			$current_time = time();
			foreach ($arr_data as $key => $value) {
				if($value['last_date_contact']>=$get_startdate && $value['last_date_contact']<=$current_time) $new_array[] = $value;
			}
			$arr_data = $new_array;
		}
		if($get_enddate!=""){
			$new_array = array();
			$current_time = time();
			foreach ($arr_data as $key => $value) {
				if($value['last_date_contact']<=$get_enddate) $new_array[] = $value;
			}
			$arr_data = $new_array;
		}

		$total_rows = count($arr_data);
		$max_pages = ceil($total_rows/MAX_ROWS);
		$cur_page = getCurentPage($max_pages);
		$start = ($cur_page - 1) * MAX_ROWS;
		$end = $start + MAX_ROWS;
		$stt=$start; $ids='';$tinchi=1;

		if($total_rows>0){
			$i=0;
			foreach ($arr_data as $key => $value) {
				if($i>=$start && $i<=$end):
					$stt = $stt+1;
					$id_collsapse = $masv = $value['masv'];
					$hotensv = $value['hotensv'];
					$sodienthoai = $value['sodienthoai'];
					$link_diem = ROOTHOST.'student/diem/'.$masv;
					$id_staff = $value['id_staff'];
					$name_staff = $value['name_staff'];

					$songay = $noidung_lienhecuoi = "";
					$last_date = $value['last_date_contact'];
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
						$noidung_lienhecuoi = $value['noidung_contact'];
					}else{
						$songay = "Chưa liên hệ";
					}

					echo '<div class="student card">';
					// Card header
					echo '
					<div class="card-header">
					<div class="box-stt">
					<span class="stt">'.$stt.'</span>
					<span class="check"><input type="checkbox" name="chk"></span>
					</div>';

					echo '<div id="heading'.$id_collsapse.'" class="content sinhvien" data-masv="'.$masv.'" data-toggle="collapse" data-target="#collapse_'.$id_collsapse.'" aria-controls="collapse_'.$id_collsapse.'">
					<ul class="list-unstyle">
					<li><span class="txt" style="display:inline-block"><i class="fa fa-clock-o" aria-hidden="true"></i> </span> '.$songay.'
					<div class="mt-1"><a href="javascript:void(0)" onclick="frm_tuongtac(this)" class="label label-success" data-masv="'.$masv.'" title="Tương tác sinh viên"><i class="fa fa-plus" aria-hidden="true"></i> Tương tác</a></div>
					</li>
					<li><span class="txt">Nội dung: </span> <div class="lienhecuoi txt">'.$noidung_lienhecuoi.'</div></li>
					<li><span class="txt">Họ tên: </span><a href="'.$link_diem.'" title="Quản lý điểm">'.$hotensv.'</a></li>
					<li><span class="txt">Mã SV: </span><a href="'.$link_diem.'" title="Quản lý điểm">'.$masv.'</a></li>
					<li><span class="txt">SĐT: </span>'.$sodienthoai.'</li>';
					if(!$IS_NV){
						echo '<li><span class="txt">Người phụ trách: </span><a href="javascript:void(0)" class="label label-primary" data-masv="'.$masv.'" data-staff="'.$id_staff.'" onclick="frm_select_staff(this)" title="Chọn người phụ trách">'.$name_staff.'</a></li>';
					}
					echo '<li><span class="txt">Ngành: </span>'.$value['name_nganh'].'</li>
					<li><span class="txt">Lớp: </span>'.$value['malop'].'</li>
					</ul>
					</div>
					</div>';

					// Card collapse
					echo '<div id="collapse_'.$id_collsapse.'" class="card-collapse collapse" aria-labelledby="heading'.$id_collsapse.'" data-parent="#list_students">
					<div id="masv_'.$masv.'" class="card-body"></div>
					</div>';
					echo '</div>';
					$i=$i+1;
				endif;
			}
		}
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
			<tr><td align="center">
				<?php paging($total_rows,MAX_ROWS,$cur_page); ?>
			</td></tr>
		</table>
	</div>
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
		$(".sinhvien").click(function(){
			var _masv = $(this).attr('data-masv');
			if(_masv.length>0){
				if($(this).hasClass('active')==false){
					$(".sinhvien").removeClass('active');
					$(".card-collapse .card-body").html();
					$(this).addClass('active');
					get_hoctap(_masv);
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

		$("#tk_btnsearch").click(function(){
			$("#frm_search").submit();
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

	function get_hoctap(masv){
		if(masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/hoctap/get_hoctap.php';
			var _data = {
				'masv' : masv,
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
</script>