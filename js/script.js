// JavaScript Document
/* Checkbox hoc phi */
function HPCheckAll(status){
	console.log('status='+status);
	$(".chk_hp").each(function(){
		$(this).prop('checked',status);
	})
	HpIDChecked();
}
function HPCheckOnce(){
	var flag=true;
	$(".chk_hp").each(function(){
		if($(this).prop("checked")!=true) {
			flag=false;
		}
	})
	$("#chkall_hp").prop('checked',flag);
	HpIDChecked();
}
function HpIDChecked(){
	var strids="";  var total_hp=0;
	var count = 0;
	$(".chk_hp").each(function(){
		if($(this).prop("checked")==true)
		{	count++;
			strids+=$(this).val()+",";
			total_hp+=parseFloat($(this).attr('datahp'));
		}
	})
	$("#hocphi_ids").val(strids);
	$('.total_muchp span').html(formatNumber(count, '.', ','));
	$('.total_hocphi span').html(formatNumber(total_hp, '.', ','));
	
	if(count>0) $("#tablefixbottom").show();
	else $("#tablefixbottom").hide();
	activeTrHP();
}
function activeTrHP(){
	$(".hp_row").each(function(){
		var check=$(this).find(".chk_hp").prop('checked');
		if(check==true)
			$(this).addClass("active");
		else
			$(this).removeClass("active");
	})
}
/* End Checkbox hoc phi */

function dosubmitAction(frmID,action){
	if(document.getElementById("txtaction"))
		document.getElementById("txtaction").value=action;
	if(checkinput()==true){
		if(frmID=="frm_action")
			document.getElementById("cmdsave").click();
		else
		document.frm_menu.submit();
	}
}
function setValsubmit(task,id) {
	if(document.getElementById("order_ids"))
		document.getElementById("order_ids").value=id;
	if(document.getElementById("txttask"))
		document.getElementById("txttask").value=task;
}
function saveOrder(){
    var ids = document.getElementsByName("chk"); 
	var orders= document.getElementsByName("txt_order");
    var strids ='';
    var strorder ='';
    
    for (var i=0;i<ids.length;i++) {
        strids  += ids[i].value+",";
        strorder  += orders[i].value+",";        
    }
    document.getElementById("order_ids").value = strids; 
    document.getElementById("txtorders").value = strorder;
	document.getElementById("txtaction").value='order';
    document.frm_menu.submit(); 
}
function saveOrderAction(action){
    var ids = document.getElementsByName("chk"); 
	var orders= document.getElementsByName("txt_order");
    var strids ='';
    var strorder ='';
    
    for (var i=0;i<ids.length;i++) {
        strids  += ids[i].value+",";
        strorder  += orders[i].value+",";        
    }
    document.getElementById("order_ids").value = strids; 
    document.getElementById("txtorders").value = strorder;
	document.getElementById("txtaction").value=action;
    document.frm_menu.submit(); 
}
function doSave(frmID,action){
	if(document.getElementById("txtaction"))
		document.getElementById("txtaction").value=action;
	if(checkinput()==true)
	{
		if(frmID=="frm_action")
			document.getElementById("cmdsave").click();
		else
			document.frm_menu.submit();
	}
}
function openlink(url)
{
	window.location=url;
}
function onsearch(thisitem,type){
	var str=thisitem.value;
	if(type==0 && str=="")
		thisitem.value="Keyword";
	if(type==1)
		thisitem.value="";
}
function cbo_Selected(id,value)
{
	var obj=document.getElementById(id);
	for(i=0;i<obj.length;i++)
		if(obj[i].value==value)
			obj.selectedIndex=i;
}
function OpenPopup(url){
	myWindow=window.open(url,'_blank','width=800,height=450');
}

function openBox(url)
{
	
	var xmlhttp;
	if (url.length==0)
	  {
	  document.getElementById("shopcart").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("shopcart").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}
function showdate(){
	var mydate=new Date()
	var year = mydate.getYear()
	if (year < 1000)
		year += 1900
	var month = mydate.getMonth() + 1
	if (month < 10)
		month = "0" + month
	var day = mydate.getDate()
	if (day < 10)
		day = "0" + day
	var dayw = mydate.getDay()
	var hour = mydate.getHours()
	if (hour < 10)
		hour = "0" + hour
	var minute=mydate.getMinutes()
	if (minute < 10)
		minute = "0" + minute
	var second=mydate.getSeconds()
	if (second < 10)
		second = "0" + second
	var dayarray=new Array("Chủ Nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy");
	var strtime="<span class=date>"+dayarray[dayw]+", "+day+"/"+month+"/"+year+" "+hour+":"+minute+":"+minute+"</span>"
	document.getElementById("gf-clock").innerHTML=strtime;
	id=setTimeout("showdate()",1000);
}
function clock(){
	var now=new Date();
	var year=now.getFullYear();
	var month=now.getMonth();
	var date=now.getDate();
	var day=now.getDay();
	var hour=now.getHours();
	var minute=now.getMinutes();
	var second=now.getSeconds();
	var montharray=new Array("01","02","03","04","05","06","07","08","09","10","11","12");
	var dayarray=new Array("Chủ Nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy");
	var disptime=dayarray[day]+", "+date+"/"+montharray[month]+"/"+year+" ";
	disptime+=((hour>12) ? hour-12 : hour)+((minute<10)?":0":":")+minute;
	disptime+=((second<10)? ":0":":")+second+((hour>=12) ? " PM" : " AM");
	document.getElementById("datetime").innerHTML=disptime;
	// getElementById(String elementId);
	id=setTimeout("clock()",1000);
}
function checkPhone(phone){
   re=/^[0][1-9][0-9]{8,9}$/;
   if(!re.test(phone.value)){alert("Số điện thoại của bạn không hợp lệ. Số điện thoại chỉ bao gồm số từ 0 đến 9.");return false;}
   return true;
}
function checkField(field,name){
   if(field.value == ""){
      alert(name + ' không được bỏ trống');
      field.focus();
   }
}
function checkEmail(email){
   re=/^(([a-zA-Z0-9])+\.?)*([a-zA-Z0-9])+@(([a-zA-Z0-9])+\.)+[a-zA-Z]{2,4}$/;
   if(!re.test(email.value)){return false;}
   return true;
}
function checkPhone(phone){
   re=/^[0][1-9][0-9]{8,9}$/;
   if(!re.test(phone.value)){return false;}
   return true;
}