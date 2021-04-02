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
$params=isset($_GET['params'])?strip_tags(addslashes($_GET['params'])):"";

// Import thư viện phpexcel
include_once ("PHPExcel.php");
require_once ('PHPExcel/IOFactory.php');

// get info
$obj = new CLS_MYSQL;
$ten_khoa=$ten_nganh=$ten_he='';
$id_khoa=isset($_GET['khoa'])?addslashes(strip_tags($_GET['khoa'])):'';
$id_he=isset($_GET['he'])?addslashes(strip_tags($_GET['he'])):'';
$id_nganh=isset($_GET['nganh'])?addslashes(strip_tags($_GET['nganh'])):'';
$id_lop=isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
$id_hocky=isset($_GET['hocky'])?addslashes(strip_tags($_GET['hocky'])):'';

$sql = "select masv,sum(hocphi) as total,ispay from tbl_hocphi";
if($id_hocky!=='') {
	$id_hocky=(int)$id_hocky;
	$sql.=" WHERE hocky='$id_hocky'"; 
}
$sql.=" GROUP BY masv,ispay"; 

$obj->Query($sql);
$arrHP = array(); $tonghp=0;
while($rs=$obj->Fetch_Assoc()) {
	$arrHP[$rs['masv']][$rs['ispay']]=$rs['total']+0;
}
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai
		FROM tbl_dangky_tuyensinh AS a 
		INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma "; 

switch($id_hocky) {
	case "0":$sql.=" WHERE b.isactive=1 and (a.masv='' OR a.masv is null) AND a.trungtuyen is null and a.nhaphoc is null";break;
	case "1":$sql.=" WHERE b.isactive=1 and (a.masv='' or a.masv is null) AND trungtuyen=1 AND a.nhaphoc is null";break;
	case "2":$sql.=" WHERE b.isactive=1 and (a.masv='' or a.masv is null) AND trungtuyen=1 AND nhaphoc=1";break;
	case "3":$sql.=" WHERE b.isactive=1 and a.masv<>''";break;
}

if($id_khoa!=='') {
	$sql.=" AND a.id_khoa='$id_khoa'";
	$objkhoa = new CLS_KHOA;
	$ten_khoa = $objkhoa->getName($id_khoa);
}
if($id_he!=='') {
	$sql.=" AND a.id_he='$id_he'";
	$objhe = new CLS_HE;
	$ten_he = $objhe->getName($id_he);
}
if($id_nganh!=='') {
	$sql.=" AND a.id_nganh='$id_nganh'";
	$objng = new CLS_NGANH;
	$ten_nganh = $objng->getName($id_nganh);
}
if($id_lop!=='') {
	$sql.=" AND a.malop='$id_lop'";
}

$sql.=" ORDER BY a.id ASC";
$obj->Query($sql);	//echo $sql;
$total_rows = $obj->Num_rows();

$objExcelAll = new PHPExcel();
$nameFile="qlhocphi_".date("YmdHis");
// Khởi tạo đối tượng mới và xử lý
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("EEA")
->setLastModifiedBy("EEA")
->setTitle("EEA - Danh sách học phí")
->setSubject("EEA - Danh sách học phí")
->setDescription("EEA - Danh sách học phí")
->setKeywords("EEA - Danh sách học phí")
->setCategory("EEA - Danh sách học phí");

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
$template="qlhocphi.xlsx";
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
$objPHPExcel->getActiveSheet()->setCellValue('C2', $ten_khoa);
$objPHPExcel->getActiveSheet()->setCellValue('C3', $ten_he);
$objPHPExcel->getActiveSheet()->setCellValue('F2', $ten_nganh);
$objPHPExcel->getActiveSheet()->setCellValue('F3', $id_lop);
$objPHPExcel->getActiveSheet()->setCellValue('I3', $id_hocky);

$stt=1; $i=7;
while($r=$obj->Fetch_Assoc()) { 
	$id_hoso = $r['ma']; $masv=$r['masv']; 
	$total=0; $dadong=$chuadong=0;
	if(isset($arrHP[$masv][0])) $chuadong=$arrHP[$masv][0];
	if(isset($arrHP[$masv][1])) $dadong=$arrHP[$masv][1];
	$total = $dadong+$chuadong;
	$gender = $GLOBALS['ARR_GENDER'][$r['gioitinh']];
	
	// set gia tri cho cac cot du lieu
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $stt);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleCenter);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $r['id_nganh']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, stripslashes($r['ho_dem']));
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, stripslashes($r['name']));
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $gender);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, date("d/m/y",$r['ngaysinh']));
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $r['malop']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $r['masv']);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, number_format($total));
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, number_format($dadong));
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, number_format($chuadong));
	/** Borders for data */
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':K'.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$stt++;$i++;
	//Set print area.
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPrintArea('A1:K'.$i); 
}
$objPHPExcel->getActiveSheet()->getStyle('O1:O1000')->getAlignment()->setWrapText(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$arr_url="cache/".$nameFile.".xlsx";
if(is_file($arr_url)) unlink($arr_url);
$objWriter->save($arr_url);
echo $arr_url;	
?>