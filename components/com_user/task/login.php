<?php
defined('ISHOME') or die("Can't acess this page, please come back!");
$err=$username=$password='';
if(isset($_POST['txtuser'])){
	$user=addslashes($_POST['txtuser']);
	$pass=addslashes($_POST['txtpass']);
	global $UserLogin;
	if($UserLogin->LOGIN($user,$pass)==true)
		echo '<script language="javascript">window.location.href="'.ROOTHOST.'index.php"</script>';
	else
		$err='<font color="red">Đăng nhập không thành công.</font>';
}
?>
<div class='col-md-4 hidden-xs'></div>
<div class='col-md-4 col-xs-12'>
	<form id="frmlogin" name="frmlogin" method="post" action="" AUTOCOMPLETE="off" >
		<h2 class="title_login"><span class='glyphicon glyphicon-user'></span> ĐĂNG NHẬP</h2>
		<div class="body">
			<div class="form-group"><br><br></div>
			<div class="form-group text-center">
				<img src="<?php echo ROOTHOST;?>images/logo/logo3.png" height="100" style="margin:auto"/>
			</div>
			<div class="clearfix"><hr style="margin:0 0 10px; padding:0"></div>
			<?php if($err!="") { ?>
			<div class="form-group text-center" style="color:red;"><b><?php echo $err;?></b></div>
			<?php } ?>
			<div class="form-group">
				<div class="col-md-4 col-sm-6">
					<label>Tên đăng nhập</label>
					<label>Mật khẩu</label>
					<?php /*<label>Mã bảo mật</label>*/?>
				</div>
				<div class="col-md-8 col-sm-6">
					<input type='text' name='txtuser' id='txtuser' class='form-control' placeholder='Tên đăng nhập' value='<?php echo $username;?>' required autocomplete="off"/>
					<input type='password' name='txtpass' id='txtpass' class='form-control' placeholder='Mật khẩu' value='<?php echo $password;?>' required autocomplete="off"/>
				</div>
			</div>
			<div class="form-group clearfix">
				<input type='submit' name='cmd_login' id='cmd_login' class='btn btn-primary form-control' value='Đăng nhập'/>
			</div>
		</div>
	</form>
</div>
<div class='col-md-4 hidden-xs'>
</div>