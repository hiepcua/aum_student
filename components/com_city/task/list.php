<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$check_permission = $UserLogin->Permission('city');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$key=isset($_GET['q'])?addslashes(strip_tags($_GET['q'])):'';
$strwhere="";
if($key!="") $strwhere=" AND (name LIKE '%$key%' OR phone LIKE '%$key%') ";
?>
<div class='page-title'>QUẢN LÝ KHU VỰC TỈNH/THÀNH</div>
<div class="container-fluid">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="city">
				<input type="hidden" class="form-control" name="task" id="task" value="">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Tên tỉnh thành" value="<?php echo $key;?>">
			</div></div>
			<div class="col-md-1">
				<button type="submit" class="btn btn-primary" name="cmdsearch" id="cmdsearch"><i class="fa fa-search"></i> Tìm</button>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-primary" name="filterDebt" id="btn_add"><i class="fa fa-dollar"></i> Thêm mới</button>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
	<?php $obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_city WHERE 1=1 $strwhere"; 
	$obj->Query($sql);
	$total_rows = $obj->Num_rows(); $arr_city=array();
	while($r=$obj->Fetch_Assoc()) $arr_city[]=$r;?>
	<div class="col-md-6 col-xs-12" style="width:49%">
		<div class="row">
			<table class="table table-bordered">
				<thead><tr>
					<th width='30'>STT</th>
					<th width='30'></th>
					<th class='text-left'>Mã tỉnh/thành</th>
					<th class='text-left'>Tên tỉnh/thành</th>
					<th class='text-center'></th>
				</tr></thead>
				<tbody>
				<?php 
				$stt=0;
				for($i=0;$i<round($total_rows/2);$i++){
					$r=$arr_city[$i];
					$id=$r['id']; $stt++;
				?>
				<tr><td class='text-center'><?php echo $stt;?></td>
					<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
					<td>#<?php echo stripslashes($r['id']);?></td>
					<td><?php echo stripslashes($r['name']);?></td>
					<td class='text-center'>
					<i class="fa fa-pencil-square-o btn_edit" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6 col-xs-12 pull-right" style="width:49%">
		<div class="row">
			<table class="table table-bordered">
				<thead><tr>
					<th width='30'>STT</th>
					<th width='30'></th>
					<th class='text-left'>Mã tỉnh/thành</th>
					<th class='text-left'>Tên tỉnh/thành</th>
					<th class='text-center'></th>
				</tr></thead>
				<tbody>
				<?php 
				for($i=round($total_rows/2);$i<$total_rows;$i++){
					$stt++;
					$r=$arr_city[$i];
					$id=$r['id']; 
				?>
				<tr><td class='text-center'><?php echo $stt;?></td>
					<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
					<td>#<?php echo stripslashes($r['id']);?></td>
					<td><?php echo stripslashes($r['name']);?></td>
					<td class='text-center'>
					<i class="fa fa-pencil-square-o btn_edit" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
$('.btn_xoa').click(function(){
	if(confirm('Bạn có chắc chắn muốn xóa tỉnh/thành này?')){
		var _id=$(this).attr('dataid');
		var _url='ajaxs/city/process_del.php';
		$.post(_url,{'id':_id},function(req){
			if(req=='success'){
				window.location.reload();
			}else{
				console.log(req);
				alert('Error:'+req);
			}
		});
	}
});
$('.btn_edit').click(function(){
	var _id=$(this).attr('dataid');
	var _url='ajaxs/city/frm_edit.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Cập nhật tỉnh/thành');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
$('#btn_add').click(function(){
	var _url='ajaxs/city/frm_add.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Thêm mới tỉnh/thành');
	$.post(_url,function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
</script>