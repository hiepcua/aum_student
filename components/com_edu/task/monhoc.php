<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$check_permission = $UserLogin->Permission('edu_monhoc');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$key=isset($_GET['q'])?addslashes(strip_tags($_GET['q'])):'';
$strwhere='';
if($key!='')
$strwhere=" AND (id LIKE '$key %' OR id LIKE '% $key %' or id LIKE '% $key' OR id='$key'
OR `name` LIKE '$key %' OR `name` LIKE '% $key %' or `name` LIKE '% $key' OR `name`='$key') "; 
?>
<div class='page-title'>DANH MỤC MÔN HỌC</div>
<div class="container-fluid">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="edu">
				<input type="hidden" class="form-control" name="task" id="task" value="monhoc">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Mã, tên môn học" value="<?php echo $key;?>">
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
					<th>Mã môn học</th>
					<th>Tên môn học</th>
					<th class='text-center'><span title='Thi tốt nghiệp'>TTN</span></th>
					<th class='text-center'></th>
				</tr></thead>
				<tbody>
				<?php 
				$obj=new CLS_MYSQL;
				$sql="SELECT * FROM tbl_monhoc WHERE 1=1 $strwhere";
				$obj->Query($sql);

				$total_rows = $obj->Num_rows();
				$max_pages = ceil($total_rows/MAX_ROWS);
				$cur_page = postCurentPage($max_pages);
				$start = ($cur_page - 1) * MAX_ROWS;
				$limit = ' LIMIT '.$start.','. MAX_ROWS;
				$sql.= $limit;
				$obj->Query($sql);

				$stt=$start;
				while($r=$obj->Fetch_Assoc()) {
					$id=$r['id'];
					$stt++;
					$ttn=$r['ttn']==1?"Yes":"";
				?>
				<tr><td class='text-center'><?php echo $stt;?></td>
					<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
					<td><?php echo stripslashes($r['id']);?></td>
					<td><?php echo stripslashes($r['name']);?></td>
					<td class='text-center'><?php echo $ttn;?></td>
					<td class='text-center'>
					<i class="fa fa-pencil-square-o btn_edit" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
			  <tr><td align="center">
				<?php  paging_index($total_rows,MAX_ROWS,$cur_page); ?>
				</td></tr>
			</table>
		</div>
	</div>
</div>
<script>
$('.btn_xoa').click(function(){
	if(confirm('Bạn có chắc chắn muốn xóa môn học này?')){
		var _id=$(this).attr('dataid');
		var _url='ajaxs/monhoc/process_del.php';
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
	var _url='ajaxs/monhoc/frm_edit.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Sửa môn học');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
$('#btn_add').click(function(){
	var _id=$(this).attr('dataid');
	var _url='ajaxs/monhoc/frm_add.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Thêm mới môn học');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
</script>