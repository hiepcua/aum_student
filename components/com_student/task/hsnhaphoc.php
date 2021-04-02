<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_hsnhaphoc');
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
//-------------------------------------------
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$lop=isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
$sbd=isset($_GET['sbd'])?addslashes(strip_tags($_GET['sbd'])):'';
$masv=isset($_GET['masv'])?addslashes(strip_tags($_GET['masv'])):'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$params=''; $step = '';
$strWhere=" AND a.nhaphoc=1 ";
if($ten!='') {
	$strWhere.=" AND (b.name LIKE '%$ten%' OR b.nickname LIKE '%$ten%')";
	$params.="&ten=$ten";
}
if($cmt!='') {
	$strWhere.=" AND b.cmt LIKE '%$cmt%'";
	$params.="&cmt=$cmt";
}
if($ns!='') {
	$ns = strtotime($ns);
	$strWhere.=" AND b.ngaysinh LIKE '%$ns%'";
	$params.="&ns=$ns";
}
if($dc!='') {
	$strWhere.=" AND b.diachi LIKE '%$dc%'";
	$params.="&dc=$dc";
}
if($nganh!='') {
	$strWhere.=" AND a.id_nganh='$nganh'";
	$params.="&nganh=$nganh";
}
if($khoa!='') {
	$strWhere.=" AND a.id_khoa='$khoa'";
	$params.="&khoa=$khoa";
}
if($he!='') {
	$strWhere.=" AND a.id_he='$he'";
	$params.="&he=$he";
}
if($lop!='') {
	$strWhere.=" AND a.malop='$lop'";
	$params.="&malop=$lop";
}
if($sbd!='') {
	$strWhere.=" AND a.sbd LIKE '%$sbd%'";
	$params.="&sbd=$sbd";
}
if($masv!='') {
	$strWhere.=" AND a.masv LIKE '%$masv%'";
	$params.="&masv=$masv";
}
if($khoa!='') 	$strWhere.=" AND a.id_khoa='$khoa'";
if($he!='') 	$strWhere.=" AND a.id_he='$he'";

$sql="SELECT count(*) as num FROM tbl_dangky_tuyensinh AS a INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma WHERE a.trungtuyen=1 $strWhere";
$obj->Query($sql);
$r=$obj->Fetch_Assoc();

