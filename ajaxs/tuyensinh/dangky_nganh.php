<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.hocsinh.php');
require_once('../../libs/cls.he.php');
require_once('../../libs/cls.khoa.php');
require_once('../../libs/cls.nganh.php');
require_once('../../libs/cls.tuyensinh.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$id_dkts = isset($_POST['id_dkts']) ? htmlentities(strip_tags($_POST['id_dkts'])) : '';
$id_hoso = isset($_POST['id_hoso']) ? htmlentities(strip_tags($_POST['id_hoso'])) : '';

// Get ho_dem and ten of hocsinh
$name='';
$res_hocsinh = SysGetList('tbl_hocsinh', array(), 'AND ma='.$id_hoso);
if(count($res_hocsinh)>0){
	$res_hocsinh = $res_hocsinh[0];
	$name = $res_hocsinh['ho_dem'].' '.$res_hocsinh['name'];
}

// Get ngành đã đăng ký
$arr_nganh_registed = array();
$res_nganh_registed = SysGetList('tbl_dangky_tuyensinh', array(), 'AND id_hoso="'.$id_hoso.'"');
if(count($res_nganh_registed)>0){
	foreach ($res_nganh_registed as $key => $value) {
		$arr_nganh_registed[] = $value['id_nganh'];
	}
}
?>
<div class="form-group row">
	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">ID Hồ sơ</label>
		<div class="col-md-8">
			<input type="text" id="id_hoso" value="<?php echo $id_hoso;?>" readonly class="form-control" />
			<input type="hidden" id="id_dkts" value="<?php echo $id_dkts;?>" class="form-control" />
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
				<?php 
				$res_khoa = SysGetList('tbl_khoa', array(), '');
				if(count($res_khoa)>0){
					foreach ($res_khoa as $key => $value) {
						echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
					}
				}?>
			</select>
		</div>
	</div>

	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Bậc đào tạo</label>
		<div class="col-md-8">
			<select name="cbobac" id="cbobac" class="form-control" required>
				<?php 
				$res_he = SysGetList('tbl_he', array(), '');
				if(count($res_he)>0){
					foreach ($res_he as $key => $value) {
						echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
					}
				}?>
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
				<?php
				$res_nganh = SysGetList('tbl_nganh', array(), ''); 
				if(count($res_nganh)>0){
					foreach ($res_nganh as $key => $value) {
						if(in_array($value['id'], $arr_nganh_registed)){
							echo '<option value="'.$value['id'].'" disabled="true" class="disabled">'.$value['name'].'</option>';
						}else{
							echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
						}
					}
				}?>
			</select>
		</div>
	</div>

	<div class="col-md-6 col-xs-12">
		<label class="col-md-4">Địa điểm học</label>
		<div class="col-md-8">
			<input type="text" name="tk_diadiem" id="tk_diadiem" value="" class="form-control">
		</div>
	</div>
</div>

<div class="row form-group text-right"><div class="col-md-12 col-xs-12">
	<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Đăng ký</button>
	<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
</div></div>
<div class="clearfix"></div>
<script>
	$(document).ready(function(){
		$("#btnsave").click(function(){	
			if(checkinput()==true) {
				var id_dkts = $("#id_dkts").val();
				var id_hoso = $("#id_hoso").val();
				var bac = $("#cbobac").val();
				var khoa = $("#cbokhoa").val();
				var ma_nganh = $("#ma_nganh").val();
				var _diadiem = $("#tk_diadiem").val();
				var _ptxt='';
				if(_diadiem==undefined) _diadiem='';

				var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_dangky_nganh.php";
				showLoading();
				$.post(url,{'id_dkts':id_dkts,'id_hoso':id_hoso,'ma_nganh':ma_nganh,'bac':bac,'khoa':khoa,
					'ptxt':_ptxt,'diadiem':_diadiem},function(req){
						hideLoading();
						if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
						else if(req=="success"){
							showMess("Hồ sơ đã đăng ký ngành học thành công!");
							setTimeout(function(){
								window.location.reload();
							}, 2000);
						}
					})
			} return false;
		})
	});

	function checkinput(){
		var ma_nganh = $("#ma_nganh").val();
		var name = $("#txtname").val();
		var bac = $("#cbobac").val();
		var khoa = $("#cbokhoa").val();
		if(ma_nganh=="") {
			$("#ma_nganh").focus();
			return false;
		}if(name=="") {
			$("#txtname").focus();
			return false;
		}if(bac=="") {
			$("#cbobac").focus();
			return false;
		}if(khoa=="") {
			$("#cbokhoa").focus();
			return false;
		}
		return true;
	}
</script>