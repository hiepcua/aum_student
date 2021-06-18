<?php
defined('ISHOME') or die("You can't access this page!");
global $UserLogin;
$UserLogin=new CLS_USER;
$author = $UserLogin->getInfo('username');
$obj=new CLS_MYSQL;

$HOCSINH = $LOP = $DKTS = array();
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

//---- Lấy danh sách staff ---------
$url='http://uid.aumsys.net/api/user-list';
$json = array();
$json['key'] = PIT_API_KEY;
$json['page'] = '';
$json['maxrow'] = '';
$json['g_code'] = '';
$json['p_code'] = '';

$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
$params = json_encode(array('data'=>$jsondata));
$res_data = Curl_Post($url, $params);
$STAFF = isset($res_data['data']) ? $res_data['data'] : array();

// process file upload
$target_file=''; $target_dir = "temp/hoso/"; 
$data_import=array();
$msg=$str='';

$ARR_STATUS_HOCPHI = array(
	"H01" 	=> 'Đã nộp tại AUM',
	"H02" 	=> 'có hẹn nộp trong tuần',
	"H03" 	=> 'có hẹn nộp tại ngày thi',
	"H04" 	=> 'chưa có tài chính',
	"H05" 	=> 'Đã nộp tại đối tác',
	"H06" 	=> 'Không nghe máy',
	"H07" 	=> 'Hẹn nộp Thứ 2',
	"H08" 	=> 'Hẹn nộp Thứ 3',
	"H09" 	=> 'Hẹn nộp Thứ 4',
	"H10" 	=> 'Hẹn nộp Thứ 5',
	"H11" 	=> 'Hẹn nộp Thứ 6',
	"H12" 	=> 'Hẹn nộp Thứ 7',
	"H13" 	=> 'có hẹn nộp học phí đúng hạn',
	"H14" 	=> 'có hẹn nộp học phí quá hạn',
	"H15" 	=> 'Có ý định bỏ học',
	"H16" 	=> 'Có ý định bảo lưu',
	"H17" 	=> 'Có hẹn nộp tại đối tác',
	"H18" 	=> 'Đã nộp',
	"H19" 	=> 'Đã nộp trước 1 slot',
	"H20" 	=> 'Tạm bảo lưu 1 slot - học slot sau',
	"H21" 	=> 'CS sau  vào tháng 1',
	"H22" 	=> 'CS sau  vào tháng 2',
	"H23" 	=> 'CS sau  vào tháng 3',
	"H24" 	=> 'CS sau  vào tháng 4',
	"H25" 	=> 'CS sau  vào tháng 5',
	"H26" 	=> 'CS sau  vào tháng 6',
	"H27" 	=> 'CS sau  vào tháng 7',
	"H28" 	=> 'CS sau  vào tháng 8',
	"H29" 	=> 'CS sau  vào tháng 9',
	"H30" 	=> 'CS sau  vào tháng 10',
	"H31" 	=> 'CS sau  vào tháng 11',
	"H32" 	=> 'CS sau  vào tháng 12',
);

$ARR_STATUS_SV = array(
	"S01" 	=> 'Đang học ( Đã có QĐTT)',
	"S02A" 	=> 'Bảo lưu 3',
	"S02B" 	=> 'Bảo lưu 06 tháng (Đã có đơn)',
	"S02C" 	=> 'Bảo lưu 01 năm (Đã có đơn)',
	"S03A" 	=> 'Ngưng học do bận, học khó , không có tài chính, tính chất cv',
	"S03B" 	=> 'Ngưng học không rõ nguyên nhân',
	"S03C" 	=> 'Ngưng học do hệ thống học tập, Thi cử, miễn môn, TB học phí',
	"S04A" 	=> 'Chờ tốt nghiệp',
	"S04B" 	=> 'Đã tốt nghiệp'
	// Không nghe máy
	// Ngưng học bảo lưu không có đơn
	// Đang học ( Chưa có QĐTT)
);

