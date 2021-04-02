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
				<div class="page-title">Hủy hồ sơ nhập học</div>
			</div>
			<ul class="box-function pull-right">
				<li><button type="button" class="btn btn-success btn-save"  title="Xác nhận hủy hồ sơ"  onclick="HuyNhapHoc('<?php echo $ma;?>');">
					<i class="fa fa-save"></i> Xác nhận hủy</button></li>
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
	<div class="col-md-12 col-xs-12 panel panel-warning"><div class="panel-body">
		<div class="col-md-2 text"><h4>Lý do hủy</h4></div>
		<div class="col-md-8"><textarea name="txtlydo" id="txtlydo" rows="2" class="form-control"></textarea></div>
	</div></div>
</div>
<script>
function HuyNhapHoc(ma) {
	var lydo = $("#txtlydo").val();
	if(lydo=="") {
		alert("Vui lòng nhập lý do hủy hồ sơ nhập");
		$("#txtlydo").focus();
	}else {
		if(confirm('Bạn chắc chắn hủy thông tin nhập học?')){
			$('.btn-save').hide(); showLoading(); 
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_nhaphoc.php";
			$.post(url,{'ma':ma,'status':0,'lydo':lydo},function(req){
				hideLoading(); console.log(req);
				if(req=="success") {
					window.location="<?php echo ROOTHOST;?>student/hstrungtuyen";
				}else showMess(req,"error");
			})
		}
	}
}
</script>