<?php
	header('Content-Type: text/plain');

	// If you need to parse XLS files, include php-excel-reader
	require('php-excel-reader/excel_reader2.php');

	require('SpreadsheetReader.php');

	$Reader = new SpreadsheetReader('ds_mail.xls');
	$str=array();
	foreach ($Reader as $Row)
	{
		if($Row[0]!='') {
			if(filter_var($Row[0], FILTER_VALIDATE_EMAIL)) {
				// valid address
				$str[]=$Row[0];
			}
			else {
				// invalid address
			}
		}
	}
	print_r($str);
?>
