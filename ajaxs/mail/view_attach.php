<?php
session_start();
require_once("../../../global/libs/gfinit.php");
require_once("../../../global/libs/gfconfig.php");
require_once("../../extensions/function.php");
require_once("../../libs/cls.mysql.php");
require_once("../../libs/cls.user.php");
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

if(isset($_GET['path'])) {
	$filename = base64_decode($_GET['path']);
	if(file_exists("../../".$filename)) {
		// images
		$arr_img = array('png','jpe','jpeg','jpg','gif','bmp','ico','tiff','tif','svg','svgz');
		// file
		$arr_file = array('txt','htm','html','php','css','js','json','xml','swf','flv');
		// office
		$arr_ms = array('doc','docx','xls','xlsx','rtf','ppt','pptx','odt','ods');
		// archives
		$arr_zip = array('zip','rar','exe','msi','cab');
		// audio/video
		$arr_video = array('mp3','mp4','qt','mov');
		// adobe
		$arr_adobe = array('pdf','psd','ai','eps','ps');
		
		$file	 	= pathinfo($filename);
		$path		= "../../".$filename;
		$ext 		= $file['extension'];
		$name 		= $file['filename'];
		
		if (in_array($ext, $arr_img)) 
			echo "<img src='".ROOTHOST_ADMIN.$filename."' class='img-responsive'/>"; 
		else echo '<div class="name"><strong>'.$name.'</strong><br></div>'; 
	} else echo "Đường dẫn file không tồn tại hoặc đã bị xóa.";
}
?>