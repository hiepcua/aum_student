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

// danh sách hồ sơ đã thi: có sbd, có điểm, chưa xét trúng tuyển
$obj = new CLS_MYSQL;
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.isactive=1 AND sbd<>''
		AND (mon1 >=0 OR mon2>=0 OR mon3>=0)
		AND trungtuyen is null"; 
$ten=isset($_POST['ten'])?addslashes(strip_tags($_POST['ten'])):'';
$cmt=isset($_POST['cmt'])?addslashes(strip_tags($_POST['cmt'])):'';
$ns=isset($_POST['ns'])?addslashes(strip_tags($_POST['ns'])):'';
$dc=isset($_POST['dc'])?addslashes(strip_tags($_POST['dc'])):'';
$nganh=isset($_POST['nganh'])?addslashes(strip_tags($_POST['nganh'])):'';
$sbd=isset($_POST['sbd'])?addslashes(strip_tags($_POST['sbd'])):'';
$diem=isset($_POST['diem'])?(float)$_POST['diem']:'';

if($ten!='') $sql.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($cmt!='') $sql.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $sql.=" AND b.diachi LIKE '%$dc%'";
if($nganh!='') $sql.=" AND a.id_nganh='$nganh'";
if($sbd!='') $sql.=" AND a.sbd LIKE '%$sbd%'";
if($diem!='') $sql.=" AND (mon1+mon2+mon3)>=$diem";
$sql.=" ORDER BY trungtuyen ASC ";
$obj->Query($sql);		//echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." LIMIT $start,".MAX_ROWS);
?>
<table class="list table table-striped table-bordered">
	<thead><tr class="header">
		<th class="text-center">STT</th>
		<th>Họ đệm</th><th>Tên</th>
		<th>Giới tính</th>
		<th class="text-center">Ngày sinh</th>
		<th class="text-center">Ngành</th>
		<th class="text-center">SBD</th>
		<th class="text-center">Môn 1</th>
		<th class="text-center">Môn 2</th>
		<th class="text-center">Môn 3</th>
		<th class="text-center">Tổng</th>
		<th class="text-center">Đạt</th>
		<th class="text-center">Không Đạt</th>
	</tr></thead>
	<tbody>
	<?php $i=1;
	$mon1 =$mon2=$mon3='';
	while($r=$obj->Fetch_Assoc()) { 
	$id_hoso = $r['ma']; $sbd=$r['sbd']; $tongdiem='';
	if(isset($r['mon1']) && $r['mon1']>=0 && $r['mon2']>=0 && $r['mon3']>=0) 
		$mon1 = $r['mon1']; $mon2 = $r['mon2']; $mon3 = $r['mon3'];
		$tongdiem = $r['mon1']+$r['mon2']+$r['mon3'];
	?>
	<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
	
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']);?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['name']);?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/y",$r['ngaysinh']);?></td>
	<td dataid="<?php echo $id_hoso;?>">
		<?php if(isset($r['id_nganh'])) echo $r['id_nganh'];
		else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
	</td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $sbd;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon1;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon2;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon3;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center cred"><b><?php echo $tongdiem;?></b></td>
	<td align="center">
		<?php 
		echo "<a href='javascript:void(0)' dataid='$id_hoso' status='".$r['trungtuyen']."' class='hs_do'>";
		if($r['trungtuyen']==null)
			echo "<i class='fa fa-question-circle cgray' aria-hidden='true'></i>";
		elseif($r['trungtuyen']==1)
			echo "<i class='fa fa-check cgreen' aria-hidden='true'></i>";
		echo "</a>";?>
	</td>
	<td align="center">
		<?php 
		echo "<a href='javascript:void(0)' dataid='$id_hoso' status='".$r['trungtuyen']."' class='hs_truot'>";
		if($r['trungtuyen']==null)
			echo "<i class='fa fa-question-circle cgray' aria-hidden='true'></i>";
		elseif($r['trungtuyen']==0)
			echo "<i class='fa fa-check cred' aria-hidden='true'></i>";
		echo "</a>";?>
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
	$('.hs_do').click(function(){
		var ma = $(this).attr('dataid');
		var status = parseInt($(this).attr('status'));
		console.log(status);
		if(status==1)	XetTrungTuyen(ma,'');
		else XetTrungTuyen(ma,1);
	})
	$('.hs_truot').click(function(){
		var ma = $(this).attr('dataid');
		var status = parseInt($(this).attr('status'));
		console.log(status);
		if(status==0)	XetTrungTuyen(ma,'');
		else XetTrungTuyen(ma,0);
	})
})
function XetTrungTuyen(ma,status) {
	var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_trungtuyen.php";
	$.post(url,{'ma':ma,'status':status},function(req){
		//console.log(req);
		window.location.reload();
	})
}	
</script>