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

$id_order_detail = isset($_POST['id_order_detail']) ? antiData($_POST['id_order_detail']) : '';
if($id_order_detail == '') die('Chưa lựa chọn đơn hàng chi tiết nào');
?>
<div class="ajx_mess"></div>
<form id="frm_note_order" method="post">
	<input type="hidden" name="id_order_detail" value="<?php echo $id_order_detail;?>">
	<div class="form-group">
		<label>Xác nhận đã đóng</label>
		<select name="cbo_flag" id="cbo_flag" class="form-control required" required>
			<option value="0">Chưa đóng</option>
			<option value="1" selected>Đã đóng</option>
		</select>
	</div>
	<div class="form-group">
		<label>Nội dung</label>
		<textarea name="content" class="form-control" rows="3" placeholder="Nội dung..."></textarea>
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
				var url = "<?php echo ROOTHOST;?>ajaxs/hocphi/process_flag.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#frm_note_order").serialize(),
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
		$('#frm_note_order .required').each(function(){
			var val = $(this).val();
			if(!val || val=='') {
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