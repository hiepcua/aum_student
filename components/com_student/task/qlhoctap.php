<?php
defined('ISHOME') or die("You can't access this page!");
$check_permission = $UserLogin->Permission('sv_qlhoctap');
if($check_permission==false) die($GLOBALS['MSG_PERMIS']);

$id_he=$id_nganh=$id_khoa=$id_lop=$id_partner=$id_mon=$diem='';
//print_r($_GET);

if(isset($_GET['manganh']) && $_GET['manganh']!==''){
	$_SESSION['THIS_NGANH'] = addslashes(strip_tags($_GET['manganh']));
}
$id_khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$id_he 		= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$id_nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$id_lop 	= isset($_GET['malop'])?addslashes(strip_tags($_GET['malop'])):'';
$id_mon 	= isset($_GET['mamon'])?addslashes(strip_tags($_GET['mamon'])):'';
$id_hoso 	= isset($_GET['mahoso'])?addslashes(strip_tags($_GET['mahoso'])):'';
$masv 		= isset($_GET['masv']) && $_GET['masv'] !== 'undefined' ? addslashes(strip_tags($_GET['masv'])):'';

$obj=new CLS_MYSQL;
$sql="SELECT * FROM tbl_monhoc";
$obj->Query($sql);
$arrMon=array();
while($r=$obj->Fetch_Assoc()){
	$arrMon[$r['id']]=$r;
}

