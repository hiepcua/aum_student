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
$sql = "SELECT * FROM tbl_dangky_tuyensinh WHERE id='$id'";
$obj=new CLS_MYSQL;
$obj->Query($sql);
$r = $obj->Fetch_Assoc();
$id = $r['id'];
$masv = $r['masv'];
$malop = $r['malop']; 
$id_khoa=$r['id_khoa'];
$id_he=$r['id_he']; 
$id_nganh=$r['id_nganh'];
?>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Mã SV</div>
	<div class="col-md-6 col-xs-8"><?php echo $masv;?></div>
</div></div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Lớp cũ</div>
	<div class="col-md-6 col-xs-8"><?php echo $malop;?></div>
</div>
<div class="row form-group">
	<div class="col-md-4 col-xs-4 text">Lớp mới</div>
	<div class="col-md-6 col-xs-8">
		<select name="cbo_lop" id="cbo_lop" class="form-control" required>
			<option value="">Lớp</option>
			<?php $objlop = new CLS_LOP;
			$objlop->getList(" AND id<>'$malop' AND id_khoa='$id_khoa' AND id_he='$id_he' AND id_nganh='$id_nganh'"); 
			while($r_lop=$objlop->Fetch_Assoc()) { ?>
				<option value="<?php echo $r_lop['id'];?>"><?php echo $r_lop['id'];?></option>
			<?php } ?>
		</select>
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
			var lop_moi = $("#cbo_lop").val();
			if(lop_moi=="") {
				$("#cbo_lop").addClass('novalid');
				return false;
			}else $("#cbo_lop").removeClass('novalid');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_chuyenlop.php";
			$.post(url,{'lop_cu':'<?php echo $malop;?>','lop_moi':lop_moi,'id':'<?php echo $id;?>','masv':'<?php echo $masv;?>'},function(req){
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="success"){
					showMess("Đã chuyển lớp thành công.");
					setTimeout(function(){window.location.reload();},3000);
				}
			});
		})
	})
</script>