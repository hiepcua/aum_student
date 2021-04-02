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
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.isactive=1 and a.masv<>'' AND trungtuyen=1 AND nhaphoc=1"; 
$ten=isset($_POST['ten'])?addslashes(strip_tags($_POST['ten'])):'';
$malop=isset($_POST['malop'])?addslashes(strip_tags($_POST['malop'])):'';
$ns=isset($_POST['ns'])?addslashes(strip_tags($_POST['ns'])):'';
$dc=isset($_POST['dc'])?addslashes(strip_tags($_POST['dc'])):'';
$masv=isset($_POST['masv'])?addslashes(strip_tags($_POST['masv'])):'';

if($ten!='') $sql.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($malop!='') $sql.=" AND a.malop LIKE '%$malop%'";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $sql.=" AND b.diachi LIKE '%$dc%'";
if($masv!='') $sql.=" AND a.masv LIKE '%$masv%'";

$sql.=" ORDER BY a.id_nganh ASC,a.malop ASC ";
$obj->Query($sql);		//echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." LIMIT $start,".MAX_ROWS);
?>
<table class="list table table-striped table-bordered">
	<thead><tr class="header">
		<th class="text-center">STT</th>
		<th class="text-center">Ngành</th>
		<th class="text-center">Lớp</th>
		<th>Mã SV</th>
		<th>Họ đệm</th><th>Tên</th>
		<th>Giới tính</th>
		<th class="text-center">Ngày sinh</th>
	</tr></thead>
	<tbody>
	<?php $i=1;
	$mon1 =$mon2=$mon3='';
	while($r=$obj->Fetch_Assoc()) { 
	$id_hoso = $r['ma']; $masv=$r['masv']; $lop=$r['malop'];
	?>
	<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
	<td dataid="<?php echo $id_hoso;?>">
		<?php if(isset($r['id_nganh'])) echo $r['id_nganh'];
		else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
	</td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $r['malop'];?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo $masv;?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']);?></td>
	<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['name']);?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
	<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/y",$r['ngaysinh']);?></td>
	</tr><?php $i++;} ?>
	</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
  <tr><td align="center">
	<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
	</td></tr>
</table>