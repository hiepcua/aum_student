<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa=$id_city='';
//print_r($_GET);
$id_khoa=isset($_GET['khoa'])?addslashes(strip_tags($_GET['khoa'])):'';
$id_he=isset($_GET['bac'])?addslashes(strip_tags($_GET['bac'])):'';

$obj = new CLS_MYSQL;
$sql = "select a.id,b.city,c.name as city_name,count(b.city) as num 
		from tbl_dangky_tuyensinh as a
		inner join tbl_hocsinh as b on a.id_hoso=b.ma
		inner join tbl_city as c on c.id=b.city where 1=1 "; 
if($id_khoa!=="") $sql.=" AND a.id_khoa='$id_khoa' ";
if($id_he!=="") $sql.=" AND a.id_he='$id_he' ";
$sql.="group by b.city";
$obj->Query($sql);	//echo $sql;
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Thống kê Hồ sơ theo tỉnh/thành</div>
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
				<button type="submit" id="tk_btnsearch" class="btn btn-primary form-control">
				<i class="fa fa-search"></i> Lọc</button>
			</div>
		</div>
		</form>
	</div></div></div>
	<table class="list table table-striped table-bordered">
		<thead><tr class="header">
			<th class="text-center">STT</th>
			<th>Tỉnh/thành</th><th>Tổng hồ sơ</th>
			<th>Ngành</th>
			<th>Xem danh sách</th>
		</tr></thead>
		<tbody>
		<?php $i=1; $total = 0;
		while($r=$obj->Fetch_Assoc()) { 
		$city = $r['city']; $total+=$r['num'];
		$objts = new CLS_TUYENSINH;
		$str = $objts->NumberNganhByCity($id_khoa,$id_he,$city);?>
		<tr><td align="center"><?php echo $i;?></td>
		
		<td><?php echo stripslashes($r['city_name']);?></td>
		<td class="text-center cred"><b><?php echo number_format($r['num']);?></b></td>
		<td><?php echo $str;?></td>
		<td class="text-center">
			<a href="<?php echo ROOTHOST;?>report/hoso/tonghop?khoa=<?php echo $id_khoa;?>&bac=<?php echo $id_he;?>&city=<?php echo $city;?>" class="btn btn-default"><i class="fa fa-list"></i></a>
		</td>
		</tr><?php $i++;} ?>
		<tr style="background:#ccc;font-weight:bold"><td></td>
			<td class="text-right">Tổng</td>
			<td class="text-center"><?php echo number_format($total);?></td>
			<td></td><td></td></tr>
		</tbody>
	</table>
</div>