<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.hocsinh.php');
require_once('../../libs/cls.he.php');
require_once('../../libs/cls.khoa.php');
require_once('../../libs/cls.nganh.php');
require_once('../../libs/cls.tuyensinh.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$ids = isset($_POST['ids']) ? antiData($_POST['ids']) : '';
if($ids=="") die('Chưa chọn đối tượng nào');
?>
<div class="ajx_mess"></div>
<form id="frm_status" method="post">
	<input type="hidden" name="ids" value="<?php echo $ids;?>">
	<div class="form-group">
		<label>Tình trạng cuộc gọi</label>
		<select name="cbo_status_call" id="cbo_status_call" class="form-control required" required>
			<?php
			foreach ($STATUS_CALL as $key => $value) {
				echo '<option value="'.$key.'">'.$value.'</option>';
			}
			?>
		</select>
	</div>

	<div class="form-group">
		<label>Ghi chú</label>
		<textarea class="form-control" name="note" rows="2"></textarea>
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
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_call_multiple.php";
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