$total_rows=$r['num'];
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$limit = 'LIMIT '.$start.','. MAX_ROWS;
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Hồ sơ đã nhập học</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="javascript:void(0)" class="btn btn-success add_class" title="Phân lớp"><i class="fa fa-users"></i> Phân lớp</a>
				</li>
				<li>
					<a href="#" class="btn btn-info btn-excel" title="Xuất File Excel"><i class="fa fa-excel"></i> Xuất File Excel</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="customer_list">
		<?php include("search_hsnhaphoc.php");?>
		<!-- initially hidden right-click menu -->
		<div id="contextMenu" class="dropdown clearfix">
			<input type="hidden" id="right_click_id" value=""/>
			<input type="hidden" id="right_click_ids" value=""/>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
				<li><a tabindex="-1" href="javascript:void(0)" class="view_profile">Hồ sơ chi tiết</a></li>
				<li class="dropdown">
					<a tabindex="-1" href="javascript:void(0)" class="thu_hocphi">QL học phí</a>
				</li>
				<li class="divider"></li>
				<li><a tabindex="-1" href="javascript:void(0)" class="chuyen_lop">Chuyển lớp</a></li>
				<li><a tabindex="-1" href="javascript:void(0)" class="kq_hoctap">Kết quả học tập</a></li>
				<li><a tabindex="-1" href="javascript:void(0)" class="xoa_hoso">Xóa hồ sơ hiện tại</a></li>
			</ul>
		</div>

		<div id="list_profile" class="table-responsive">
			<table class="list table table-striped table-bordered">
				<thead><tr class="header">
					<th class="text-center">STT</th>
					<th>Họ tên</th>
					<th>Giới tính</th>
					<th class="text-center">Ngày sinh</th>
					<th class="text-center">Khóa</th>
					<th class="text-center">Hệ</th>
					<th class="text-center">Ngành</th>
					<th class="text-center">Trạng thái</th>
					<th class="text-center">Mã SV</th>
					<th class="text-center">Ngày nhập học</th>
					<th class="text-center">Lớp</th>
					<th class="text-center"></th>
				</tr></thead>
				<tbody>
					<?php 
					$sql="SELECT DISTINCT(masv) FROM tbl_hocphi  WHERE ispay=1";
					$obj->Query($sql);
					$arr_paid = array();
					while($row=$obj->Fetch_Assoc()) $arr_paid[$row['masv']]=1; 
					$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
					$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
					FROM tbl_dangky_tuyensinh AS a 
					INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
					WHERE a.trungtuyen=1 $strWhere ";
					$sql .= " ORDER BY a.nhaphoc ASC $limit";
					$obj->Query($sql);
					$i=$start;
					$mon1 =$mon2=$mon3='';

					while($r=$obj->Fetch_Assoc()) { 
						$i++;
						$id_hoso = $r['ma']; $masv=$r['masv']; $sbd=$r['sbd']; $tongdiem='';
						if(isset($r['mon1']) && $r['mon1']>=0 && $r['mon2']>=0 && $r['mon3']>=0) {
							$mon1 = $r['mon1']; $mon2 = $r['mon2']; $mon3 = $r['mon3'];
							$tongdiem = $r['mon1']+$r['mon2']+$r['mon3'];
						} 
						$ispay = isset($arr_paid[$masv])?$arr_paid[$masv]:0;
						$dataids = $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];
						?>
						<tr dataid="<?php echo $id_hoso;?>" dataids="<?php echo $dataids;?>">
							<td align="center"><?php echo $i;?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']);?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/Y",$r['ngaysinh']);?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $r['id_khoa'];?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $r['id_he'];?></td>
							<td dataid="<?php echo $id_hoso;?>">
								<?php if(isset($r['id_nganh'])) echo $_NGANH['N'.$r['id_nganh']];
								else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
							</td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center">
								<?php if($ispay==0) echo 'Đã nhập học'; else echo 'Đã đóng học';?>
							</td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $masv;?></td>
							<td align="center"><?php if($r['date_nhaphoc']!=null) echo date("d/m/Y",$r['date_nhaphoc']);?></td>
							<td align="center">
								<?php if($r['malop']!="") echo $r['malop']; else {?>
									<a href="javascript:void(0)" class="btn btn-default btn_nhaplop" dataid="<?php echo $id_hoso;?>" dataids="<?php echo $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];?>">Nhập lớp</a>
								<?php } ?>
							</td>
							<td align="center">
								<?php if($ispay==0) { ?>
									<button class='btn btn-danger' onclick="NhapHoc('<?php echo $id_hoso;?>',0)">Hủy nhập học</button>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
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
		$("#tk_hoten").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_cmt").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_ns").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_dc").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_sbd").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_masv").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_btnsearch").click(function(){
			SubmitSearch();
		})
		$(".add_class").click(function(){
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/phan_lop.php";
			$.post(url,{},function(req) {
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-title').html('Phân lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		})
		$(".btn-excel").click(function(){
			showLoading(); 
			link="<?php echo ROOTHOST;?>excel/export_hsnhaphoc.php?<?php echo $params;?>";
			$.get(link,function(req){
				console.log(req);
				hideLoading();
				if(req=="E01") showMess('Vui lòng đăng nhập hệ thống.');
				else if(req=="empty") showMess('Dữ liệu trống.');
				else {
					str='<a href="<?php echo ROOTHOST;?>excel/cache/download.php?file='+req+'">Download link tại đây</a>';
					showMess(str);
				}
			})
		})
		$(".btn_nhaplop").click(function(){
			var hoso = $(this).attr('dataid');
			var ids = $(this).attr('dataids');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_add_lop.php";
			$.post(url,{'ma':hoso, 'ids': ids},function(req) {
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-title').html('Phân lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});
	})
	function SubmitSearch() {
		var _ten = $("#tk_hoten").val();
		var _cmt = $("#tk_cmt").val();
		var _ns = $("#tk_ns").val();
		var _dc = $("#tk_dc").val();
		var _sbd = $("#tk_sbd").val();
		var _masv = $("#tk_masv").val();

		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);

		if(searchParams.has("ten")===true){ searchParams.delete("ten");}
		searchParams.append("ten",_ten);
		if(searchParams.has("cmt")===true){ searchParams.delete("cmt");}
		searchParams.append("cmt",_cmt);
		if(searchParams.has("ns")===true){ searchParams.delete("ns");}
		searchParams.append("ns",_ns);
		if(searchParams.has("dc")===true){ searchParams.delete("dc");}
		searchParams.append("dc",_dc);
		if(searchParams.has("sbd")===true){ searchParams.delete("sbd");}
		searchParams.append("sbd",_sbd);
		if(searchParams.has("masv")===true){ searchParams.delete("masv");}
		searchParams.append("masv",_masv);

		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);
		window.location.reload();
	}
	function NhapHoc(ma,status) {
		showLoading();
	/*var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_nhaphoc.php";
	$.post(url,{'ma':ma,'status':status},function(req){
		hideLoading();
		if(req=="success") {
			window.location.reload();
		}else showMess(req,"error");
		
	})*/
	window.location='<?php echo ROOTHOST;?>?com=student&task=cancel_nhaphoc&ma='+ma;
}
</script>