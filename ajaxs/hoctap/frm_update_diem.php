<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$masv = isset($_GET['masv'])?addslashes(strip_tags($_GET['masv'])):'';
$mon = isset($_GET['mon'])?addslashes(strip_tags($_GET['mon'])):'';
$flag=true;
if($masv!='' && $mon!=''){
	$sql="SELECT b.cmt,b.ho_dem,b.name FROM tbl_dangky_tuyensinh AS a 
	INNER JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma 
	WHERE a.masv='$masv'"; 
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc($sql);
	if($r['cmt']!=''){
		$flag=true;
		$cmt=$r['cmt'];
		$secret_string = "d9de08358434ae88846ed819583fccc1";
		$hash=md5($secret_string.$cmt.$mon.'@eea');
		$url="https://lms-dev.eea.edu.vn/grade_api.php?ma_mon=$mon&cmnd=$cmt&hash=$hash";
		$data=json_decode(file_get_contents($url),true);

		if(isset($data['data']['chuyen_can']) && isset($data['data']['kiem_tra'])){
			$diem_chuyencan=floatval($data['data']['chuyen_can']);
			$diem_kiemtra=floatval($data['data']['kiem_tra']);
		}else{
			$diem_chuyencan = null;
			$diem_kiemtra = null;
		}
		?>
		<div class='form-group'>Mã SV: <?php echo $masv;?></div>
		<div class='form-group'>Họ tên: <?php echo $r['ho_dem'].' '.$r['name'];?></div>
		<div class='form-group'>Mã môn: <?php echo $mon;?></div>
		<div class='form-group row'>
			<div class='col-sm-6'>Điểm chuyên cần: <?php echo $diem_chuyencan;?></div>
			<div class='col-sm-6'>Điểm kiểm tra: <?php echo $diem_kiemtra;?></div>
		</div>
		<div class='form-group text-center'><hr/>
			<span style='color:#d00; font-size:24px;'>Kiểm tra điểm trước khi cập nhập!</span><br/>
			<button type='button' class='btn btn-primary' id='btn_confirm_update_diem'>Cập nhập</button>
		</div>
		<script>
			$('#btn_confirm_update_diem').click(function(){
				var _url='<?php echo ROOTHOST;?>ajaxs/hoctap/process_updateDiem.php';
				$.post(_url,{'mon':'<?php echo $mon;?>','masv':'<?php echo $masv;?>','chuyen_can':'<?php echo $diem_chuyencan;?>','kiem_tra':'<?php echo $diem_kiemtra;?>'},function(req){
					if(req=='success'){
						alert('Cập nhập điểm thành công');
						window.location.reload();
					}else{
						alert(req);
					}
				});
			})
		</script>
		<?php	
	}else{
		echo "Sinh viên chưa cập nhập CMT, không thể thực hiện chức năng này!";
		$flag=false;
	}
}else{
	echo "Mã sv hoặc mã môn không xác đinh!";
	$flag=false;
}