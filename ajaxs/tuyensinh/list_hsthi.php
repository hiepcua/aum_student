<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;

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

// danh sách hồ sơ thi: có sbd, chưa có điểm
$obj = new CLS_MYSQL;
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.isactive=1 and sbd<>''
		AND (mon1 is null OR mon2 is null OR mon3 is null) ";
		
$ten=isset($_POST['ten'])?addslashes(strip_tags($_POST['ten'])):'';
$cmt=isset($_POST['cmt'])?addslashes(strip_tags($_POST['cmt'])):'';
$ns=isset($_POST['ns'])?addslashes(strip_tags($_POST['ns'])):'';
$dc=isset($_POST['dc'])?addslashes(strip_tags($_POST['dc'])):'';
$sbd=isset($_POST['sbd'])?addslashes(strip_tags($_POST['sbd'])):'';
$diem=isset($_POST['diem'])?(float)$_POST['diem']:'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

if($ten!='') $sql.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($cmt!='') $sql.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $sql.=" AND b.diachi LIKE '%$dc%'";
if($sbd!='') $sql.=" AND a.sbd LIKE '%$sbd%'";
if($diem!='') $sql.=" AND (mon1+mon2+mon3)>=$diem";

if($khoa!='') $sql.=" AND a.id_khoa='$khoa'";
if($he!='') $sql.=" AND a.id_he='$he'";
if($nganh!='') $sql.=" AND a.id_nganh='$nganh'";

$obj->Query($sql);	//echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." ORDER BY sbd ASC LIMIT $start,".MAX_ROWS);	
?>
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
	<?php $i=1;
	while($r=$obj->Fetch_Assoc()) { 
		$sbd=$r['sbd']; $phongthi=$r['phongthi']; 
		$id_hoso = $r['ma']; $id_dky = $r['id']; $tongdiem='';
		if(isset($r['mon1']) && $r['mon1']>=0 && $r['mon2']>=0 && $r['mon3']>=0) 
			$tongdiem = $r['mon1']+$r['mon2']+$r['mon3'];
	?>
	<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $id_hoso;?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']);?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/y",$r['ngaysinh']);?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $r['diachi'];?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $r['dienthoai'];?></td>
	<td dataid="<?php echo $id_hoso;?>">
		<?php if(isset($r['id_nganh'])) echo $_NGANH['N'.$r['id_nganh']];
		else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
	</td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $_KHOA['K'.$r['id_khoa']];?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $_HE['H'.$r['id_he']];?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $sbd;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $phongthi;?></td>
	<td class="text-center">
		<input type="number" name="nhap_mon1" class="nhap_mon1 form-control" style="width:100px" min="0" max="10" dataid="<?php echo $id_hoso;?>" datadk="<?php echo $id_dky;?>"/>
	</td>
	<td class="text-center">
		<input type="number" name="nhap_mon2" class="nhap_mon2 form-control" style="width:100px" min="0" max="10" dataid="<?php echo $id_hoso;?>" datadk="<?php echo $id_dky;?>"/>
	</td>
	<td class="text-center">
		<input type="number" name="nhap_mon3" class="nhap_mon3 form-control" style="width:100px" min="0" max="10" dataid="<?php echo $id_hoso;?>" datadk="<?php echo $id_dky;?>"/>
	</td>
	</tr><?php $i++;} ?>
	</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
  <tr><td align="center">
	<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
	</td></tr>
</table>
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