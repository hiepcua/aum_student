<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$obj = new CLS_MYSQL;
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.city,c.name as city_name, b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		INNER JOIN tbl_city AS c ON b.city=c.id
		WHERE a.xettuyen=0 AND (sbd='' OR sbd is null) ";
		
$ma=isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
$ten=isset($_POST['ten'])?addslashes(strip_tags($_POST['ten'])):'';
$cmt=isset($_POST['cmt'])?addslashes(strip_tags($_POST['cmt'])):'';
$ns=isset($_POST['ns'])?addslashes(strip_tags($_POST['ns'])):'';
$dc=isset($_POST['dc'])?addslashes(strip_tags($_POST['dc'])):'';
$nganh=isset($_POST['nganh']) && $_POST['nganh']!=0  ? addslashes(strip_tags($_POST['nganh'])):'';
$khoa=isset($_POST['khoa']) && $_POST['khoa']!=0 ? addslashes(strip_tags($_POST['khoa'])):'';
$he=isset($_POST['he']) && $_POST['he']!=0 ? addslashes(strip_tags($_POST['he'])):'';

if($ma!='') $sql.=" AND b.ma LIKE '%$ma%'";
if($ten!='') $sql.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($cmt!='') $sql.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $sql.=" AND b.city LIKE '%$dc%'";
if($nganh!='') $sql.=" AND a.id_nganh='$nganh'";
if($khoa!='') $sql.=" AND a.id_khoa='$khoa'";
if($he!='') $sql.=" AND a.id_he='$he'";

$obj->Query($sql); //echo $sql;
$result = $obj->Fetch_Assoc();
$total = $obj->Num_rows(); 
$sophong=1; $sots=20; $ketqua="";
if($total>=20) {
	$sophong = ceil($total/20); //$sots=ceil($total/$sophong);
	$ketqua = "Kết quả phân phòng: ".($sophong-1)." phòng ".$sots." thí sinh, 1 phòng ".($total-($sophong-1)*$sots)." thí sinh.";
} ?>
<div class="form-group">
	<div class="col-md-12"><label>QUY TẮC ĐÁNH SỐ BÁO DANH (TIỀN TỐ + BẮT ĐẦU TỪ SỐ)</label></div>
</div>
<div class="form-group">
	<div class="col-md-3">Tiền tố (*)</div>
	<div class="col-md-3">
		<input type="text" name="sbd_tiento" id="sbd_tiento" value="SBD<?php echo date("y");?>" required class="form-control" />
	</div>
</div>
<div class="form-group">
	<div class="col-md-3">Bắt đầu từ số (*)</div>
	<div class="col-md-3">
		<input type="text" name="sbd_batdau" id="sbd_batdau" value="001" required class="form-control" />
	</div>
</div>
<div class="form-group">
	<div class="col-md-3">Xem trước</div>
	<div class="col-md-3"><b class="sbd_view">SBD<?php echo date("y");?>001</b></div>
</div>
<div class="form-group">
	<div class="col-md-12"><label>QUY TẮC PHÂN PHÒNG THI</label></div>
</div>
<div class="form-group">
	<div class="col-md-3">Tổng hồ sơ thi</div>
	<div class="col-md-3"><b><?php echo $total;?></b>
		<input type="hidden" name="tong_hoso" id="tong_hoso" value="<?php echo $total;?>"/>
	</div>
</div>
<div class="form-group">
	<div class="col-md-6">Chia đều theo số lượng phòng</div>
	<div class="col-md-3">Số phòng</div>
	<div class="col-md-3">
		<input type="number" name="so_phong" id="so_phong" value="<?php echo $sophong;?>" min="1" class="form-control"/>
	</div>
</div>
<div class="form-group">
	<div class="col-md-6">Chia theo số lượng thí sinh</div>
	<div class="col-md-3">Số thí sinh/phòng</div>
	<div class="col-md-3">
		<input type="number" name="so_thisinh" id="so_thisinh" value="<?php echo $sots;?>" min="1" class="form-control"/>
	</div>
</div>
<div class="form-group"><div class="col-md-12">
	<label class="label label-danger msg_check"><?php echo $ketqua;?></label>
</div></div>
<div class="form-group"><div class="col-md-12 text-right">
	<button type="button" class="btn btn-success btn-phanphong"  title="Phân lớp">
	<i class="fa fa-save"></i> Đồng ý</button>
</div></div>
<div class="clearfix"></div>
<script>
$(document).ready(function(){
	$("#sbd_tiento").change(function(){
		changeView();
	})
	$("#sbd_batdau").change(function(){
		changeView();
	})
	$("#so_phong").change(function(){
		changeKetqua(1);
	})
	$("#so_thisinh").change(function(){
		changeKetqua(2);
	})
	
	$(".btn-phanphong").click(function(){	
		if(checkinput()==true) {
			var tiento = $("#sbd_tiento").val();
			var start = $("#sbd_batdau").val();
			var total = parseInt($("#tong_hoso").val());
			var sophong = parseInt($("#so_phong").val());
			var sots = parseInt($("#so_thisinh").val());
			if(total<=0) {
				showMess("Chưa có hồ sơ thi.","error");
			}else if(total>=1) {
				var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_danh_sbd.php";
				showLoading();
				$.post(url,{'khoa':'<?php echo $khoa;?>','he':'<?php echo $he;?>','nganh':'<?php echo $nganh;?>','total':total,'tiento':tiento,'start':start,'sophong':sophong,'sots':sots},function(req){
					// console.log(req);
					hideLoading();
					if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
					else if(req=="success"){
						showMess("Đã đánh số báo danh & phân phòng thi thành công!");
						setTimeout(function(){ 
							window.location.reload();
						}, 2000);
					}
				})
			}
		} return false;
	})
})
function changeView(){
	var tiento = $("#sbd_tiento").val();
	var start = $("#sbd_batdau").val();
	$(".sbd_view").html(tiento+start);
}
function changeKetqua(status) {
	var total = parseInt($("#tong_hoso").val());
	var sophong = parseInt($("#so_phong").val());
	var sots = parseInt($("#so_thisinh").val());
	if(status==1) {// chia deu theo so phong
		sots = Math.ceil(total/sophong);
		$("#so_thisinh").val(sots);
	}else{ // so thi sinh
		sophong = Math.ceil(total/sots);
		$("#so_phong").val(sophong);
	}
	$(".msg_check").html("Kết quả phân phòng: "+(sophong-1)+" phòng "+sots+" thí sinh, 1 phòng "+(total-(sophong-1)*sots)+" thí sinh.");
}
function checkinput(){
	var tiento = $("#sbd_tiento").val();
	var start = $("#sbd_batdau").val();
	var sophong = parseInt($("#so_phong").val());
	var sots = parseInt($("#so_thisinh").val());
	if(tiento=="") {
		$("#sbd_tiento").focus();
		$("#sbd_tiento").addClass('novalid');
		return false;
	}else $("#sbd_tiento").removeClass('novalid');
	if(start=="") {
		$("#sbd_batdau").focus();
		$("#sbd_batdau").addClass('novalid');
		return false;
	}else $("#sbd_batdau").removeClass('novalid');
	if(sophong=="" || sophong<=0) {
		$("#so_phong").focus();
		$("#so_phong").addClass('novalid');
		return false;
	}else $("#so_phong").removeClass('novalid');
	if(sots=="" || sots<=0) {
		$("#so_thisinh").focus();
		$("#so_thisinh").addClass('novalid');
		return false;
	}else $("#so_thisinh").removeClass('novalid');
	return true;
}
</script>