$target_file=''; $target_dir = "temp/"; $data_import=array();
$msg='';
if(isset($_FILES["txtfile"]["type"]) && $_FILES["txtfile"]["type"]!=''){
	$validextensions = array("csv", "xls", "xlsx");
	$temporary = explode(".", $_FILES["txtfile"]["name"]);
	$file_extension = end($temporary);
	if (in_array($file_extension, $validextensions)) {
		if ($_FILES["txtfile"]["size"] < 10485760) { //10MB
			if ($_FILES["txtfile"]["error"] > 0){
				$msg="File Error";
			}else{
				$target_file = $target_dir . basename($_FILES["txtfile"]["name"]);
				// Check if file already exists
				if (file_exists($target_file)) {
					$file_name=basename($_FILES["txtfile"]["name"]);
					$temp = explode(".",$file_name);
					$newfilename = $temp[0].'_'.date('Ymd-His').'.'.$temp[1];
					$target_file=$target_dir.$newfilename;
				}
				// save file on server
				if (move_uploaded_file($_FILES["txtfile"]["tmp_name"], $target_file)) {
					chmod("$target_file", 0755); 
					require('extensions/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
					require('extensions/spreadsheet-reader-master/SpreadsheetReader.php');
					$Reader = new SpreadsheetReader($target_file);
					$i=0;
					$obj->Exec("BEGIN"); $flag_result=true;
					foreach ($Reader as $Row){
						$i++;						
						if($i>1 && trim($Row[1])!='') {
							$num=count($data_import);
							$arr_diem['chuyencan'] = trim($Row[2]);
							$arr_diem['diemkt'] = trim($Row[3]);
							$arr_diem['diemthi'] = trim($Row[4]);
							$json = json_encode($arr_diem,JSON_UNESCAPED_UNICODE);
							$sql = "UPDATE tbl_hoctap SET diem='$json',mdate=".time()." WHERE masv='".trim($Row[1])."' AND id_monhoc='$id_mon'";
							$result = $obj->Exec($sql);
							if(!$result) $flag_result=false;
						}
					}
					if($flag_result==true){
						$obj->Exec("COMMIT"); $msg="Lưu điểm thành công";
					}else {
						$obj->Exec("ROLLBACK"); $msg="Lỗi trong quá trình lưu trữ dữ liệu";
					}
					unlink($target_file);
				} else $msg="Tải file không thành công";		
			}
		}else $msg="Dung lượng file không vượt quá 10MB.";
	}
	else{
		$msg="Kiểu file phải là .csv";
	}
} ?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý học tập</div>
			</div>
		</div>
	</div>

	<div class="search_box panel panel-warning">
		<div class="panel-body">
			<div class="media row">
				<form name="frm_search" id="frm_search" method="get" action="#">
					<div class="form-group">
						<input type="hidden" name="com" value="student"/>
						<input type="hidden" name="task" value="qlhoctap"/>
						<div class="col-md-2 col-xs-6">
							<label>Môn học</label>
							<select name="mamon" id="ma_mon" class="form-control">
								<option value="">Môn học</option>
							</select>
						</div>
						<div class="col-md-2 col-xs-6">
							<label>Lớp</label>
							<select name="malop" id="ma_lop" class="form-control">
								<option value="">Lớp</option>
								<?php 
								$res_lop = SysGetList('tbl_lop', array(), '');
								if(count($res_lop)){
									foreach ($res_lop as $key => $value) {
										$selected = '';
										if($id_lop == $value['id']) $selected = "selected";
										echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['id'].'</option>';
									}
								}?>
							</select>
						</div>
						<div class="col-md-2 col-xs-6">
							<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<button type="button" id="tk_btnsearch" class="btn btn-primary form-control"><i class="fa fa-search"></i> Lọc</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row form-group">
		<div class="col-md-8 col-xs-12">
			Vui lòng nhấn Enter để lưu khi nhập từng ô điểm. Hoặc tải lên file điểm (.CSV). 
			<a href="<?php echo ROOTHOST;?>/temp/mau/import_diem.csv" id="download_file_diem">Download File mẫu tại đây <i class="fa fa-download"></i></a> <?php if($msg!="") echo "<div><label class='label label-warning'>".$msg."</label></div>";?>
		</div>
		<div class="col-md-4 col-xs-12">
			<button type="button" class="pull-right btn btn-primary update_auto" style="margin-left:10px"><i class="fa fa-tasks"></i> Xét Đạt/Không Đạt</button>
			<button type="button" class="pull-right btn btn-success import_diem3" style="margin-left:10px"><i class="fa fa-upload"></i> Tải file điểm</button>

			<form name="frm_import" id="frm_import" method="POST"  enctype="multipart/form-data">
				<input type="file" id="txtfile" name="txtfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none" />
				<input type="hidden" id="txttype" name="txttype" value=""> 
			</form>
		</div>
	</div>

	<table class="table table-bordered" id="tbl_hocphan">
		<thead>
			<tr> 
				<th width="30" rowspan="2">STT</th>
				<th class='align-middle' rowspan="2" width='180'>Sinh viên</th>
				<th rowspan="2">Môn học</th>
				<th rowspan="2">Tín chỉ</th>
				<th rowspan="2">Chuyên cần</th>
				<th rowspan="2">Kiểm tra</th>
				<th rowspan="2">Thi</th>
				<th class='text-center' rowspan="2">Thi lại </th>
				<th class='text-center' rowspan="2">Note</th>
				<th class='text-center' rowspan="2">Ngày cập nhập</th>
				<th colspan="3">Thang điểm</th>
				<th class='text-center' rowspan="2">Trạng thái</th>
				<th rowspan="2">Xếp loại</th>
				<th class='text-center' width="80" rowspan="2">Xét đạt/ không đạt</th>
			</tr>
			<tr>
				<th>10</th>
				<th>Chữ</th>
				<th>4</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$where = '';
			if($id_he!='') 		$where.=" AND id_he='$id_he'";
			if($id_nganh!='') 	$where.=" AND id_nganh='$id_nganh'";
			if($id_mon!='') 	$where.=" AND id_monhoc='$id_mon'";

			$sql="SELECT * FROM tbl_hocphan_khung WHERE 1=1 ";
			$obj->Query($sql.$where);
			$arrHP = array(); $hocky='';
			while($r=$obj->Fetch_Assoc()) {
				$arrHP=$r;
				$hocky = $arrHP['hocky'];
			}

			if($id_khoa!='') 	$where.=" AND id_khoa='$id_khoa'";
			if($id_lop!='') 	$where.=" AND malop='$id_lop'";
			if($id_hoso!='') 	$where.=" AND a.id_hoso='$id_hoso'";
			if($masv!='') 	$where.=" AND a.masv='$masv'";

			$sql="SELECT a.masv,a.id_hoso,
			b.id as id_ht,b.tinchi,b.id_monhoc,b.diem,b.ketqua,b.ketqua2,b.hoclai,b.status,b.mdate
			FROM tbl_dangky_tuyensinh AS a 
			INNER JOIN tbl_hoctap AS b ON a.masv=b.masv 
			WHERE 1=1 $where
			ORDER BY a.masv ASC,id_ht DESC";
			$obj->Query($sql); 

			$arr_list=array(); $str_ma = '';
			while($r=$obj->Fetch_Assoc()){
				$idhoso = $r['id_hoso'];
				$id_monhoc = $r['id_monhoc'];
				$arr_list[] = $r;
				$str_ma .=$idhoso."','";
			}
			if($str_ma!='') $str_ma = substr($str_ma,0,-3);
			$sql = "SELECT ma, ho_dem, name FROM tbl_hocsinh WHERE ma IN ('$str_ma')";
			$obj->Query($sql); 
			$info_sv = array();
			while($r=$obj->Fetch_Assoc()){
				$idhoso = $r['ma']; 
				$info_sv[$idhoso]['ho_dem']=$r['ho_dem'];
				$info_sv[$idhoso]['name']=$r['name'];
			}

			$stt=0; $ids='';$tinchi=1;
			foreach($arr_list as $r){ 
				$stt++;
				$id_hoso = $r['id_hoso'];
				$hodem = $info_sv[$id_hoso]['ho_dem'];
				$name = $info_sv[$id_hoso]['name'];
				$id_ht=$r['id_ht']; $ids.=$id_ht.",";
				$tinchi=$r['tinchi'];
				$diem = json_decode($r['diem'],true); $status = $r['status'];
				$kq=$r['ketqua']; $kq2=$r['ketqua2'];
				$kq_chu=$kq_4=$xeploai=''; $diem_pass=4;
				if($r['status']!==null) { /* Chỉ xét khi đã có kết quả Đạt/không đạt*/
					$diem_pass = $arrHP['total'];
					if($kq2!==null) $kq=$kq2;	
					if ($kq!==null) {		
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
						case '0':$status="<label class='label label-danger'>Không Đạt</label>"; 	break;
						case '1':$status="<label class='label label-success'>Đạt</label>"; 			break;
						case '2':$status="<label class='label label-warning'>Thi lại</label>"; 		break;
						case '3':$status="<label class='label label-warning'>Thi cải thiện</label>"; break;
						case '4':$status="<label class='label label-danger'>Học lại</label>"; 		break;
						case '5':$status="<label class='label label-danger'>Học cải thiện</label>"; break;
					} 
				} ?>
				<tr dataid="<?php echo $id_ht;?>" datama="<?php echo $r['masv'];?>" datamon="<?php echo $r['id_monhoc'];?>">
					<td align="center"><?php echo $stt;?></td>
					<td>
						<a href="student/diem/<?= $id_hoso;?>">Mã HS:<?php echo $r['masv'];?></a><br/>
						<span><?php echo $hodem.' '.$name;?></span>
					</td>
					<td><?php echo $arrMon[$r['id_monhoc']]['name'];?></td>
					<td align="center"><?php echo $r['tinchi'];?></td>

					<?php
					echo '<td align="center">';
					if($r['status']!=-1) {
						if(isset($diem['chuyencan'])) echo $diem['chuyencan']; 
					} else {
						$diemchuyencan = isset($diem['chuyencan']) ? $diem['chuyencan'] : '';
						echo '<input type="text" name="chuyencan" class="nhapdiem chuyencan form-control" value="'.$diemchuyencan.'" dataid="'.$id_ht.'" datama="'.$r['masv'].'" style="width:40px">';
					}
					echo '</td>';

					echo '<td align="center">';
					if($r['status']!=-1) {
						if(isset($diem['diemkt'])) echo $diem['diemkt']; 
					}else {
						$diemkt = isset($diem['diemkt']) ? $diem['diemkt'] : '';
						echo '<input type="text" name="diemkt" class="nhapdiem diemkt form-control" value="'.$diemkt.'" dataid="'.$id_ht.'" datama="'.$r['masv'].'" style="width:40px">';
					}
					echo '</td>';

					echo '<td align="center">';
					if($r['status']!=-1) {
						if(isset($diem['diemthi'])) echo $diem['diemthi']; 
					}else {
						$diemthi = isset($diem['diemthi']) ? $diem['diemthi'] : '';
						echo '<input type="text" name="diemthi" class="nhapdiem diemthi form-control" value="'.$diemthi.'" dataid="'.$id_ht.'" datama="'.$r['masv'].'" style="width:40px">';
					}
					echo '</td>';

					echo '<td align="center">';
					if($r['status']!=-1) {
						if(isset($diem['thilai'])){ 
							if($r['ketqua2']==null) {?>
								<input type="number" name="thilai" class="thilai form-control" value="<?php if(isset($diem['thilai'])) echo $diem['thilai'];?>" dataid="<?php echo $id_ht;?>" datama="<?php echo $r['masv'];?>" style="width:40px">
							<?php 	}else echo $diem['thilai'];
						}
					}
					echo '</td>';
					?>

					<td align="center">
						<a dataid='<?php echo $id_ht;?>' title='Note' class="btn_readNote"><i class="fa fa-commenting-o" aria-hidden="true"> <span class='label_number' id='id_<?php echo $id_ht;?>'>0</span></i></a>
					</td>
					<td align="center">
						<?php if($r['mdate']!='') echo date("d/m/y H:i",$r['mdate']);?>
						<button class='btn btn-success btn_capnhap_diem' data_mon='<?php echo $r['id_monhoc'];?>' data_masv='<?php echo $r['masv'];?>'>Cập nhập điểm</button>
					</td>
					<td align="center"><?php echo $kq;?></td>
					<td align="center"><?php echo $kq_chu;?></td>
					<td align="center"><?php echo $kq_4;?></td>
					<td align="center">
						<?php echo $status;?>
					</td>
					<td align="center"><?php echo $xeploai;?></td>
					<td class='text-center'>
						<?php
						if($r['status']!=-1) { ?>
							<?php 
							/*sinh viên đăng ký thi lại*/
							if(isset($diem['thilai'])) { 
								/*chưa xét KQ thi lại*/
								if($r['ketqua2']==null)
									echo '<button type="button" class="btn btn-warning btn_xet_thilai" style="margin-top:5px;padding:2px 4px;">Xét đạt/không đạt</button>';
								else {
									if($r['ketqua2']<$diem_pass && $r['hoclai']==0) {
										/*kỳ thi phụ bị điểm F */
										/*Mức học phí tín chỉ đối với học phần đăng ký học cải thiện điểm gấp 1,5 lần */
										?>
										<button type="button" class="btn btn-danger btn_hoclai" style="padding:2px 4px;">Học lại</button>
									<?php }elseif($r['ketqua2']>=$diem_pass && $diem['thilai']<=6  && $r['hoclai']==0){?>
										<button type="button" class="btn btn-danger btn_hoccaithien" style="padding:2px 4px;">Học cải thiện</button>
									<?php } /*end xet ketqua2*/
								} /*end if ketqua2==null*/
							} else{
								/*SV không dự thi ở kỳ thi chính, sinh viên bị điểm F*/
								if($r['status']==0 || ($r['status']!=-1 && $diem['diemthi']==="") ) { ?>
									<button type="button" class="btn btn-warning btn_thilai" style="padding:2px 4px;">Thi lại</button>
								<?php } elseif($r['status']==1 && $diem['diemthi']<=6){ 
									/*SV đạt, muốn cải thiện điểm*/ ?>
									<button type="button" class="btn btn-warning btn_thicaithien" style="padding:2px 4px;">Thi cải thiện</button>
								<?php }  /*end if diem thi*/
							} /*end if thi lai*/
						} else if($r['ketqua']==null){ ?>
							<button type="button" class="btn btn-warning btn_xet_dat" style="margin-top:5px;padding:2px 4px;">Xét</button>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	getMonHoc();
	// get all note count
	$.get('<?php echo ROOTHOST;?>ajaxs/hoctap/count_note.php',function(req){
		var object=JSON.parse(req);
		for(key in object){
			$('#'+key).html(object[key].num);
		}
	})

	$(document).ready(function(){
		$("#cbo_bac_menu").change(function(){
			getMonHoc(); getLop();
		})
		$("#cbo_nganh_menu").change(function(){
			getMonHoc(); getLop();
		})
		$("#tk_btnsearch").click(function(){
			SubmitSearch();
		})
		$('.btn_capnhap_diem').click(function(){ // tự động từ hệ thống
			var _url='<?php echo ROOTHOST;?>ajaxs/hoctap/frm_update_diem.php';
			var _masv=$(this).attr('data_masv');
			var _mon=$(this).attr('data_mon');
			$.get(_url,{'masv':_masv,'mon':_mon},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-title').html('Cập nhập điểm');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		});
		$(".nhapdiem").keypress(function(e){
			if(e.which==13) {// gõ enter
				var ht_row = $(this).parent().parent();
				var ht_id = ht_row.attr('dataid');
				var masv = ht_row.attr('datama');
				var id_mon = ht_row.attr('datamon');
				var chuyencan = ht_row.find('.chuyencan').val();
				var diemkt = ht_row.find('.diemkt').val();
				var diemthi = ht_row.find('.diemthi').val();
				save_diem(masv,ht_id,id_mon,chuyencan,diemkt,diemthi);
			}
		})
		$(".import_diem1").click(function(){
			if(checkinput()==true) {
				$("#txttype").val(1);
				$("#txtfile").trigger('click');
			}else alert("Vui lòng chọn đầy đủ thông tin tìm kiếm trước khi import file");
		})
		$(".import_diem2").click(function(){
			if(checkinput()==true) {
				$("#txttype").val(2);
				$("#txtfile").trigger('click');
			}else alert("Vui lòng chọn đầy đủ thông tin tìm kiếm trước khi import file");
		})
		$(".import_diem3").click(function(){
			if(checkinput()==true) {
				$("#txttype").val(3);
				$("#txtfile").trigger('click');
			}else alert("Vui lòng chọn đầy đủ thông tin tìm kiếm trước khi import file");
		})
		$('#txtfile').change(function(){
			$('#frm_import').submit();
		});
		$(".update_auto").click(function(){
			if(confirm("Bạn có chắc chắn thực hiện Xét Đạt/không Đạt tự động cho toàn bộ SV lớp?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/update_auto.php";
				$.post(url,{'ids':'<?php echo $ids;?>','id_he':'<?php echo $id_he;?>','id_nganh':'<?php echo $id_nganh;?>','id_mon':'<?php echo $id_mon;?>','id_lop':'<?php echo $id_lop;?>'},function(req){
					console.log(req);
					if(req=="error") showMess("Lỗi trong quá trình xét duyệt điểm.","error");
					if(req=="nodata") showMess("Không có dữ liệu xét duyệt.","error");
					if(req=="empty") showMess("Không có thông tin SV cần xét duyệt.","error");
					else {
						showMess(req,"");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}
				})
			}
		})
		$(".btn_thilai").click(function(){
			if(confirm("Bạn có chắc chắn thực hiện đăng ký thi lại cho SV này?")) {
				var ht_row = $(this).parent().parent();
				var ht_id = ht_row.attr('dataid');
				var masv = ht_row.attr('datama');
				var id_mon = ht_row.attr('datamon');
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_thilai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'type':1,'hocky':'<?php echo $hocky;?>'},function(req){
					if(req=="error") showMess("Lỗi trong quá trình đăng ký thi lại.","error");
					else if(req=="success") {
						showMess("Đăng ký thi lại thành công","");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}else {
						showMess(req,"");
					}
				})
			}
		})
		$(".btn_thicaithien").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			if(confirm("Bạn có chắc chắn thực hiện đăng ký thi cải thiện cho SV #"+masv+"?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_thilai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'type':2,'hocky':'<?php echo $hocky;?>'},function(req){
					if(req=="error") showMess("Lỗi trong quá trình đăng ký thi cải thiện điểm.","error");
					else if(req=="success") {
						showMess("Đăng ký thi cải thiện điểm thành công","");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}else {
						showMess(req,"");
					}
				})
			}
		})
		$(".thilai").keypress(function(e){
			if(e.which==13) {
				var ht_row = $(this).parent().parent();
				var ht_id = ht_row.attr('dataid');
				var masv = ht_row.attr('datama');
				var id_mon = ht_row.attr('datamon');
				var thilai = $(this).val();
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_diem_thilai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'thilai':thilai},function(req){
					if(req=="error") {
						showMess("Lỗi nhập điểm thi lại.","error");
					} else if(req=="success") {
						showMess("Đã nhập điểm thi lại thành công.","");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}else {
						showMess(req,"");
					}
				}) 
			}
		})
		$(".btn_xet_thilai").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			if(confirm("Bạn có chắc chắn thực hiện Xét Đạt/Không Đạt cho SV #"+masv+"?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_xet_thilai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'id_mon':id_mon,
					'id_he':'<?php echo $id_he;?>','id_nganh':'<?php echo $id_nganh;?>'},function(req){
						if(req=="error") {
							showMess("Lỗi trong quá trình xét đạt/không đạt cho SV #"+masv,"error");
						} else {
							showMess(req,"");
							setTimeout(function(){ window.location.reload(); }, 3000);
						}
					})
			}
		})
		$(".btn_xet_dat").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			if(confirm("Bạn có chắc chắn thực hiện Xét Đạt/Không Đạt cho SV #"+masv+"?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_xet_dat.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon},function(req){
					if(req=="error") {
						showMess("Lỗi trong quá trình xét đạt/không đạt cho SV #"+masv,"error");
					} else {
						showMess(req,"");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}
				})
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
		
		$(".btn_hoclai").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			if(confirm("Bạn có chắc chắn thực hiện đăng ký học lại cho SV #"+masv+"?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_hoclai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'type':1,
					'hocky':'<?php echo $hocky;?>','tinchi':'<?php echo $tinchi;?>'},function(req){
						if(req=="error") showMess("Lỗi trong quá trình đăng ký học lại.","error");
						else if(req=="success") {
							showMess("Đăng ký học lại thành công","");
							setTimeout(function(){ window.location.reload(); }, 3000);
						}else {
							showMess(req,"");
						}
					})
			}
		})
		$(".btn_hoccaithien").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			if(confirm("Bạn có chắc chắn thực hiện đăng ký học học cải thiện cho SV #"+masv+"?")) {
				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_hoclai.php";
				$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'type':2,
					'hocky':'<?php echo $hocky;?>','tinchi':'<?php echo $tinchi;?>'},function(req){
						if(req=="error") showMess("Lỗi trong quá trình đăng ký học cải thiện.","error");
						else if(req=="success") {
							showMess("Đăng ký học cải thiện thành công","");
							setTimeout(function(){ window.location.reload(); }, 3000);
						}else {
							showMess(req,"");
						}
					})
			}
		})
	})

