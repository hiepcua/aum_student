<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$obj = new CLS_MYSQL; 
$_masv = addslashes(strip_tags(htmlentities($_GET['id']))); // masv

//---------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH['N'.$r['id']]=$r['name'];
}

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
$sql = "SELECT a.*,b.ho_dem,b.name,b.gioitinh,b.ngaysinh
FROM tbl_dangky_tuyensinh AS a 
INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma
WHERE a.masv='$_masv'";
$obj->Query($sql);
$r_ts = $obj->Fetch_Assoc();
$fullname = $r_ts['ho_dem'].' '.$r_ts['name'];
$gender = $GLOBALS['ARR_GENDER'][$r_ts['gioitinh']];
$ngaysinh = date("Y-m-d",$r_ts['ngaysinh']);

$id_he = $r_ts['id_he'];
$id_nganh = $r_ts['id_nganh'];
$masv = $r_ts['masv'];
$ten_khoa = $_KHOA['K'.$r_ts['id_khoa']];
$ten_nganh = $_NGANH['N'.$r_ts['id_nganh']];
$ten_he = $_HE['H'.$r_ts['id_he']];

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
	<th width="30" rowspan="2">STT</th>
	<th rowspan="2">Môn học</th>
	<th rowspan="2">Tín chỉ</th>
	<th rowspan="2">chuyên cần</th>
	<th rowspan="2">Kiểm tra</th>
	<th rowspan="2">Thi</th>
	<th rowspan="2">Thi lại</th>
	<th rowspan="2">Cập nhật gần nhất</th>
	<th colspan="3">Thang điểm</th>
	<th rowspan="2">Đạt/ không đạt</th>
	<th rowspan="2">Xếp loại</th>
	</tr>
	<tr><th>10</th><th>Chữ</th><th>4</th></tr>
	</thead>
	<tbody>'; ?>
	<div class="clearfix">
		<table class="table table-bordered" id="tbl_hocphan">
			<thead>
				<tr> 
					<th width="30" rowspan="2">STT</th>
					<th rowspan="2">Môn học</th>
					<th rowspan="2">Tín chỉ</th>
					<th rowspan="2">chuyên cần</th>
					<th rowspan="2">Kiểm tra</th>
					<th rowspan="2">Thi</th>
					<th rowspan="2">Thi lại</th>
					<th rowspan="2">Note</th>
					<th rowspan="2">ngày cập nhật</th>
					<th colspan="3">Thang điểm</th>
					<th rowspan="2">Trạng thái</th>
					<th rowspan="2">Xếp loại</th>
				</tr>
				<tr><th>10</th><th>Chữ</th><th>4</th></tr>
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
					$kq_chu=$kq_4=$xeploai=''; $diem_pass=4;
					if($r['status']!=-1) { /*Chỉ xét khi đã có kết quả Đạt/không đạt*/
						$diem_pass = $arrHP['total'];
						if($kq2!==null && $kq2!=='') $kq=$kq2;	
						if ($kq!==null && $kq!=='') {			
							if($kq>=8.5 && $kq<=10){ $kq_chu='A'; $kq_4="4"; $xeploai="Giỏi";}
							if($kq>=7.0 && $kq<8.5){ $kq_chu='B'; $kq_4="3"; $xeploai="Khá"; }
							if($kq>=5.5 && $kq<7.0){ $kq_chu='C'; $kq_4="2"; $xeploai="TB"; }
							if($kq>=4.0 && $kq<5.5){ $kq_chu='D'; $kq_4="1"; $xeploai="TB yếu"; }
							if($kq>=0 && $kq<4.0){ $kq_chu='F'; $kq_4="0"; $xeploai="Kém"; }
							if($kq<$diem_pass) $kq="<span class='red'>$kq</span>";
						}else { 
							$kq_chu='F'; $kq_4="0"; $xeploai="Kém";
						} 
						switch($r['status']){
							case '0':$status="<label class='label label-danger'>Không Đạt</label>"; break;
							case '1':$status="<label class='label label-success'>Đạt</label>"; break;
							case '2':$status="<label class='label label-warning'>Thi lại</label>"; break;
							case '3':$status="<label class='label label-warning'>Thi cải thiện</label>"; break;
							case '4':$status="<label class='label label-danger'>Học lại</label>"; break;
							case '5':$status="<label class='label label-danger'>Học cải thiện</label>"; break;
						} 
					}?>
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
						<td align="center"><?php echo $kq;?></td>
						<td align="center"><?php echo $kq_chu;?></td>
						<td align="center"><?php echo $kq_4;?></td>
						<td align="center"><?php echo $status;?></td>
						<td align="center"><?php echo $xeploai;?></td>
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
					$html.='</td><td></td><td align="center">';
					if($r['mdate']!='') $html.=date("d/m/y H:i",$r['mdate']);
					$html.='</td>
					<td align="center">'.$kq.'</td>
					<td align="center">'.$kq_chu.'</td>
					<td align="center">'.$kq_4.'</td>
					<td align="center">'.$status.'</td>
					<td align="center">'.$xeploai.'</td>
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
})
</script>