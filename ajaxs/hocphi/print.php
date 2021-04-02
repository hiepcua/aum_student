<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.hocsinh.php');
require_once('../../libs/cls.tuyensinh.php');

$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
if(isset($_POST['ma']) && $_POST['ma']!='' && isset($_POST['id_hocphi_pay']) && $_POST['id_hocphi_pay']!='') {
	$ma  = isset($_POST['ma']) ? addslashes(htmlentities(strip_tags($_POST['ma']))) : '';
	$id_hocphi_pay  = isset($_POST['id_hocphi_pay']) ? (int)$_POST['id_hocphi_pay'] : '';
	
	// style print
	$html ='<style>
	@media print {
		body {
			font: 13px "Times New Roman", Times, serif;
			line-height: 1.3;
			background: #fff !important;
			color: #000;
		}
		h1 {font-size: 24pt;}

		h2, h3, h4 {
			font-size: 14pt;
			margin-top: 25px;
		}
		.page-title {
			padding: 0;
			font-size: 24px;
			letter-spacing: -1px;
			display: block;
			color: #333;
			font-weight: 300;
			margin-bottom: 10px;
			margin-top: 10px;
			text-align:center;
		}
		.panel-warning {
			border-color: #faebcc;
		}
		.panel {
			margin-bottom: 20px;
			background-color: #fff;
			border: 1px solid transparent;
			border-radius: 4px;
			-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
			box-shadow: 0 1px 1px rgba(0,0,0,.05);
		}
		.panel-body {
			padding: 15px;
		}
		table.table {
			background: white;
			border-collapse: collapse;
			width: 100%;
		}
		table.table tr, table.table th, table.table td {
			border: none;
			border-bottom: 1px solid #e8e8e8;
			font-size: 13px;
		}
		table.table th, table.table td {
			padding: 8px !important;
		}
		.table-bordered {
			border: 1px solid #ddd;
		}
		table.table-bordered tr, table.table-bordered th, table.table-bordered td {
			border: none;
			border-bottom: 1px solid #e8e8e8;
			font-size: 13px;
		}
		.table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, 
		.table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, 
		.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
			border: 1px solid #ddd;
		}
	}
	</style>';
	
	$objhs = new CLS_HS;
	$objhs->getList(" AND ma='$ma'");
	$r=$objhs->Fetch_Assoc();
	$fullname = $r['ho_dem'].' '.$r['name'];
	$gender = $GLOBALS['ARR_GENDER'][$r['gioitinh']];
	$ngaysinh = date("Y-m-d",$r['ngaysinh']);
	
	$objts = new CLS_TUYENSINH;
	$objts->getList(" AND id_hoso='$ma' ");
	$r_ts = $objts->Fetch_Assoc();
	$he = $r_ts['id_he'];
	$nganh = $r_ts['id_nganh'];
	$masv = $r_ts['masv'];
	$malop = $r_ts['malop'];
	
	$html.="<h3 align='center'>BIÊN LAI THU HỌC PHÍ</h3>
	<div align='center'><i>Ngày đóng: ".date("d/m/y")."</i></div>
	<table class='table' style='width:100%'>
		<tr><td width='100'>Mã sinh viên:</td><td>$masv</td>
			<td width='100'>Lớp:</td><td>$malop</td>
		</tr>
		<tr><td>Họ và tên:</td><td>$fullname</td>
			<td>Ngày sinh:</td><td>$ngaysinh</td>
		</tr>
	</table><br><div><b>Chi tiết các khoản thu</b></div>";
	
	$html.='<table class="table table-bordered">
			<thead><tr>
				<th width="30">STT</th>
				<th>Số tiền</th>
				<th style="text-align:left">Nội dung</th>
				<th>Ngày đóng</th>
			</tr></thead>
			<tbody>';
			
	$sql="SELECT * FROM tbl_hocphi_pay WHERE id=".$id_hocphi_pay; 
	$obj->Query($sql);
	$stt=0;
	if($obj->Num_rows()>0){
		while($hp=$obj->Fetch_Assoc()) {
			$stt++;
			$html.='<tr><td align="center">'.$stt.'</td>
			<td align="center">'.number_format($hp['sotien']).'</td>
			<td>'.$hp['noidung'].'</td>
			<td align="center">'.date('d-m-Y', $hp['date_pay']).'</td>';
			$html.='</tr>';
		}
	}
	$html.='<br><table width="100%">
		<tr><td align="center"><b>Người nộp tiền</b></td>
			<td width="50"></td>
			<td align="center"><b>Người thu tiền</b></td>
		</tr>
		<tr><td align="center"><i>(Ký, họ tên)</i></td>
			<td></td>
			<td align="center"><i>(Ký, họ tên)</i></td>
		</tr>
	</table>';
	echo $html;
}?>