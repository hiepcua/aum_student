<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
$url = ROOTHOST;
?>
<div class="dashboard_page">
	<?php if(in_array($USER_ACCOUNT['pcode'], $PERMISSION_FULL)){ ?>
		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>?com=edu&task=khungdaotao"><i class="media-object fa fa-book fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>?com=edu&task=khungdaotao" title="">KHUNG ĐÀO TẠO</a></h4>
							<small class="text-muted">Quản lý khung chương trình đào tạo cho ngành học tương ứng</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>?com=edu&task=khungdaotao" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>hsdaotao"><i class="media-object fa fa-graduation-cap fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>hsdaotao" title="">QL HỒ SƠ ĐÀO TẠO</a></h4>
							<small class="text-muted">Quản lý sinh viên theo lớp, khóa, ngành học. QL điểm, khen thưởng, kỷ luật</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>hsdaotao" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>lop"><i class="media-object fa fa-graduation-cap fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>lop" title="">QL LỚP</a></h4>
							<small class="text-muted">Quản lý sinh viên theo lớp</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>lop" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>student/hoso"><i class="media-object fa fa-book fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>student/hoso" title="">QL HỒ SƠ</a></h4>
							<small class="text-muted">Quản lý hồ sơ sinh viên, thông tin cá nhân từng sinh viên</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>student/hoso" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>student/qlhocphi"><i class="media-object fa fa-graduation-cap fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>student/qlhocphi" title="">QL HỌC PHÍ</a></h4>
							<small class="text-muted">Quản lý học phí của sinh viên theo từng ngành học</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>student/qlhocphi" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>student/qlhoctap"><i class="media-object fa fa-stack-overflow fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>student/qlhoctap" title="">KẾT QUẢ HỌC TẬP</a></h4>
							<small class="text-muted">Nhập điểm theo nhiều cột hệ số hoặc cột người dùng tự định nghĩa</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>student/qlhoctap" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>report/hoso"><i class="media-object fa fa-bar-chart fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>report/hoso" title="">THỐNG KÊ</a></h4>
							<small class="text-muted">Thống kê tổng hợp, theo khu vực, đối tác, học phí</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>report/hoso" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>notify"><i class="media-object fa fa-bar-chart fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>notify" title="">THÔNG BÁO</a></h4>
							<small class="text-muted">Thống kê các hành động được thực hiện trong hệ thống</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>notify" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>hsdaotao"><i class="media-object fa fa-graduation-cap fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>hsdaotao" title="">QL HỒ SƠ ĐÀO TẠO</a></h4>
							<small class="text-muted">Quản lý sinh viên theo lớp, khóa, ngành học. QL điểm, khen thưởng, kỷ luật</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>hsdaotao" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>student/qlhocphi"><i class="media-object fa fa-graduation-cap fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>student/qlhocphi" title="">QL HỌC PHÍ</a></h4>
							<small class="text-muted">Quản lý học phí của sinh viên theo từng ngành học</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>student/qlhocphi" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>student/qlhoctap"><i class="media-object fa fa-stack-overflow fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>student/qlhoctap" title="">KẾT QUẢ HỌC TẬP</a></h4>
							<small class="text-muted">Nhập điểm theo nhiều cột hệ số hoặc cột người dùng tự định nghĩa</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>student/qlhoctap" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>report/hoso"><i class="media-object fa fa-bar-chart fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>report/hoso" title="">THỐNG KÊ</a></h4>
							<small class="text-muted">Thống kê tổng hợp, theo khu vực, đối tác, học phí</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>report/hoso" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="box col-md-4 col-xs-12">
			<div class="panel panel-warning">
				<div class="panel-body">
					<div class="media">
						<div class="icon-category">
							<a href="<?php echo ROOTHOST;?>notify"><i class="media-object fa fa-bar-chart fa-3x"></i></a>
						</div>
						<div class="media-body padding-left-10">
							<h4 class="media-heading"><a href="<?php echo ROOTHOST;?>notify" title="">THÔNG BÁO</a></h4>
							<small class="text-muted">Thống kê các hành động được thực hiện trong hệ thống</small><br>
							<a class="btn btn-primary btn-xs pull-right" href="<?php echo ROOTHOST;?>notify" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<div class="clearfix"></div>