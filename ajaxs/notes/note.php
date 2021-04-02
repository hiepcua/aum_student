<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once('../../libs/cls.mysql.php');
$id=isset($_GET["id"])?(int)$_GET["id"]:0;
$objMySql=new CLS_MYSQL;
$sql="SELECT * FROM tbl_order_note WHERE oid=$id ORDER BY cdate DESC";
$objMySql->Query($sql);
?>
<div class="row header">
    <form method="post" action="">
        <input type="text" name="txt_note" id="txt_note" placeholder="..." class="form-control"/>
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
			<td><?php echo $rows['uid'];?></td>
			<td><?php echo $rows['note'];?></td>
		</tr>
		<?php
		}
        ?>
    </table>
</div>
<script>
$(document).ready(function(){
	$("#txt_note").keyup(function(e){
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code==13) {
			e.preventDefault();
			saveNote('<?php echo $id; ?>');
		}
	})
})
</script>
