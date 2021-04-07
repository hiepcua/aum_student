<?php
$strwhere='';
$check_permission = $UserLogin->Permission('user');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$_name = isset($_GET['name']) ? antiData($_GET['name']) : '';
$_phone = isset($_GET['phone']) ? antiData($_GET['phone']) : '';
?>
<div class="body"><br>
	<div class='col-md-3'>
		<div class='body_col_left bleft bright'>
			<div class="com_header color">
				<i class="fa fa-sitemap" aria-hidden="true"></i> Nhóm người dùng
			</div>
			<input type='hidden' id='guser_selected' value=''/>
			<div class='user_group_list'>
				<?php $UserLogin->getGroupUser(0);?>
			</div>
			<div class='user_group_func'>
				<ul class='menu'>
					<li class='cmd_group_add'><a href='' class='cgreen'><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm mới</a></li>
					<li class="cmd_group_edit"><a href='' ><i class="fa fa-edit" aria-hidden="true"></i> Sửa nhóm</a></li>
					<li class='cmd_group_del'><a href='' class="cred"><i class="fa fa-user-times" aria-hidden="true"></i> Xóa nhóm</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class='col-md-9 body_col_right'>
		<div class='row'>
			<div class="com_header color">
				<i class="fa fa-list" aria-hidden="true"></i>  Danh sách người dùng
				<div class="pull-right">
					<button id="cmd_user_add" class="btn btn-default"><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm mới người dùng</button>
					<button class="btn btn-default"><i class="fa fa-envelope" aria-hidden="true"></i> Send mail</button>
				</div>
			</div>
		</div>
		<div class='list_search'>
			<form method='get' class="form-inline" style="margin-bottom: 10px;">
				<div class='row'>
					<div class='col-md-12'>
						<input type='text' class='form-control' id="_name" name="name" placeholder='Username or fullname'>
						SĐT: <input type="text" name="phone" id="_phone" class='form-control'>
						<input type="button" name="btn_search" id="tk_btnsearch" class="btn btn-primary" value="Tìm kiếm">
					</div>
				</div>
			</form>
		</div>
		<div class='user_list'>
			<div class="list"></div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$("#_name").keypress(function(e){
				if(e.which==13) SubmitSearch();
			})
			$("#_phone").keypress(function(e){
				if(e.which==13) SubmitSearch();
			})
			$("#tk_btnsearch").click(function(){
				SubmitSearch();
			})
		});

		function SubmitSearch() {
			var _name = $("#_name").val();
			var _phone = $("#_phone").val();
			
			var url = window.location.href;
			var urlSplit = url.split( "?" );  
			var searchParams = new URLSearchParams(window.location.search);
			
			if(searchParams.has("name")===true){ searchParams.delete("name");}
			searchParams.append("name",_name);
			if(searchParams.has("phone")===true){ searchParams.delete("phone");}
			searchParams.append("phone",_phone);
			
			var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
			history.pushState(null, obj.Title, obj.Url);
			window.location.reload();
		}

		function user_group_select(_item){
			var _gid=$(_item).attr('dataid');
			$('.user_group_list .menu li').removeClass('checked');
			$(_item).parent().addClass('checked');
			$('#guser_selected').val(_gid);
			getUserByGroup(_gid);
		}
		function getUserByGroup(gid){
			var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/getUserByGroup.php';
			$.post(url,{'gid':gid},function(req){
				$('.user_list .list').html(req);
			});
		}
		function edit_user($this_user){
			var _gid=$('#guser_selected').val();
			var _userid = $($this_user).attr('dataid');
			if(_userid=='' || _userid==0) showMess('Vui lòng chọn thành viên cần sửa','');
			else{
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-header .modal-title').html('Sửa người dùng');
				$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
				var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/frm_edit_user.php'; 
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
			var _gid=$('#guser_selected').val();
			var _userid = $($this_user).attr('dataid');
			if(_userid=='' || _userid==0) showMess('Vui lòng chọn thành viên cần xóa','');
			else{
				if(confirm("Bạn có chắc muốn xóa?")){
					var _gid=$('#guser_selected').val();
					var _userid = $($this_user).attr('dataid');
					if(_userid=='' || _userid==0) showMess('Chọn một cá nhân để xóa','');
					else{
						var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/process_del_user.php'; 
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
				} }
			}
			function active_user($this_user){
				var _gid=$('#guser_selected').val();
				var _userid = $($this_user).attr('dataid');
				if(_userid=='' || _userid==0) showMess('Vui lòng chọn một thành viên','');
				else{
					var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/process_active_user.php'; 
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
				getUserByGroup(0);
				var body_h=$('.body_body').outerHeight();
				$('.body_body .body_col_left').css({'height':body_h+'px'});
				$('.cmd_group_add a').click(function(){
					$('#myModalPopup .modal-dialog').removeClass('modal-sm');
					$('#myModalPopup .modal-header .modal-title').html('Thêm mới nhóm người dùng');
					$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
					var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/frm_add_group.php'; 
					$.get(url,function(req){
						if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
						if(req=='E02'){showMess('Không có quyền sửa nhóm này!','error');}
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
						var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/frm_add_group.php'; 
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
					var _gid=$('#guser_selected').val();
					if(_gid=='' || _gid==0) showMess('Bạn chưa chọn nhóm để xóa','error');
					else if(confirm("Bạn có chắc muốn xóa?")){
						var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/del_group.php'; 
						$.get(url,{'id':_gid},function(req){
							if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
							else if(req=='E02'){showMess('Không có quyền xóa nhóm này!','error');}
							else if(req=='E03'){showMess('Không được xóa nhóm có người dùng!','error');}
							else{$('.user_group_list').html(req);}
						});
						return false;
					} 
					return false;
				});
				$('#cmd_user_add').click(function(){
					var _gid=$('#guser_selected').val();
					if(_gid=='undefined' || _gid==0) showMess('Bạn chưa chọn nhóm để thêm','');
					else{ 
						$('#myModalPopup .modal-dialog').removeClass('modal-sm');
						$('#myModalPopup .modal-header .modal-title').html('Đăng ký người dùng');
						$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
						var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/user/frm_add_user.php'; 
						$.post(url,{'id':_gid},function(req){
							if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
							if(req=='E02'){showMess('Không có quyền thêm người dùng vào nhóm này!','error');}
							else{
								$('#myModalPopup .modal-body').html(req);
								$('#myModalPopup').modal('show');
							}
						})
					}
					return false;
				});

				$('#btn_search').on('click', function(){
					// var
				});
			})
		</script>
	</div>