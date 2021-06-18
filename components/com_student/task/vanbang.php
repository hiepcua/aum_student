<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma_hoso = antiData($_GET['id']);

$cur_khoa = $cur_he = $cur_nganh = '';

$res_khoa = SysGetList('tbl_khoa', array(), "");
$_KHOA=array(); $i = 0;
foreach($res_khoa as $r){
	if($i == 0) $cur_khoa = $r['id'].'-'.$r['name'];
	$_KHOA['K'.$r['id']]=$r['name'];
	$i++;
}
//---------------------------------------
$res_he = SysGetList('tbl_he', array(), "");
$_HE=array(); $i = 0;
foreach($res_he as $r){
	if($i == 0) $cur_he = $r['id'].'-'.$r['name'];
	$_HE['H'.$r['id']]=$r['name'];
	$i++;
}
//---------------------------------------
$res_nganh = SysGetList('tbl_nganh', array(), "");
$_NGANH=array(); $i = 0;
foreach($res_nganh as $r){
	if($i == 0) $cur_nganh = $r['id'].'-'.$r['name'];
	$_NGANH['N'.$r['id']]=$r['name'];
	$i++;
}
//---------------------------------------
$res_lop = SysGetList('tbl_lop', array(), "");
$_LOP=array();
foreach($res_lop as $r){
	$_LOP[$r['id']]=$r['name'];
}
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul><li class="active"><a href="#">Thêm văn bằng</a></li></ul>
				</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>student/profile/<?php echo $ma_hoso;?>" class="btn btn-default btn-close" title="Quay lại"><i class="fa fa-reply"></i> Quay lại trang hồ sơ</a>
				</li>
			</ul>
		</div>
	</div>
	<section class="card" style="position: unset;">
		<div class="card-body">
			<div class="card-block">
				<form name="student_add" id="student_add" class="form" action="#" method="post" enctype='multipart/form-data'>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">Mã hồ sơ <span class="cred">*</span></div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="ma" id="ma" class="form-control" value="<?php echo $ma_hoso;?>" required readonly>
						</div>
						<div class="col-md-2 col-xs-4 text">Mã SV</div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="masv" id="masv" class="form-control"  placeholder="Mã SV">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">Khóa</div>
						<div class="col-md-4 col-xs-8">
							<input list="dskhoa" name="cbokhoa" id="cbokhoa" class="form-control"  placeholder="Chọn khóa">
							<datalist id="dskhoa">
								<?php 
								$res_khoa = SysGetList('tbl_khoa', array(), '');
								if(count($res_khoa)>0){
									foreach ($res_khoa as $key => $value) {
										echo '<option value="'.$value['id'].'-'.$value['name'].'"/>';
									}
								}?>
							</datalist>
						</div>
						<div class="col-md-2 col-xs-4 text">Bậc đào tạo</div>
						<div class="col-md-4 col-xs-8">
							<input list="dsbac" name="cbobac" id="cbobac" class="form-control" placeholder="Chọn bậc đào tạo">
							<datalist id="dsbac">
								<?php 
								$res_khoa = SysGetList('tbl_he', array(), '');
								if(count($res_khoa)>0){
									foreach ($res_khoa as $key => $value) {
										echo '<option value="'.$value['id'].'-'.$value['name'].'"/>';
									}
								}?>
							</datalist>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">Ngành</div>
						<div class="col-md-4 col-xs-8">
							<input list="dsnganh" name="cbonganh" id="cbonganh" class="form-control" placeholder="Chọn ngành">
							<datalist id="dsnganh">
								<?php 
								$res_khoa = SysGetList('tbl_nganh', array(), '');
								if(count($res_khoa)>0){
									foreach ($res_khoa as $key => $value) {
										echo '<option value="'.$value['id'].'-'.$value['name'].'"/>';
									}
								}?>
							</datalist>
						</div>
						<div class="col-md-2 col-xs-4 text">Hệ tốt nghiệp</div>
						<div class="col-md-4 col-xs-8">
							<input list="dshetn" name="hetotnghiep" id="hetotnghiep" class="form-control" placeholder="Chọn hệ tốt nghiệp">
							<datalist id="dshetn">
								<?php foreach($GLOBALS['ARR_HETOTNGHIEP'] as $item) {?>
								<option value="<?php echo $item;?>"/>	
								<?php } ?>								
							</datalist>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">Đợt nhập học</div>
						<div class="col-md-4 col-xs-8">
							<select name="dotnhaphoc" id="dotnhaphoc" class="form-control">
								<?php for($i=1;$i<=7;$i++) { ?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2 col-xs-4 text">Kỳ học</div>
						<div class="col-md-4 col-xs-8">
							<select name="kyhoc" id="kyhoc" class="form-control">
								<?php for($i=1;$i<=9;$i++) { ?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php } ?>
								<option value="10">Kỳ tốt nghiệp</option>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">Lớp</div>
						<div class="col-md-4 col-xs-8">
							<input list="dslop" name="cbolop" id="cbolop" class="form-control" placeholder="Chọn lớp">
							<datalist id="dslop">
								<?php 
								$res_lop = SysGetList('tbl_lop', array(), '');
								if(count($res_lop)>0){
									foreach ($res_lop as $key => $value) {
										echo '<option value="'.$value['id'].'-'.$value['name'].'"/>';
									}
								}?>
							</datalist>
						</div>
						<div class="col-md-2 col-xs-4 text">Người phụ trách</div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="nguoiphutrach" id="nguoiphutrach" class="form-control"/>
						</div>
					</div>
					<hr/>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">BGHS.Ngày BG trường</div>
						<div class="col-md-4 col-xs-8">
							<input type="date" name="ngayBG" id="ngayBG" class="form-control"/>
						</div>
						<div class="col-md-2 col-xs-4 text">BGHS.Tình Trạng BG</div>
						<div class="col-md-4 col-xs-8">
							<input list="dstinhtrangbg" name="tinhtrangBG" id="tinhtrangBG" class="form-control" placeholder="Chọn tình trạng bàn giao">
							<datalist id="dstinhtrangbg">
								<?php foreach($GLOBALS['ARR_TINHTRANG_BG'] as $item) {?>
								<option value="<?php echo $item;?>"/>	
								<?php } ?>								
							</datalist>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">BGHS.Lý do</div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="lydoBG" id="lydoBG" class="form-control"/>
						</div>
					</div>
					<hr/>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">HS.Tình trạng</div>
						<div class="col-md-4 col-xs-8">
							<input list="ds_hstinhtrang" name="HStinhtrang" id="HStinhtrang" class="form-control" placeholder="Tình trạng hồ sơ">
							<datalist id="ds_hstinhtrang">
								<?php foreach($GLOBALS['ARR_HS_TINHTRANG'] as $item) {?>
								<option value="<?php echo $item;?>"/>	
								<?php } ?>								
							</datalist>
						</div>
						<div class="col-md-2 col-xs-4 text"></div>
						<div class="col-md-4 col-xs-8">
						  
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">HS. Vỏ</div>
						<div class="col-md-4 col-xs-8">
							<select name="hsvo" id="hsvo" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-4 text">HS. Ảnh</div>
						<div class="col-md-4 col-xs-8">
							<select name="hsanh" id="hsanh" class="form-control">
								<?php for($i=1;$i<=10;$i++) { ?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">HS. Bằng</div>
						<div class="col-md-4 col-xs-8">
							<select name="hsbang" id="hsbang" class="form-control">
								<?php for($i=1;$i<=8;$i++) { ?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php } ?>
								<option value="0">Thiếu</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-4 text">HS. CN Tốt nghiệp</div>
						<div class="col-md-4 col-xs-8">
							<select name="hscntn" id="hscntn" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">HS. Bảng điểm</div>
						<div class="col-md-4 col-xs-8">
							<select name="hsbangdiem" id="hsbangdiem" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-4 text">HS. Học bạ</div>
						<div class="col-md-4 col-xs-8">
							<select name="hshocba" id="hshocba" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">HS. PĐK</div>
						<div class="col-md-4 col-xs-8">
							<select name="hspdk" id="hspdk" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-4 text">HS. Giấy KS</div>
						<div class="col-md-4 col-xs-8">
							<select name="hsksk" id="hsksk" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">HS. CMT</div>
						<div class="col-md-4 col-xs-8">
							<select name="hscmt" id="hscmt" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-4 text">HS. SYLL</div>
						<div class="col-md-4 col-xs-8">
							<select name="hssyll" id="hssyll" class="form-control">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="0">Thiếu</option>
							</select>
						</div>
					</div>
					<hr/>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">QĐ Trúng Tuyển</div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="qdtrungtuyen" id="qdtrungtuyen" class="form-control">
						</div>
						<div class="col-md-2 col-xs-4 text">Số QĐ công nhận SV</div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="qd_congnhansv" id="qd_congnhansv" class="form-control">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-2 col-xs-4 text">Tình trạng học viên</div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="tinhtranghv" id="tinhtranghv" class="form-control">
						</div>
						<div class="col-md-2 col-xs-4 text">Tình trạng học phí</div>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="tinhtranghp" id="tinhtranghp" class="form-control">
						</div>
					</div>
					<div class="text-center form-group"><br/>
						<button type="button" id="dangky_vanbang" class="btn btn-success"><i class="fa fa-save"></i> Đăng ký văn bằng</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<script>
$(document).ready(function(){
	$("#student_add").validate();
	$("#student_add #dangky_vanbang").click(function(){
		if(checkinput()==true) {
			var url = "<?php echo ROOTHOST;?>ajaxs/student/process_add_vanbang.php";
			$.ajax({
				type: "POST",
				url: url,
				data: $("#student_add").serialize(),
				success: function(req){
					console.log(req);
					if(req == "success") {
						var ma = $("#ma").val();
						showMess("Lưu thông tin đăng ký thành công!",""); 
						setTimeout(function(){ 
							window.location="<?php echo ROOTHOST;?>student/profile/"+ma; 
						}, 2000);
					}else 
						showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				}
			});
		}
	})
})

function checkinput(){
	if($("#ma").val()=="") {
		$("#ma").focus();
		$("#ma").addClass('novalid');
		return false;
	}else {
		$("#ma").removeClass('novalid');
	}
	if($("#masv").val()=="") {
		$("#masv").focus();
		$("#masv").addClass('novalid');
		return false;
	}else {
		$("#masv").removeClass('novalid');
	}
	if($("#cbokhoa").val()=="") {
		$("#cbokhoa").focus();
		$("#cbokhoa").addClass('novalid');
		return false;
	}else {
		$("#cbokhoa").removeClass('novalid');
	}
	if($("#cbobac").val()=="") {
		$("#cbobac").focus();
		$("#cbobac").addClass('novalid');
		return false;
	}else {
		$("#cbobac").removeClass('novalid');
	}
	if($("#cbonganh").val()=="") {
		$("#cbonganh").focus();
		$("#cbonganh").addClass('novalid');
		return false;
	}else {
		$("#cbonganh").removeClass('novalid');
	}
	if($("#nguoiphutrach").val()=="") {
		$("#nguoiphutrach").focus();
		$("#nguoiphutrach").addClass('novalid');
		return false;
	}else {
		$("#nguoiphutrach").removeClass('novalid');
	}
	return true;
}
</script>