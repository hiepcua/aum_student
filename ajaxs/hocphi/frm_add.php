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

$objts = new CLS_TUYENSINH;
$objts->getList(" AND masv='$masv' ");
$r_ts = $objts->Fetch_Assoc();
$he = $r_ts['id_he'];
$nganh = $r_ts['id_nganh'];
$masv = $r_ts['masv'];
$malop = $r_ts['malop'];
$ma = $r_ts['id_hoso'];
?>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Mã SV:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="add_masv" id="add_masv" class="form-control" value="<?php echo $masv;?>" readonly>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Học Kỳ:</div>
	<div class="col-md-6 col-xs-8">
		<?php $objhe = new CLS_HE;
		$objhe->getList(" AND id='$he'");
		$r=$objhe->Fetch_Assoc();
		$sohocky=$r['sohocky'];?>
		<select id='add_hocky' name='add_hocky' class='form-control'>
			<option value="">Tất cả</option>
			<?php for($i=1;$i<=$sohocky;$i++){
				echo "<option value='$i'>Học kỳ $i</option>";
			}?>
		</select>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Tên mục học phí:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="add_name" id="add_name" class="form-control" value="" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Số tiền:</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="add_money" id="add_money" class="form-control" value="" required>
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
		var name = $("#add_name").val();
		var hocky = $("#add_hocky").val();
		var money = $("#add_money").val();
		if(hocky=="") {
			$("#add_hocky").addClass('novalid');
			$("#add_hocky").focus();
			return false;
		}else $("#add_hocky").removeClass('novalid');
		if(name=="") {
			$("#add_name").addClass('novalid');
			$("#add_name").focus();
			return false;
		}else $("#add_name").removeClass('novalid');
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
		
		var url = "<?php echo ROOTHOST;?>ajaxs/hocphi/process_add.php";
		$.post(url,{'ma':'<?php echo $ma;?>','masv':'<?php echo $masv;?>','name':name,'hocky':hocky,'money':money},function(req){
			console.log(req);
			if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
			else if(req=="success"){
				showMess("Thêm thông tin học phí thành công");
				setTimeout(function(){window.location.reload();},1000);
			}
		});
	})
})
</script>