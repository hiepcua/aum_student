<?php
session_start();
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once("../../libs/cls.mysql.php");
require_once("../../libs/cls.users.php");
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$userid=isset($_POST['userid'])?(int)$_POST['userid']:0;
$gid=isset($_POST['gid'])?(int)$_POST['gid']:0;

$check_permission = $objuser->Permission('user');
if($check_permission==false) die('E02');

$objuser->getList(" AND id=$userid ");
if($objuser->Num_rows()<1) die("E03");
else {
	$row = $objuser->Fetch_Assoc();
}
?>
<style type="text/css">
	hr{	margin-top: 0;margin-bottom: 15px;}
	label.title{font-size: 16px;font-weight: 500;}
</style>
<form id="frm-register" class="form-horizontal"  name="frm-register" method="" action="" enctype="multipart/form-data">
	<input type="hidden" class="form-control" id="txt_gid" value="<?php echo $gid;?>">
	<input type="hidden" id="txt_user_id" name="txt_user_id" value="<?php echo $row['id'] ?>" />
	<div class="form-group">
		<div class="col-md-12">
			<label>Họ tên<small class="cred"> (*)</small></label>
			<input type="text" id="txt_firstname" name="txt_firstname" class="form-control" value="<?php echo $row['firstname'];?>" placeholder="Tên">
			<small id="er0" class="cred"></small>
			<label>Phone<small class="cred"> (*)</small></label>
			<input type="number" id="txt_phone" name="txt_phone" class="form-control" value="<?php echo $row['phone'];?>" placeholder="Số điện thoại">
			<small id="er5" class="cred"></small>
		</div>
	</div>
	<br>
	<div class="clearfix"></div><br>
	<input type="hidden" name="cmd_update_user"/>
	<button type="button" class="btn btn-primary" id="cmd_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	<button type="button" class="btn btn-default" id="cmd_cancel"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cmd_save').click(function(){
			if(check_validate()==true) {
				var gid=$('#txt_gid').val()!='undefined'?$('#txt_gid').val():0;
				var userid=$('#txt_user_id').val();
				var data = $('#frm-register').serializeArray();
				data.push( {name:'txt_gid', value:gid},{name:'txt_user_id', value:userid} );
				var url='ajaxs/user/process_update_user.php';
				$.post(url,data,function(req){
					if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
					if(req=='E03'){showMess('Không có quyền sửa người dùng cho nhóm này!','error');}
					if(req=='E04'){showMess('Có lỗi trong quá trình thực hiện!','error');}
					else {
						console.log(req);
						getUserByGroup(gid);
						showMess('Success!','success');
					}
				});
			}else{
				alert("Lỗi!");
			}
		});
		$('#cmd_cancel').click(function(){
			$('#myModalPopup .modal-header .modal-title').html('Sửa thông tin người dùng');
			$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
			$('#myModalPopup').modal('hide');
		});
	})
	function getUserByGroup($gid){
		var url='ajaxs/user/getUserByGroup.php';
		$.post(url,{'gid':$gid},function(req){
			$('.user_list .list').html(req);
		});
	}
	function check_validate(){
		if ($('#txt_firstname').val() =='') {
			$('#er0').text('Không được bỏ trống');
			return false;
		}else{
			$('#er0').text('');
		}
		if ($('#txt_lastname').val() =='') {
			$('#er1').text('Không được bỏ trống');
			return false;
		}else{
			$('#er1').text('');
		}
		if ($('#txt_phone').val() =='') {
			$('#er5').text('Không được bỏ trống');
			return false;
		}else{
			$('#er5').text('');
		}
		return true;
	}
</script>