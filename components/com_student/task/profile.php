<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma = addslashes(strip_tags(htmlentities($_GET['id'])));

if(isset($_SESSION["SV$ma"]['TAB_QHGD'])) unset($_SESSION["SV$ma"]['TAB_QHGD']);
if(isset($_SESSION["SV$ma"]['TAB_QHHT'])) unset($_SESSION["SV$ma"]['TAB_QHHT']);
if(isset($_SESSION["SV$ma"]['TAB_QHHOC'])) unset($_SESSION["SV$ma"]['TAB_QHHOC']);
if(isset($_SESSION["SV$ma"]['TAB_KHENTHUONG'])) unset($_SESSION["SV$ma"]['TAB_KHENTHUONG']);
if(isset($_SESSION["SV$ma"]['TAB_KYLUAT'])) unset($_SESSION["SV$ma"]['TAB_KYLUAT']);

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

$objhs = new CLS_HS;
$objhs->getList(" AND ma='$ma'");
$r=$objhs->Fetch_Assoc();
$dmhoso = ($r['dmhoso']!==null && $r['dmhoso']!=='') ? json_decode($r['dmhoso'],true) : array();
$dmhoso_ids='';
if(count($dmhoso)>0) {
	foreach($dmhoso as $k=>$v){
		if($v['status']==1)
			$dmhoso_ids.=$v['id'].",";
	}
}
$_SESSION["SV$ma"]['TAB_QHGD'] = json_decode($r['qhgiadinh'],true);
$_SESSION["SV$ma"]['TAB_QTHT'] = json_decode($r['qthoctap'],true);
$_SESSION["SV$ma"]['TAB_QHHOC'] = json_decode($r['qthoc'],true);
$_SESSION["SV$ma"]['TAB_KHENTHUONG'] = json_decode($r['khenthuong'],true);
$_SESSION["SV$ma"]['TAB_KYLUAT'] = json_decode($r['kyluat'],true);

