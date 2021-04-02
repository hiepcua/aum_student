<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$ma=isset($_POST['ma'])?strip_tags($_POST['ma']):'';
if(!isset($_SESSION["SV$ma"]['TAB_QTHT'])) $_SESSION["SV$ma"]['TAB_QTHT']=array();
$n = count($_SESSION["SV$ma"]['TAB_QTHT']);
if(isset($_POST['row_from'])) {
	if(isset($_POST['row_id'])) $n=(int)$_POST['row_id'];
 	$_SESSION["SV$ma"]['TAB_QTHT'][$n]['tunam']= addslashes(strip_tags($_POST['row_from']));
 	$_SESSION["SV$ma"]['TAB_QTHT'][$n]['dennam']= addslashes(strip_tags($_POST['row_to']));
 	$_SESSION["SV$ma"]['TAB_QTHT'][$n]['lamgi']= addslashes(strip_tags($_POST['row_lamgi']));
 	$_SESSION["SV$ma"]['TAB_QTHT'][$n]['noidau']= addslashes(strip_tags($_POST['row_noidau']));
 	$_SESSION["SV$ma"]['TAB_QTHT'][$n]['chucvu']= addslashes(strip_tags($_POST['row_chucvu']));
}?>
<table class="table table-striped">
	<thead><tr><th></th>
		<th>STT</th>
		<th>Từ năm</th>
		<th>Đến năm</th>
		<th>Làm gì</th>
		<th>Nơi đâu</th>
		<th>Chức vụ</th>
		<th></th>
	</tr></thead>
	<tbody>
	<?php $stt=0; foreach($_SESSION["SV$ma"]['TAB_QTHT'] as $item) {?>
	<tr dataid="<?php echo $stt;?>">
		<td><button type="button" class="btn btn-default del_qtht red" dataid="<?php echo $stt;?>">
		<i class="fa fa-times"></i></button></td>
		<td><?php echo $stt+1;?></td>
		<td><?php echo $item['tunam'];?></td>
		<td><?php echo $item['dennam'];?></td>
		<td><?php echo $item['lamgi'];?></td>
		<td><?php echo $item['noidau'];?></td>
		<td><?php echo $item['chucvu'];?></td>
		<td><button type="button" class="btn btn-default edit_qtht" dataid="<?php echo $stt;?>">
		<i class="fa fa-edit"></i></button></td>
	</tr>
	<?php  $stt++;} ?>
	</tbody>
</table>
<script>
$(".edit_qtht").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid');
	var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_qtht.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		console.log(req);
		$("#tab2").html(req);
	})
})
$(".del_qtht").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid');
	var url = "<?php echo ROOTHOST;?>ajaxs/student/del_qtht.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab2").html(req);
	})
})
$("#save_qtht").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $("input[name='id_qtht']").val();
	var row_qh = $("input[name='row_qh']").val();
	var row_name = $("input[name='row_name']").val();
	var row_ns = $("input[name='row_ns']").val();
	var row_nn = $("input[name='row_nn']").val();
	var row_hk = $("input[name='row_hk']").val();
	var row_note = $("input[name='row_note']").val();
	var url = "<?php echo ROOTHOST;?>ajaxs/student/save_qtht.php";
	$.post(url,{'ma':ma,'row_id':row_id,'row_qh':row_qh,'row_name':row_name,'row_ns':row_ns,
	'row_nn':row_nn,'row_hk':row_hk,'row_note':row_note},function(req){
		//console.log(req);
		$("#tab2").html(req);
	})
})
</script>