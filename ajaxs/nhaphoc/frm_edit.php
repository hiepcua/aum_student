<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
if(isset($_POST['id'])) {
	$code = "nhaphoc";
	$id = isset($_POST['id'])?(int)$_POST['id']:-1;
	// select config 
	$objdata=new CLS_MYSQL;
	$sql = "SELECT `config` FROM tbl_config_hoso WHERE `code`='$code'";
	$objdata->Query($sql);
	$r = $objdata->Fetch_Assoc();
	$json_hoso = json_decode($r['config'],true);
	$value = $json_hoso[$id];
?>
<div class="form-group">
	<textarea name="brief_field_edit" id="brief_field_edit" class="form-control" rows="2"><?php echo $value;?></textarea>
</div>
<div class="form-group">
	<button type="button" id="brief_del" class="btn btn-default pull-left">Xóa</button>
	<button type="button" id="brief_edit" class="btn btn-success pull-right">Cập nhật</button>
</div>
<script>
$("#brief_edit").click(function(){
	var field = $("#brief_field_edit").val();
	if(field=="") {
		$(".msgbox").html("Vui lòng nhập nội dung"); 
		$("#brief_field_edit").focus();
		return false;
	}
	var url = ROOTHOST+"ajaxs/nhaphoc/process_edit.php";
	showLoading();
	$.post(url,{'id':'<?php echo $id;?>','field':field},function(req){
		console.log(req);
		hideLoading();
		if(req=="E01") showMess("Vui lòng đăng nhập hệ thống");
		else if(req=="success") {
			window.location.reload();
		}else showMess("Xảy ra lỗi!");
	})
})
$("#brief_del").click(function(){
	var url = ROOTHOST+"ajaxs/nhaphoc/process_del.php";
	showLoading();
	$.post(url,{'id':'<?php echo $id;?>'},function(req){
		console.log(req);
		hideLoading();
		if(req=="E01") showMess("Vui lòng đăng nhập hệ thống");
		else if(req=="success") {
			window.location.reload();
		}else showMess("Xảy ra lỗi!");
	})
})
</script>
<?php } else die("Không có dữ liệu.");?>