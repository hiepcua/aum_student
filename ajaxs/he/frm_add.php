<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.configsite.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$config=new CLS_CONFIG;$config->getList();
$r_config = $config->Fetch_Assoc();
$thilai = $r_config['thilai'];
$thict = $r_config['thicaithien'];
$hoclai = $r_config['hoclai'];
$hocct = $r_config['hoccaithien'];
?>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Mã bậc đào tạo:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtid" id="txtid" class="form-control" value="" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Tên bậc đào tạo</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtname" id="txtname" class="form-control" value="" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Số học kỳ:</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="txthocky" id="txthocky" class="form-control" value='' required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Học phí(tín chỉ):</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="txthocphi" id="txthocphi" value='' class="form-control money" required>
	</div>
</div>
<div class="row form-group"><hr></div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Lệ phí thi lại/môn</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="txthocphi_thilai" id="txthocphi_thilai" value='<?php echo $thilai;?>' class="form-control money" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Lệ phí thi CT/môn</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="txthocphi_thict" id="txthocphi_thict" value='<?php echo $thict;?>' class="form-control money" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Học phí học lại/tín chỉ</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="txthocphi_hoclai" id="txthocphi_hoclai" value='<?php echo $hoclai;?>' class="form-control money" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Học phí học CT/tín chỉ</div>
	<div class="col-md-6 col-xs-8">
		<input type="number" name="txthocphi_hocct" id="txthocphi_hocct" value='<?php echo $hocct;?>' class="form-control money" required>
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
		var id = $("#txtid").val();
		var name = $("#txtname").val();
		var hocphi = $("#txthocphi").val();
		var hocphi_thilai = $("#txthocphi_thilai").val();
		var hocphi_thict = $("#txthocphi_thict").val();
		var hocphi_hoclai = $("#txthocphi_hoclai").val();
		var hocphi_hocct = $("#txthocphi_hocct").val();
		var hocky = $("#txthocky").val();
		var url = "ajaxs/he/process_add.php";
		if(id!='' && name!=''){
			$.post(url,{'id':id,'name':name,'hocphi':hocphi,'hocphi_thilai':hocphi_thilai,
			'hocphi_thict':hocphi_thict,'hocphi_hoclai':hocphi_hoclai,
			'hocphi_hocct':hocphi_hocct,'hocky':hocky},function(req){
				console.log(req);
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Thêm bậc đào tạo thành công");
					setTimeout(function(){window.location.reload();},1000);
				}
			});
		}
	})
})
</script>