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
if($masv == '') die('Chưa lựa chọn sinh viên nào');

//---------------------------------------
$KHOA = array();
$json_khoa = file_get_contents(DOCUMENT_ROOT.'jsons/khoa.json');
$arr_khoa = json_decode($json_khoa, true);
foreach ($arr_khoa as $key => $value) {
	$KHOA[$value['id']] = $value;
}

//---------------------------------------
$SINHVIEN = array();
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND masv='".$masv."'");
if(count($res_dkts)>0) $SINHVIEN = $res_dkts[0];
else die("Không tìm thấy sinh viên");
?>
<div class="ajx_mess"></div>
<form id="frm_status" method="post">
	<input type="hidden" id="masv" name="masv" value="<?php echo $masv;?>">
	<div class="form-group">
		<label>Chọn khóa</label>
		<select name="cbo_khoa" id="cbo_khoa" class="form-control required" style="width: 100%" required>
			<option value="">-- Chọn một --</option>
			<?php
			foreach ($KHOA as $key => $value) {
				if($value['id']== $SINHVIEN['id_khoa']){
					echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
				}else{
					echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				}
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
		$('#cbo_khoa').select2();

		$("#btnsave").click(function(){	
			if(validForm()==true) {
				showLoading();
				var url = "<?php echo ROOTHOST;?>ajaxs/khoa/process_select_khoa.php";
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