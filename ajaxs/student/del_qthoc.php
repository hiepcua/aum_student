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
$row_id = isset($_POST['row_id'])?(int)$_POST['row_id']:-1;
$stt=0; $new_arr=array();
foreach($_SESSION["SV$ma"]['TAB_QTHOC'] as $item) {
	if($row_id!=$stt) $new_arr[]=$item;
	$stt++;
} $_SESSION["SV$ma"]['TAB_QTHOC']=$new_arr;
?>
<table class="table table-striped">
	<thead><tr><th></th>
		<th>STT</th>
		<th>Thời gian</th>
		<th>Nội dung</th>
		<th>Lớp</th>
		<th></th>
	</tr></thead>
	<tbody>
	<?php $stt=0; foreach($_SESSION["SV$ma"]['TAB_QTHOC'] as $item) {?>
	<tr dataid="<?php echo $stt;?>">
		<td><button type="button" class="btn btn-default del_qthoc red" dataid="<?php echo $stt;?>">
		<i class="fa fa-times"></i></button></td>
		<td><?php echo $stt+1;?></td>
		<td><?php echo $item['thoigian'];?></td>
		<td><?php echo $item['noidung'];?></td>
		<td><?php echo $item['lop'];?></td>
		<td><button type="button" class="btn btn-default edit_qthoc" dataid="<?php echo $stt;?>">
		<i class="fa fa-edit"></i></button></td>
	</tr>
	<?php  $stt++;} ?>
	</tbody>
</table>
<script>
$("#save_qthoc").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $("input[name='id_qthoc']").val();
	var row_time = $("input[name='row_time']").val();
	var row_noidung = $("input[name='row_noidung']").val();
	var row_lop = $("input[name='row_lop']").val();
	var url = "<?php echo ROOTHOST;?>ajaxs/student/save_qthoc.php";
	$.post(url,{'ma':ma,'row_id':row_id,'row_time':row_time,'row_noidung':row_noidung,'row_lop':row_lop},function(req){
		console.log(req);
		$("#tab3").html(req);
	})
})
$(".edit_qthoc").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid');
	var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_qthoc.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab3").html(req);
	})
})
$(".del_qthoc").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid');
	var url = "<?php echo ROOTHOST;?>ajaxs/student/del_qthoc.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab3").html(req);
	})
})
</script>