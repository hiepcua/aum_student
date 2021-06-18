<?php
defined('ISHOME') or die("You can't access this page!");
// -------------------------------------------
$_NGANH	=array();
$_HE	=array();
$res_nganh=(array) json_decode(file_get_contents('jsons/nganh.json'),true);
if(count($res_nganh)<=0){
	$res_nganh = SysGetList('tbl_nganh', array(),'');
	file_put_contents('jsons/nganh.json',json_encode($res_nganh,JSON_UNESCAPED_UNICODE));
}
if(!isset($_SESSION['THIS_NGANH'])) $_SESSION['THIS_NGANH']=$res_nganh[0]['id'];
foreach($res_nganh as $r){
	$_NGANH['N'.$r['id']]=$r['name'];
}

$res_bac=(array) json_decode(file_get_contents('jsons/he.json'),true);
if(count($res_bac)<=0){
	$res_bac = SysGetList('tbl_he', array(),'');
	file_put_contents('jsons/he.json',json_encode($res_bac,JSON_UNESCAPED_UNICODE));
}
if(!isset($_SESSION['THIS_BAC'])) $_SESSION['THIS_BAC']=$res_bac[0]['id'];
foreach($res_bac as $r){
	$_HE['H'.$r['id']]=$r['name'];
}

$res_khoa=(array) json_decode(file_get_contents('jsons/khoa.json'),true);
if(count($res_khoa)<=0){
	$res_khoa = SysGetList('tbl_khoa', array(),'');
	file_put_contents('jsons/khoa.json',json_encode($res_khoa,JSON_UNESCAPED_UNICODE));
}
foreach($res_khoa as $r){
	$_KHOA['K'.$r['id']]=$r['name'];
}
?>
<div class='bgColor' id='site_header'>
	<div class='logo pull-left'><a href="<?php echo ROOTHOST;?>">
		<img src="<?php echo ROOTHOST;?>images/logo/logo22.png" class="img-responsive">
	</a></div>
	<div class='header_content'>
		<div class="navbar-container container-fluid">
			<div class="nav-left">
				<ul class="list-unstyle">
					<li><span>Ngành</span></li>
					<li>
						<select class="form-control btn btn-fefault" id="cbo_nganh_menu">
							<option value="">Tất cả</option>
							<?php
							if(count($res_nganh) > 0){
								foreach ($res_nganh as $key => $value) {
									$item = $value['id'];
									$selected = '';
									if ($_SESSION['THIS_NGANH']==$value['id']) $selected = 'selected';
									echo '<option '.$selected.' value="'.$value['id'].'">'.$value['name'].'</option>';
								}
							}
							?>
						</select>
					</li>
					<li><span>Hệ/bậc</span></li>
					<li>
						<select class="form-control btn btn-fefault" id="cbo_bac_menu">
							<option value="">Tất cả</option>
							<?php
							if(count($res_bac) > 0){
								foreach ($res_bac as $key => $value) {
									$item = $value['id']; $selected = '';
									if ($_SESSION['THIS_BAC']==$value['id']) $selected = 'selected';
									echo '<option '.$selected.' value="'.$value['id'].'">'.$value['name'].'</option>';
								}
							}
							?>
						</select>
					</li>
					<?php if(in_array($USER_ACCOUNT['pcode'], $PERMISSION_FULL)){ ?>
					<li><span>Nhân viên</span></li>
					<li>
						<select class="form-control btn btn-fefault" id="cbo_staff_menu">
							<option value="">Tất cả</option>
							<?php
							if(count($STAFF_ALL) > 0){
								foreach ($STAFF_ALL as $key => $value) {
									$selected = '';
									if ($_SESSION['THIS_STAFF']==$key) $selected = 'selected';
									echo '<option '.$selected.' value="'.$key.'">'.$value['fullname'].'</option>';
								}
							}
							?>
						</select>
					</li>
					<?php } ?>
				</ul>
			</div>

			<div class="nav-right">
				<ul class="list-unstyle">
					<?php if(in_array($USER_ACCOUNT['pcode'], $PERMISSION_FULL)){ ?>
						<li>
							<a href='javascript:void(0);'><i class="fa fa-graduation-cap" aria-hidden="true"></i> Hệ thống</a>
							<ul class="submenu">
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=nienkhoa">Khóa đào tạo</a></li>
								<li><a href='<?php echo ROOTHOST;?>?com=edu&task=khungdaotao'>Khung đào tạo</a></li>
								<li class="divide"><hr></li>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=hedaotao">Bậc đào tạo</a></li>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=nganh">Danh mục ngành</a></li>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=monhoc">Danh mục môn học</a></li>
								<li class="divide"><hr></li>
								<li><a href="<?php echo ROOTHOST;?>config">Cấu hình hệ thống</a></li>
							</ul>
						</li>
					<?php } ?>
					<li>
						<div class="btn-group form-profile">
							<div class="pull-left action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<a href="javascript:void(0);" id="nav_registry" ><span class='avatar-small'><i class="fa fa-user fa-2" aria-hidden="true"></i></span> <?php echo getInfo('user');?> </a><i class="fa fa-caret-down" aria-hidden="true"></i>
							</div>
							<ul class="dropdown-menu pull-right">
								<li><a href="<?php echo ROOTHOST;?>profile"><i class="fa fa-info-circle"></i> Thông tin tài khoản</a></li>
								<li><a href="<?php echo ROOTHOST;?>changepass"><i class="fa fa-key"></i> Đổi mật khẩu</a></li>
								<li><a href="<?php echo ROOTHOST;?>logout" rel="nofollow,noindex"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="main-menu container-fluid">
		<div class='topmenu'>
			<ul class="nav navbar-nav">
				<?php if(in_array($USER_ACCOUNT['pcode'], $PERMISSION_FULL)){ ?>
					<li>
						<a href='<?php echo ROOTHOST;?>lop'>
							<i class="fa fa-file-text-o"></i> Quản lý lớp
						</a>
					</li>
				<?php } ?>

				<li>
					<a href="<?php echo ROOTHOST;?>hsdaotao"><i class="fa fa-file-text-o" aria-hidden="true"></i> Quản lý đào tạo</a>
				</li>
				<li>
					<a href='<?php echo ROOTHOST;?>student/qlhoctap'>
						<i class="fa fa-file-text-o"></i> Quản lý học tập
					</a>
				</li>
				<li>
					<a href='<?php echo ROOTHOST;?>student/qlhocphi'>
						<i class="fa fa-file-text-o"></i> Quản lý học phí
					</a>
				</li>

				<?php if(in_array($USER_ACCOUNT['pcode'], $PERMISSION_FULL)){ ?>
					<li><a href='<?php echo ROOTHOST;?>student/hoso'><i class="fa fa-book" aria-hidden="true"></i> Hồ sơ</a></li>
				<?php } ?>

				<li>
					<a href='<?php echo ROOTHOST;?>report/hoso'><i class="fa fa-bar-chart" aria-hidden="true"></i> Báo cáo thống kê</a>
					<ul class="submenu">
						<li><a href="<?php echo ROOTHOST;?>report/hoso/tonghop">Thống kê tổng hợp</a></li>
						<li><a href="<?php echo ROOTHOST;?>report/hoso/tinhthanh">Thống kê theo tỉnh/thành</a></li>
						<li><a href="<?php echo ROOTHOST;?>report/hocphi">Thống kê học phí</a></li>
					</ul>
				</li>

				<li><a href='<?php echo ROOTHOST;?>notify'><i class="fa fa-life-ring" aria-hidden="true"></i> Thông báo</a></li>

				<?php if(in_array($USER_ACCOUNT['pcode'], $PERMISSION_FULL)){ ?>
					<li><a href='<?php echo ROOTHOST;?>student/hosol8'><i class="fa fa-book" aria-hidden="true"></i> Contact L8</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	function loadMenu(year,bac,nganh,staff){
		var url="<?php echo ROOTHOST;?>ajaxs/load_menu.php";
		$.get(url,{'year':year,'bac':bac,'nganh':nganh,'staff':staff},function(req){
			window.location.reload();
		});
	}
	$('#cbo_year_menu').change(function(){
		var this_year=$(this).val(); 
		var this_bac=$('#cbo_bac_menu').val(); 
		var this_nganh=$('#cbo_nganh_menu').val(); 
		var this_staff=$('#cbo_staff_menu').val(); 
		loadMenu(this_year,this_bac,this_nganh,this_staff);
	});
	$('#cbo_bac_menu').change(function(){
		var this_year=$('#cbo_year_menu').val(); 
		var this_nganh=$('#cbo_nganh_menu').val(); 
		var this_staff=$('#cbo_staff_menu').val(); 
		var this_bac=$(this).val(); 
		loadMenu(this_year,this_bac,this_nganh,this_staff);
	});
	$('#cbo_nganh_menu').change(function(){
		var this_year=$('#cbo_year_menu').val(); 
		var this_bac=$('#cbo_bac_menu').val(); 
		var this_staff=$('#cbo_staff_menu').val(); 
		var this_nganh=$(this).val(); 
		loadMenu(this_year,this_bac,this_nganh,this_staff);
	});
	$('#cbo_staff_menu').change(function(){
		var this_year=$('#cbo_year_menu').val(); 
		var this_bac=$('#cbo_bac_menu').val(); 
		var this_nganh=$('#cbo_nganh_menu').val();
		var this_staff=$(this).val(); 
		loadMenu(this_year,this_bac,this_nganh,this_staff);
	});
</script>