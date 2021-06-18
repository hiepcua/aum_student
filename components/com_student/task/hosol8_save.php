<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_POST['lop_gv'])) {
	die("<div>Không có dữ liệu cần lưu trữ. <a href='".ROOTHOST."student/hosol8' class='btn btn-primary'>Quay lại Contact L8</a></div>");
}
//echo "<pre>"; print_r($_POST);
$result_msg = ""; $result_flag = true;
//$hoso_ids = antiData($_POST['hoso_ids']);

$arr_lop = array();
foreach ($_POST['lop_gv'] as $k=>$v) {
	$arr = explode("|",$v);
	if(isset($arr[0]) || isset($arr[1])) {
		$lop = antiData($arr[0]);
		$gv  = antiData($arr[1]);
		$arr_lop[$lop]['giaovu'] = $gv; // Lớp | Mã giáo vụ
		$arr_lop[$lop]['id_nganh'] = $_POST["lop_nganh"][$k];
	}
} //print_r($arr_lop);

/* ------------------------- get contact data ----------------------------*/
$contact_data = file_get_contents('jsons/contact_data.json');
$arr_hsL8 = json_decode($contact_data, true);
// Lưu danh sách lớp mới
$cdate = time();
foreach($arr_lop as $k=>$v) {
	$arr   = array();
	$arr['id'] 		= $k;
	$arr['name'] 	= $k;
	$arr['id_nganh']= $v['id_nganh'];
	$arr['id_he'] 	= 'AUM';
	$arr['id_khoa'] = date("Y");
	$arr['cdate'] 	= $cdate;
	
	SysAddNotExist('tbl_lop',$arr);
}

// Lưu danh sách học viên mới
$stt = 0; $hoso_ids = ''; $total = 0;
foreach($arr_hsL8 as $item) { 
	$stt++;
	// insert bảng học sinh
	$arr   = array();
	$arr['ma'] 		 = $item['mkt_code_customer'];
	$arr['cmt'] 	 = $item['cmtnd'];	
	$fullname 		 = explode(" ",$item['name']);
	$name 			 = $fullname[count($fullname)-1];
	$arr['ho_dem'] 	 = str_replace(" ".$name,"",$item['name']);
	$arr['name'] 	 = $name;
	
	if($item['birthday'] != null && $item['birthday'] != "") 
		$arr['ngaysinh'] = $item['birthday'];
	$arr['gioitinh'] = $item['sex'] == 0 ? 'nu' : 'nam';
	$arr['diachi'] 	 = $item['address'];
	$arr['dienthoai']= $item['phone'];
	$arr['email']	 = $item['email'];
	$arr['trinhdo']  = $item['trinh_do'];
	$arr['cdate']	 = $cdate;
	
	$result1 = SysAddNotExist('tbl_hocsinh',$arr);
	
	// insert bảng dăng ký tuyển sinh
	$arr   = array();
	$arr['cdate'] 	 		= $cdate;
	$arr['masv'] 	 		= $item['masv'];
	$malop 	 		 		= $item['malop'];
	$arr['malop'] 	 		= $malop;
	$arr['id_nganh'] 		= $item['id_nganh_dang_ky'];
	$arr['id_he'] 	 		= $item['id_he_dao_tao'];
	$arr['id_hoso']  		= $item['mkt_code_customer'];
	$arr['nhomkhachhang'] 	= $item['id_nhom_khach_hang'];
	$arr['id_staff'] 		= $arr_lop[$malop]['giaovu'];

	$arr['namnhaphoc']    	= date("Y");
	$arr['ngayBG']   		= $item['ngay_ban_giao_hs'];
	$arr['tinhtrangBG']   	= $item['tinh_trang_bg_hs'];
	$arr['lydoBG']   		= $item['bghs_ly_do'];
	$arr['hs_tinhtrang']  	= $item['tinh_trang_hs'];
	$arr['hs_vo']  			= $item['ho_so_vo'];
	$arr['hs_anh']  		= $item['ho_so_anh'];
	$arr['hs_bang']  		= $item['ho_so_bang'];
	$arr['hs_cn_totnghiep']	= $item['hs_chung_nhan_tn'];
	$arr['hs_syll']  		= $item['ho_so_syll'];
	$arr['hs_bangdiem'] 	= $item['ho_so_bang_diem'];
	$arr['hs_hocba'] 		= $item['ho_so_hoc_ba'];
	$arr['hs_pdk'] 			= $item['ho_so_phieu_dk'];
	$arr['hs_giay_ks'] 		= $item['ho_so_phieu_kham_sk'];
	$arr['hs_mota'] 		= $item['ho_so_khac'];
	
	$result2 = SysAddNotExist('tbl_dangky_tuyensinh',$arr);
	
	if($result1 && $result2) {
		$total ++;
		$hoso_ids   .=  $item['masv'].',';
		$result_msg .= "<div class='form-group'><i class='fa fa-check cgreen'></i> $stt. ".$item['name']." (".$item['birthday'].")</div>";
	} else {
		$result_msg .= "<div class='form-group'><i class='fa fa-close cred'></i> $stt. ".$item['name']." (".$item['birthday'].")</div>";
	}
}

// Update những hồ sơ đã nhận (hồ sơ lưu thành công) cho bên TVTS
if($hoso_ids != "") {
	$hoso_ids = substr($hoso_ids,0,-1);
	$hoso_ids = str_replace(",","','",$hoso_ids);
	$json = array();
	$json['key']  = PIT_API_KEY;
	$json['ids']  = antiData($_POST['hoso_ids']);
	$jsondata = encrypt(json_encode($json,JSON_UNESCAPED_UNICODE),PIT_API_KEY);
	$api_data = Curl_Post(API_CONTACT_L8_UPDATE,json_encode(array('data'=>$jsondata)));
}
// Xóa dữ liệu contact L8
file_put_contents('jsons/contact_data.json',json_encode(array(),JSON_UNESCAPED_UNICODE));
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Contact L8 > Bước 3: Hoàn thành nhận hồ sơ L8</div>
			</div>
		</div>
	</div>
	<div class="panel panel-warning"><div class="panel-body">
		<div class="form-group alert alert-success">Đã hoàn thành nhận <b><?php echo $total;?></b> hồ sơ L8 mới.</div>
		<h4>Chi tiết như sau: </h4>
		<?php echo $result_msg;?>
	</div></div>
</div>