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
if($id == '') die('Chưa lựa tương tác nào');

$res_wklog = SysGetList('tbl_working_log', array(), "AND id=".$id);
$row = $res_wklog[0];
$date = isset($row['date']) && $row['date']!=='' && $row['date']!==null ? date('Y-m-d', $row['date']) : null;
?>
<style type="text/css">
	.row-status{
		position: relative;
		padding-right: 40px;
	}
	input.chk_done {
	    position: absolute;
	    right: 20px;
	    top: 8px;
	    margin-top: 0;
	    width: 20px;
	    height: 20px;
	}
</style>
<form id="frm_status" method="post">
	<input type="hidden" id="id_working_log" name="id_working_log" value="<?php echo $id;?>">
	<label>Báo cáo tương tác</label>
	<div class="form-group row row-status">
		<input type="checkbox" name="chk_done" class="chk_done" id="chk_done">
		<div class="col-md-3"><input type="date" name="date_done" id="date_done" class="form-control" value="<?php echo $date;?>"></div>
		<div class="col-md-5"><input type="text" name="noidung_done" id="noidung_done" class="form-control" value="<?php echo $row['noidung'];?>" placeholder="Nội dung (Không để trống)"></div>
		<div class="col-md-4"><input type="text" name="ketqua_done" id="ketqua_done" class="form-control" value="<?php echo $row['ketqua'];?>" placeholder="Kết quả"></div>
	</div>
	<div class="row form-group text-right" style="margin-top: 20px;"><div class="col-md-12 col-xs-12">
		<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Lưu</button>
		<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
	</div></div>
</form>
<div class="clearfix"></div>
<script>
	$(document).ready(function(){
		$("#btnsave").click(function(){	
			if(checkinput()==true) {
				showLoading();
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_workinglog.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#frm_status").serialize(),
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
		})
	});

	function checkinput(){
		var id_dkts = $("#id_working_log").val();
		noidung_done = $('#noidung_done').val();

		if(id_dkts=="" || id_dkts=="undefined") {
			return false;
		}
		if(noidung_done=="") {
			$('#noidung_done').focus();
			return false;
		}
		return true;
	}
</script>