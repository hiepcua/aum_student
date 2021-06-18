<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$obj = new CLS_MYSQL; 
$_masv = addslashes(strip_tags(htmlentities($_GET['id']))); // masv

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

//---------------------------------------
$sql = "SELECT a.*,b.ho_dem,b.name,b.gioitinh,b.ngaysinh
FROM tbl_dangky_tuyensinh AS a 
INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma
WHERE a.masv='$_masv'";
$obj->Query($sql);
$r_ts = $obj->Fetch_Assoc();
$fullname = $r_ts['ho_dem'].' '.$r_ts['name'];
$gender = $r_ts['gioitinh']=='nam' ? 'Nam' : 'Nữ';
$ngaysinh = date("Y-m-d",$r_ts['ngaysinh']);

$id_he = $r_ts['id_he'];
$id_nganh = $r_ts['id_nganh'];
$masv = $r_ts['masv'];
$ten_khoa = $r_ts['id_khoa']!=='' ? $KHOA[$r_ts['id_khoa']]['name'] : '';
$ten_nganh = $r_ts['id_nganh']!=='' ? $NGANH[$r_ts['id_nganh']]['name'] : '';
$ten_he = $r_ts['id_he']!=='' ? $HE[$r_ts['id_he']]['name'] : '';

$html .='<div class="page-bar">
<div class="page-title-breadcrumb">
<div class="page-title">BẢNG ĐIỂM</div>
</div>
</div>';
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">BẢNG ĐIỂM</div>
			</div>
			<ul class="box-function pull-right">
				<li><button type="button" class="btn btn-warning btn-print"  title="In bảng điểm"><i class="fa fa-print"></i> In</button></li>
				<li><a href="<?php echo ROOTHOST;?>student" class="btn btn-default btn-close" title="Thoát"><i class="fa fa-reply"></i> Thoát</a></li>
			</ul>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="panel-body">
			<div class="col-md-6 col-xs-12">
				<div class="row form-group">
					<div class="col-md-3 col-xs-4 text">Mã sinh viên</div>
					<div class="col-md-9 col-xs-8"><?php echo $masv;?></div>
				</div><div class="row form-group">
					<div class="col-md-3 col-xs-4 text">Họ và tên</div>
					<div class="col-md-9 col-xs-8"><?php echo $fullname;?></div>
				</div><div class="row form-group">
					<div class="col-md-3 col-xs-4 text">Ngày sinh</div>
					<div class="col-md-9 col-xs-8"><?php echo $ngaysinh;?></div>
				</div><div class="row form-group">	
					<div class="col-md-3 col-xs-4 text">Giới tính</div>
					<div class="col-md-9 col-xs-8"><?php echo $gender;?></div>
				</div>
			</div>

			<div class="col-md-6 col-xs-12">
				<div class="row form-group">
					<div class="col-md-3 col-xs-4 text">Khóa</div>
					<div class="col-md-9 col-xs-8"><?php echo $ten_khoa;?></div>
				</div><div class="row form-group">
					<div class="col-md-3 col-xs-4 text">Ngành</div>
					<div class="col-md-9 col-xs-8"><?php echo $ten_nganh;?></div>
				</div><div class="row form-group">
					<div class="col-md-3 col-xs-4 text">Bậc đào tạo</div>
					<div class="col-md-9 col-xs-8"><?php echo $ten_he;?></div>
				</div>
			</div>
		</div>
	</div>

	<?php $html.='
	<table class="table" style="width:100%">
	<tr><td width="100">Mã sinh viên</td><td>'.$masv.'</td>
	<td width="100">Khóa</td><td>'.$ten_khoa.'</td>
	</tr>
	<tr><td>Họ và tên</td><td>'.$fullname.'</td>
	<td>Ngành</td><td>'.$ten_nganh.'</td>
	</tr>
	<tr><td>Ngày sinh</td><td>'.$ngaysinh.'</td>
	<td>Bậc đào tạo</td><td>'.$ten_he.'</td>
	</tr>
	<tr><td>Giới tính</td><td>'.$gender.'</td>
	<td></td><td></td>
	</tr>
	</table>
	<table class="table table-bordered" id="tbl_hocphan">
	<thead><tr> 
	<thwidth="30" >STT</th>
	<th>Môn học</th>
	<th>Tín chỉ</th>
	<th>chuyên cần</th>
	<th>Kiểm tra</th>
	<th>Thi</th>
	<th>Thi lại</th>
	<th>Cập nhật gần nhất</th>
	<th>Đạt/ không đạt</th>
	</tr>
	</thead>
	<tbody>'; ?>
	<div class="clearfix">
		<table class="table table-bordered" id="tbl_hocphan">
			<thead>
				<tr> 
					<th width="30">STT</th>
					<th>Môn học</th>
					<th class="text-center">Tín chỉ</th>
					<th class="text-center">chuyên cần</th>
					<th class="text-center">Kiểm tra</th>
					<th class="text-center">Thi</th>
					<th class="text-center">Thi lại</th>
					<th class="text-center">Note</th>
					<th class="text-center">Ngày cập nhật điểm</th>
					<th class="text-center">Trạng thái</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql="SELECT * FROM tbl_monhoc";
				$obj->Query($sql);
				$arrMon=array();
				while($r=$obj->Fetch_Assoc()){
					$arrMon[$r['id']]=$r;
				}

				$sql="SELECT * FROM tbl_hocphan_khung WHERE id_he='$id_he' AND id_nganh='$id_nganh'";
				$obj->Query($sql); 
				$arrHP = array(); $hocky='';
				while($r=$obj->Fetch_Assoc()) $arrHP=$r;

				$sql="SELECT id as id_ht,masv,tinchi,id_monhoc,diem,ketqua,ketqua2,hoclai,status,mdate
				FROM tbl_hoctap
				WHERE masv='$masv' ORDER BY id_monhoc ASC, id_ht desc";

				$obj->Query($sql); $stt=0; $ids='';$tinchi=1;
				while($r=$obj->Fetch_Assoc()){ $stt++;
					$id_ht=$r['id_ht']; $ids.=$id_ht.",";
					$tinchi=$r['tinchi'];
					$diem = json_decode($r['diem'],true); $status = $r['status'];
					$kq=$r['ketqua']; $kq2=$r['ketqua2'];

					$txt_status = '';
					if($r['status']!==null) { 
						/* Chỉ xét khi đã có kết quả Đạt/không đạt*/
						$diem_pass = $arrHP['total'];
						switch($r['status']){
							case 'HT01': 
							$html_status="<a class='label other' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Chưa học</a>"; 
							$txt_status = 'Chưa học';
							break;
							case 'HT02': 
							$html_status="<a class='label label-success' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Đang học</a>"; 
							$txt_status = 'Đang học';
							break;
							case 'HT03': 
							$html_status="<a class='label label-success' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Đang thi</a>"; 
							$txt_status = 'Đang thi';
							break;
							case 'HT04': 
							$html_status="<a class='label label-warning' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Không đạt</a>"; 
							$txt_status = 'Không đạt';
							break;
							case 'HT05': 
							$html_status="<a class='label label-success' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Đạt</a>"; 
							$txt_status = 'Đạt';
							break;
							case 'HT06': 
							$html_status="<a class='label label-danger' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Thi lại</a>"; 
							$txt_status = 'Thi lại';
							break;
							default: 
							$html_status="<a class='label other' data-id='".$id_ht."' data-status='".$status."' onclick='frm_status_hoctap(this)'>Chưa học</a>"; 
							$txt_status = 'Chưa học';
							break;
						}
					}
					?>
					<tr dataid="<?php echo $id_ht;?>" datama="<?php echo $r['masv'];?>" datamon="<?php echo $r['id_monhoc'];?>">
						<td align="center"><?php echo $stt;?></td>
						<td><?php echo $arrMon[$r['id_monhoc']]['name'];?></td>

						<td align="center"><?php echo $r['tinchi'];?></td>
						<td align="center">
							<?php if($r['status']!=-1) {
								if(isset($diem['chuyencan'])) echo $diem['chuyencan']; 
							} ?>
						</td>
						<td align="center">
							<?php if($r['status']!=-1) {
								if(isset($diem['diemkt'])) echo $diem['diemkt']; 
							} ?>
						</td>
						<td align="center">
							<?php if($r['status']!=-1) {
								if(isset($diem['diemthi'])) echo $diem['diemthi']; 
							} ?>
						</td>
						<td></td>
						<td align="center">
							<a dataid='<?php echo $id_ht;?>' title='Note' class="btn_readNote">
								<i class="fa fa-commenting-o" aria-hidden="true"> 
									<span class='label_number' id='id_<?php echo $id_ht;?>'>0</span>
								</i>
							</a>
						</td>
						<td align="center"><?php if($r['mdate']!='') echo date("d/m/y H:i",$r['mdate']);?></td>
						<td align="center"><?php echo $html_status;?></td>
					</tr>
					<?php 
					$html.='<tr>
					<td align="center">'.$stt.'</td>
					<td>'.$arrMon[$r['id_monhoc']]['name'].'</td>
					<td align="center">'.$r['tinchi'].'</td>
					<td align="center">';
					if($r['status']!=-1) 
						if(isset($diem['chuyencan'])) $html.=$diem['chuyencan']; 
					$html.='</td><td align="center">';
					if($r['status']!=-1)
						if(isset($diem['diemkt'])) $html.=$diem['diemkt']; 
					$html.='</td><td align="center">';
					if($r['status']!=-1)
						if(isset($diem['diemthi']))$html.=$diem['diemthi']; 
					$html.='</td><td align="center">';
					if($r['mdate']!='') $html.=date("d/m/y H:i",$r['mdate']);
					$html.='</td>
					<td align="center">'.$txt_status.'</td>
					</tr>';
				} 
				$html.='</tbody></table>';?>
			</tbody>
		</table>
		<div class="clearfix"></div>
	</div>
