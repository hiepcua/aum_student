<?php session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.hocsinh.php');
require_once('../../libs/cls.he.php');
require_once('../../libs/cls.khoa.php');
require_once('../../libs/cls.nganh.php');
require_once('../../libs/cls.tuyensinh.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
$ma = isset($_POST['id_hoso']) ? antiData($_POST['id_hoso']) : '';
if($id == '') die('Chưa lựa chọn hồ sơ nào');

$objhs = new CLS_HS;
$name = $objhs->getFullNameByInfo('ma',$ma);

$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND id=".$id);
$row = $res_dkts[0];
?>
<form id="frm_status" method="post">
	<div class="form-group row">
		<input type="hidden" id="id_dkts" name="id_dkts" value="<?php echo $id;?>">
		<input type="hidden" id="id_hoso" name="id_hoso" value="<?php echo $ma;?>">
		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Họ tên</label>
			<div class="col-md-8"><input type="text" id="fullname" value="<?php echo $name;?>" readonly class="form-control" /></div>
		</div>

		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Khóa</label>
			<div class="col-md-8">
				<select name="cbokhoa" id="cbokhoa" class="form-control" readonly>
					<?php 
					$res_khoa = SysGetList('tbl_khoa', array(), '');
					if(count($res_khoa)>0){
						foreach ($res_khoa as $key => $value) {
							if($value['id'] == $row['id_khoa']){
								echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
							}
						}
					}?>
				</select>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Bậc đào tạo</label>
			<div class="col-md-8">
				<select name="cbobac" id="cbobac" class="form-control" readonly>
					<?php 
					$res_he = SysGetList('tbl_he', array(), '');
					if(count($res_he)>0){
						foreach ($res_he as $key => $value) {
							if($value['id'] == $row['id_he']){
								echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
							}
						}
					}?>
				</select>
			</div>
		</div>

		<div class="col-md-6 col-xs-12">
			<label class="col-md-4">Ngành</label>
			<div class="col-md-8">
				<select name="ma_nganh" id="ma_nganh" class="form-control" readonly>
					<?php
					$res_nganh = SysGetList('tbl_nganh', array(), ''); 
					if(count($res_nganh)>0){
						foreach ($res_nganh as $key => $value) {
							if($value['id'] == $row['id_nganh']){
								echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
							}
						}
					}?>
				</select>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<label>Trạng thái</label>
			<div>
				<?php
				$arr_status=array();
				$current_status = $row['status'];
				switch ($current_status) {
					case 'TS1':
					$arr_status = array('TS1','TS2','TS3','TS4','TS5','HS1','HS2','HS3','HS4');
					break;

					case 'TS2':
					$arr_status = array('TS2','TS3','TS4','TS5','HS1','HS2','HS3','HS4');
					break;
					
					case 'TS3':
					$arr_status = array('TS3','TS4','TS5','HS1','HS2','HS3','HS4');
					break;
					
					case 'TS4':
					$arr_status = array('TS4','TS5','HS1','HS2','HS3','HS4');
					break;
					
					case 'TS5':
					$arr_status = array('TS5','HS1','HS2','HS3','HS4');
					break;
					
					case 'HS1':
					$arr_status = array('HS1','HS2','HS3','HS4');
					break;
					
					case 'HS2':
					$arr_status = array('HS2','HS3','HS4');
					break;
					
					case 'HS3':
					$arr_status = array('HS3','HS4');
					break;
					
					case 'HS4':
					$arr_status = array('HS4');
					break;
					
					default:
					$arr_status = array('TS1','TS2','TS3','TS4','TS5','HS1','HS2','HS3','HS4');
					break;
				}
				foreach ($arr_status as $key => $value) {
					$checked = $key==0 ? 'checked' : '';
					echo '<label class="radio-inline"><input type="radio" name="status" value="'.$value.'" '.$checked.'> '.$STATUS_DKTS[$value].'</label>&nbsp&nbsp&nbsp';
				}
				?>
			</div>
		</div>
	</div>
	<div class="row form-group text-right" style="margin-top: 20px;"><div class="col-md-12 col-xs-12">
		<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Cập nhật trạng thái</button>
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
	</div></div>
</form>
<div class="clearfix"></div>
<script>
	$(document).ready(function(){
		$("#btnsave").click(function(){	
			if(checkinput()==true) {
				var id_dkts = $("#id_dkts").val();
				var id_hoso = $("#id_hoso").val();
				var status = $("input[name='status']:checked", '#frm_status').val();
				
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_status.php";
				showLoading();
				$.post(url,{'id_dkts':id_dkts,'id_hoso':id_hoso,'status':status},function(req){
					hideLoading();
					if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
					else if(req=="success"){
						showMess("Cập nhật trạng thái thành công!");
						setTimeout(function(){
							window.location.reload();
						}, 2000);
					}
				})
			} return false;
		})
	});

	function checkinput(){
		var id_dkts = $("#id_dkts").val();
		var id_hoso = $("#id_hoso").val();
		var status = $("input[name='status']:checked", '#frm_status').val();
		if(id_dkts=="" || id_dkts=="undefined") {
			return false;
		}if(id_hoso=="" || id_hoso=="undefined") {
			return false;
		}if(status=="" || status=="undefined") {
			return false;
		}
		return true;
	}
</script>