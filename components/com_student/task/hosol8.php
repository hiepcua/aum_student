<?php
defined('ISHOME') or die("You can't access this page!");
$ma=isset($_GET['ma']) ? antiData($_GET['ma']) : '';
$ten=isset($_GET['ten']) ? antiData($_GET['ten']) : '';
$phone=isset($_GET['phone']) ? antiData($_GET['phone']) : '';
$email=isset($_GET['email']) ? antiData($_GET['email']) : '';
$cur_page=isset($_GET['page']) ? antiData($_GET['page'], 'int') : 1;

// get ngành
$arr_nganh2 = array();
$arr_nganh=(array) json_decode(file_get_contents('jsons/nganh.json'),true);
if(is_array($arr_nganh) && count($arr_nganh)>0){
	foreach ($arr_nganh as $key => $value) {
		$arr_nganh2[$value['id_bo']] = $value;
	}
}

/* ------------------------- get contact data ----------------------------*/
//$contact_data = file_get_contents('jsons/contact_data.json');
//$contact_data = json_decode($contact_data,true);  
//if(count($contact_data) == 0) {
	$json = array();
	$json['key'] 		= PIT_API_KEY;
	$json['id_school']  = SCHOOL_CODE;
	$jsondata= encrypt(json_encode($json,JSON_UNESCAPED_UNICODE),PIT_API_KEY);

	$api_data = Curl_Post(API_CONTACT_L8,json_encode(array('data'=>$jsondata)));
	// echo "<pre>"; var_dump($api_data); echo "</pre>";
	if($api_data['status'] == "no") die($api_data['data']);

	$arr_hsL8 = array();
	if(is_array($api_data['data']) && count($api_data['data'])>0){
		foreach($api_data['data'] as $item){
			$item['id_nganh_dang_ky_bo'] = $item['id_nganh_dang_ky'];
			$_id_nganh = isset($arr_nganh2[$item['id_nganh_dang_ky']]) ? $arr_nganh2[$item['id_nganh_dang_ky']]['id'] : "";
			$item['id_nganh_dang_ky'] = $_id_nganh;
			$arr_hsL8[$item['mkt_code_customer']] = $item;
		}
	}

	file_put_contents('jsons/contact_data.json',json_encode($arr_hsL8,JSON_UNESCAPED_UNICODE));
//}else 
	//$arr_hsL8 = $contact_data;
/* ------------------------- /.API get data ----------------------------*/
function searchArray($arr=null, $index='', $str=''){
	$result = array();
	foreach ($arr as $key => $value) {
		if(strcasecmp($value[$index], $str)==0){
			$result[] = $value;
		}
	}
	return $result;
}

