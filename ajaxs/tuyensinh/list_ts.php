<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.nganh.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;

// danh sách hồ sơ mới: chưa thi, chưa trúng tuyển
$obj = new CLS_MYSQL;
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.city,c.name as city_name, b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		INNER JOIN tbl_city AS c ON b.city=c.id
		WHERE a.xettuyen=0 AND (sbd='' OR sbd is null) ";

$ma=isset($_POST['ma'])?addslashes(strip_tags($_POST['ma'])):'';
$ten=isset($_POST['ten'])?addslashes(strip_tags($_POST['ten'])):'';
$cmt=isset($_POST['cmt'])?addslashes(strip_tags($_POST['cmt'])):'';
$ns=isset($_POST['ns'])?addslashes(strip_tags($_POST['ns'])):'';
$dc=isset($_POST['dc'])?addslashes(strip_tags($_POST['dc'])):'';
$khoa=isset($_POST['khoa'])?addslashes(strip_tags($_POST['khoa'])):'';
$nganh=isset($_POST['nganh'])?addslashes(strip_tags($_POST['nganh'])):'';

if($ma!='') $sql.=" AND b.ma LIKE '%$ma%'";
if($ten!='') $sql.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($cmt!='') $sql.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $sql.=" AND b.city LIKE '%$dc%'";
if($nganh!='') $sql.=" AND a.id_nganh='$nganh'";
if($khoa!='') $sql.=" AND a.id_khoa='$khoa'";

$obj->Query($sql);	//echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." ORDER BY b.id DESC LIMIT $start,".MAX_ROWS);
?>
<table class="list table table-striped table-bordered">
	<thead><tr class="header">
		<th class="text-center">STT</th>
		<th class="text-center">Mã hồ sơ</th>
		<th>Họ đệm</th><th>Tên</th>
		<th>Giới tính</th>
		<th class="text-center">Ngày sinh</th>
		<th>Tỉnh/thành</th>
		<th class="text-center">Ngành</th>
		<th class="text-center">SBD</th>
		<th class="text-center">Đạt</th>
		<th class="text-center">Không Đạt</th>
	</tr></thead>
	<tbody>
	<?php  $i=1; 
	while($r=$obj->Fetch_Assoc()) { 
	$id_hoso = $r['ma']; $sbd=$r['sbd']; $objng = new CLS_NGANH;
	?>
	<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
	<td dataid="<?php echo $id_hoso;?>"class="text-center"><?php echo $id_hoso;?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']);?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['name']);?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/y",$r['ngaysinh']);?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $r['city_name'];?></td>
	<td dataid="<?php echo $id_hoso;?>">
		<?php if(isset($r['id_nganh'])) echo $objng->getName($r['id_nganh']);
		else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
	</td>
	<td dataid="<?php echo $id_hoso;?>">
		<?php if($r['id_nganh']!='') {?>
		<input type="text" name="nhap_sbd" class="nhap_sbd form-control" dataid="<?php echo $id_hoso;?>" style="width:100px"/>
		<?php } ?>
	</td>
	<td align="center">
		<?php if($r['id_nganh']!='') {
		echo "<a href='javascript:void(0)' dataid='$id_hoso' status='".$r['trungtuyen']."' class='hs_do'>";
		if($r['trungtuyen']==null)
			echo "<i class='fa fa-question-circle cgray' aria-hidden='true'></i>";
		elseif($r['trungtuyen']==1)
			echo "<i class='fa fa-check cgreen' aria-hidden='true'></i>";
		echo "</a>";
		} ?>
	</td>
	<td align="center">
		<?php if($r['id_nganh']!='') {
		echo "<a href='javascript:void(0)' dataid='$id_hoso' status='".$r['trungtuyen']."' class='hs_truot'>";
		if($r['trungtuyen']==null)
			echo "<i class='fa fa-question-circle cgray' aria-hidden='true'></i>";
		elseif($r['trungtuyen']==0)
			echo "<i class='fa fa-check cred' aria-hidden='true'></i>";
		echo "</a>";
		} ?>
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
	$(".dk_nganh").click(function(){
		var ma = $(this).attr('dataid');
		frm_dangky(ma);
	})
	$(".nhap_sbd").keyup(function(e){
		if(e.which==13) {
			if($(this).val()=="") {
				$(this).focus(); $(this).addClass('novalid');
			}else {
				$(this).removeClass('novalid');
				var sbd=$(this).val();
				var ma=$(this).attr('dataid');
				var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_sbd.php";
				$.post(url,{'sbd':sbd,'ma':ma},function(req){
					//console.log(req);
					window.location.reload();
				})
			}
		}
	})
	$('.hs_do').click(function(){
		var ma = $(this).attr('dataid');
		var status = parseInt($(this).attr('status'));
		if(status==1)	XetTrungTuyen(ma,'');
		else XetTrungTuyen(ma,1);
	})
	$('.hs_truot').click(function(){
		var ma = $(this).attr('dataid');
		var status = parseInt($(this).attr('status'));
		if(status==0)	XetTrungTuyen(ma,'');
		else XetTrungTuyen(ma,0);
	})
})
function XetTrungTuyen(ma,status) {
	var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_trungtuyen.php";
	$.post(url,{'ma':ma,'status':status},function(req){
		console.log(req);
		//window.location.reload();
	})
}	
</script>