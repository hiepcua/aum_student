<?php
defined('ISHOME') or die("You can't access this page!");
$ma=isset($_GET['ma'])?addslashes(strip_tags($_GET['ma'])):'';
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$phone=isset($_GET['phone'])?addslashes(strip_tags($_GET['phone'])):'';
$email=isset($_GET['email'])?addslashes(strip_tags($_GET['email'])):'';

$strWhere='';
if($ma!='') $strWhere.=" AND (ma LIKE '%$ma%')";
if($ten!='') $strWhere.=" AND ( name LIKE '%$ten%' OR nickname LIKE '%$ten%')";
if($cmt!='') $strWhere.=" AND cmt LIKE '%$cmt%'";
if($phone!='') $strWhere.=" AND dienthoai='$phone'";
if($email!='') $strWhere.=" AND email='$email'";
if($ns!='') {
	$int_ns = strtotime($ns);
	$strWhere.=" AND ngaysinh = '$int_ns'";
}
if($dc!='') $strWhere.=" AND diachi LIKE '%$dc%'";

$total_rows=SysCount('tbl_hocsinh',$strWhere);
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$limit = ' LIMIT '.$start.','. MAX_ROWS;
//--------------------------------------
$obj=SysGetList('tbl_hocsinh',array(),"$strWhere ORDER BY `mdate` DESC, id DESC $limit",false);
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý hồ sơ</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>?com=student&task=import" class="btn btn-success btn-import" title="Import hồ sơ"><i class="fa fa-upload"></i> Import hồ sơ</a>
				</li>
				<li>
					<a href="<?php echo ROOTHOST;?>student/add" class="btn btn-primary btn-add" title="Thêm hồ sơ"><i class="fa fa-plus"></i> Thêm hồ sơ</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="customer_list">
		<?php include("search_hs.php");?>
		<div id="contextMenu" class="dropdown clearfix">
			<input type="hidden" id="right_click_id" value=""/>
			<input type="hidden" id="right_click_ids" value=""/>
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
				<li><a tabindex="-1" href="javascript:void(0)" class="view_profile">Hồ sơ chi tiết</a></li>
				<li><a tabindex="-1" href="javascript:void(0)" class="view_soyeulylich">Sơ yếu lý lịch</a></li>
				<li><a tabindex="-1" href="javascript:void(0)" class="xoa_hoso">Xóa hồ sơ hiện tại</a></li>
			</ul>
		</div>
		<div id="list_profile" class="table-responsive">
			<table class="list table table-striped table-bordered">
				<thead><tr class="header">
					<th class="text-center">STT</th>
					<th>Mã hồ sơ</th>
					<th>Họ tên</th>
					<th class="text-center">Giới tính</th>
					<th class="text-center">Điện thoại</th>
					<th class="text-center">Email</th>
					<th class="text-center">Địa chỉ</th>
					<th class="text-center">Ngày BG</th>
					<th class="text-center">Tình trạng BG</th>
					<th class="text-center">Lý do BG</th>
					<!--<th class="text-center">Trạng thái HS</th>-->
				</tr></thead>
				<tbody>
					<?php
					$i=$start;
					while($r=$obj->Fetch_Assoc()) { $i++;
					$id_hoso = $r['ma'];
					$dataids = '---';
					?>
					<tr dataid="<?php echo $id_hoso;?>" dataids="<?php echo $dataids;?>">
						<td align="center"><?php echo $i;?></td>
						<td dataid="<?php echo $id_hoso;?>">
							<a href="<?php echo ROOTHOST;?>student/profile/<?php echo $id_hoso;?>"><?php echo stripslashes($id_hoso);?></a>
						</td>
						<td dataid="<?php echo $id_hoso;?>">
							<a href="<?php echo ROOTHOST;?>student/profile/<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']);?></a>
						</td>
						<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $r['gioitinh']=='nam' ? 'Nam' : 'Nữ';?></td>
						<td class='text-center'><?php echo stripslashes($r['dienthoai']);?></td>
						<td><?php echo stripslashes($r['email']);?></td>
						<td><?php echo stripslashes($r['hktt']);?></td>
						<td class="text-center"><?php if($r['ngayBG']!=null) echo date("d/m/Y",$r['ngayBG']);?></td>
						<td class="text-center"><?php echo $r['tinhtrangBG'];?></td>
						<td class="text-center"><?php echo $r['lydoBG'];?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
			<tr>
				<td align="center"><?php paging($total_rows,MAX_ROWS,$cur_page); ?></td>
			</tr>
		</table>
	</div>
</div>
<script>
	/* $('.btn-active').click(function(){
		var url='<?php echo ROOTHOST;?>ajaxs/tuyensinh/process_active.php';
		$.get(url,{'ma':$(this).attr('dataid')},function(req){
			window.location.reload();
		});
	}); */
</script>