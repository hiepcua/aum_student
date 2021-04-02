<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.nganh.php');
$obj=new CLS_MYSQL;
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$objng = new CLS_NGANH;

$_KHOA = isset($_SESSION['THIS_KHOA']) ? $_SESSION['THIS_KHOA'] : '';
$_HE = isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
?>
<div class="form-group">
	<label class="col-md-2">Khóa</label>
	<div class="col-md-4">
		<select name="cbo_khoa" id="cbo_khoa" class="form-control" required>
		<?php
		$sql="SELECT * FROM tbl_khoa";
		$obj->Query($sql);
		while($r=$obj->Fetch_Assoc()){ 
		$select=$_KHOA==$r['id']?"selected=true":"";
		?>
		<option <?php echo $select;?> value="<?php echo $r['id'];?>"><?php echo $r['name'];?></option>
		<?php } ?>
		</select>
	</div>
	<label class="col-md-3">Hệ</label>
	<div class="col-md-3">
		<select name="cbo_he" id="cbo_he" class="form-control" required>
		<?php
		$sql="SELECT * FROM tbl_he";
		$obj->Query($sql);
		while($r=$obj->Fetch_Assoc()){
		$select=$_HE==$r['id']?"selected=true":"";
		?>
		<option <?php echo $select;?> value="<?php echo $r['id'];?>"><?php echo $r['name'];?></option>
		<?php } ?>
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-md-2">Ngành</label>
	<div class="col-md-4">
		<select <?php echo $select;?> name="cbo_nganh" id="cbo_nganh" class="form-control" required>
		<?php 
		$sql="SELECT * FROM tbl_nganh";
		$obj->Query($sql);
		while($r=$obj->Fetch_Assoc()){
		$select=$_NGANH==$r['id']?"selected=true":"";
		?>
		<option <?php echo $select;?> value="<?php echo $r['id'];?>"><?php echo $r['name'];?></option>
		<?php } ?>
		</select>
	</div>
	<label class="col-md-3">Số hồ sơ</label>
	<div class="col-md-3">
		<input type="number" name="count_hoso" id="count_hoso" value="0" readonly class="form-control" />
	</div>
</div>
<div class="form-group">
	<label class="col-md-2">Sĩ số/lớp</label>
	<div class="col-md-4">
		<input type="number" id="siso" value="30" min="30" required class="form-control" />
	</div>
	<label class="col-md-3">Số lượng lớp</label>
	<div class="col-md-3">
		<input type="number" id="solop" value="1" min="1" required class="form-control" />
	</div>
</div>
<div class="form-group">
	<label class="col-md-2">Mã Lớp</label>
	<div class="col-md-4">
		<input type="text" id="malop_1" value="" required class="form-control" />
	</div>
	<div class="col-md-3">
		<input type="text" id="malop_2" value="@" required class="form-control" />
	</div>
	<div class="col-md-3">
		<input type="text" id="malop_3" value="K<?php echo date("y");?>" required class="form-control" />
	</div>
</div>
<div class="form-group">
	<label class="col-md-2"></label>
	<div class="col-md-4">Mã ngành</div>
	<div class="col-md-3">Giá trị tự động tăng 1,2,3...</div>
	<div class="col-md-3">Niên khóa</div>
</div>
<div class="form-group"><div class="col-md-12">
	<label class="label label-danger msg_check"></label>
</div></div>
<div class="form-group"><div class="col-md-12 text-right">
	<button type="button" class="btn btn-success btn-save"  title="Phân lớp">
	<i class="fa fa-save"></i> Đồng ý Phân lớp</button>
