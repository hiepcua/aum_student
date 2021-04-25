<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
require_once('../../libs/cls.lop.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$arr_id = array('id'=>'','khoa'=>'','he'=>'','nganh'=>'');
$ids = isset($_POST['ids'])?addslashes(strip_tags($_POST['ids'])):'';

if($ids!==''){
	$tml_arr = explode('-', $ids);
	$arr_id['id'] = $tml_arr[0];
	$arr_id['id_khoa'] = $tml_arr[1];
	$arr_id['id_he'] = $tml_arr[2];
	$arr_id['id_nganh'] = $tml_arr[3];
}
if($arr_id['id']=="" || $arr_id['id_khoa']=="" || $arr_id['id_he']=="" || $arr_id['id_nganh']=="")die("Thông tin sinh viên chưa đủ.");

$id = $arr_id['id'];
$id_khoa = $arr_id['id_khoa'];
$id_he = $arr_id['id_he'];
$id_nganh = $arr_id['id_nganh'];

$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND id=".$id);
if(count($res_dkts)<=0) die("Không tồn tại sinh viên này.");
$row = $res_dkts[0];
$masv = $row['masv'];
?>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Mã SV</div>
	<div class="col-md-6 col-xs-8"><?php echo $masv;?></div>
</div></div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Vào lớp:</div>
	<div class="col-md-6 col-xs-8">
		<?php 
		$obj=new CLS_MYSQL;
		$sql = "SELECT * FROM tbl_lop WHERE id_khoa='$id_khoa' AND id_he='$id_he' AND id_nganh='$id_nganh'";
		$obj->Query($sql); 
		if($obj->Num_rows()==0){
			echo "Chưa có lớp nào (thuộc khóa $id_khoa, hệ $id_he, ngành $id_nganh) được tạo.";
		}else {?>
		<select name="cbo_lop" id="cbo_lop" class="form-control" required>
			<?php 
			while($r_lop=$obj->Fetch_Assoc()) { ?>
			<option value="<?php echo $r_lop['id'];?>"><?php echo $r_lop['id'];?></option>
			<?php } ?>
		</select>
		<?php } ?>
	</div>
</div>
<div class="row form-group text-center">
	<button type="button" name="btnsave" id="btnsave" class="btn btn-primary">Lưu</button>
	<button type="button" name="btncancel" id="btncancel" class="btn btn-default" data-dismiss="modal">Thoát</button>
</div>
<div class="clearfix"></div>
<script>
$(document).ready(function(){
	$("#btnsave").click(function(){
		var lop = $("#cbo_lop").val();
		if(lop=="") {
			$("#cbo_lop").addClass('novalid');
			return false;
		}else $("#cbo_lop").removeClass('novalid');
		var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_add_lop.php";
		$.post(url,{'lop':lop,'id_khoa':'<?php echo $id_khoa;?>','id_he':'<?php echo $id_he;?>','id_nganh':'<?php echo $id_nganh;?>','id':'<?php echo $id;?>','masv':'<?php echo $masv;?>'},function(req){
			console.log(req);
			if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
			else if(req=="success"){
				showMess("Đã chuyển lớp thành công.");
				setTimeout(function(){window.location.reload();},3000);
			}
		});
	})
})
</script>