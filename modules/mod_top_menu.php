<?php
defined('ISHOME') or die("You can't access this page!");
if(!$UserLogin->isLogin()) die("You can't access this page!");
$objdata=new CLS_MYSQL();
$com=isset($_GET['com'])?strip_tags(trim($_GET['com'])):'frontpage';
?>
<div class='bgColor' id='site_header'>
	<div class='logo pull-left'><a href="<?php echo ROOTHOST;?>">
		<img src="<?php echo ROOTHOST;?>images/logo/logo-eea-small-white.png" class="img-responsive">
	</a></div>
	<div class='header_content'>
		<div class="navbar-container container-fluid">
			<div class="nav-left">
				<ul class="list-unstyle">
					<li><span>Khóa</span></li>
					<li>
						<select class='form-control btn btn-fefault' id='cbo_year_menu'>
							<option value="">Tất cả</option>
							<?php
							$res_khoa = SysGetList('tbl_khoa', array(), '');
							if(count($res_khoa)>0){
								$arr_year = array();
								foreach ($res_khoa as $key => $value) {
									$item = $value['id']; $selected = '';
									if($_SESSION['THIS_YEAR']==$value['id']) $selected = 'selected';
									echo '<option '.$selected.' value="'.$item.'">'.$value['name'].'</option>';
								}
							}
							?>
						</select>
					</li>
					<li><span>Bậc</span></li>
					<li>
						<select class="form-control btn btn-fefault" id="cbo_bac_menu">
							<option value="">Tất cả</option>
							<?php
							$res_bac = SysGetList('tbl_he', array(), '');
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
					<li><span>Ngành</span></li>
					<li>
						<select class="form-control btn btn-fefault" id="cbo_nganh_menu">
							<option value="">Tất cả</option>
							<?php
							$res_nganh = SysGetList('tbl_nganh', array(), '');
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
				</ul>
			</div>

			<div class="nav-right">
				<ul class="list-unstyle">
					<?php if($UserLogin->Permission('config')==true || $UserLogin->Permission('user')==true) { ?>
						<li><a href='javascript:void(0);'>
							<i class="fa fa-graduation-cap" aria-hidden="true"></i> Hệ thống</a>
							<ul class="submenu">
								<?php if($UserLogin->Permission('config')==true) { ?>
									<li><a href="<?php echo ROOTHOST;?>config">Cấu hình hệ thống</a></li>
								<?php } if($UserLogin->Permission('user')==true) { ?>
									<li><a href="<?php echo ROOTHOST;?>user">Quản lý User - Phân quyền</a></li>
								<?php }?>
							</ul>
						</li>
					<?php } ?>
					<li>
						<div class="btn-group form-profile">
							<div class="pull-left action dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<a href="javascript:void(0);" id="nav_registry" ><span class='avatar-small'><i class="fa fa-user fa-2" aria-hidden="true"></i></span> <?php echo $UserLogin->getInfo('lastname').' '.$UserLogin->getInfo('firstname');?> </a><i class="fa fa-caret-down" aria-hidden="true"></i>
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
				<?php
				if($UserLogin->Permission('partner')==true || $UserLogin->Permission('city')==true || $UserLogin->Permission('edu_khoa')==true || $UserLogin->Permission('edu_he')==true || $UserLogin->Permission('edu_nganh')==true || $UserLogin->Permission('edu_monhoc')==true || $UserLogin->Permission('edu_hocphi')==true || $UserLogin->Permission('edu_hoso')==true ){ ?>
					<li><a href='javascript:void(0);'><i class="fa fa-list" aria-hidden="true"></i> Danh mục</a>
						<ul class="submenu">
							<?php if($UserLogin->Permission('edu_khoa')==true) { ?>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=nienkhoa">Khóa đào tạo</a></li>
							<?php } if($UserLogin->Permission('edu_he')==true) { ?>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=hedaotao">Bậc đào tạo</a></li>
							<?php }?>
							<li class="divide"><hr></li>
							<?php if($UserLogin->Permission('city')==true) { ?>
								<li><a href="<?php echo ROOTHOST;?>?com=city">Danh mục khu vực</a></li>
							<?php } if($UserLogin->Permission('edu_nganh')==true) { ?>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=nganh">Danh mục ngành</a></li>
							<?php } if($UserLogin->Permission('edu_monhoc')==true) { ?>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=monhoc">Danh mục môn học</a></li>
							<?php } if($UserLogin->Permission('edu_hoso')==true) { ?>
								<li><a href="<?php echo ROOTHOST;?>?com=edu&task=hoso">Danh mục hồ sơ</a></li>
							<?php } ?>

						</ul>
					</li>
				<?php } if($UserLogin->Permission('edu_khungdt')==true) { ?>
					<li><a href='<?php echo ROOTHOST;?>?com=edu&task=khungdaotao'>
						<i class="fa fa-file-text-o"></i> Khung đào tạo</a>
					</li>
				<?php } if($UserLogin->Permission('sv_hsdaotao')==true || $UserLogin->Permission('sv_qlhocphi')==true || $UserLogin->Permission('sv_qlhoctap')==true) { ?>
					<li><a href="javascript:void(0);"><i class="fa fa-file-text-o" aria-hidden="true"></i> Quản lý đào tạo</a>
						<ul class="submenu">
							<li>
								<a href="<?php echo ROOTHOST;?>hsdaotao">Hồ sơ đào tạo</a>
							</li>
							<li>
								<a href="<?php echo ROOTHOST;?>lop">Quản lý lớp</a>
							</li>
							<?php if($UserLogin->Permission('sv_qlhocphi')==true) { ?>
								<li><a href="<?php echo ROOTHOST;?>qlhocphi">Quản lý học phí</a></li>
							<?php } ?>
						</ul>
					</li>

					<li><a href='<?php echo ROOTHOST;?>student/hoso'><i class="fa fa-book" aria-hidden="true"></i> Hồ sơ</a></li>

				<?php } if($UserLogin->Permission('report')==true) { ?>
					<li>
						<a href='<?php echo ROOTHOST;?>report/hoso'><i class="fa fa-bar-chart" aria-hidden="true"></i> Báo cáo thống kê</a>
						<ul class="submenu">
							<li><a href="<?php echo ROOTHOST;?>report/hoso/tonghop">Thống kê tổng hợp</a></li>
							<li><a href="<?php echo ROOTHOST;?>report/hoso/tinhthanh">Thống kê theo tỉnh/thành</a></li>
							<li><a href="<?php echo ROOTHOST;?>report/hocphi">Thống kê học phí</a></li>
						</ul>
					</li>
				<?php } if($UserLogin->Permission('notify')==true) { ?>
					<li><a href='<?php echo ROOTHOST;?>notify'><i class="fa fa-life-ring" aria-hidden="true"></i> Thông báo</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	function loadMenu(year,bac,nganh){
		var url="<?php echo ROOTHOST;?>ajaxs/load_menu.php";
		$.get(url,{'year':year,'bac':bac,'nganh':nganh},function(req){
			window.location.reload();
		});
	}
	$('#cbo_year_menu').change(function(){
		var this_year=$(this).val(); 
		var this_bac=$('#cbo_bac_menu').val(); 
		var this_nganh=$('#cbo_nganh_menu').val(); 
		loadMenu(this_year,this_bac,this_nganh);
	});
	$('#cbo_bac_menu').change(function(){
		var this_year=$('#cbo_year_menu').val(); 
		var this_nganh=$('#cbo_nganh_menu').val(); 
		var this_bac=$(this).val(); 
		loadMenu(this_year,this_bac,this_nganh);
	});
	$('#cbo_nganh_menu').change(function(){
		var this_year=$('#cbo_year_menu').val(); 
		var this_bac=$('#cbo_bac_menu').val(); 
		var this_nganh=$(this).val(); 
		loadMenu(this_year,this_bac,this_nganh);
	});
</script>