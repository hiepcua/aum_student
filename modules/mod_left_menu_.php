<?php
defined('ISHOME') or die("You can't access this page!");
if(!$UserLogin->isLogin()) die("You can't access this page!");

$khoa_selected 	= isset($_GET['khoa'])?addslashes(strip_tags($_GET['khoa'])):'';
$nganh_selected = isset($_GET['nganh'])?addslashes(strip_tags($_GET['nganh'])):'';
$he_selected 	= isset($_GET['he'])?addslashes(strip_tags($_GET['he'])):'';
$malop_selected = isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';

$data_action = "khoa";
$data_value = date("Y");
if($malop_selected!='') { $data_action="lop"; $data_value=$malop_selected;}
elseif($he_selected!='') { $data_action="he"; $data_value=$he_selected;}
elseif($nganh_selected!='') { $data_action="nganh"; $data_value=$nganh_selected;}
elseif($khoa_selected!='') { $data_action="khoa"; $data_value=$khoa_selected;}

function Load_Khoa($type,$data_action,$data_value){
	$sql="SELECT * FROM tbl_khoa ORDER BY id DESC";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	echo "<ul>"; $i=0; $icon=ROOTHOST."images/icons/icon-calendar.png";
	while($r=$obj->Fetch_Assoc()){
		$id=$r['id'];$name=$r['name'];
		if($data_action=="khoa" && $data_value==$id)
			echo "<li data-jstree='{\"icon\":\"$icon\",\"opened\":true}'>";
		else echo "<li data-jstree='{\"icon\":\"$icon\"}'>";
		echo "<a href='javascript:void(0);' data_action='khoa' dataid='$id'>
			<i class='fa fa-calendar''></i>$name</a>";
			Load_He($id,$data_action,$data_value);
		echo "</li>"; $i++;
	}
	echo "</ul>";
}
function Load_He($id_khoa,$data_action,$data_value){
	$sql="SELECT * FROM tbl_he";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	echo "<ul>"; $icon=ROOTHOST."images/icons/icon-book.png";
	while($r=$obj->Fetch_Assoc()){
		$id=$r['id'];$name=$r['name'];
		if($data_action=="he" && $data_value==$id)
			echo "<li data-jstree='{\"icon\":\"$icon\",\"opened\":true}'>";
		else echo "<li data-jstree='{\"icon\":\"$icon\"}'>";
		echo "<a href='javascript:void(0);' data_action='he' dataid='$id' datakhoa='$id_khoa'>
				<i class='fa fa-calendar''></i> $name</a>";
				Load_Nganh($id_khoa,$id,$data_action,$data_value);
		echo "</li>";
	}
	echo "</ul>";
}
function Load_Nganh($id_khoa,$id_he,$data_action,$data_value){
	$sql="SELECT * FROM tbl_nganh";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	echo "<ul>"; $icon=ROOTHOST."images/icons/icon-training.png";
	while($r=$obj->Fetch_Assoc()){
		$id=$r['id'];$name=$r['name'];
		$str=Load_Lop($id_khoa,$id_he,$id,$data_action,$data_value);
		if ($str!='' || ($data_action=="nganh" && $data_value==$id)) 
			echo "<li data-jstree='{\"icon\":\"$icon\",\"opened\":true}'>";
		else echo "<li data-jstree='{\"icon\":\"$icon\"}'>";
		echo "	<a href='javascript:void(0);' data_action='nganh' dataid='$id' datakhoa='$id_khoa' datahe='$id_he'>
				<i class='fa fa-calendar''></i> $name</a>";
				echo $str;
		echo "</li>";
	}
	echo "</ul>";
}
function Load_Lop($id_khoa,$id_he,$id_nganh,$data_action,$data_value){
	$sql="SELECT * FROM tbl_lop WHERE id_khoa='$id_khoa' AND id_he='$id_he' 
	AND id_nganh='$id_nganh' ORDER BY id DESC";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	$str="<ul>"; $icon=ROOTHOST."images/icons/icon-class3.png";
	while($r=$obj->Fetch_Assoc()){
		$id=$r['id'];$name=$r['name']; $cls ='';
		if($data_action=="lop" && $data_value==$id) {
			$str.="<li data-jstree='{\"icon\":\"$icon\",\"opened\":true}'>";
			$cls = "jstree-clicked";
		}else $str.="<li data-jstree='{\"icon\":\"$icon\"}'>";		
		$str.="<a href='javascript:void(0);' data_action='lop' dataid='$id' datakhoa='$id_khoa' datahe='$id_he' datanganh='$id_nganh'>
				<i class='fa fa-calendar''></i> Lớp $id</a>";
		$str.="</li>";
	}
	$str.="</ul>";
	return $str;
}
?>
<div class='main-menu'>
	<h3 class='title'>HỆ THỐNG TỔ CHỨC</h3>
	<div id="jstree"><ul>
		<?php $icon=ROOTHOST."images/icons/icon-university.png";
		foreach($GLOBALS['ARR_SOURCE'] as $k=>$v ) { ?>
		<li data-jstree='{"icon":"<?php echo $icon;?>","opened":true}'><a href='javascript:void();' dataid='<?php echo $k;?>' data_action='type'><?php echo $v;?></a>
		<?php Load_Khoa($k,$data_action,$data_value);?></li>
		<?php } ?>
	</ul></div>