if(isset($_FILES["txtfile"]["type"]) && $_FILES["txtfile"]["type"]!=''){
	$ma_nganh = isset($NGANH[$_POST['import_nganh']]) ? $NGANH[$_POST['import_nganh']]['id'] : "";
	$ma_he = isset($_POST['import_he']) ? $_POST['import_he'] : "";
	$ma_nguoiphutrach = isset($_POST['import_staff']) ? $_POST['import_staff'] : "";
	if($ma_nganh=="") die("Chưa chọn ngành học");

	$data_import=array();
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
					// đọc file excel
					include_once (DOCUMENT_ROOT."excel/PHPExcel.php");
					$file = $target_dir.basename($_FILES["txtfile"]["name"]);//Đường dẫn file
					$objFile = PHPExcel_IOFactory::identify($file);//Tiến hành xác thực file
					$objData = PHPExcel_IOFactory::createReader($objFile);
					$objData->setReadDataOnly(true);//Chỉ đọc dữ liệu
					$objPHPExcel = $objData->load($file);// Load dữ liệu sang dạng đối tượng
					$sheet  = $objPHPExcel->setActiveSheetIndex(0);//Chọn trang cần truy xuất
					
					$start=2;
					$Totalrow=$sheet->getHighestRow();
					$TotalCol=42;
					// $LastColumn = $sheet->getHighestColumn();//Lấy ra tên cột cuối cùng

					// check các row có dữ liệu
					$count=0;
					for ($i = $start; $i <= $Totalrow; $i++){
						$value=$sheet->getCellByColumnAndRow(2, $i)->getValue();
						if($value!=NULL){
							$count++;
						}
					}
					$Totalrow=$start+$count;// gán lại $Totalrow
					
					//Tiến hành lặp qua từng ô dữ liệu, Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng $start
					for ($i = $start; $i < $Totalrow; $i++)
					{
						for ($j = 0; $j < $TotalCol; $j++)
						{
							$data[$i][$j]=$sheet->getCellByColumnAndRow($j, $i)->getValue();
						}
					}

					if(!empty($data)){
						$data_hocsinh = array();
						$data_dkts = array();
						$data_khoa = array();
						$data_lop = array();
						$arr_khoa_keys = array();
						$arr_lop_keys = array();

						foreach ($data as $cols) {
							$last_contact 		= isset($cols[0]) && $cols[0]!='' ? strtotime($cols[0]) : 0;
							$ma_hoso 			= isset($cols[1]) && $cols[1]!='' ? antiData($cols[1]) : '';
							$status 			= isset($cols[2]) && $cols[2]!='' ? antiData($cols[2]) : 'L0';
							$fullname 			= isset($cols[3]) && $cols[3]!='' ? antiData($cols[3]) : '';
							$dienthoai 			= isset($cols[4]) && $cols[4]!='' ? antiData($cols[4]) : '';
							$nhomkhachhang 		= isset($cols[5]) && $cols[5]!='' ? antiData($cols[5]) : '';
							$email 				= isset($cols[6]) && $cols[6]!='' ? antiData($cols[6]) : '';
							$noisinh 			= isset($cols[7]) && $cols[7]!='' ? antiData($cols[7]) : '';
							// $id_staff 			= isset($cols[8]) && $cols[8]!='' ? antiData($cols[8]) : '';
							$ngaytao 			= isset($cols[9]) && $cols[9]!='' ? strtotime($cols[9]):0;
							$date_level_up 		= isset($cols[10]) && $cols[10]!='' ? strtotime($cols[10]) : 0;
							$hktt 				= isset($cols[11]) && $cols[11]!='' ? antiData($cols[11]) : '';
							$ngaysinh 			= isset($cols[12]) && $cols[12]!='' ? strtotime($cols[12]) : 0;
							// $nganhdangky		= isset($cols[13]) && $cols[13]!='' ? strtotime($cols[13]) : '';
							$hetotnghiep 		= isset($cols[14]) && $cols[14]!='' ? antiData($cols[14]) : '';
							$gioitinh 			= isset($cols[15]) && $cols[15]!='' && antiData($cols[15])=='Nam'?'nam':'nu';
							$ngayBG 			= isset($cols[16]) && $cols[16]!='' ? strtotime($cols[16]) : '';
							$tinhtrangBG 		= isset($cols[17]) && $cols[17]!='' ? antiData($cols[17]) : '';
							$lydoBG 			= isset($cols[18]) && $cols[18]!='' ? antiData($cols[18]) : '';
							$hs_tinhtrang 		= isset($cols[19]) && $cols[19]!='' ? antiData($cols[19]) : '';
							$hs_vo 				= isset($cols[20]) && $cols[20]!='' ? antiData($cols[20]) : '';
							$hs_anh 			= isset($cols[21]) && $cols[21]!='' ? antiData($cols[21]) : '';
							$hs_bang 			= isset($cols[22]) && $cols[22]!='' ? antiData($cols[22]) : '';
							$hs_cn_totnghiep 	= isset($cols[23]) && $cols[23]!='' ? antiData($cols[23]) : '';
							$hs_bangdiem 		= isset($cols[24]) && $cols[24]!='' ? antiData($cols[24]) : '';
							$hs_hocba 			= isset($cols[25]) && $cols[25]!='' ? antiData($cols[25]) : '';
							$hs_pdk 			= isset($cols[26]) && $cols[26]!='' ? antiData($cols[26]) : '';
							$hs_giay_ks 		= isset($cols[27]) && $cols[27]!='' ? antiData($cols[27]) : '';
							$hs_cmt 			= isset($cols[28]) && $cols[28]!='' ? antiData($cols[28]) : '';
							$hs_mota 			= isset($cols[29]) && $cols[29]!='' ? antiData($cols[29]) : '';
							$khoa 				= isset($cols[30]) && $cols[30]!='' ? antiData($cols[30]) : '';
							$dotnhaphoc 		= isset($cols[31]) && $cols[31]!='' ? antiData($cols[31]) : '';
							$namnhaphoc 		= isset($cols[32]) && $cols[32]!='' ? antiData($cols[32]) : '';
							$kyhoc 				= isset($cols[33]) && $cols[33]!='' ? antiData($cols[33]) : '';
							$malop 				= isset($cols[34]) && $cols[34]!='' ? antiData($cols[34]) : '';
							$masv				= isset($cols[35]) && $cols[35]!='' ? antiData($cols[35]) : '';
							// $giaovu_account		= isset($cols[36]) && $cols[36]!='' ? antiData($cols[36]) : '';
							$qd_trungtuyen 		= isset($cols[37]) && $cols[37]!='' ? antiData($cols[37],'int') : '';
							$qd_congnhansv 		= isset($cols[38]) && $cols[38]!='' ? antiData($cols[38]) : '';
							$tinhtrang_sv 		= isset($cols[39]) && $cols[39]!='' ? antiData($cols[39]) : '';
							$tinhtrang_hocphi 	= isset($cols[40]) && $cols[40]!='' ? antiData($cols[40]) : '';
							$ngaychuyen_level 	= isset($cols[41]) && $cols[41]!='' ? strtotime($cols[41]) : 0;

							$hodem = $name = '';
							if($fullname!=''){
								$arr_name = explode(' ', $fullname);
								$name = end($arr_name);
								$num = count($arr_name);
								foreach ($arr_name as $key => $value) {
									if($key < $num - 1){
										$hodem.= $value.'  ';
									}
									$hodem = substr($hodem, 0, strlen($hodem) - 1);
								}
							}

							$status_HP = $status_SV = "";
							foreach ($ARR_STATUS_HOCPHI as $key => $value) {
								if($tinhtrang_hocphi==$value){
									$status_HP=$key;
								}
							}
							foreach ($ARR_STATUS_SV as $key => $value) {
								if($tinhtrang_sv==$value){
									$status_SV=$key;
								}
							} 

							$hedaotao = $ma_he ;
							$nganhdangky = $ma_nganh;
							$id_staff = $ma_nguoiphutrach;
							$nhaphoc = 1;
							$cdate = time();

							// Data học sinh
							$tmp_hocsinh = array();
							array_push($tmp_hocsinh, $ma_hoso,$hodem,$name,$ngaysinh,$noisinh,$gioitinh,$hktt,$dienthoai,$noisinh,$hktt,$email,$ngaytao,$ngayBG,$tinhtrangBG,$lydoBG);
							$data_hocsinh[] = $tmp_hocsinh;

							// Data đăng ký tuyển sinh
							$tmp_dkts = array();
							array_push($tmp_dkts, $khoa, $hedaotao, $nganhdangky, $malop, $masv, $status, $ma_hoso, $cdate, $nhaphoc, $nhomkhachhang, $id_staff, $date_level_up, $namnhaphoc, $kyhoc, $hs_tinhtrang, $hs_vo, $hs_anh, $hs_bang, $hs_cn_totnghiep, $hs_bangdiem, $hs_hocba, $hs_pdk, $hs_giay_ks, $hs_cmt, $hs_mota, $dotnhaphoc, $hetotnghiep, $qd_trungtuyen, $qd_congnhansv, $status_SV, $status_HP, $last_contact);
							$data_dkts[] = $tmp_dkts;

							// // Bảng khóa
							// if(!in_array($khoa, $arr_khoa)){
							// 	$tmp_khoa = array();

							// 	if(!in_array($khoa, $arr_khoa_keys)){
							// 		$arr_khoa_keys[] = $khoa;
							// 		array_push($tmp_khoa, $khoa, $khoa);
							// 	}
							// 	$data_khoa[] = $tmp_khoa;
							// }

							// // Bảng lớp
							// if(!in_array($malop, $arr_lop)){
							// 	$tmp_lop = array();

							// 	if(!in_array($malop, $arr_lop_keys)){
							// 		$arr_lop_keys[] = $malop;
							// 		array_push($tmp_lop, $malop, $nganhdangky, $hedaotao, $khoa, $malop, $cdate);
							// 	}
							// 	$data_lop[] = $tmp_lop;
							// }
						}

						$values_hocsinh = $values_dkts = $values_khoa = $values_lop = "";
						if(count($data_hocsinh)>0){
							foreach ($data_hocsinh as $key => $hocsinh) {
								if(count($hocsinh)>0){
									$str_hocsinh="";
									foreach ($hocsinh as $key => $value) {
										$str_hocsinh.="'$value',";
									}
									if($str_hocsinh!==""){
										$values_hocsinh.="(".substr($str_hocsinh,0,-1)."),";
									}
								}
							}
							if($values_hocsinh!==""){
								$values_hocsinh=substr($values_hocsinh,0,strlen($values_hocsinh)-1).";";
							}
						}

						if(count($data_dkts)>0){
							foreach ($data_dkts as $key => $hoso) {
								if(count($hoso)>0){
									$str_dkts="";
									foreach ($hoso as $key => $value) {
										$str_dkts.="'$value',";
									}
									if($str_dkts!==""){
										$values_dkts.="(".substr($str_dkts,0,-1)."),";
									}
								}
							}
							if($values_dkts!==""){
								$values_dkts.=substr($values_dkts,0,-1).";";
							}
						}

						// if(count($data_khoa)>0){
						// 	foreach ($data_khoa as $key => $khoa) {
						// 		if(count($khoa)>0){
						// 			$str_khoa="";
						// 			foreach ($khoa as $key => $value) {
						// 				$str_khoa.="'$value',";
						// 			}
						// 			if($str_khoa!==""){
						// 				$values_khoa.="(".substr($str_khoa,0,-1)."),";
						// 			}
						// 		}
						// 	}
						// 	if($values_khoa!==""){
						// 		$values_khoa.=substr($values_khoa,0,-1).";";
						// 	}
						// }

						// if(count($data_lop)>0){
						// 	foreach ($data_lop as $key => $lop) {
						// 		if(count($lop)>0){
						// 			$str_lop="";
						// 			foreach ($lop as $key => $value) {
						// 				$str_lop.="'$value',";
						// 			}
						// 			if($str_lop!==""){
						// 				$values_lop.="(".substr($str_lop,0,-1)."),";
						// 			}
						// 		}
						// 	}
						// 	if($values_lop!==""){
						// 		$values_lop.=substr($values_lop,0,-1).";";
						// 	}
						// }

						$objmysql=new CLS_MYSQL;
						$objmysql->Exec("BEGIN");
						$flag1 = $flag2 = $flag3 = $flag4 = true;

						$sql="INSERT IGNORE INTO tbl_hocsinh (
						`ma`,`ho_dem`,`name`,`ngaysinh`,`noisinh`,
						`gioitinh`,`diachi`,`dienthoai`,`nguyenquan`,`hktt`,`email`,`cdate`,
						`ngayBG`,`tinhtrangBG`,`lydoBG`) VALUES ".$values_hocsinh;
						$result1 = $objmysql->Exec($sql);
						if(!$result1) {
							$flag1 = false;
							// echo "Có mã hồ sơ đã tồn tại";
						}

						$sql2="INSERT IGNORE INTO tbl_dangky_tuyensinh (
						`id_khoa`,`id_he`,`id_nganh`,`malop`,`masv`,`status`,
						`id_hoso`,`cdate`,`nhaphoc`,`nhomkhachhang`,`id_staff`,
						`date_level_up`,`namnhaphoc`,`kyhoc`,
						`hs_tinhtrang`,`hs_vo`,`hs_anh`,`hs_bang`,
						`hs_cn_totnghiep`,`hs_bangdiem`,`hs_hocba`,`hs_pdk`,
						`hs_giay_ks`,`hs_cmt`,`hs_mota`,`dotnhaphoc`,`hetotnghiep`,
						`qd_trungtuyen`,`qd_congnhansv`,`tinhtrang_sv`,`tinhtrang_hocphi`,`last_contact`) VALUES ".$values_dkts;
						$result2 = $objmysql->Exec($sql2);
						if(!$result2) {
							$flag2 = false;
							// echo "Có mã sinh viên đã tồn tại";
						}

						// $sql3="INSERT INTO tbl_khoa2 (`id`,`name`) VALUES ".$values_khoa;
						// echo $sql3;
						// $result3 = $objmysql->Exec($sql3);

						// $sql4="INSERT INTO tbl_lop2 (`id`,`id_nganh`,`id_he`,`id_khoa`,`name`,`cdate`) VALUES ".$values_lop;
						// echo $sql4;
						// $result4 = $objmysql->Exec($sql4);

						if($flag1 && $flag2) {
							$objmysql->Exec("COMMIT"); 
							echo "<script>alert('Import thành công');</script>";
						}else { 
							$objmysql->Exec("ROLLBACK"); 
							echo "<script>alert('Import lỗi.');</script>";
						}
					}
					// Xóa file excel
					unlink($file);
				} else $msg="Tải file không thành công";		
			}
		}else $msg="Dung lượng file không vượt quá 10MB.";
	}
	else{
		$msg="Kiểu file phải là .csv .xls .xlsx";
	}
}?>

