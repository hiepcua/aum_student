<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$_masv = addslashes(strip_tags(htmlentities($_GET['id'])));

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

/* LỊCH SỬ ĐÓNG HỌC PHÍ */
$url='http://uid.aumsys.net/api/student/order_pay';
$json = array();
$json['key'] = PIT_API_KEY;
$json['masv'] = $_masv;

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$row_order_history = $res_data['data'];

/* --------------------------------------------- */
$objhs = new CLS_HS;
$objhs->getList(" AND ma IN (select id_hoso FROM tbl_dangky_tuyensinh WHERE masv='$_masv')");
$row_dkts = $objhs->Fetch_Assoc();
$masv = $row_dkts['ma'];
$fullname = $row_dkts['ho_dem'].' '.$row_dkts['name'];
$gender = $row_dkts['gioitinh']=='nam' ? 'Nam' : 'Nữ';
$ngaysinh = date("d-m-Y", $row_dkts['ngaysinh']);
$hokhau = $row_dkts['hktt'];

$objts = new CLS_TUYENSINH;
$objts->getList(" AND masv='$_masv' ");
$r_ts = $objts->Fetch_Assoc();
$malop = $r_ts['malop'];
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Chi tiết Học phí đã nộp</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>student/qlhocphi" class="btn btn-default btn-close" title="Thoát"><i class="fa fa-reply"></i> Thoát</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="panel-body">
			<h4>THÔNG TIN SINH VIÊN</h4>
			<div class="row form-group">
				<div class="col-md-3 col-xs-4 text">Mã sinh viên</div>
				<div class="col-md-9 col-xs-8"><?php echo $masv;?></div>
			</div><div class="row form-group">
				<div class="col-md-3 col-xs-4 text">Lớp</div>
				<div class="col-md-9 col-xs-8"><?php echo $malop;?></div>
			</div><div class="row form-group">
				<div class="col-md-3 col-xs-4 text">Họ và tên</div>
				<div class="col-md-9 col-xs-8"><?php echo $fullname;?></div>
			</div><div class="row form-group">
				<div class="col-md-3 col-xs-4 text">Ngày sinh</div>
				<div class="col-md-9 col-xs-8"><?php echo $ngaysinh;?></div>
			</div><div class="row form-group">	
				<div class="col-md-3 col-xs-4 text">Giới tính</div>
				<div class="col-md-9 col-xs-8"><?php echo $gender;?></div>
			</div><div class="row form-group">	
				<div class="col-md-3 col-xs-4 text">Hộ khẩu</div>
				<div class="col-md-9 col-xs-8"><?php echo $hokhau;?></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width='30'>STT</th>
						<th>Ngày đóng</th>
						<th>Đợt đóng</th>
						<th class='text-center'>Số tiền</th>
						<th>Nội dung</th>
						<th>Phương thức thanh toán</th>
						<th>Tạo bởi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($row_order_history as $key => $value) {
						$stt = $key + 1;
						$ngaydong = $value['date_pay']!=="" ? date("H:i d/m/Y", $value['date_pay']) : '';
						$id_order = $value['id_order'];
						$order_name = isset($arr_order[$id_order]) ? $arr_order[$id_order]['name'] : "";
						$sotien = $value['sotien']!=="" ? number_format($value['sotien']) : '';
						$noidung = $value['noidung']!=="" ? $value['noidung'] : '';
						$author = $value['author']!=="" ? $value['author'] : '';
						$pay_info = $value['pay_info'];
						echo '<tr>
						<td>'.$stt.'</td>
						<td>'.$ngaydong.'</td>
						<td>'.$order_name.'</td>
						<td align="center"><strong>'.$sotien.'</strong></td>
						<td>'.$noidung.'</td>
						<td>'.$pay_info.'</td>
						<td>'.$author.'</td>
						</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>