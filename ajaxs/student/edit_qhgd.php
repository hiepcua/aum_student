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
if(!isset($_SESSION["SV$ma"]['TAB_QHGD'])) $_SESSION["SV$ma"]['TAB_QHGD']=array();
$n = count($_SESSION["SV$ma"]['TAB_QHGD']);
?>
<table class="table table-striped">
	<thead><tr><th></th>
		<th>STT</th>
		<th>Quan hệ</th>
		<th>Họ và tên</th>
		<th>Năm sinh</th>
		<th>Nghề nghiệp</th>
		<th>Hộ khẩu</th>
		<th>Ghi chú</th>
		<th></th>
	</tr></thead>
	<tbody>
	<?php $stt=0; foreach($_SESSION["SV$ma"]['TAB_QHGD'] as $item) {?>
	<?php if($stt==$row_id) { ?>
	<tr dataid="<?php echo $stt;?>">
		<td><button type="button" class="btn btn-default del_qhgd red" dataid="<?php echo $stt;?>">
		<i class="fa fa-times"></i></button></td>
		<td><?php echo $stt+1;?></td>
		<td><input type="text" name="row_qh" value="<?php echo $item['qh'];?>" class="form-control" placeholder="Quan hệ"></td>
		<td><input type="text" name="row_name" value="<?php echo $item['name'];?>" class="form-control" placeholder="Họ và tên"></td>
		<td><input type="text" name="row_ns" value="<?php echo $item['ns'];?>" class="form-control" placeholder="Năm sinh"></td>
		<td><input type="text" name="row_nn" value="<?php echo $item['nn'];?>" class="form-control" placeholder="Nghề nghiệp"></td>
		<td><input type="text" name="row_hk" value="<?php echo $item['hk'];?>" class="form-control" placeholder="Hộ khẩu"></td>
		<td><input type="text" name="row_note" value="<?php echo $item['note'];?>" class="form-control" placeholder="Ghi chú"></td>
		<td><input type="hidden" name="id_qhgd" value="<?php echo $row_id;?>"/>
		<button type="button" class="btn btn-success" id="save_qhgd"><i class="fa fa-save"></i></button>
		</td>
	</tr>
	<?php } else { ?>
	<tr dataid="<?php echo $stt;?>">
		<td><button type="button" class="btn btn-default del_qhgd red" dataid="<?php echo $stt;?>">
		<i class="fa fa-times"></i></button></td>
		<td><?php echo $stt+1;?></td>
		<td><?php echo $item['qh'];?></td>
		<td><?php echo $item['name'];?></td>
		<td><?php echo $item['ns'];?></td>
		<td><?php echo $item['nn'];?></td>
		<td><?php echo $item['hk'];?></td>
		<td><?php echo $item['note'];?></td>
		<td><button type="button" class="btn btn-default edit_qhgd" dataid="<?php echo $stt;?>">
			<i class="fa fa-edit"></i></button></td>
	</tr>
	<?php } ?>
	<?php  $stt++;} ?>
	</tbody>
</table>
<script>
$(".edit_qhgd").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid'); 
	var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_qhgd.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab1").html(req);
	})
})
$(".del_qhgd").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid');
	var url = "<?php echo ROOTHOST;?>ajaxs/student/del_qhgd.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab1").html(req);
	})
})
$("#save_qhgd").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $("input[name='id_qhgd']").val();
	var row_qh = $("input[name='row_qh']").val();
	var row_name = $("input[name='row_name']").val();
	var row_ns = $("input[name='row_ns']").val();
	var row_nn = $("input[name='row_nn']").val();
	var row_hk = $("input[name='row_hk']").val();
	var row_note = $("input[name='row_note']").val();
	var url = "<?php echo ROOTHOST;?>ajaxs/student/save_qhgd.php";
	$.post(url,{'ma':ma,'row_id':row_id,'row_qh':row_qh,'row_name':row_name,'row_ns':row_ns,
	'row_nn':row_nn,'row_hk':row_hk,'row_note':row_note},function(req){
		//console.log(req);
		$("#tab1").html(req);
	})
})
</script>