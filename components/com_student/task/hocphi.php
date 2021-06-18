<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$_masv = antiData($_GET['id']);
if($_masv=='') die("Không có dữ liệu");
$_SESSION['THIS_YEAR'] = $_SESSION['THIS_BAC'] = $_SESSION['THIS_NGANH'] = '';
$hocky=8; $slot=24;
//---------------------------------------
$obj = new CLS_MYSQL;
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH[$r['id']]=$r['name'];
}

//---------------------------------------
$sql="SELECT * FROM tbl_lop";
$obj->Query($sql);
$_HE=array();
while($r=$obj->Fetch_Assoc()){
	$_LOP[$r['id']]=$r['name'];
}


// Tình trạng HV theo mã sinh viên
$_ARR_STATUS_SV = array();
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array('masv', 'tinhtrang_sv'));
foreach ($res_dkts as $key => $value) {
	$_ARR_STATUS_SV[$value['masv']] = $value['tinhtrang_sv'];
}

/* Handle GET parameter */
$id_he 			= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$id_nganh 		= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$get_order 		= isset($_GET['order']) && $_GET['order']!=="" ? antiData($_GET['order']) : '';
$get_lop 		= isset($_GET['lop']) && $_GET['lop']!=="" ? antiData($_GET['lop']) : '';
$get_hocky 		= isset($_GET['hocky']) ? antiData($_GET['hocky'], 'int') : '';
$get_slot 		= isset($_GET['slot']) ? antiData($_GET['slot'], 'int') : '';
$get_status 	= isset($_GET['status']) && $_GET['status']!=="" ? addslashes($_GET['status']) : '';

//---- Lấy danh sách đợt đóng học phí ---------
$url='http://uid.aumsys.net/api/student/order';
$json = array();
$json['key'] = PIT_API_KEY;
$json['id_school'] = SCHOOL_CODE;

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

//---- Get order detail by masv ---------
$url='http://uid.aumsys.net/api/student/order_detail';
$json = array();
$json['key'] = PIT_API_KEY;
$json['masv'] 		= $_masv;
$json['id_order']	= $get_order; 			// varchar
$json['ma_nganh']	= $id_nganh; 			// varchar
$json['ma_lop']		= $get_lop; 			// varchar
$json['hocky'] 		= $get_hocky;			// int
$json['slot'] 		= $get_slot;			// int
$json['status']		= $get_status; 			// int

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$res_status = $res_data['status'];
if($res_status!=="yes") die("Không có dữ liệu");
$res_order_detail = $res_data['data'];

$arr_soluong = array();
$tong_hocphi=$tong_dadong=$tong_conlai=0;
foreach ($res_order_detail as $key => $value) {
	$tong_hocphi+= $value['hocphi'];
	$tong_dadong+= $value['dadong'];
	$tong_conlai+= $value['conlai'];
	$arr_soluong[$value['id_order']] = $value['id_order'];
}

/* LỊCH SỬ ĐÓNG HỌC PHÍ */
$url='http://uid.aumsys.net/api/student/order_pay';
$json = array();
$json['key'] = PIT_API_KEY;
$json['masv'] = $_masv;

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$row_order_history = $res_data['data'];

//---------------------------------------
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND masv='".$_masv."'");
if(count($res_dkts)<=0) die('Không có dữ liệu sinh viên');
$row_dkts = $res_dkts[0];
$he = $row_dkts['id_he'];
$nganh = $row_dkts['id_nganh'];
$masv = $row_dkts['masv'];
$malop = $row_dkts['malop'];
$id_hoso = $row_dkts['id_hoso'];
$status = $row_dkts['status'];

//---------------------------------------
$objhs = new CLS_HS;
$objhs->getList(" AND ma='$id_hoso'");
$r=$objhs->Fetch_Assoc();
$fullname = $r['ho_dem'].' '.$r['name'];
$gender = $r['gioitinh']=='nam' ? 'Nam' : 'Nữ';
$ngaysinh = date("Y-m-d",$r['ngaysinh']);
$hokhau = $r['hktt'];

