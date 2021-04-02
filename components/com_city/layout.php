<?php 
defined("ISHOME") or die("Can not acess this page, please come back!");
$COMS="city";
define('THIS_COM_PATH',COM_PATH.'com_'.$COMS.'/');
$objUser=new CLS_USER();
$obj=new CLS_MYSQL();
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>