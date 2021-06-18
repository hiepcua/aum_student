<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa=''; $obj = new CLS_MYSQL;
$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$DKTS = $HOCTAP = array();
//---------------------------------------
$KHOA = array();
$json_khoa = file_get_contents(DOCUMENT_ROOT.'jsons/khoa.json');
$arr_khoa = json_decode($json_khoa, true);
foreach ($arr_khoa as $key => $value) {
	$KHOA[$value['id']] = $value;
}

//---------------------------------------
$HE = array();
$json_he = file_get_contents(DOCUMENT_ROOT.'jsons/he.json');
$arr_he = json_decode($json_he, true);
foreach ($arr_he as $key => $value) {
	$HE[$value['id']] = $value;
}

//---------------------------------------
$NGANH = array();
$json_nganh = file_get_contents(DOCUMENT_ROOT.'jsons/nganh.json');
$arr_nganh = json_decode($json_nganh, true);
foreach ($arr_nganh as $key => $value) {
	$NGANH[$value['id']] = $value;
}

//---------------------------------------
$DKTS_LOP = array();
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array());
if(count($res_dkts)>0){
	foreach ($res_dkts as $key => $value) {
		$DKTS_LOP[$value["malop"]][] = $value;
	}
}

//---------------------------------------
$strWhere='';
if($khoa!='') $strWhere.=" AND id_khoa='$khoa'";
if($he!='') $strWhere.=" AND id_he='$he'";
if($nganh!='') $strWhere.=" AND id_nganh='$nganh'";

$sql="SELECT count(*) as num FROM tbl_lop WHERE 1=1 $strWhere";
$obj->Query($sql);
$r=$obj->Fetch_Assoc();

$total_rows=$r['num']+1;
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = postCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$limit = ' LIMIT '.$start.','. MAX_ROWS;

$sql="SELECT * FROM tbl_lop WHERE 1=1 $strWhere ORDER BY cdate DESC";
$obj->Query($sql.$limit);
$arr_lop = array(); $str_lop = '';
while($r = $obj->Fetch_Assoc()) {
	$lop = $r['id'];
	$r['siso']=0;
	$arr_lop["$lop"]=$r;
	$str_lop .= $lop."','";
} 

// tổng số học sinh
if($str_lop!='') {
	$str_lop = substr($str_lop,0,-3);
	$sql = "select count(id) as total,malop FROM tbl_dangky_tuyensinh 
	WHERE malop IN ('$str_lop')
	group by malop";
	$obj->Query($sql);
	while($r=$obj->Fetch_Assoc()){
		$malop = $r['malop'];
		if(isset($arr_lop["$malop"])) $arr_lop["$malop"]['siso'] = $r['total'];
	}
}

