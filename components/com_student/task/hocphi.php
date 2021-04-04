<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$_masv 	= addslashes(strip_tags(htmlentities($_GET['id']))); // masv
$_SESSION['THIS_YEAR'] = $_SESSION['THIS_BAC'] = $_SESSION['THIS_NGANH'] = '';

//---------------------------------------
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array(), "AND masv='".$_masv."'");
if(count($res_dkts)<=0) die('Không có dữ liệu');
$row = $res_dkts[0];
$he = $row['id_he'];
$nganh = $row['id_nganh'];
$masv = $row['masv'];
$malop = $row['malop'];
$id_hoso = $row['id_hoso'];

//---------------------------------------
$objhs = new CLS_HS;
$objhs->getList(" AND ma='$id_hoso'");
$r=$objhs->Fetch_Assoc();
$fullname = $r['ho_dem'].' '.$r['name'];
$gender = $GLOBALS['ARR_GENDER'][$r['gioitinh']];
$ngaysinh = date("Y-m-d",$r['ngaysinh']);
$hokhau = $r['hktt'];

//---------------------------------------
$dm = isset($_GET['dm'])?addslashes(htmlentities(strip_tags($_GET['dm']))):"";
$hocky = isset($_GET['hocky'])?(int)$_GET['hocky']:"";
?>
<style type="text/css">
	.price{color: red; font-weight: bold; font-size: 16px;}
