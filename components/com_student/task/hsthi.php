<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_hsthi');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);
$obj = new CLS_MYSQL;
//---------------------------------------
$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$_HE=array();
while($r=$obj->Fetch_Assoc()){
	$_HE['H'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH['N'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_khoa";
$obj->Query($sql);
$_KHOA=array();
while($r=$obj->Fetch_Assoc()){
	$_KHOA['K'.$r['id']]=$r['name'];
}
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$sbd=isset($_GET['sbd'])?addslashes(strip_tags($_GET['sbd'])):'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$strWhere=" AND (a.sbd!='' AND a.sbd is not null) AND (a.mon1='' OR a.mon1 is null)";
if($ten!='') $strWhere.=" AND (b.name LIKE '%$ten%' OR b.nickname LIKE '%$ten%')";
if($cmt!='') $strWhere.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$strWhere.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $strWhere.=" AND b.diachi LIKE '%$dc%'";
if($sbd!='') $strWhere.=" AND a.sbd LIKE '%$sbd%'";
if($khoa!='') $strWhere.=" AND a.id_khoa='$khoa'";
if($he!='') $strWhere.=" AND a.id_he='$he'";
if($nganh!='') $strWhere.=" AND a.id_nganh='$nganh'";

$xettuyen = 0; $step = 3;
$sql="SELECT count(*) as num FROM tbl_dangky_tuyensinh AS a INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
WHERE a.xettuyen=$xettuyen $strWhere";
$obj->Query($sql);
$r=$obj->Fetch_Assoc();
$total_rows=$r['num'];		
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Hồ sơ thi</div>
			</div>
		</div>
	</div>
	<div class="customer_list">
		<?php include("search_hsthi.php");?>
        <div id="contextMenu" class="dropdown clearfix">
			<input type="hidden" id="right_click_id" value=""/>
			<input type="hidden" id="right_click_ids" value=""/>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
			  <li><a tabindex="-1" href="javascript:void(0)" class="view_profile">Hồ sơ chi tiết</a></li>
			  <li><a tabindex="-1" href="javascript:void(0)" class="nhapdiem">Nhập điểm</a></li>
			  <li><a tabindex="-1" href="javascript:void(0)">Xóa hồ sơ hiện tại</a></li>
			</ul>
        </div>
		<div id="list_profile" class="table-responsive">
		<table class="list table table-striped table-bordered">
			<thead><tr class="header">
				<th class="text-center">STT</th>
				<th class="text-center">Mã hồ sơ</th>
				<th>Họ đệm</th>
				<th class="text-center">Ngày sinh</th>
				<th>Giới tính</th>
				<th>Địa chỉ</th>
				<th>Điện thoại</th>
				<th class="text-center">Ngành</th>
				<th class="text-center">Khóa</th>
				<th class="text-center">Hệ</th>
				<th class="text-center">SBD</th>
				<th class="text-center">Phòng thi</th>
				<th class="text-center">Môn 1</th>
				<th class="text-center">Môn 2</th>
				<th class="text-center">Môn 3</th>
			</tr></thead>
			<tbody>
			<?php  
			$MAX_ROWS=MAX_ROWS;
			$start=0; if($cur_page>1) $start = ($cur_page-1)*$MAX_ROWS;
			$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
				FROM tbl_dangky_tuyensinh AS a 
				INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
				WHERE a.xettuyen=0 $strWhere";
			$sql .= " ORDER BY a.nhaphoc ASC ";
			//echo $sql;
			$i=$start; 
			$obj->Query($sql);
			while($r=$obj->Fetch_Assoc()) { 
			$i++;
			$id_hoso = $r['ma']; $id_dky = $r['id'];
			$dataids = $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];
			?>
			<tr dataid="<?php echo $id_hoso;?>" dataids="<?php echo $dataids;?>">
			<td align="center"><?php echo $i;?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo $id_hoso;?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']);?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/Y",$r['ngaysinh']);?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo $r['diachi'];?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo $r['dienthoai'];?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo $_NGANH['N'.$r['id_nganh']];?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo $_KHOA['K'.$r['id_khoa']];?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo $_HE['H'.$r['id_he']];?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $r['sbd'];?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $r['phongthi'];?></td>
			<td class="text-center">
				<input type="number" name="nhap_mon1" class="nhap_mon1 form-control" style="width:100px" min="0" max="10" dataid="<?php echo $id_hoso;?>" datadk="<?php echo $id_dky;?>"/>
			</td>
			<td class="text-center">
				<input type="number" name="nhap_mon2" class="nhap_mon2 form-control" style="width:100px" min="0" max="10" dataid="<?php echo $id_hoso;?>" datadk="<?php echo $id_dky;?>"/>
			</td>
			<td class="text-center">
				<input type="number" name="nhap_mon3" class="nhap_mon3 form-control" style="width:100px" min="0" max="10" dataid="<?php echo $id_hoso;?>" datadk="<?php echo $id_dky;?>"/>
			</td>
			</tr><?php } ?>
			</tbody>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
			<tr><td align="center">
			<?php  paging($total_rows,$MAX_ROWS,$cur_page); ?>
			</td></tr>
		</table>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".nhap_mon1").keyup(function(e){
		if(e.which==13) {
			if($(this).val()=="") {
				$(this).focus(); $(this).addClass('novalid');
			}else {
				$(this).removeClass('novalid');
				var ma=$(this).attr('dataid');
				var id_dky=$(this).attr('datadk');
				var mon1=parseFloat($(this).val());
				var mon2=parseFloat($(this).parent().parent().find(".nhap_mon2").val());
				var mon3=parseFloat($(this).parent().parent().find(".nhap_mon3").val());
				
				if(mon1<0 || mon1>10 || mon1=="NaN") {
					$(this).focus(); $(this).addClass('novalid');
					return;
				}
				if(mon2<0 || mon2>10 || mon2=="NaN") {
					$(this).parent().parent().find(".nhap_mon2").focus();
					$(this).parent().parent().find(".nhap_mon2").addClass('novalid');
					return;
				}
				if(mon3<0 || mon3>10 || mon3=="NaN") {
					$(this).parent().parent().find(".nhap_mon3").focus();
					$(this).parent().parent().find(".nhap_mon3").addClass('novalid');
					return;
				}
				if(mon1!="" && mon2!="" && mon3!="")
					luu_diem(ma,id_dky,mon1,mon2,mon3);
			}
		}
	})
	$(".nhap_mon2").keyup(function(e){
		if(e.which==13) {
			if($(this).val()=="") {
				$(this).focus(); $(this).addClass('novalid');
			}else {
				$(this).removeClass('novalid');
				var ma=$(this).attr('dataid');
				var id_dky=$(this).attr('datadk');
				var mon1=$(this).parent().parent().find(".nhap_mon1").val();
				var mon2=$(this).val();
				var mon3=$(this).parent().parent().find(".nhap_mon3").val();
				if(mon1<0 || mon1>10 || mon1=="NaN") {
					$(this).parent().parent().find(".nhap_mon1").focus();
					$(this).parent().parent().find(".nhap_mon1").addClass('novalid');
					return;
				}
				if(mon2<0 || mon2>10 || mon2=="NaN") {
					$(this).focus(); $(this).addClass('novalid');
					return;
				}
				if(mon3<0 || mon3>10 || mon3=="NaN") {
					$(this).parent().parent().find(".nhap_mon3").focus();
					$(this).parent().parent().find(".nhap_mon3").addClass('novalid');
					return;
				}
				if(mon1!="" && mon2!="" && mon3!="")
					luu_diem(ma,id_dky,mon1,mon2,mon3);
			}
		}
	})
	$(".nhap_mon3").keyup(function(e){
		if(e.which==13) {
			if($(this).val()=="") {
				$(this).focus(); $(this).addClass('novalid');
			}else {
				$(this).removeClass('novalid');
				var ma=$(this).attr('dataid');
				var id_dky=$(this).attr('datadk');
				var mon1=$(this).parent().parent().find(".nhap_mon1").val();
				var mon2=$(this).parent().parent().find(".nhap_mon2").val();
				var mon3=$(this).val();
				if(mon1<0 || mon1>10 || mon1=="NaN") {
					$(this).parent().parent().find(".nhap_mon1").focus();
					$(this).parent().parent().find(".nhap_mon1").addClass('novalid');
					return;
				}
				if(mon2<0 || mon2>10 || mon2=="NaN") {
					$(this).parent().parent().find(".nhap_mon2").focus();
					$(this).parent().parent().find(".nhap_mon2").addClass('novalid');
					return;
				}
				if(mon3<0 || mon3>10 || mon3=="NaN") {
					$(this).focus(); $(this).addClass('novalid');
					return;
				}
				if(mon1!="" && mon2!="" && mon3!="")
					luu_diem(ma,id_dky,mon1,mon2,mon3);
			}
		}
	})
})
function luu_diem(ma,id_dky,mon1,mon2,mon3){
	var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_diem.php";
	$.post(url,{'id_hoso':ma,'id_dky':id_dky,'mon1':mon1,'mon2':mon2,'mon3':mon3},function(req){
		//console.log(req);
		window.location.reload();
	})
}
</script>