<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$ma_hoso   = $_POST['ma_hoso'] ? antiData($_POST['ma_hoso']) : '';
$rs_masv = SysGetList('tbl_dangky_tuyensinh',array('masv')," AND id_hoso = '".$ma_hoso."' ORDER BY id DESC");
if(count($rs_masv) == 0) die('Chưa có thông tin đăng ký ngành học.');
?>
<style type="text/css">
	#frmAddWordLog .form-control{
		border: 1px solid #ccc;
	}
</style>
<form name="frmAddWordLog" id="frmAddWordLog" class="form">
	<div class="form-group msg_error text-danger"></div>
	<input type="hidden" name="ma_hoso" id="ma_hoso" value="<?php echo $ma_hoso;?>" class="form-control"/>
	<div class="form-group">
		<div class="row">
			<div class="col-md-6">
				<label>Mã SV</label>
				<select name="cbo_masv" id="cbo_masv" class="form-control">
					<?php foreach($rs_masv as $item) { ?>
						<option value="<?php echo $item['masv'];?>"><?php echo $item['masv'];?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6">
				<label>Ngày liên hệ</label>
				<input type="date" name="ngay_lienhe" id="ngay_lienhe" class="form-control" value="<?php echo  date("Y-m-d");?>"/>
			</div>
		</div>
	</div>

	<label>Nội dung tương tác</label>
	<div class="form-group">
		<textarea type="text" name="nd_tuongtac" id="nd_tuongtac" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<select name="hoanthanh" id="hoanthanh" class="form-control">
			<option value="0">Chưa hoàn thành</option>
			<option value="1" selected>Đã hoàn thành</option>
		</select>
	</div>

	<div class="row form-group text-center">
		<button type="button" name="btnsave" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i> Lưu thông tin</button>
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Hủy</button>
	</div>
	<div class="clearfix"></div>
</form>
<script>
	$(document).ready(function(){
		$("#frmAddWordLog #btnsave").click(function(){
			if(checkinput()==true) {
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_add_workinglog.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#frmAddWordLog").serialize(),
					success: function(req){
						console.log(req);
						if(req == "success") {
							showMess("Thêm cuộc gọi thành công.");
							setTimeout(function(){ 
								location.reload();
							}, 2000);
						} else if(req == "E01") {
							showMess("Lỗi! Không có thông tin đăng nhập.","error");
						} else if(req == "error")
						showMess("Xảy ra lỗi.","error");
					}
				})
			}
		})
	})
	function checkinput(){
		if($("#cbo_masv").val()=="") {
			$("#cbo_masv").focus();
			$("#cbo_masv").addClass('novalid');
			return false;
		}else {
			$("#cbo_masv").removeClass('novalid');
		}
		if($("#ma_hoso").val()=="") {
			$("#ma_hoso").focus();
			$("#ma_hoso").addClass('novalid');
			return false;
		}else {
			$("#ma_hoso").removeClass('novalid');
		}
		if($("#ngay_lienhe").val()=="") {
			$("#ngay_lienhe").focus();
			$("#ngay_lienhe").addClass('novalid');
			return false;
		}else {
			$("#ngay_lienhe").removeClass('novalid');
		}
		if($("#nd_tuongtac").val()=="") {
			$("#nd_tuongtac").focus();
			$("#nd_tuongtac").addClass('novalid');
			return false;
		}else {
			$("#nd_tuongtac").removeClass('novalid');
		}
		return true;
	}
</script>