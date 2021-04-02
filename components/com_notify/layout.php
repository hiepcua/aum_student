<?php 
$check_permission = $UserLogin->Permission('notify');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

include_once("libs/cls.notify.php"); 
$objnoti = new CLS_NOTIFY;
$objnoti->getList(" ","");
$total_rows = $objnoti->Num_rows();

$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$objnoti->getList(" "," LIMIT $start,".MAX_ROWS);
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Các hoạt động gần đây</div>
			</div>
		</div>
	</div>
	<table class="list table table-striped table-bordered">
		<thead><tr class="header">
			<th class="text-center">STT</th>
			<th class="text-center">Ngày tạo</th>
			<th>Nội dung</th>
			<th class="text-center">Tạo bởi</th>
		</tr></thead>
		<tbody>
		<?php $stt=0; while($r = $objnoti->Fetch_Assoc()) { $stt++;?>
		<tr><td class="text-center"><?php echo $stt;?></td>
			<td class="text-center"><?php echo date("d/m/y",$r['cdate']);?></td>
			<td><?php echo $r['notes'];?></td>
			<td class="text-center"><?php echo $r['author'];?></td>
		</tr>
		<?php } ?></tbody>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr><td align="center">
		<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
		</td></tr>
	</table>
</div>