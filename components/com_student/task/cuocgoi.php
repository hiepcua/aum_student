<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma_hoso = antiData($_GET['id']);

$obj = new CLS_MYSQL;
//---------------------------------------
$sql="SELECT * FROM tbl_khoa";
$obj->Query($sql);
$_KHOA=array();
while($r=$obj->Fetch_Assoc()){
	$_KHOA['K'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$_HE=array();
while($r=$obj->Fetch_Assoc()){
	$_HE['H'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH['N'.$r['id']]=$r['name'];
}

$res_hocsinh = SysGetList('tbl_hocsinh', array(), "AND ma='".$ma_hoso."'");
$r = $res_hocsinh[0];

?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<?php $cur_tab = 3; include_once("tabs.php"); ?>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>student/hoso" class="btn btn-default btn-close" title="Thoát"><i class="fa fa-reply"></i> Thoát</a>
				</li>
			</ul>
		</div>
	</div>
	
	<section class="card" style="position: unset;">
		<div class="card-body">
			<div class="card-block">
				<div class="media">
					<div class="table-responsive">
						<table class="list table table-striped table-bordered">
						<thead>
							<tr class="header">
								<th class="text-center">Ngày</th>
								<th>Mã sinh viên</th>
								<th>Nội dung tương tác</th>
								<th class="text-center">Kết quả</th>
								<th class="text-center">Hoàn thành</th>
								<th class="text-center">Sửa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$strWhere=' AND id_hoso="'.$ma_hoso.'"';
							$strWhere.=' ORDER BY `date` DESC LIMIT 0,100';
							$res_workinglog = SysGetList('tbl_working_log',array(),$strWhere);
							if(count($res_workinglog)>0){
							foreach ($res_workinglog as $key => $value) {
								$masv = $value['masv'];
								$date = date('d-m-Y', $value['date']);
								$cdate = date('d-m-Y H:i', $value['cdate']);
								if($value['finish']==1){
									$edit = '';
									$finish = '<i class="fa fa-check cgreen" aria-hidden="true"></i>';
								}else{
									$edit = '<i class="fa fa-pencil-square-o edit_workinglog" dataid="'.$value['id'].'" aria-hidden="true"></i>';
									$finish = '<i class="fa fa-times cgray finish_workinglog" dataid="'.$value['id'].'" aria-hidden="true"></i>';
								}
								
								echo '<tr>';
								echo '<td align="center">'.$cdate.'</td>';
								echo '<td>'.$masv.'</td>';
								echo '<td>'.$value['noidung'].'</td>';
								echo '<td><strong>Ngày: </strong>'.$date.'<br/>'.$value['ketqua'].'</td>';
								echo '<td align="center">'.$cdate.'</td>';
								echo '<td align="center">'.$edit.'</td>';
								echo '</tr>';
							}
							}
							?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.End Card lịch sử tương tác -->
</div>

<script>
	$(document).ready(function(){
		$(".chuyen_lop").click(function(){
			var ids = $(this).attr('dataids');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_chuyen_lop.php";
			$.post(url,{'ids':ids},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Thông tin chuyển lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});

		$('#dk_nganh').click(function(){
			var id_dkts = $(this).attr('dataid-dkts');
			var id_hoso = $(this).attr('dataid');
			frm_dangky_nganh_moi(id_hoso, id_dkts);
		});

		$(".dk_nganh").click(function(){
			var id_dkts = $(this).attr('dataid-dkts');
			var id_hoso = $(this).attr('dataid');
			frm_dangky_nganh(id_hoso, id_dkts);
		})

		$('.xoa_nganh').click(function(){
			var id_dkts = $(this).attr('data-id_dkts');
			xoa_nganh(id_dkts);
		});

		$('.change_status').click(function(){
			var id = $(this).attr('dataid');
			var id_hoso = $(this).attr('data-hoso');
			frm_status(id, id_hoso);
		});

		$('.edit_workinglog').click(function(){
			var id = $(this).attr('dataid');
			frm_edit_workinglog(id);
		});

		$('#cbo_masv').change(function(){
			$('#frm_search').submit();
		});

		$('.finish_workinglog').click(function(){
			var id = $(this).attr('dataid');
			var url = "<?php echo ROOTHOST;?>ajaxs/student/process_finish_workinglog.php";
			$.post(url,{'id_working_log':id},function(req) {
				if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(req=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(req==="success") {
					showMess("Cập nhật thành công!",""); 
					setTimeout(function(){ 
						window.location.reload(); 
					}, 1500);
				}
			})
		});

		$(".btn_nhaplop").click(function(){
			var hoso = $(this).attr('dataid');
			var ids = $(this).attr('dataids');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_add_lop.php";
			$.post(url,{'ma':hoso, 'ids': ids},function(req) {
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-title').html('Phân lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});
	})

	function frm_dangky_nganh_moi(id_hoso, id_dkts){
		if(id_hoso.length>0){
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/dangky.php";
			$.post(url,{'id_dkts':id_dkts, 'id_hoso': id_hoso},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-lg');
				$('#myModalPopup .modal-title').html('Đăng ký thêm ngành học');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		}else{
			showMess('Chưa chọn hồ sơ nào.', 'error');
		}
	}

	function frm_dangky_nganh(id_hoso, id_dkts){
		if(id_hoso.length>0){
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/dangky_nganh.php";
			$.post(url,{'id_dkts':id_dkts, 'id_hoso': id_hoso},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-lg');
				$('#myModalPopup .modal-title').html('Đăng ký ngành học');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		}else{
			showMess('Chưa chọn hồ sơ nào.', 'error');
		}
	}

	function frm_status(id, id_hoso){
		if(id.length>0){
			var url = "<?php echo ROOTHOST;?>ajaxs/student/frm_status.php";
			$.post(url,{'id':id, 'id_hoso':id_hoso},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-lg');
				$('#myModalPopup .modal-title').html('Cập nhật trạng thái');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		}else{
			showMess('Chưa chọn hồ sơ nào.', 'error');
		}
	}

	function frm_edit_workinglog(id){
		if(id.length>0){
			var url = "<?php echo ROOTHOST;?>ajaxs/student/frm_edit_workinglog.php";
			$.post(url,{'id':id},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-lg');
				$('#myModalPopup .modal-title').html('Cập nhật báo cáo tương tác');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		}else{
			showMess('Chưa chọn hồ sơ nào.', 'error');
		}
	}

	function xoa_nganh(id_dkts){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/process_del_nganh.php',
		_data = {
			'id_dkts': id_dkts,
		};

		if(id_dkts.length == 0){
			showMess('Bạn chưa chọn ngành nào', 'error');
		}else{
			if(confirm('Bạn có chắc muốn xóa ngành đã đăng ký này?')){
				$.post(_url, _data, function(req){
					if(req == 'success'){
						showMess('Xóa thành công.', 'success');
						setTimeout(function(){
							window.location.reload(); 
						}, 2000);
					}
				});
			}
		}
	}
</script>