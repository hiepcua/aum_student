<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once('../../libs/cls.mysql.php');
$objMySql=new CLS_MYSQL;
$sql="SELECT count(id_hoctap) as num, id_hoctap FROM tbl_hoctap_note GROUP BY id_hoctap HAVING num>0";
$objMySql->Query($sql);
$arr=array();
while($r=$objMySql->Fetch_Assoc()){
	$arr['id_'.$r['id_hoctap']]=array('num'=>$r['num'],'id'=>$r['id_hoctap']);
}
echo json_encode($arr);
?>