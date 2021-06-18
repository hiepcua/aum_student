<?php
defined('ISHOME') or die("You can't access this page!");
$id_khoa=$id_city=$id_partner=$strWhere='';
$THIS_HE 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$THIS_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$arr_data = array(); // Mảng chứa tất cả thông tin cần thiết để in ra bảng

/* Get all hồ sơ */
$HOCSINH = array();
$res_hosoSV = SysGetList('tbl_hocsinh', array());
if(count($res_hosoSV)>0){
	foreach ($res_hosoSV as $key => $value) {
		$HOCSINH[$value['ma']] = $value;
	}
}

// ------------------------------------------------
$id_khoa = isset($_GET['khoa']) ? antiData($_GET['khoa']) : '';
if($THIS_NGANH!=='') $strWhere.=" AND id_nganh='".$THIS_NGANH."'";
if($THIS_HE!=='') $strWhere.=" AND id_he='".$THIS_HE."'";
if($id_khoa!=='') $strWhere.=" AND id_khoa='".$id_khoa."'";

/* Get all đăng ký tuyển sinh */
$DKTS = array();
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
	$id_nganh = $value['id_nganh'];
	$id_khoa = $value['id_khoa'];
	$id_he = $value['id_he'];

	$hodem = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['ho_dem'] : "";
	$tensv = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['name'] : "";
	$sodienthoai = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['dienthoai'] : "";
	$ngaysinh = isset($HOCSINH[$ma_hoso]) && $HOCSINH[$ma_hoso]['ngaysinh']>0 ? date('d-m-Y', $HOCSINH[$ma_hoso]['ngaysinh']) : '';
	$gioitinh = isset($HOCSINH[$ma_hoso]) && $HOCSINH[$ma_hoso]['gioitinh']=="nam" ? "Nam" : 'Nữ';
	$hotensv = $hodem.' '.$tensv;
	$name_nganh = isset($NGANH[$id_nganh]) ? $NGANH[$id_nganh]['name'] : "";
	$name_khoa = isset($KHOA[$id_khoa]) ? $KHOA[$id_khoa]['name'] : "";
	$name_he = isset($HE[$id_he]) ? $HE[$id_he]['name'] : "";

	$arr_data[$key]['hotensv'] = $hotensv;
	$arr_data[$key]['sodienthoai'] = $sodienthoai;
	$arr_data[$key]['ngaysinh'] = $ngaysinh;
	$arr_data[$key]['gioitinh'] = $gioitinh;
	$arr_data[$key]['name_nganh'] = $name_nganh;
	$arr_data[$key]['name_khoa'] = $name_khoa;
	$arr_data[$key]['name_he'] = $name_he;
}

$total_rows = count($arr_data);
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$end = $start + MAX_ROWS;
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Thống kê Hồ sơ tổng hợp</div>
			</div>
			
			<ul class="box-function pull-right">
				<li>
					<button type="button" class="btn btn-warning btn-print" title="In hồ sơ"><i class="fa fa-print"></i> In</button>
				</li>
				<li>
					<button class="btn btn-default" title="Thoát"><i class="fa fa-file-excel"></i> Xuất File Excel</button>
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
							<select name="khoa" id="cbokhoa" class="form-control" >
								<option value="">-- Khóa --</option>
								<?php 
								foreach ($KHOA as $key => $value) {
									if($value['type']==1){
										$selected = $id_khoa==$value['id'] ? "selected" : "";
										echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['name'].'</option>';
									}
								}?>
							</select>
						</div>

						<div class="col-md-2 col-xs-6">
							<button type="submit" id="tk_btnsearch" class="btn btn-primary form-control"><i class="fa fa-search"></i> Lọc</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<table class="list table table-striped table-bordered">
		<thead>
			<tr class="header">
				<th class="text-center">STT</th>
				<th>Họ tên</th>
				<th class="text-center">Giới tính</th>
				<th class="text-center">Ngày sinh</th>
				<th>Ngành</th>
				<th>Mã SV</th>
				<th>Lớp</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(is_array($arr_data) && count($arr_data)>0){
				$stt = $start;
				$i=0;
				foreach ($arr_data as $key => $value) {
					$stt = $stt+1;
					$masv = $value['masv']; 
					$id_hoso = $value['id_hoso']; 
					
					if($i >= $start && $i <= $end){
						echo '<tr data-masv="'.$masv.'" data-hoso="'.$id_hoso.'">
						<td align="center">'.$stt.'</td>

						<td>'.$value['hotensv'].'</td>

						<td align="center">'.$value['gioitinh'].'</td>
						<td align="center">'.$value['ngaysinh'].'</td>
						<td>'.$value['name_nganh'].'</td>
						<td>'.$value['masv'].'</td>
						<td>'.$value['malop'].'</td>
						</tr>';
						$i=$i+1;
					}
				}
			}?>
		</tbody>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr><td align="center">
			<?php paging($total_rows, MAX_ROWS, $cur_page); ?>
		</td></tr>
	</table>
</div>