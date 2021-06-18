<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa=''; $MONHOC = array(); $obj = new CLS_MYSQL();
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

//---- Lấy danh sách môn học ---------
$url='http://uid.aumsys.net/api/edu/monhoc';
$json = array();
$json['key'] = PIT_API_KEY;
$json['id'] = '';

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$MONHOC = isset($res_data['data']) ? $res_data['data'] : array();

//---------------------------------------
$id_lop = isset($_GET['id'])?addslashes(strip_tags($_GET['id'])):'';
$res_lop = SysGetList('tbl_lop', array(), "AND id='".$id_lop."'");
$row_lop = $res_lop[0];
$id_he = $row_lop['id_he'];
$id_khoa = $row_lop['id_khoa'];
$id_nganh = $row_lop['id_nganh'];
$sohocky = $id_he!=='' ? $HE[$id_he]['sohocky'] : 0;

$sql="SELECT * FROM tbl_chuongtrinhhoc WHERE id_lop='$id_lop' ORDER BY `start_date` ASC";
$obj->Query($sql);
$arrCTH = array();
while($r=$obj->Fetch_Assoc()){
	$arrCTH[$r['id']] = $r;
}

/* ---------------------------------------------------- */
$str_id_hpk = $str_id_cth = '';
/* Get id_monhoc từ học phần khung theo mã ngành, mã hệ */
$res_hpk = SysGetList('tbl_hocphan_khung', array('id_monhoc'), "AND id_nganh='".$id_nganh."' AND id_he='".$id_he."'");
if(count($res_hpk)>0){
	foreach ($res_hpk as $key => $value) {
		$str_id_hpk.= "'".$value['id_monhoc']."',";
	}
}

/* Get id_monhoc từ chương trình học theo mã lớp */
$res_cth = SysGetList('tbl_chuongtrinhhoc', array('id_monhoc'), "AND id_lop='".$id_lop."'");
if(count($res_cth)>0){
	foreach ($res_cth as $key => $value) {
		$str_id_cth.= "'".$value['id_monhoc']."',";
	}
}

$str_id_hpk = strlen($str_id_hpk)>0 ? substr($str_id_hpk, 0, strlen($str_id_hpk)-1) : '';
$str_id_cth = strlen($str_id_cth)>0 ? substr($str_id_cth, 0, strlen($str_id_cth)-1) : '';

/* Get all môn học với id "in" id_monhoc của học phần khung và "not in" id_monhoc của chương trình học */
$arrMonhoc = array();
if($str_id_hpk !== ''){
	$sql="SELECT * FROM tbl_monhoc WHERE id IN (".$str_id_hpk.")";
	if($str_id_cth!=="") $sql.=" AND id NOT IN (".$str_id_cth.")";
	$obj->Query($sql);
	while($row_mh = $obj->Fetch_Assoc()){
		if(!isset($arrCTH[$row_mh['id']])){
			$arrMonhoc[$row_mh['id']] = $row_mh;
		}
	}
}

/* Tổng số học viên */
$siso = SysCount('tbl_dangky_tuyensinh', "AND malop='$id_lop'");
$last_hk = $last_slost = $last_tinchi = 0;
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý lớp</div>
			</div>
		</div>
	</div>

	<div class="search_box panel panel-warning">
		<div class="panel-body">
			<div class="media row">
				<div class="form-group">
					<div class='col-md-6'>Lớp: <label><?php echo $id_lop;?></label></div>
					<div class='col-md-6'>Ngành: <label><?php echo $NGANH[$id_nganh]['name'];?></label></div>
					<div class='col-md-6'>Bậc: <label><?php echo $id_he!=='' ? $HE[$id_he]['name'] : '';?></label></div>
					<div class='col-md-6'>Khóa học: <label><?php echo $id_khoa!=='' ? $KHOA[$id_khoa]['name'] : '';?></label></div>
					<div class='col-md-6'>Sĩ số: <label><?php echo number_format($siso);?></label></div>
				</div>
			</div>
		</div>
	</div>

	<h3 class='text-center'>Lịch học thực tế</h3>
	<table class="table table-striped table-bordered">
		<thead>
			<tr class="">
				<th class="text-center">STT</th>
				<th class="text-center">Học phần</th>
				<th class="text-center">Học kỳ</th>
				<th class="text-center">Slot</th>
				<th class="text-center">Tín chỉ</th>
				<th class="text-center">Ngày bắt đầu</th>
				<th class="text-center"></th>
				<th class="text-center"></th>
			</tr>
			<tr>
				<th class="text-center">#</th>
				<th>
					<select id='cbo_add_monhoc' class='form-control'>
						<?php 
						if(count($arrMonhoc)>0){
							foreach($arrMonhoc as $key =>$val){
								echo "<option value='$key'>".$val['name']."</option>";
							}
						}?>
					</select>
				</th>
				<th class="text-center">
					<select id='txthocky' class='form-control'>
						<option value="0"></option>
						<?php for($i=1;$i<=$sohocky;$i++){
							echo "<option value='$i'>Học kỳ $i</option>";
						}?>
					</select>
				</th>
				<th class="text-center">
					<select id='txtslot' class='form-control'>
						<option value="0"></option>
						<?php for($i=1;$i<=24;$i++){
							echo "<option value='$i'>Slot $i</option>";
						}?>
					</select>
				</th>
				<th class="text-center" width='100'>
					<input type='number' size=4 id='txt_tinchi' class='form-control text-center' value="3" max=6 min=1/>
				</th>
				<th class="text-center"><input type="date" id="start_date" name="start_date" class="form-control"></th>
				<th class="text-center"></th>
				<th class="text-center">
					<button type='button' id='btn_add_hp' class='btn btn-primary'>Thêm học phần</button>
				</th>
			</tr>
		</thead>
		<tbody id="datatable-cth">
			<?php $i=1; $count_cth = count($arrCTH);
			foreach($arrCTH as $key => $r){
				if($i == $count_cth){
					$last_slost = $r['slot'];
					$last_hk = $r['hocky'];
					$last_tinchi = $r['tinchi'];
				}
				$start_date = (int)$r['start_date'] > 0 ? date('m/d/Y', $r['start_date']) : '';
				?>
				<tr dataid="<?php echo $r['id'];?>">
					<td align="center"><?php echo $i;?></td>
					<td><?php echo stripslashes($MONHOC[$r['id_monhoc']]['name']);?></td>
					<td class="text-center"><?php echo $r['hocky']!=='0' ? $r['hocky'] : '';?></td>
					<td class="text-center"><?php echo $r['slot']!=='0' ? $r['slot'] : '';?></td>
					<td class="text-center"><?php echo $r['tinchi'];?></td>
					<td class="text-center"><?php echo $start_date;?></td>
					<td align="center"><a href="<?php echo ROOTHOST.'?com=student&task=qlhoctap&mamon='.$r['id_monhoc'].'&malop='.$id_lop;?>" target="_blank">Ql học tập</a></td>
					<td class="text-center"><a href='javascript:void(0);' class='cmd_del_hp' dataid='<?php echo $r['id'];?>' datalop='<?php echo $r['id_lop'];?>' datamon='<?php echo $r['id_monhoc'];?>'>Xóa</a></td>
				</tr>
				<?php $i++;
			} ?>
		</tbody>
	</table>
