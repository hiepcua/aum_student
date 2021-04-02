<?php
defined('ISHOME') or die("You can't access this page!");
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Thống kê Hồ sơ</div>
			</div><?php /*
			<ul class="box-function pull-right">
				<li><button type="button" class="btn btn-warning btn-print" title="In hồ sơ">
					<i class="fa fa-print"></i> In</button></li>
				<li><button class="btn btn-default" title="Thoát">
					<i class="fa fa-file-excel"></i> Xuất File Excel</a></li>
			</ul> */?>
		</div>
	</div>
	<div class="card">
		<div class="card-body"><div class="card-block"><div class="media">
		<ul><li><a href="<?php echo ROOTHOST;?>report/hoso/tonghop">Thống kê hồ sơ tổng hợp</a></li>
			<li><a href="<?php echo ROOTHOST;?>report/hoso/tinhthanh">Thống kê hồ sơ theo tỉnh thành</a></li>
			<li><a href="<?php echo ROOTHOST;?>report/hoso/doitac">Thống kê hồ sơ theo Đối tác tuyển sinh</a></li>
			<li><a href="<?php echo ROOTHOST;?>report/hocphi">Thống kê học phí</a></li>
		</ul>
		</div></div></div>
	</div>
</div>