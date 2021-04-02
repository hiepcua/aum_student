<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$ma=isset($_POST['ma'])?htmlentities(strip_tags($_POST['ma'])):'';
if(!isset($_SESSION["SV$ma"]['TAB_KHENTHUONG'])) $_SESSION["SV$ma"]['TAB_KHENTHUONG']=array();
$n = count($_SESSION["SV$ma"]['TAB_KHENTHUONG']);
$row_id = isset($_POST['row_id'])?(int)$_POST['row_id']:-1; 
?>
<table class="table table-striped">
	<thead><tr><th></th>
		<th>STT</th>
		<th>Học kỳ</th>
		<th>Hình thức</th>
		<th>Lý do</th>
		<th>Quyết định</th>
		<th>Ngày</th>
		<th>Ghi chú</th>
		<th></th>
	</tr></thead>
	<tbody>
	<?php $stt=0; foreach($_SESSION["SV$ma"]['TAB_KHENTHUONG'] as $item) {?>
	<?php if($stt==$row_id) { ?>
	<tr dataid="<?php echo $stt;?>">
		<td><button type="button" class="btn btn-default del_khenthuong red" dataid="<?php echo $stt;?>">
		<i class="fa fa-times"></i></button></td>
		<td><?php echo $stt+1;?></td>
		<td><input type="number" name="row_hocky" value="<?php echo $item['hocky'];?>" class="form-control" placeholder="Học kỳ"></td>
		<td><input type="text" name="row_hthuc" value="<?php echo $item['hinhthuc'];?>" class="form-control" placeholder="Hình thức"></td>
		<td><input type="text" name="row_lydo" value="<?php echo $item['lydo'];?>" class="form-control" placeholder="Lý do"></td>
		<td><input type="text" name="row_qdinh" value="<?php echo $item['quyetdinh'];?>" class="form-control" placeholder="Quyết định"></td>
		<td><input type="text" name="row_ghichu" value="<?php echo $item['ghichu'];?>" class="form-control" placeholder="Ghi chú"></td>
		<td><input type="hidden" name="id_khenthuong" value="<?php echo $row_id;?>"/>
		<button type="button" class="btn btn-success" id="save_khenthuong"><i class="fa fa-save"></i></button>
		</td>
	</tr>
	<?php } else { ?>
	<tr dataid="<?php echo $stt;?>">
		<td><button type="button" class="btn btn-default del_khenthuong red" dataid="<?php echo $stt;?>">
		<i class="fa fa-times"></i></button></td>
		<td><?php echo $stt+1;?></td>
		<td><?php echo $item['hocky'];?></td>
		<td><?php echo $item['hinhthuc'];?></td>
		<td><?php echo $item['lydo'];?></td>
		<td><?php echo $item['quyetdinh'];?></td>
		<td><?php echo $item['ghichu'];?></td>
		<td><button type="button" class="btn btn-default edit_khenthuong" dataid="<?php echo $stt;?>">
		<i class="fa fa-edit"></i></button></td>
	</tr>
	<?php } ?>
	<?php  $stt++;} ?>
	</tbody>
</table>
<script>
$(".edit_khenthuong").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid'); 
	var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_khenthuong.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab4").html(req);
	})
})
$(".del_khenthuong").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid');
	var url = "<?php echo ROOTHOST;?>ajaxs/student/del_khenthuong.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab4").html(req);
	})
})
$("#save_khenthuong").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $("input[name='id_khenthuong']").val();
	var row_hocky = $("input[name='row_hocky']").val();
	var row_hthuc = $("input[name='row_hthuc']").val();
	var row_lydo = $("input[name='row_lydo']").val();
	var row_qdinh = $("input[name='row_qdinh']").val();
	var row_ghichu = $("input[name='row_ghichu']").val();
	var url = "<?php echo ROOTHOST;?>ajaxs/student/save_khenthuong.php";
	$.post(url,{'ma':ma,'row_id':row_id,'row_hocky':row_hocky,'row_hthuc':row_hthuc,'row_lydo':row_lydo,
	'row_qdinh':row_qdinh,'row_ghichu':row_ghichu},function(req){
		//console.log(req);
		$("#tab4").html(req);
	})
})
</script>