</div></div>
<div class="clearfix"></div>
<script>
$(document).ready(function(){
	getTotalHS();
	$("#cbo_khoa").change(function(){
		getTotalHS(); 
	})
	$("#cbo_he").change(function(){
		getTotalHS(); 
	})
	$("#cbo_nganh").change(function(){
		$("#malop_1").val($(this).val());
		getTotalHS();
	})
	$("#siso").change(function(){ 
		if($(this).val()>=1) phanlop(); 
		else $(this).focus();
	})
	$("#solop").change(function(){ 
		if($(this).val()>=1) {
			var total = parseInt($("#count_hoso").val());
			var solop = parseInt($(this).val());
			if(siso>total) {
				$(".msg_check").html("Kết quả phân lớp: Số hồ sơ chưa đủ để phân lớp");
				return;
			}
			var siso = Math.ceil(total/solop); // Làm tròn lên; Math.floor (làm tròn xuống)
			$("#siso").val(siso);
			var str = "";
			if(solop>1) {
				var conlai = total-((solop-1)*siso);
				str="Kết quả phân lớp: Có "+(solop-1)+" lớp sĩ số: "+siso+", 1 lớp sĩ số: "+conlai;
			}else str = "Kết quả phân lớp: Có "+solop+" lớp sĩ số: "+siso;
			//console.log(str);
			$(".msg_check").html(str);
		}else $(this).focus();
	})
	$(".btn-save").click(function(){	
		if(checkinput()==true) {
			var siso = $("#siso").val();
			var solop = $("#solop").val();
			var count_hoso = $("#count_hoso").val();
			var malop_1 = $("#malop_1").val();
			var malop_2 = $("#malop_2").val();
			var malop_3 = $("#malop_3").val();
			var nganh = $("#cbo_nganh").val();
			var khoa = $("#cbo_khoa").val();
			var he = $("#cbo_he").val();
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_phanlop.php";
			showLoading();
			$.post(url,{'siso':siso,'solop':solop,'count_hoso':count_hoso,'malop_1':malop_1,'malop_2':malop_2,'malop_3':malop_3,'khoa':khoa,'he':he,'nganh':nganh},function(req){
				debugger;
				console.log(req);
				hideLoading();
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="error1"){
					showMess("Lỗi! Trùng mã lớp. Vui lòng tạo lại mã lớp khác.","error");
				}else if(req=="error2"){
					showMess("Xảy ra lỗi khi cập nhật mã lớp cho hồ sơ!","error");
				}else if(req=="error3"){
					showMess("Xảy ra lỗi khi phân lớp!","error");
				}else{
					showMess("Kết quả phân lớp: Đã phân lớp thành công!");
					setTimeout(function(){ 
						window.location.reload();
					}, 2000);
				}
			})
		} return false;
	})
})
function phanlop(){
	// mã lơp
	var nganh = $("#cbo_nganh").val();
	$("#malop_1").val(nganh);
	
	var total = parseInt($("#count_hoso").val());
	var siso = parseInt($("#siso").val());
	if(siso>total) {
		$(".msg_check").html("Kết quả phân lớp: Số hồ sơ chưa đủ để phân lớp");
		return;
	}
	var solop = Math.ceil(total/siso); // Làm tròn lên; Math.floor (làm tròn xuống)
	
	$("#solop").val(solop);
	$("#solop").attr("max",solop);
	var str = "";
	if(solop>1) {
		var conlai = total-((solop-1)*siso);
		str="Kết quả phân lớp: Có "+(solop-1)+" lớp sĩ số: "+siso+", 1 lớp sĩ số: "+conlai;
	}else str = "Kết quả phân lớp: Có "+solop+" lớp sĩ số: "+siso;
	$(".msg_check").html(str);
}
function getTotalHS(){
	var nganh = $("#cbo_nganh").val();
	var khoa = $("#cbo_khoa").val();
	var he = $("#cbo_he").val();
	var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/get_total_hs.php";
	showLoading();
	$.post(url,{'khoa':khoa,'he':he,'nganh':nganh},function(req){
		hideLoading(); 
		$("#count_hoso").val(req);
		phanlop();
	})
}
function checkinput(){
	var siso = $("#siso").val();
	var malop = $("#malop").val();
	var nganh = $("#cbo_nganh").val();
	if(siso=="") {
		$("#siso").focus();
		$("#siso").addClass('novalid');
		return false;
	}else $("#siso").removeClass('novalid');
	if(malop=="") {
		$("#malop").focus();
		$("#malop").addClass('novalid');
		return false;
	}else $("#malop").removeClass('novalid');
	if(nganh=="") {
		$("#cbo_nganh").focus();
		$("#cbo_nganh").addClass('novalid');
		return false;
	}else $("#cbo_nganh").removeClass('novalid');
	return true;
}
</script>