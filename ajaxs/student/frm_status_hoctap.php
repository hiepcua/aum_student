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

$masv = isset($_POST['masv']) ? antiData($_POST['masv']) : '';
$ma_mon = isset($_POST['ma_mon']) ? antiData($_POST['ma_mon']) : '';
$status = isset($_POST['status']) ? antiData($_POST['status']) : '';
if($masv=="" || $ma_mon=="") die('Chưa đủ dữ liệu');

$res_monhoc = SysGetList('tbl_monhoc', array(), "AND id='".$ma_mon."'");
$row_monhoc = $res_monhoc[0];
?>
<div class="ajx_mess"></div>
<form id="frm_status" method="post">
	<input type="hidden" name="masv" value="<?php echo $masv;?>">
	<input type="hidden" name="ma_monhoc" value="<?php echo $ma_mon;?>">
	<div class="form-group">
		<label>Tên môn học</label>
		<input type="text" name="txt_monhoc" class="form-control" value="<?php echo $row_monhoc['name'];?>">
	</div>
	<div class="form-group">
		<label>Tình trạng học tập</label>
		<select name="cbo_status_hoctap" id="cbo_status_hoctap" class="form-control required" required>
			<?php
			foreach ($STATUS_HOCTAP as $key => $value) {
				$checked = $key==$status_call ? 'selected' : '';
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
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_hoctap.php";
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