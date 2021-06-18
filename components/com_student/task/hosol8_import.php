<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_POST['hoso_ids'])) {
	die("<div>Vui lòng chọn hồ sơ cần nhập. <a href='".ROOTHOST."student/hosol8' class='btn btn-primary'>Quay lại Contact L8</a></div>");
}
$hoso_ids = antiData($_POST['hoso_ids']);

// Get danh sách giáo vụ thuộc phòng ban
$json = array();
$json['key'] 	= PIT_API_KEY;
$json['g_code'] = 'G04';
$jsondata = encrypt(json_encode($json,JSON_UNESCAPED_UNICODE),PIT_API_KEY);
$api_staff= Curl_Post(API_STAFF,json_encode(array('data'=>$jsondata)));
if(count($api_staff['data']) == 0) die ("<div>Chưa có giáo vụ.</div>");

$opt_gv = "";
foreach ($api_staff['data'] as $k=>$v) {
	$opt_gv .= "<option value='".$v['username']."'>".$v['fullname']."</option>";
}

/* ------------------------- get contact data ----------------------------*/
$contact_data = file_get_contents('jsons/contact_data.json');
$arr_hsL8 = json_decode($contact_data, true);

$list_lop = array();
foreach ($arr_hsL8 as $r) {
	$malop = $r['malop'];
	$masv  = $r['masv'];
	$list_lop[$malop]['masv'][] 	= $masv;
	$list_lop[$malop]['id_nganh'] 	= $r['id_nganh_dang_ky'];
	$list_lop[$malop]['id_he'] 		= $r['id_he_dao_tao'];
} 
// get ngành
$arr_nganh=(array) json_decode(file_get_contents('jsons/nganh.json'),true);
?>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Contact L8 > Bước 2: Chọn giáo vụ cho lớp</div>
			</div>
		</div>
	</div>
	<div class="panel panel-warning"><div class="panel-body">
		<div class="table-responsive">
			<form name="frmAddL8" id="frmAddL8" action="<?php echo ROOTHOST;?>student/save_hosol8" method="POST" >
				<table class="table table-striped table-bordered">
					<thead><tr class="header">
						<th class="text-center">STT</th>
						<th class="text-center">Ngành</th>
						<th class="text-center">Mã lớp</th>
						<th class="text-center">Số hồ sơ</th>
						<th class="text-center">Chọn giáo vụ</th>
					</thead>
					<tbody>
						<?php $stt = 0; foreach($list_lop as $k=>$v) {  $stt++;?>
						<tr>
							<td><?php echo $stt;?></td>
							<td><?php echo $arr_nganh[$v['id_nganh']]['name'];?></td>
							<td><?php echo $k;?></td>
							<td><?php echo count($v['masv']);?></td>
							<td>
								<select name='opt_gv' class='form-control opt_gv' dataid='<?php echo $k;?>'>
									<option value=''>-- Chọn giáo vụ cho lớp</option>
									<?php echo $opt_gv;?>
								</select>
								<input type="hidden" name="lop_nganh[]" class="lop_nganh" value="<?php echo $v['id_nganh'];?>"/>
								<input type="hidden" name="lop_gv[]" class="lop_gv" value="" dataid='<?php echo $k;?>'/>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="text-center">
					<input type="hidden" name="hoso_ids" value="<?php echo $hoso_ids;?>"/>
					<button type="button" class="btn btn-success" id="save_l8"><i class='fa fa-save'></i> Hoàn thành</button>
				</div>
			</form>
		</div>
	</div></div>
</div>
<script>
	$('.opt_gv').change(function(){
		var gv = $(this).find('option:selected').val();
		var lop = $(this).attr('dataid');
		$(this).parent().find(".lop_gv").val(lop+'|'+gv);
	})

	$("#save_l8").click(function(){
		var flag = true;
		$('.opt_gv').each(function(){
			if($(this).find('option:selected').val() == "") {
				flag = false;
				$(this).addClass('error');
			} else {
				$(this).removeClass('error');
			}
		})
		if(flag == false) 
			showMess("Vui lòng chọn giáo vụ quản lý cho tất cả các lớp hiện có.","error");
		else $("#frmAddL8").submit();
	})
</script>