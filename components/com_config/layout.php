<?php
define('COMS','config');

$check_permission = $UserLogin->Permission(COMS);
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$title=$company=''; $thilai=$thict=$hoclai=$hocct=0;
$hoccd=$bvluanvan=$chuanth=$chuanta=$thilaitn=0;
include_once('libs/cls.configsite.php');
$obj = new CLS_CONFIG();
if(isset($_POST['web_title']) && $_POST['web_title']!='') {
	if($_POST['company_name']!='')  $obj->CompanyName = addslashes(strip_tags($_POST['company_name']));
	if($_POST['web_title']!='')     $obj->Title = addslashes(strip_tags($_POST['web_title']));
	if($_POST['thilai']!='')      	$obj->Thilai = (int)$_POST['thilai'];
	if($_POST['thict']!='')      	$obj->ThiCT = (int)$_POST['thict'];
	if($_POST['hoclai']!='')      	$obj->Hoclai = (int)$_POST['hoclai'];
	if($_POST['hocct']!='')      	$obj->HocCT = (int)$_POST['hocct'];
	if($_POST['hoccd']!='')      	$obj->HocCD = (int)$_POST['hoccd'];
	if($_POST['bvluanvan']!='')     $obj->BVluanvan = (int)$_POST['bvluanvan'];
	if($_POST['chuanth']!='')      	$obj->ChuanTH = (int)$_POST['chuanth'];
	if($_POST['chuanta']!='')      	$obj->ChuanTA = (int)$_POST['chuanta'];
	if($_POST['thilaitn']!='')      $obj->ThilaiTN = (int)$_POST['thilaitn'];
	$obj->Update();
	echo '<script>alert("Cập nhật thành công")</script>';
}    
$obj->getList();
if($obj->Num_rows()<=0) {
	echo 'Dữ liệu trống.';
}
else{
	$row = $obj->Fetch_Assoc();
	$title          = stripslashes($row['title']);
	$company_name   = stripslashes($row['company_name']);
	$thilai         = $row['thilai'];
	$thict          = $row['thicaithien'];
	$hoclai         = $row['hoclai'];
	$hocct          = $row['hoccaithien'];
	$hoccd          = $row['hocchuyendoi'];
	$bvluanvan      = $row['bvluanvan'];
	$chuanth        = $row['chuantinhoc'];
	$chuanta        = $row['chuantienganh'];
	$thilaitn       = $row['thilaitotnghiep'];
}
unset($obj);
?>
<div class="com_header color">
	<i class="fa fa-cog" aria-hidden="true"></i> CẤU HÌNH HỆ THỐNG
	<div class="pull-right">
		<form id="frm_menu" name="frm_menu" method="post" action="">
			<input type="hidden" name="txtorders" id="txtorders" />
			<input type="hidden" name="txtids" id="txtids" />
			<input type="hidden" name="txtaction" id="txtaction" />

			<ul class="list-inline">
				<li><a class="save btn btn-default" href="#" onclick="dosubmitAction('frm_action','save');" title="Lưu"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</a></li>

				<li><a class="btn btn-default"  href="<?php echo ROOTHOST_ADMIN;?>" title="Đóng"><i class="fa fa-sign-out" aria-hidden="true"></i> Đóng</a></li>
			</ul>
		</form>
	</div>
</div><br>
<div id='action' class="col-md-12" style="background-color:#fff; padding:20px">
	<form name="frm_action" id="frm_action" action="" method="post">
		<div><b>THÔNG TIN TỔ CHỨC</b></div><hr size="1" style="margin:10px 0 20px;">
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Tên tổ chức<font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="text" name="web_title" class="form-control" id="web_title" value="<?php echo $title;?>" placeholder="">
				<div id="txt_name_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Địa chỉ <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="text" name="company_name" class="form-control" value="<?php echo $company_name;?>" placeholder="">
				<div id="txt_company_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div><b>CẤU HÌNH CHUNG</b></div><hr size="1" style="margin:10px 0 20px;">
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Lệ phí thi lại / môn <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="thilai" class="form-control" id="thilai" value="<?php echo $thilai;?>" placeholder="">
				<div id="txt_thilai_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Lệ phí thi cải thiện / môn <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="thict" class="form-control" id="thict" value="<?php echo $thict;?>" placeholder="">
				<div id="txt_thict_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Học phí học lại / tín chỉ <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="hoclai" class="form-control" id="hoclai" value="<?php echo $hoclai;?>" placeholder="">
				<div id="txt_hoclai_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Học phí học cải thiện / tín chỉ <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="hocct" class="form-control" id="hocct" value="<?php echo $hocct;?>" placeholder="">
				<div id="txt_hocct_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Lệ phí học chuyển đổi / môn <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="hoccd" class="form-control" id="hoccd" value="<?php echo $hoccd;?>" placeholder="">
				<div id="txt_hocct_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Lệ phí thi lại tốt nghiệp / môn <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="thilaitn" class="form-control" id="thilaitn" value="<?php echo $thilaitn;?>" placeholder="">
				<div id="txt_hocct_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<hr size="1" style="margin:10px 0 20px;">
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Lệ phí bảo vệ luận văn tốt nghiệp <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="bvluanvan" class="form-control" id="bvluanvan" value="<?php echo $bvluanvan;?>" placeholder="">
				<div id="txt_hocct_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Lệ phí chuẩn đầu ra tin học <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="chuanth" class="form-control" id="chuanth" value="<?php echo $chuanth;?>" placeholder="">
				<div id="txt_hocct_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group">
			<div class="col-md-3 col-xs-12">Lệ phí chuẩn đầu ra ngoại ngữ <font color="red">*</font></div>
			<div class="col-md-6 col-xs-12">
				<input type="number" name="chuanta" class="form-control" id="chuanta" value="<?php echo $chuanta;?>" placeholder="">
				<div id="txt_hocct_err" class="mes-error"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
	</form>
</div>
<script>
function checkinput() {return true;}
</script>