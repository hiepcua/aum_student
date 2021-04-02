<?php
session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Ho_Chi_Minh");
require_once('../global/libs/gfconfig.php');
require_once('../global/libs/gfinit.php');
require_once('../global/libs/gffunc.php');
require_once('../includes/gfconfig.php');
require_once('../libs/cls.mysql.php');
require_once('../libs/cls.users.php');
require_once('../libs/cls.khoa.php');
require_once('../libs/cls.he.php');
require_once('../libs/cls.nganh.php');
$template=$nameFile="";
$lfcr = chr(10) . chr(13);
$infoOrder=$infoUser=$arrListItem=array();

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$username = $objuser->getInfo('username');

$cdate=date("d-m-Y H:i:s");
// Import thư viện phpexcel
include_once ("PHPExcel.php");
require_once ('PHPExcel/IOFactory.php');

$obj = new CLS_MYSQL;
//---------------------------------------
$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$_HE=array();
while($r=$obj->Fetch_Assoc()){
	$_HE['H'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH['N'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_khoa";
$obj->Query($sql);
$_KHOA=array();
while($r=$obj->Fetch_Assoc()){
	$_KHOA['K'.$r['id']]=$r['name'];
}
unset($r);
// get info
$ten_khoa=$ten_nganh=$ten_he='';
$ten=isset($_GET['ten'])?addslashes(strip_tags($_GET['ten'])):'';
$cmt=isset($_GET['cmt'])?addslashes(strip_tags($_GET['cmt'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$nganh=isset($_GET['nganh'])?addslashes(strip_tags($_GET['nganh'])):'';
$sbd=isset($_GET['sbd'])?addslashes(strip_tags($_GET['sbd'])):'';

$strWhere=" AND a.trungtuyen=1 AND a.nhaphoc=0";
if($ten!='') {
	$strWhere.=" AND (b.name LIKE '%$ten%' OR b.nickname LIKE '%$ten%')";
}
if($cmt!='') {
	$strWhere.=" AND b.cmt LIKE '%$cmt%'";
}
if($ns!='') {
	$ns = strtotime($ns);
	$strWhere.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') {
	$strWhere.=" AND b.diachi LIKE '%$dc%'";
}
if($nganh!='') {
	$strWhere.=" AND a.id_nganh='$nganh'";
}
if($sbd!='') {
	$strWhere.=" AND a.sbd LIKE '%$sbd%'";
}

$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE 1=1 $strWhere";
$sql .= " ORDER BY a.nhaphoc ASC ";
$obj->Query($sql);

$objExcelAll = new PHPExcel();
$nameFile="hstrungtuyen_".date("YmdHis");
// Khởi tạo đối tượng mới và xử lý
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("EEA")
->setLastModifiedBy("EEA")
->setTitle("EEA - Danh sách hồ sơ trúng tuyển")
->setSubject("EEA - Danh sách hồ sơ trúng tuyển")
->setDescription("EEA - Danh sách hồ sơ trúng tuyển")
->setKeywords("EEA - Danh sách hồ sơ trúng tuyển")
->setCategory("EEA - Danh sách hồ sơ trúng tuyển");

// Set Orientation and Paper Size
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

//Page margins
$objPHPExcel->getActiveSheet()
	->getPageMargins()->setTop(0.5);
$objPHPExcel->getActiveSheet()
	->getPageMargins()->setRight(0.75);
$objPHPExcel->getActiveSheet()
	->getPageMargins()->setLeft(0.75);
$objPHPExcel->getActiveSheet()
	->getPageMargins()->setBottom(0.5);
//Headers and Footers
$objPHPExcel->getActiveSheet()
->getHeaderFooter()->setOddFooter('&R&F Page &P / &N');
$objPHPExcel->getActiveSheet()
->getHeaderFooter()->setEvenFooter('&R&F Page &P / &N'); 

// load template có sẵn
$template="hstrungtuyen.xlsx";
$objPHPExcel = PHPExcel_IOFactory::load("$template");

// style color, fontsize
$styleCenter=array(
'alignment'=>array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);
$styleRight=array(
'alignment'=>array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);
$styleLeft=array(
'alignment'=>array(
	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);
$styleEnd = array(
'font' => array(
	'size' => 12,'bold' => true,
	'color' => array('rgb' => 'fffff')
	),
'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => '3f67cd')
	),
'alignment'=>array(
	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	)
);

// set gia tri cot du lieu
$objPHPExcel->getActiveSheet()->setCellValue('F2',"Ngày xuất file: ".date("d/m/Y"));

$stt=1; $i=5; 
while($r=$obj->Fetch_Assoc()) { 
	$id_hoso = $r['ma']; 
	$gender = $GLOBALS['ARR_GENDER'][$r['gioitinh']];

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $stt);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleCenter);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $id_hoso);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, stripslashes($r['ho_dem']).' '.stripslashes($r['name']));
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, date("d/m/y",$r['ngaysinh']));
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $gender);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $r['dienthoai']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $r['diachi']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $_NGANH['N'.$r['id_nganh']]);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $_KHOA['K'.$r['id_khoa']]);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $_HE['H'.$r['id_he']]);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, 'Trúng tuyển');

	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':K'.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$stt++;$i++;

	$objPHPExcel->getActiveSheet()->getPageSetup()->setPrintArea('A1:K'.$i); 
}
$objPHPExcel->getActiveSheet()->getStyle('O1:O1000')->getAlignment()->setWrapText(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$arr_url="cache/".$nameFile.".xlsx";
if(is_file($arr_url)) unlink($arr_url);
$objWriter->save($arr_url);
echo $nameFile.".xlsx";
?>