</div>
<div id="divToPrint" style="display:none;"><?php echo $html; ?></div>
<script>
// get all note count
$.get('<?php echo ROOTHOST;?>ajaxs/hoctap/count_note.php',function(req){
	var object=JSON.parse(req);
	for(key in object){
		$('#'+key).html(object[key].num);
	}
})
// read note hoctap
$('.btn_readNote').click(function(){
	var ht_id=$(this).attr('dataid');
	$.get('<?php echo ROOTHOST;?>ajaxs/hoctap/get_note.php',{'ht_id':ht_id},function(req){
		$('#myModalPopup .modal-dialog').removeClass('modal-lg');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-title').html('Ghi chú');
		$('#myModalPopup .modal-body').html(req);
		$('#myModalPopup').modal('show');
	});
});
$(".btn-print").click(function(){
	showLoading();
	var screenW =screen.width;
	var screenH =screen.height; console.log(screenW+' / '+screenH);
	var divToPrint = document.getElementById('divToPrint');
	var popupWin = window.open('', '_blank','toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width='+screenW+',height='+screenH);
	popupWin.document.open();
	popupWin.document.write('<html><head><title><?php global $conf; echo $conf['title'];?></title>');
	popupWin.document.write('</head><body onload="window.print();">');
	popupWin.document.write(divToPrint.innerHTML);
	popupWin.document.write('</body></html>');
	popupWin.document.close();
	hideLoading();
});

function frm_status_hoctap(e){
	var _id = e.getAttribute('data-id');
	var _status = e.getAttribute('data-status');
	if(_status.length>0 && _id.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/hoctap/frm_status_hoctap.php';
		var _data = {
			'id' : _id,
			'status' : _status,
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật trạng thái học tập');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}
}
</script>