<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once('../../libs/cls.mysql.php');
$objMySql=new CLS_MYSQL;
$sql="SELECT count(oid) as num, oid FROM tbl_order_note GROUP BY oid HAVING num>0";
$objMySql->Query($sql);
$arr=array();
while($r=$objMySql->Fetch_Assoc()){
	$arr['id_'.$r['oid']]=array('num'=>$r['num'],'id'=>$r['oid']);
}
echo json_encode($arr);
?>