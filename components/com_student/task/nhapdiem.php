<?php 
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma = addslashes(strip_tags(htmlentities($_GET['id'])));

$objhs = new CLS_HS;
$name = $objhs->getFullNameByInfo('ma',$ma);
$objts = new CLS_TUYENSINH;
$objts->getList(" AND id_hoso='$ma' ");
$mon1 = $mon2 = $mon3 = '';$id_dky=$tongdiem=0;
if($objts->Num_rows()>0) {
	$r=$objts->Fetch_Assoc(); 
	$id_dky = $r['id'];
	$mon1 = $r['mon1'];
	$mon2 = $r['mon2'];
	$mon3 = $r['mon3'];
	$tongdiem=(float)($mon1+$mon2+$mon3);
} ?>
<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul><li><a href="<?php echo ROOTHOST;?>student/profile/<?php echo $ma;?>">Hồ sơ</a></li>
						<li><a href="<?php echo ROOTHOST;?>student/nganh/<?php echo $ma;?>">Đăng ký ngành</a></li>
						<li class="active"><a href="<?php echo ROOTHOST;?>student/diem/<?php echo $ma;?>">Nhập điểm</a></li>
					</ul>
				</div>
			</div>
			<ul class="box-function pull-right">
				<li><button type="button" class="btn btn-success btn-save"  title="Lưu hồ sơ">
					<i class="fa fa-save"></i> Lưu</button></li>
				<li><a href="<?php echo ROOTHOST;?>student/tuyensinh" class="btn btn-default btn-close" title="Thoát">
					<i class="fa fa-reply"></i> Thoát</a></li>
			</ul>
		</div>
	</div>
	<div class="card">
		<div class="card-body"><div class="card-block"><div class="media">
			<?php if($mon1!="" && $mon2!="" && $mon3!="") {?>
			<div class="form-group row"><div class="col-md-6 col-xs-12">
				<label class="label label-danger">Đã nhập điểm!</label>
			</div></div>
			<?php } ?>
			<div class="form-group row">
				<div class="col-md-6 col-xs-12">
					<label class="col-md-4">ID</label>
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
			</div>
			<div class="form-group row">
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
			<div class="clearfix"></div>
		</div>
	</div>
</div>
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
			var mon1 = $("#mon1").val();
			var mon2 = $("#mon2").val();
			var mon3 = $("#mon3").val();
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_nhapdiem.php";
			showLoading();
			$.post(url,{'id_dky':id_dky,'id_hoso':id_hoso,'mon1':mon1,'mon2':mon2,'mon3':mon3},function(req){
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
	var mon1 = $("#mon1").val();
	var mon2 = $("#mon2").val();
	var mon3 = $("#mon3").val();
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