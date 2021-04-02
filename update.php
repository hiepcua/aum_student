<?php
/*require_once('global/libs/gfconfig.php');
require_once('global/libs/gfinit.php');
require_once('global/libs/gffunc.php');
require_once('libs/cls.mysql.php');
$obj = new CLS_MYSQL;
function unHtmlentities($table){ 
	$sql = "SELECT * FROM $table";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	while($r=$obj->Fetch_Assoc()){
		$sql="UPDATE $table SET ";
		foreach($r as $key=>$val){
			$newVal=html_entity_decode($val);
			if($key!='id')
			$sql.="`$key`='$newVal',";
		}
		$sql=substr($sql,0,-1)." WHERE id='{$r['id']}'";
		echo $sql."<br/>";
		$obj->Exec($sql);
	}
}
$sql="show tables";
$obj->Query($sql);
while($r=$obj->Fetch_Assoc()){
	//unHtmlentities($r['Tables_in_edaotao']);
}
*/ ?>