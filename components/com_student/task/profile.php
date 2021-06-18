<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma_hoso = antiData($_GET['id']);
$res_hocsinh = SysGetList('tbl_hocsinh', array(), "AND ma='".$ma_hoso."'");
if(!isset($res_hocsinh[0])) die('Không có thông tin học viên này.');
$r = $res_hocsinh[0];

//---------------------------------------
$KHOA = array();
$json_khoa = file_get_contents(DOCUMENT_ROOT.'jsons/khoa.json');
$arr_khoa = json_decode($json_khoa, true);
foreach ($arr_khoa as $key => $value) {
	$KHOA[$value['id']] = $value;
}

//---------------------------------------
$HE = array();
$json_he = file_get_contents(DOCUMENT_ROOT.'jsons/he.json');
$arr_he = json_decode($json_he, true);
foreach ($arr_he as $key => $value) {
	$HE[$value['id']] = $value;
}

//---------------------------------------
$NGANH = array();
$json_nganh = file_get_contents(DOCUMENT_ROOT.'jsons/nganh.json');
$arr_nganh = json_decode($json_nganh, true);
foreach ($arr_nganh as $key => $value) {
	$NGANH[$value['id']] = $value;
}
?>
<style type="text/css">
	.box-infosv{
		position: relative;
		padding-left: 60px;
	}
	.box-infosv .xoa_nganh {
		position: absolute;
		left: 0;
		width: 40px;
		height: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
		background-color: #ccc;
	}
	.profile_view .flex{
		display: flex;
		flex-wrap: wrap;
	}
