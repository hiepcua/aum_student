<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
define("COMS","user");
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
$obj = new CLS_USER();

// End toolbar
if($UserLogin->isLogin()) {
	$task=isset($_GET['task'])?$_GET['task']:'list';
	if(is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		include_once(THIS_COM_PATH.'task/'.$task.'.php');
	}
}
unset($obj); unset($task);	unset($ids);
?>