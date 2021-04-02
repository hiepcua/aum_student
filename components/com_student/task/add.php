<?php
defined('ISHOME') or die("You can't access this page!");
$ma = time();
if(isset($_SESSION["SV$ma"]['TAB_QHGD'])) unset($_SESSION["SV$ma"]['TAB_QHGD']);
if(isset($_SESSION["SV$ma"]['TAB_QTHT'])) unset($_SESSION["SV$ma"]['TAB_QTHT']);
if(isset($_SESSION["SV$ma"]['TAB_QTHOC'])) unset($_SESSION["SV$ma"]['TAB_QTHOC']);
if(isset($_SESSION["SV$ma"]['TAB_KHENTHUONG'])) unset($_SESSION["SV$ma"]['TAB_KHENTHUONG']);
if(isset($_SESSION["SV$ma"]['TAB_KYLUAT'])) unset($_SESSION["SV$ma"]['TAB_KYLUAT']);
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
					<button type="button" class="btn btn-success btn-save"  title="Lưu hồ sơ"><i class="fa fa-save"></i> Lưu</button>
				</li>
				<li>
					<a href="<?php echo ROOTHOST;?>?com=student&task=hoso" class="btn btn-default btn-close" title="Thoát"><i class="fa fa-reply"></i> Thoát</a>
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
									<div class="col-md-2 col-xs-4 text">Mã hồ sơ</div>
									<div class="col-md-4 col-xs-8">
										<input type="number" name="ma" id="ma" class="form-control" value="<?php echo $ma;?>" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Họ và tên</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="hoten" id="hoten" class="form-control" required>
									</div>
									<div class="col-md-2 col-xs-4 text">Giới tính</div>
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
									<div class="col-md-2 col-xs-4 text">Quốc tịch</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="quoctich" id="quoctich" class="form-control" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày sinh</div>
									<div class="col-md-4 col-xs-8">
										<input type="date" name="ngaysinh" id="ngaysinh" class="form-control" required placeholder="tháng/ngày/năm">
									</div>
									<div class="col-md-2 col-xs-4 text">Nơi sinh</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="noisinh" id="noisinh" class="form-control" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Nguyên quán</div>
									<div class="col-md-10 col-xs-8">
										<input type="text" name="nguyenquan" id="nguyenquan" class="form-control" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Hộ khẩu</div>
									<div class="col-md-10 col-xs-8">
										<input type="text" name="hokhau" id="hokhau" class="form-control" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Tỉnh/Thành</div>
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
								<div class="row form-group"></div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Dân tộc</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="dantoc" id="dantoc" class="form-control" required>
									</div>
									<div class="col-md-2 col-xs-4 text">Tôn giáo</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="tongiao" id="tongiao" class="form-control" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Khu vực TS</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="khuvuc" id="khuvuc" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Đối tượng</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="doituong" id="doituong" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Đạo đức</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="daoduc" id="daoduc" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Trình độ VH</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="trinhdo" id="trinhdo" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Diện chính sách</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="diencs" id="diencs" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">T.phần gia đình</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="thanhphan" id="thanhphan" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày vào Đoàn</div>
									<div class="col-md-4 col-xs-8">
										<input type="date" name="doan" id="doan" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Ngày vào Đảng</div>
									<div class="col-md-4 col-xs-8">
										<input type="date" name="dang" id="dang" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày chính thức</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="ngayct" id="ngayct" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">CMND/CCCD</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="cmnd" id="cmnd" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày cấp</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="ngaycap" id="ngaycap" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Nơi cấp</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="noicap" id="noicap" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Số tài khoản</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="stk" id="stk" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Email</div>
									<div class="col-md-4 col-xs-8">
										<input type="email" name="email" id="email" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Địa chỉ liên lạc</div>
									<div class="col-md-10 col-xs-8">
										<input type="text" name="diachi" id="diachi" class="form-control">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Điện thoại</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="dienthoai" id="dienthoai" class="form-control">
									</div>
									<div class="col-md-2 col-xs-4 text">Ghi chú</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="ghichu" id="ghichu" class="form-control">
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="box-tabs box-add">
								<ul class="tabs-function">
									<li>
										<button type="button" class="btn btn-default add-row" title="Thêm hàng"><i class="fa fa-folder-open"></i></button>
									</li>
								</ul>
								<ul class="nav nav-tabs step-form" role="tablist">
									<li>
										<a href="#tab1" role="tab" data-toggle="tab">
											<div class="item">QH gia đình</div>
										</a>
									</li><li class="">
										<a href="#tab2" role="tab" data-toggle="tab">
											<div class="item">QT học tập</div>
										</a>
									</li><li class="">
										<a href="#tab3" role="tab" data-toggle="tab">
											<div class="item">QT học tại trường</div>
										</a>
									</li><li class="">
										<a href="#tab4" role="tab" data-toggle="tab">
											<div class="item">Khen thưởng</div>
										</a>
									</li><li class="">
										<a href="#tab5" role="tab" data-toggle="tab">
											<div class="item">Kỷ luật</div>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade active in" id="tab1">
										<table class="table table-striped">
											<thead><tr><th></th>
												<th>STT</th>
												<th>Quan hệ</th>
												<th>Họ và tên</th>
												<th>Năm sinh</th>
												<th>Nghề nghiệp</th>
												<th>Hộ khẩu</th>
												<th>Ghi chú</th>
											</tr></thead>
											<tbody></tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab2">
										<table class="table table-striped">
											<thead><tr><th></th>
												<th>STT</th>
												<th>Từ năm</th>
												<th>Đến năm</th>
												<th>Học gì</th>
												<th>Nơi đâu</th>
												<th>Chức vụ</th>
											</tr></thead>
											<tbody></tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab3">
										<table class="table table-striped">
											<thead><tr><th></th>
												<th>STT</th>
												<th>Thời gian</th>
												<th>Nội dung</th>
												<th>Lớp</th>
											</tr></thead>
											<tbody></tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab4">
										<table class="table table-striped">
											<thead><tr><th></th>
												<th>STT</th>
												<th>Học kỳ</th>
												<th>Hình thức</th>
												<th>Lý do</th>
												<th>Quyết định</th>
												<th>Ngày</th>
												<th>Ghi chú</th>
											</tr></thead>
											<tbody></tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab5">
										<table class="table table-striped">
											<thead><tr><th></th>
												<th>STT</th>
												<th>Học kỳ</th>
												<th>Hình thức</th>
												<th>Lý do</th>
												<th>Quyết định</th>
												<th>Từ ngày</th>
												<th>Đến ngày</th>
											</tr></thead>
											<tbody></tbody>
										</table>
									</div>
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
		$(".avatar").click(function(){
			$("#FileUpload").click();
		});

		$("#FileUpload").on('change', function(){
			readURL(this);
		});

		$(".tabs-function .add-row").click(function(){
			var idtab = $(".tab-content .active").attr('id');
			var ma = "<?php echo $ma;?>";
			var url = "";
			if(idtab=="tab1")
				url = "<?php echo ROOTHOST;?>ajaxs/student/add_qhgd.php?ma="+ma;
			if(idtab=="tab2")
				url = "<?php echo ROOTHOST;?>ajaxs/student/add_qtht.php?ma="+ma;
			if(idtab=="tab3")
				url = "<?php echo ROOTHOST;?>ajaxs/student/add_qthoc.php?ma="+ma;
			if(idtab=="tab4")
				url = "<?php echo ROOTHOST;?>ajaxs/student/add_khenthuong.php?ma="+ma;
			if(idtab=="tab5")
				url = "<?php echo ROOTHOST;?>ajaxs/student/add_kyluat.php?ma="+ma;
			$.get(url,function(new_row){
				$("#"+idtab).html(new_row);
			})
		});

		$(".box-function .btn-save").click(function(){
			var ma = "<?php echo $ma;?>";
			if(checkinput()==true) {
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_add.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#student_add").serialize(),
					success: function(req){
						// console.log(req);
						if(req=="error") showMess("Lỗi trong quá trình lưu dữ liệu!","error");
						else if(ma===req) {
							showMess("Lưu hồ sơ thành công!",""); 
							setTimeout(function(){ 
								window.location="<?php echo ROOTHOST;?>student/profile/"+ma; 
							}, 2000);
						}
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
	$(".edit_qhgd").click(function(){
		var ma = "<?php echo $ma;?>";
		var row_id = $(this).attr('dataid');
		var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_qhgd.php";
		$.post(url,{'ma':ma,'row_id':row_id},function(req){
			$("#tab1").html(req);
		})
	})
	$(".del_qhgd").click(function(){
		var ma = "<?php echo $ma;?>";
		var row_id = $(this).attr('dataid');
		var url = "<?php echo ROOTHOST;?>ajaxs/student/del_qhgd.php";
		$.post(url,{'ma':ma,'row_id':row_id},function(req){
			$("#tab1").html(req);
		})
	})
	function checkinput(){
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