<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$check_permission = $UserLogin->Permission('edu_khoa');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$key=isset($_GET['q'])?addslashes(strip_tags($_GET['q'])):'';
$strwhere=" AND (id LIKE '%$key%' OR name LIKE '%$key%') ";
?>
<div class='page-title'>KHÓA ĐÀO TẠO</div>
<div class="container-fluid">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="edu">
				<input type="hidden" class="form-control" name="task" id="task" value="nienkhoa">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Khóa đào tạo" value="<?php echo $key;?>">
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
					<th>Mã khóa đào tạo</th>
					<th>Tên khóa đào tạo</th>
					<th class='text-center'></th>
				</tr></thead>
				<tbody>
				<?php 
				$obj=new CLS_MYSQL;
				$sql="SELECT * FROM tbl_khoa WHERE 1=1 $strwhere";
				$obj->Query($sql);
				$stt=0;
				while($r=$obj->Fetch_Assoc()) {
					$id=$r['id'];
					$stt++;
				?>
				<tr><td class='text-center'><?php echo $stt;?></td>
					<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
					<td><?php echo stripslashes($r['id']);?></td>
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
	if(confirm('Bạn có chắc chắn muốn xóa khóa đào tạo này?')){
		var _id=$(this).attr('dataid');
		var _url='ajaxs/khoa/process_del.php';
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
	var _url='ajaxs/khoa/frm_edit.php';
	$('#myModalPopup .modal-dialog').removeClass('modal-sm modal-md modal-lg');
	$('#myModalPopup .modal-dialog').addClass('modal-md');
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Cập nhật khóa đào tạo');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
$('#btn_add').click(function(){
	var _id=$(this).attr('dataid');
	var _url='ajaxs/khoa/frm_add.php';
	$('#myModalPopup .modal-dialog').removeClass('modal-sm modal-md modal-lg');
	$('#myModalPopup .modal-dialog').addClass('modal-md');
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Thêm mới khóa đào tạo');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
</script>