function SubmitSearch() {
	var _mon = $("#ma_mon option:selected").val();
	var _lop = $("#ma_lop option:selected").val();
	var _masv = $("#tk_masv").val()!==undefined ? $("#tk_masv").val() : '';
	
	var url = window.location.href;
	var urlSplit = url.split( "?" );  
	var searchParams = new URLSearchParams(window.location.search);
	
	if(searchParams.has("mamon")===true){ searchParams.delete("mamon");}
	searchParams.append("mamon",_mon);
	if(searchParams.has("malop")===true){ searchParams.delete("malop");}
	searchParams.append("malop",_lop);
	if(searchParams.has("masv")===true && _masv!==''){ searchParams.delete("masv");}
	searchParams.append("masv",_masv);
	
	var obj = { Title : null, Url: urlSplit[0] + "?"+searchParams.toString()}; 
	history.pushState(null, obj.Title, obj.Url);
	window.location.reload();
}

function getMonHoc(){
	var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/getmon.php";
	var he = "<?php echo $id_he;?>";
	var nganh = "<?php echo $id_nganh;?>";
	$.post(url,{'he':he,'nganh':nganh,'mon':'<?php echo $id_mon;?>'},function(req){
		$("#ma_mon").html(req);
	})
}

function getLop(){
	var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/getlop.php";
	var he = "<?php echo $id_he;?>";
	var nganh = "<?php echo $id_nganh;?>";
	$.post(url,{'he':he,'nganh':nganh},function(req){
		$("#ma_lop").html(req);
	})
}

function checkinput(){
	var lop = $("#ma_lop option:selected").val();
	if(lop=="") {
		$("#ma_lop").addClass('novalid');
		$("#ma_lop").focus();
		return false;
	}else {
		$("#ma_lop").removeClass('novalid');
		return true;
	}
}

function save_diem(masv,ht_id,id_mon,chuyencan,diemkt,diemthi) {
	var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_diem.php";
	$.post(url,{'masv':masv,'ht_id':ht_id,'id_mon':id_mon,'chuyencan':chuyencan,'diemkt':diemkt,'diemthi':diemthi},function(req){
		console.log(req);
		if(req=="success") {
			showMess("Đã lưu thành công");
			setTimeout(function(){ window.location.reload(); }, 1000);
		}
	}) 
}
</script>