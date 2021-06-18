<?php
defined('ISHOME') or die("You can't access this page!");
global $UserLogin;
$UserLogin=new CLS_USER;
$author = $UserLogin->getInfo('username');
$objmysql = new CLS_MYSQL;

// process file upload
$target_file=''; $target_dir = "temp/"; 
$data_import=array();
$msg=$str='';

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
					$TotalCol=7;
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
						$objmysql->Exec("BEGIN"); 
						$flag_result = true;
						foreach ($data as $row) {
							$imp_masv = isset($row[0]) && $row[0]!="" ? antiData($row[0]) : "";
							$imp_monhoc = isset($row[1]) && $row[1]!="" ? antiData($row[1]) : "";
							$arr_diem['chuyencan'] = isset($row[2]) && $row[2]!="" ? antiData($row[2]) : "";
							$arr_diem['diemkt'] = isset($row[3]) && $row[3]!="" ? antiData($row[3]) : "";
							$arr_diem['diemthi'] = isset($row[5]) && $row[5]!="" ? antiData($row[5]) : "";
							$json = json_encode($arr_diem,JSON_UNESCAPED_UNICODE);
							$imp_dieukienthi = isset($row[4]) && $row[4]!="" ? antiData($row[4]) : "NULL";
							$imp_diemthilai = isset($row[6]) && $row[6]!="" ? antiData($row[6]) : "NULL";

							if($imp_masv!="" && $imp_monhoc!=""){
								$sql = "UPDATE tbl_hoctap SET diem='$json', dieukienthi=$imp_dieukienthi, ketqua2=$imp_diemthilai, mdate=".time()." WHERE masv='".$imp_masv."' AND id_monhoc='".$imp_monhoc."'";
								$result = $objmysql->Exec($sql);
								if(!$result) $flag_result = false;
							}
						}
						if($flag_result==true){
							$objmysql->Exec("COMMIT"); $msg="Lưu điểm thành công";
						}else {
							$objmysql->Exec("ROLLBACK"); $msg="Lỗi trong quá trình lưu trữ dữ liệu";
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
					<ul><li class="active"><a href="#">Import điểm sinh viên</a></li></ul>
				</div>
			</div>
			<ul class="box-function pull-right">
				<li><a href="<?php echo ROOTHOST;?>student/qlhoctap" class="btn btn-default btn-close" title="Thoát">
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
						<div class="row">
							<div class="col-md-12 form-group">Tải lên file điểm (.CSV).  
								<a href="<?php echo ROOTHOST;?>temp/mau/import_diem.csv" id="download_file_hoso">
									Download File mẫu tại đây <i class="fa fa-download"></i>
								</a> 
							</div>
							<div class="col-md-12">
								<button type="button" class="btn btn-success import_hoso"><i class="fa fa-upload"></i> Import file điểm</button>

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