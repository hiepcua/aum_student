<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_hsxettuyen');
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
$ma=isset($_GET['ma'])?addslashes(strip_tags($_GET['ma'])):'';
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$strWhere=" AND (sbd='' OR sbd is null) AND (trungtuyen is null OR trungtuyen=-1)";
if($ma!='') $strWhere.=" AND b.ma=".$ma;
if($ten!='') $strWhere.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($cmt!='') $strWhere.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$strWhere.=" AND b.ngaysinh = '$ns'";
}
if($dc!='') $strWhere.=" AND b.diachi LIKE '%$dc%'";
if($khoa!='') $strWhere.=" AND a.id_khoa='$khoa'";
if($he!='') $strWhere.=" AND a.id_he='$he'";
if($nganh!='') $strWhere.=" AND a.id_nganh='$nganh'";

$xettuyen = 1; $step = 2;
$sql="SELECT count(*) as num FROM tbl_dangky_tuyensinh AS a INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
WHERE a.xettuyen=$xettuyen $strWhere";
$obj->Query($sql);
$r=$obj->Fetch_Assoc();
$total_rows=$r['num'];
//--------------------------------------
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$sql="SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai,b.xettuyen 
		FROM tbl_dangky_tuyensinh AS a INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE a.xettuyen=$xettuyen $strWhere
		ORDER BY a.id DESC, a.id_nganh ASC LIMIT $start,".MAX_ROWS;
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Hồ sơ xét tuyển (mới)</div>
			</div>
		</div>
	</div>
	<div class="customer_list">
		<?php include("search_ts.php");?>
		<div id="contextMenu" class="dropdown clearfix">
			<input type="hidden" id="right_click_id" value=""/>
			<input type="hidden" id="right_click_ids" value=""/>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
			  <li><a tabindex="-1" href="javascript:void(0)" class="view_profile">Hồ sơ chi tiết</a></li>
			   <li><a tabindex="-1" href="javascript:void(0)" class="xoa_hoso">Xóa hồ sơ hiện tại</a></li>
			</ul>
        </div>
		<div id="list_profile" class="table-responsive">
		<table class="list table table-striped table-bordered">
		<thead><tr class="header">
			<th class="text-center">STT</th>
			<th class="text-center" colspan='2'>Xét tuyển</th>
			<th class="text-center">Ngành</th>
			<th class="text-center">Khóa</th>
			<th class="text-center">Hệ</th>
			<th class="text-center">Mã HS</th>
			<th>Họ tên</th>
			<th class="text-center">Ngày sinh</th>
			<th class="text-center">Giới tính</th>
			<th class="text-center">Điện thoại</th>
			<th class="text-center">Địa chỉ</th>
			<th class="text-center">Ngày đăng ký</th>
		</tr></thead>
		<tbody>
		<?php
			$obj->Query($sql);
			$i=$start;
			while($r=$obj->Fetch_Assoc()) { $i++;
				$id_hoso = $r['ma'];
				$dataids = $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];
			?>
			<tr dataid="<?php echo $id_hoso;?>" dataids="<?php echo $dataids;?>"><td align="center"><?php echo $i;?></td>
			<td align="center">
			<button class='btn btn-success hs_do' datastatus=1 dataid='<?php echo $id_hoso;?>'>Đạt</button>
			</td>
			<td align="center">
			<button class='btn btn-danger hs_truot' datastatus=0 dataid='<?php echo $id_hoso;?>'>Trượt</button>
			</td>
			<td><?php echo $_NGANH['N'.$r['id_nganh']];?></td>
			<td><?php echo $_KHOA['K'.$r['id_khoa']];?></td>
			<td><?php echo $_HE['H'.$r['id_he']];?></td>
			<td><a href="<?php echo ROOTHOST;?>student/profile/<?php echo $id_hoso;?>">
			<?php echo stripslashes($id_hoso);?></a></td>
			<td><a href="<?php echo ROOTHOST;?>student/profile/<?php echo $id_hoso;?>">
			<?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']);?></a></td>
			<td class="text-center"><?php echo date("d/m/Y",$r['ngaysinh']);?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
			<td><?php echo stripslashes($r['dienthoai']);?></td>
			<td><?php echo stripslashes($r['diachi']);?></td>
			<td align="center"><?php if($r['cdate']!=null) echo date("d/m/Y",$r['cdate']);?></td>
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
$('.btn-dat').click(function(){
	var url='<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_trungtuyen.php';
	$.post(url,{'ma':$(this).attr('dataid'),'status':$(this).attr('datastatus')},function(req){
		//console.log(req); return;
		window.location.reload();
	});
});
</script>