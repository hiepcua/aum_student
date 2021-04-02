<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$check_permission = $UserLogin->Permission('edu_khungdt');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);
$obj=new CLS_MYSQL;

$_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$_HE = isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
// ---------------------------------------------
$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$arrHe=array();
while($r=$obj->Fetch_Assoc()){
	$arrHe[$r['id']]=$r['name'];
}
// ---------------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$arrNganh=array();
while($r=$obj->Fetch_Assoc()){
	$arrNganh[$r['id']]=$r['name'];
}
?>
<div class='page-title'>CHƯƠNG TRÌNH KHUNG</div>
<div class="">
	<div class="clearfix"></div>
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<input type='hidden' name='com' value='<?php echo $COMS;?>'/>
			<input type='hidden' name='task' value='<?php echo $task;?>'/>
			
			<div class="pull-right">
				<label>&nbsp;&nbsp;</label>
				<button type="button" class="btn btn-primary" name="filterDebt" id="btn_add"><i class="fa fa-plus"></i> Thêm mới</button>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="row">
			<table class="table table-bordered" id='tbl_hocphan'>
				<thead><tr>
					<th width='30'>STT</th>
					<th width='30'></th>
					<th class='text-left'>Ngành</th>
					<th class='text-left'>Bậc</th>
					<th class='text-left'>Mã học phần</th>
					<th class='text-left'>Tên học phần</th>
					<th class='text-center'>Tín chỉ</th>
					<th class='text-center'>% chuyên cần</th>
					<th class='text-center'>% kiểm tra</th>
					<th class='text-center'>% thi</th>
					<th class='text-center'>Tổng đạt</th>
					<th class='text-center'></th>
				</tr></thead>
				<tbody>
				<?php 
				$obj=new CLS_MYSQL;
				$sql="SELECT * FROM tbl_monhoc";
				$obj->Query($sql);
				$arrMon=array();
				while($r=$obj->Fetch_Assoc()){
					$arrMon[$r['id']]=$r;
				}
				
				$sql="SELECT * FROM tbl_hocphan_khung WHERE 1=1";
				if($_NGANH!=="") $sql.=" AND id_nganh='$_NGANH'";
				if($_HE!=="") $sql.=" AND id_he='$_HE'";
				$obj->Query($sql." ORDER by id_nganh ASC, id_he ASC, id_monhoc ASC ");
				$stt=0;
				if($obj->Num_rows()>0){
				while($r=$obj->Fetch_Assoc()) {
					$id=$r['id'];
					$stt++;
				?>
				<tr><td class='text-center'><?php echo $stt;?></td>
					<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
					<td><?php echo $arrNganh[$r['id_nganh']];?></td>
					<td><?php echo $arrHe[$r['id_he']];?></td>
					<td><?php echo stripslashes($arrMon[$r['id_monhoc']]['id']);?></td>
					<td><?php echo stripslashes($arrMon[$r['id_monhoc']]['name']);?></td>
					<td class='text-center'><?php echo (int)$r['tinchi'];?></td>
					<td class='text-center'><?php echo (int)$r['diem_chuyencan'];?>%</td>
					<td class='text-center'><?php echo (int)$r['diem_kiemtra'];?>%</td>
					<td class='text-center'><?php echo (int)$r['diem_thi'];?>%</td>
					<td class='text-center'><?php echo $r['total'];?></td>
					<td class='text-center'>
					<i class="fa fa-pencil-square-o btn_edit" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
					</td>
				</tr>
				<?php } 
				}else{
					echo "<tr><td colspan='11' class='text-center red'>Không danh mục nào</td></tr>";
				}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
$('.btn_xoa').click(function(){
	if(confirm('Bạn có chắc chắn xóa học phần?')){
		var _id=$(this).attr('dataid');
		var _url='ajaxs/khungdaotao/process_del.php';
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
	var _url='ajaxs/khungdaotao/frm_edit.php';
	$('#myModalPopup .modal-dialog').removeClass('modal-lg');
	$('#myModalPopup .modal-dialog').removeClass('modal-sm');
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Sửa học phần');
	$.post(_url,{'id':_id},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
$('#btn_add').click(function(){;
	var _url='ajaxs/khungdaotao/frm_add.php';
	$('#myModalPopup .modal-dialog').removeClass('modal-lg');
	$('#myModalPopup .modal-dialog').removeClass('modal-sm');
	$('#myModalPopup .modal-body').html('Loading...');
	$('#myModalPopup .modal-title').html('Thêm học phần');
	$.post(_url,{},function(req){
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
</script>