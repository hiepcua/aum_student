<?php
defined('ISHOME') or die("You can't access this page!");
$params=''; 
$page_title = "QL đào tạo"; 
$DKTS = array();
//---------------------------------------
$THIS_KHOA 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$THIS_HE 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$THIS_NGANH = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$THIS_STAFF = isset($_SESSION['THIS_STAFF']) ? $_SESSION['THIS_STAFF'] : ''; // ID nhân viên đăng nhập

/* Get all hồ sơ */
$HOCSINH = array();
$res_hosoSV = SysGetList('tbl_hocsinh', array());
if(count($res_hosoSV)>0){
	foreach ($res_hosoSV as $key => $value) {
		$HOCSINH[$value['ma']] = $value;
	}
}

/* Get tương tác cuối cùng theo từng sinh viên */
$WORK_LOG = array(); // Mảng lưu logs theo từng sinh viên
$WORK_LOG_DATE = array(); // Mảng lưu tất cả time tương tác theo từng sinh viênS
$WORK_LOG_NOIDUNG = array(); // Mảng lưu tất cả nội dung tương tác theo từng sinh viênS
$current_time = time();
$res_log = SysGetList('tbl_working_log', array(), "AND finish=1 AND `date`<=".$current_time." ORDER BY cdate DESC");
if(count($res_log)>0){
	foreach ($res_log as $key => $value) {
		$WORK_LOG[$value['masv']][] = $value;
		$WORK_LOG_DATE[$value['masv']][] = $value['date'];
		$WORK_LOG_NOIDUNG[$value['masv']][] = $value['noidung'];
	}
}

//-------------------------------------------
$strWhere='';
if($THIS_NGANH!='') { 
	$strWhere.=" AND id_nganh='$THIS_NGANH'"; 
	$nganh_name = $NGANH[$THIS_NGANH];
	$page_title.= " - ngành $nganh_name";
	$params .= "&nganh=$THIS_NGANH";
}

if($THIS_HE!='') {
	$strWhere.=" AND id_he='$THIS_HE'";
	$he_name = $HE[$THIS_HE];
	$page_title.= " - hệ $he_name";
	$params .= "&he=$THIS_HE";
}

$LOP = array();
$res_lop = SysGetList('tbl_lop',array()," $strWhere");
if(count($res_lop)>0){
	foreach ($res_lop as $key => $value) {
		$LOP[$value['id']] = $value;
	}
}

/* Handle GET request */
$_staff = $THIS_STAFF;
$_masv = isset($_GET['masv']) ? antiData($_GET['masv']) : '';
$_malop = isset($_GET['malop']) ? antiData($_GET['malop']) : '';
$_khoa = isset($_GET['khoa']) ? antiData($_GET['khoa']) : '';
$_level = isset($_GET['level']) ? antiData($_GET['level']) : '';
$_statusSV = isset($_GET['statusSV']) ? antiData($_GET['statusSV']) : '';
$_statusHP = isset($_GET['statusHP']) ? antiData($_GET['statusHP']) : '';
$_statusCall = isset($_GET['statusCall']) ? antiData($_GET['statusCall']) : '';
$_statusCallHP = isset($_GET['statusCallHP']) ? antiData($_GET['statusCallHP']) : '';
$get_startdate 	= isset($_GET['startdate']) && $_GET['startdate']!="" ? antiData($_GET['startdate'], 'int') : '';
$get_enddate 	= isset($_GET['enddate']) && $_GET['enddate']!="" ? antiData($_GET['enddate'], 'int') : '';

