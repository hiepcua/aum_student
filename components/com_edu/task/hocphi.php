<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$check_permission = $UserLogin->Permission('edu_hocphi');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);
?>
<div class='page-title'>DANH MỤC HỌC PHÍ</div>
<div class="">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<input type='hidden' name='com' value='<?php echo $COMS;?>'/>
			<input type='hidden' name='task' value='<?php echo $task;?>'/>
			
			<div class="pull-right">
				<div class="form-group">
					<button type="button" class="btn btn-primary" id="btn_add"><i class="fa fa-plus"></i> Thêm mới</button>
					<button type="button" class="btn btn-primary" id="btn_add_config"><i class="fa fa-plus"></i> Cấu hình chung</button>
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
					<th>Ngành</th><th>Bậc</th>
					<th>Tên danh mục</th>
					<th class='text-right'>Học phí</th>
					<th></th>
				</tr></thead>
				<tbody>
					<?php 
					$obj=new CLS_MYSQL;
					$sql="SELECT * FROM tbl_dmhocphi WHERE 1=1";
					$obj->Query($sql." ORDER by `all` DESC,id_nganh ASC, id_he ASC, id ASC");
					$stt=0;
					if($obj->Num_rows()>0){
						while($r=$obj->Fetch_Assoc()) {
							$id=$r['id'];
							$hocphi=$r['hocphi'];
							$stt++;
							?>
							<tr><td class='text-center'><?php echo $stt;?></td>
								<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
								<td><?php if($r['all']==0) echo $arrNganh[$r['id_nganh']]; else echo 'Tất cả';?></td>
								<td><?php if($r['all']==0) echo $arrHe[$r['id_he']]; else echo 'Tất cả';?></td>
								<td><?php echo stripslashes($r['name']);?></td>
								<td class='text-right cred'><b><?php echo number_format($hocphi);?></b></td>
								<td class='text-center'>
									<?php if($r['all']==1) { ?>
										<i class="fa fa-pencil-square-o btn_edit_config" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
									<?php } else { ?>
										<i class="fa fa-pencil-square-o btn_edit" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
									<?php } ?>
								</td>
							</tr>
						<?php } 
					}else{
						echo "<tr><td colspan='6' class='text-center red'>Không danh mục nào</td></tr>";
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$('.btn_xoa').click(function(){
		if(confirm('Bạn có chắc chắn muốn xóa hoc phí này?')){
			var _id=$(this).attr('dataid');
			var _url='ajaxs/dmhocphi/process_del.php';
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
	$('#btn_add').click(function(){
		var _url='ajaxs/dmhocphi/frm_add.php';
		$('#myModalPopup .modal-dialog').removeClass('modal-lg');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-title').html('Thêm mới danh mục học phí');
		$.post(_url,{},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	});
	$('.btn_edit').click(function(){
		var _id=$(this).attr('dataid');
		var _nganh=$('#cbo_nganh').val();
		var _url='ajaxs/dmhocphi/frm_edit.php';
		$('#myModalPopup .modal-dialog').removeClass('modal-lg');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-title').html('Sửa danh mục học phí');
		$.post(_url,{'id':_id,'nganh':_nganh},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	});
	$('#btn_add_config').click(function(){
		var _url='ajaxs/dmhocphi/frm_add_config.php';
		$('#myModalPopup .modal-dialog').removeClass('modal-lg');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-title').html('Thêm mới danh mục học phí chung');
		$.post(_url,function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	});
	$('.btn_edit_config').click(function(){
		var _id=$(this).attr('dataid');
		var _nganh=$('#cbo_nganh').val();
		var _url='ajaxs/dmhocphi/frm_edit_config.php';
		$('#myModalPopup .modal-dialog').removeClass('modal-lg');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-title').html('Sửa danh mục học phí chung');
		$.post(_url,{'id':_id,'nganh':_nganh},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	});
</script>