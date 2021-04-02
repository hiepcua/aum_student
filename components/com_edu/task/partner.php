<?php
defined('ISHOME') or die('Can not acess this page, please come back!');

// get total hoso by partner
$obj = new CLS_MYSQL;
$sql = "select b.partner_id,count(b.partner_id) as num 
		from tbl_dangky_tuyensinh as a 
		inner join tbl_hocsinh as b on a.id_hoso=b.ma 
		left join tbl_partner as c on c.id=b.partner_id
		group by b.partner_id order by num DESC "; 
$obj->Query($sql);
$arr_total = array();
while($r=$obj->Fetch_Assoc()) $arr_total[$r['partner_id']]=$r['num'];

$key=isset($_GET['q'])?addslashes(strip_tags($_GET['q'])):'';
$strwhere=" AND (name LIKE '%$key%' OR phone LIKE '%$key%') ";
?>
<div class='page-title'>ĐỐI TÁC TUYỂN SINH</div>
<div class="container-fluid">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="edu">
				<input type="hidden" class="form-control" name="task" id="task" value="partner">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Tên, số điện thoại đối tác" value="<?php echo $key;?>">
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
	<div class="col-md-12">
		<div class="row">
			<table class="table table-bordered">
				<thead><tr>
					<th width='30'>STT</th>
					<th width='30'></th>
					<th class='text-left'>Mã đối tác</th>
					<th class='text-left'>Tên đối tác</th>
					<th class='text-left'>Địa chỉ</th>
					<th class='text-center'>Điện thoại</th>
					<th class='text-center'>Hồ sơ</th>
					<th class='text-center'></th>
				</tr></thead>
				<tbody>
				<?php 
				$sql="SELECT * FROM tbl_partner WHERE 1=1 $strwhere";
				$obj->Query($sql);
				$stt=0;
				while($r=$obj->Fetch_Assoc()) {
					$id=$r['id'];
					$stt++;
					$hoso=$arr_total[$id];
				?>
				<tr><td class='text-center'><?php echo $stt;?></td>
					<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
					<td>#<?php echo stripslashes($r['id']);?></td>
					<td><?php echo stripslashes($r['name']);?></td>
					<td><?php echo stripslashes($r['diachi']);?></td>
					<td class='text-right'><?php echo stripslashes($r['phone']);?></td>
					<td class='text-center'><?php echo number_format($hoso);?></td>
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
	if(confirm('Bạn có chắc chắn muốn xóa đối tác này?')){
		var _id=$(this).attr('dataid');
		var _url='ajaxs/partner/process_del.php';
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
	var _url='ajaxs/partner/frm_edit.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Sửa đối tác tuyển sinh');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
$('#btn_add').click(function(){
	var _url='ajaxs/partner/frm_add.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Thêm mới đối tác tuyển sinh');
	$.post(_url,function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
</script>