</style>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý Học phí</div>
			</div>
			<ul class="pull-right">
				<li><a href="<?php echo ROOTHOST;?>student/qlhocphi" class="btn btn-default btn-close" title="Thoát">
					<i class="fa fa-reply"></i> Thoát</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="container-fluid">
		<div class="flex row">
			<div class="col-md-5 col-xs-12">
				<div class="panel panel-warning">
					<div class="panel-body">
						<h4>THÔNG TIN SINH VIÊN</h4>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Mã sinh viên</div>
							<div class="col-md-9 col-xs-8"><?php echo $masv;?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Lớp</div>
							<div class="col-md-9 col-xs-8"><?php echo $malop;?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Họ và tên</div>
							<div class="col-md-9 col-xs-8"><?php echo $fullname;?></div>
						</div>
						<div class="row form-group">
							<div class="col-md-3 col-xs-4 text">Ngày sinh</div>
							<div class="col-md-9 col-xs-8"><?php echo $ngaysinh;?></div>
						</div>
						<div class="row form-group">	
							<div class="col-md-3 col-xs-4 text">Giới tính</div>
							<div class="col-md-9 col-xs-8"><?php echo $gender;?></div>
						</div>
						<div class="row form-group">	
							<div class="col-md-3 col-xs-4 text">Hộ khẩu</div>
							<div class="col-md-9 col-xs-8"><?php echo $hokhau;?></div>
						</div>
						<div class="row form-group">	
							<div class="col-md-3 col-xs-4 text">Trạng thái</div>
							<div class="col-md-9 col-xs-8">
								<label class="label <?php echo $trangthai_label;?>"><?php echo $trangthai;?></label>
							</div>
						</div><br>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-xs-12">
				<div class="panel panel-warning">
					<div class="panel-body">
						<h4>SỐ LƯỢNG</h4>
						<?php
						$count_money = $paid_money = $miss_money = 0;
						$res_hocphi_pay = SysGetList('tbl_hocphi_pay', array(), 'AND masv="'.$masv.'"');
						if(count($res_hocphi_pay)>0){
							foreach ($res_hocphi_pay as $key => $value) {
								$paid_money += $value['sotien'];
							}
						}

						// Get SUM hocphi
						$obj=new CLS_MYSQL;
						$sql="SELECT SUM(hocphi) AS tonghocphi FROM tbl_hocphi WHERE masv='".$masv."'";
						$obj->Query($sql);
						if($obj->Num_rows()>0){
							$res_sum_hocphi = $obj->Fetch_Assoc();
							$count_money = $res_sum_hocphi['tonghocphi'];
						}

						if($count_money!=0 && $paid_money!=0){
							$miss_money = $count_money - $paid_money;
						}else{
							$miss_money = $count_money;
						}
						?>
						<div class="box_count">
							<div class="form-group">
								<label>Tổng học phí:</label>
								<span class="price count_money"><?php echo number_format($count_money);?> VNĐ</span>
							</div>
							<div class="form-group">
								<label>Đã đóng:</label>
								<span class="price paid"><?php echo number_format($paid_money);?> VNĐ</span>
							</div>
							<div class="form-group">
								<label>Còn lại:</label>
								<span class="price miss_money"><?php echo number_format($miss_money);?> VNĐ</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-xs-12">
				<div class="panel panel-warning">
					<div class="panel-body">
						<h4>LỊCH SỬ ĐÓNG HỌC PHÍ</h4>
						<div class="box_history">
							<ul>
								<?php $sql = "SELECT * FROM tbl_hocphi_pay WHERE masv='$masv' ORDER BY date_pay DESC";
								$obj = new CLS_MYSQL; $obj->Query($sql);
								while($r_note=$obj->Fetch_Assoc()) { ?>
									<li>
										<div class="note"><i class="fa fa-caret-right"></i> Đã đóng <?php echo number_format($r_note['sotien']);?> VNĐ</div>
										<small class="date">
											<span class="pull-left">Bởi <?php echo $r_note['author'];?></span>
											<span class="pull-right"><?php echo date("d/m/y H:i",$r_note['date_pay']);?></span>
										</small>
										<div class="clearfix"></div>
									</li>
								<?php } ?>
							</ul>
						</div>

						<a href="<?php echo ROOTHOST;?>student/hocphi_history/<?php echo $masv;?>" class="btn btn-default">Xem chi tiết</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-xs-12 panel panel-warning">
			<div class="panel-body">
				<form name="frmsearch" id="frmsearch" action="#" method="get">
					<div class="col-md-1 col-xs-12 text">Tên mục</div>
					<div class="col-md-2 col-xs-12">
						<input type="text" name="dm" id="dm" value="<?php echo $dm;?>" class="form-control">
					</div>
					<div class="col-md-1 col-xs-12 text">Học kỳ</div>
					<div class="col-md-2 col-xs-12">
						<?php $objhe = new CLS_HE;
						$objhe->getList(" AND id='$he'");
						$r=$objhe->Fetch_Assoc();
						$sohocky=$r['sohocky']; ?>
						<select id='hocky' name='hocky' class='form-control'>
							<option value="">Tất cả</option>
							<?php for($i=1;$i<=$sohocky;$i++){
								if($i==$hocky) echo "<option value='$i' selected>Học kỳ $i</option>";
								else echo "<option value='$i'>Học kỳ $i</option>";
							}?>
						</select>
					</div>
					<div class="box-function pull-right">
						<button type="button" dataid="<?php echo $masv;?>" class="btn btn-success btn-add" title="Thêm học phí"><i class="fa fa-plus"></i> Thêm học phí</button>
						<button type="button" dataid="<?php echo $masv;?>" class="btn btn-warning btn-print" title="In hồ sơ"><i class="fa fa-print"></i> In</button>
						<button type="button" dataid="<?php echo $masv;?>" id="btn_donghocphi" class="btn btn-success">ĐÓNG HỌC PHÍ</button>
						<button type="button" dataid="<?php echo $masv;?>" id="btn_donghocphivainbienlai" class="btn btn-warning"><i class="fa fa-print"></i> ĐÓNG & IN BIÊN LAI</button>
					</div>
					<div class="col-md-1 col-xs-8">
						<button type="submit" class="btn btn-primary">Tìm</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php $html.="<h3 align='center'>CHI TIẾT HỌC PHÍ</h3>
	<table class='table' style='width:100%'>
	<tr><td width='100'>Mã sinh viên:</td><td>$masv</td>
	<td width='100'>Lớp:</td><td>$malop</td>
	</tr>
	<tr><td>Họ và tên:</td><td>$fullname</td>
	<td>Ngày sinh:</td><td>$ngaysinh</td>
	</tr>
	</table>";
	?>

	<div class="container-fluid"><div class="row">
		<div class="col-md-12 col-xs-12">
			<table class="table table-bordered">
				<thead><tr>
					<th width='30'>STT</th>
					<th width='30'>Xóa</th>
					<th>Tên danh mục</th>
					<th class='text-right'>Học phí</th>
					<th class='text-center'>Học kỳ</th>
				</tr></thead>
				<tbody>
					<?php 
					$html.='<table class="table table-bordered">
					<thead><tr>
					<th width="30">STT</th>
					<th class="text-left">Tên danh mục</th>
					<th class="text-right">Học phí</th>
					<th class="text-center">Học kỳ</th>
					</tr></thead>
					<tbody>';
					$obj=new CLS_MYSQL;
					$sql="SELECT * FROM tbl_monhoc";
					$obj->Query($sql);
					$arrMon=array();
					while($r=$obj->Fetch_Assoc()){
						$arrMon[$r['id']]=$r;
					}
					$strwhere = "";
					if($dm!=="") $strwhere.=" AND ten_hp LIKE '%$dm%' ";
					if($hocky!=="" && $hocky!==0) $strwhere.=" AND hocky=$hocky ";

					$sql="SELECT * FROM tbl_hocphi WHERE masv='$masv' $strwhere";
					$obj->Query($sql);
					$stt=0; $tong_hp=0;
					if($obj->Num_rows()>0){
						while($hp=$obj->Fetch_Assoc()) {
							$id_hp=$hp['id'];
							$hocphi=$hp['hocphi']; 
							$type_hocphi=$hp['type_hp'];
							$ten_hp = stripslashes($hp['ten_hp']);
							if($type_hocphi=="hoc_phan" && isset($arrMon[$hp['ma_hp']]['name'])) $ten_hp = $arrMon[$hp['ma_hp']]['name'];
							$stt++; $tong_hp+=$hocphi;

							$html.='<tr><td class="text-center">'.$stt.'</td>
							<td>'.$ten_hp.'</td>
							<td class="text-right">'.number_format($hocphi).'</td>
							<td class="text-center">'.$hp['hocky'].'</td>';
							$html.='</tr>';
							?>
							<tr class="hp_row">
								<td class='text-center'><?php echo $stt;?></td>
								<td>
									<i class="fa fa-trash btn_xoa" aria-hidden="true" title="Xóa" dataid="<?php echo $id_hp;?>" dataname="<?php echo $ten_hp;?>"></i>
								</td>
								<td><?php echo $ten_hp;?></td>
								<td class='text-right'><?php echo number_format($hocphi);?></td>
								<td class='text-center'><?php echo $hp['hocky'];?></td>
							</tr>
						<?php } ?>
						<tr style="background:#ccc;font-weight:bold"><td></td>
							<td></td><td class='text-right'>TỔNG</td>
							<td class='text-right'><?php echo number_format($tong_hp);?></td>
							<td></td>
						</tr>
						<?php $html.='<tr style="background:#ccc;font-weight:bold"><td></td>
						<td class="text-right">TỔNG</td>
						<td class="text-right">'.number_format($tong_hp).'</td>
						<td></td>
						</tr></tbody></table>';
					} ?>
				</tbody>
			</table>
		</div>
	</div></div>
	<div id="divToPrint" style="display:none;"><?php echo $html; ?></div>
