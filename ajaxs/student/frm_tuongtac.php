<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");

$masv = isset($_POST['masv']) ? antiData($_POST['masv']) : '';
if($masv == '') die('Chưa lựa chọn học viên nào');

$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND masv='".$masv."'");
if(count($res_dkts)<=0) die('Không tìm thấy sinh viên');
$row = $res_dkts[0];
$startdate = date("Y-m-d");
$level = $row['status'];
$status_sv = $row['tinhtrang_sv'];
$status_hp = $row['tinhtrang_hocphi'];
$status_call = $row['tinhtrang_call'];
$status_call_hp = $row['tinhtrang_call_hp'];
$ma_hoso = $row['id_hoso'];
$res_hocsinh = SysGetList('tbl_hocsinh', array(), "AND ma='".$ma_hoso."'");
$hotensv = $res_hocsinh[0]['ho_dem'].' '.$res_hocsinh[0]['name'];
?>
<div class="ajx_mess"></div>
<form id="frm_tuongtac" method="post">
	<input type="hidden" id="ma_hoso" name="ma_hoso" value="<?php echo $ma_hoso;?>">
	<input type="hidden" id="masv" name="masv" value="<?php echo $masv;?>">
	
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				<strong><?php echo $hotensv;?></strong>
			</div>
			<div id="list-tuongtac" class="box-left">
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-target="#panel-1">
						Tương tác sinh viên
						<a href="javascript:void(0)" class="remove_tuongtac" onclick="remove_tuongtac(this)"><i class="fa fa-times" aria-hidden="true"></i></a>
					</div>
					<div class="panel-body collapse in" id="panel-1" data-parent="#list-tuongtac">
						<div class="el">
							<div class="form-group">
								<span class="text">Ngày: </span>
								<div class="content">
									<input type="date" class="form-control required" name="startdate[]" value="<?php echo $startdate;?>">
								</div>
							</div>

							<div class="form-group">
								<span class="text">Nội dung: </span>
								<div class="content">
									<textarea class="form-control required" name="noidung[]" placeholder="Nội dung tương tác"></textarea>
								</div>
							</div>

							<div classs="form-group">
								<span class="text">Tình trạng: </span>
								<div class="content">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" name="finish[]" id="finish1" value="1">
										<label class="form-check-label" for="finish1">Hoàn thành</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<a href="javascript:void(0)" id="add_tuongtac" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm tương tác</a>
		</div>
		<div class="col-md-4">
			<div class="box-right">
				<div class="form-group">
					<label>Tình trạng cuộc gọi học tập</label>
					<select name="cbo_status_call" id="cbo_status_call" class="form-control">
						<?php
						foreach ($STATUS_CALL as $key => $value) {
							$checked = $key==$status_call ? 'selected' : '';
							echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
						}
						?>
					</select>
				</div>

				<div class="form-group">
					<label>Tình trạng cuộc gọi học phí</label>
					<select name="cbo_status_call_hp" id="cbo_status_call_hp" class="form-control">
						<?php
						foreach ($STATUS_CALL_HP as $key => $value) {
							$checked = $key==$status_call_hp ? 'selected' : '';
							echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
						}
						?>
					</select>
				</div>

				<div class="form-group">
					<label>Level</label>
					<select id="cbo_level" name="cbo_level" class="form-control">
						<?php
						$flag = 'no';
						foreach ($LEVEL_STUDENT as $key => $value) {
							$checked = '';
							if($key == $level){
								$flag = "yes";
								$checked = 'selected';
							}
							if($flag=='yes'){
								echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
							}
						}?>
					</select>
				</div>

				<div class="form-group">
					<label>Tình trạng SV</label>
					<select name="cbo_status_sv" id="cbo_status_sv" class="form-control">
						<?php
						foreach ($STATUS_SV as $key => $value) {
							$checked = $key==$status_sv ? 'selected' : '';
							echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
						}
						?>
					</select>
				</div>

				<div class="form-group">
					<label>Tình trạng học phí</label>
					<select name="cbo_status_hp" id="cbo_status_hp" class="form-control">
						<?php
						foreach ($STATUS_HOCPHI as $key => $value) {
							$checked = $key==$status_hp ? 'selected' : '';
							echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group text-center" style="margin-top: 20px;">
		<button type="button" name="btnsave" id="btnsave" class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal"> Hủy</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnsave").click(function(){	
			if(validForm()==true) {
				showLoading();
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_tuongtac.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#frm_tuongtac").serialize(),
					success: function(req){
						hideLoading();
						if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
						else if(req=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
						else if(req==="success") {
							showMess("Cập nhật thành công!",""); 
							setTimeout(function(){ 
								window.location.reload(); 
							}, 1500);
						}
					}
				});
			} return false;
		});

		$("#add_tuongtac").on('click', function(){
			var url = "<?php echo ROOTHOST;?>ajaxs/student/item_frm_tuongtac.php";
			$.get(url, function(res){
				$("#list-tuongtac").append(res);
			});
		});
	});

	function remove_tuongtac(e){
		var tuongtac = e.parentElement.parentElement;
		tuongtac.remove();
	}

	function validForm(){
		var flag = true;
		$('#frm_tuongtac .required').each(function(){
			var val = $(this).val();
			if(!val || val=='' || val=='0') {
				$(this).parents('.form-group').addClass('error');
				flag = false;
			}

			if(flag==false) {
				$('.ajx_mess').html('Những mục có đánh dấu * là những thông tin bắt buộc.');
			}
		});
		return flag;
	}
</script>