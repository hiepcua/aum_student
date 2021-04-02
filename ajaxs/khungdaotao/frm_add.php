<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj=new CLS_MYSQL;
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$_HE = isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$sql="SELECT * FROM tbl_he WHERE id='$_HE'";
$obj->Query($sql);
$r=$obj->Fetch_Assoc();
$sohocky=$r['sohocky'];
?>
<div class="row form-group">
	<div class="col-md-3 col-xs-3 text"><label>Ngành đào tạo</label></div>
	<div class="col-md-6 col-xs-9"><select id='dm_nganh' name='nganh' class='form-control'>
		<option value=''>Chọn ngành</option>
		<?php $sql="SELECT * FROM tbl_nganh";
		$obj=new CLS_MYSQL;
		$obj->Query($sql); $arrNganh=array();
		while($r_nganh=$obj->Fetch_Assoc()){
			$id=stripslashes($r_nganh['id']);
			$name=stripslashes($r_nganh['name']);
			$arrNganh[$id]=$name;
			$select=$_NGANH==$id?"selected=true":'';
			echo "<option $select value='$id'>$name</option>";
		}
		?>
	</select></div>
</div></div>
<div class="row form-group">
	<div class="col-md-3 col-xs-3 text"><label>Bậc đào tạo</label></div>
	<div class="col-md-6 col-xs-9"><select id='dm_he' name='he' class='form-control'>
		<option value=''>Chọn bậc đào tạo</option>
		<?php $sql="SELECT * FROM tbl_he";
		$obj=new CLS_MYSQL;
		$obj->Query($sql); $arrHe=array();
		while($r_he=$obj->Fetch_Assoc()){
			$id=stripslashes($r_he['id']);
			$name=stripslashes($r_he['name']);
			$arrHe[$id]=$name;
			$select=$_HE==$id?"selected=true":'';
			echo "<option $select value='$id'>$name</option>";
		}
		?>
	</select></div>
</div>
<div class="row form-group">
	<div class="col-md-6 col-xs-6">
		<label>Học phần:</label>
		<select id='cbo_monhoc' name='monhoc' class='form-control'>
		<option value=''>Chọn học phần</option>
		</select>
	</div>
	<div class="col-md-6 col-xs-6">
		<label>Tín chỉ:</label>
		<input type="number" name="txttinchi" id="txttinchi" class="form-control text-center" value="3" required>
	</div>
</div>
<div class="row form-group">
	
	<div class="col-md-3 col-xs-3">
		<label>% Chuyên cần:</label>
		<input type="number" name="txtchuyencan" id="txtchuyencan" class="form-control text-center" value="20" required>
	</div>
	<div class="col-md-3 col-xs-3">
		<label>% Kiểm tra:</label>
		<input type="number" name="txtkiemtra" id="txtkiemtra" class="form-control text-center" value="30" required>
	</div>
	<div class="col-md-3 col-xs-3"><div class='row'>
		<label>% Thi:</label>
		<input type="number" name="txtthi" id="txtthi" class="form-control text-center" value="50" required>
	</div></div>
	<div class="col-md-3 col-xs-3">
		<label>Điểm đạt từ:</label>
		<input type="number" name="txttong" id="txttong" class="form-control text-center" value="4" required>
	</div>
</div>
<div class="row form-group text-center">
	<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Lưu</button>
	<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
