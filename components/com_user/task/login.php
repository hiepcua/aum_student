<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
$err=$username=$password='';
?>
<div class='col-md-4 hidden-xs'></div>
<div class='col-md-4 col-xs-12'>
	<div class="mess_error cred"></div>
	<form id="frmlogin" name="frmlogin" method="post" action="<?php echo ROOTHOST;?>ajaxs/login/login_send.php" AUTOCOMPLETE="off" >
		<h2 class="title_login"><span class='glyphicon glyphicon-user'></span> ĐĂNG NHẬP</h2>
		<div class="body">
			<div class="form-group"><br><br></div>
			<div class="form-group text-center">
				<img src="<?php echo ROOTHOST;?>images/logo/logo2.png" height="100" style="margin:auto"/>
			</div>
			<div class="clearfix"><hr style="margin:0 0 10px; padding:0"></div>
			<div class="form-group">
				<div class="col-md-4 col-sm-6">
					<label>Tên đăng nhập</label>
					<label>Mật khẩu</label>
				</div>
				<div class="col-md-8 col-sm-6">
					<input type='text' name='username' id='txtuser' class='form-control' placeholder='Tên đăng nhập' value='<?php echo $username;?>' required autocomplete="off"/>
					<input type='password' name='password' id='txtpass' class='form-control' placeholder='Mật khẩu' value='<?php echo $password;?>' required autocomplete="off"/>
				</div>
			</div>
			<div class="form-group clearfix">
				<input type="submit" name='cmd_login' id='cmd_login' class='btn btn-primary form-control' value='Đăng nhập'/>
			</div>
		</div>
	</form>
</div>
<div class='col-md-4 hidden-xs'>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#frmlogin').submit(function(){
			return checkinput();
		})
	});

	function checkinput(){
		var username = $("#txtuser").val();
		var password = $("#txtpass").val();
		
		if(username=="" || username=="undefined") {
			return false;
		}if(password=="" || password=="undefined") {
			return false;
		}
		return true;
	}
</script>