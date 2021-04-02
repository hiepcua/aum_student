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
require_once('../../libs/cls.configsite.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

// config site
$config=new CLS_CONFIG; $config->getList();
$conf = $config->Fetch_Assoc();
global $conf;

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
	<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Đóng & in biên lai</button>
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

			showLoading();
			var url = "<?php echo ROOTHOST;?>ajaxs/hocphi/process_hocphi_inbienlai.php";
			$.post(url,{'id_hoso':'<?php echo $id_hoso;?>','masv':'<?php echo $masv;?>','noidung': noidung, 'sotien':money},function(req){
				// console.log(req);
				hideLoading();
				if(parseInt(req) != NaN && parseInt(req) > 0) {
					setTimeout(function(){showMess("Đóng học phí thành công. Thực hiện in biên lai")},2000);
					var url = "<?php echo ROOTHOST;?>ajaxs/hocphi/print.php";
					$.post(url,{'ma':'<?php echo $id_hoso;?>','id_hocphi_pay': parseInt(req)},function(req){
						// console.log(req);
						var screenW =screen.width;
						var screenH =screen.height; console.log(screenW+' / '+screenH);
						var popupWin = window.open('', '_blank','toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width='+screenW+',height='+screenH);
						popupWin.document.open();
						popupWin.document.write('<html><head><title><?php global $conf; echo $conf['title'];?></title>');
						popupWin.document.write('</head><body onload="window.print();">');
						popupWin.document.write(req);
						popupWin.document.write('</body></html>');
						popupWin.document.close();
						hideLoading();
					})
					setTimeout(function(){window.location.reload(); }, 2000);
				}else if(req=="E01"){
					showMess("Vui lòng đăng nhập hệ thống","error");
				}else{
					showMess('Lỗi trong quá trình lưu thông tin học phí');
				}
			});
			hideLoading();
		})
	})
</script>