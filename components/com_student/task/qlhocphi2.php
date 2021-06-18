<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa=$id_lop=$id_partner='';
$hocky=3; $id_hocky=''; $params='';
//print_r($_GET);
$obj = new CLS_MYSQL;
$id_he 		= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$id_nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$id_lop 	= isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
$id_hocky 	= isset($_GET['hocky'])?addslashes(strip_tags($_GET['hocky'])):'';
$masv 	= isset($_GET['masv'])?addslashes(strip_tags(masv)):'';
//---------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH['N'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$_HE=array();
while($r=$obj->Fetch_Assoc()){
	$_HE['H'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_khoa";
$obj->Query($sql);
$_KHOA=array();
while($r=$obj->Fetch_Assoc()){
	$_KHOA['K'.$r['id']]=$r['name'];
}

//---------------------------------------
$sql = "select masv,sum(hocphi) as total,ispay from tbl_hocphi";
if($id_hocky!=='') {
	$params.="&hocky=$id_hocky";
	$id_hocky=(int)$id_hocky;
	$sql.=" WHERE hocky='$id_hocky'"; 
}
$sql.=" GROUP BY masv,ispay"; 

$obj->Query($sql);
$arrHP = array(); $tonghp=0;
while($rs=$obj->Fetch_Assoc()) {
	$arrHP[$rs['masv']]=$rs['total']+0;
}
//---------------------------------------
$sql = "select masv,sum(sotien) as total from tbl_hocphi_pay GROUP BY masv"; 
$obj->Query($sql);
$arrHP_dadong = array();
while($rs=$obj->Fetch_Assoc()) {
	$arrHP_dadong[$rs['masv']]=$rs['total'];
}

$sql="SELECT * FROM tbl_dangky_tuyensinh  WHERE isactive=1 "; 

if($id_he!=='') {
	$sql.=" AND id_he='$id_he'";
	$params.="&he=$id_he";
}
if($id_nganh!=='') {
	$sql.=" AND id_nganh='$id_nganh'";
	$params.="&nganh=$id_nganh";
}
if($id_lop!=='') {
	$sql.=" AND malop='$id_lop'";
	$params.="&malop=$id_lop";
}
if($masv!=='') {
	$sql.=" AND masv='$masv'";
	$params.="&masv=$masv";
}
if($params!='') $params=substr($params,1,strlen($params));
$obj->Query($sql);	//echo $sql;

$MAX_ROWS=50;
$total_rows = $obj->Num_rows();
$max_pages = ceil($total_rows/$MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * $MAX_ROWS;
$limit = ' LIMIT '.$start.','. $MAX_ROWS;
$sql.= $limit;
$obj->Query($sql);
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">QL Học phí</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<button type="button" class="btn btn-warning btn-print" title="In hồ sơ"><i class="fa fa-print"></i> In</button>
				</li>
				<li>
					<a href="#" class="btn btn-info btn-excel" title="Xuất File Excel">
						<i class="fa fa-excel"></i> Xuất File Excel
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="search_box panel panel-warning">
		<div class="panel-body">
			<div class="media row">
				<form name="frm_search" id="frm_search" method="get" action="#">
					<div class="form-group">
						<div class="col-md-2 col-xs-6">
							<input type="text" name="masv" id="txt_masv" value="<?php echo $masv;?>" placeholder="Mã sinh viên" class="form-control">
						</div>
						<div class="col-md-2 col-xs-6">
							<select name="malop" id="ma_lop" class="form-control" >
								<option value="">Lớp</option>
								<?php $objlop = new CLS_LOP;
								$objlop->getList(); 
								while($r_lop=$objlop->Fetch_Assoc()) { ?>
									<option value="<?php echo $r_lop['id'];?>" <?php if($id_lop==$r_lop['id']) echo "selected";?>>
										<?php echo $r_lop['id'];?>
									</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2 col-xs-6">
							<select name="hocky" id="hocky" class="form-control" >
								<option value="">Học kỳ</option>
								<?php for($i=1;$i<=$hocky;$i++) { ?>
									<option value="<?php echo $i;?>" <?php if($id_hocky==$i) echo "selected";?>>
										Học kỳ <?php echo $i;?>
									</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-2 col-xs-6">
							<select name="hocky" id="hocky" class="form-control" >
								<option value="">Tình trạng</option>
								<?php for($i=1;$i<=$hocky;$i++) { ?>
									<option value="<?php echo $i;?>" <?php if($id_hocky==$i) echo "selected";?>>
										Học kỳ <?php echo $i;?>
									</option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-1 col-xs-6">
							<button type="button" id="tk_btnsearch" class="btn btn-primary form-control"><i class="fa fa-search"></i> Lọc</button>
						</div>
						<div class="col-md-2 col-xs-6"></div>
						<div class="col-md-2 col-xs-6"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php $html.='<div class="page-bar">
	<div class="page-title-breadcrumb">
	<div class="page-title">DANH SÁCH HỌC PHÍ</div>
	</div>
	</div>'; 
	$html.='<table class="table table-striped table-bordered">
	<thead><tr class="header">
	<th class="text-center">STT</th>
	<th>Ngành</th>
	<th>Họ đệm</th><th>Tên</th>
	<th>Giới tính</th>
	<th class="text-center">Ngày sinh</th>
	<th class="text-center">Lớp</th>
	<th class="text-center">Mã SV</th>
	<th class="text-center">Tổng học phí</th>
	<th class="text-center">HP đã đóng</th>
	<th class="text-center">Cần thu</th>
	</tr></thead>
	<tbody>';
	?>
	<table class="list table table-striped table-bordered">
		<thead><tr class="header">
			<th class="text-center">STT</th>
			<th>Ngành</th>
			<th>Hệ/Bậc</th>
			<th>Lớp</th>
			<th class="text-center">Mã SV</th>
			<th class="text-center">Tình trạng</th>
			<th class="text-center">Tổng học phí</th>
			<th class="text-center">Đã đóng</th>
			<th class="text-center">Cần thu</th>
			<th class="text-center"></th>
		</tr></thead>
		<tbody>
			<?php $i=$start;
			$mon1 =$mon2=$mon3=''; 
			while($r=$obj->Fetch_Assoc()) { 
				$i++;
				$masv=$r['masv']; 
				$total=0; $dadong=$chuadong=0;
				$total = isset($arrHP[$masv]) ? $arrHP[$masv] : 0;
				$dadong = isset($arrHP_dadong[$masv]) ? $arrHP_dadong[$masv] : 0;
				$chuadong = $total - $dadong;
				$nganh = strlen($r['id_nganh'])>0 ? $_NGANH['N'.$r['id_nganh']] : '';
				$khoa = strlen($r['id_khoa'])>0 ? $_KHOA['K'.$r['id_khoa']] : '';
				$bac = strlen($r['id_he'])>0 ? $_HE['H'.$r['id_he']] : '';
				$tinh_trang=$r['tinhtrang_hocphi'];
				?>
				<tr dataid="<?php echo $masv;?>">
					<td align="center"><?php echo $i;?></td>
					<td><?php echo $nganh;?></td>
					<td><?php echo $bac;?></td>
					<td align="center">
						<?php
						if(strlen($r['malop'])>0) echo $r['malop'];
						else{
							echo '<a href="javascript:void(0)" class="btn btn-default btn_nhaplop" dataids="'.$r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'].'">Nhập lớp</a>';
						}
						?>
					</td>
					<td class="text-center"><?php echo $masv;?></td>
					<td class="text-center"><?php echo $tinh_trang;?></td>
					<td align="center"><b class="cred"><?php echo number_format($total);?></b></td>
					<td align="center"><label class="label label-success"><big><?php echo number_format($dadong);?></big></label></td>
					<td align="center"><label class="label label-danger"><big><?php echo number_format($chuadong);?></big></label></td>
					<?php
					if($masv!==''){
						?>
						<td align="center"><a href="<?php echo ROOTHOST;?>student/hocphi/<?php echo $masv;?>">Chi tiết Học phí</a></td>
					<?php }else{ ?>
						<td align="center"></td>
					<?php } ?>
				</tr>
				<?php 
				$html.='<tr><td align="center">'.$i.'</td>
				<td>'.$r['id_nganh'].'</td>
				<td align="center">'.$r['malop'].'</td>
				<td class="text-center">'.$masv.'</td>
				<td align="center">'.$tinh_trang.'</td>
				<td align="center"><b class="cred">'.number_format($total).'</b></td>
				<td align="center"><label class="label label-success"><big>'.number_format($dadong).'</big></label></td>
				<td align="center"><label class="label label-danger"><big>'.number_format($chuadong).'</big></label></td>
				</tr>';
			} 
			$html.="</tbody></table>";?>
		</tbody>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr><td align="center">
			<?php paging($total_rows,$MAX_ROWS,$cur_page); ?>
		</td></tr>
	</table>
</div>
<div id="divToPrint" style="display:none;"><?php echo $html; ?></div>
<script>
	$(document).ready(function(){
		$(".btn-excel").click(function(){
			showLoading(); 
			link="<?php echo ROOTHOST;?>excel/export_qlhocphi.php?<?php echo $params;?>";
			$.get(link,function(req){
				console.log(req);
				hideLoading();
				if(req=="E01") showMess('Vui lòng đăng nhập hệ thống.');
				else if(req=="empty") showMess('Dữ liệu trống.');
				else {
					str='<a href="<?php echo ROOTHOST;?>excel/'+req+'">Download link tại đây</a>';
					showMess(str);
				}
			})
		})
		$(".btn-print").click(function(){
			showLoading();
			var screenW =screen.width;
			var screenH =screen.height; console.log(screenW+' / '+screenH);
			var divToPrint = document.getElementById('divToPrint');
			var popupWin = window.open('', '_blank','toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width='+screenW+',height='+screenH);
			popupWin.document.open();
			popupWin.document.write('<html><head><title>Danh sách học phí</title>');
			popupWin.document.write('</head><body onload="window.print();">');
			popupWin.document.write(divToPrint.innerHTML);
			popupWin.document.write('</body></html>');
			popupWin.document.close();
			hideLoading();
		});

		$(".btn_nhaplop").click(function(){
			var ids = $(this).attr('dataids');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_add_lop.php";
			$.post(url,{'ids': ids},function(req) {
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-title').html('Phân lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});

		$("#ma_lop").change(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#hocky").change(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_hodem").change(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_tensv").change(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_btnsearch").click(function(){
			SubmitSearch();
		})
	})

	function SubmitSearch() {
		var _malop = $("#ma_lop").val();
		var _hocky = $("#hocky").val();
		var _hodem = $("#tk_hodem").val();
		var _tensv = $("#tk_tensv").val();

		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);

		if(searchParams.has("malop")===true){ searchParams.delete("malop");}
		searchParams.append("malop",_malop);
		if(searchParams.has("hocky")===true){ searchParams.delete("hocky");}
		searchParams.append("hocky",_hocky);
		if(searchParams.has("hodem")===true){ searchParams.delete("hodem");}
		searchParams.append("hodem",_hodem);
		if(searchParams.has("tensv")===true){ searchParams.delete("tensv");}
		searchParams.append("tensv",_tensv);

		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);

		window.location.reload();
	}
</script>