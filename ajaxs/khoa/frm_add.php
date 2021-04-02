<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.he.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$action = isset($_POST['action'])?addslashes(htmlentities(strip_tags($_POST['action']))):'';
$value = isset($_POST['value'])?addslashes(htmlentities(strip_tags($_POST['value']))):'';

?>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Khóa học</div>
	<div class="col-md-6 col-xs-8">
		<select name="cboyear" id="cboyear" class="form-control" required>
			<option value="">Chọn khóa</option>
			<?php $year=date("Y");
			for($i=$year-5;$i<=$year+5;$i++) {?>
			<option value="<?php echo $i;?>"><?php echo $i;?></option>
			<?php } ?>
		</select>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Tên hiển thị</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtname" id="txtname" class="form-control" value="Khóa <?php echo $year;?>" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Ngày khai giảng</div>
	<div class="col-md-6 col-xs-8">
		<input type="date" name="ngay" id="ngay" class="form-control" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Số lượng</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="sl" id="sl" class="form-control" required>
	</div>
</div>
<div class="row form-group text-center">
	<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Lưu</button>
	<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
</div>
<div class="clearfix"></div>
<script>
$(document).ready(function(){
	$("#cboyear").change(function(){
		var year = $("#cboyear option:selected").val();
		$("#txtname").val('Khóa '+year);
	})
	$("#btnsave").click(function(){
		if(checkinput()==true) {
			var year = $("#cboyear option:selected").val();
			var name = $("#txtname").val();
			var ngay = $("#ngay").val();
			var sl = $("#sl").val();
			var url = "<?php echo ROOTHOST;?>ajaxs/khoa/process_add.php";
			showLoading();
			$.post(url,{'type':'<?php echo $value;?>', 'year':year,'name':name,'ngay':ngay,'sl':sl}, function(req){
				console.log(req);
				hideLoading();
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Thêm khóa mới thành công");
					window.location.reload();
				}else if(req=="E02"){
					showMess("Đã có khóa thuộc năm này, vui lòng tạo lại", "error");
				}
			})
		} return false;
	})
	$("#btncancel").click(function(){
		
	})
})
function checkinput(){
	var year = $("#cboyear option:selected").val();
	var name = $("#txtname").val();
	var ngay = $("#ngay").val();
	var sl = $("#sl").val();
	if(year=="") {
		$("#cboyear").focus();
		return false;
	}
	if(name=="") {
		$("#txtname").focus();
		return false;
	}if(ngay=="") {
		$("#ngay").focus();
		return false;
	}
	if(sl=="" || sl.isNumeric==false) {
		$("#sl").focus();
		return false;
	}
	return true;
}
</script>