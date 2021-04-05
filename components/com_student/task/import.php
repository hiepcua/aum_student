<?php
defined('ISHOME') or die("You can't access this page!");
global $UserLogin;
$UserLogin=new CLS_USER;
$author = $UserLogin->getInfo('username');
$obj=new CLS_MYSQL;
// process file upload
$target_file=''; $target_dir = "temp/"; $data_import=array();
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
					chmod("$target_file", 0755); 
					require('extensions/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
					require('extensions/spreadsheet-reader-master/SpreadsheetReader.php');
					$Reader = new SpreadsheetReader($target_file);
					$i=0; $stt=$success=0;
					$obj->Exec("BEGIN"); $flag_result=true;
					foreach ($Reader as $Row){
						$i++; 						
						if($i>3 && trim($Row[2])!='') {
							$stt++;
							$num=count($data_import);
							$ma = time().$stt;
							$cdate 		= str_replace("'","",trim($Row[1]));
							$cdate 		= str_replace("-","/",$cdate);
							$cdate 		= explode("/",$cdate);
							//mktime(hour, minute, second, month, day, year);
							if($cdate[1]>12 && $cdate[0]<=12) // tháng/ngày/năm
								$cdate = mktime(0, 0, 0, $cdate[0], $cdate[1], $cdate[2]);
							else // ngày/tháng/năm
								$cdate = mktime(0, 0, 0, $cdate[1], $cdate[0], $cdate[2]);
								
							$cmt		= trim($Row[2]);
							$ho_dem 	= trim($Row[3]);
							$name 		= trim($Row[4]);
							$ns 		= str_replace("'","",trim($Row[5]));
							$ns 		= str_replace("-","/",$ns);
							$ns 		= explode("/",$ns);
							//mktime(hour, minute, second, month, day, year);
							if($ns[1]>12 && $ns[0]<=12) // tháng/ngày/năm
								$ngaysinh = mktime(0, 0, 0, $ns[0], $ns[1], $ns[2]);
							else // ngày/tháng/năm
								$ngaysinh = mktime(0, 0, 0, $ns[1], $ns[0], $ns[2]);
							
							//echo $stt.'. '.$Row[1].' ; '.date("d/m/Y",$cdate).' | '.$Row[5].' ; '.date("d/m/Y",$ngaysinh).'<br>';
							$gioitinh	= trim($Row[6]);
							$noisinh	= trim($Row[7]);	
							$city		= trim($Row[7]);	
							$dantoc		= trim($Row[8]);		
							$diachi		= trim($Row[9]);	
							$dienthoai	= trim($Row[10]);	
							$email		= trim($Row[11]);	
							
							$sql="SELECT id FROM tbl_city WHERE name='$city'";
							$obj->Query($sql);
							$r=$obj->Fetch_Assoc();
							$city_id= $r['id'];
							
							// check exist cmt or ma ho so
							$sql="SELECT `ma` FROM tbl_hocsinh WHERE cmt='$cmt' OR `ma`='$ma'";
							$obj->Query($sql);
							if($obj->Num_rows()>0) 
								$str.= "<span style='color:red'>$stt. $ho_dem $name (".date("d/m/Y",$ngaysinh).") - $city (Hồ sơ đã tồn tại)</span><br>";
							else {
								$success++;
								$sql = "INSERT INTO tbl_hocsinh (`ma`,ho_dem,`name`,ngaysinh,noisinh,gioitinh,diachi,city,dienthoai,cmt,email,cdate,author,nhaphoc,status)
								VALUES ('$ma','$ho_dem','$name','$ngaysinh','$noisinh','$gioitinh','$diachi','$city_id','$dienthoai','$cmt','$email',$cdate,'$author','1','L0')";
								$obj->Exec($sql);
								$str.="$stt. $ho_dem $name (".date("d/m/Y",$ngaysinh).") - $city<br>";	
							}
						}
					}
					$msg=$str."<b>Lưu $success hồ sơ thành công</b><hr>";
					
					//var_dump($data_import);
					//file_put_contents('log.txt',json_encode($data_import));
					unlink($target_file);
				} else $msg="Tải file không thành công";		
			}
		}else $msg="Dung lượng file không vượt quá 10MB.";
	}
	else{
		$msg="Kiểu file phải là .csv .xls .xlsx";
	}
} ?>
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
					<i class="fa fa-reply"></i> Thoát</a></li>
			</ul>
		</div>
	</div>
	<div class="card">
		<div class="card-body"><div class="card-block"><div class="media">
			<?php if($msg!='') { ?>
			<div class="row"><div class="col-md-12"><?php echo $msg;?></div></div>
			<?php } ?>
			<div class="row">
				<div class="col-md-12">Tải lên file danh sách hồ sơ mới. 
					<a href="<?php echo ROOTHOST;?>temp/mau/import_hoso_sv.xlsx" id="download_file_hoso">
					Download File mẫu tại đây <i class="fa fa-download"></i></a> 
				</div>
				<div class="col-md-12">
					<button type="button" class="btn btn-success import_hoso"><i class="fa fa-upload"></i> Import file hồ sơ</button>
					<form name="frm_import" id="frm_import" method="POST"  enctype="multipart/form-data">
						<input type="file" id="txtfile" name="txtfile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display:none" />
						<input type="hidden" id="txttype" name="txttype" value=""> 
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div></div></div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".import_hoso").click(function(){
		$("#txtfile").trigger('click');
	})
	$('#txtfile').change(function(){
		console.log('submit');
		$('#frm_import').submit();
	});
})
</script>