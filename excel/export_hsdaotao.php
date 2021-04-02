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
require_once('../libs/cls.city.php');
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
$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.city,b.dienthoai 
		FROM tbl_dangky_tuyensinh AS a 
		RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
		WHERE b.isactive=1 and nhaphoc=1"; 

$khoa=isset($_GET['khoa'])?addslashes(strip_tags($_GET['khoa'])):'';
$he=isset($_GET['he'])?addslashes(strip_tags($_GET['he'])):'';
$nganh=isset($_GET['nganh'])?addslashes(strip_tags($_GET['nganh'])):'';
$malop=isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
if($khoa!='') {
	$sql.=" AND a.id_khoa='$khoa'";
	$page_title = "QL đào tạo khóa $khoa";
	$params .= "khoa=$khoa";
}
if($he!='') {
	$sql.=" AND a.id_he='$he'";
	$objhe = new CLS_HE; $he_name = $objhe->getName($he);
	$page_title = "QL đào tạo hệ $he_name";
	$params .= "&he=$he";
}
if($nganh!='') { 
	$sql.=" AND a.id_nganh='$nganh'"; 
	$objnganh = new CLS_NGANH; $nganh_name = $objnganh->getName($nganh);
	$page_title = "QL đào tạo khoa $nganh_name";
	$params .= "&nganh=$nganh";
}
if($malop!='') { 
	$sql.=" AND a.malop='$malop'"; 
	$page_title = "Danh sách lớp $malop";
	$params .= "&malop=$malop";
}

$hoten=isset($_GET['hoten'])?addslashes(strip_tags($_GET['hoten'])):'';
$ns=isset($_GET['ns'])?addslashes(strip_tags($_GET['ns'])):'';
$dc=isset($_GET['dc'])?addslashes(strip_tags($_GET['dc'])):'';
$masv=isset($_GET['masv'])?addslashes(strip_tags($_GET['masv'])):'';
if($hoten!='') $sql.=" AND (b.ho_dem LIKE '%$hoten%' OR b.name LIKE '%$hoten%')";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $sql.=" AND b.diachi LIKE '%$dc%'";
if($masv!='') $sql.=" AND a.masv LIKE '%$masv%'";

$sql.=" ORDER BY a.id_nganh ASC,a.malop ASC ";
$obj->Query($sql);
$total_rows = $obj->Num_rows();

$objExcelAll = new PHPExcel();
$nameFile="hsdaotao_".date("YmdHis");
// Khởi tạo đối tượng mới và xử lý
$objPHPExcel = new PHPExcel();
// Set document properties
$objPHPExcel->getProperties()->setCreator("EEA")
->setLastModifiedBy("EEA")
->setTitle("EEA - Danh sách sinh viên")
->setSubject("EEA - Danh sách sinh viên")
->setDescription("EEA - Danh sách sinh viên")
->setKeywords("EEA - Danh sách sinh viên")
->setCategory("EEA - Danh sách sinh viên");

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
$template="hsdaotao.xlsx";
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

$stt=1; $i=4;
while($r=$obj->Fetch_Assoc()) { 
	$id_hoso = $r['ma']; $masv=$r['masv']; $lop=$r['malop'];
	$objcity = new CLS_CITY();
	$city_name = $objcity->getNameById($r['city']);
	$gender = $GLOBALS['ARR_GENDER'][$r['gioitinh']];
	
	// set gia tri cho cac cot du lieu
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $stt);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($styleCenter);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $r['id_nganh']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $r['malop']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $masv);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, stripslashes($r['ho_dem']));
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, stripslashes($r['name']));
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $gender);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, date("d/m/y",$r['ngaysinh']));
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $city_name);
	/** Borders for data */
	$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':I'.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$stt++;$i++;
	//Set print area.
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPrintArea('A1:I'.$i); 
}
$objPHPExcel->getActiveSheet()->getStyle('O1:O1000')->getAlignment()->setWrapText(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$arr_url="cache/".$nameFile.".xlsx";
if(is_file($arr_url)) unlink($arr_url);
$objWriter->save($arr_url);
echo $arr_url;	
?>