$objts = new CLS_TUYENSINH;
$objts->getList(" AND id_hoso='$ma' ");
$id_khoa = $id_he = $id_nganh=''; $id_dky = 0;$_id_hoso = $ma;
$masv = $ptxt = $diadiem = $sbd = '';
$mon1 = $mon2 = $mon3 = '';$id_dky=$tongdiem=0;
$readonly = "";
if($objts->Num_rows()>0) {
	$row=$objts->Fetch_Assoc();
	$masv = $row['masv'];
	$id_khoa = $row['id_khoa'];
	$id_he 	= $row['id_he'];
	$id_nganh = $row['id_nganh'];
	$ptxt = $row['xettuyen']; 
	$diadiem = $row['diadiemhoc'];
	$id_dky = $row['id'];
	$sbd = $row['sbd'];
	$mon1 = $row['mon1'];
	$mon2 = $row['mon2'];
	$mon3 = $row['mon3'];
	$tongdiem=(float)($mon1+$mon2+$mon3);
	if($row['trungtuyen']!=null) $readonly=" readonly";
} ?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul><li class="active"><a href="<?php echo ROOTHOST;?>student/profile/<?php echo $ma;?>">
					Hồ sơ</a></li></ul>
				</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>student" class="btn btn-default btn-close" title="Quay lại"><i class="fa fa-reply"></i> Quay lại</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="card-block">
				<div class="media">
					<div class="row">
						<div class="col-md-3 col-xs-12">
							<div class="col-md-12 col-xs-4 text-center">
								<div class="avatar"></div>
								<input type="file" id="FileUpload" style="display: none" accept="image/*"/>
							</div>
						</div>
						<div class="col-md-9 col-xs-12">
							<div class="row form-group">
								<div class="col-md-2 col-xs-4 text">ID</div>
								<div class="col-md-4 col-xs-8">
									<input type="number" name="ma" id="" class="form-control" value="<?php echo $r['ma'];?>" readonly>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-2 col-xs-4 text">Họ và tên</div>
								<div class="col-md-4 col-xs-8">
									<input type="text" name="hoten" id="hoten" class="form-control" value="<?php echo $r['ho_dem'].' '.$r['name'];?>" readonly>
								</div>
								<div class="col-md-2 col-xs-4 text">Giới tính</div>
								<div class="col-md-4 col-xs-8"><fieldset id="group1">
									<input type="radio" name="gender" value="0" <?php if($r['gioitinh']==0) echo 'checked';?>> 
									<?php echo $GLOBALS['ARR_GENDER'][0];?>
									<input type="radio" name="gender" value="1" <?php if($r['gioitinh']==1) echo 'checked';?>> 
									<?php echo $GLOBALS['ARR_GENDER'][1];?>
								</fieldset></div>
							</div>
							<div class="row form-group">
								<div class="col-md-2 col-xs-4 text">Tên thường gọi</div>
								<div class="col-md-4 col-xs-8">
									<input type="text" name="tengoi" id="tengoi" class="form-control" value="<?php echo $r['nickname'];?>" readonly>
								</div>
								<div class="col-md-2 col-xs-4 text">Quốc tịch</div>
								<div class="col-md-4 col-xs-8">
									<input type="text" name="quoctich" id="quoctich" class="form-control" value="<?php echo $r['quoctich'];?>" readonly>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-2 col-xs-4 text">Ngày sinh</div>
								<div class="col-md-4 col-xs-8">
									<input type="date" name="ngaysinh" id="ngaysinh" class="form-control" value="<?php echo date("Y-m-d",$r['ngaysinh']);?>" readonly  placeholder="tháng/ngày/năm">
								</div>
								<div class="col-md-2 col-xs-4 text">Nơi sinh</div>
								<div class="col-md-4 col-xs-8">
									<input type="text" name="noisinh" id="noisinh" class="form-control" value="<?php echo $r['noisinh'];?>" readonly>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-2 col-xs-4 text">Nguyên quán</div>
								<div class="col-md-4 col-xs-8">
									<input type="text" name="nguyenquan" id="nguyenquan" class="form-control" value="<?php echo $r['nguyenquan'];?>" readonly>
								</div>
								<div class="col-md-2 col-xs-4 text">Hộ khẩu</div>
								<div class="col-md-4 col-xs-8">
									<input type="text" name="hokhau" id="hokhau" class="form-control" value="<?php echo $r['hktt'];?>" readonly>
								</div>
							</div><br>
							<div class="form-group text-center">
								<a href="<?php echo ROOTHOST.'student/soyeulylich/'.$r['ma'];?>" class="btn btn-primary">Xem chi tiết sơ yếu lý lịch >></a>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="page-bar" style="margin-bottom: 10px;">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul>
						<li class="active">Danh sách ngành đăng ký</li>
						<a href="javascript:void(0)" id="dk_nganh" class="btn btn-primary" dataid="<?php echo $masv;?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Đăng ký thêm ngành học</a>
					</ul>

				</div>
			</div>
		</div>
	</div>
	<section class="card" style="position: unset;">
		<div class="card-body">
			<div class="card-block">
				<div class="media">
					<div id="list_profile" class="table-responsive">
						<table class="list table table-striped table-bordered">
							<thead>
								<tr class="header">
									<th class="text-center">STT</th>
									<th class="text-center"></th>
									<th class="text-center">Khóa</th>
									<th class="text-center">Bậc</th>
									<th class="text-center">Ngành</th>
									<th class="text-center">Mã SV</th>
									<th class="text-center">Lớp</th>
									<th class="text-center">Trạng thái</th>
									<th class="text-center"></th>
									<th class="text-center"></th>
									<th class="text-center"></th>
									<th class="text-center"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$res_nganhdk = SysGetList('tbl_dangky_tuyensinh',array(),'AND id_hoso="'.$ma.'"');
								if(count($res_nganhdk)>0){
									foreach ($res_nganhdk as $key => $value) {
										$i = $key+1; $id=$value['id']; $str='';
										$status=$value['status'];
										$dataid = $id;
										$hoso = $value['id_hoso'];
										if($status=='' || $status==null || $status=='L0') 
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-default change_status">'.$STATUS_DKTS['L0'].'</label>';
										elseif($status=='L1') 
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-info change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='L2') 
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-info change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='L3')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-info change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='L4')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-warning change_status">'.$STATUS_DKTS[$status].'</label>'; 
										elseif($status=='L5')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-warning change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='L8')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-success change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='L9A')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-warning change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='L9B')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-danger change_status">'.$STATUS_DKTS[$status].'</label>';

										echo '<tr dataid="'.$ma.'">';
										echo '<td align="center">'.$i.'</td>';
										echo '<td align="center"><a href="javascript:void(0)" data-id_dkts="'.$value['id'].'" class="xoa_nganh cred">Xóa</a></td>';

										echo '<td align="center">';
										if(strlen($value['id_khoa'])>0) echo $_KHOA['K'.$value['id_khoa']];
										echo '</td>';

										echo '<td align="center">';
										if(strlen($value['id_he'])>0) echo $_HE['H'.$value['id_he']];
										echo '</td>';

										echo '<td align="center">';
										if(strlen($value['id_nganh'])>0) echo $_NGANH['N'.$value['id_nganh']];
										else{
											echo '<button class="dk_nganh btn btn-default" dataid="'.$value['id_hoso'].'" dataid-dkts="'.$value['id'].'"><i class="fa fa-plus cgray"></i> Đăng ký</button>';
										}
										echo '</td>';

										echo '<td align="center">'.$value['masv'].'</td>';
										echo '<td align="center">';
										if($value['malop']!="") {
											echo $value['malop'];
										}else {
											echo '<a href="javascript:void(0)" class="btn btn-default btn_nhaplop" dataid="'.$value['id_hoso'].'" dataids="'.$value['id'].'-'.$value['id_khoa'].'-'.$value['id_he'].'-'.$value['id_nganh'].'">Nhập lớp</a>';
										}
										echo '</td>';

										echo '<td align="center">'.$str.'</td>';

										if(in_array($status, array('L2','L3','L4','L5'))){
											echo '<td align="center"><a href="javascript:void(0)" dataids="'.$value['id'].'-'.$value['id_khoa'].'-'.$value['id_he'].'-'.$value['id_nganh'].'" class="chuyen_lop label label-primary">Chuyển lớp</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/diem/'.$value['masv'].'" class="label label-primary">Kết quả học tập</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/hocphi/'.$value['masv'].'" target="_blank" class="label label-primary">Ql học phí</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'?com=student&task=qlhoctap&manganh='.$value['id_nganh'].'&malop='.$value['malop'].'&masv='.$value['masv'].'" target="_blank" class="label label-primary">Ql học tập</a></td>';
										}elseif(in_array($status, array('L0','L1'))){
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
										}elseif(in_array($status, array('L8','L9A','L9B'))){
											echo '<td></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/diem/'.$value['id_hoso'].'" dataid="'.$value['masv'].'" class="label label-primary">Kết quả học tập</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/hocphi/'.$value['masv'].'" target="_blank" class="label label-primary">Ql học phí</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'?com=student&task=qlhoctap&manganh='.$value['id_nganh'].'&malop='.$value['malop'].'&masv='.$value['masv'].'" target="_blank" class="label label-primary">Ql học tập</a></td>';
										}else{
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
										}
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

	<!-- Card lịch sử tương tác -->
	<?php $sql=''; ?>
	<div class="page-bar" style="margin-bottom: 10px;">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul>
						<li class="active">Lịch sử tương tác</li>
					</ul>
				</div>
			</div>
			<div class="col-md-2" style="margin-top: 12px;">
				<form name="frm_search" id="frm_search" method="get" action="">
					<select id="cbo_masv" name="cbo_masv" class="form-control">
						<option value="">Tất cả</option>
						<?php
						$cbo_masv = isset($_GET['cbo_masv']) && $_GET['cbo_masv']!=='' ? antiData($_GET['cbo_masv']) : '';
						if($cbo_masv!==''){
							$sql.=' AND masv="'.$cbo_masv.'"';
						}
						if(count($res_nganhdk)>0){
							foreach ($res_nganhdk as $key => $value) {
								echo '<option value="'.$value['masv'].'">'.$value['masv'].'</option>';
							}
						}
						?>
					</select>
					<script type="text/javascript">
						$(document).ready(function(){
							cbo_Selected('cbo_masv', '<?php echo $cbo_masv;?>');
						});
					</script>
				</form>
			</div>
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
									<th class="text-center">STT</th>
									<th class="text-center">Mã HS</th>
									<th class="text-center">Mã SV</th>
									<th class="text-center">Ngày</th>
									<th>Nội dung tương tác</th>
									<th class="text-center">Kết quả</th>
									<th class="text-center">Ngày cập nhật</th>
									<th class="text-center">Hoàn thành</th>
									<th class="text-center">Sửa</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql.=' AND id_hoso="'.$_id_hoso.'"';
								$MAX_ROWS = 50;
								$total_rows = SysCount('tbl_working_log', $sql);
								$max_pages = ceil($total_rows/$MAX_ROWS);
								$cur_page = getCurentPage($max_pages);
								$start = ($cur_page - 1) * $MAX_ROWS;
								$limit = ' LIMIT '.$start.','. $MAX_ROWS;
								$sql.=' ORDER BY finish ASC, `date` DESC'.$limit;

								$res_workinglog = SysGetList('tbl_working_log',array(),$sql);
								if(count($res_workinglog)>0){
									foreach ($res_workinglog as $key => $value) {
										$i = $key+1;
										$masv = $value['masv'];
										$id_hoso = $value['id_hoso'];
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
										echo '<td align="center">'.$i.'</td>';
										echo '<td align="center">'.$id_hoso.'</td>';
										echo '<td align="center">'.$masv.'</td>';
										echo '<td align="center">'.$date.'</td>';
										echo '<td>'.$value['noidung'].'</td>';
										echo '<td align="center">'.$value['ketqua'].'</td>';
										echo '<td align="center">'.$cdate.'</td>';
										echo '<td align="center">'.$finish.'</td>';
										echo '<td align="center">'.$edit.'</td>';
										echo '</tr>';
									}
								}
								?>
							</tbody>
						</table>

						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
							<tr><td align="center">
								<?php paging($total_rows,$MAX_ROWS,$cur_page); ?>
							</td></tr>
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
				$('#myModalPopup .modal-dialog').removeClass('modal-lg, modal-sm');
				$('#myModalPopup .modal-dialog').addClass('modal-md');
				$('#myModalPopup .modal-title').html('Thông tin chuyển lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});

		$('#dk_nganh').click(function(){
			var id_hoso = $(this).attr('dataid');
			frm_dangky_nganh_moi(id_hoso);
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

	function frm_dangky_nganh_moi(id_hoso){
		if(id_hoso.length>0){
			var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/dangky.php";
			$.post(url,{'ma':id_hoso},function(req){
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