</div>
<script>
	$(document).ready(function(){
		selected_last_HK('<?php echo $last_hk;?>');
		selected_last_slost('<?php echo $last_slost;?>');
		selected_last_tinchi('<?php echo $last_tinchi;?>');

		$('#cbo_add_monhoc, #txthocky, #txtslot').select2();

		$("#btn_add_hp").click(function(){
			if(confirm('Thêm học phần')){
				showLoading();
				var flag=true;
				var mon = $('#cbo_add_monhoc option:selected').val();
				var hk = $("#txthocky option:selected").val();
				var slot = $("#txtslot option:selected").val();
				var tc = $("#txt_tinchi").val();
				var start_date = $("#start_date").val();

				if(tc=="" || tc==undefined) {
					$("#txt_tinchi").focus(); 
					alert('Nhập số tín chỉ'); 
					flag=false;
				}
				if(mon=="" || mon==undefined) {
					$("#cbo_add_monhoc").focus();
					alert('Chọn học phần!'); 
					flag=false;
				}
				if(hk=="" || hk==undefined) {
					$("#txthocky").focus(); 
					alert('Nhập học kỳ'); 
					flag=false;
				}
				if(start_date=="" || start_date==undefined) {
					$("#start_date").addClass('error'); 
					$("#start_date").focus(); 
					alert('Nhập ngày bắt đầu học học phần'); 
					flag=false;
				}else{
					$("#start_date").removeClass('error'); 
				}
				if(flag==true){
					var _url = "<?php echo ROOTHOST;?>ajaxs/lop/process_add_hp.php";
					var _data = {
						'he':'<?php echo $id_he;?>',
						'nganh':'<?php echo $id_nganh;?>',
						'lop':'<?php echo $id_lop;?>',
						'mon':mon,
						'hk':hk,
						'slot':slot,
						'tc':tc,
						'start_date': start_date
					};
					$.post(_url, _data, function(req){
						hideLoading();
						if(req=="nodata") alert("Vui lòng nhập dữ liệu");
						else {
							window.location.reload();
						}
					})
				}
				hideLoading();
			}
		});

		$(".cmd_del_hp").click(function(){
			if(confirm("Bạn có chắc muốn xóa học phần này không?")){
				showLoading();
				var id = $(this).attr('dataid');
				var lop = $(this).attr('datalop');
				var mon = $(this).attr('datamon');
				var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_del_hp.php";
				$.post(url,{'id':id,'lop':lop,'mon':mon},function(req){
					console.log(req);
					hideLoading();
					if(req=="empty") alert("Dữ liệu trống.");
					if(req=="notdel") alert("Chương trình học này không được phép xóa.");
					else {
						window.location.reload();
					}
				})
			}
		})
	});

	function selected_last_HK(num){
		$('#txthocky').val(num);
	}
	
	function selected_last_slost(num){
		$('#txtslot').val(num);
	}

	function selected_last_tinchi(num){
		$('#txt_tinchi').val(num);
	}
</script>