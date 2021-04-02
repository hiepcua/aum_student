<?php 
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma = addslashes(strip_tags(htmlentities($_GET['id'])));

$objhs = new CLS_HS;
$name = $objhs->getFullNameByInfo('ma',$ma);
$objts = new CLS_TUYENSINH;
$objts->getList(" AND id_hoso='$ma' ");
$id_khoa = $id_he = $id_nganh=''; $id_dky = 0;
$ptxt = $diadiem = '';
if($objts->Num_rows()>0) {
	$r=$objts->Fetch_Assoc(); 
	$id_khoa = $r['id_khoa'];
	$id_he 	= $r['id_he'];
	$id_nganh = $r['id_nganh'];
	$ptxt = $r['xettuyen'];
	$diadiem = $r['diadiemhoc'];
	$id_dky = $r['id'];
} ?>
<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul><li><a href="<?php echo ROOTHOST;?>student/profile/<?php echo $ma;?>">Hồ sơ</a></li>
						<li class="active"><a href="<?php echo ROOTHOST;?>student/nganh/<?php echo $ma;?>">Đăng ký ngành</a></li>
						<li><a href="<?php echo ROOTHOST;?>student/diem/<?php echo $ma;?>">Nhập điểm</a></li>
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
			<?php if($id_khoa!="" && $id_he!="" && $id_nganh!="") {?>
			<div class="form-group row"><div class="col-md-6 col-xs-12">
				<label class="label label-danger">Hồ sơ đã đăng ký ngành học!</label>
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
					<label class="col-md-4">Khóa</label>
					<div class="col-md-8">
						<select name="cbokhoa" id="cbokhoa" class="form-control" required>
						<option value=""></option>
						<?php 
						$objkhoa = new CLS_KHOA;
						$objkhoa->getList("");
						while($r=$objkhoa->Fetch_Assoc()) { ?>
						<option value="<?php echo $r['id'];?>" <?php if($id_khoa==$r['id']) echo "selected";?>>
						<?php echo $r['name'];?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-xs-12">
					<label class="col-md-4">Bậc đào tạo</label>
					<div class="col-md-8">
						<select name="cbobac" id="cbobac" class="form-control" required>
						<option value=""></option>
						<?php $objhe = new CLS_HE;
						$objhe->getList(); 
						while($r=$objhe->Fetch_Assoc()) { ?>
						<option value="<?php echo $r['id'];?>" <?php if($id_he==$r['id']) echo "selected";?>>
						<?php echo $r['name'];?></option>
						<?php } ?>
						</select>
					</div>
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-6 col-xs-12">
					<label class="col-md-4">Ngành</label>
					<div class="col-md-8">
						<select name="ma_nganh" id="ma_nganh" class="form-control" required>
						<option value=""></option>
						<?php $objng = new CLS_NGANH;
						$objng->getList(); 
						while($r=$objng->Fetch_Assoc()) { ?>
						<option value="<?php echo $r['id'];?>" <?php if($id_nganh==$r['id']) echo "selected";?>>
						<?php echo $r['id']." - ".$r['name'];?></option>
						<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label class="col-md-2">Phương thức XT</label>
					<div class="col-md-10">
						<?php foreach($GLOBALS['ARR_PTXT'] as $k=>$v) { ?>
						<input type="radio" name="tk_ptxt[]" value="<?php echo $k;?>" <?php if($k==$ptxt) echo "checked";?>> <?php echo $v;?>&nbsp;
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label class="col-md-2">Địa điểm học</label>
					<div class="col-md-10">
						<?php foreach($GLOBALS['ARR_DIADIEM'] as $k=>$v) { ?>
						<input type="radio" name="tk_diadiem[]" value="<?php echo $k;?>" <?php if($k==$diadiem) echo "checked";?>> <?php echo $v;?>&nbsp;
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".btn-save").click(function(){	
		if(checkinput()==true) {
			var id_dky = $("#id_dky").val();
			var id_hoso = $("#id_hoso").val();
			var bac = $("#cbobac").val();
			var khoa = $("#cbokhoa").val();
			var ma_nganh = $("#ma_nganh").val();
			var _ptxt = $("input[name='tk_ptxt[]']:checked").val();
			var _diadiem = $("input[name='tk_diadiem[]']:checked").val();
			
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_dangky.php";
			showLoading();
			$.post(url,{'id_dky':id_dky,'id_hoso':id_hoso,'ma_nganh':ma_nganh,'bac':bac,'khoa':khoa,
			'ptxt':_ptxt,'diadiem':_diadiem},function(req){
				console.log(req);
				hideLoading();
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Hồ sơ đã đăng ký ngành học thành công!");
					window.location.reload();
				}
			})
		} return false;
	})
})
function checkinput(){
	var ma_nganh = $("#ma_nganh").val();
	var name = $("#txtname").val();
	var bac = $("#cbobac").val();
	var khoa = $("#cbokhoa").val();
	if(ma_nganh=="") {
		$("#ma_nganh").focus();
		$("#ma_nganh").addClass('novalid');
		return false;
	}else $("#ma_nganh").removeClass('novalid');
	if(name=="") {
		$("#txtname").focus();
		$("#txtname").addClass('novalid');
		return false;
	}else $("#txtname").removeClass('novalid');
	if(bac=="") {
		$("#cbobac").focus();
		$("#cbobac").addClass('novalid');
		return false;
	}else $("#cbobac").removeClass('novalid');
	if(khoa=="") {
		$("#cbokhoa").focus();
		$("#cbokhoa").addClass('novalid');
		return false;
	}else $("#cbokhoa").removeClass('novalid');
	return true;
}
</script>