<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul><li class="active"><a href="#">Import hồ sơ</a></li></ul>
				</div>
			</div>
			<ul class="box-function pull-right">
				<li><a href="<?php echo ROOTHOST;?>?com=student&task=hoso" class="btn btn-default btn-close" title="Thoát">
					<i class="fa fa-reply"></i> Thoát</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="card-block">
				<div class="media">
					<form name="frm_import" id="frm_import" method="POST"  enctype="multipart/form-data">
						<?php if($msg!='') { ?>
							<div class="row"><div class="col-md-12"><?php echo $msg;?></div></div>
						<?php } ?>
						<div class="ajx_mess cred" style="margin-bottom: 10px;"></div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-12 text">Chọn ngành <small class="cred">(*)</small></div>
							<div class="col-md-5 col-xs-12">
								<select id="cbo_nganh" class="form-control required" name="import_nganh">
									<option value="">-- Chọn ngành --</option>
									<?php
									if(is_array($NGANH) && count($NGANH)>0){
										foreach ($NGANH as $key => $value) {
											echo '<option value="'.$key.'">'.$value['name'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2 col-xs-12 text">Hệ đào tạo <small class="cred">(*)</small></div>
							<div class="col-md-5 col-xs-12">
								<select id="cbo_hedaotao" class="form-control required" name="import_he">
									<?php
									if(is_array($HE) && count($HE)>0){
										foreach ($HE as $key => $value) {
											$select = $key==0 ? "selected" : "";
											echo '<option value="'.$key.'" '.$select.'>'.$value['name'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2 col-xs-12 text">Người phụ trách <small class="cred">(*)</small></div>
							<div class="col-md-5 col-xs-12">
								<select id="cbo_staff" class="form-control required" name="import_staff">
									<option value="">-- Chọn người phụ trách --</option>
									<?php
									if(is_array($STAFF) && count($STAFF)>0){
										foreach ($STAFF as $key => $value) {
											echo '<option value="'.$key.'">'.$value['fullname'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 form-group">Tải lên file danh sách hồ sơ mới. 
								<a href="<?php echo ROOTHOST;?>temp/mau/import_hoso_sv.xlsx" id="download_file_hoso">
									Download File mẫu tại đây <i class="fa fa-download"></i>
								</a> 
							</div>
							<div class="col-md-12">
								<button type="button" class="btn btn-success import_hoso"><i class="fa fa-upload"></i> Import file hồ sơ</button>

								<input type="file" id="txtfile" name="txtfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none" />
								<input type="hidden" id="txttype" name="txttype" value=""> 
							</div>
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cbo_staff').select2();
		$(".import_hoso").click(function(){
			if(validForm()){
				$("#txtfile").trigger('click');
			}
		})
		$('#txtfile').change(function(){
			$('#frm_import').submit();
		});
	});

	function validForm(){
		var flag = true;
		$('#frm_import .required').each(function(){
			var val = $(this).val();
			if(!val || val=='' || val=='0') {
				$(this).parents('.form-group').addClass('error');
				flag = false;
			}else{
				$(this).parents('.form-group').removeClass('error');
			}

			if(flag==false) {
				$('.ajx_mess').html('Những mục có đánh dấu * là những thông tin bắt buộc.');
			}
		});
		return flag;
	}
</script>