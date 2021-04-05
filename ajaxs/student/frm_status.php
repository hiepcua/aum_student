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
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
$ma = isset($_POST['id_hoso']) ? antiData($_POST['id_hoso']) : '';
if($id == '') die('Chưa lựa chọn hồ sơ nào');

$objhs = new CLS_HS;
$name = $objhs->getFullNameByInfo('ma',$ma);

$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND id=".$id);
$row = $res_dkts[0];
?>
<style type="text/css">
	.row-status{
		position: relative;
		padding-right: 40px;
	}
	input.chk_done {
	    position: absolute;
	    right: 20px;
	    top: 8px;
	    margin-top: 0;
	    width: 20px;
	    height: 20px;
	}
</style>
<form id="frm_status" method="post">
	<div class="form-group row">
		<input type="hidden" id="id_dkts" name="id_dkts" value="<?php echo $id;?>">
		<input type="hidden" id="id_hoso" name="id_hoso" value="<?php echo $ma;?>">
		<input type="hidden" id="masv" name="masv" value="<?php echo $row['masv'];?>">
		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Họ tên</label>
			<div class="col-md-8"><input type="text" id="fullname" value="<?php echo $name;?>" readonly class="form-control" /></div>
		</div>

		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Khóa</label>
			<div class="col-md-8">
				<select name="cbokhoa" id="cbokhoa" class="form-control" readonly>
					<?php 
					$res_khoa = SysGetList('tbl_khoa', array(), '');
					if(count($res_khoa)>0){
						foreach ($res_khoa as $key => $value) {
							if($value['id'] == $row['id_khoa']){
								echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
							}
						}
					}?>
				</select>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Bậc đào tạo</label>
			<div class="col-md-8">
				<select name="cbobac" id="cbobac" class="form-control" readonly>
					<?php 
					$res_he = SysGetList('tbl_he', array(), '');
					if(count($res_he)>0){
						foreach ($res_he as $key => $value) {
							if($value['id'] == $row['id_he']){
								echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
							}
						}
					}?>
				</select>
			</div>
		</div>

		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Ngành</label>
			<div class="col-md-8">
				<select name="ma_nganh" id="ma_nganh" class="form-control" readonly>
					<?php
					$res_nganh = SysGetList('tbl_nganh', array(), ''); 
					if(count($res_nganh)>0){
						foreach ($res_nganh as $key => $value) {
							if($value['id'] == $row['id_nganh']){
								echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
							}
						}
					}?>
				</select>
			</div>
		</div>
	</div>

	<div class="form-group row">
		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Trạng thái</label>
			<div class="col-md-8">
				<select name="cbo_status" id="cbo_status" class="form-control" required>
					<?php 
					$arr_status=array();
					$current_status = $row['status'];
					switch ($current_status) {
						case 'L0':
						$arr_status = array('L0','L1','L2','L3','L4','L5','L8','L9A','L9B');
						break;

						case 'L1':
						$arr_status = array('L1','L2','L3','L4','L5','L8','L9A','L9B');
						break;

						case 'L2':
						$arr_status = array('L2','L3','L4','L5','L8','L9A','L9B');
						break;

						case 'L3':
						$arr_status = array('L3','L4','L5','L8','L9A','L9B');
						break;

						case 'L4':
						$arr_status = array('L4','L5','L8','L9A','L9B');
						break;

						case 'L5':
						$arr_status = array('L5','L8','L9A','L9B');
						break;

						case 'L8':
						$arr_status = array('L8');
						break;

						case 'L9A':
						$arr_status = array('L9A','L9B');
						break;

						case 'L9B':
						$arr_status = array('L9B');
						break;

						default:
						$arr_status = array('L0','L1','L2','L3','L4','L5','L8','L9A','L9B');
						break;
					}
					foreach ($arr_status as $key => $value) {
						$checked = $key==0 ? 'checked' : '';
						echo '<option value="'.$value.'" '.$checked.'>'.$STATUS_DKTS[$value].'</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<hr>
	<label>Báo cáo tương tác</label>
	<div class="form-group row row-status">
		<input type="checkbox" name="chk_done" class="chk_done" id="chk_done">
		<div class="col-md-3"><input type="date" name="date_done" id="date_done" class="form-control" value="<?php echo date("Y-m-d");?>"></div>
		<div class="col-md-5"><input type="text" name="noidung_done" id="noidung_done" class="form-control" placeholder="Nội dung (Không để trống)"></div>
		<div class="col-md-4"><input type="text" name="ketqua_done" id="ketqua_done" class="form-control" placeholder="Kết quả"></div>
	</div>
	<label>Kế hoạch tương tác</label>
	<div class="form-group row row-status">
		<input type="checkbox" name="chk_kehoach" class="chk_done" id="chk_kehoach">
		<div class="col-md-3"><input type="date" name="date_kehoach" id="date_kehoach" class="form-control"></div>
		<div class="col-md-5"><input type="text" name="noidung_kehoach" id="noidung_kehoach" class="form-control" placeholder="Nội dung"></div>
		<div class="col-md-4"><input type="text" name="ketqua_kehoach" id="ketqua_kehoach" class="form-control" placeholder="Kết quả"></div>
	</div>
	<div class="row form-group text-right" style="margin-top: 20px;"><div class="col-md-12 col-xs-12">
		<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Lưu</button>
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
	</div></div>
</form>
<div class="clearfix"></div>
<script>
	$(document).ready(function(){
		$("#btnsave").click(function(){	
			if(checkinput()==true) {
				showLoading();
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_status.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#frm_status").serialize(),
					success: function(req){
						hideLoading();
						if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
						else if(req=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
						else if(req==="success") {
							showMess("Cập nhật thành công!",""); 
							setTimeout(function(){ 
								window.location.reload(); 
							}, 1500);
						}
					}
				});
			} return false;
		})
	});

	function checkinput(){
		var id_dkts = $("#id_dkts").val();
		var id_hoso = $("#id_hoso").val();
		var masv = $("#masv").val(),
		status = $("#cbo_status :selected").val(),
		noidung_done = $('#noidung_done').val();

		if(id_dkts=="" || id_dkts=="undefined") {
			return false;
		}if(id_hoso=="" || id_hoso=="undefined") {
			return false;
		}if(masv=="" || masv=="undefined") {
			return false;
		}if(status=="" || status=="undefined") {
			return false;
		}if(noidung_done=="") {
			$('#noidung_done').focus();
			return false;
		}
		return true;
	}
</script>