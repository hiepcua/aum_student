<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_hstruot');
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
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;

$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$sbd=isset($_GET['sbd'])?addslashes(strip_tags($_GET['sbd'])):'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$strWhere=" AND trungtuyen=0";
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
$step = '';
$sql="SELECT count(*) as num FROM tbl_dangky_tuyensinh AS a INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma WHERE a.isactive=1 $strWhere";

$obj->Query($sql);
$r=$obj->Fetch_Assoc();
$total_rows=$r['num'];	
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Hồ sơ không trúng tuyển</div>
			</div>
		</div>
	</div>
	<div class="customer_list">
		<?php include("search_hstruot.php");?>
        <div id="contextMenu" class="dropdown clearfix">
			<input type="hidden" id="right_click_id" value=""/>
			<input type="hidden" id="right_click_ids" value=""/>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
			  <li><a tabindex="-1" href="javascript:void(0)" class="view_profile">Hồ sơ chi tiết</a></li>
			   <li><a tabindex="-1" href="javascript:void(0)">Xóa hồ sơ hiện tại</a></li>
			</ul>
        </div>
		<div id="list_profile" class="table-responsive">
		<?php 
		// danh sách hồ sơ trúng tuyển: trúng tuyển=1, chưa nhập học
		$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
		$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
				FROM tbl_dangky_tuyensinh AS a 
				INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
				WHERE a.isactive=1 $strWhere";
		$sql .= " ORDER BY a.nhaphoc ASC ";
		$obj->Query($sql." LIMIT $start,".MAX_ROWS);
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
				<th class="text-center">Xét Đạt</th>
			</tr></thead>
			<tbody>
			<?php $i=$start;
			$mon1 =$mon2=$mon3='';
			while($r=$obj->Fetch_Assoc()) { $i++;
			$id_hoso = $r['ma']; $sbd=$r['sbd']; $tongdiem='';
			$loaiHs	= $r['xettuyen']==1?"Xét tuyển":'';
			if(isset($r['mon1']) && $r['mon1']>=0 && $r['mon2']>=0 && $r['mon3']>=0) 
				$mon1 = $r['mon1']; $mon2 = $r['mon2']; $mon3 = $r['mon3'];
				$tongdiem = $r['mon1']+$r['mon2']+$r['mon3'];

			$dataids = $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];
			?>
			<tr dataid="<?php echo $id_hoso;?>" dataids="<?php echo $dataids;?>">
			<td align="center"><?php echo $i;?></td>
			
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
			<td align="center">Không đạt</div>
			<td align="center">
				<button class='btn btn-success btn-dat hs_do' dataid='<?php echo $id_hoso;?>' >Đạt</button>
			</td>
			</tr><?php } ?>
			</tbody>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		  <tr><td align="center">
			<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
			</td></tr>
		</table>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.hs_do').click(function(){
		var ma = $(this).attr('dataid');
		var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_trungtuyen.php";
		$.post(url,{'ma':ma,'status':1},function(req){
			window.location.reload();
		})
	})
});	
</script>