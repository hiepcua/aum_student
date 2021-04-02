<?php 
defined("ISHOME") or die("Can not acess this page, please come back!");
$check_permission = $UserLogin->Permission('report');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$COMS="report";
define('THIS_COM_PATH',COM_PATH.'com_'.$COMS.'/');
$objUser=new CLS_USER();
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='default';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>