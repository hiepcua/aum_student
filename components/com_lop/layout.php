<?php
$COM='lop';
$_OBJDATA=new CLS_MYSQL;
$task=isset($_GET['task'])?addslashes($_GET['task']):'list';
$path_task="components/com_$COM/task/$task.php";
if(is_file($path_task)) include($path_task);