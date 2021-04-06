<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_hsdaotao');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$params=''; 
$page_title = "Quản lý đào tạo";
$obj = new CLS_MYSQL;
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
//---------------------------------------
$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$_HE=array();
while($r=$obj->Fetch_Assoc()){
	$_HE['H'.$r['id']]=$r['name'];
}

$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.city,b.dienthoai 
FROM tbl_dangky_tuyensinh AS a 
RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
WHERE b.isactive=1 and nhaphoc=1"; 

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$malop 	= isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
if($khoa!='') {
	$sql.=" AND a.id_khoa='$khoa'";
	$page_title = "QL đào tạo - khóa $khoa";
	$params .= "&khoa=$khoa";
}
if($he!='') {
	$sql.=" AND a.id_he='$he'";
	$objhe = new CLS_HE; $he_name = $objhe->getName($he);
	$page_title = "QL đào tạo - hệ $he_name";
	$params .= "&he=$he";
}
if($nganh!='') { 
	$sql.=" AND a.id_nganh='$nganh'"; 
	$objnganh = new CLS_NGANH; $nganh_name = $objnganh->getName($nganh);
	$page_title = "QL đào tạo - khoa $nganh_name";
	$params .= "&nganh=$nganh";
}
if($malop!='') { 
	$sql.=" AND a.malop='$malop'"; 
	$page_title = "Danh sách lớp $malop";
	$params .= "&malop=$malop";
}

$_date_ns = null;
$hodem=isset($_GET['hodem'])?addslashes(strip_tags($_GET['hodem'])):'';
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$ma_hoso=isset($_GET['ma_hoso'])?addslashes(strip_tags($_GET['ma_hoso'])):'';
$step=isset($_GET['step'])?addslashes(strip_tags($_GET['step'])):'';

if($hodem!='') $sql.=" AND b.ho_dem LIKE '%$hodem%'";
if($ten!='') $sql.=" AND b.name LIKE '%$ten%'";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
	$_date_ns = date('Y-m-d', $ns);
}
if($dc!='') $sql.=" AND b.diachi LIKE '%$dc%'";
if($ma_hoso!='') $sql.=" AND a.id_hoso='$ma_hoso'";

$sql.=" ORDER BY a.id_nganh ASC,a.malop ASC ";
$obj->Query($sql);

