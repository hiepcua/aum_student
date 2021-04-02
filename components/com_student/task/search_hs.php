<div class="search_box panel panel-warning"><div class="panel-body"><div class="media row">
	<form name="frm_search" id="frm_search" method="post">
		<div class="form-group">
			<div class="col-md-2 col-xs-6">
				<input type="text" name="tk_ma" id="tk_ma" value="<?php echo $ma;?>" placeholder="Mã hồ sơ" class="form-control"/> 
			</div>
			<div class="col-md-2 col-xs-6">
				<input type="text" name="tk_hoten" id="tk_hoten" value="<?php echo $ten;?>" placeholder="Họ tên" class="form-control"/> 
			</div>
			<div class="col-md-2 col-xs-6">
				<input type="text" name="tk_cmt" id="tk_cmt" value="<?php echo $cmt;?>" placeholder="CMT/CCCD" class="form-control"/> 
			</div>
			<div class="col-md-2 col-xs-6">
				<input type="date" name="tk_ns" id="tk_ns" value="<?php echo $ns;?>" placeholder="Ngày sinh" class="form-control"/> 
			</div>
			<div class="col-md-2 col-xs-6">
				<input type="text" name="tk_dc" id="tk_dc" value="<?php echo $dc;?>" placeholder="Tỉnh/thành" class="form-control"/> 
			</div>
			<div class="col-md-2">
				<input type="hidden" id="txt_page" name='page' value="<?php echo $cur_page;?>"/>
				<button type="button" name="tk_btnsearch" id="tk_btnsearch" class="btn btn-primary form-control">
				<i class="fa fa-search"></i> Tìm kiếm</button>
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
		$("#tk_btnsearch").click(function(){
			SubmitSearch();
		})
	})
	function SubmitSearch() {
		var _ma = $("#tk_ma").val();
		var _ten = $("#tk_hoten").val();
		var _cmt = $("#tk_cmt").val();
		var _ns = $("#tk_ns").val();
		var _dc = $("#tk_dc").val();
		var _page = $("#txt_page").val();

		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);

		if(searchParams.has("he")===true){ searchParams.delete("he");}
		if(searchParams.has("khoa")===true){ searchParams.delete("khoa");}
		if(searchParams.has("nganh")===true){ searchParams.delete("nganh");}

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
		if(searchParams.has("page")===true){ searchParams.delete("page");}
		searchParams.append("page",_page);

		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);
		window.location.reload();
	}
</script>