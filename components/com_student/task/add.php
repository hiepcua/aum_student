<?php
defined('ISHOME') or die("You can't access this page!");
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul><li class="active"><a href="#">Hồ sơ</a></li></ul>
				</div>
			</div>
			<ul class="box-function pull-right">
				<li>
					<a href="<?php echo ROOTHOST;?>/student/hoso" class="btn btn-default btn-close" title="Thoát"><i class="fa fa-reply"></i> Thoát</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="card-block">
				<div class="media">
					<div class="row">
						<form name="student_add" id="student_add" class="form" action="#" method="post" enctype='multipart/form-data'>
							<div class="col-md-3 col-xs-12">
								<div class="col-md-12 col-xs-4">
									<div class="widget-fileupload fileupload fileupload-new" data-provides="fileupload">
										<label>Ảnh đại diện</label><small> (Dung lượng < 10MB)</small>
										<div class="widget-avatar mb-2">
											<div class="fileupload-new thumbnail">
												<img src="<?php echo ROOTHOST;?>global/img/no-photo.jpg" id="img_image_preview">
											</div>
											<div class="fileupload-preview fileupload-exists thumbnail" style="line-height: 20px;"></div>
										</div>
										<div class="control">
											<div class="btn btn-file">
												<span class="fileupload-new">Tải lên</span>
												<span class="fileupload-exists">Thay đổi</span>
												<input type="file" id="FileUpload" name="txt_thumb" accept="image/jpg, image/jpeg">
											</div>
											<a href="javascript:void(0)" class="btn fileupload-exists" data-dismiss="fileupload" onclick="cancel_fileupload()">Hủy</a>
										</div>
									</div>
								</div>

								<div class="col-md-12 col-xs-8">
									<div class="row form-group"></div>
								</div>
							</div>
							<div class="col-md-9 col-xs-12">
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Mã hồ sơ <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<input type="number" name="ma" id="ma" class="form-control" value="" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Họ và tên <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="hoten" id="hoten" class="form-control" required>
									</div>
									<div class="col-md-2 col-xs-4 text">Giới tính <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8"><fieldset id="group1">
										<input type="radio" name="gender" value="0"> <?php echo $GLOBALS['ARR_GENDER'][0];?>
										<input type="radio" name="gender" value="1"> <?php echo $GLOBALS['ARR_GENDER'][1];?>
									</fieldset></div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Tên thường gọi</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="tengoi" id="tengoi" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Quốc tịch <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="quoctich" id="quoctich" class="form-control" value="Việt Nam" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày sinh <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<input type="date" name="ngaysinh" id="ngaysinh" class="form-control" required placeholder="tháng/ngày/năm">
									</div>
									<div class="col-md-2 col-xs-4 text">Nơi sinh <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="noisinh" id="noisinh" class="form-control" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Nguyên quán <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="nguyenquan" id="nguyenquan" class="form-control" required>
									</div>
									<div class="col-md-2 col-xs-4 text">Hộ khẩu <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="hokhau" id="hokhau" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Tỉnh/Thành <span class="cred">*</span></div>
									<div class="col-md-4 col-xs-8">
										<select name="cbo_city[]" id="cbo_city" class="form-control" required>
											<option value=""></option>
											<?php
											include_once(LIB_PATH.'cls.city.php');
											$objCb=new CLS_city();
											$objCb->getList();
											while ($city = $objCb->Fetch_Assoc()) {?>
												<option value="<?php echo $city['id'];?>"><?php echo $city['name'];?></option>
											<?php } unset($objCb); ?>
										</select>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Điện thoại</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="dienthoai" id="dienthoai" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Email</div>
									<div class="col-md-4 col-xs-8">
										<input type="email" name="email" id="email" class="form-control">
									</div>
								</div>
								<div class="text-center form-group"><br/>
									<button type="button" class="btn btn-success btn-save"  title="Lưu hồ sơ">
									<i class="fa fa-save"></i> Lưu hồ sơ</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#student_add").validate();
		$(".avatar").click(function(){
			$("#FileUpload").click();
		});

		$("#FileUpload").on('change', function(){
			readURL(this);
		});

		$("#student_add .btn-save").click(function(){
			if(checkinput()==true) {
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_add.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#student_add").serialize(),
					success: function(req){
						console.log(req);
						if(req == "success") {
							var ma = $("#ma").val();
							showMess("Lưu hồ sơ thành công!",""); 
							setTimeout(function(){ 
								window.location="<?php echo ROOTHOST;?>student/profile/"+ma; 
							}, 2000);
						}if(req == "exist") {
							showMess("Mã hồ sơ đã có trong hệ thống. Vui lòng nhập mã khác.","error");
							$("#ma").focus();
						}else 
							showMess("Lỗi trong quá trình lưu dữ liệu!","error");
					}
				});
			}
		});
	})
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				var img = document.createElement("img");
				img.src = e.target.result;
				$('.fileupload').removeClass('fileupload-new');
				$('.fileupload').addClass('fileupload-exists');
				$('.fileupload-preview').html(img);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	function cancel_fileupload(){
		$('.fileupload').removeClass('fileupload-exists');
		$('.fileupload').addClass('fileupload-new');
		$('.fileupload-preview').empty();
		$("#file_image").val('');
	}
	
	function checkinput(){
		if($("#ma").val()=="") {
			$("#ma").focus();
			$("#ma").addClass('novalid');
			return false;
		}else {
			$("#ma").removeClass('novalid');
		}
		if($("#hoten").val()=="") {
			$("#hoten").focus();
			$("#hoten").addClass('novalid');
			return false;
		}else {
			$("#hoten").removeClass('novalid');
		}
		if($("#ngaysinh").val()=="") {
			$("#ngaysinh").focus();
			$("#ngaysinh").addClass('novalid');
			return false;
		}else {
			$("#ngaysinh").removeClass('novalid');
		}
		if($("#noisinh").val()=="") {
			$("#noisinh").focus();
			$("#noisinh").addClass('novalid');
			return false;
		}else {
			$("#noisinh").removeClass('novalid');
		}
		if($("#nguyenquan").val()=="") {
			$("#nguyenquan").focus();
			$("#nguyenquan").addClass('novalid');
			return false;
		}else {
			$("#nguyenquan").removeClass('novalid');
		}
		if($("#hokhau").val()=="") {
			$("#hokhau").focus();
			$("#hokhau").addClass('novalid');
			return false;
		}else {
			$("#hokhau").removeClass('novalid');
		}
		if($("#cbo_city").val()=="") {
			$("#cbo_city").focus();
			$("#cbo_city").addClass('novalid');
			return false;
		}else {
			$("#cbo_city").removeClass('novalid');
		}
		return true;
	}
</script>