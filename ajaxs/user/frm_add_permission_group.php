<?php
session_start();
define("isHOME",true);
require_once("../../global/libs/gfinit.php");
require_once("../../global/libs/gfconfig.php");
require_once("../../global/libs/gffunc.php");
require_once("../../includes/gfconfig.php");
require_once("../../libs/cls.mysql.php");
require_once("../../libs/cls.users.php");
require_once("../../libs/cls.user_group.php");
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$obj_user_group = new CLS_USER_GROUP();
?>
<script type="text/javascript"></script>
<form class="form-horizontal" id="frm_action" name="frm_action" method="post" action="">
	<input type="hidden" id="txtids" name="">
	<input type="checkbox" name="chkall" id="chkall" onclick="docheckall('chk',this.checked);">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ANDMIN ROLE</th>
				<th>Admin</th>
				<th>Boss</th>
				<th>Thư ký</th>
				<th>Nhân viên</th>
				<th>Giúp việc</th>
				<th>Bảo vệ</th>
			</tr>
		</thead>
		<tbody>
			<tr name="trow">
				<td>Ra vào phòng bất kỳ</td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
			</tr>
			<tr name="trow">
				<td>Ra vào phòng chỉ định</td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
				<td align="center" width="60"><input type="checkbox" name="chk" id="chk" onclick="docheckonce('chk');" value="1"></td>
			</tr>
		</tbody>
	</table>
	<div class="clearfix"></div><br><br>
	<button type="button" class="btn btn-primary" id="cmd_save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu</button>
	<button type="button" class="btn btn-default" id="cmd_cancel"><i class="fa fa-undo" aria-hidden="true"></i> Hủy</button>
</form>
<div class="clearfix"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cmd_save').click(function(){
			var id=$('#txt_id').val()!='undefined'?$('#txt_id').val():0;
			var pid=$('#cbo_pid').val();
			var name=$('#txt_name').val();
			var intro=$('#txt_intro').val();
			var url='ajaxs/user/process_add_permission_group.php'; 
			$.post(url,{'txt_id':id,'cbo_pid':pid,'txt_name':name,'txt_intro':intro,},function(req){
				if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
				if(req=='E03'){showMess('Không có quyền thêm danh mục con cho nhóm này!','error');}
				else $('.user_group_list').html(req);
				$('#myModalPopup').modal('hide');
			});
		});
		$('#cmd_cancel').click(function(){
			$('#myModalPopup .modal-header .modal-title').html('Sửa thông tin người dùng');
			$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
			$('#myModalPopup').modal('hide');
		});
	})
</script>