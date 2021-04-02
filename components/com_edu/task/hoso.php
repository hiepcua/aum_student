<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$check_permission = $UserLogin->Permission('edu_hoso');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);
?>
<div class="container-fluid list_new"><br/>
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<input type='hidden' name='com' value='<?php echo $COMS;?>'/>
			<input type='hidden' name='task' value='<?php echo $task;?>'/>
			<div class="pull-right">
				<div class="form-group">
					<button type="button" class="btn btn-primary" id="btn_add"><i class="fa fa-dollar"></i> Thêm mới</button>
					<button type="button" class="btn btn-primary" id="add_config"><i class="fa fa-dollar"></i> Cấu hình chung</button>
				</div>
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
					<th>Bậc đào tạo</th>
					<th>Tên danh mục</th>
					<th></th>
				</tr></thead>
				<tbody>
					<?php 
					$obj=new CLS_MYSQL;
					$sql="SELECT a.*,b.name AS he FROM tbl_dmhoso AS a 
					LEFT JOIN tbl_he AS b ON a.id_he=b.id WHERE 1=1";
					$sql.=" ORDER BY id_he ASC";
					$obj->Query($sql); 
					$stt=0;
					if($obj->Num_rows()>0){
						while($r=$obj->Fetch_Assoc()) {
							$id=$r['id'];
							$stt++; 
							?>
							<tr><td class='text-center'><?php echo $stt;?></td>
								<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
								<td><?php if($r['all']==0) echo stripslashes($r['he']); else echo 'Tất cả';?></td>
								<td><?php echo stripslashes($r['name']);?></td>
								<td class='text-center'>
									<i class="fa fa-pencil-square-o btn_edit" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
								</td>
							</tr>
						<?php } 
					}else{
						echo "<tr><td colspan='5' class='text-center red'>Không danh mục nào</td></tr>";
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$('.btn_xoa').click(function(){
		if(confirm('Bạn có chắc chắn muốn xóa danh mục này?')){
			var _id=$(this).attr('dataid');
			var _url='ajaxs/dmhoso/process_del.php';
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
		var _url='ajaxs/dmhoso/frm_edit.php';
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm modal-md modal-xl');
		$('#myModalPopup .modal-dialog').addClass('modal-md');
		$('#myModalPopup .modal-title').html('Sửa danh mục hồ sơ');
		$.post(_url,{'id':_id},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	});
	$('#btn_add').click(function(){
		var _url='ajaxs/dmhoso/frm_add.php';
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm modal-md modal-xl');
		$('#myModalPopup .modal-dialog').addClass('modal-md');
		$('#myModalPopup .modal-title').html('Thêm mới danh mục hồ sơ');
		$.post(_url,{},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	});
	$('#add_config').click(function(){
		var _url='ajaxs/dmhoso/frm_add_config.php';
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm modal-md modal-xl');
		$('#myModalPopup .modal-dialog').addClass('modal-md');
		$('#myModalPopup .modal-title').html('Thêm danh mục hồ sơ chung');
		$.post(_url,function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	});
</script>