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

$ma_lop = isset($_POST['ma_lop']) ? antiData($_POST['ma_lop']) : '';
$ma_khoa = isset($_POST['ma_khoa']) ? antiData($_POST['ma_khoa']) : '';
if($ma_lop == '') die('Chưa lựa chọn lớp nào');

//---------------------------------------
$KHOA = array();
$json_khoa = file_get_contents(DOCUMENT_ROOT.'jsons/khoa.json');
$arr_khoa = json_decode($json_khoa, true);
foreach ($arr_khoa as $key => $value) {
	$KHOA[$value['id']] = $value;
}

//---------------------------------------
$LOP = array();
$res_lop = SysGetList('tbl_lop', array());
if(count($res_lop)>0){
	foreach ($res_lop as $key => $value) {
		$LOP[$value['id']] = $value;
	}
}

$tenlop = isset($LOP[$ma_lop]) ? $LOP[$ma_lop]['name'] : "";
?>
<div class="ajx_mess"></div>
<form id="frm_status" method="post">
	<input type="hidden" id="ma_lop" name="ma_lop" value="<?php echo $ma_lop;?>">
	<div class="form-group">
		<div class="row form-group">
			<div class="col-sm-2">Lớp</div>
			<div class="col-sm-8"><?php echo $tenlop;?></div>
		</div>

		<div class="row form-group">
			<div class="col-sm-2">Chọn khóa</div>
			<div class="col-sm-8">
				<select name="cbo_khoa" id="cbo_khoa" class="form-control required" style="width: 100%" required>
					<option value="">-- Chọn một --</option>
					<?php
					if(count($KHOA)>0){
						foreach ($KHOA as $key => $value) {
							if($key==$ma_khoa){
								echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
							}else{
								echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
							}
						}
					}?>
				</select>
			</div>
		</div>
	</div>

	<div class="form-group text-center" style="margin-top: 20px;">
		<button type="button" name="btnsave" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cbo_khoa').select2();

		$("#btnsave").click(function(){	
			if(validForm()==true) {
				showLoading();
				var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_select_khoa.php";
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