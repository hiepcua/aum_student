<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.tuyensinh.php');
require_once('../../libs/cls.he.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(!isset($_POST['masv'])) die("Vui lòng chọn mã sv");
$masv = addslashes(strip_tags(htmlentities($_POST['masv'])));

$res_dkts = SysGetList('tbl_dangky_tuyensinh',  array(), 'AND masv="'.$masv.'"');
if(count($res_dkts)<=0) die("Không tìm thấy sinh viên.");
$row = $res_dkts[0];
$id_hoso = $row['id_hoso'];
?>
<div class="row form-group">
	<div class="col-md-12">
		<label>Mã SV</label>
		<input type="text" name="add_masv" id="add_masv" class="form-control" value="<?php echo $masv;?>" readonly>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-12">
		<label>Số tiền:</label>
		<input type="number" name="add_money" id="add_money" class="form-control" value="" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-12">
		<label>Nội dung</label>
		<textarea name="add_noidung" id="add_noidung" class="form-control" placeholder="Nội dung" rows="3"></textarea>
	</div>
</div>
<div class="row form-group text-center">
	<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Lưu</button>
	<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
</div>
<div class="clearfix"></div>
<script>
	$(document).ready(function(){
		$("#btnsave").click(function(){
			var noidung = $("#add_noidung").val();
			var money = $("#add_money").val();
			if(money=="") {
				$("#add_money").addClass('novalid');
				$("#add_money").focus();
				return false;
			}else if($.isNumeric(money)==false){
				$("#add_money").addClass('novalid');
				$("#add_money").focus();
				return false;
			}else if(money<0){
				$("#add_money").addClass('novalid');
				alert("Vui lòng nhập số tiền >0");
				$("#add_money").focus();
				return false;
			}else $("#add_money").removeClass('novalid');

			var url = "<?php echo ROOTHOST;?>ajaxs/hocphi/process_hocphi.php";
			$.post(url,{'id_hoso':'<?php echo $id_hoso;?>','masv':'<?php echo $masv;?>','noidung': noidung, 'sotien':money},function(req){
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Đóng học phí thành công");
					setTimeout(function(){window.location.reload();},1000);
				}
			});
		})
	})
</script>