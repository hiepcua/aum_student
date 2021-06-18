<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.hocsinh.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$id = isset($_POST['id']) ? antiData($_POST['id']) : '';
$status = isset($_POST['status']) ? antiData($_POST['status']) : '';
if($id == '') die('Chưa lựa chọn học viên nào');
?>
<div class="ajx_mess"></div>
<form id="frm_status" method="post">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<div class="form-group">
		<label>Trạng thái học tập</label>
		<select name="cbo_status_hoctap" id="cbo_status_hoctap" class="form-control required" required>
			<?php
			foreach ($STATUS_HOCTAP as $key => $value) {
				$checked = $key==$status ? 'selected' : '';
				echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
			}
			?>
		</select>
	</div>

	<div class="form-group text-center" style="margin-top: 20px;">
		<button type="button" name="btnsave" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsave").click(function(){	
			if(validForm()==true) {
				showLoading();
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_status_hoctap.php";
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

	function validForm(){
		var flag = true;
		$('#frm_status .required').each(function(){
			var val = $(this).val();
			if(!val || val=='' || val=='0') {
				$(this).parents('.form-group').addClass('error');
				flag = false;
			}

			if(flag==false) {
				$('.ajx_mess').html('Những mục có đánh dấu * là những thông tin bắt buộc.');
			}
		});
		return flag;
	}
</script>