</div>
<div class="clearfix"></div>
<script>
$(document).ready(function(){
	getCboHocphan();
	$('#dm_nganh').change(function(){
		getCboHocphan();
	})
	$('#dm_he').change(function(){
		var url = "<?php echo ROOTHOST;?>ajaxs/he/getSohocky.php";
		$.post(url,{'id':$(this).val()},function(req){
			$("#txthocky").html(req);
		});
		getCboHocphan();
	})
	$('#txttinchi').change(function(){
		$('#txtlythuyet').val($(this).val());
		$('#txtthuchanh').val(0);	
	});
	$("#btnsave").click(function(){
		var nganh = $("#dm_nganh").val();
		var he = $("#dm_he").val();
		var monhoc = $("#cbo_monhoc").val();
		var hocky = $("#txthocky").val();
		var tinchi = $("#txttinchi").val();
		var chuyencan = $("#txtchuyencan").val();
		var kiemtra = $("#txtkiemtra").val();
		var thi = $("#txtthi").val();
		var tong = $("#txttong").val();
		
		if(check_input()==true) {
			var url = "ajaxs/khungdaotao/process_add.php";
			if(monhoc!='' && nganh!=''){
				$.post(url,{'monhoc':monhoc,'nganh':nganh,'he':he,'hocky':hocky,'tinchi':tinchi,'chuyencan':chuyencan,'kiemtra':kiemtra,'thi':thi,'tong':tong},function(req){
					console.log(req);
					if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
					else if(req=="success"){
						showMess("Thêm học phần thành công");
						setTimeout(function(){window.location.reload();},1000);
					}
				});
			}
		}
	})
})
function getCboHocphan(){
	var url='<?php echo ROOTHOST;?>ajaxs/monhoc/getcboHocphan.php';
	var nganh=$('#dm_nganh').val();
	var he=$('#dm_he').val();
	$.get(url,{'nganh':nganh,'he':he},function(req){
		// console.log(req);
		$('#cbo_monhoc').html(req);
	});
}
function check_input() {
	var nganh = $("#dm_nganh").val();
	var he = $("#dm_he").val();
	var monhoc = $("#cbo_monhoc").val();
	var hocky = $("#txthocky").val();
	var tinchi = $("#txttinchi").val();
	var chuyencan = $("#txtchuyencan").val();
	var kiemtra = $("#txtkiemtra").val();
	var thi = $("#txtthi").val();
	var tong = $("#txttong").val();
	
	if(nganh=="") {
		$("#dm_nganh").addClass('novalid');
		return false;
	}else $("#dm_nganh").removeClass('novalid');
	if(he=="") {
		$("#dm_he").addClass('novalid');
		return false;
	}else $("#dm_he").removeClass('novalid');
	if(monhoc=="") {
		$("#cbo_monhoc").addClass('novalid');
		return false;
	}else $("#cbo_monhoc").removeClass('novalid');
	if(hocky=="") {
		$("#txthocky").addClass('novalid');
		return false;
	}else $("#txthocky").removeClass('novalid');
	
	if(tinchi=="") {
		$("#txttinchi").focus();
		$("#txttinchi").addClass('novalid');
		return false;
	}else if($.isNumeric(tinchi)==false){
		alert("Số tín chỉ phải là kiểu số!");
		$("#txttinchi").focus(); 
		$("#txttinchi").addClass('novalid');
		return false;
	}else $("#txttinchi").removeClass('novalid');
	
	if(chuyencan=="") {
		$("#txtchuyencan").focus();
		$("#txtchuyencan").addClass('novalid');
		return false;
	}else if($.isNumeric(chuyencan)==false){
		alert("Chuyên cần phải là kiểu số!");
		$("#txtchuyencan").focus(); 
		$("#txtchuyencan").addClass('novalid');
		return false;
	}else $("#txtchuyencan").removeClass('novalid');
	
	if(kiemtra=="") {
		$("#txtkiemtra").focus();
		$("#txtkiemtra").addClass('novalid');
		return false;
	}else if($.isNumeric(kiemtra)==false){
		alert("Kiểm tra phải là kiểu số!");
		$("#txtkiemtra").focus(); 
		$("#txtkiemtra").addClass('novalid');
		return false;
	}else $("#txtkiemtra").removeClass('novalid');
	
	if(thi=="") {
		$("#txtthi").focus();
		$("#txtthi").addClass('novalid');
		return false;
	}else if($.isNumeric(thi)==false){
		alert("Thi phải là kiểu số!");
		$("#txtthi").focus(); 
		$("#txtthi").addClass('novalid');
		return false;
	}else $("#txtthi").removeClass('novalid');
	
	var rate = parseFloat(chuyencan)+parseFloat(kiemtra)+parseFloat(thi);
	if(rate!=100) {
		$("#txtchuyencan").addClass('novalid');
		$("#txtkiemtra").addClass('novalid');
		$("#txtthi").addClass('novalid');
		alert("% Chuyên cần + % Kiểm tra + % Thi phải bằng 100%");
		return false;
	}
	var so = parseFloat(tong);
	if(tong=="") {
		$("#txttong").focus();
		$("#txttong").addClass('novalid');
		return false;
	}else if($.isNumeric(tong)==false){
		alert("Điểm đạt phải là kiểu số");
		$("#txttong").focus(); 
		$("#txttong").addClass('novalid');
		return false;
	}else if(so>10 || so<0) {
		alert("Tổng đạt phải là kiểu số thang điểm 10!");
		$("#txttong").focus(); 
		$("#txttong").addClass('novalid');
		return false;
	}else $("#txttong").removeClass('novalid');
	
	return true;
}
</script>