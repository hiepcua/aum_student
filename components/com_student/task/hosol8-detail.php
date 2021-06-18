<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$_ma_hoso = addslashes(strip_tags(htmlentities($_GET['id'])));

/* ------------------------- API get data ----------------------------*/
$api_data = Curl_Get(ROOTHOST.'test2.php');
$arr_hsL8 = $api_data;
/* ------------------------- /.API get data ----------------------------*/

$row = array();
foreach ($arr_hsL8 as $key => $value) {
	if($value['ma_hoso'] == $_ma_hoso){
		$row = $value;
	}
}
$ngayBG = $row['ngayBG']!=='' ? date('Y-m-d', strtotime($row['ngayBG'])) : '';

/* ------------------------- Check exist hoso ----------------------------*/
$exist_hoso = SysCount('tbl_hocsinh', "AND `ma`='".$_ma_hoso."'");
$txt_mess = $exist_hoso>0 ? 'Đã tồn tại hồ sơ với mã '.$_ma_hoso.' trong hệ thống' : '';
/* ------------------------- /.Check exist hoso ----------------------------*/
?>
<style type="text/css">
	.flex-center{
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.error .form-control{
		border-color: red !important;
	}
</style>
<div class='body profile_view'>
	<form id="frm_hosol8" method="post" action="">
		<div class="page-bar">
			<div class="page-title-breadcrumb">
				<div class="pull-left">
					<div class="page-title tab-title">
						<ul>
							<li class="active"><a href="<?php echo ROOTHOST;?>student/hosol8/<?php echo $_ma_hoso;?>">Hồ sơ cơ bản</a></li>
						</ul>
					</div>
				</div>
				<ul class="box-function pull-right">
					<li>
						<a href="<?php echo ROOTHOST;?>student/hosol8/" class="btn btn-default btn-close" title="Quay lại"><i class="fa fa-reply"></i> Quay lại</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="card-block">
					<div class="media">
						<div class="ajx_mess cred"></div>
						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Mã hồ sơ:<small class="cred"> (*)</small></div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="ma_hoso" class="form-control required" value="<?php echo $row['ma_hoso'];?>" readonly>
							</div>
							<div class="col-md-6 col-xs-4 text">
								<div class="cred" id="txt_mess"><?php echo $txt_mess;?></div>
								<?php
								if($exist_hoso>0){
									echo '<input type="hidden" name="exist_hoso" id="exist_hoso" value="yes">';
								}else{
									echo '<input type="hidden" name="exist_hoso" id="exist_hoso" value="no">';
								}
								?>
							</div>
						</div>
						
						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Họ và tên <small class="cred"> (*)</small></div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hoten" id="hoten" class="form-control required" value="<?php echo $row['hovaten'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">Điện thoại <small class="cred"> (*)</small></div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="dienthoai" class="form-control required" value="<?php echo $row['dienthoai'];?>" readonly>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Email</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="email" class="form-control" value="<?php echo $row['email'];?>">
							</div>
							<div class="col-md-2 col-xs-4 text">Ngày sinh</div>
							<div class="col-md-4 col-xs-8">
								<input type="date" name="ngaysinh" id="ngaysinh" class="form-control" value="<?php echo date("Y-m-d",$row['ngaysinh']);?>">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Nơi sinh</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="noisinh" class="form-control" value="<?php echo $row['noisinh'];?>">
							</div>
							<div class="col-md-2 col-xs-4 text">Giới tính</div>
							<div class="col-md-4 col-xs-8"><fieldset id="group1">
								<input type="radio" name="gender" value="nam" <?php if($row['gioitinh']=='nam') echo 'checked';?>> Nam
								<input type="radio" name="gender" value="nu" <?php if($row['gioitinh']=='nu') echo 'checked';?>> Nữ
							</fieldset></div>
						</div>
						<br>
					</div>
					<div class="clearfix"></div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu sang hồ sơ đào tạo</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Layout người quản lý -->
		<div class="page-bar" style="margin-bottom: 8px;">
			<div class="page-title-breadcrumb">
				<div class="pull-left">
					<div class="page-title tab-title flex-center">
						<ul>
							<li class="active"><a href="javascript:void(0)">Người quản lý</a></li>
						</ul>
						<a href="javascript:void(0)" class="btn btn-primary" onclick="chonnguoiquanly()" style="margin-left: 10px"><i class="fa fa-plus" aria-hidden="true"></i> Chọn người quản lý</a>
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="card-block">
					<div class="media">
						<div class="form-group">
							<div class="col-md-2 col-xs-4 text">Người quản lý</div>
							<div class="col-md-4 col-xs-8">
								<input type="hidden" name="id_nguoiquanly" id="id_nguoiquanly" value="">
								<input type="text" name="nguoiquanly" id="nguoiquanly" class="form-control" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Layout văn bằng -->
		<div class="page-bar" style="margin-bottom: 8px;">
			<div class="page-title-breadcrumb">
				<div class="pull-left">
					<div class="page-title tab-title">
						<ul>
							<li class="active"><a href="javascript:void(0)">Đăng ký văn bằng</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="card-block">
					<div class="media">
						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Ngành đăng ký <small class="cred"> (*)</small></div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="nganhdangky" class="form-control required" value="<?php echo $row['nganhdangky'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">Hệ đào tạo <small class="cred"> (*)</small></div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hedaotao" class="form-control required" value="<?php echo $row['hedaotao'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Ngành đã học</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="nganhdahoc" class="form-control" value="<?php echo $row['nganhdahoc'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Nguồn</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="nguon" class="form-control" value="<?php echo $row['nguon'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">Ghi chú nguồn contact</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="ghichu_nguon_contact" class="form-control" value="<?php echo $row['ghichu_nguon_contact'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Trường chăm sóc</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="truongchamsoc" class="form-control" value="<?php echo $row['truongchamsoc'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">Nhóm khách hàng</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="nhomkhachhang" class="form-control" value="<?php echo $row['nhomkhachhang'];?>" readonly>
							</div>
						</div>
						
						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Ngày bàn giao</div>
							<div class="col-md-4 col-xs-8">
								<input type="date" name="ngayBG" class="form-control" value="<?php echo $row['ngayBG'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">Tình trạng bàn giao</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="tinhtrangBG" class="form-control" value="<?php echo $row['tinhtrangBG'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">Lý do bàn giao</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="lydoBG" class="form-control" value="<?php echo $row['lydoBG'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">HS Tình trạng</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_tinhtrang" class="form-control" value="<?php echo $row['hs_tinhtrang'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">HS vỏ</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_vo" class="form-control" value="<?php echo $row['hs_vo'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">HS ảnh</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_anh" class="form-control" value="<?php echo $row['hs_anh'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">HS bằng</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_bang" class="form-control" value="<?php echo $row['hs_bang'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">HS chứng nhận tốt nghiệp</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_cn_totnghiep" class="form-control" value="<?php echo $row['hs_cn_totnghiep'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">HS chứng minh thư</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_cmt" class="form-control" value="<?php echo $row['hs_cmt'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">HS mô tả</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_mota" class="form-control" value="<?php echo $row['hs_mota'];?>" readonly>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-2 col-xs-4 text">HS sơ yếu lý lịch</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_syll" class="form-control" value="<?php echo $row['hs_syll'];?>" readonly>
							</div>
							<div class="col-md-2 col-xs-4 text">HS khác</div>
							<div class="col-md-4 col-xs-8">
								<input type="text" name="hs_khac" class="form-control" value="<?php echo $row['hs_khac'];?>" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("form#frm_hosol8").submit(function(e) {
			if(validForm()){
				e.preventDefault();
				var _data = $('#frm_hosol8').serializeArray();
				var _url = '<?php echo ROOTHOST;?>ajaxs/student/process_add_hosol8.php';
				$.ajax({
					url: _url,
					data: _data,
					cache: false,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function (res) {
						console.log(res);
					}
				});
			}else{
				e.preventDefault();
			}
		});
	});

	function chonnguoiquanly(){
		// Show popup staff with staff from uid.aumsys.net
		// var _url = '<?php echo ROOTHOST;?>ajaxs/'
	}

	function validForm(){
		var flag = true;
		$('#frm_hosol8 .required').each(function(){
			var val = $(this).val();
			if(!val || val=='' || val=='0') {
				$(this).parent().addClass('error');
				flag = false;
			}

			if(flag==false) {
				$('.ajx_mess').html('Những mục có đánh dấu * là những thông tin bắt buộc.');
			}
		});
		return flag;
	}
</script>