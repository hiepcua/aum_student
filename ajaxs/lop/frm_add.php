<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.nganh.php');
$obj=new CLS_MYSQL;
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$_KHOA = isset($_SESSION['THIS_KHOA']) ? $_SESSION['THIS_KHOA'] : '';
$_HE = isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
?>
<div class="form-group msg_error text-danger"></div>
<div class="form-group">
	<label class="col-md-2">Khóa</label>
	<div class="col-md-4">
		<select name="cbo_khoa" id="cbo_khoa" class="form-control" required>
			<?php
			$sql="SELECT * FROM tbl_khoa";
			$obj->Query($sql);
			while($r=$obj->Fetch_Assoc()){ 
				if($r['id'] == $_KHOA){
					echo '<option value="'.$r['id'].'" selected>'.$r['name'].'</option>';
				}else{
					echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
				}
			}?>
		</select>
	</div>
	<label class="col-md-2">Hệ</label>
	<div class="col-md-4">
		<select name="cbo_he" id="cbo_he" class="form-control" required>
			<?php
			$sql="SELECT * FROM tbl_he";
			$obj->Query($sql);
			while($r=$obj->Fetch_Assoc()){
				if($r['id'] == $_HE){
					echo '<option value="'.$r['id'].'" selected>'.$r['name'].'</option>';
				}else{
					echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
				}
			}?>
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-md-2">Ngành</label>
	<div class="col-md-4">
		<select name="cbo_nganh" id="cbo_nganh" class="form-control" required>
			<?php 
			$sql="SELECT * FROM tbl_nganh";
			$obj->Query($sql);
			while($r=$obj->Fetch_Assoc()){
				if($r['id'] == $_NGANH){
					echo '<option value="'.$r['id'].'" selected>'.$r['name'].'</option>';
				}else{
					echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
				}
			} ?>
		</select>
	</div>
	<label class="col-md-2">Tên lớp</label>
	<div class="col-md-4">
		<input type="text" name="txt_lop" id="txt_lop" value="" required class="form-control" />
	</div>
</div>
<div class="row form-group text-center">
	<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Lưu</button>
</div>
<div class="clearfix"></div>
<script>
	$(document).ready(function(){
		$("#btnsave").click(function(){
			var khoa = $("#cbo_khoa").val();
			var he  = $("#cbo_he").val();
			var nganh = $("#cbo_nganh").val();
			var lop = $("#txt_lop").val();

			if(khoa=="") { $('.msg_error').html('Vui lòng chọn khóa'); $("#cbo_khoa").focus(); return false;}
			if(he=="") { $('.msg_error').html('Vui lòng chọn hệ'); $("#cbo_he").focus(); return false;}
			if(nganh=="") { $('.msg_error').html('Vui lòng chọn ngành'); $("#cbo_nganh").focus(); return false;}
			if(lop=="") { $('.msg_error').html('Vui lòng nhập tên lớp mới'); $("#txt_lop").focus(); return false;}

			showLoading();
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_add.php";
			$.post(url,{'lop':lop,'id_khoa':khoa,'id_he':he,'id_nganh':nganh},function(req){
				hideLoading();
				if(req=="E01") 
					showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="nodata") 
					$('.msg_error').html('Vui lòng nhập đủ thông tin');
				else if(req=="exist"){
					$('.msg_error').html('Tên lớp đã có. Vui lòng nhập tên khác.');
					$("#cbo_khoa").focus(); return false;
				}else if(req=="success"){
					showMess("Đã thêm lớp thành công.");
					setTimeout(function(){window.location.reload();},2000);
				}
			});
		})
	})
</script>