//---------------------------------------
?>
<style type="text/css">
	.price{
		color: red; 
		font-weight: bold; 
		font-size: 16px;
	}
	.label.price{
		color: #FFF !important;
		font-size: 12px;
	}
	.list-flex{
		display: flex;
		flex-wrap: wrap;
	}
	.list-flex .item:first-child .panel {
		position: relative;
		height: calc(100% - 20px);
	}
	#frm_search .form-control{
		margin-bottom: 10px;
	}
</style>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý Học phí</div>
			</div>
			<ul class="pull-right">
				<li><a href="<?php echo ROOTHOST;?>student/qlhocphi" class="btn btn-default btn-close" title="Thoát">
					<i class="fa fa-reply"></i> Thoát</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="container-fluid">
		<div class="list-flex row">
			<div class="col-md-5 col-xs-12 item">
				<div class="panel panel-warning">
					<div class="panel-body">
						<h4>THÔNG TIN SINH VIÊN</h4>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Mã sinh viên</div>
							<div class="col-md-9 col-xs-8"><?php echo $masv;?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Lớp</div>
							<div class="col-md-9 col-xs-8"><?php echo $malop;?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Họ và tên</div>
							<div class="col-md-9 col-xs-8"><?php echo $fullname;?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Ngày sinh</div>
							<div class="col-md-9 col-xs-8"><?php echo $ngaysinh;?></div>
						</div>
						<div class="row form-group">	
							<div class="col-md-3 col-xs-4 text">Giới tính</div>
							<div class="col-md-9 col-xs-8"><?php echo $gender;?></div>
						</div>
						<div class="row form-group">	
							<div class="col-md-3 col-xs-4 text">Hộ khẩu</div>
							<div class="col-md-9 col-xs-8"><?php echo $hokhau;?></div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-xs-12 item panel panel-warning">
				<div class="panel-body">
					<h4>SỐ LƯỢNG</h4>
					<div class="box_count">
						<div class="form-group">
							<label>Tổng học phí:</label>
							<span class="price count_money"><?php echo number_format($tong_hocphi);?> VNĐ</span>
						</div>
						<div class="form-group">
							<label>Tổng đã đóng:</label>
							<span class="price paid"><?php echo number_format($tong_dadong);?> VNĐ</span>
						</div>
						<div class="form-group">
							<label>Phải thu:</label>
							<span class="price miss_money"><?php echo number_format($tong_conlai);?> VNĐ</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-xs-12 item">
				<div class="panel panel-warning">
					<div class="panel-body">
						<h4>LỊCH SỬ ĐÓNG HỌC PHÍ</h4>
						<div class="box_history">
							<ul>
								<?php 
								foreach ($row_order_history as $key => $value) {
									$sotien = (int)$value['sotien']>0 ? number_format($value['sotien']) .'vnđ' : '';
									$author = $value['author'];
									$date_pay = date("d/m/y H:i",$value['date_pay']);
									echo '<li>
									<div class="note"><i class="fa fa-caret-right"></i> Đã đóng '.$sotien.'</div>
									<small class="date">
									<span class="pull-left">Bởi '.$author.'</span>
									<span class="pull-right">'.$date_pay.'</span>
									</small>
									<div class="clearfix"></div>
									</li>';
								}
								?>
							</ul>
						</div>

						<a href="<?php echo ROOTHOST;?>student/hocphi_history/<?php echo $masv;?>" class="btn btn-default">Xem chi tiết</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-xs-12 panel panel-warning">
			<div class="search_box panel-body">
				<form name="frmsearch" id="frm_search" action="#" method="get" class="row">
					<input type="hidden" name="txtaction" id="txtaction">
					<input type="hidden" name="txtids" id="txtids" value="">
					<div class="row">
						<div class="col-md-10 col-sm-8">
							<div class="col-md-3 col-xs-6">
								<select name="order" id="cbo_order" class="form-control" >
									<option value="">-- Đợt đóng --</option>
									<?php
									foreach ($arr_order as $key => $value) {
										$selected = $get_order==$key ? 'selected' : '';
										echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
									}
									?>
								</select>
							</div>

							<div class="col-md-3 col-xs-6">
								<select name="lop" id="cbo_lop" class="form-control" >
									<option value="">-- Lớp học --</option>
									<?php 
									foreach ($_LOP as $key => $value) {
										$selected = $get_lop==$key ? 'selected' : '';
										echo '<option value="'.$key.'" '.$selected.'>Lớp: '.$value.'</option>';
									}
									?>
								</select>
							</div>

							<div class="col-md-2 col-xs-6">
								<select name="status" id="cbo_status" class="form-control" >
									<option value="">-- Trạng thái đóng HP --</option>
									<option value="yes" <?php echo $get_status=='yes'?'selected':'';?>>Đủ</option>
									<option value="no" <?php echo $get_status=='no'?'selected':'';?>>Còn thiếu</option>
								</select>
							</div>
							<div class="col-md-2 col-xs-6">
								<button type="submit" id="tk_btnsearch" class="btn btn-primary form-control"><i class="fa fa-search"></i> Lọc</button>
							</div>
						</div>

						<div class="col-md-2 col-sm-4">
							<div class="pull-right">
								<button type="button" dataid="<?php echo $masv;?>" class="btn btn-warning btn-print" title="In hồ sơ"><i class="fa fa-print"></i> In</button>
								<button type="button" dataid="<?php echo $masv;?>" id="btn_xuat_excel" class="btn btn-info btn-excel"><i class="fas fa-file-csv"></i> Xuất File Excel</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php $html.="<h3 align='center'>CHI TIẾT HỌC PHÍ</h3>
	<table class='table' style='width:100%'>
	<tr>
	<td width='100'>Mã sinh viên:</td>
	<td>$masv</td>
	<td width='100'>Lớp:</td>
	<td>$malop</td>
	</tr>
	<tr>
	<td>Họ và tên:</td>
	<td>$fullname</td>
	<td>Ngày sinh:</td>
	<td>$ngaysinh</td>
	</tr>
	</table>";
	?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<?php
				$html.='
				<table class="table table-bordered">
				<thead>
				<tr>
				<th width="30">STT</th>
				<th width="30">Xóa</th>
				<th>Tên danh mục</th>
				<th class="text-right">Học phí</th>
				<th class="text-center">Học kỳ</th>
				</tr>
				</thead>
				<tbody>';
				?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<tr class="header">
								<th class="text-center">STT</th>
								<th>Đợt học phí</th>
								<th class="text-center">Học phí</th>
								<th class="text-center">Đã đóng</th>
								<th class="text-center">Phải thu</th>
								<th class="text-center">Tình trạng SV</th>
								<th class="text-center">Flag</th>
								<th class="text-center">Trạng thái</th>
								<th>Hạn đóng HP</th>
								<th>Ngành</th>
								<th>Mã lớp</th>
							</tr>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($res_order_detail) && count($res_order_detail)>0){
							foreach ($res_order_detail as $key => $row) {
								$stt = $key + 1;
								$id_order = $row['id_order'];
								$order_name = isset($arr_order[$id_order]) ? $arr_order[$id_order]['name'] : "";
								$name_nganh = isset($_NGANH[$row['ma_nganh']]) ? $_NGANH[$row['ma_nganh']] : "";
								$ma_lop = $row['ma_lop'];
								$masv = $row['masv'];
								$hodem = $row['hodem'];
								$ten = $row['ten'];
								$hotenSV = $hodem.' '.$ten;
								$hocky = $row['hocky'];
								$slot = $row['slot'];
								$status = $row['status'];
								$ghichu = $row['ghichu'];
								$flag_class = $row['flag']=='0' ? 'other' : 'label-primary';
								$tonghocphi = number_format($row['hocphi']);
								$dadong = $row['dadong']!=="" ? number_format($row['dadong']) : '0';
								$canthu = $row['conlai']!=="" ? number_format($row['conlai']) : '0';
								$sdate = isset($row['start_date']) && $row['start_date']!=="" ? date('d/m/Y',$row['start_date']):"";
								$edate = isset($row['end_date']) && $row['end_date']!=="" ? date('d/m/Y',$row['end_date']):"";

								switch($status){
									case 'no': $html_status="<strong>Thiếu</strong>"; break;
									case 'yes': $html_status="<strong class='cgreen'>Đủ</strong>"; break;
									default: $html_status="<strong>Thiếu</strong>"; break;
								}

								$tinhtrang_sv = isset($_ARR_STATUS_SV[$masv]) ? $_ARR_STATUS_SV[$masv] : 'S01';
								$txt_tinhtrang_sv = $STATUS_SV[$tinhtrang_sv];

								echo '<tr>
								<td align="center">'.$stt.'</td>
								<td>'.$order_name.'</td>
								<td align="center"><strong>'.$tonghocphi.'<strong></td>
								<td align="center"><strong>'.$dadong.'<strong></td>
								<td align="center"><strong class="cred">'.$canthu.'<strong></td>
								<td align="center" title="'.$txt_tinhtrang_sv.'">
								<a href="javascript:void(0)" class="label label-success" onclick="frm_status_sv(this)" data-masv="'.$masv.'" data-status-sv="'.$tinhtrang_sv.'">'.$tinhtrang_sv.'</a>
								<div class="txt_status">'.$txt_tinhtrang_sv.'</div>
								</td>';

								if($status=="no"){
									echo '<td align="center">
									<a href="javascript:void(0)" data-id-order-detail="'.$id_order.'" onclick="note_flag(this)" class="label '.$flag_class.'">Complaint</a>
									<div class="txt_ghichu">'.$ghichu.'</div>
									</td>';
								}else{
									echo '<td align="center"</td>';
								}

								echo '<td align="center">'.$html_status.'</td>
								<td><div class="start_date">'.$sdate.'</div><div class="end_date">'.$edate.'</div></td>
								<td>'.$name_nganh.'</td>
								<td>'.$ma_lop.'</td>
								</tr>';
							}
							echo '<tr style="background:#ccc;font-weight:bold;">
							<td></td>
							<td class="text-right" style="font-size:1.2em;">TỔNG</td>
							<td class="text-right" style="font-size:1.2em;">'.number_format($tong_hocphi).'</td>
							<td class="text-right" style="font-size:1.2em;">'.number_format($tong_dadong).'</td>
							<td class="text-right" style="font-size:1.2em;">'.number_format($tong_conlai).'</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							</tr>';

							$html.='
							<tr style="background:#ccc;font-weight:bold">
							<td></td>
							<td class="text-right">TỔNG</td>
							<td class="text-right"></td>
							<td></td>
							</tr>';
						} ?>
					</tbody>
				</table>
				<?php
				$html.='
				</tbody>
				</table>';
				?>
			</div>
		</div>
	</div>
	<div id="divToPrint" style="display:none;"><?php echo $html; ?></div>
</div>
<script>
	$("#dm").keypress(function(e){
		if(e.which==13) {
			if($(this).val()=="") {
				$(this).focus(); return;
			}
			$("#frmsearch").submit();
		}
	});

	$(".btn-print").click(function(){
		showLoading();
		var screenW =screen.width;
		var screenH =screen.height; //console.log(screenW+' / '+screenH);
		var divToPrint = document.getElementById('divToPrint');
		var popupWin = window.open('', '_blank','toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width='+screenW+',height='+screenH);
		popupWin.document.open();
		popupWin.document.write('<html><head><title><?php global $conf; echo $conf['title'];?></title>');
		popupWin.document.write('</head><body onload="window.print();">');
		popupWin.document.write(divToPrint.innerHTML);
		popupWin.document.write('</body></html>');
		popupWin.document.close();
		hideLoading();
	})

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
</script>