</div>
<script>
// tree view
var selectedTree = '';
$('#jstree').jstree();
$('#jstree').on("changed.jstree", function (e, data) {
	selectedTree = data.selected[0];
	_action=$("#"+selectedTree+"_anchor").attr('data_action');
	_value=$("#"+selectedTree+"_anchor").attr('dataid');
	console.log(_action+" / "+_value);
	$('#mnu_action').val(_action);
	$('#mnu_id').val(_value);
	if(_action=="khoa") {
		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);
		if(searchParams.has("khoa")===true){ searchParams.delete("khoa");}
		searchParams.append("khoa",_value);
		if(searchParams.has("he")===true){ searchParams.delete("he");}
		if(searchParams.has("nganh")===true){ searchParams.delete("nganh");}
		if(searchParams.has("malop")===true){ searchParams.delete("malop");}
		
		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);
		var url = window.location.href;
		console.log(url);
		window.location=url;
	}
	if(_action=="he") {
		_khoa=$("#"+selectedTree+"_anchor").attr('datakhoa');
		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);
		if(searchParams.has("khoa")===true){ searchParams.delete("khoa");}
		searchParams.append("khoa",_khoa);
		if(searchParams.has("he")===true){ searchParams.delete("he");}
		searchParams.append("he",_value);
		if(searchParams.has("nganh")===true){ searchParams.delete("nganh");}
		if(searchParams.has("malop")===true){ searchParams.delete("malop");}
		
		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);
		var url = window.location.href;
		console.log(url);
		window.location=url;
	}
	if(_action=="nganh") {
		_khoa=$("#"+selectedTree+"_anchor").attr('datakhoa');
		_he=$("#"+selectedTree+"_anchor").attr('datahe');
		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);
		if(searchParams.has("khoa")===true){ searchParams.delete("khoa");}
		searchParams.append("khoa",_khoa);
		if(searchParams.has("he")===true){ searchParams.delete("he");}
		searchParams.append("he",_he);
		if(searchParams.has("nganh")===true){ searchParams.delete("nganh");}
		searchParams.append("nganh",_value);
		if(searchParams.has("malop")===true){ searchParams.delete("malop");}
		
		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);
		var url = window.location.href;
		console.log(url);
		window.location=url;
	}
	if(_action=="lop") {
		_khoa=$("#"+selectedTree+"_anchor").attr('datakhoa');
		_he=$("#"+selectedTree+"_anchor").attr('datahe');
		_nganh=$("#"+selectedTree+"_anchor").attr('datanganh');
		
		var url = window.location.href;
		var urlSplit = url.split( "?" );  
		var searchParams = new URLSearchParams(window.location.search);
		if(searchParams.has("khoa")===true){ searchParams.delete("khoa");}
		searchParams.append("khoa",_khoa);
		if(searchParams.has("he")===true){ searchParams.delete("he");}
		searchParams.append("he",_he);
		if(searchParams.has("nganh")===true){ searchParams.delete("nganh");}
		searchParams.append("nganh",_nganh);
		if(searchParams.has("malop")===true){ searchParams.delete("malop");}
		searchParams.append("malop",_value);
		
		var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
		history.pushState(null, obj.Title, obj.Url);
		var url = window.location.href;
		console.log(url);
		window.location=url;
	}
	
});
$('button').on('click', function () {
  $('#jstree').jstree(true).select_node('child_node_1');
  $('#jstree').jstree('select_node', 'child_node_1');
  $.jstree.reference('#jstree').select_node('child_node_1');
});
// end tree view
function loadHocSinh(){
	
}
$(document).ready(function(){
	h=$(window).outerHeight()-45;
	$('#site_left').css({"width":"260px","height":h+'px',"overflow":"hidden"});
	h-=45;
	$('#site_left .main-menu').css({"height":h+'px',"overflow":"scroll"});
});
</script>