<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_hsdaotao');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$lop=isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
$sbd=isset($_GET['sbd'])?addslashes(strip_tags($_GET['sbd'])):'';
$masv=isset($_GET['masv'])?addslashes(strip_tags($_GET['masv'])):'';
$khoa = isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he = isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$step='';	
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Hồ sơ sinh viên</div>
			</div>
		</div>
	</div>
	<div class="customer_list">
		<?php include("search_hsnhaphoc.php");?>
		<div id="list_profile" class="table-responsive"></div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#tk_hoten").keypress(function(e){
		if(e.which==13) SubmitSearch();
	})
	$("#tk_cmt").keypress(function(e){
		if(e.which==13) SubmitSearch();
	})
	$("#tk_ns").keypress(function(e){
		if(e.which==13) SubmitSearch();
	})
	$("#tk_dc").keypress(function(e){
		if(e.which==13) SubmitSearch();
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
	var _page = '<?php echo $cur_page;?>';
	
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
	if(searchParams.has("sbd")===true){ searchParams.delete("sbd");}
	searchParams.append("sbd",_sbd);
	if(searchParams.has("page")===true){ searchParams.delete("page");}
	searchParams.append("page",_page);
	
	var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
	history.pushState(null, obj.Title, obj.Url);
	
	var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/list.php";
	$.post(url,{'ten':_ten,'cmt':_cmt,'ns':_ns,'dc':_dc,'sbd':_sbd,'page':_page},function(req){
		$("#list_profile").html(req);
	})
}
</script>
<script>SubmitSearch()</script>