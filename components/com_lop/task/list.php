<?php
defined('ISHOME') or die("You can't access this page!");
	
$nganh=isset($_GET['nganh'])?addslashes(strip_tags($_GET['nganh'])):'';
$khoa=isset($_GET['khoa'])?addslashes(strip_tags($_GET['khoa'])):'';
$he=isset($_GET['he'])?addslashes(strip_tags($_GET['he'])):'';
$lop=isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';

$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;
$obj=new CLS_MYSQL;
$strWhere='';
$sql="SELECT count(*) as num FROM tbl_lop WHERE 1=1 $strWhere";
$obj->Query($sql);
$r=$obj->Fetch_Assoc();
$total_rows=$r['num']+1;
$sql="SELECT * FROM tbl_lop WHERE 1=1";
$obj->Query($sql);
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Danh sách lớp</div>
			</div>
		</div>
	</div>
	<div class="customer_list">
		<?php //include("search_lop.php");?>
		<div id="list_profile" class="table-responsive">
		<table class="list table table-striped table-bordered">
			<thead><tr class="header">
				<th class="text-center">STT</th>
				<th class="text-center">Mã Lớp</th>
				<th class="text-center">Ngành</th>
				<th class="text-center">Hệ</th>
				<th class="text-center">Khóa</th>
				<th class="text-center">sĩ số</th>
				<th class="text-center">Chương trình</th>
				<th class="text-center">Ngày tạo</th>
			</tr></thead>
			<tbody>
			<?php $i=1;
			while($r=$obj->Fetch_Assoc()){
			$siso=0;
			?>
			<tr dataid="<?php echo $r['id'];?>"><td align="center"><?php echo $i;?></td>
			<td dataid="<?php echo $r['id'];?>"><a href="<?php echo ROOTHOST;?>student/profile/<?php echo $id_hoso;?>">
			<?php echo stripslashes($r['id']);?></a></td>
			<td><?php echo stripslashes($r['id_nganh']);?></td>
			<td><?php echo stripslashes($r['id_he']);?></td>
			<td><?php echo stripslashes($r['id_khoa']);?></td>
			<td class="text-center"><?php echo $siso;?></td>
			<td align="center"><i class='fa fa-check cgreen' aria-hidden='true'></i></td>
			<td align="center"><?php echo date('d/m/Y',$r['cdate']);?></td>
			</tr><?php $i++;} ?>
			</tbody>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		  <tr><td align="center">
			<?php  paging($total_rows,MAX_ROWS,$cur_page); ?>
			</td></tr>
		</table>
		
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#tk_nganh").change(function(){
		SubmitSearch();
	})
	$("#tk_sbd").keypress(function(e){
		if(e.which==13) SubmitSearch();
	})
	$("#tk_btnsearch").click(function(){
		SubmitSearch();
	})
})
function SubmitSearch() {
	var _ten = $("#tk_hoten").val();
	var _cmt = $("#tk_cmt").val();
	var _ns = $("#tk_ns").val();
	var _dc = $("#tk_dc").val();
	var _sbd = $("#tk_sbd").val();
	var _nganh = $("#tk_nganh option:selected").val();
	
	var url = window.location.href;
	var urlSplit = url.split( "?" );  
	var searchParams = new URLSearchParams(window.location.search);
	
	if(searchParams.has("ten")===true){ searchParams.delete("ten");}
	searchParams.append("ten",_ten);
	if(searchParams.has("cmt")===true){ searchParams.delete("cmt");}
	searchParams.append("cmt",_cmt);
	if(searchParams.has("ns")===true){ searchParams.delete("ns");}
	searchParams.append("ns",_ns);
	if(searchParams.has("dc")===true){ searchParams.delete("dc");}
	searchParams.append("dc",_dc);
	if(searchParams.has("nganh")===true){ searchParams.delete("nganh");}
	searchParams.append("nganh",_nganh);
	if(searchParams.has("sbd")===true){ searchParams.delete("sbd");}
	searchParams.append("sbd",_sbd);
	
	var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
	history.pushState(null, obj.Title, obj.Url);
	
	window.location.reload();
}
</script>