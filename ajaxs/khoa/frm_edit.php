<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.khoa.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$action = isset($_POST['action'])?addslashes(htmlentities(strip_tags($_POST['action']))):'';
$id = isset($_POST['id'])?addslashes(htmlentities(strip_tags($_POST['id']))):'';
$objkhoa = new CLS_KHOA;
$objkhoa->getList(" AND id='$id'");
$r=$objkhoa->Fetch_Assoc();
$id_khoa = $r['id']; $r_year=substr($id_khoa,-4); 
?>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Khóa học</div>
	<div class="col-md-6 col-xs-8">
		<select name="cboyear" id="cboyear" class="form-control" required readonly>
			<option value="<?php echo $r_year;?>" selected><?php echo $r_year;?></option>
		</select>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Tên hiển thị</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtname" id="txtname" class="form-control" value="<?php echo $r['name'];?>" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Ngày khai giảng</div>
	<div class="col-md-6 col-xs-8">
		<input type="date" name="ngay" id="ngay" class="form-control" value="<?php echo date("Y-m-d",$r['startDay']);?>" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-6 col-xs-4 text">Số lượng</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="sl" id="sl" class="form-control" value="<?php echo $r['quan'];?>" required>
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
			var url = "<?php echo ROOTHOST;?>ajaxs/khoa/process_edit.php";
			showLoading();
			$.post(url,{'value':'<?php echo $id;?>','year':year,'name':name,'ngay':ngay,'sl':sl},function(req){
				hideLoading();
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Cập nhật thành công");
					window.location.reload();
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