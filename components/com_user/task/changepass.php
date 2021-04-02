<?php
$obju=new CLS_USER;
$error='';
if($obju->isLogin()==false){?>
<script>window.location='<?php echo ROOTHOST_ADMIN;?>login';</script>
<?php
}
$user = $obju->getInfo('username');
if(isset($_POST['cmd_update_info']) && $_POST['txt_newpass']!=''){	
	if($_POST['txt_newpass']!=$_POST['txt_newpass2']) {
		$error = "Xác nhận mật khẩu không chính xác"; 
	}
	else {
		$pass = $_POST["txtpass"];
		$newpass = $_POST["txt_newpass"];
		$obju->getList(" AND username='".$user."' LIMIT 1");
		$row = $obju->Fetch_Assoc();
		$pass=hash('sha512',trim($pass));
		$pass=md5($pass);
		if($pass!=$row['password']){
			$error = 'Mật khẩu hiện tại không chính xác';
		} else {
			$result = $obju->ChangePass_User($user,$newpass);
			if($result) 
				echo '<div id="action"><h3 style="color:#3399FF">Mật khẩu đã được đổi thành công! Vui lòng đăng xuất để nhập lại mật khẩu mới.</h3></div>';
			else
				echo '<div id="action"><h3 style="color:red">Lỗi trong quá trình lưu trữ. Mật khẩu chưa được đổi.</h3></div>';
		}
	}
}
?>
<div class='header row'>
<h1 class='page-title'>Đổi mật khẩu</h1>
</div>
<div class="min-height box-white"><div class="container-fluid">
	<div class="bg-white"><div class="white-body"><br>
		<div id="messageError" style="color:red;"><strong><?php echo $error;?></strong></div>
		<span class="error_pass" style="color:red;font-weight:bold"></span>
		<form name="frm_update_member" id="frm_update_member" action=""  method="POST" class="form_add">
			<div class="form-group">
				<div class="col-md-2 col-xs-12">Tên đăng nhập</div>
				<div class="col-md-4 col-xs-12">
					<input type='text' class='form-control' name='txt_user' id='txt_user' placeholder='Tên đăng nhập' minlength="3" value='<?php echo $user;?>' readonly/>
					<span id='user_result'></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 col-xs-12">Mật khẩu hiện tại</div>
				<div class="col-md-4 col-xs-12"><input type="password"  class="form-control" id="txtpass" name="txtpass" value="" minlength="6" required>
				<input type="hidden"  class="form-control" id="txtid" name="txtid" value="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2 col-xs-12">Mật khẩu mới</div>
				<div class="col-md-4 col-xs-12"><input type="password" class="form-control" name="txt_newpass" id="txt_newpass" minlength="6" value="" required></div>
			</div>
			<div class="form-group">
				<div class="col-md-2 col-xs-12">Xác nhận mật khẩu mới</div>
				<div class="col-md-4 col-xs-12"><input type="password" class="form-control" name="txt_newpass2" id="txt_newpass2" value="" required minlength="6"></div>
			</div>
			<div class="form-group"><div class="col-md-2 hidden-xs"></div>
				<div class="col-md-4 col-xs-12">
				<button type="submit" class="btn btn-primary" name="cmd_update_info" id="cmd_update_info" onclick="return checkfrm()">Lưu lại</button>
				</div>
			</div><br>
		</form>
	</div></div>
</div></div>
<script>
function checkfrm() {
	if($('#txt_newpass').val().length()<6) {
		$('.error_pass').html('Mật khẩu phải có ít nhất 6 ký tự');
		$('#txt_newpass').focus();
		return false;
	}
	if($('#txt_newpass').val()!=$('#txt_newpass2').val()) {
		$('.error_pass').html('Mật khẩu mới không khớp');
		$('#txt_newpass2').focus();
		return false;
	}
	return true;
}
</script>