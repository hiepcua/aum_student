function orderCheckAll(status){
	console.log('status='+status);
	$(".chk").each(function(){
		$(this).prop('checked',status);
	})
	orderIDChecked();
}
function orderCheckOnce(){
	var flag=true;
	$(".chk").each(function(){
		if($(this).prop("checked")!=true) {
			$("#chkall").prop('checked',flag);
		}
	})
	orderIDChecked();
}
function orderIDChecked(){
	var strids="";  
	var total_sls=total_cyn=total_vn=0;
	var count = 0;
	$(".chk").each(function(){
		if($(this).prop("checked")==true)
		{	count++;
			strids+=$(this).val()+",";
		}
	})
	$("#hoso_ids").val(strids);
	$('.total_orders span').html(formatNumber(count, '.', ','));
	
	if(count>0) $("#tablefixbottom").show();
	else $("#tablefixbottom").hide();
	activeTr();
}
function activeTr(){
	$(".trow").each(function(){
		var check=$(this).find(".chk").prop('checked');
		if(check==true)
			$(this).addClass("active");
		else
			$(this).removeClass("active");
	})
}