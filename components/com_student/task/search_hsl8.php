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
				<input type="text" name="tk_phone" id="tk_phone" value="<?php echo $phone;?>" placeholder="Số điện thoại" class="form-control"/> 
			</div>
			<div class="col-md-2 col-xs-6">
				<input type="text" name="tk_email" id="tk_email" value="<?php echo $email;?>" placeholder="Email" class="form-control"/> 
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
		$("#tk_phone").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_email").keypress(function(e){
			if(e.which==13) SubmitSearch();
		})
		$("#tk_btnsearch").click(function(){
			SubmitSearch();
		})
	})
	function SubmitSearch() {
		var _ma = $("#tk_ma").val();
		var _ten = $("#tk_hoten").val();
		var _phone = $("#tk_phone").val();
		var _email = $("#tk_email").val();
		var _page = $("#txt_page").val();

		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);

		if(searchParams.has("ma")===true){ searchParams.delete("ma");}
		searchParams.append("ma",_ma);
		if(searchParams.has("ten")===true){ searchParams.delete("ten");}
		searchParams.append("ten",_ten);
		if(searchParams.has("phone")===true){ searchParams.delete("phone");}
		searchParams.append("phone",_phone);
		if(searchParams.has("email")===true){ searchParams.delete("email");}
		searchParams.append("email",_email);
		if(searchParams.has("page")===true){ searchParams.delete("page");}
		searchParams.append("page",_page);

		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);
		window.location.reload();
	}
</script>