if($_malop!='') { 
	$strWhere.=" AND malop='$_malop'";
	$params .= "&malop=$_malop";
}
if($_khoa!='') {
	$strWhere.=" AND id_khoa='$_khoa'";
	$params .= "&khoa=$_khoa";
}
if($_masv!=''){
	$strWhere.=" AND masv='$_masv'";
}
if($_statusSV!=''){
	$strWhere.=" AND tinhtrang_sv='$_statusSV'";
}
if($_statusCall!=''){
	$strWhere.=" AND tinhtrang_call='$_statusCall'";
}
if($_statusCallHP!=''){
	$strWhere.=" AND tinhtrang_call_hp='$_statusCallHP'";
}
if($_staff!=''){
	$strWhere.=" AND id_staff='$_staff'";
}
if($_statusHP!=''){
	$strWhere.=" AND tinhtrang_hocphi='$_statusHP'";
}

$res_dkts = SysGetList('tbl_dangky_tuyensinh',array(), $strWhere);
if(count($res_dkts)>0){
	foreach ($res_dkts as $key => $value) {
		$DKTS[$value['masv']] = $value;
	}
}
$arr_data = $DKTS;

$number_by_level = array("L0"=>0,"L1"=>0,"L2"=>0,"L3"=>0,"L4"=>0,"L5"=>0,"L6"=>0,"L7"=>0,"L8"=>0,"L9"=>0);
foreach ($arr_data as $key => $value) {
	$masv = $key;
	$ma_hoso = $value['id_hoso'];
	$hodem = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['ho_dem'] : "";
	$tensv = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['name'] : "";
	$sodienthoai = isset($HOCSINH[$ma_hoso]) ? $HOCSINH[$ma_hoso]['dienthoai'] : "";
	$ngaysinh = isset($HOCSINH[$ma_hoso]) && $HOCSINH[$ma_hoso]['ngaysinh']>0 ? date('d-m-Y', $HOCSINH[$ma_hoso]['ngaysinh']) : '';
	$hotensv = $hodem.' '.$tensv;
	$id_nganh = $value['id_nganh'];
	$id_khoa = $value['id_khoa'];
	$id_he = $value['id_he'];
	$id_staff = $value['id_staff'];
	$name_staff = isset($STAFF_ALL[$id_staff]) ? $STAFF_ALL[$id_staff]['fullname'] : "";
	$name_nganh = isset($NGANH[$id_nganh]) ? $NGANH[$id_nganh]['name'] : "";
	$name_khoa = isset($KHOA[$id_khoa]) ? $KHOA[$id_khoa]['name'] : "";
	$name_he = isset($HE[$id_he]) ? $HE[$id_he]['name'] : "";

	if(array_key_exists($value['status'], $number_by_level)){
		$num = $number_by_level[$value['status']];
		$number_by_level[$value['status']] = $num + 1;
	}

	$last_date_contact = $noidung_last_contact = $noidung_contact_ht = $noidung_contact_hp = "";
	if(isset($WORK_LOG[$masv])){
		$arr_last_contact_ht = array();
		$arr_last_contact_hp = array();
		foreach ($WORK_LOG[$masv] as $k => $v) {
			if($v["type"] == "hoctap") $arr_last_contact_ht[] = $v["noidung"];
			if($v["type"] == "hocphi") $arr_last_contact_hp[] = $v["noidung"];
		}

		$last_date_contact = max($WORK_LOG_DATE[$masv]);
		$noidung_last_contact = $WORK_LOG_NOIDUNG[$masv][0];
		$noidung_contact_ht = isset($arr_last_contact_ht[0]) ? $arr_last_contact_ht[0] : "";
		$noidung_contact_hp = isset($arr_last_contact_hp[0]) ? $arr_last_contact_hp[0] : "";
	}

	$arr_data[$key]['hotensv'] = $hotensv;
	$arr_data[$key]['sodienthoai'] = $sodienthoai;
	$arr_data[$key]['ngaysinh'] = $ngaysinh;
	$arr_data[$key]['name_staff'] = $name_staff;
	$arr_data[$key]['name_nganh'] = $name_nganh;
	$arr_data[$key]['name_khoa'] = $name_khoa;
	$arr_data[$key]['name_he'] = $name_he;
	$arr_data[$key]['last_date_contact'] = $last_date_contact;
	$arr_data[$key]['noidung_contact'] = $noidung_last_contact;
	$arr_data[$key]['noidung_contact_ht'] = $noidung_contact_ht;
	$arr_data[$key]['noidung_contact_hp'] = $noidung_contact_hp;
}
?>
<style type="text/css">
#frm_search .form-control {
	margin-bottom: 10px;
	border-radius: 0;
	box-shadow: none;
	border: 0px;
	border-bottom: 1px solid #ccc;
}
#frm_search .time{
	position: relative;
}
#frm_search .time .text{
	font-weight: 600;
	position: absolute;
	font-size: .8em;
	bottom: 12px;
}
#frm_search .time input{
	padding-left: 60px;
}
.table span.label{
	cursor: pointer;
	font-size: 90%;
}
.box-level a.active{
	color: #fff;
	background-color: #5cb85c;
	border-color: #4cae4c;
}
select.status{
	max-width: 120px;
}
</style>
<div class='body'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title"><?php echo $page_title;?></div>
			</div>
			<div class="box-function pull-right">
				<form id="frm_search_multiple" method="GET" action="">
					<input type="hidden" id="txtids" name="txtids">
					<ul>
						<li>
							<a href="javascript:void(0)" class="btn btn-primary" onclick="frm_status_level_multiple()" title="Cập nhật Level"><i class="bi bi-pencil-square"></i> Cập nhật Level</a>
						</li>
						<?php if($IS_NV==false){ ?>
							<li>
								<a href="javascript:void(0)" class="btn btn-primary" onclick="frm_select_staff_multiple()" title="Chọn người quản lý"><i class="bi bi-pencil-square"></i> Người quản lý</a>
							</li>
						<?php } ?>
						<li>
							<a href="javascript:void(0)" class="btn btn-primary" onclick="frm_status_sv_multiple()" title="Cập nhật tình trạng học viên"><i class="bi bi-pencil-square"></i> Tình trạng SV</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="btn btn-primary" onclick="frm_status_hocphi_multiple()" title="Cập nhật tình trạng học phí"><i class="bi bi-pencil-square"></i> Tình trạng học phí</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="btn btn-primary" onclick="frm_status_call_multiple()" title="Cập nhật tình trạng cuộc gọi học tập"><i class="bi bi-pencil-square"></i> Gọi học tập</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="btn btn-primary" onclick="frm_status_call_hp_multiple()" title="Cập nhật tình trạng cuộc gọi học phí"><i class="bi bi-pencil-square"></i> Gọi học phí</a>
						</li>
						<li>
							<a href="<?php echo ROOTHOST;?>qlhocphi?<?php echo $params;?>" class="btn btn-primary btn-money" title="Quản lý học phí"><i class="fa fa-money"></i> QL Học phí</a>
						</li>
						<li>
							<a href="<?php echo ROOTHOST;?>qlhoctap?<?php echo $params;?>" class="btn btn-success btn-book" title="Quản lý học tập"><i class="fa fa-book"></i> QL Học tập</a>
						</li>
						<li>
							<a href="#" class="btn btn-info btn-excel" title="Xuất File Excel"><i class="fa fa-excel"></i> Xuất File Excel</a>
						</li>
						<li>
							<a href="#" class="btn btn-warning btn-print" title="In danh sách"><i class="fa fa-print"></i> In</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>

	<div class="customer_list">
		<?php $tk_nganh='';?>
		<div class="search_box panel panel-warning">
			<div class="panel-body">
				<div class="media row">
					<form name="frm_search" id="frm_search" method="get" action="#">
						<input type="hidden" name="com" value="student"/>
						<input type="hidden" name="task" value="hsdaotao"/>
						<div class="form-group">
							<div class="col-md-2 col-xs-6">
								<select class="form-control btn btn-fefault" name='malop' id="cbo_lop">
									<option value="">Tất cả các lớp</option>
									<?php
									foreach ($LOP as $value) {
										$item = $value['id'];
										$selected = ($_malop==$value['id'])?'selected':'';
										echo '<option '.$selected.' value="'.$value['id'].'">'.$value['name'].'</option>';
									}
									?>
								</select> 
							</div>
							<div class="col-md-2 col-xs-6">
								<select class="form-control btn btn-fefault" name='khoa' id="cbo_khoa">
									<option value="">Tất cả các khóa</option>
									<?php
									foreach ($res_khoa as $value) {
										$item = $value['id'];
										$selected = ($_khoa==$value['id'])?'selected':'';
										echo '<option '.$selected.' value="'.$value['id'].'">'.$value['name'].'</option>';
									}
									?>
								</select> 
							</div>
							<div class="col-md-2 col-xs-6">
								<select class="form-control" name='statusSV'>
									<option value="">Tình trạng SV</option>
									<?php
									foreach ($STATUS_SV as $key => $value) {
										$selected = ($_statusSV == $key) ? 'selected' : '';
										echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
									}
									?>
								</select>
							</div>
							<div class="col-md-2 col-xs-6">
								<select class="form-control" name='statusHP'>
									<option value="">Tình trạng học phí</option>
									<?php
									foreach ($STATUS_HOCPHI as $key => $value) {
										$selected = ($_statusHP == $key) ? 'selected' : '';
										echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
									}
									?>
								</select>
							</div>

							<div class="col-md-2">
								<div class="wr-btnsearch btn-group">
									<button type="submit" name="tk_btnsearch" id="tk_btnsearch" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
									<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownFillter"><i class="fa fa-caret-down"></i></button>
									<button type="button" class="btn btn-primary btn-refresh"><i class="fa fa-refresh" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
						<div id="fillter_advance">
							<div class="scroll" class="over400">
								<div class="common_fillter">
									<div class="col-md-2">
										<input type="text" name="masv" id="tk_masv" value="<?php echo $_masv;?>" placeholder="Mã SV" class="form-control"/>
									</div>

									<div class="col-md-2 col-xs-6">
										<select class="form-control" name='statusCall' id="cbo_statusCall">
											<option value="">Tình trạng cuộc gọi HT</option>
											<?php
											foreach ($STATUS_CALL as $key => $value) {
												$selected = ($_statusCall == $key) ? 'selected' : '';
												echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
											}
											?>
										</select>
									</div>
									
									<div class="col-md-2 col-xs-6">
										<select class="form-control" name='statusCallHP' id="cbo_statusCallHP">
											<option value="">Tình trạng cuộc gọi HP</option>
											<?php
											foreach ($STATUS_CALL_HP as $key => $value) {
												$selected = ($_statusCallHP == $key) ? 'selected' : '';
												echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12 form-group box-level">
							<?php
							foreach ($LEVEL_STUDENT as $key => $value) {
								$active = $key==$_level ? "active" : "";
								echo '<a href="'.ROOTHOST.'hsdaotao?level='.$key.'" class="btn btn-'.$key.' '.$active.'"> '.$key.' ('.$number_by_level[$key].')</a>&nbsp&nbsp';
							}
							?>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php $html.='<div class="page-bar">
		<div class="page-title-breadcrumb">
		<div class="page-title">DANH SÁCH SINH VIÊN</div>
		</div>
		</div>';
		$html.='<table class="table table-striped table-bordered">
		<thead><tr class="header">
		<th class="text-center">STT</th>
		<th>Thông tin SV</th>
		<th class="text-center">Level</th>
		<th class="text-center">Tình trạng SV</th>
		<th class="text-center">Tình trạng học phí</th>
		<th class="text-center">Tình trạng cuộc gọi</th>
		<th class="text-center">Người phụ trách</th>
		<th>Ngành</th>
		<th class="text-center">Thông tin đào tạo</th>
		</tr></thead>
		<tbody>';
		?>
		<div id="list_profile" class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead><tr class="header">
					<th class="text-center">STT</th>
					<th width="30" class="text-center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);"/></th>
					<th>Sinh viên</th>
					<th class="text-center">Level</th>
					<th class="text-center">Tình trạng SV</th>
					<th class="text-center">Tình trạng học phí</th>
					<th class="text-center">Tình trạng cuộc gọi HT</th>
					<th class="text-center">Tình trạng cuộc gọi HP</th>
					<th class="text-center">Người phụ trách</th>
					<th>Thông tin đào tạo</th>
				</tr></thead>
				<tbody>
					<?php
					if($get_startdate!=""){
						$new_array = array();
						$current_time = time();
						$startDay = strtotime("-".$get_startdate." day");

						foreach ($arr_data as $key => $value) {
							if($value['last_date_contact']>=$startDay && $value['last_date_contact']<=$current_time) $new_array[] = $value;
						}
						$arr_data = $new_array;
					}

					if($get_enddate!=""){
						$new_array = array();
						$current_time = time();
						$endDay = strtotime("-".$get_enddate." day");
						foreach ($arr_data as $key => $value) {
							if($value['last_date_contact']<=$endDay) $new_array[] = $value;
						}
						$arr_data = $new_array;
					}

					if($_level!=''){
						$new_array = array();
						foreach ($arr_data as $key => $value) {
							if($value['status']==$_level) $new_array[] = $value;
						}
						$arr_data = $new_array;
					}

					$total_rows = count($arr_data);
					$max_pages = ceil($total_rows/MAX_ROWS);
					$cur_page = getCurentPage($max_pages);
					$start = ($cur_page - 1) * MAX_ROWS;
					$end = $start + MAX_ROWS;
					$stt = $start; $ids='';
					if($total_rows>0){
						$i=0;
						foreach ($arr_data as $key => $row) {
							if($i>=$start && $i<=$end):
								$stt = $stt+1;
								$ids = (int)$row['id'];
								$id_hoso = $row['id_hoso']; $masv=$row['masv']; $lop=$row['malop'];
								$id_khoa = $row['id_khoa']; 
								$id_he = $row['id_he']; 
								$id_nganh = $row['id_nganh']; 
								$noidung_contact_hp = $row['noidung_contact_hp'];
								$noidung_contact_ht = $row['noidung_contact_ht'];

								$name_khoa = $row['name_khoa'];
								$name_he = $row['name_he'];
								$name_nganh = $row['name_nganh'];
								$hoten = $row['hotensv'];
								$ngaysinh = $row['ngaysinh'];
								$dienthoai = $row['sodienthoai'];
								$id_staff = $row['id_staff'];
								$name_staff = $row['name_staff'];

								$level = $row['status']!="" ? $row['status'] : "L0";
								$tinhtrang_sv = strlen($row['tinhtrang_sv'])>0 ? $row['tinhtrang_sv'] : '---';
								$tinhtrang_call = strlen($row['tinhtrang_call'])>0 ? $row['tinhtrang_call'] : '---';
								$tinhtrang_call_hp = strlen($row['tinhtrang_call_hp'])>0 ? $row['tinhtrang_call_hp'] : '---';
								$tinhtrang_hocphi = strlen($row['tinhtrang_hocphi'])>0 ? $row['tinhtrang_hocphi'] : '---';

								$txt_level = isset($LEVEL_STUDENT[$level]) ? $LEVEL_STUDENT[$level] : "";
								$txt_tinhtrang_sv = $tinhtrang_sv!=='---' ? $STATUS_SV[$tinhtrang_sv] : '';
								$txt_tinhtrang_hocphi = $tinhtrang_hocphi!=='---' ? $STATUS_HOCPHI[$tinhtrang_hocphi] : '';
								$txt_tinhtrang_call = $tinhtrang_call!=='---' && isset($STATUS_CALL[$tinhtrang_call]) ? $STATUS_CALL[$tinhtrang_call] : '';
								$txt_tinhtrang_call_hp = $tinhtrang_call_hp!=='---' && isset($STATUS_CALL_HP[$tinhtrang_call_hp]) ? $STATUS_CALL_HP[$tinhtrang_call_hp] : '';
								?>
								<tr>
									<td align="center" width="30"><?php echo $stt;?></td>
									<td align="center" width="30">
										<label class="action" style="border:0px"><input type='checkbox' name='chk' id='chk' onclick="docheckonce('chk');" value='<?php echo $ids;?>'/></label>
									</td>
									<td>
										<div class="infoSV">
											<div class="masv"><a href="<?php echo ROOTHOST.'student/profile/'.$row['id_hoso'];?>" title=""><span class="cblack"></span><strong><?php echo $masv;?></strong></a></div>
											<div class="name"><a href="<?php echo ROOTHOST.'student/profile/'.$row['id_hoso'];?>" class="cblack" title=""><?php echo $hoten;?></a></div>
											<div class="phone"><span class="cblack">SĐT: </span><?php echo $dienthoai;?></div>
										</div>
									</td>

									<td align="center">
										<select class="status cbo_level form-control" data-masv="<?php echo $masv;?>" name="cbo_level">
											<?php
											$flag = 'no';
											foreach ($LEVEL_STUDENT as $key => $value) {
												$checked = '';
												if($key == $level){
													$flag = "yes";
													$checked = 'selected';
												}
												if($flag=='yes'){
													echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
												}
											}
											?>
										</select>
									</td>

									<td align="center">
										<select class="status cbo_statusSV form-control" data-masv="<?php echo $masv;?>" name="cbo_statusSV">
											<?php
											foreach ($STATUS_SV as $key => $value) {
												$checked = $key==$tinhtrang_sv ? 'selected' : '';
												echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
											}
											?>
										</select>
									</td>

									<td align="center">
										<select class="status cbo_statusHP form-control" data-masv="<?php echo $masv;?>" name="cbo_statusHP">
											<?php
											foreach ($STATUS_HOCPHI as $key => $value) {
												$checked = $key==$tinhtrang_hocphi ? 'selected' : '';
												echo '<option value="'.$key.'" '.$checked.'>'.$value.'</option>';
											}
											?>
										</select>
									</td>

									<td align="center" width="180" title="<?php echo $txt_tinhtrang_call;?>">
										<a href="javascript:void(0)" class="label label-success" onclick="frm_status_call(this)" data-masv="<?php echo $masv;?>" data-status-call="<?php echo $tinhtrang_call;?>"><?php echo $tinhtrang_call;?></a>
										<div class="txt_status"><?php echo $txt_tinhtrang_call;?></div>
										<div class="ghichu mt-1"><?php echo $noidung_contact_ht;?></div>
									</td>

									<td align="center" width="180" title="<?php echo $txt_tinhtrang_call_hp;?>">
										<a href="javascript:void(0)" class="label label-success" onclick="frm_status_call_hp(this)" data-masv="<?php echo $masv;?>" data-status-call="<?php echo $tinhtrang_call_hp;?>"><?php echo $tinhtrang_call_hp;?></a>
										<div class="txt_status"><?php echo $txt_tinhtrang_call_hp;?></div>
										<div class="ghichu mt-1"><?php echo $noidung_contact_hp;?></div>
									</td>

									<td align="center">
										<select name="cbo_staff" data-masv="<?php echo $masv;?>" class="status cbo_staff form-control">
											<option value="">-- Chọn một --</option>
											<?php
											if(!$IS_NV){
												if(count($STAFF_ALL)>0){
													foreach ($STAFF_ALL as $key => $value) {
														$checked = $value['username']==$id_staff ? 'selected' : '';
														echo '<option value="'.$value['username'].'" '.$checked.'>'.$value['fullname'].'</option>';
													}
												}
											}else{
												foreach ($STAFF_NV as $key => $value) {
													if($value['id']== $_SESSION[MD5($_SERVER['HTTP_HOST']).'_MEMBER_LOGIN']['uid']){
														echo '<option value="'.$value['id'].'" selected>'.$value['fullname'].'</option>';
													}
												}
											}
											?>
										</select>
									</td>

									<td>
										<div class="daotao-info">
											<div class="el nganh"><strong><?php echo $name_nganh;?></strong></div>
											<div class="el khoa">Khóa: <strong><?php echo $name_khoa;?></strong></div>
											<div class="el lop">Lớp: <strong><?php echo $row['malop'];?></strong></div>
											<div class="el nam">Năm: <strong><?php echo $row['namnhaphoc'];?></strong></div>
										</div>
									</td>
								</tr>
								<?php 
								$html.='<tr><td align="center">'.$i.'</td>
								<td>
								<div class="infoSV">
								<div class="name">'.$hoten.'</div>
								<div class="masv"><span class="cblack">Mã SV: </span>'.$masv.'</div>
								<div class="phone"><span class="cblack">SĐT: </span>'.$dienthoai.'</div>
								</div>
								</td>
								<td>'.$txt_level.'</td>
								<td>'.$txt_tinhtrang_sv.'</td>
								<td>'.$txt_tinhtrang_hocphi.'</td>
								<td>'.$txt_tinhtrang_call.'</td>
								<td></td>
								<td>'.$txt_level.'</td>
								<td>'.$txt_tinhtrang_sv.'</td>
								<td>'.$txt_tinhtrang_hocphi.'</td>
								<td>'.$txt_tinhtrang_call.'</td>
								</tr>';
								$i=$i+1;
							endif;
						} 
					}
					$html.="</tbody></table>";?>
				</tbody>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
				<tr><td align="center">
					<?php paging($total_rows,MAX_ROWS,$cur_page); ?>
				</td></tr>
			</table>
		</div>
	</div>
</div>
<div id="divToPrint" style="display:none;"><?php echo $html; ?></div>
<script>
	$(document).ready(function(){
		$("#tk_masv").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_malop").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_hoten").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_ten").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_ns").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_dc").keypress(function(e){
			if(e.which==13) $("#frm_search").submit();
		})
		$("#tk_btnsearch").click(function(){
			$("#frm_search").submit();
		})

		$(".btn-excel").click(function(){
			// showLoading(); 
			// link="<?php echo ROOTHOST;?>excel/export_hsdaotao.php?<?php echo $params;?>";
			// $.get(link,function(req){
			// 	console.log(req);
			// 	hideLoading();
			// 	if(req=="E01") showMess('Vui lòng đăng nhập hệ thống.');
			// 	else if(req=="empty") showMess('Dữ liệu trống.');
			// 	else {
			// 		str='<a href="<?php echo ROOTHOST;?>excel/'+req+'">Download link tại đây</a>';
			// 		showMess(str);
			// 	}
			// })
		});

		$(".btn-print").click(function(){
			showLoading();
			var screenW =screen.width;
			var screenH =screen.height; console.log(screenW+' / '+screenH);
			var divToPrint = document.getElementById('divToPrint');
			var popupWin = window.open('', '_blank','toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width='+screenW+',height='+screenH);
			popupWin.document.open();
			popupWin.document.write('<html><head><title>Danh sách SV</title>');
			popupWin.document.write('</head><body onload="window.print();">');
			popupWin.document.write(divToPrint.innerHTML);
			popupWin.document.write('</body></html>');
			popupWin.document.close();
			hideLoading();
		});

		$(".btn_nhaplop").click(function(){
			var ids = $(this).attr('dataids');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_add_lop.php";
			$.post(url,{'ids': ids},function(req) {
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-title').html('Phân lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		});

		$(".btn-refresh").on("click", function(){
			$("#frm_search").find(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
			$("#frm_search").find(':checkbox, :radio').prop('checked', false);
		});

		$("#dropdownFillter").click(function(){
			$(this).toggleClass("open");
			$("#fillter_advance").toggleClass("active");
		});

		$(".cbo_level").change(function(){
			var masv = $(this).attr("data-masv");
			var level = $(this).val();
			var _data = {
				"masv": masv,
				"cbo_level": level,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_level.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!",""); 
					setTimeout(function(){ 
						window.location.reload(); 
					}, 1000);
				}
			});
		});

		$(".cbo_statusSV").change(function(){
			var masv = $(this).attr("data-masv");
			var statusSV = $(this).val();
			var _data = {
				"masv": masv,
				"cbo_status_sv": statusSV,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_sv.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!","");
				}
			});
		});

		$(".cbo_statusHP").change(function(){
			var _masv = $(this).attr("data-masv");
			var _status_hp = $(this).val();
			var _data = {
				"masv": _masv,
				"cbo_status_hp": _status_hp,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_status_hocphi.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!","");
				}
			});
		});

		$(".cbo_staff").change(function(){
			var _masv = $(this).attr("data-masv");
			var _staff = $(this).val();
			var _data = {
				"masv": _masv,
				"cbo_staff": _staff,
			};

			var _url = "<?php echo ROOTHOST;?>ajaxs/student/process_select_staff.php";
			$.post(_url, _data, function(res){
				if(res=="E01") showMess("Vui lòng đăng nhập hệ thống","error");
				else if(res=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
				else if(res==="success") {
					showMess("Cập nhật thành công!","");
				}
			});
		});
	});

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

