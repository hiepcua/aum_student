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

// danh sách hồ sơ trúng tuyển: trúng tuyển=1, chưa nhập học
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.isactive=1 AND a.trungtuyen=1 AND (a.nhaphoc is null OR a.nhaphoc=0) "; 
$ten=isset($_POST['ten'])?addslashes(strip_tags($_POST['ten'])):'';
$cmt=isset($_POST['cmt'])?addslashes(strip_tags($_POST['cmt'])):'';
$ns=isset($_POST['ns'])?addslashes(strip_tags($_POST['ns'])):'';
$dc=isset($_POST['dc'])?addslashes(strip_tags($_POST['dc'])):'';
$sbd=isset($_POST['sbd'])?addslashes(strip_tags($_POST['sbd'])):'';
$diem=isset($_POST['diem'])?(float)$_POST['diem']:'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$params='';
if($ten!='') {
	$sql.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
	$params.="&ten=$ten";
}
if($cmt!='') {
	$sql.=" AND b.cmt LIKE '%$cmt%'";
	$params.="&cmt=$cmt";
}
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
	$params.="&ns=$ns";
}
if($dc!='') {
	$sql.=" AND b.diachi LIKE '%$dc%'";
	$params.="&dc=$dc";
}
if($nganh!='') {
	$sql.=" AND a.id_nganh='$nganh'";
	$params.="&nganh=$nganh";
}
if($sbd!='') {
	$sql.=" AND a.sbd LIKE '%$sbd%'";
	$params.="&sbd=$sbd";
}
if($khoa!='') $sql.=" AND a.id_khoa='$khoa'";
if($he!='') $sql.=" AND a.id_he='$he'";

$sql .= " ORDER BY a.nhaphoc ASC ";
$obj->Query($sql);		//echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." LIMIT $start,".MAX_ROWS);
$step = '';
?>
<table class="list table table-striped table-bordered">
	<thead><tr class="header">
		<th class="text-center">STT</th>
		<th>Họ tên</th>
		<th class="text-center">Ngày sinh</th>
		<th>Giới tính</th>
		<th>Điện thoại</th>
		<th>Địa chỉ</th>
		<th class="text-center">Ngành</th>
		<th class="text-center">Khóa</th>
		<th class="text-center">Hệ</th>
		<th class="text-center">Loại HS</th>
		<th class="text-center">SBD</th>
		<th class="text-center">Môn 1</th>
		<th class="text-center">Môn 2</th>
		<th class="text-center">Môn 3</th>
		<th class="text-center">Tổng</th>
		<th class="text-center">Kết quả</th>
		<th class="text-center">Hủy kết quả</th>
		<th class="text-center"></th>
	</tr></thead>
	<tbody>
	<?php $i=1;
	$mon1 =$mon2=$mon3='';
	while($r=$obj->Fetch_Assoc()) { 
	$id_hoso = $r['ma']; $sbd=$r['sbd']; $tongdiem='';
	if(isset($r['mon1']) && $r['mon1']>=0 && $r['mon2']>=0 && $r['mon3']>=0) 
		$mon1 = $r['mon1']; $mon2 = $r['mon2']; $mon3 = $r['mon3'];
		$tongdiem = $r['mon1']+$r['mon2']+$r['mon3'];
		$loaiHs	= $r['xettuyen']==1?"Xét tuyển":'';
	?>
	<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
			
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']); ?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/Y",$r['ngaysinh']);?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-left"><?php echo $r['dienthoai'];?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-left"><?php echo $r['diachi'];?></td>
	<td><?php echo $_NGANH['N'.$r['id_nganh']];?></td>
	<td><?php echo $_KHOA['K'.$r['id_khoa']];?></td>
	<td><?php echo $_HE['H'.$r['id_he']];?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $loaiHs;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $sbd;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon1;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon2;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon3;?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center cred"><b><?php echo $tongdiem;?></b></td>
	<td align="center">Trúng tuyển</td>
	<td align="center">
		<button class='btn btn-danger hs_huy_do' dataid='<?php echo $id_hoso;?>'>Hủy</button>
	</td>
	<td align="center">
		<button class='btn btn-success btn-nhaphoc' onclick="NhapHoc('<?php echo $id_hoso;?>',1);">Nhập học</button>
	</td><?php $i++;} ?>
	</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
  <tr><td align="center">
	<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
	</td></tr>
</table>
<script>
$(document).ready(function(){
	$('.hs_huy_do').click(function(){
		if(confirm('Bạn chắc hủy trúng tuyển?')){
			var ma = $(this).attr('dataid');
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_trungtuyen.php";
			$.post(url,{'ma':ma,'status':0},function(req){
				window.location.reload();
			})
		}
	})
	$(".btn-excel").click(function(){
		showLoading(); 
		link="<?php echo ROOTHOST;?>excel/export_hstrungtuyen.php?<?php echo $params;?>";
		$.get(link,function(req){
			hideLoading();
			if(req=="E01") showMess('Vui lòng đăng nhập hệ thống.');
			else if(req=="empty") showMess('Dữ liệu trống.');
			else {
				str='<a href="<?php echo ROOTHOST;?>excel/cache/download.php?file='+req+'">Download link tại đây</a>';
				showMess(str);
			}
		})
	})
})
function NhapHoc(ma,status) {
	window.location='<?php echo ROOTHOST;?>?com=student&task=confirm_nhaphoc&ma='+ma;
}	
</script>