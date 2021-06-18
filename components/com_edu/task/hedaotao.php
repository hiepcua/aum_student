<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
//---------------------------------------
$HE = array();
$json_he = file_get_contents(DOCUMENT_ROOT.'jsons/he.json');
$arr_he = json_decode($json_he, true);
foreach ($arr_he as $key => $value) {
	$HE[$value['id']] = $value;
}
$arr_data = $HE;

//---------------------------------------
$get_q = isset($_GET['q']) ? antiData($_GET['q']):'';
if($get_q!=''){
	$new_array = array();
	foreach ($arr_data as $key => $value) {
		$position = stripos($value['name'], $get_q);
		if(strcasecmp($value['id'], $get_q) == 0 || $position!==false){
			$new_array[] = $value;
		}
	}
	$arr_data = $new_array;
}
?>
<div class='page-title'>BẬC ĐÀO TẠO</div>
<div class="container-fluid">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="edu">
				<input type="hidden" class="form-control" name="task" id="task" value="hedaotao">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Mã, tên bậc đào tạo" value="<?php echo $get_q;?>">
			</div></div>
			<div class="col-md-1">
				<button type="submit" class="btn btn-primary" name="cmdsearch" id="cmdsearch"><i class="fa fa-search"></i> Tìm</button>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-primary" name="filterDebt" onclick="dongbo_he()"><i class="fa fa-refresh" aria-hidden="true"></i> Đồng bộ</button>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="row">
			<table class="table table-bordered">
				<thead><tr>
					<th width='30'>STT</th>
					<th>Tên hệ</th>
				</tr></thead>
				<tbody>
					<?php 
					$stt=0;
					foreach ($arr_data as $key => $r) {
						$stt = $stt + 1;
						?>
						<tr>
							<td align="center"><?php echo $stt;?></td>
							<td><?php echo stripslashes($r['name']);?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	function dongbo_he(){
		if(confirm("Đồng bộ lại dữ liệu.")){
			var _url = "<?php echo ROOTHOST;?>ajaxs/he/dongbo_he.php";
			$.post(_url, function(res){
				if(res == "success") {
					showMess("Đồng bộ thành công.");
					setTimeout(function(){ 
						location.reload();
					}, 2000);
				} else if(res == "E01") {
					showMess("Lỗi! Không có thông tin đăng nhập.","error");
				} else if(res == "error")
				showMess("Xảy ra lỗi.","error");
			})
		}
	}
</script>