function frm_status_call_hp(e){
	var _masv = e.getAttribute('data-masv');
	var _status_call = e.getAttribute('data-status-call');
	if(_status_call.length>0 && _masv.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_call_hp.php';
		var _data = {
			'masv' : _masv,
			'status_call_hp' : _status_call
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật tình trạng cuộc gọi học phí');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}
}

function frm_status_level_multiple(){
	var _ids = $('#txtids').val();
	if(_ids.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_level_multiple.php';
		var _data = {
			'ids' : _ids
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật Level');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}else{
		alert('Chưa lựa chọn đối tượng nào.');
	}
}

function frm_status_sv_multiple(){
	var _ids = $('#txtids').val();
	if(_ids.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_sv_multiple.php';
		var _data = {
			'ids' : _ids
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật tình trạng học viên');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}else{
		alert('Chưa lựa chọn đối tượng nào.');
	}
}

function frm_status_hocphi_multiple(){
	var _ids = $('#txtids').val();
	if(_ids.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_hocphi_multiple.php';
		var _data = {
			'ids' : _ids
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật tình trạng học phí');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}else{
		alert('Chưa lựa chọn đối tượng nào.');
	}
}

function frm_status_call_multiple(){
	var _ids = $('#txtids').val();
	if(_ids.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_call_multiple.php';
		var _data = {
			'ids' : _ids
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật tình trạng cuộc gọi học tập');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}else{
		alert('Chưa lựa chọn đối tượng nào.');
	}
}

function frm_status_call_hp_multiple(){
	var _ids = $('#txtids').val();
	if(_ids.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_status_call_hp_multiple.php';
		var _data = {
			'ids' : _ids
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Cập nhật tình trạng cuộc gọi học phí');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}else{
		alert('Chưa lựa chọn đối tượng nào.');
	}
}

function frm_select_staff_multiple(){
	var _ids = $('#txtids').val();
	if(_ids.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_select_staff_multiple.php';
		var _data = {
			'ids' : _ids
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-lg modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-md');
			$('#myModalPopup .modal-title').html('Chọn người phụ trách');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}else{
		alert('Chưa lựa chọn đối tượng nào.');
	}
}

function frm_tuongtac(e){
	var masv = e.getAttribute('data-masv');
	if(masv.length>0){
		var _url = '<?php echo ROOTHOST;?>ajaxs/student/frm_tuongtac.php';
		var _data = {
			'masv' : masv,
		};
		$.post(_url, _data, function(res){
			$('#myModalPopup .modal-dialog').removeClass('modal-md modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-lg');
			$('#myModalPopup .modal-title').html('Tương tác sinh viên');
			$('#myModalPopup .modal-body').html(res);
			$('#myModalPopup').modal('show');
		})
	}
}
</script>