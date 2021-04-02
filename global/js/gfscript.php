<?php header("Content-type: text/javascript"); ?>
// JavaScript Document
function docheckall(name,status){
	var objs=document.getElementsByName(name);
	for(i=0;i<objs.length;i++)
		objs[i].checked=status;
	getIDchecked(name);
}
function docheckonce(name){
	var objs=document.getElementsByName(name);
	var flag=true;
	for(i=0;i<objs.length;i++)
		if(objs[i].checked!=true)
		{
			flag=false;
			break;
		}
	document.getElementById("chkall").checked=flag;
	getIDchecked(name);
}
function getIDchecked(name){
	var objs=document.getElementsByName(name);
	var strids="";
	for(i=0;i<objs.length;i++)
		if(objs[i].checked==true)
		{
			strids+=objs[i].value+",";
		}
	document.getElementById("txtids").value=strids;
	activeTr();
}
function activeTr(){
	var Trs=document.getElementsByName("trow");
	for(i=0;i<Trs.length;i++)
	{
		var check=Trs[i].getElementsByTagName("input");
		if(check[0].checked==true)
			Trs[i].className="active";
		else
			Trs[i].className="";
	}
}
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
	if(document.getElementById("txtids"))
		document.getElementById("txtids").value=id;
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
    document.getElementById("txtids").value = strids; 
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
    document.getElementById("txtids").value = strids; 
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

function gotopage(page)
{
	document.getElementById("txtCurnpage").value=page;
	document.frmpaging.submit();
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
/*function openBox(fileSrc,winW,winH,scBar,toBar,stBar,t,l){
	var sw = screen.width;
	var sh = screen.height;
	if(winW==null) winW = sw*0.70;
	if(winH==null) winH = sh*0.55;
	if(scBar==null) scBar = 'yes';
	if(toBar==null) toBar = 'no';
	if(stBar==null) stBar = 'yes';
	if(t==null) t = (sh-winH)/2;
	if(l==null) l = (sw-winW)/2;
	var newPar = "width="+winW+",height="+winH;
	newPar += ",scrollbars="+scBar+",toolbar="+toBar;
	newPar += ",status="+stBar+",left="+l+",top="+t;
	window.open(fileSrc,"a",newPar); 
}*/
function add2cart(ItemID)
{
	var xmlhttp;
	if (ItemID.length==0)
	  {
	  document.getElementById("txtHint").innerHTML="";
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
		document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","index.php?com=add2cart&ItemID="+ItemID,true);
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

function check_input_dangky() {
	var name   = document.getElementById("name");
	var phone  = document.getElementById("phone");
	var email  = document.getElementById("email");
	var course = document.getElementById("cbo_course");
	var sercur = document.getElementById("txt_security");
	var flag=true;
	$("#msgbox_name").html('').addClass('messageboxerror').fadeTo(600,1);
	$("#msgbox_phone").html('').addClass('messageboxerror').fadeTo(600,1);
	$("#msgbox_email").html('').addClass('messageboxerror').fadeTo(600,1);
	$("#msgbox_course").html('').addClass('messageboxerror').fadeTo(600,1);
	$("#msgbox_sercur").html('').addClass('messageboxerror').fadeTo(600,1);
	
	if(name.value=='') {
		$("#msgbox_name").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập họ tên').addClass('messageboxerror').fadeTo(600,1);
		});
		flag=false;
	}
	if(sercur.value=='') {
		$("#msgbox_sercur").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Bạn phải điền captcha').addClass('messageboxerror').fadeTo(600,1);
		});
		flag=false;
	}
	if(phone.value=='') {
		$("#msgbox_phone").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập số điện thoại').addClass('messageboxerror').fadeTo(600,1);
		});
		flag=false;
	}
	if (checkPhone(phone)==false) {
		$("#msgbox_phone").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Số điện thoại không hợp lệ').addClass('messageboxerror').fadeTo(600,1);
		});
		flag=false;
	}
	if(email.value=='') {
		$("#msgbox_email").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập Email').addClass('messageboxerror').fadeTo(600,1);
		});
		flag=false;
	}
	if (checkEmail(email)==false) {
		$("#msgbox_email").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Địa chỉ Email không hợp lệ').addClass('messageboxerror').fadeTo(600,1);
		});
		flag=false;
	}
	
	if(course.value=='') {
		$("#msgbox_course").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng chọn khóa học').addClass('messageboxerror').fadeTo(600,1);
		});
		flag=false;
	}
	
	return flag;
}
function check_ca11() {
	var ctr = document.getElementsByName("check_ca1");
	var str="Ca1 thứ:";
	for (var i=0;i<ctr.length;i++) {
		if(ctr[i].checked){		
		str+=ctr[i].value+",";
		}
	}
	document.getElementById("txt_ca1").value=str;
}
function check_ca22() {
	var ctr = document.getElementsByName("check_ca2");
	var str="Ca2 thứ:";
	for (var i=0;i<ctr.length;i++) {
		if(ctr[i].checked){
			str+=ctr[i].value+",";
		}
	}
	document.getElementById("txt_ca2").value=str;
}

