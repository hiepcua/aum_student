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
$id_khoa = $id_he = $id_nganh=''; $id_dky = 0;
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
						<a href="javascript:void(0)" id="dk_nganh" class="btn btn-primary" dataid="<?php echo $ma;?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Đăng ký thêm ngành học</a>
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
									<th class="text-center">Phương thức XT</th>
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
										$i = $key+1;
										$id=$value['id'];
										$trungtuyen=$value['trungtuyen'];
										$nhaphoc=$value['nhaphoc'];
										$phuongthuc_XT = $value['xettuyen']==1 ? '<label class="label label-primary">Xét tuyển</label>' : '<label class="label label-primary">Thi tuyển</label>';

										$str='';
										$status=$value['status'];
										$dataid = $id;
										$hoso = $value['id_hoso'];
										if($status=='' || $status==null || $status=='TS1') 
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-default change_status">'.$STATUS_DKTS['TS1'].'</label>';
										elseif($status=='TS2') 
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-warning change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='TS3') 
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-info change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='TS4')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-primary change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='TS5')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-danger change_status">'.$STATUS_DKTS[$status].'</label>'; 
										elseif($status=='HS1')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-success change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='HS2')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-success change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='HS3')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-warning change_status">'.$STATUS_DKTS[$status].'</label>';
										elseif($status=='HS4')
											$str='<label dataid="'.$dataid.'" data-hoso="'.$hoso.'" class="label label-danger change_status">'.$STATUS_DKTS[$status].'</label>';
										if($id==null) 
											$str='<label class="label label-default">Hồ sơ chưa ĐK ngành</label>';

										echo '<tr dataid="'.$ma.'">';
										echo '<td align="center">'.$i.'</td>';
										echo '<td align="center"><a href="javascript:void(0)" data-hoso="'.$value['id_hoso'].'" data-nganh="'.$value['id_nganh'].'" class="xoa_nganh cred">Xóa</a></td>';
										echo '<td align="center">'.$_KHOA['K'.$value['id_khoa']].'</td>';
										echo '<td align="center">'.$_HE['H'.$value['id_he']].'</td>';
										echo '<td align="center">'.$_NGANH['N'.$value['id_nganh']].'</td>';
										echo '<td align="center">'.$value['masv'].'</td>';


										echo '<td align="center">';

										if($value['malop']!="") {
											echo $value['malop'];
										}else {
											echo '<a href="javascript:void(0)" class="btn btn-default btn_nhaplop" dataid="'.$value['id_hoso'].'" dataids="'.$value['id'].'-'.$value['id_khoa'].'-'.$value['id_he'].'-'.$value['id_nganh'].'">Nhập lớp</a>';
										}
										echo '</td>';

										echo '<td align="center">'.$phuongthuc_XT.'</td>';
										echo '<td align="center">'.$str.'</td>';

										if(in_array($status, array('HS1','HS2','HS3'))){
											echo '<td align="center"><a href="javascript:void(0)" dataid="'.$value['id_hoso'].'" class="chuyen_lop label label-primary">Chuyển lớp</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/diem/'.$value['id_hoso'].'" dataid="'.$value['id_hoso'].'" class="label label-primary">Kết quả học tập</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/hocphi/'.$value['id_hoso'].'" target="_blank" class="label label-primary">Ql học phí</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'?com=student&task=qlhoctap&manganh='.$value['id_nganh'].'&malop='.$value['malop'].'&masv='.$value['masv'].'" target="_blank" class="label label-primary">Ql học tập</a></td>';
										}elseif(in_array($status, array('TS1','TS2','TS3','TS4','TS5'))){
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
											echo '<td></td>';
										}elseif(in_array($status, array('HS4'))){
											echo '<td></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/diem/'.$value['id_hoso'].'" dataid="'.$value['id_hoso'].'" class="label label-primary">Kết quả học tập</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'student/hocphi/'.$value['id_hoso'].'" target="_blank" class="label label-primary">Ql học phí</a></td>';
											echo '<td align="center"><a href="'.ROOTHOST.'?com=student&task=qlhoctap&manganh='.$value['id_nganh'].'&malop='.$value['malop'].'&masv='.$value['masv'].'" target="_blank" class="label label-primary">Ql học tập</a></td>';
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
</div>

<script>
	$(document).ready(function(){
		$(".chuyen_lop").click(function(){
			var id_hoso = $(this).attr('dataid');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_chuyen_lop.php";
			$.post(url,{'ma':id_hoso},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-dialog').addClass('modal-sm');
				$('#myModalPopup .modal-title').html('Thông tin chuyển lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});

		$('#dk_nganh').click(function(){
			var id_hoso = $(this).attr('dataid');
			frm_dangky(id_hoso);
		});

		$('.xoa_nganh').click(function(){
			var id_hoso = $(this).attr('data-hoso');
			var id_nganh = $(this).attr('data-nganh');
			xoa_nganh(id_hoso, id_nganh);
		});

		$('.change_status').click(function(){
			var id = $(this).attr('dataid');
			var id_hoso = $(this).attr('data-hoso');
			frm_status(id, id_hoso);
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

	$(".edit_qhgd").click(function(){
		var ma = "<?php echo $ma;?>";
		var row_id = $(this).attr('dataid'); 
		var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_qhgd.php";
		$.post(url,{'ma':ma,'row_id':row_id},function(req){
			$("#tab1").html(req);
		})
	})

	function tongdiem() {
		var mon1 = $("#mon1").val()!='' ? parseFloat($("#mon1").val()) : 0;
		var mon2 = $("#mon2").val()!='' ? parseFloat($("#mon2").val()) : 0;
		var mon3 = $("#mon3").val()!='' ? parseFloat($("#mon3").val()) : 0;
		var tong = mon1 + mon2 + mon3;
		$("#tong_diem").val(tong);
	}
	function checkinput(){
		var ma_nganh = $("#ma_nganh").val();
		var bac = $("#cbobac").val();
		var khoa = $("#cbokhoa").val();

		if($("#hoten").val()=="") {
			$("#hoten").focus();
			$("#hoten").addClass('novalid');
			return false;
		}else $("#hoten").removeClass('novalid');
		if($("#ngaysinh").val()=="") {
			$("#ngaysinh").focus();
			$("#ngaysinh").addClass('novalid');
			return false;
		}else $("#ngaysinh").removeClass('novalid');
		if($("#noisinh").val()=="") {
			$("#noisinh").focus();
			$("#noisinh").addClass('novalid');
			return false;
		}else $("#noisinh").removeClass('novalid');
		if($("#nguyenquan").val()=="") {
			$("#nguyenquan").focus();
			$("#nguyenquan").addClass('novalid');
			return false;
		}else $("#nguyenquan").removeClass('novalid');
		if($("#hokhau").val()=="") {
			$("#hokhau").focus();
			$("#hokhau").addClass('novalid');
			return false;
		}else $("#hokhau").removeClass('novalid');

		if(khoa=="") {
			$("#cbokhoa").focus();
			$("#cbokhoa").addClass('novalid');
			return false;
		}else $("#cbokhoa").removeClass('novalid');
		if(bac=="") {
			$("#cbobac").focus();
			$("#cbobac").addClass('novalid');
			return false;
		}else $("#cbobac").removeClass('novalid');
		if(ma_nganh=="") {
			$("#ma_nganh").focus();
			$("#ma_nganh").addClass('novalid');
			return false;
		}else $("#ma_nganh").removeClass('novalid');
		return true;
	}

	function frm_dangky(id_hoso){
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

	/* Checkbox dm ho so */
	function HSCheckAll(status){
		console.log('status='+status);
		$(".chk_hoso").each(function(){
			$(this).prop('checked',status);
		})
		HsoIDChecked();
	}
	function HSCheckOnce(){
		var flag=true;
		$(".chk_hoso").each(function(){
			if($(this).prop("checked")!=true) {
				flag=false;
			}
		})
		$("#chkall_hoso").prop('checked',flag);
		HsoIDChecked();
	}
	function HsoIDChecked(){
		var strids='';
		$(".chk_hoso").each(function(){
			if($(this).prop("checked")==true){
				strids+=$(this).attr('dataid')+",";
			}
		})
		$("#dmhoso_ids").val(strids);
	}

	function xoa_nganh(id_hoso, id_nganh){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/process_del_nganh.php',
		_data = {
			'hoso': id_hoso,
			'nganh': id_nganh,
		};

		if(id_hoso.length == 0 ||id_nganh.length == 0){
			showMess('Không xóa được, do thiếu dữ liệu', 'error');
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