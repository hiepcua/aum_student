<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.hocsinh.php');
require_once('../../libs/cls.tuyensinh.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(!isset($_POST['ma'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma = addslashes(strip_tags(htmlentities($_POST['ma'])));

$objhs = new CLS_HS;
$name = $objhs->getFullNameByInfo('ma',$ma);
$objts = new CLS_TUYENSINH;
$objts->getList(" AND id_hoso='$ma' ");
$mon1 = $mon2 = $mon3 = $sbd = '';$id_dky=$tongdiem=0;
$id_khoa=$id_he=$id_nganh="";
if($objts->Num_rows()>0) {
	$r=$objts->Fetch_Assoc(); 
	$id_khoa = $r['id_khoa'];
	$id_he = $r['id_he'];
	$id_nganh = $r['id_nganh'];
	$id_dky = $r['id'];
	$sbd = $r['sbd'];
	$mon1 = $r['mon1'];
	$mon2 = $r['mon2'];
	$mon3 = $r['mon3'];
	$tongdiem=(float)($mon1+$mon2+$mon3);
} 
if($id_khoa=="" || $id_he=="" || $id_nganh=="") {?>
<div class="form-group row"><div class="col-md-6 col-xs-12">
	<label class="label label-danger">Hồ sơ chưa đăng ký ngành học!</label>
</div></div>
<?php } else {?>
<?php if($mon1!="" && $mon2!="" && $mon3!="") {?>
<div class="form-group row"><div class="col-md-6 col-xs-12">
	<label class="label label-danger">Đã nhập điểm!</label>
</div></div>
<?php } ?>
<div class="form-group row">
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Mã hồ sơ</label>
		<div class="col-md-8">
			<input type="hidden" id="id_dky" value="<?php echo $id_dky;?>" readonly class="form-control" />
			<input type="text" id="id_hoso" value="<?php echo $ma;?>" readonly class="form-control" />
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Họ tên</label>
		<div class="col-md-8"><input type="text" id="fullname" value="<?php echo $name;?>" readonly class="form-control" /></div>
	</div>
</div>
<div class="form-group row">
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">SBD</label>
		<div class="col-md-8"><input type="text" id="sbd" value="<?php echo $sbd;?>" class="form-control" /></div>
	</div>
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Điểm môn 1</label>
		<div class="col-md-8">
			<input type="number" name="mon1" id="mon1" class="form-control" value="<?php echo $mon1;?>" min="0"  max="10" required/>
		</div>
	</div>
</div>	
<div class="form-group row">
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Điểm môn 2</label>
		<div class="col-md-8">
			<input type="number" name="mon2" id="mon2" class="form-control" value="<?php echo $mon2;?>" min="0"  max="10" required/>
		</div>
	</div>
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Điểm môn 3</label>
		<div class="col-md-8">
			<input type="number" name="mon3" id="mon3" class="form-control" value="<?php echo $mon3;?>" min="0"  max="10" required/>
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Tổng Điểm</label>
		<div class="col-md-8">
			<input type="number" name="tongdiem" id="tongdiem" class="form-control" value="<?php echo $tongdiem;?>" min="0" required/>
		</div>
	</div>
</div>
<div class="form-group row"><div class="col-md-12 text-right">
	<button type="button" class="btn btn-success btn-save"  title="Lưu hồ sơ">
	<i class="fa fa-save"></i> Lưu</button>
</div></div>
<div class="clearfix"></div>
<?php } ?>
<script>
$(document).ready(function(){
	$("#mon1").change(function(){	
		tongdiem();
	})
	$("#mon2").change(function(){	
		tongdiem();
	})
	$("#mon3").change(function(){	
		tongdiem();
	})
	$(".btn-save").click(function(){	
		if(checkinput()==true) {
			var id_dky = $("#id_dky").val();
			var id_hoso = $("#id_hoso").val();
			var sbd = $("#sbd").val();
			var mon1 = $("#mon1").val();
			var mon2 = $("#mon2").val();
			var mon3 = $("#mon3").val();
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_nhapdiem.php";
			showLoading();
			$.post(url,{'id_dky':id_dky,'id_hoso':id_hoso,'sbd':sbd,'mon1':mon1,'mon2':mon2,'mon3':mon3},function(req){
				console.log(req);
				hideLoading();
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Hồ sơ đã nhập điểm thành công!");
					window.location.reload();
				}
			})
		} return false;
	})
})
function tongdiem() {
	var mon1 = parseFloat($("#mon1").val());
	var mon2 = parseFloat($("#mon2").val());
	var mon3 = parseFloat($("#mon3").val());
	tong = mon1+mon2+mon3;
	$("#tongdiem").val(tong);
}
function checkinput(){
	var sbd = $("#sbd").val();
	var mon1 = $("#mon1").val();
	var mon2 = $("#mon2").val();
	var mon3 = $("#mon3").val();
	if(sbd=="") {
		$("#sbd").focus();
		$("#sbd").addClass('novalid');
		return false;
	}else $("#sbd").removeClass('novalid');
	if(mon1=="") {
		$("#mon1").focus();
		$("#mon1").addClass('novalid');
		return false;
	}else $("#mon1").removeClass('novalid');
	if(mon2=="") {
		$("#mon2").focus();
		$("#mon2").addClass('novalid');
		return false;
	}else $("#mon2").removeClass('novalid');
	if(mon3=="") {
		$("#mon3").focus();
		$("#mon3").addClass('novalid');
		return false;
	}else $("#mon3").removeClass('novalid');
	return true;
}
</script>