</style>
<div class='body profile_view'>
	<div class="row flex">
		<div class="col-md-6 col-sm-6 card">
			<div class="">
				<div class="card-body">
					<div class="card-block">
						<div class="box-profile">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="el">
										<span>Mã hồ sơ :</span>
										<div class="field"><?php echo $r['ma'];?></div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="el">
										<span>Họ tên :</span>
										<div class="field"><?php echo $r['ho_dem'].' '.$r['name'];?></div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="el">
										<span>Số điện thoại :</span>
										<div class="field"><?php echo $r['dienthoai'];?></div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="el">
										<span>Email :</span>
										<div class="field"><?php echo $r['email'];?></div>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-group">
							<a href="<?php echo ROOTHOST.'student/soyeulylich/'.$r['ma'];?>" class="btn btn-primary"><i class="fa fa-book" aria-hidden="true"></i> Sơ yếu lý lịch</a>
							<a href="<?php echo ROOTHOST;?>student/vanbang/<?php echo $ma_hoso;?>" class="btn btn-primary" title="Thêm văn bằng"><i class="fa fa-plus"></i> Thêm chương trình học</a>
							<a href="javascript:viod(0)" class="btn btn-primary add_workinglog" title="Thêm cuộc gọi"><i class="fa fa-plus"></i> Thêm cuộc gọi</a>
						</div>
					</div>

					<div id="list_profile" class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr class="header">
									<th colspan="2" class="text-center">Thông tin sinh viên</th>
								</tr>
								<tr class="header">
									<th colspan="1" class="text-center">Level và các trạng thái</th>
									<th colspan="1" class="text-center">Thông tin đào tạo</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$res_nganhdk = SysGetList('tbl_dangky_tuyensinh',array(),'AND id_hoso="'.$ma_hoso.'"');
								if(count($res_nganhdk)>0){
									foreach ($res_nganhdk as $key => $value) {
										$i = $key+1; $id=$value['id']; $str='';
										$status = $value['status'] != '' ? $LEVEL_STUDENT[$value['status']] : '';
										$dataid = $id;
										$hoso = $value['id_hoso'];
										$masv = $value['masv'];

										$name_nganh = isset($NGANH[$value['id_nganh']]) ? $NGANH[$value['id_nganh']]['name'] : "";
										$name_he = isset($HE[$value['id_he']]) ? $HE[$value['id_he']]['name'] : "";
										$name_khoa = isset($KHOA[$value['id_khoa']])? $KHOA[$value['id_khoa']]['name'] : "";

										$tinhtrang_sv = strlen($value['tinhtrang_sv'])>0 ? $value['tinhtrang_sv'] : '---';
										$txt_tinhtrang_sv = $tinhtrang_sv!=='---' ? $STATUS_SV[$tinhtrang_sv] : '';

										$tinhtrang_hocphi = strlen($value['tinhtrang_hocphi'])>0 ? $value['tinhtrang_hocphi'] : '---';
										$txt_tinhtrang_hocphi = $tinhtrang_hocphi!=='---' ? $STATUS_HOCPHI[$tinhtrang_hocphi] : '---';

										$tinhtrang_call = strlen($value['tinhtrang_call'])>0 ? $value['tinhtrang_call'] : '---';
										$txt_tinhtrang_call = $tinhtrang_call!=='---' ? $STATUS_CALL[$tinhtrang_call] : '';
										$last_contact = (int)$value['last_contact']>0 ? date('d/m/Y', $value['last_contact']) : '';

										echo '<tr>';

										echo '<td colspan="2">
										<div class="box-infosv">
										<a href="javascript:void(0)" data-id_dkts="'.$value['id'].'" class="xoa_nganh cred" title="Xóa chương trình học"><i class="fa fa-trash btn_xoa" aria-hidden="true" title="Xóa"></i></a>
										<strong><a href="#">'.$value['masv'].'</a></strong>
										<div class="lienhecuoi">Liên hệ cuối: '.$last_contact.'</div>
										</td>
										</div>
										</tr>';

										echo '<tr>
										<td>
										<div class="box-all-status">

										<div class="el level">
										<span>Level: </span>
										<a href="javascript:void(0)" title="Cập nhật trạng thái" dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-default change_status">'.$status.'</a>
										</div>

										<div class="el status_sv" title="'.$txt_tinhtrang_sv.'">
										<span>Tình trạng SV: </span>
										<a href="javascript:void(0)" class="label label-success" onclick="frm_status_sv(this)" data-masv="'.$masv.'" data-status-sv="'.$tinhtrang_sv.'">'.$txt_tinhtrang_sv.'</a>
										</div>

										<div class="el status_hp" title="'.$txt_tinhtrang_hocphi.'">
										<span>Tình trạng HP: </span>
										<a href="javascript:void(0)" class="label label-success" onclick="frm_status_hocphi(this)"  data-masv="'.$masv.'" data-status-hp="'.$tinhtrang_hocphi.'">'.$txt_tinhtrang_hocphi.'</a>
										</div>

										<div class="el status_call" title="'.$txt_tinhtrang_call.'">
										<span>Tình trạng cuộc gọi: </span>
										<a href="javascript:void(0)" class="label label-success" onclick="frm_status_call(this)" data-masv="'.$masv.'" data-status-call="'.$tinhtrang_call.'">'.$txt_tinhtrang_call.'</a>
										</div>

										</div>
										</td>';

										echo '<td>
										<div class="daotao-info">
										<div class="el nganh"><strong>'.$name_nganh.'</strong></div>
										<div class="el khoa">Khóa: <strong>'.$name_khoa.'</strong></div>
										<div class="el he">Hệ/bậc: <strong>'.$name_he.'</strong></div>';

										if($value['malop']!="") {
											echo 'Lớp: <a href="javascript:void(0)" title="Chuyển lớp" data-masv="'.$value['masv'].'" class="chuyen_lop label label-primary">'.$value['malop'].'</a>';
										}else {
											echo '<a href="javascript:void(0)" class="btn btn-default btn_nhaplop" data-masv="'.$value['masv'].'">Nhập lớp</a>';
										}

										echo '</div>
										</td>
										</tr>';
									}
								} else {
									echo '<tr><td colspan="12">Chưa có dữ liệu</td></tr>';
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="box-history table-responsive">
						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th class="text-center">Xóa</th>
										<th colspan="1">Ngày</th>
										<th colspan="1">Trạng thái</th>
										<th colspan="1">Người thực hiện</th>
									</tr>
									<tr>
										<th class="text-center" colspan="4">Nội dung tương tác</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$strWhere=' AND id_hoso="'.$ma_hoso.'"';
									$strWhere.=' ORDER BY `date` DESC LIMIT 0,10';
									$res_workinglog = SysGetList('tbl_working_log',array(),$strWhere);
									if(count($res_workinglog)>0){
										$stt = 1;
										foreach ($res_workinglog as $key => $value) {
											$masv = $value['masv'];
											$date = date('d-m-Y', $value['date']);
											$cdate = date('d-m-Y H:i', $value['cdate']);
											$author = $value['author'];

											echo '<tr class="header">';
											if($value['finish']==1){
												$hoanthanh = "<span class='cgreen'>Hoàn thành</span>";
												echo '<td></td>';
												echo '<td>'.$date.'</td>';
												echo '<td>'.$hoanthanh.'</td>';
												echo '<td>'.$author.'</td>';
											}else{
												$hoanthanh = "<span>Chưa hoàn thành</span>";
												echo '<td width="30" align="center"><a href="javascript:void(0)"><i class="fa fa-trash cred del_workinglog" dataid="'.$value['id'].'"></i></a></td>';
												echo '<td><div class="date" title="Sửa"><a href="javascript:void(0)" dataid="'.$value['id'].'" class="edit_workinglog">'.$date.'</a></div></td>';
												echo '<td>'.$hoanthanh.'</td>';
												echo '<td>'.$author.'</td>';
											}
											echo '</tr>';

											echo '<tr>
											<td colspan="4">
											<div class="noidung"><strong>Nội dung: </strong>'.$value['noidung'].'</div>
											<div class="Kết quả"><strong>Kết quả: </strong>'.$value['ketqua'].'</div>
											</td>
											</tr>';
											$stt++;
										}
									} else { echo '<tr><td align="center" colspan="8">Chưa có dữ liệu</td></tr>'; }
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".chuyen_lop").click(function(){
			var masv = $(this).attr('data-masv');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_chuyen_lop.php";
			$.post(url,{'masv': masv},function(req){
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
		$('.add_workinglog').click(function(){
			var url = "<?php echo ROOTHOST;?>ajaxs/student/frm_add_workinglog.php";
			$.post(url,{'ma_hoso': '<?php echo $ma_hoso;?>'},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-lg');
				$('#myModalPopup .modal-title').html('Thêm tương tác sinh viên');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		});

		$('.del_workinglog').click(function(){
			if(confirm("Bạn muốn xóa lịch sử tương tác này?")){
				var id = $(this).attr('dataid');
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_del_workinglog.php";
				$.post(url,{'id':id},function(req) {
					if(req=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
					else if(req=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
					else if(req==="success") {
						showMess("Xóa thông tin thành công!",""); 
						setTimeout(function(){ 
							window.location.reload(); 
						}, 1500);
					}
				})
			}
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

	function frm_status_sv(e){
		var _masv = e.getAttribute('data-masv');
		var _status_sv = e.getAttribute('data-status-sv');
		if(_masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_sv.php';
			var _data = {
				'masv' : _masv,
				'status_sv' : _status_sv
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật tình trạng học viên');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function frm_status_hocphi(e){
		var _masv = e.getAttribute('data-masv');
		var _status_hp = e.getAttribute('data-status-hp');
		if(_status_hp.length>0 && _masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_hocphi.php';
			var _data = {
				'masv' : _masv,
				'status_hp' : _status_hp
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật tình trạng học phí');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}

	function frm_status_call(e){
		var _masv = e.getAttribute('data-masv');
		var _status_call = e.getAttribute('data-status-call');
		if(_status_call.length>0 && _masv.length>0){
			var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_call.php';
			var _data = {
				'masv' : _masv,
				'status_call' : _status_call
			};
			$.post(_url, _data, function(res){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Cập nhật tình trạng cuộc gọi');
				$('#myModalPopup .modal-body').html(res);
				$('#myModalPopup').modal('show');
			})
		}
	}
</script>