<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$id_daotao = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$res_hpkhung = SysGetList('tbl_hocphan_khung', array(), "AND id='".$id_daotao."'");
if(count($res_hpkhung) <= 0) die('Bản ghi không tồn tại');
else{
	$rhp = $res_hpkhung[0];
	$nganh = $rhp['id_nganh'];
	$he = $rhp['id_he'];
	$monhoc = $rhp['id_monhoc'];

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
	?>
	<form id="frm_khungdaotao" method="post" action="">
		<input type='hidden' id='txtid' name="txtid" value='<?php echo $id_daotao;?>'/>
		<div class="row form-group">
			<div class="col-md-3 col-xs-3 text"><label>Ngành đào tạo</label></div>
			<div class="col-md-6 col-xs-9">
				<select id='dm_nganh' name='nganh' class='form-control required'>
					<option value="">Chọn ngành</option>
					<?php
					if(count($NGANH)>0){
						foreach ($NGANH as $key => $value) {
							$id = stripslashes($value['id']);
							$name = stripslashes($value['name']);
							$select = $nganh == $id ? "selected=true" : '';
							echo "<option $select value='$id'>$name</option>";
						}
					}
					?>
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-3 col-xs-3 text"><label>Bậc đào tạo</label></div>
			<div class="col-md-6 col-xs-9">
				<select id='dm_he' name='he' class='form-control'>
					<option value="">Chọn bậc đào tạo</option>
					<?php 
					if(count($HE)>0){
						foreach ($HE as $key => $value) {
							$id = stripslashes($value['id']);
							$name = stripslashes($value['name']);
							$select = $he == $id ? "selected=true" : '';
							echo "<option $select value='$id'>$name</option>";
						}
					}
					?>
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-6 col-xs-6">
				<label>Học phần:</label>
				<select id='cbo_monhoc' class="form-control" name='monhoc' style="width: 100%;">
					<option value=''>Chọn học phần</option>
				</select>
			</div>
			<div class="col-md-6 col-xs-6">
				<label>Tín chỉ:</label>
				<input type="number" name="txttinchi" id="txttinchi" class="form-control text-center" value="<?php echo $rhp['tinchi'];?>" required>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-6 col-xs-6">
				<label>Học kỳ:</label>
				<select id='cbo_hocky' name='hocky' class="form-control" style="width: 100%;">
					<option value='0'>Chọn học kỳ</option>
					<?php for($i=1; $i<=8; $i++){
						$select = $rhp['hocky'] == $i ? "selected=true" : '';
						echo "<option value='$i' ".$select.">Học kỳ $i</option>";
					}?>
				</select>
			</div>
			<div class="col-md-6 col-xs-6">
				<label>Slot:</label>
				<select id='cbo_slot' name='slot' class="form-control" style="width: 100%;">
					<option value='0'>Chọn slot</option>
					<?php for($i=1; $i<=24; $i++){
						$select = $rhp['slot'] == $i ? "selected=true" : '';
						echo "<option value='$i' ".$select.">Slot $i</option>";
					}?>
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-3 col-xs-3">
				<label>% Chuyên cần:</label>
				<input type="number" name="txtchuyencan" id="txtchuyencan" class="form-control text-center" value="<?php echo $rhp['diem_chuyencan'];?>" required>
			</div>
			<div class="col-md-3 col-xs-3">
				<label>% Kiểm tra:</label>
				<input type="number" name="txtkiemtra" id="txtkiemtra" class="form-control text-center" value="<?php echo $rhp['diem_kiemtra'];?>" required>
			</div>
			<div class="col-md-3 col-xs-3"><div class='row'>
				<label>% Thi:</label>
				<input type="number" name="txtthi" id="txtthi" class="form-control text-center" value="<?php echo $rhp['diem_thi'];?>" required>
			</div></div>
			<div class="col-md-3 col-xs-3">
				<label>Điểm đạt từ:</label>
				<input type="number" name="txttong" id="txttong" class="form-control text-center" value="<?php echo $rhp['total'];?>" required>
			</div>
		</div>

		<hr>
		<div class="wr-lotrinhkhung">
			<div class="box-tool clearfix">
				<label>Khung lộ trình chăm sóc môn:</label>
				<a href="javascript:void(0)" class="pull-right btn btn-primary" title="Thêm lộ trình" onclick="add_lotrinhkhung()"><i class="fa fa-plus"></i> Thêm lộ trình</a>
			</div>
			<div id="row-lotrinhkhung" class="row">
				<?php
				$arr_lotrinhkhung = strlen($rhp['lotrinh'])>0 ? json_decode($rhp['lotrinh'], true) : array();
				if(count($arr_lotrinhkhung) > 0){
					foreach ($arr_lotrinhkhung as $key => $value) {
						$tuan = (int)$value['tuan'];
						$noidung = $value['noidung'];

						echo '<div class="form-group lotrinhkhung">
						<div class="col-sm-3 col-md-2 col-left">
						<span>Tuần </span>
						<input type="number" value="'.$tuan.'" name="tuan[]" class="form-control week required" placeholder="Tuần nào">
						</div>
						<div class="col-sm-9 col-md-10"><input type="text" class="form-control noidung required" name="noidung[]" value="'.$noidung.'" placeholder="Nội dung..."></div>
						<a href="javascript:void(0)" title="Xóa lộ trình" class="btn-remove" onclick="remove_lotrinhkhung(this)"><i class="fa fa-times cred" aria-hidden="true"></i></a>
						</div>';
					}
				}
				?>
			</div>
		</div>

		<div class="row form-group text-center" style="margin-top: 20px;">
			<button type="button" name="btnsave" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i> Cập nhật học phần</button>
			<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
		</div>
		<div class="clearfix"></div>
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
			getCboHocphan();

			$('#cbo_slot, #cbo_hocky').select2();

			$('#dm_nganh').change(function(){
				getCboHocphan();
			});

			$('#dm_he').change(function(){
				var url = "<?php echo ROOTHOST;?>ajaxs/he/getSohocky.php";
				$.post(url,{'id':$(this).val()},function(req){
					$("#txthocky").html(req);
				})
				getCboHocphan();
			});

			$('#txttinchi').change(function(){
				$('#txtlythuyet').val($(this).val());
				$('#txtthuchanh').val(0);
			});

			$("#btnsave").click(function(){
				var nganh = $("#dm_nganh").val();
				var monhoc = $("#cbo_monhoc").val();
				var _data = $('#frm_khungdaotao').serialize();
				var _url = "ajaxs/khungdaotao/process_edit.php";

				if(check_input()==true) {
					$.post(_url, _data, function(req){
						if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
						else if(req=="success"){
							showMess("Sửa học phần thành công");
							setTimeout(function(){window.location.reload();},1000);
						}
					});
				}
			})
		});

		function getCboHocphan(){
			var url='<?php echo ROOTHOST;?>ajaxs/monhoc/getcboHocphan.php';
			var nganh=$('#dm_nganh').val();
			var he=$('#dm_he').val();
			$.get(url,{'nganh':nganh,'he':he,'monhoc':'<?php echo $monhoc;?>'},function(req){
				$('#cbo_monhoc').html(req);
			});
		};

		function check_input() {
			var flag = true;
			var tinchi = $("#txttinchi").val();
			var chuyencan = $("#txtchuyencan").val();
			var kiemtra = $("#txtkiemtra").val();
			var thi = $("#txtthi").val();
			var tong = $("#txttong").val();

			$('#frm_khungdaotao .required').each(function(){
				var val = $(this).val();
				if(!val || val=='' || val=='0') {
					$(this).parents('.form-group').addClass('error');
					flag = false;
				}else{
					$(this).parents('.form-group').removeClass('error');
				}
			});
			
			if(tinchi=="") {
				$("#txttinchi").focus();
				$("#txttinchi").addClass('novalid');
				return false;
			}else if($.isNumeric(tinchi)==false){
				alert("Số tín chỉ phải là kiểu số!");
				$("#txttinchi").focus(); 
				$("#txttinchi").addClass('novalid');
				return false;
			}else $("#txttinchi").removeClass('novalid');

			if(chuyencan=="") {
				$("#txtchuyencan").focus();
				$("#txtchuyencan").addClass('novalid');
				return false;
			}else if($.isNumeric(chuyencan)==false){
				alert("Chuyên cần phải là kiểu số!");
				$("#txtchuyencan").focus(); 
				$("#txtchuyencan").addClass('novalid');
				return false;
			}else $("#txtchuyencan").removeClass('novalid');

			if(kiemtra=="") {
				$("#txtkiemtra").focus();
				$("#txtkiemtra").addClass('novalid');
				return false;
			}else if($.isNumeric(kiemtra)==false){
				alert("Kiểm tra phải là kiểu số!");
				$("#txtkiemtra").focus(); 
				$("#txtkiemtra").addClass('novalid');
				return false;
			}else $("#txtkiemtra").removeClass('novalid');

			if(thi=="") {
				$("#txtthi").focus();
				$("#txtthi").addClass('novalid');
				return false;
			}else if($.isNumeric(thi)==false){
				alert("Thi phải là kiểu số!");
				$("#txtthi").focus(); 
				$("#txtthi").addClass('novalid');
				return false;
			}else $("#txtthi").removeClass('novalid');

			var rate = parseFloat(chuyencan)+parseFloat(kiemtra)+parseFloat(thi);
			if(rate!=100) {
				$("#txtchuyencan").addClass('novalid');
				$("#txtkiemtra").addClass('novalid');
				$("#txtthi").addClass('novalid');
				alert("% Chuyên cần + % Kiểm tra + % Thi phải bằng 100%");
				return false;
			}

			var so = parseFloat(tong);
			if(tong=="") {
				$("#txttong").focus();
				$("#txttong").addClass('novalid');
				return false;
			}else if($.isNumeric(tong)==false){
				alert("Điểm đạt phải là kiểu số");
				$("#txttong").focus(); 
				$("#txttong").addClass('novalid');
				return false;
			}else if(so>10 || so<0) {
				alert("Tổng đạt phải là kiểu số thang điểm 10!");
				$("#txttong").focus(); 
				$("#txttong").addClass('novalid');
				return false;
			}else $("#txttong").removeClass('novalid');

			return flag;
		};

		function add_lotrinhkhung(){
			var last_week = document.querySelectorAll(".lotrinhkhung:last-child .week");
			var number = 0;
			if(last_week.length > 0){
				number = parseInt(last_week[0].value);
			}
			number = number + 1;
			let div = document.createElement("div");
			div.classList.add('form-group', 'lotrinhkhung');

			var html = '<div class="col-sm-3 col-md-2 col-left">';
			html+= '<span>Tuần </span>';
			html+= '<input type="number" value="'+number+'" name="tuan[]" class="form-control week required" placeholder="Tuần nào">';
			html+= '</div>';
			html+= '<div class="col-sm-9 col-md-10"><input type="text" class="form-control noidung required" name="noidung[]" placeholder="Nội dung..."></div>';
			html+= '<a href="javascript:void(0)" title="Xóa lộ trình" class="btn-remove" onclick="remove_lotrinhkhung(this)"><i class="fa fa-times cred" aria-hidden="true"></i></a>';

			div.innerHTML = html;
			$('#row-lotrinhkhung').append(div);
		};

		function remove_lotrinhkhung(e){
			if(confirm("Xóa lộ trình khung")){
				var item = e.parentElement;
				item.remove();
			}
		};
	</script>
	<?php 
} ?>