$total_rows = $obj->Num_rows();
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$limit = ' LIMIT '.$start.','. MAX_ROWS;
$sql.= $limit;
$obj->Query($sql);
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title"><?php echo $page_title;?></div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>qlhocphi?<?php echo $params;?>" class="btn btn-primary btn-money" title="Quản lý học phí"><i class="fa fa-money"></i> QL Học phí</a>
				</li>
				<li>
					<a href="<?php echo ROOTHOST;?>qlhoctap?<?php echo $params;?>" class="btn btn-success btn-book" title="Quản lý học tập"><i class="fa fa-book"></i> QL Học tập</a>
				</li>
				<li>
					<a href="#" class="btn btn-info btn-excel" title="Xuất File Excel"><i class="fa fa-excel"></i> Xuất File Excel</a>
				</li>
				<li>
					<a href="#" class="btn btn-warning btn-print" title="In danh sách"><i class="fa fa-print"></i> In</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="customer_list">
		<?php $tk_nganh='';?>
		<div class="search_box panel panel-warning">
			<div class="panel-body">
				<div class="media row">
					<form name="frm_search" id="frm_search" method="get" action="#">
						<div class="form-group">
							<div class="col-md-2 col-xs-6">
								<input type="hidden" name="com" value="student"/>
								<input type="hidden" name="task" value="hsdaotao"/>
								<input type="hidden" name="malop" value="<?php echo $malop;?>"/>
								<input type="text" name="ma_hoso" id="tk_mahs" value="<?php echo $ma_hoso;?>" placeholder="Mã hồ sơ" class="form-control"/>
							</div>
							<div class="col-md-2 col-xs-6">
								<input type="text" name="hodem" id="tk_hoten" value="<?php echo $hodem;?>" placeholder="Họ đệm" class="form-control"/> 
							</div>
							<div class="col-md-2 col-xs-6">
								<input type="text" name="ten" id="tk_ten" value="<?php echo $ten;?>" placeholder="Tên" class="form-control"/> 
							</div>
							<div class="col-md-2 col-xs-6">
								<input type="date" name="ns" id="tk_ns" value="<?php echo $_date_ns;?>" placeholder="Ngày sinh" class="form-control"/> 
							</div>
							<div class="col-md-2 col-xs-6">
								<input type="text" name="dc" id="tk_dc" value="<?php echo $dc;?>" placeholder="Địa chỉ" class="form-control"/> 
							</div>
							<div class="col-md-2">
								<button type="button" name="tk_btnsearch" id="tk_btnsearch" class="btn btn-primary form-control"><i class="fa fa-search"></i> Lọc</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php $html.='<div class="page-bar">
		<div class="page-title-breadcrumb">
		<div class="page-title">DANH SÁCH SINH VIÊN</div>
		</div>
		</div>';
		$html.='<table class="table table-striped table-bordered">
		<thead><tr class="header">
		<th class="text-center">STT</th>
		<th class="text-center">Ngành</th>
		<th class="text-center">Lớp</th>
		<th>Mã SV</th>
		<th>Họ đệm</th><th>Tên</th>
		<th>Giới tính</th>
		<th class="text-center">Ngày sinh</th>
		<th class="text-center">Tỉnh/thành</th>
		</tr></thead>
		<tbody>';
		?>
		<div id="list_profile" class="table-responsive">
			<table class="list table table-striped table-bordered">
				<thead><tr class="header">
					<th class="text-center">STT</th>
					<th>Ngành</th>
					<th class="text-center">Lớp</th>
					<th class="text-center">Mã hồ sơ</th>
					<th>Họ tên</th>
					<th class="text-center">Giới tính</th>
					<th class="text-center">Ngày sinh</th>
					<th class="text-center">Tỉnh/thành</th>
					<th></th>
				</tr></thead>
				<tbody>
					<?php $i=$start;
					$mon1 =$mon2=$mon3=''; 
					while($r=$obj->Fetch_Assoc()) { 
						$i++;
						$id_hoso = $r['ma']; $masv=$r['masv']; $lop=$r['malop'];
						$id_khoa = $r['id_khoa']; 
						$id_he = $r['id_he']; 
						$id_nganh = $r['id_nganh']; 
						$objcity = new CLS_CITY();
						$city_name = $objcity->getNameById($r['city']);
						$dataids = $r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'];
						?>
						<tr dataid="<?php echo $id_hoso;?>" dataids="<?php echo $dataids;?>">
							<td align="center"><?php echo $i;?></td>
							<td dataid="<?php echo $id_hoso;?>">
								<?php if($r['id_nganh']!=='') echo $_NGANH['N'.$r['id_nganh']].' - '.$_KHOA['K'.$r['id_khoa']].' - '.$_HE['H'.$r['id_he']];
								else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
							</td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center">
								<?php
								if(strlen($r['malop'])>0) echo $r['malop'];
								else{
									echo '<a href="javascript:void(0)" class="btn btn-default btn_nhaplop" dataids="'.$r['id'].'-'.$r['id_khoa'].'-'.$r['id_he'].'-'.$r['id_nganh'].'">Nhập lớp</a>';
								}
								?>
							</td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $r['id_hoso'];?></td>
							<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']);?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/Y",$r['ngaysinh']);?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $city_name;?></td>
							<td dataid="<?php echo $id_hoso;?>" class="text-center"><a href="<?php echo ROOTHOST.'student/profile/'.$r['id_hoso'];?>" target="_blank" title="">HS chi tiết</a></td>
						</tr>
						<?php 
						$html.='<tr><td align="center">'.$i.'</td>
						<td>';
						if(isset($r['id_nganh'])) $html.= $r['id_nganh'];
						$html.='</td><td>'.$r['malop'].'</td>
						<td>'.$masv.'</td>
						<td>'.stripslashes($r['ho_dem']).'</td>
						<td>'.stripslashes($r['name']).'</td>
						<td align="center">'.$GLOBALS['ARR_GENDER'][$r['gioitinh']].'</td>
						<td align="center">';
						$html.=date("d/m/Y",$r['ngaysinh']);
						$html.='<td>'.$city_name.'</td>';
						$html.='</td>
						</tr>';
					} 
					$html.="</tbody></table>";?>
				</tbody>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
				<tr><td align="center">
					<?php paging($total_rows,MAX_ROWS,$cur_page); ?>
				</td></tr>
			</table>
		</div>
	</div>
</div>
<div id="divToPrint" style="display:none;"><?php echo $html; ?></div>
<script>
	$(document).ready(function(){
		$("#tk_mahs").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_malop").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_hoten").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_ten").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_ns").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_dc").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_btnsearch").click(function(){
			$("#frm_search").submit();
		})

		$(".btn-excel").click(function(){
			showLoading(); 
			link="<?php echo ROOTHOST;?>excel/export_hsdaotao.php?<?php echo $params;?>";
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
		});

		$(".btn-print").click(function(){
			showLoading();
			var screenW =screen.width;
			var screenH =screen.height; console.log(screenW+' / '+screenH);
			var divToPrint = document.getElementById('divToPrint');
			var popupWin = window.open('', '_blank','toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width='+screenW+',height='+screenH);
			popupWin.document.open();
			popupWin.document.write('<html><head><title>Danh sách SV</title>');
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
	})
</script>