</div>
<script>
	$("#dm").keypress(function(e){
		if(e.which==13) {
			if($(this).val()=="") {
				$(this).focus(); return;
			}
			$("#frmsearch").submit();
		}
	})
	$("#btn_donghocphi").click(function(){
		var _id=$(this).attr('dataid');
		var _url='<?php echo ROOTHOST;?>ajaxs/hocphi/frm_donghocphi.php';
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-title').html('Đóng học phí');
		$.post(_url,{'masv':_id},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	})
	$("#btn_donghocphivainbienlai").click(function(){
		var _id=$(this).attr('dataid');
		var _url='<?php echo ROOTHOST;?>ajaxs/hocphi/frm_donghocphi_inbienlai.php';
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-title').html('Đóng học phí & in biên lai');
		$.post(_url,{'masv':_id},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	})
	$(".btn_xoa").click(function(){
		var id = $(this).attr('dataid');
		var name = $(this).attr('dataname');
		if(confirm("Bạn chắc chắn muốn xóa mục học phí '"+name+"' ?")) {
			showLoading();
			var _url='<?php echo ROOTHOST;?>ajaxs/hocphi/process_del.php';
			$.post(_url,{'id':id,'name':name,'masv':'<?php echo $masv;?>'},function(req){
				hideLoading();
				if(req=="success") { 
					showMess("Đã xóa mục học phí '"+name+"'");
					setTimeout(function(){window.location.reload(); }, 2000);
				}else showMess('Lỗi không thể xóa');
			});
		}
	})
	$(".box-function .btn-add").click(function(){
		var masv = $(this).attr('dataid');
		var _url='<?php echo ROOTHOST;?>ajaxs/hocphi/frm_add.php';
		$('#myModalPopup .modal-body').html('Loading...');
		$('#myModalPopup .modal-title').html('Thêm thông tin học phí');
		$.post(_url,{'masv':masv},function(req){
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		});
	})
	$(".btn-print").click(function(){
		showLoading();
		var screenW =screen.width;
		var screenH =screen.height; //console.log(screenW+' / '+screenH);
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