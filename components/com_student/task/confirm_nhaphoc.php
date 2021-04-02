<?php
defined('ISHOME') or die("You can't access this page!");
$obj = new CLS_MYSQL;
if(!isset($_GET['ma'])) die('Chưa có thông tin mã hồ sơ');
$ma = addslashes(strip_tags($_GET['ma']));
$objhs = new CLS_HS;
$objhs->getList(" AND ma='$ma'");
$r=$objhs->Fetch_Assoc();
$fullname = $r['ho_dem'].' '.$r['name'];
$gender = $GLOBALS['ARR_GENDER'][$r['gioitinh']];
$ngaysinh = date("Y-m-d",$r['ngaysinh']);
$noisinh = $r['noisinh'];

$objts = new CLS_TUYENSINH;
$objts->getList(" AND id_hoso='$ma' ");
$r_ts = $objts->Fetch_Assoc();
$id_khoa = $r_ts['id_khoa'];
$id_he = $r_ts['id_he'];
$id_nganh = $r_ts['id_nganh'];
$masv = $r_ts['masv'];
$malop = $r_ts['malop'];
$ptxt = $r_ts['xettuyen'];
$diadiemhoc = $r_ts['diadiemhoc'];
$cdate_ts = date("d/m/y",$r_ts['cdate']);

$dm = isset($_GET['dm'])?addslashes(htmlentities(strip_tags($_GET['dm']))):"";
$hocky = isset($_GET['hocky'])?(int)$_GET['hocky']:"";
$status = isset($_GET['status'])?(int)$_GET['status']:"";

require_once('global/libs/gffunc_edu.php');
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Xác nhận hồ sơ nhập học</div>
			</div>
			<ul class="box-function pull-right">
				<li><button type="button" class="btn btn-success btn-save"  title="Xác nhận lưu hồ sơ"  onclick="NhapHoc('<?php echo $ma;?>',1);">
					<i class="fa fa-save"></i> Xác nhận lưu</button></li>
				<li><a href="<?php echo ROOTHOST;?>student/hstrungtuyen" class="btn btn-default btn-close" title="Thoát">
					<i class="fa fa-reply"></i> Thoát</a></li>
			</ul>
		</div>
	</div>
	<div class="col-md-7 col-xs-12"><div style="margin-left:-15px;">
		<div class="panel panel-warning"><div class="panel-body">
			<h4>THÔNG TIN HỒ SƠ</h4>
			<div class="row form-group">
				<div class="col-md-3 col-xs-4 text">Mã hồ sơ</div>
				<div class="col-md-9 col-xs-8"><?php echo $ma;?></div>
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
				<div class="col-md-3 col-xs-4 text">Nơi sinh</div>
				<div class="col-md-9 col-xs-8"><?php echo $noisinh;?></div>
			</div>
		</div></div>
	</div></div>
	<div class="col-md-5 col-xs-12 pull-right panel panel-warning">
		<div class="panel-body">
			<h4>THÔNG TIN ĐĂNG KÝ NGÀNH</h4>
			<div class="row form-group">
				<div class="col-md-4 text">Ngày đăng ký</div>
				<div class="col-md-8"><?php echo $cdate_ts;?></div>
			</div>
			<div class="row form-group">
				<div class="col-md-4 text">Khóa</div>
				<div class="col-md-8">
					<?php 
					$objkhoa = new CLS_KHOA; $objkhoa->getList(" ");
					while($r_khoa=$objkhoa->Fetch_Assoc()) { 
						if($id_khoa==$r_khoa['id']) { echo $r_khoa['name'];break;}
					} ?>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4 text">Bậc đào tạo</div>
				<div class="col-md-8">
					<?php $objhe = new CLS_HE; $objhe->getList(); 
					while($r_he=$objhe->Fetch_Assoc()) { 
						if($id_he==$r_he['id']) { echo $r_he['name']; break;}
					} ?>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4 text">Ngành</div>
				<div class="col-md-8">
					<?php $objng = new CLS_NGANH; $objng->getList(); 
					while($r_nganh=$objng->Fetch_Assoc()) { 
						if($id_nganh==$r_nganh['id']) { echo $r_nganh['id']." - ".$r_nganh['name'];break;  }
					} ?>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4 text">Địa điểm học</div>
				<div class="col-md-8"><?php echo $diadiemhoc.' ';?></div>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-xs-12 panel panel-warning"><div class="row panel-body">
		<?php // chương trình học 
		$arr_hocphi=getHocphikhac($id_he,$id_nganh);
		?>
		<h4>HỌC PHÍ KHÁC</h4>
		<table class="table table-bordered">
		<thead><tr>
			<th width='30'>STT</th>
			<th>Tên danh mục</th>
			<th class='text-right'>Học phí</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt=0; $total=0; foreach($arr_hocphi as $item) { 
		$stt++; $total+=$item['hocphi']; ?>
		<tr><td align="center"><?php echo $stt;?></td>
			<td><?php echo $item['name'];?></td>
			<td align="right"><?php echo number_format($item['hocphi']);?></td>
		</tr>
		<?php } ?>
		<tr style="background:#ccc;font-weight:bold"><td></td>
		<td align="right">Tổng</td><td align="right"><?php echo number_format($total);?></td></tr>
		</tbody>
		</table>
	</div></div>
</div>
<script>
function NhapHoc(ma,status) {
	if(confirm('Bạn chắc chắn nhập học?')){
		showLoading(); $('.btn-save').hide();
		var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_nhaphoc.php";
		$.post(url,{'ma':ma,'status':status},function(req){
			hideLoading();
			if(req=="success") {
				window.location="<?php echo ROOTHOST;?>student/hocphi/"+ma;
			}else showMess(req,"error");
			
		})
	}
}
</script>