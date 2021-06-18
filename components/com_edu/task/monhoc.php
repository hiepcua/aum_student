<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
//---------------------------------------
$MONHOC = $arr_data = array();
$json_monhoc = file_get_contents(DOCUMENT_ROOT.'jsons/monhoc.json');
$arr_monhoc = json_decode($json_monhoc, true);
if(is_array($arr_monhoc) && count($arr_monhoc)>0){
	$arr_data = $arr_monhoc;
}

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

$total_rows = count($arr_data);
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = getCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$end = $start + MAX_ROWS;
?>
<div class='page-title'>Danh mục môn học</div>
<div class="container-fluid">
	<div class="form-group">
		<form id="frm_search" name="frm_search" method="get" action="">
			<div class="col-md-4"><div class="row">
				<input type="hidden" class="form-control" name="com" id="com" value="edu">
				<input type="hidden" class="form-control" name="task" id="task" value="monhoc">
				<input type="text" class="form-control" name="q" id="txt_q" placeholder="Mã, tên môn học" value="<?php echo $get_q;?>">
			</div></div>
			<div class="col-md-1">
				<button type="submit" class="btn btn-primary" name="cmdsearch" id="cmdsearch"><i class="fa fa-search"></i> Tìm</button>
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-primary" name="filterDebt" onclick="dongbo_monhoc()"><i class="fa fa-refresh" aria-hidden="true"></i> Đồng bộ</button>
			</div>
		</form>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="row">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width='30'>STT</th>
						<th>Mã môn học</th>
						<th>Tên môn học</th>
						<th class='text-center'><span title='Thi tốt nghiệp'>TTN</span></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(is_array($arr_data) && count($arr_data)>0){
						$stt = $start;
						$i=0;
						foreach ($arr_data as $key => $value) {
							$i = $i+1;
							if($i >= $start && $i <= $end){
								$ttn = $value['ttn']==1 ? "Yes":"";
								echo '<tr>
								<td class="text-center">'.$i.'</td>
								<td>'.$value['id'].'</td>
								<td>'.$value['name'].'</td>
								<td class="text-center">'.$ttn.'</td>
								</tr>';
							}
						}
					}?>
				</tbody>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
				<tr><td align="center">
					<?php paging_index($total_rows,MAX_ROWS,$cur_page); ?>
				</td></tr>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	function dongbo_monhoc(){
		if(confirm("Đồng bộ lại dữ liệu.")){
			var _url = "<?php echo ROOTHOST;?>ajaxs/monhoc/dongbo_monhoc.php";
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