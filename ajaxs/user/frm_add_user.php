<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once("../../libs/cls.mysql.php");
require_once("../../libs/cls.users.php");
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$gid=isset($_POST['id'])?(int)$_POST['id']:0;
$check_permission = $objuser->Permission('user');
if($check_permission==false) die('E02');
?>
<script type="text/javascript" src="<?php echo ROOTHOST_ADMIN;?>js/webcam.js"></script>
<form id="frm-register" class="form-horizontal"  name="frm-register" method="" action="" enctype="multipart/form-data">
	<input type="hidden" class="form-control" id="txt_gid" value="<?php echo $gid;?>">
	<div class="form-group">
		<div class="col-md-12">
			<label>Họ Tên<small class="cred"> (*)</small></label><small id="er1" class="cred"></small>
			<input type="text" id="txt_firstname" name="txt_firstname" class="form-control" value="" placeholder="Tên">
			<label>Phone<small class="cred"> (*)</small></label><small id="er2" class="cred"></small>
			<input type="number" id="txt_phone" name="txt_phone" class="form-control" value="" placeholder="Số điện thoại">
		</div>
	</div>
	<hr/>
	<div class="form-group">
		<div class="col-md-12">
			<label>Username<small class="cred"> (*)</small></label><small id="er3" class="cred"></small>
			<input type="text" id="txt_username" name="txt_username" class="form-control" value="" placeholder="Tên đăng nhập">
			<span id="user_success"></span>
			<label>Password<small class="cred"> (*)</small></label><small id="er4" class="cred"></small>
			<input type="password" id="txt_password" name="txt_password" class="form-control" value="" placeholder="Mật khẩu">
		</div>
	</div>
	<br>
	<div class="clearfix"></div><br>
	<button type="button" class="btn btn-primary" id="cmd_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	<button type="button" class="btn btn-default" id="cmd_cancel"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
</form>
<div class="clearfix"></div>
<style type="text/css">
	hr{margin-top: 0;margin-bottom: 15px;}
	label.title{font-size: 16px;font-weight: 500;}
	#results,#my_camera {
		margin: auto;
		margin-bottom: 10px;
	}
	#results img {
		width: 350px;
		height: 263px;
	}
	.must {
		color: red !important;
	}
	#dt_basic thead th {
		text-align: center;
	}
</style>
<script type="text/javascript">
$(document).ready(function(){
	var flag=1;
	$('#cmd_save').click(function(){
		if(flag==1){ 
			if(check_validate()==true) {
				var gid=$('#txt_gid').val()!='undefined'?$('#txt_gid').val():0;
				var data = $('#frm-register').serializeArray();
				data.push( {name:'txt_gid', value:gid} );
				var url='ajaxs/user/process_update_user.php';
				$.post(url,data,function(req){
					if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
					if(req=='E03'){showMess('Không có quyền thêm người dùng cho nhóm này!','error');}
					if(req=='E04'){showMess('Có lỗi trong quá trình thực hiện!','error');}
					else {
						console.log(req);
						getUserByGroup(gid);
						showMess('Success!','success');
					}
				});
			}
		}else{ console.log('2');
			showMess('Tên đăng nhập đã tồn tại!','error');
		}
	});
	$('#cmd_cancel').click(function(){
		$('#myModalPopup .modal-header .modal-title').html('Sửa thông tin người dùng');
		$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
		$('#myModalPopup').modal('hide');
	});
	$('#txt_username').change(function(){
		var username = $(this).val();
		var url ='ajaxs/user/check_isset_username.php';
		$.post(url,{'username':username},function(req){
			if(req=="ERR") {
				flag=0;
				$('#er2').text('Tên đăng nhập đã tồn tại');
			}
			if(req=="SUCCESS"){
				$('#er2').text('');
				$('#user_success').addClass('glyphicon glyphicon-ok form-control-feedback');
				flag=1;
			}
		});
	})
})
function checkUserRegisExist(){
	var username = $('#txt_username').val();
	var url ='ajaxs/user/check_isset_username.php';
	$.post(url,{'username':username},function(req){
		if(req=="ERR") {
			flag=0;
			$('#er2').text('Tên đăng nhập đã tồn tại');
			return false;
		}
		if(req=="SUCCESS"){
			$('#er2').text('');
			$('#user_success').addClass('glyphicon glyphicon-ok form-control-feedback');
			flag=1; return true;
		}
	});
	return false;
}
function getUserByGroup($gid){
	var url='ajaxs/user/getUserByGroup.php';
	$.post(url,{'gid':$gid},function(req){
		$('.user_list .list').html(req);
	});
}
function check_validate(){
	if ($('#txt_firstname').val() =='') {
		return false;
	}else{
		$('#er1').text('');
	}
	if ($('#txt_phone').val() =='') {
		$('#er2').text('Không được bỏ trống');
		return false;
	}else{
		$('#er2').text('');
	}
	if ($('#txt_username').val() =='') {
		$('#er3').text('Tên đăng nhập là bắt buộc');
		return false;
	}else{
		$('#er3').text('');
	}
	if ($('#txt_password').val() =='') {
		$('#er4').text('Mật khẩu là bắt buộc');
		return false;
	}
	else{
		$('#er4').text('');
	}
	
	return true;
}
</script>