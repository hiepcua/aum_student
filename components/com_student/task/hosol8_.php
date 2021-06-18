<?php
defined('ISHOME') or die("You can't access this page!");
$ma=isset($_GET['ma']) ? antiData($_GET['ma']) : '';
$ten=isset($_GET['ten']) ? antiData($_GET['ten']) : '';
$phone=isset($_GET['phone']) ? antiData($_GET['phone']) : '';
$email=isset($_GET['email']) ? antiData($_GET['email']) : '';
$cur_page=isset($_GET['page']) ? antiData($_GET['page'], 'int') : 1;

/* ------------------------- API get data ----------------------------*/
$api_data = Curl_Get(ROOTHOST.'test2.php');
$arr_hsL8 = $api_data;
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

if($ma!='') $arr_hsL8 = searchArray($arr_hsL8, 'ma_hoso', $ma);
if($ten!='') $arr_hsL8 = searchArray($arr_hsL8, 'hovaten', $ten);
if($phone!='') $arr_hsL8 = searchArray($arr_hsL8, 'dienthoai', $phone);
if($email!='') $arr_hsL8 = searchArray($arr_hsL8, 'email', $email);

$total_rows=count($arr_hsL8);
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$offset = $start + MAX_ROWS;
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
				<th>Họ tên</th>
				<th class="text-center">Điện thoại</th>
				<th>Email</th>
				<th>Ngành đăng ký</th>
				<th>Hệ đào tạo</th>
				<th>Ngày bàn giao</th>
				<th>Tình trạng BG</th>
				<th>Tình trạng hồ sơ</th>
			</tr></thead>
			<tbody id="datatable-hoso">
				<?php
				if(count($arr_hsL8)>0){
					for ($i = $start; $i < $offset; $i++) {
						if(isset($arr_hsL8[$i]) && count($arr_hsL8[$i])>0){
							$stt = $i+1;
							$value = $arr_hsL8[$i];
							$ma_hoso = $value['ma_hoso'];
							$hovaten = $value['hovaten'];
							$dienthoai = $value['dienthoai'];
							$email = $value['email'];
							$link = ROOTHOST.'student/hosol8/'.$ma_hoso;
							$nganhdangky = $value['nganhdangky'];
							$hedaotao = $value['hedaotao'];
							$ngayBG = $value['ngayBG']!=='' ? date('Y-m-d', $value['ngayBG']) : '';
							$tinhtrangBG = $value['tinhtrangBG'];
							$lydoBG = $value['lydoBG'];
							$hs_tinhtrang = $value['hs_tinhtrang'];
							$hs_vo = $value['hs_vo'];
							$hs_anh = $value['hs_anh'];
							$hs_bang = $value['hs_bang'];
							$hs_cn_totnghiep = $value['hs_cn_totnghiep'];
							$hs_cmt = $value['hs_cmt'];
							$hs_mota = $value['hs_mota'];
							$hs_syll = $value['hs_syll'];
							$hs_khac = $value['hs_khac'];

							echo '<tr dataid="'.$ma_hoso.'">';
							echo '<td align="center">'.$stt.'</td>';
							echo '<td align="center"><a href="'.$link.'" title="'.$ma_hoso.'">'.$ma_hoso.'</a></td>';
							echo '<td><a href="'.$link.'" title="'.$ma_hoso.'">'.$hovaten.'</a></td>';
							echo '<td align="center">'.$dienthoai.'</td>';
							echo '<td>'.$email.'</td>';
							echo '<td>'.$nganhdangky.'</td>';
							echo '<td>'.$hedaotao.'</td>';
							echo '<td>'.$ngayBG.'</td>';
							echo '<td>'.$tinhtrangBG.'</td>';
							echo '<td>'.$hs_tinhtrang.'</td>';
							echo '</tr>';
						}
					}
				}
				?>
			</tbody>
		</table>
	</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr>
			<td align="center"><?php paging($total_rows,MAX_ROWS,$cur_page); ?></td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	function get_hosoL8(){
		var _url = '<?php echo ROOTHOST;?>api/get-hosol8';
		$.get(_url, function(res){
			$('#datatable-hoso').html(res);
		})
	}
</script>