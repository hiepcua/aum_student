<?php $tk_nganh='';?>
<div class="search_box panel panel-warning"><div class="panel-body"><div class="media row">
	<form name="frm_search" id="frm_search" method="post">
	<div class="form-group">
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_ma" id="tk_ma" value="" placeholder="Mã hồ sơ" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_hoten" id="tk_hoten" value="" placeholder="Họ tên" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_cmt" id="tk_cmt" value="" placeholder="CMT/CCCD" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="date" name="tk_ns" id="tk_ns" value="" placeholder="Ngày sinh" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_dc" id="tk_dc" value="" placeholder="Địa chỉ" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<select name="tk_nganh" id="tk_nganh" class="form-control">
			<option value="" selected>Chọn Ngành</option>
			<?php $objng = new CLS_NGANH;
			$objng->getList(); 
			while($r=$objng->Fetch_Assoc()) { ?>
			<option value="<?php echo $r['id'];?>" <?php if($tk_nganh==$r['id']) echo "selected";?>>
			<?php echo $r['id']." - ".$r['name'];?></option>
			<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group text-center">
		<?php if($step>1) { ?>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_sbd" id="tk_sbd" value="" placeholder="Số báo danh" class="form-control"/>
		</div>
		<div class="col-md-2">
			<input type="text" name="tk_diem" id="tk_diem" value="" placeholder="Điểm sàn" class="form-control"/>
		</div>
		<?php } else { ?>
		<div class="col-md-2 hidden-sm hidden-xs"><input type="hidden" name="tk_sbd" id="tk_sbd" value="" /></div>
		<div class="col-md-2 hidden-sm hidden-xs"><input type="hidden" name="tk_diem" id="tk_diem" value="" /></div>
		<?php } ?>
		<div class="col-md-2 hidden-sm hidden-xs"></div>
		<div class="col-md-2 hidden-sm hidden-xs"></div>
		<div class="col-md-2 hidden-sm hidden-xs"></div>
		<div class="col-md-2">
			<input type="hidden" id="tk_step" value="<?php echo $step;?>"/>
			<button type="button" name="tk_btnsearch" id="tk_btnsearch" class="btn btn-primary form-control">
			<i class="fa fa-search"></i> Lọc</button>
		</div>
	</div>
	</form>
</div></div></div>
<script>
$(document).ready(function(){
	$("#tk_ma").keypress(function(e){
		if(e.which==13) SubmitSearch();
	})
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
	$("#tk_nganh").change(function(){
		SubmitSearch();
	})
	$("#tk_sbd").keypress(function(e){
		if(e.which==13) SubmitSearch();
	})
	$("#tk_diem").keypress(function(e){
		if(e.which==13) SubmitSearch();
	})
	$("input[name='tk_ptxt[]']").click(function(e){
		SubmitSearch();
	})
	$("input[name='tk_diadiem[]']").click(function(e){
		SubmitSearch();
	})
	$("#tk_btnsearch").click(function(){
		SubmitSearch();
	})
})
function SubmitSearch() {
	var _step = $("#tk_step").val();
	var _ma = $("#tk_ma").val();
	var _ten = $("#tk_hoten").val();
	var _cmt = $("#tk_cmt").val();
	var _ns = $("#tk_ns").val();
	var _dc = $("#tk_dc").val();
	var _sbd = $("#tk_sbd").val();
	var _diem = $("#tk_diem").val();
	var _nganh = $("#tk_nganh option:selected").val();
	var _ptxt = $("input[name='tk_ptxt[]']:checked").val();
	var _diadiem = $("input[name='tk_diadiem[]']:checked").val();
	if(_ptxt==undefined) _ptxt='';
	if(_diadiem==undefined) _diadiem='';
	
	var url = window.location.href;
	var urlSplit = url.split( "?" );  
	var searchParams = new URLSearchParams(window.location.search);
	
	if(searchParams.has("step")===true){ searchParams.delete("step");}
	searchParams.append("step",_step);
	if(searchParams.has("ma")===true){ searchParams.delete("ma");}
	searchParams.append("ma",_ma);
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
	if(searchParams.has("diem")===true){ searchParams.delete("diem");}
	searchParams.append("diem",_diem);
	if(searchParams.has("ptxt")===true){ searchParams.delete("ptxt");}
	searchParams.append("ptxt",_ptxt);
	if(searchParams.has("diadiem")===true){ searchParams.delete("diadiem");}
	searchParams.append("diadiem",_diadiem);
	
	var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
	history.pushState(null, obj.Title, obj.Url);
	
	var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/list.php";
	$.post(url,{'step':_step,'ma':_ma,'ten':_ten,'cmt':_cmt,'ns':_ns,'dc':_dc,'nganh':_nganh,
	'sbd':_sbd,'diem':_diem,'ptxt':_ptxt,'diadiem':_diadiem},function(req){
		$("#list_profile").html(req);
	})
}
</script>