<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
define("COMS","mail");
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');

if($UserLogin->isLogin())  
$task=isset($_GET['task'])?$_GET['task']:'list'; 

$objdata= new CLS_MYSQL;				
$sql="SELECT * FROM tbl_mail_config ORDER BY `id` DESC"; 
$objdata->Query($sql);
$_host=$_user=$_pass='';$_port=110;
if($objdata->Num_rows()>0) {
	$r=$objdata->Fetch_Assoc();
	$_host = $r['hostname'];
	$_user = $r['user'];
	$_pass = $r['pass'];
	$_port = $r['port'];
	$_name = $r['name'];
} ?>
<div class="body">
	<?php 
		if(is_file(THIS_COM_PATH.'task/'.$task.'.php')){
			if($task=='' || $task=='list') {
				if(!isset($_POST['txtkey']))
					include_once(THIS_COM_PATH."task/load_mailbox.php");
			}
			include_once(THIS_COM_PATH.'task/'.$task.'.php');
		}
	?>
</div>
<?php unset($obj); unset($task);	unset($ids);?>
<script>
function user_group_select(_item){
	var _gid=$(_item).attr('dataid');
	$('.user_group_list .menu li').removeClass('checked');
	$(_item).parent().addClass('checked');
	$('#guser_selected').val(_gid);
	getUserByGroup(_gid);
}
function getUserByGroup($gid){
	var url='ajaxs/<?php echo COMS;?>/getUserByGroup.php';
	$.post(url,{'gid':$gid},function(req){
		$('.user_list .list').html(req);
	});
}
function changepass_user($this_user){

}
function edit_user($this_user){
	var _gid=$('#guser_selected').val();
	var _userid = $($this_user).attr('dataid');
	if(_userid=='' || _userid==0) showMess('Chọn một cá nhân để sửa','');
	else{
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-dialog').addClass('modal-lg');
		$('#myModalPopup .modal-header .modal-title').html('Sửa người dùng');
		$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
		var url='ajaxs/<?php echo COMS;?>/frm_edit_user.php'; 
		$.post(url,{'userid':_userid,'gid':_gid},function(req){
			if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
			if(req=='E02'){showMess('Không có quyền sửa người dùng ở nhóm này!','error');}
			if(req=='E03'){showMess('Không tồn tại người dùng này!','error');}
			else{
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			}
		})
	}
	return false;
}
function del_user($this_user){
	if(confirm("Bạn có chắc muốn xóa?")){
		var _gid=$('#guser_selected').val();
		var _userid = $($this_user).attr('dataid');
		if(_userid=='' || _userid==0) showMess('Chọn một cá nhân để xóa','');
		else{
			var url='ajaxs/<?php echo COMS;?>/process_del_user.php'; 
			$.post(url,{'userid':_userid,'gid':_gid},function(req){
				if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
				if(req=='E02'){showMess('Không có quyền xóa người dùng ở nhóm này!','error');}
				if(req=='E03'){showMess('Không tồn tại người dùng này!','error');}
				if(req=='E04'){showMess('Có lỗi trong quá trình sử lý!','error');}
				else{
					getUserByGroup(_gid);
					showMess('Success!','success');
				}
			})
		}
		return false;
	}
}
function active_user($this_user){
	var _gid=$('#guser_selected').val();
	var _userid = $($this_user).attr('dataid');
	if(_userid=='' || _userid==0) showMess('Chọn một cá nhân để active','');
	else{
		var url='ajaxs/<?php echo COMS;?>/process_active_user.php'; 
		$.post(url,{'userid':_userid,'gid':_gid},function(req){
			if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
			if(req=='E02'){showMess('Không có quyền sửa người dùng ở nhóm này!','error');}
			if(req=='E03'){showMess('Không tồn tại người dùng này!','error');}
			if(req=='E04'){showMess('Có lỗi trong quá trình sử lý!','error');}
			else{
				getUserByGroup(_gid);
				showMess('Success!','success');
			}
		})
	}
	return false;
}
$(document).ready(function(){
	var body_h=$('.body_body').outerHeight();
	$('.body_body .body_col_left').css({'height':body_h+'px'});
	$('.cmd_group_add a').click(function(){
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-dialog').addClass('modal-lg');
		$('#myModalPopup .modal-header .modal-title').html('Thêm mới nhóm người dùng');
		$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
		var url='ajaxs/<?php echo COMS;?>/frm_add_group.php'; 
		$.get(url,function(req){
			if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
			else{
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			}
		})
		return false;
	});
	$('.cmd_group_edit a').click(function(){
		var _gid=$('#guser_selected').val();
		if(_gid=='' || _gid==0) showMess('Bạn chưa chọn nhóm để sửa','error');
		else{
			$('#myModalPopup .modal-dialog').removeClass('modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-lg');
			$('#myModalPopup .modal-header .modal-title').html('Sửa thông tin nhóm người dùng');
			$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
			var url='ajaxs/<?php echo COMS;?>/frm_add_group.php'; 
			$.get(url,{'gid':_gid},function(req){
				if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
				if(req=='E02'){showMess('Không có quyền sửa nhóm này!','error');}
				else{
					$('#myModalPopup .modal-body').html(req);
					$('#myModalPopup').modal('show');
				}
			})
		}
		return false;
	});
	$('.cmd_group_del a').click(function(){
		if(confirm("Bạn có chắc muốn xóa?")){
			var _gid=$('#guser_selected').val();
			var url='ajaxs/<?php echo COMS;?>/del_group.php'; 
			$.get(url,{'id':_gid},function(req){
				if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
				if(req=='E02'){showMess('Không có quyền xóa nhóm này!','error');}
				$('.user_group_list').html(req);
			});
			return false;
		}
	});
	$('#cmd_user_add').click(function(){
		var _gid=$('#guser_selected').val();
		if(_gid=='undefined' || _gid==0) showMess('Bạn chưa chọn nhóm để thêm','');
		else{
			$('#myModalPopup .modal-dialog').removeClass('modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-lg');
			$('#myModalPopup .modal-header .modal-title').html('Đăng ký người dùng');
			$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
			var url='ajaxs/<?php echo COMS;?>/frm_add_user.php'; 
			$.get(url,{'id':_gid},function(req){
				if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
				if(req=='E02'){showMess('Không có quyền thêm người dùng vào nhóm này!','error');}
				else{
					$('#myModalPopup .modal-body').html(req);
					$('#myModalPopup').modal('show');
				}
			})
		}
		return false;
	})
	$('table.mail_list tr').click(function(){
		var id = $(this).attr('dataid');
		window.location="<?php echo ROOTHOST_ADMIN.COMS;?>/"+id;
	})
	$('.func_refresh').click(function(){
		window.location="<?php echo ROOTHOST_ADMIN.COMS;?>/";
	})
})
</script>