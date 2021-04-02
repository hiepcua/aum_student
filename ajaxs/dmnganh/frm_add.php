<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
?>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Mã ngành QL:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtid" id="txtid" class="form-control" value="" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Mã ngành của Bộ:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtid_bo" id="txtid_bo" class="form-control" value="">
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Tên ngành:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtname" id="txtname" class="form-control" value="" required>
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
		var id_bo = $("#txtid_bo").val();
		var name = $("#txtname").val();
		var url = "ajaxs/dmnganh/process_add.php";
		if(id=="") {
			$("#txtid").focus(); return false;
		}if(id!=''){
			$.post(url,{'id':id,'id_bo':id_bo,'name':name},function(req){
				console.log(req);
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Thêm ngành thành công");
					setTimeout(function(){window.location.reload();},1000);
				}else showMess("Lỗi","error");
			});
		}
	})
})
</script>