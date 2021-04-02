<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_tuyensinh');
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
$ma=isset($_GET['ma'])?addslashes(strip_tags($_GET['ma'])):'';
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$strWhere=" AND (sbd='' OR sbd is null)";
if($ma!='') $strWhere.=" AND b.ma=".$ma;
if($ten!='') $strWhere.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($cmt!='') $strWhere.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$strWhere.=" AND b.ngaysinh = '$ns'";
}
if($dc!='') $strWhere.=" AND b.diachi LIKE '%$dc%'";
if($khoa!='') 	$strWhere.=" AND a.id_khoa='$khoa'";
if($he!='') 	$strWhere.=" AND a.id_he='$he'";
if($nganh!='') 	$strWhere.=" AND a.id_nganh='$nganh'";

$xettuyen = 0; $step=1;
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
				<div class="page-title">Hồ sơ tuyển sinh mới</div>
			</div>
			<ul class="box-function pull-right">
				<li><a href="javascript:void(0);" class="btn btn-warning sbd-auto" title="SBD tự động">
					<i class="fa fa-plus"></i> SBD tự động</a>
				</li>
			</ul>
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
					<th class="text-center">Mã hồ sơ</th>
					<th>Họ đệm</th><th>Tên</th>
					<th class="text-center">Ngày sinh</th>
					<th>Giới tính</th>
					<th>Địa chỉ</th>
					<th>Điện thoại</th>
					<th class="text-center">Ngành</th>
					<th class="text-center">Khóa</th>
					<th class="text-center">Hệ</th>
					<th class="text-center">SBD</th>
					<th class="text-center">Phòng thi</th>
				</tr></thead>
				<tbody>
					<?php  $i=$start; 
					$obj->Query($sql);
					while($r=$obj->Fetch_Assoc()) { 
						$i++;
						$id_dky = $r['ma'];
						$id_hoso = $r['ma'];
						$dataids = $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];
						?>
						<tr dataid="<?php echo $id_hoso;?>" dataids="<?php echo $dataids;?>">
							<td align="center"><?php echo $i;?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php echo $id_hoso;?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']);?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['name']);?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/Y",$r['ngaysinh']);?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php echo $r['diachi'];?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php echo $r['dienthoai'];?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php if(isset($_NGANH['N'.$r['id_nganh']])) echo $_NGANH['N'.$r['id_nganh']];?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php if(isset($_KHOA['K'.$r['id_khoa']])) echo $_KHOA['K'.$r['id_khoa']];?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php if(isset($_HE['H'.$r['id_he']])) echo $_HE['H'.$r['id_he']];?></td>
							<td dataid="<?php echo $id_hoso;?>" align="center">
								<input type="text" name="nhap_sbd" value='<?php echo $r['sbd'];?>' class="nhap_sbd form-control" dataid="<?php echo $id_hoso;?>" style="width:100px"/>
							</td>
							<td dataid="<?php echo $id_hoso;?>" align="center">
								<input type="text" name="phongthi" value='<?php echo $r['phongthi'];?>' class="phong_thi form-control" style="width:100px" dataid="<?php echo $id_hoso;?>" datadk="<?php echo $id_dky;?>"/>
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
<script type="text/javascript">
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
				window.location.reload();
			})
			}
		}
	})
	$(".phong_thi").keyup(function(e){
		if(e.which==13) {
			if($(this).val()=="") {
				$(this).focus(); $(this).addClass('novalid');
			}else {
				$(this).removeClass('novalid');
				var phongthi=$(this).val();
				var ma=$(this).attr('dataid');
				var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_phongthi.php";
				$.post(url,{'phongthi':phongthi,'ma':ma},function(req){
				//console.log(req);
				window.location.reload();
			})
			}
		}
	})
	$(".sbd-auto").click(function(){
		var _ma = $("#tk_ma").val();
		var _ten = $("#tk_hoten").val();
		var _cmt = $("#tk_cmt").val();
		var _ns = $("#tk_ns").val();
		var _dc = $("#tk_dc").val();
		var _nganh = "<?php echo $nganh;?>";
		var _khoa = "<?php echo $khoa;?>";
		var _he = "<?php echo $he;?>";
		if(_khoa=='') {
			alert('Vui lòng chọn khóa trước khi thực hiện chức năng đánh SBD tự động');
			return false;
		}
		var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/danh_sbd.php";
		$.post(url,{'ma':_ma,'ten':_ten,'cmt':_cmt,'ns':_ns,'dc':_dc,'nganh':_nganh,'khoa':_khoa,'he':_he},function(req) {
			$('#myModalPopup .modal-dialog').removeClass('modal-sm');
			$('#myModalPopup .modal-dialog').removeClass('modal-lg');
			$('#myModalPopup .modal-title').html('Đánh số báo danh & Phân phòng thi');
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		})
	})
</script>