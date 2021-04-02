<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$check_permission = $UserLogin->Permission('edu_he');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$key=isset($_GET['q'])?addslashes(strip_tags($_GET['q'])):'';
$strwhere=" AND (id LIKE '%$key%' OR name LIKE '%$key%') ";
?>
<div class='page-title'>BẬC ĐÀO TẠO</div>
<div class="container-fluid">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="edu">
				<input type="hidden" class="form-control" name="task" id="task" value="hedaotao">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Mã, tên bậc đào tạo" value="<?php echo $key;?>">
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
					<th class='text-center'>Mã BĐT</th>
					<th class='text-left'>Tên bậc đào tạo</th>
					<th class='text-center'>Số học kỳ</th>
					<th class='text-right'>Học phí/tín chỉ</th>
					<th class='text-right'>Lệ phí thi lại/môn</th>
					<th class='text-right'>Lệ phí thi CT/môn</th>
					<th class='text-right'>Học phí học lại/tín chỉ</th>
					<th class='text-right'>Học phí học CT/tín chỉ</th>
					<th class='text-center'></th>
				</tr></thead>
				<tbody>
				<?php 
				$obj=new CLS_MYSQL;
				$sql="SELECT * FROM tbl_he WHERE isactive=1 $strwhere";
				$obj->Query($sql);
				$stt=0;
				while($r=$obj->Fetch_Assoc()) {
					$id=$r['id'];
					$stt++;
				?>
				<tr><td class='text-center'><?php echo $stt;?></td>
					<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
					<td class='text-center'><?php echo stripslashes($r['id']);?></td>
					<td><?php echo stripslashes($r['name']);?></td>
					<td class='text-center'><?php echo number_format($r['sohocky']);?></td>
					<td class='text-right'><?php echo number_format($r['hocphi']);?> đ</td>
					<td class='text-right'><?php echo number_format($r['hocphi_thilai']);?> đ</td>
					<td class='text-right'><?php echo number_format($r['hocphi_thict']);?> đ</td>
					<td class='text-right'><?php echo number_format($r['hocphi_hoclai']);?> đ</td>
					<td class='text-right'><?php echo number_format($r['hocphi_hocct']);?> đ</td>
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
	if(confirm('Bạn có chắc chắn muốn xóa bậc đào tạo này?')){
		var _id=$(this).attr('dataid');
		var _url='ajaxs/he/process_del.php';
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
	var _url='ajaxs/he/frm_edit.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Sửa bậc đào tạo');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
$('#btn_add').click(function(){
	var _id=$(this).attr('dataid');
	var _url='ajaxs/he/frm_add.php';
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Thêm mới bậc đào tạo');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
</script>