foreach ($arr_lop as $key => $value) {
	$arr_lop[$key]['S00'] = isset($arr_lop[$key]['S00']) ? $arr_lop[$key]['S00'] : 0;
	$arr_lop[$key]['S01'] = isset($arr_lop[$key]['S01']) ? $arr_lop[$key]['S01'] : 0;
	$arr_lop[$key]['S02A'] = isset($arr_lop[$key]['S02A']) ? $arr_lop[$key]['S02A'] : 0;
	$arr_lop[$key]['S02B'] = isset($arr_lop[$key]['S02B']) ? $arr_lop[$key]['S02B'] : 0;
	$arr_lop[$key]['S02C'] = isset($arr_lop[$key]['S02C']) ? $arr_lop[$key]['S02C'] : 0;
	$arr_lop[$key]['S03A'] = isset($arr_lop[$key]['S03A']) ? $arr_lop[$key]['S03A'] : 0;
	$arr_lop[$key]['S03B'] = isset($arr_lop[$key]['S03B']) ? $arr_lop[$key]['S03B'] : 0;
	$arr_lop[$key]['S03C'] = isset($arr_lop[$key]['S03C']) ? $arr_lop[$key]['S03C'] : 0;
	$arr_lop[$key]['S04A'] = isset($arr_lop[$key]['S04A']) ? $arr_lop[$key]['S04A'] : 0;
	$arr_lop[$key]['S04B'] = isset($arr_lop[$key]['S04B']) ? $arr_lop[$key]['S04B'] : 0;

	if(isset($DKTS_LOP[$key])){
		foreach ($DKTS_LOP[$key] as $k => $v) {
			$status_sv = $v['tinhtrang_sv'];
			switch ($status_sv) {
				case 'S01':
				$arr_lop[$key]['S01'] = $arr_lop[$key]['S01'] + 1;
				break;
				case 'S02A':
				$arr_lop[$key]['S02A'] = $arr_lop[$key]['S02A'] + 1;
				break;
				case 'S02B':
				$arr_lop[$key]['S02B'] = $arr_lop[$key]['S02B'] + 1;
				break;
				case 'S02C':
				$arr_lop[$key]['S02C'] = $arr_lop[$key]['S02C'] + 1;
				break;
				case 'S03A':
				$arr_lop[$key]['S03A'] = $arr_lop[$key]['S03A'] + 1;
				break;
				case 'S03B':
				$arr_lop[$key]['S03B'] = $arr_lop[$key]['S03B'] + 1;
				break;
				case 'S03C':
				$arr_lop[$key]['S03C'] = $arr_lop[$key]['S03C'] + 1;
				break;
				case 'S04A':
				$arr_lop[$key]['S04A'] = $arr_lop[$key]['S04A'] + 1;
				break;
				case 'S04B':
				$arr_lop[$key]['S04B'] = $arr_lop[$key]['S04B'] + 1;
				break;
				default:
				$arr_lop[$key]['S00'] = $arr_lop[$key]['S00'] + 1;
				break;
			}
		}
	}
}
?>
<style type="text/css">
.wr-status .el {
	width: 120px;
	display: inline-block;
	text-align: left;
}
</style>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý lớp</div>
			</div>
			<div class="box-function pull-right">
				<button type="button" class="btn btn-primary" id="btn_add"><i class="fa fa-plus"></i> Thêm mới</button>
			</div>
		</div>
	</div>

	<table class="table table-striped table-bordered">
		<thead>
			<tr class="header">
				<th class="text-center">STT</th>
				<th class="text-center">Mã Lớp</th>
				<th class="text-center">Lịch học</th>
				<th class="text-center">Ngành</th>
				<th class="text-center">Khóa</th>
				<th class="text-center">Sĩ số</th>
				<th class="text-center">Trạng thái SV</th>
				<th class="text-center">Ngày mở lớp</th>
				<th class="text-center">Chi tiết</th>
				<th class="text-center">Tác vụ</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;
			foreach($arr_lop as $r){
				$siso=0+$r['siso'];
				$ma_he = $r['id_he'];
				$ma_khoa = $r['id_khoa'];
				$ma_nganh = $r['id_nganh'];
				$ma_lop = $r['id'];

				$name_he = isset($HE[$ma_he]) ? $HE[$ma_he]['name'] : "";
				$name_nganh = isset($NGANH[$r['id_nganh']]) ? $NGANH[$r['id_nganh']]['name'] : "";
				if(isset($KHOA[$ma_khoa])){
					$name_khoa = isset($KHOA[$ma_khoa]) ? $KHOA[$ma_khoa]['name'] : "";
				}else{
					$name_khoa = '<a href="javascript:void(0)" title="Chọn khóa" data-lop="'.$ma_lop.'" data-khoa="'.$ma_khoa.'" onclick="select_khoa(this)" class="btn btn-primary">Chọn khóa</a>';
				}
				?>
				<tr dataid="<?php echo $r['id'];?>">
					<td align="center"><?php echo $i;?></td>
					<td align="center"><?php echo stripslashes($r['id']);?></td>
					<td align="center" dataid="<?php echo $r['id'];?>">
						<a class="btn btn-info" href="<?php echo ROOTHOST;?>?com=student&task=chitiet_lop&id=<?php echo $r['id'];?>">
						Lịch học</a>
					</td>
					<td align="center"><?php echo $name_nganh;?></td>
					<td align="center"><?php echo $name_khoa;?></td>
					<td align="center"><?php echo $siso;?></td>
					<td align="center" style="max-width: 300px;">
						<div class="wr-status">
							<?php
							echo '<div class="el"><span class="txt">Chưa học: </span> <strong class="number">'.$r["S00"].'</strong></div>';
							foreach ($STATUS_SV as $key => $value) {
								$number = isset($r[$key]) ? $r[$key] : "";
								echo '<div class="el"><span class="txt">'.$value.': </span> <strong class="number">'.$number.'</strong></div>';
							}
							?>
						</div>
					</td>
					<td align="center"><?php echo date('d/m/Y',$r['opendate']);?></td>
					<td align="center">
						<a class="btn btn-success" href="<?php echo ROOTHOST;?>hsdaotao?he=<?= $r['id_he']?>&nganh=<?= $r['id_nganh']?>&malop=<?= $r['id']?>">
						Danh sách lớp</a>
					</td>
					<td align="center">
						<a href="javascript:void(0)" class="btn_delete" dataid='<?php echo $r['id'];?>' datass='<?php echo $siso;?>' title="Xóa lớp"><i class='fa fa-trash cgray' aria-hidden='true'></i></a>
					</td>
				</tr>
				<?php $i++;
			} ?>
		</tbody>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr><td align="center">
			<?php  paging_index($total_rows,MAX_ROWS,$cur_page); ?>
		</td></tr>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_add").click(function(){
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_add.php";
			$.post(url,function(req) {
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-title').html('Phân lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});

		$(".btn_delete").click(function(){
			var id = $(this).attr('dataid');
			var siso = parseInt($(this).attr('datass'));
			if(siso > 0) alert('Lớp đã có dữ liệu, vui lòng không xóa.');
			else {
				if(confirm("Bạn có chắc muốn xóa lớp?")){
					var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_delete.php";
					$.post(url,{'id':id},function(req) {
						if(req=="success"){
							showMess("Đã xóa lớp thành công.");
							setTimeout(function(){window.location.reload();},3000);
						}else if(req=="notdel") {
							showMess("Lớp đã có dữ liệu, không được phép xóa.");
							setTimeout(function(){window.location.reload();},3000);
						}
					})
				}
			}
		});
	});

	function select_khoa(e){
		var _id_lop = e.getAttribute('data-lop');
		var _cur_khoa = e.getAttribute('data-khoa');

		if(_id_lop.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/lop/frm_select_khoa.php';
			var _data = {
				'ma_lop' : _id_lop,
				'ma_khoa' : _cur_khoa,
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Chọn khóa cho lớp');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}
</script>