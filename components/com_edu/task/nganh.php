<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
//---------------------------------------
$NGANH = array();
$json_nganh = file_get_contents(DOCUMENT_ROOT.'jsons/nganh.json');
$arr_nganh = json_decode($json_nganh, true);
foreach ($arr_nganh as $key => $value) {
	$NGANH[$value['id']] = $value;
}
$arr_data = $NGANH;

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
<div class="page-bar">
	<div class="page-title-breadcrumb">
		<div class="pull-left">
			<div class="page-title">Ngành đào tạo</div>
		</div>
	</div>
</div>
<div class="clearfix">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="edu">
				<input type="hidden" class="form-control" name="task" id="task" value="nganh">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Mã, tên ngành" value="<?php echo $get_q;?>">
			</div></div>
			<div class="col-md-1">
				<button type="submit" class="btn btn-primary" name="cmdsearch" id="cmdsearch"><i class="fa fa-search"></i> Tìm</button>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-primary" name="filterDebt" onclick="dongbo_nganh()"><i class="fa fa-refresh" aria-hidden="true"></i> Đồng bộ</button>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="row">
			<table class="table table-bordered">
				<thead><tr>
					<th width='30'>STT</th>
					<th>Tên ngành</th>
					<th>Mã Ngành QL</th>
					<th>Mã Ngành của Bộ</th>
				</tr></thead>
				<tbody>
					<?php 
					$stt=0;
					foreach ($arr_data as $key => $value) {
						$stt = $stt + 1;
						echo '<tr>
						<td class="text-center">'.$stt.'</td>
						<td>'.$value['name'].'</td>
						<td>'.$value['id'].'</td>
						<td>'.$value['id_bo'].'</td>
						</tr>';
					}?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	function dongbo_nganh(){
		if(confirm("Đồng bộ lại dữ liệu.")){
			var _url = "<?php echo ROOTHOST;?>ajaxs/dmnganh/dongbo_nganh.php";
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