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
$id_hocphi = isset($_POST['id'])?addslashes(htmlentities(strip_tags($_POST['id']))):'0';
$nganh = isset($_POST['nganh'])?addslashes(htmlentities(strip_tags($_POST['nganh']))):'0';
$he = isset($_POST['he'])?addslashes(htmlentities(strip_tags($_POST['he']))):'0';
$sql="SELECT * FROM tbl_dmhocphi WHERE id='$id_hocphi'";
$obj=new CLS_MYSQL;
$obj->Query($sql);
if($obj->Num_rows()!=1) die('Bản ghi không tồn tại');
else{
	$r=$obj->Fetch_Assoc(); $all=$r['all'];
?>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Ngành đào tạo</div>
	<div class="col-md-6 col-xs-8"><select id='dm_nganh' name='nganh' class='form-control' readonly>
		<option value=''>Tất cả</option>
	</select></div>
</div></div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Bậc đào tạo</div>
	<div class="col-md-6 col-xs-8"><select id='dm_he' name='he' class='form-control' readonly>
		<option value=''>Tất cả</option>
	</select></div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Tên danh mục:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txtname" id="txtname" class="form-control" value="<?php echo $r['name'];?>" required>
	</div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Học phí:</div>
	<div class="col-md-6 col-xs-8">
		<input type="text" name="txthocphi" id="txthocphi" class="form-control" value="<?php echo $r['hocphi'];?>" required>
	</div>
</div>
<div class="row form-group text-center">
	<input type="hidden" name="txtid" id="txtid" value="<?php echo $id_hocphi;?>"/>
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
		if(name=="") {
			$("#txtname").focus(); 
			$("#txtname").addClass('novalid');
			return false;
		}else $("#txtname").removeClass('novalid');
		if(hocphi=="") {
			$("#txthocphi").focus(); 
			$("#txthocphi").addClass('novalid');
			return false;
		}else if($.isNumeric(hocphi)==false){
			alert("Học phí phải là kiểu số!");
			$("#txthocphi").focus(); 
			$("#txthocphi").addClass('novalid');
			return false;
		}else $("#txthocphi").removeClass('novalid');
		
		var url = "ajaxs/dmhocphi/process_edit_config.php";
		if(id!='' && name!=''){
			$.post(url,{'id':id,'name':name,'hocphi':hocphi},function(req){
				console.log(req);
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Sửa danh mục thành công");
					setTimeout(function(){window.location.reload();},500);
				}
			});
		}
	})
})
</script>
<?php }?>