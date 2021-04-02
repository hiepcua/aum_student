<?php 
$strwhere=' WHERE type=2 ';
$key='';
if(isset($_POST['txtkey'])) {
	$key=addslashes($_POST['txtkey']);
	$strwhere.= " AND (subject LIKE '%$key%' OR `content` LIKE '%$key%'";
	$strwhere.= " OR `from` LIKE '%$key%' OR `to` LIKE '%$key%') ";
} ?>
<div class="row">
	<h3 class="col-md-4">Thư đã gửi</h3>
	<div class='col-md-4 list_search'>
		<form name="frmsearch" id="frmsearch" action="#" method="POST">
		<div class='field_input col-md-10'>
			<input type='text' name="txtkey" id="txtkey" class='form-control' placeholder='Nhập từ khóa'>
			<input type="hidden" name="txtstt" id="txtstt" value=""/>
		</div>
		<div class='btnsearch col-md-1'>
			<button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
		</div>
		</form>
	</div>
</div>
<div class='box-white user_list'>
<table class="table mail_list">
	<thead><tr>
		<th width="30" align="center">STT</th>
		<th width="80">Gửi đến</th>
		<th width="250">Tiêu đề</th>
		<th>Nội dung</th>
		<th align="center" width="100">Thời gian</th>
	</tr></thead>
	<tbody>
	<?php
	$total_rows=0; $cur_page=1;
	// Pagging
	if(!isset($_SESSION['CUR_PAGE_MAIL']))
		$_SESSION['CUR_PAGE_MAIL']=1;
	if(isset($_POST['txtCurnpage']))
		$_SESSION['CUR_PAGE_MAIL']=(int)$_POST['txtCurnpage'];
		
	$objdata= new CLS_MYSQL;				
	$sql="SELECT * FROM tbl_boxes ".$strwhere." ORDER BY `create_date` DESC"; 
	$objdata->Query($sql);
	$total_rows=$objdata->Num_Rows();
	
	if($_SESSION['CUR_PAGE_MAIL']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_MAIL']=ceil($total_rows/MAX_ROWS);
	$cur_page=(int)$_SESSION['CUR_PAGE_MAIL']>0 ? $_SESSION['CUR_PAGE_MAIL']:1;
	$start=($cur_page-1)*MAX_ROWS;
	
	if($total_rows==0) 
		echo "<tr><td colspan='6' align='center'>Chưa có thư</td></tr>";
	else { 
	$objdata= new CLS_MYSQL;	
	$objdata->Query($sql." LIMIT $start,".MAX_ROWS);
	$stt=0;
	while($rows=$objdata->Fetch_Assoc()) {
		$stt++; $id=$rows['id'];
		$cls='';
		if($rows['viewed']==0) $cls="class='unview'";

		$date = strtotime($rows['create_date']);
		if(date("d/m/Y",$date)==date("d/m/Y")) $date = date("H:i",$date);
		elseif(date("Y",$date)==date("Y")) $date = date("d/m",$date);
		else $date = date("d/m/Y",$date);
		
		$to = json_decode($rows['to'],true);
		$str_to='';
		for($i=0;$i<count($to);$i++) {
			$name = isset($to[$i]['name'])?$to[$i]['name']:'';
			$str_to.=$name.' '.htmlentities('<').$to[$i]['address'].htmlentities('>');
		}
		
		$subject = stripslashes($rows['subject']);
		$content = Substring(strip_tags(stripslashes($rows['content'])),0,9);
		
		$attach = $rows['attachment'];
		if($attach!='') $attach='<i class="fa fa-paperclip pull-left" aria-hidden="true"></i>';
	?>
	<tr <?php echo $cls;?> dataid="<?php echo $id;?>">
		<td align="center"><?php echo $stt;?></td>
		<td><?php echo $str_to;?></td>
		<td><?php echo $subject;?></td>
		<td><?php echo $content;?></td>
		<td align="right"><?php echo $attach.' '.$date;?></td>
	</tr>
	<?php } } ?>
	</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
  <tr>
	<td align="center">
		<?php 
		paging($total_rows,MAX_ROWS,$cur_page,ROOTHOST_ADMIN."mail/outbox");
		?>
	</td>
	</tr>
</table></div>
<script>
$(document).ready(function(){
	$('.btnsearch').click(function(){
		$('#frmsearch').submit();
	})
})
</script>