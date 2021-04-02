<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$masv = addslashes(strip_tags(htmlentities($_GET['id']))); // id_hoso
$obj=new CLS_MYSQL;
$objhs = new CLS_HS;
$objhs->getList(" AND ma IN (select id_hoso FROM tbl_dangky_tuyensinh WHERE masv='$masv')");
$r=$objhs->Fetch_Assoc();
$fullname = $r['ho_dem'].' '.$r['name'];
$gender = $GLOBALS['ARR_GENDER'][$r['gioitinh']];
$ngaysinh = date("Y-m-d",$r['ngaysinh']);
$hokhau = $r['hktt'];
$trangthai = $GLOBALS['TRANGTHAI_HS'][$r['isactive']];
$trangthai_label = $GLOBALS['TRANGTHAI_LABEL'][$r['isactive']];

$objts = new CLS_TUYENSINH;
$objts->getList(" AND masv='$masv' ");
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
	<div class="panel panel-warning"><div class="panel-body">
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
	</div></div>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<table class="table table-bordered">
				<thead><tr>
					<th width='30'>STT</th>
					<th>Ngày đóng</th>
					<th class='text-center'>Số tiền</th>
					<th>Nội dung</th>
					<th class='text-center'>Tạo bởi</th>
				</tr></thead>
				<tbody>
					<?php 
					$stt = 0; 
					$sql = "SELECT * FROM tbl_hocphi_pay WHERE masv='$masv' ORDER BY date_pay DESC";
					$obj->Query($sql);
					while($r = $obj->Fetch_Assoc()){ 
						$stt++;
						echo '<tr>';
						echo '<td align="center">'.$stt.'</td>';
						echo '<td>'.date("d/m/y H:i",$r['date_pay']).'</td>';
						echo '<td align="center" class="red">'.number_format($r['sotien']).'</td>';
						echo '<td>'.$r['noidung'].'</td>';
						echo '<td align="center">'.$r['author'].'</td>';
						echo '</tr>';
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>