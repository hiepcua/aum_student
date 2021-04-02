<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_hsdathi');
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
$sbd=isset($_GET['sbd'])?addslashes(strip_tags($_GET['sbd'])):'';
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$diem=isset($_GET['diem'])?(int)$_GET['diem']:'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$strWhere=" AND (a.sbd!='' AND a.sbd is not null) AND (a.mon1!='' OR a.mon1 is not null) AND a.trungtuyen=-1";
if($ten!='') $strWhere.=" AND (b.name LIKE '%$ten%' OR b.nickname LIKE '%$ten%')";
if($cmt!='') $strWhere.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$strWhere.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $strWhere.=" AND b.diachi LIKE '%$dc%'";
if($sbd!='') $strWhere.=" AND a.sbd LIKE '%$sbd%'";
if($diem!='') $strWhere.=" AND (a.mon1+a.mon2+a.mon3)>=$diem";

if($khoa!='') $strWhere.=" AND a.id_khoa='$khoa'";
if($he!='') $strWhere.=" AND a.id_he='$he'";
if($nganh!='') $strWhere.=" AND a.id_nganh='$nganh'";

$xettuyen = 0; $step = 4;
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
				<div class="page-title">Hồ sơ đã thi</div>
			</div>
		</div>
	</div>
	<div class="customer_list">
		<?php include("search_hsdathi.php");?>
		<!-- initially hidden right-click menu -->
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
				<th>Họ đệm</th><th>Tên</th>
				<th>Giới tính</th>
				<th class="text-center">Ngày sinh</th>
				<th class="text-center">Ngành</th>
				<th class="text-center">SBD</th>
				<th class="text-center">Môn 1</th>
				<th class="text-center">Môn 2</th>
				<th class="text-center">Môn 3</th>
				<th class="text-center">Tổng</th>
				<th class="text-center" colspan='2'>Xét kết quả</th>
			</tr></thead>
			<tbody>
			<?php 
			$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
			$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
				FROM tbl_dangky_tuyensinh AS a 
				INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
				WHERE a.xettuyen=0 $strWhere";
			$sql .= " ORDER BY a.nhaphoc ASC ";
			$obj->Query($sql);
			// echo $sql;
			$i=$start;
			$mon1 =$mon2=$mon3='';
			while($r=$obj->Fetch_Assoc()) { 
			$i++;
			$id_hoso = $r['ma']; $sbd=$r['sbd']; $tongdiem='';
			if(isset($r['mon1']) && $r['mon1']>=0 && $r['mon2']>=0 && $r['mon3']>=0) 
				$mon1 = $r['mon1']; $mon2 = $r['mon2']; $mon3 = $r['mon3'];
				$tongdiem = $r['mon1']+$r['mon2']+$r['mon3'];

			$dataids = $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];
			?>
			<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
			
			<td dataid="<?php echo $id_hoso;?>" dataid="<?php echo $dataids;?>"><?php echo stripslashes($r['ho_dem']);?></td>
			<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['name']);?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/Y",$r['ngaysinh']);?></td>
			<td dataid="<?php echo $id_hoso;?>">
				<?php if(isset($r['id_nganh'])) echo $_NGANH['N'.$r['id_nganh']];
				else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
			</td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $sbd;?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon1;?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon2;?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $mon3;?></td>
			<td dataid="<?php echo $id_hoso;?>" class="text-center cred"><b><?php echo $tongdiem;?></b></td>
			<td align="center">
				<button dataid='<?php echo $id_hoso;?>' class='btn btn-success btn_hs_do'>Đạt</button>
			</td>
			<td align="center">
				<button dataid='<?php echo $id_hoso;?>' class='btn btn-danger btn_hs_truot'>Trượt</button>
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
	$('.btn_hs_do').click(function(){
		var ma = $(this).attr('dataid');
		XetTrungTuyen(ma,1);
	})
	$('.btn_hs_truot').click(function(){
		var ma = $(this).attr('dataid');
		XetTrungTuyen(ma,0);
	})
})
function XetTrungTuyen(ma,status) {
	var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_trungtuyen.php";
	$.post(url,{'ma':ma,'status':status},function(req){
		if(req=="error"){
			showMess("Lỗi trong quá trình lưu dữ liệu!","error");
			setTimeout(function(){ 
				window.location.reload(); 
			}, 1500);
		}else if(req=="success"){
			window.location.reload(); 
		}
	})
}	
</script>