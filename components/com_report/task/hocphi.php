<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa=$id_lop=$id_partner=$id_lop='';
$hocky=3; $id_hocky=1;
//print_r($_GET);
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;
$obj = new CLS_MYSQL;
$id_khoa=isset($_GET['khoa'])?addslashes(strip_tags($_GET['khoa'])):'';
$id_he=isset($_GET['bac'])?addslashes(strip_tags($_GET['bac'])):'';
$id_nganh=isset($_GET['nganh'])?addslashes(strip_tags($_GET['nganh'])):'';
$id_lop=isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
$id_hocky=isset($_GET['hocky'])?(int)$_GET['hocky']:1;

$sql = "select masv,sum(hocphi) as total,ispay from tbl_hocphi";
if($id_hocky!=='') $sql.=" WHERE hocky='$id_hocky'"; 
$sql.=" group by masv,ispay";

$obj->Query($sql);
$arrHP = array(); $tonghp=0;
while($rs=$obj->Fetch_Assoc()) {
	$arrHP[$rs['masv']][$rs['ispay']]=$rs['total']+0;
}
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai
		FROM tbl_dangky_tuyensinh AS a 
		INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma "; 

switch($hocky) {
	case "0":$sql.=" WHERE b.isactive=1 and (a.masv='' OR a.masv is null) AND a.trungtuyen is null and a.nhaphoc is null";break;
	case "1":$sql.=" WHERE b.isactive=1 and (a.masv='' or a.masv is null) AND trungtuyen=1 AND a.nhaphoc is null";break;
	case "2":$sql.=" WHERE b.isactive=1 and (a.masv='' or a.masv is null) AND trungtuyen=1 AND nhaphoc=1";break;
	case "3":$sql.=" WHERE b.isactive=1 and a.masv<>''";break;
}

if($id_khoa!=='') $sql.=" AND a.id_khoa='$id_khoa'";
if($id_he!=='') $sql.=" AND a.id_he='$id_he'";
if($id_nganh!=='') $sql.=" AND a.id_nganh='$id_nganh'";
if($id_lop!=='') $sql.=" AND a.malop='$id_lop'";

$sql.=" ORDER BY b.masv ";
$obj->Query($sql);	//echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." LIMIT $start,".MAX_ROWS);
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Thống kê Học phí</div>
			</div><?php /*
			<ul class="box-function pull-right">
				<li><button type="button" class="btn btn-warning btn-print" title="In hồ sơ">
					<i class="fa fa-print"></i> In</button></li>
				<li><button class="btn btn-default" title="Thoát">
					<i class="fa fa-file-excel"></i> Xuất File Excel</a></li>
			</ul>*/?>
		</div>
	</div>
	<div class="search_box panel panel-warning"><div class="panel-body"><div class="media row">
		<form name="frm_search" id="frm_search" method="get" action="#">
		<div class="form-group">
			<div class="col-md-2 col-xs-6">
				<select name="khoa" id="cbokhoa" class="form-control" >
				<option value="">Khóa</option>
				<?php 
				$objkhoa = new CLS_KHOA;
				$objkhoa->getList(" AND type=1");
				while($r_khoa=$objkhoa->Fetch_Assoc()) { ?>
				<option value="<?php echo $r_khoa['id'];?>" <?php if($id_khoa==$r_khoa['id']) echo "selected";?>>
				<?php echo $r_khoa['name'];?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col-md-2 col-xs-6">
				<select name="bac" id="cbobac" class="form-control" >
				<option value="">Bậc đào tạo</option>
				<?php $objhe = new CLS_HE;
				$objhe->getList();
				while($r_he=$objhe->Fetch_Assoc()) { ?>
				<option value="<?php echo $r_he['id'];?>" <?php if($id_he==$r_he['id']) echo "selected";?>>
				<?php echo $r_he['name'];?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col-md-2 col-xs-6">
				<select name="nganh" id="ma_nganh" class="form-control" >
				<option value="">Ngành</option>
				<?php $objng = new CLS_NGANH;
				$objng->getList(); 
				while($r_nganh=$objng->Fetch_Assoc()) { ?>
				<option value="<?php echo $r_nganh['id'];?>" <?php if($id_nganh==$r_nganh['id']) echo "selected";?>>
				<?php echo $r_nganh['id']." - ".$r_nganh['name'];?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col-md-2 col-xs-6">
				<select name="malop" id="ma_lop" class="form-control" >
				<option value="">Lớp</option>
				<?php $objlop = new CLS_LOP;
				$objlop->getList(); 
				while($r_lop=$objlop->Fetch_Assoc()) { ?>
				<option value="<?php echo $r_lop['id'];?>" <?php if($id_lop==$r_lop['id']) echo "selected";?>>
				<?php echo $r_lop['id'];?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col-md-2 col-xs-6">
				<select name="hocky" id="hocky" class="form-control" >
				<option value="">Học kỳ</option>
				<?php for($i=1;$i<=$hocky;$i++) { ?>
				<option value="<?php echo $i;?>" <?php if($id_hocky==$i) echo "selected";?>>
				Học kỳ <?php echo $i;?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col-md-2 col-xs-6">
				<button type="submit" id="tk_btnsearch" class="btn btn-primary form-control">
				<i class="fa fa-search"></i> Lọc</button>
			</div>
		</div>
		</form>
	</div></div></div>
	<table class="list table table-striped table-bordered">
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
		<tbody>
		<?php $i=1;
		$mon1 =$mon2=$mon3=''; 
		while($r=$obj->Fetch_Assoc()) { 
		$id_hoso = $r['ma']; $masv=$r['masv']; 
		$total=0; $dadong=$chuadong=0;
		if(isset($arrHP[$masv][0])) $chuadong=$arrHP[$masv][0];
		if(isset($arrHP[$masv][1])) $dadong=$arrHP[$masv][1];
		$total = $dadong+$chuadong;
		?>
		<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
		
		<td dataid="<?php echo $id_hoso;?>"><?php echo $r['id_nganh'];?></td>
		<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']);?></td>
		<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['name']);?></td>
		<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
		<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/y",$r['ngaysinh']);?></td>
		<td align="center"><?php echo $r['malop'];?></td>
		<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $masv;?></td>
		<td align="center"><b class="cred"><?php echo number_format($total);?></b></td>
		<td align="center"><label class="label label-success"><big><?php echo number_format($dadong);?></big></label></td>
		<td align="center"><label class="label label-danger"><big><?php echo number_format($chuadong);?></big></label></td>
		</tr><?php $i++;} ?>
		</tbody>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
	  <tr><td align="center">
		<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
		</td></tr>
	</table>
</div>
<script></script>