<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa=$id_city=$id_partner='';
//print_r($_GET);
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;
$obj = new CLS_MYSQL;
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma "; 
$id_khoa=isset($_GET['khoa'])?addslashes(strip_tags($_GET['khoa'])):'';
$id_he=isset($_GET['bac'])?addslashes(strip_tags($_GET['bac'])):'';
$id_nganh=isset($_GET['nganh'])?addslashes(strip_tags($_GET['nganh'])):'';
$id_city=isset($_GET['city'])?addslashes(strip_tags($_GET['city'])):'';
$id_partner=isset($_GET['partner'])?addslashes(strip_tags($_GET['partner'])):'';
$gender=isset($_GET['gender'])?(int)$_GET['gender']:-1;
$type=isset($_GET['type'])?(int)$_GET['type']:0;

switch($type) {
	case "0":$sql.=" WHERE b.isactive=1 and (a.masv='' OR a.masv is null) AND a.trungtuyen is null and a.nhaphoc is null";break;
	case "1":$sql.=" WHERE b.isactive=1 and (a.masv='' or a.masv is null) AND trungtuyen=1 AND a.nhaphoc is null";break;
	case "2":$sql.=" WHERE b.isactive=1 and (a.masv='' or a.masv is null) AND trungtuyen=1 AND nhaphoc=1";break;
	case "3":$sql.=" WHERE b.isactive=1 and a.masv<>''";break;
}

if($id_khoa!=='') $sql.=" AND a.id_khoa='$id_khoa'";
if($id_he!=='') $sql.=" AND a.id_he='$id_he'";
if($id_nganh!=='') $sql.=" AND a.id_nganh='$id_nganh'";
if($id_city!=='') $sql.=" AND b.city='$id_city'";
if($id_partner!=='') $sql.=" AND b.partner_id='$id_partner'";
if($gender>-1) $sql.=" AND b.gioitinh=$gender";

switch($type) {
	case "1":$sql.=" ORDER BY a.nhaphoc ASC ";break;
}

$obj->Query($sql);	//echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." LIMIT $start,".MAX_ROWS);
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Thống kê Hồ sơ tổng hợp</div>
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
				<select name="city" id="cbo_city" class="form-control">
					<option value="">Tỉnh/thành</option>
					 <?php
					 include_once(LIB_PATH.'cls.city.php');
					 $objCb=new CLS_city();
					 $objCb->getList();
					 while ($city = $objCb->Fetch_Assoc()) {?>
					 <option value="<?php echo $city['id'];?>" <?php if($id_city==$city['id']) echo "selected";?>><?php echo $city['name'];?></option>
					 <?php } unset($objCb); ?>
				 </select>
			</div>
			<div class="col-md-2 col-xs-6">
				<select name="partner" id="cbo_partner" class="form-control">
					<option value="">Đối tác</option>
					 <?php
					 include_once(LIB_PATH.'cls.partner.php');
					 $objpart=new CLS_PARTNER();
					 $objpart->getList();
					 while ($part = $objpart->Fetch_Assoc()) {?>
					 <option value="<?php echo $part['id'];?>" <?php if($id_partner==$part['id']) echo "selected";?>><?php echo $part['name'];?></option>
					 <?php } unset($objpart); ?>
				 </select>
			</div>
			<div class="col-md-2 col-xs-6">
				<button type="submit" id="tk_btnsearch" class="btn btn-primary form-control">
				<i class="fa fa-search"></i> Lọc</button>
			</div>
		</div>
		<div class="form-group"><div class="col-md-12 col-xs-12">
			<fieldset id="group1">
				<input type="radio" name="gender" value="0" <?php if($gender==0) echo "checked";?>> 
				<?php echo $GLOBALS['ARR_GENDER'][0];?>
				<input type="radio" name="gender" value="1" <?php if($gender==1) echo "checked";?>> 
				<?php echo $GLOBALS['ARR_GENDER'][1];?>
			 </fieldset>
		</div></div>
		<div class="form-group">
			<div class="col-md-12 col-xs-12">
				<input type="radio" name="type" value="0" <?php if($type===0) echo "checked";?>> Hồ sơ tuyển sinh (mới)
				<input type="radio" name="type" value="1" <?php if($type===1) echo "checked";?>> Hồ sơ đã trúng tuyển
				<input type="radio" name="type" value="2" <?php if($type===2) echo "checked";?>> Hồ sơ đã nhập học
				<input type="radio" name="type" value="3" <?php if($type===3) echo "checked";?>> Hồ sơ sinh viên
			</div>
		</div>
		</form>
	</div></div></div>
	<table class="list table table-striped table-bordered">
		<thead><tr class="header">
			<th class="text-center">STT</th>
			<th>Họ đệm</th><th>Tên</th>
			<th>Giới tính</th>
			<th class="text-center">Ngày sinh</th>
			<th class="text-center">Ngành</th>
			<th class="text-center">Mã SV</th>
			<th class="text-center">Lớp</th>
		</tr></thead>
		<tbody>
		<?php $i=1;
		$mon1 =$mon2=$mon3='';
		while($r=$obj->Fetch_Assoc()) { 
		$id_hoso = $r['ma']; $masv=$r['masv']; 
		?>
		<tr dataid="<?php echo $id_hoso;?>"><td align="center"><?php echo $i;?></td>
		
		<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']);?></td>
		<td dataid="<?php echo $id_hoso;?>"><?php echo stripslashes($r['name']);?></td>
		<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
		<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/y",$r['ngaysinh']);?></td>
		<td dataid="<?php echo $id_hoso;?>">
			<?php if(isset($r['id_nganh'])) echo $r['id_nganh'];
			else echo "<button class='dk_nganh btn btn-default' dataid='".$id_hoso."'><i class='fa fa-plus cgray'></i> Đăng ký</button>";?>
		</td>
		<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $masv;?></td>
		<td align="center"><?php echo $r['malop'];?></td>
		</tr><?php $i++;} ?>
		</tbody>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
	  <tr><td align="center">
		<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
		</td></tr>
	</table>
</div>