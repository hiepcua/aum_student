<?php
defined('ISHOME') or die("You can't access this page!");
if(!isset($_GET['id'])) die("<br>Vui lòng chọn hồ sơ cần xem");
$ma = addslashes(strip_tags(htmlentities($_GET['id'])));

if(isset($_SESSION["SV$ma"]['TAB_QHGD'])) unset($_SESSION["SV$ma"]['TAB_QHGD']);
if(isset($_SESSION["SV$ma"]['TAB_QHHT'])) unset($_SESSION["SV$ma"]['TAB_QHHT']);
if(isset($_SESSION["SV$ma"]['TAB_QHHOC'])) unset($_SESSION["SV$ma"]['TAB_QHHOC']);
if(isset($_SESSION["SV$ma"]['TAB_KHENTHUONG'])) unset($_SESSION["SV$ma"]['TAB_KHENTHUONG']);
if(isset($_SESSION["SV$ma"]['TAB_KYLUAT'])) unset($_SESSION["SV$ma"]['TAB_KYLUAT']);

$objhs = new CLS_HS;
$objhs->getList(" AND ma='$ma'");
$r=$objhs->Fetch_Assoc();
$dmhoso = ($r['dmhoso']!==null && $r['dmhoso']!=='') ? json_decode($r['dmhoso'],true) : array();
$dmhoso_ids='';
if(count($dmhoso)>0) {
	foreach($dmhoso as $k=>$v){
		if($v['status']==1)
			$dmhoso_ids.=$v['id'].",";
	}
}
$_SESSION["SV$ma"]['TAB_QHGD'] = json_decode($r['qhgiadinh'],true);
$_SESSION["SV$ma"]['TAB_QTHT'] = json_decode($r['qthoctap'],true);
$_SESSION["SV$ma"]['TAB_QHHOC'] = json_decode($r['qthoc'],true);
$_SESSION["SV$ma"]['TAB_KHENTHUONG'] = json_decode($r['khenthuong'],true);
$_SESSION["SV$ma"]['TAB_KYLUAT'] = json_decode($r['kyluat'],true);
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title tab-title">
					<ul><li class="active"><a href="<?php echo ROOTHOST;?>student/profile/<?php echo $ma;?>">
					Sơ yếu lý lịch</a></li></ul>
				</div>
			</div>
			<ul class="box-function pull-right">
				<li><button type="button" class="btn btn-success btn-save"  title="Lưu hồ sơ"><i class="fa fa-save"></i> Lưu</button></li>
				<li><a href="<?php echo ROOTHOST.'student/profile/'.$ma;?>" class="btn btn-default btn-close" title="Quay lại"><i class="fa fa-reply"></i> Quay lại</a></li>
			</ul>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="card-block">
				<div class="media">
					<div class="row">
						<form name="student_edit" id="student_edit" class="form" action="#" method="post" enctype='multipart/form-data'>
							<div class="col-md-3 col-xs-12">
								<div class="col-md-12 col-xs-4 text-center">
									<div class="avatar"></div>
									<input type="file" id="FileUpload" style="display: none" accept="image/*"/>
								</div>
							</div>
							<div class="col-md-9 col-xs-12">
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">ID</div>
									<div class="col-md-4 col-xs-8">
										<input type="number" name="ma" id="" class="form-control" value="<?php echo $r['ma'];?>" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Họ và tên</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="hoten" id="hoten" class="form-control" value="<?php echo $r['ho_dem'].' '.$r['name'];?>" required>
									</div>
									<div class="col-md-2 col-xs-4 text">Giới tính</div>
									<div class="col-md-4 col-xs-8"><fieldset id="group1">
										<input type="radio" name="gender" value="0" <?php if($r['gioitinh']==0) echo 'checked';?>> 
										<?php echo $GLOBALS['ARR_GENDER'][0];?>
										<input type="radio" name="gender" value="1" <?php if($r['gioitinh']==1) echo 'checked';?>> 
										<?php echo $GLOBALS['ARR_GENDER'][1];?>
									</fieldset></div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Tên thường gọi</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="tengoi" id="tengoi" class="form-control" value="<?php echo $r['nickname'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">Quốc tịch</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="quoctich" id="quoctich" class="form-control" value="<?php echo $r['quoctich'];?>" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày sinh</div>
									<div class="col-md-4 col-xs-8">
										<input type="date" name="ngaysinh" id="ngaysinh" class="form-control" value="<?php echo date("Y-m-d",$r['ngaysinh']);?>" required  placeholder="tháng/ngày/năm">
									</div>
									<div class="col-md-2 col-xs-4 text">Nơi sinh</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="noisinh" id="noisinh" class="form-control" value="<?php echo $r['noisinh'];?>" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Nguyên quán</div>
									<div class="col-md-10 col-xs-8">
										<input type="text" name="nguyenquan" id="nguyenquan" class="form-control" value="<?php echo $r['nguyenquan'];?>" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Hộ khẩu</div>
									<div class="col-md-10 col-xs-8">
										<input type="text" name="hokhau" id="hokhau" class="form-control" value="<?php echo $r['hktt'];?>" required>
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
											while ($city = $objCb->Fetch_Assoc()) {
												$selected=""; if($city['id']==$r['city']) $selected="selected";?>
												<option value="<?php echo $city['id'];?>" <?php echo $selected;?>><?php echo $city['name'];?></option>
											<?php } unset($objCb); ?>
										</select>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Dân tộc</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="dantoc" id="dantoc" class="form-control" value="<?php echo $r['dantoc'];?>" required>
									</div>
									<div class="col-md-2 col-xs-4 text">Tôn giáo</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="tongiao" id="tongiao" class="form-control" value="<?php echo $r['tongiao'];?>" required>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Khu vực TS</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="khuvuc" id="khuvuc" class="form-control" value="<?php echo $r['khuvucTS'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">Đối tượng</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="doituong" id="doituong" class="form-control" value="<?php echo $r['doituongUT'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Đạo đức</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="daoduc" id="daoduc" class="form-control" value="<?php echo $r['daoduc'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">Trình độ VH</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="trinhdo" id="trinhdo" class="form-control" value="<?php echo $r['trinhdo'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Diện chính sách</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="diencs" id="diencs" class="form-control" value="<?php echo $r['diencs'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">T.phần gia đình</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="thanhphan" id="thanhphan" class="form-control" value="<?php echo $r['thanhphan'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày vào Đoàn</div>
									<div class="col-md-4 col-xs-8">
										<input type="date" name="doan" id="doan" class="form-control" value="<?php echo $r['doan'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">Ngày vào Đảng</div>
									<div class="col-md-4 col-xs-8">
										<input type="date" name="dang" id="dang" class="form-control" value="<?php echo $r['dang'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày chính thức</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="ngayct" id="ngayct" class="form-control" value="<?php echo $r['ngayct'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">CMND/CCCD</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="cmnd" id="cmnd" class="form-control" value="<?php echo $r['cmt'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Ngày cấp</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="ngaycap" id="ngaycap" class="form-control" value="<?php echo $r['ngaycap_cmt'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">Nơi cấp</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="noicap" id="noicap" class="form-control" value="<?php echo $r['noicap_cmt'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Số tài khoản</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="stk" id="stk" class="form-control" value="<?php echo $r['stk'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">Email</div>
									<div class="col-md-4 col-xs-8">
										<input type="email" name="email" id="email" class="form-control" value="<?php echo $r['email'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Địa chỉ liên lạc</div>
									<div class="col-md-10 col-xs-8">
										<input type="text" name="diachi" id="diachi" class="form-control" value="<?php echo $r['diachi'];?>">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-md-2 col-xs-4 text">Điện thoại</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="dienthoai" id="dienthoai" class="form-control" value="<?php echo $r['dienthoai'];?>">
									</div>
									<div class="col-md-2 col-xs-4 text">Ghi chú</div>
									<div class="col-md-4 col-xs-8">
										<input type="text" name="ghichu" id="ghichu" class="form-control" value="<?php echo $r['note'];?>">
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="box-tabs box-add">
								<ul class="tabs-function">
									<li>
										<button type="button" class="btn btn-default add-row" title="Thêm hàng"><i class="fa fa-folder-open"></i></button>
									</li>
									<li>
										<button type="button" class="btn btn-default delete-row red" title="Xóa hàng"><i class="fa fa-times"></i></button>
									</li>
								</ul>
								<ul class="nav nav-tabs step-form" role="tablist">
									<li class="active">
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
									<li class="">
										<a href="#tab6" role="tab" data-toggle="tab">
											<div class="item">DM hồ sơ</div>
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade active in" id="tab1">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>STT</th>
													<th>Quan hệ</th>
													<th>Họ và tên</th>
													<th>Năm sinh</th>
													<th>Nghề nghiệp</th>
													<th>Hộ khẩu</th>
													<th>Ghi chú</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php $stt=0; if(is_array($_SESSION["SV$ma"]['TAB_QHGD']) && count($_SESSION["SV$ma"]['TAB_QHGD'])>0) {
													foreach($_SESSION["SV$ma"]['TAB_QHGD'] as $item) {?>
														<tr dataid="<?php echo $stt;?>"><td><?php echo $stt+1;?></td>
															<td><?php echo $item['qh'];?></td>
															<td><?php echo $item['name'];?></td>
															<td><?php echo $item['ns'];?></td>
															<td><?php echo $item['nn'];?></td>
															<td><?php echo $item['hk'];?></td>
															<td><?php echo $item['note'];?></td>
															<td><button type="button" class="btn btn-default edit_qhgd" dataid="<?php echo $stt;?>"><i class="fa fa-edit"></i></button></td>
														</tr>
														<?php  $stt++;
													} 
												} ?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab2">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>STT</th>
													<th>Từ năm</th>
													<th>Đến năm</th>
													<th>Học gì</th>
													<th>Nơi đâu</th>
													<th>Chức vụ</th><th></th>
												</tr>
											</thead>
											<tbody>
												<?php $stt=0; if(is_array($_SESSION["SV$ma"]['TAB_QTHT']) && count($_SESSION["SV$ma"]['TAB_QTHT'])>0) {
													foreach($_SESSION["SV$ma"]['TAB_QTHT'] as $item) {?>
														<tr dataid="<?php echo $stt;?>"><td><?php echo $stt+1;?></td>
															<td><?php echo $item['tunam'];?></td>
															<td><?php echo $item['dennam'];?></td>
															<td><?php echo $item['lamgi'];?></td>
															<td><?php echo $item['noidau'];?></td>
															<td><?php echo $item['chucvu'];?></td>
															<td><button type="button" class="btn btn-default edit_qtht" dataid="<?php echo $stt;?>"><i class="fa fa-edit"></i></button></td>
														</tr>
														<?php  $stt++;
													} 
												} ?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab3">
										<table class="table table-striped">
											<thead><tr>
												<th>STT</th>
												<th>Thời gian</th>
												<th>Nội dung</th>
												<th>Lớp</th><th></th>
											</tr></thead>
											<tbody>
												<?php $stt=0; if(is_array($_SESSION["SV$ma"]['TAB_QHHOC']) && count($_SESSION["SV$ma"]['TAB_QHHOC'])>0) {
													foreach($_SESSION["SV$ma"]['TAB_QHHOC'] as $item) {?>
														<tr dataid="<?php echo $stt;?>"><td><?php echo $stt+1;?></td>
															<td><?php echo $item['thoigian'];?></td>
															<td><?php echo $item['noidung'];?></td>
															<td><?php echo $item['lop'];?></td>
															<td><button type="button" class="btn btn-default edit_qthoc" dataid="<?php echo $stt;?>"><i class="fa fa-edit"></i></button></td>
														</tr>
														<?php  $stt++;
													} 
												} ?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab4">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>STT</th>
													<th>Học kỳ</th>
													<th>Hình thức</th>
													<th>Lý do</th>
													<th>Quyết định</th>
													<th>Ngày</th>
													<th>Ghi chú</th><th></th>
												</tr>
											</thead>
											<tbody>
												<?php $stt=0; if(is_array($_SESSION["SV$ma"]['TAB_KYLUAT']) && count($_SESSION["SV$ma"]['TAB_KYLUAT'])>0) {
													foreach($_SESSION["SV$ma"]['TAB_KYLUAT'] as $item) {?>
														<tr dataid="<?php echo $stt;?>"><td><?php echo $stt+1;?></td>
															<td><?php echo $item['hocky'];?></td>
															<td><?php echo $item['hinhthuc'];?></td>
															<td><?php echo $item['lydo'];?></td>
															<td><?php echo $item['quyetdinh'];?></td>
															<td><?php echo $item['tungay'];?></td>
															<td><?php echo $item['denngay'];?></td>
															<td><button type="button" class="btn btn-default edit_kyluat" dataid="<?php echo $stt;?>"><i class="fa fa-edit"></i></button></td>
														</tr>
														<?php  $stt++;
													} 
												} ?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane fade" id="tab5">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>STT</th>
													<th>Học kỳ</th>
													<th>Hình thức</th>
													<th>Lý do</th>
													<th>Quyết định</th>
													<th>Từ ngày</th>
													<th>Đến ngày</th><th></th>
												</tr>
											</thead>
											<tbody>
												<?php $stt=0; if(is_array($_SESSION["SV$ma"]['TAB_KHENTHUONG']) && count($_SESSION["SV$ma"]['TAB_KHENTHUONG'])>0) {
													foreach($_SESSION["SV$ma"]['TAB_KHENTHUONG'] as $item) {?>
														<tr dataid="<?php echo $stt;?>"><td><?php echo $stt+1;?></td>
															<td><?php echo $item['hocky'];?></td>
															<td><?php echo $item['hinhthuc'];?></td>
															<td><?php echo $item['lydo'];?></td>
															<td><?php echo $item['quyetdinh'];?></td>
															<td><?php echo $item['ghichu'];?></td>
															<td><button type="button" class="btn btn-default edit_khenthuong" dataid="<?php echo $stt;?>"><i class="fa fa-edit"></i></button></td>
														</tr>
														<?php  $stt++;
													} 
												} ?>
											</tbody>
										</table>
									</div>
									<div class="tab-pane fade in" id="tab6">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>STT</th>
													<th>Danh mục</th>
													<th><input type="checkbox" name="chkall_hoso" id="chkall_hoso" onclick="HSCheckAll(this.checked);">Nộp đủ</th>
													<th>Ngày nộp</th>
												</tr>
											</thead>
											<tbody>
												<?php if(count($dmhoso)>0) { 
													$i=1; 
													foreach($dmhoso as $k=>$v) {?>
														<tr>
															<td><?php echo $i;?></td>
															<td><?php echo $v['name'];?></td>
															<td><input type="checkbox" name="chk_hoso[<?php echo $v['id'];?>]" class="chk_hoso" onclick="HSCheckOnce();" value="<?php echo $v['name'];?>" dataid="<?php echo $v['id'];?>" <?php if($v['status']==1) echo "checked";?>></td>
															<td><input type="text" name="date_hoso[<?php echo $v['id'];?>]" class="date_hoso" dataid="<?php echo $v['id'];?>" value="<?php echo $v['date'];?>" placeholder="ngày/tháng/năm"></td>
														</tr>
														<?php $i++;
													}
												} else { 
													$obj=new CLS_MYSQL;
													$sql="SELECT * FROM tbl_dmhoso WHERE `all`=1";
													$obj->Query($sql); $i=1;
													while($r_hs = $obj->Fetch_Assoc()) {?>
														<tr>
															<td><?php echo $i;?></td>
															<td><?php echo $r_hs['name'];?></td>
															<td><input type="checkbox" name="chk_hoso[<?php echo $r_hs['id'];?>]" class="chk_hoso" onclick="HSCheckOnce();" value="<?php echo $r_hs['name'];?>" dataid="<?php echo $r_hs['id'];?>"></td>
															<td><input type="text" name="date_hoso[<?php echo $r_hs['id'];?>]" class="date_hoso" dataid="<?php echo $r_hs['id'];?>" placeholder="ngày/tháng/năm"></td>
														</tr>
														<?php $i++;
													}
												}?>
											</tbody>
										</table>
										<input type="hidden" name="dmhoso_ids" id="dmhoso_ids" value="<?php echo $dmhoso_ids;?>"/>
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
		$(".tk_xettuyen").click(function(){
			var value = $(".tk_xettuyen:checked").val();
			if(parseInt(value)==0) {
				$('.thituyen').removeClass('hidden');
			}else{
				$('.thituyen').addClass('hidden'); 
			}
		})
		$(".avatar").click(function(){
			$("#FileUpload").click();
		})
		$("#FileUpload").change(function () {

		});
		$(".tabs-function .add-row").click(function(){
			var ma = "<?php echo $ma;?>";
			var idtab = $(".tab-content .active").attr('id');
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
		})
		$(".box-function .btn-save").click(function(){
			HsoIDChecked();
			if(checkinput()==true) {
				var url = "<?php echo ROOTHOST;?>ajaxs/student/process_edit.php";
				$.ajax({
					type: "POST",
					url: url,
					data: $("#student_edit").serialize(),
					success: function(req){
						console.log(req); 
						// if(req=="success") {
						// 	showMess("Cập nhật thành công!",""); 
						// 	setTimeout(function(){window.location.reload(); }, 2000);
						// }else{
						// 	showMess("Lỗi trong quá trình lưu dữ liệu!","error");
						// }
					}
				});
			}
		})
		$("#mon1").change(function(){	
			tongdiem();
		})
		$("#mon2").change(function(){	
			tongdiem();
		})
		$("#mon3").change(function(){	
			tongdiem();
		})
	})

	$(".edit_qhgd").click(function(){
		var ma = "<?php echo $ma;?>";
		var row_id = $(this).attr('dataid'); 
		var url = "<?php echo ROOTHOST;?>ajaxs/student/edit_qhgd.php";
		$.post(url,{'ma':ma,'row_id':row_id},function(req){
		//console.log(req);
		$("#tab1").html(req);
	})
	})
	function tongdiem() {
		var mon1 = $("#mon1").val()!='' ? parseFloat($("#mon1").val()) : 0;
		var mon2 = $("#mon2").val()!='' ? parseFloat($("#mon2").val()) : 0;
		var mon3 = $("#mon3").val()!='' ? parseFloat($("#mon3").val()) : 0;
		var tong = mon1 + mon2 + mon3;
		$("#tong_diem").val(tong);
	}
	function checkinput(){
		var ma_nganh = $("#ma_nganh").val();
		var bac = $("#cbobac").val();
		var khoa = $("#cbokhoa").val();

		if($("#hoten").val()=="") {
			$("#hoten").focus();
			$("#hoten").addClass('novalid');
			return false;
		}else $("#hoten").removeClass('novalid');
		if($("#ngaysinh").val()=="") {
			$("#ngaysinh").focus();
			$("#ngaysinh").addClass('novalid');
			return false;
		}else $("#ngaysinh").removeClass('novalid');
		if($("#noisinh").val()=="") {
			$("#noisinh").focus();
			$("#noisinh").addClass('novalid');
			return false;
		}else $("#noisinh").removeClass('novalid');
		if($("#nguyenquan").val()=="") {
			$("#nguyenquan").focus();
			$("#nguyenquan").addClass('novalid');
			return false;
		}else $("#nguyenquan").removeClass('novalid');
		if($("#hokhau").val()=="") {
			$("#hokhau").focus();
			$("#hokhau").addClass('novalid');
			return false;
		}else $("#hokhau").removeClass('novalid');

		if(khoa=="") {
			$("#cbokhoa").focus();
			$("#cbokhoa").addClass('novalid');
			return false;
		}else $("#cbokhoa").removeClass('novalid');
		if(bac=="") {
			$("#cbobac").focus();
			$("#cbobac").addClass('novalid');
			return false;
		}else $("#cbobac").removeClass('novalid');
		if(ma_nganh=="") {
			$("#ma_nganh").focus();
			$("#ma_nganh").addClass('novalid');
			return false;
		}else $("#ma_nganh").removeClass('novalid');
		return true;
	}

	/* Checkbox dm ho so */
	function HSCheckAll(status){
		console.log('status='+status);
		$(".chk_hoso").each(function(){
			$(this).prop('checked',status);
		})
		HsoIDChecked();
	}
	function HSCheckOnce(){
		var flag=true;
		$(".chk_hoso").each(function(){
			if($(this).prop("checked")!=true) {
				flag=false;
			}
		})
		$("#chkall_hoso").prop('checked',flag);
		HsoIDChecked();
	}
	function HsoIDChecked(){
		var strids='';
		$(".chk_hoso").each(function(){
			if($(this).prop("checked")==true)
			{
				strids+=$(this).attr('dataid')+",";
			}
		})
		$("#dmhoso_ids").val(strids);
	}
</script>