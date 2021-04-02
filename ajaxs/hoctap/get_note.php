<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$id=isset($_GET["ht_id"])?(int)$_GET["ht_id"]:0;
$objMySql=new CLS_MYSQL;
$sql="SELECT * FROM tbl_hoctap_note WHERE id_hoctap=$id ORDER BY cdate DESC";
$objMySql->Query($sql);
?>
<div class="row header">
    <form method="post" action="">
    	<div class="row">
    		<div class="col-md-10"><input type="text" name="txt_note" id="txt_note" placeholder="Nội dung ghi chú" class="form-control"/></div>
    		<div class="col-md-2"><button type="button" id="save_note" class="btn btn-primary">Lưu</button></div>
    	</div>
	</form>
</div>
<div class="clearfix"><br></div>
<div align="center" id="result"></div>
<div class="tab-content">
    <table class="table table-striped table-bordered" id="table_note">
        <tr>
            <th width="30">#</th>
            <th>Cdate</th>
            <th width="70">Username</th>
            <th>Note</th>
        </tr>
        <?php
        $i=0;
		while ($rows = $objMySql->Fetch_Assoc()){ $i++;
		?>
		<tr>
			<td width="30" style="font-weight: normal"><?php echo $i;?></td>
			<td width="150" style="font-weight: normal"><?php echo date('d-m-Y H:i',$rows['cdate']);?></td>
			<td><?php echo $rows['author'];?></td>
			<td><?php echo $rows['notes'];?></td>
		</tr>
		<?php
		}
        ?>
    </table>
</div>
<script>
$(document).ready(function(){
	$('#save_note').on('click', function(){
		var txt = $("#txt_note").val();
		if(txt.length > 0){
			saveNote();
		}else{
			alert("Nội dung trống.");
		}
	});
})
function saveNote(){
	var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/save_note.php";
	var txt_note = $("#txt_note").val();
	$.post(url,{'id_ht':'<?php echo $id; ?>','txt_note':txt_note},function(req){
		if(req == 'success'){
			showMess('Lưu thành công!',"success");
		}else{
			showMess('Có lỗi trong quá trình lưu',"error");
		}
	})
}
</script>