/*if($ma!='') $arr_hsL8 = searchArray($arr_hsL8, 'mkt_code_customer', $ma);
if($ten!='') $arr_hsL8 = searchArray($arr_hsL8, 'name', $ten);
if($phone!='') $arr_hsL8 = searchArray($arr_hsL8, 'phone', $phone);
if($email!='') $arr_hsL8 = searchArray($arr_hsL8, 'email', $email);
*/
/*$total_rows=count($arr_hsL8);
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$offset = $start + MAX_ROWS;*/
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Contact L8</div>
			</div>
			<!-- <ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>?com=student&task=import" class="btn btn-success btn-import" title="Import hồ sơ"><i class="fa fa-upload"></i> Import hồ sơ</a>
				</li>
				<li>
					<a href="<?php echo ROOTHOST;?>student/add" class="btn btn-primary btn-add" title="Thêm hồ sơ"><i class="fa fa-plus"></i> Thêm hồ sơ</a>
				</li>
			</ul> -->
		</div>
	</div>

	<?php include("search_hsl8.php");?>
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead><tr class="header">
				<th class="text-center">STT</th>
				<th class="text-center">Mã hồ sơ</th>
				<th class="text-center">Mã SV</th>
				<th>Họ tên</th>
				<th class="text-center">Điện thoại</th>
				<th>Email</th>
				<th>Ngành đăng ký</th>
				<th>Hệ đào tạo</th>
				<th>Lớp</th>
				<th>Ngày bàn giao</th>
				<th>Tình trạng BG</th>
				<th>Tình trạng hồ sơ</th>
				<th><input type="checkbox" name="chkall" id="chkall" value="" onclick="orderCheckAll(this.checked);"></th>
			</tr></thead>
			<tbody id="datatable-hoso">
				<?php
				// get hệ/bậc
				$arr_bac=(array) json_decode(file_get_contents('jsons/he.json'),true);
				$stt = 0;
				if(count($arr_hsL8) > 0) {
					foreach($arr_hsL8 as $value){
						$stt ++;
						//$value 		= $arr_hsL8[$i];
						$ma_hoso 		= $value['mkt_code_customer'];
						$masv 			= $value['masv'];
						$malop 			= $value['malop'];
						$hovaten 		= $value['name'];
						$dienthoai 		= $value['phone'];
						$email 			= $value['email'];
						$link 			= $ma_hoso != "" ? ROOTHOST.'student/hosol8/'.$ma_hoso :'';
						$nganhdangky 	= $value['id_nganh_dang_ky'];
						if($nganhdangky != "" ) 
							$nganhdangky = isset($arr_nganh[$nganhdangky]) ? $arr_nganh[$nganhdangky]['name'] : "";
						$hedaotao 		= isset($value['id_he_dao_tao']) ? $value['id_he_dao_tao'] : "";

						if($hedaotao != "")
							$hedaotao 	= isset($arr_bac["$hedaotao"]) ? $arr_bac["$hedaotao"]['name'] : "";
						$ngayBG 		= ($value['ngay_ban_giao_hs'] !== null && $value['ngay_ban_giao_hs'] !== '') ? date('Y-m-d', $value['ngay_ban_giao_hs']) : '';
						$tinhtrangBG 	= $value['tinh_trang_bg_hs'];
						if($tinhtrangBG != "")
							$tinhtrangBG	= $_GLOBALS['STATUS_BAN_GIAO_HO_SO']["$tinhtrangBG"];
						$lydoBG 		= $value['bghs_ly_do'];
						$hs_tinhtrang 	= $value['tinh_trang_hs'];
						if($hs_tinhtrang != "")
							$hs_tinhtrang	= $_GLOBALS['STATUS_TINH_TRANG_HO_SO']["$hs_tinhtrang"];
						$hs_vo 			= $value['ho_so_vo'];
						$hs_anh 		= $value['ho_so_anh'];
						$hs_bang 		= $value['ho_so_bang'];
						$hs_cn_totnghiep= $value['hs_chung_nhan_tn'];
						$hs_cmt 		= $value['ho_so_cmt'];
						//$hs_mota 		= $value['hs_mota'];
						$hs_syll 		= $value['ho_so_syll'];
						$hs_khac 		= $value['ho_so_khac'];
						
						$cls = ($ma_hoso == '' || $masv == '' ||$malop == '' || $value['tinh_trang_hs'] == 'thieu') ? 'style="background: #f7f7d4"' : '';

						echo '<tr dataid="'.$ma_hoso.'" '.$cls.'>';
						echo '<td align="center">'.$stt.'</td>';
						echo '<td align="center"><a href="'.$link.'" title="'.$ma_hoso.'">'.$ma_hoso.'</a></td>';
						echo '<td><a href="'.$link.'" title="'.$ma_hoso.'">'.$masv.'</a></td>';
						echo '<td><a href="'.$link.'" title="'.$ma_hoso.'">'.$hovaten.'</a></td>';
						echo '<td align="center">'.$dienthoai.'</td>';
						echo '<td>'.$email.'</td>';
						echo '<td>'.$nganhdangky.'</td>';
						echo '<td>'.$hedaotao.'</td>';
						echo '<td>'.$malop.'</td>';
						echo '<td>'.$ngayBG.'</td>';
						echo '<td>'.$tinhtrangBG.'</td>';
						echo '<td>'.$hs_tinhtrang.'</td>';
						if($ma_hoso == '' || $masv == '' ||$malop == '' || $value['tinh_trang_hs'] == 'thieu') 
							echo '<td></td>';
						else echo '<td><input type="checkbox" name="chk" class="chk" onclick="orderCheckOnce();" value="'.$ma_hoso.'"></td>';
						echo '</tr>';
					}
				} else echo "<tr><td colspan='13' align='center'><b>Chưa có thông tin contact L8</b></td></tr>";?>
			</tbody>
		</table>
	</div>
	
	<div id="tablefixbottom"><div class="inner">
		<form name="frm_import" id="frm_import" method="POST" action="<?php echo ROOTHOST;?>student/import_hosol8" style="overflow: hidden"/>
			<div class="box pull-right">
				<span class="total_orders">Tổng hồ sơ: <span>0</span></span>
				<input type="hidden" name="hoso_ids" id="hoso_ids" value="" class="form-control">
				<button type="button" id="ImportContactL8" class="btn btn-success">
				<i class="fa fa-save"></i> NHẬN HỒ SƠ</button>
			</div>
			<div class="waiting"></div>
		</form>
	</div></div>
</div>
<script src="<?php echo ROOTHOST;?>js/checkbox_l8.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".nhan_hoso").click(function(){
		var ma = $(this).attr('data_ma');
		var tinhtrang_hs = $(this).attr('data_tinhtrang');
		var data = $(this).attr('data');
		if(ma == "") {
			if(confirm("Chưa có mã hồ sơ. Bạn có chắc chắn muốn nhận hồ sơ này?")){
				getContactL8(data);
			}
			return;
		}else if(tinhtrang_hs == "thieu") {
			if(confirm("Tình trạng hồ sơ đang thiếu. Bạn có chắc chắn muốn nhận hồ sơ này?")){
				getContactL8(data);
			}
			return;
		}else getContactL8(data);
		return;
	})
	$("#ImportContactL8").click(function(){
		if($('#hoso_ids').val()=="") {
			showMess('Vui lòng chọn hồ sơ cần nhập');
		}else{
			$("#frm_import").submit();
		}
	})
})

function getContactL8(data){
	var url = "<?php echo ROOTHOST;?>ajaxs/contact/get_contact_l8.php";
	$.post(url,{'data': data},function(req){
		
	})
}
</script>