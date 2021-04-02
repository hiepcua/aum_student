<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$ma=isset($_GET['ma'])?htmlentities(strip_tags($_GET['ma'])):'';
if(!isset($_SESSION["SV$ma"]['TAB_QTHT'])) $_SESSION["SV$ma"]['TAB_QTHT']=array();
$n = count($_SESSION["SV$ma"]['TAB_QTHT']);
?>
<table class="table table-striped">
	<thead><tr><th></th>
		<th>STT</th>
		<th>Từ năm</th>
		<th>Đến năm</th>
		<th>Học gì</th>
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
	<tr class="new"><td></td>
		<td><?php echo $stt+1;?></td>
		<td><input type="number" name="row_from" class="form-control" placeholder="Từ năm"></td>
		<td><input type="number" name="row_to" class="form-control" placeholder="Đến năm"></td>
		<td><input type="text" name="row_lamgi" class="form-control" placeholder="Làm gì"></td>
		<td><input type="text" name="row_noidau" class="form-control" placeholder="Nơi đâu"></td>
		<td><input type="text" name="row_chucvu" class="form-control" placeholder="Chức vụ"></td>
		<td><button type="button" class="btn btn-success" id="save_qtht"><i class="fa fa-save"></i></button></td>
	</tr>
	</tbody>
</table>
<script>
$("#save_qtht").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_from = $("input[name='row_from']").val();
	var row_to = $("input[name='row_to']").val();
	var row_lamgi = $("input[name='row_lamgi']").val();
	var row_noidau = $("input[name='row_noidau']").val();
	var row_chucvu = $("input[name='row_chucvu']").val();
	var url = "<?php echo ROOTHOST;?>ajaxs/student/save_qtht.php";
	$.post(url,{'ma':ma,'row_from':row_from,'row_to':row_to,'row_lamgi':row_lamgi,
	'row_noidau':row_noidau,'row_chucvu':row_chucvu},function(req){
		//console.log(req);
		$("#tab2").html(req);
	})
})
$(".edit_qtht").click(function(){
	var ma = "<?php echo $ma;?>";
	var row_id = $(this).attr('dataid');
	var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_qtht.php";
	$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab2").html(req);
	})
})
</script>