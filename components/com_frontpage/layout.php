<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
global $UserLogin;
$username = $GLOBALS['username'];
?>
<div class="dashboard_page">
	<?php if($UserLogin->Permission('sv_hsdaotao')==true) { 
	$url = ROOTHOST."student/hsdaotao";?>
	<div class="box col-md-3 col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="media">
					<div class="icon-category">
						<a href="<?php echo $url;?>">
						<i class="media-object fa fa-graduation-cap fa-3x"></i></a>
					</div>
					<div class="media-body padding-left-10">
						<h4 class="media-heading"><a href="<?php echo $url;?>" title="">QL SINH VIÊN</a></h4>
						<small class="text-muted">Quản lý sinh viên theo lớp, khóa, ngành học. QL điểm, khen thưởng, kỷ luật</small><br>
						<a class="btn btn-primary btn-xs pull-right" href="<?php echo $url;?>" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php } if($UserLogin->Permission('edu_khungdt')==true) { 
	$url = ROOTHOST."?com=edu&task=khungdaotao";?>
	<div class="box col-md-3 col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="media">
					<div class="icon-category">
						<a href="<?php echo $url;?>">
						<i class="media-object fa fa-book fa-3x"></i></a>
					</div>
					<div class="media-body padding-left-10">
						<h4 class="media-heading"><a href="<?php echo $url;?>" title="">KHUNG ĐÀO TẠO</a></h4>
						<small class="text-muted">Quản lý khung chương trình đào tạo cho ngành học tương ứng</small><br>
						<a class="btn btn-primary btn-xs pull-right" href="<?php echo $url;?>" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php } if($UserLogin->Permission('sv_qlhoctap')==true) { 
	$url = ROOTHOST."student/qlhoctap";?>
	<div class="box col-md-3 col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="media">
					<div class="icon-category">
						<a href="<?php echo $url;?>">
						<i class="media-object fa fa-stack-overflow fa-3x"></i></a>
					</div>
					<div class="media-body padding-left-10">
						<h4 class="media-heading"><a href="<?php echo $url;?>" title="">KẾT QUẢ HỌC TẬP</a></h4>
						<small class="text-muted">Nhập điểm theo nhiều cột hệ số hoặc cột người dùng tự định nghĩa</small><br>
						<a class="btn btn-primary btn-xs pull-right" href="<?php echo $url;?>" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php } if($UserLogin->Permission('sv_qlhocphi')==true) { 
	$url = ROOTHOST."student/qlhocphi";?>
	<div class="box col-md-3 col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="media">
					<div class="icon-category">
						<a href="<?php echo $url;?>">
						<i class="media-object fa fa-money fa-3x"></i></a>
					</div>
					<div class="media-body padding-left-10">
						<h4 class="media-heading"><a href="<?php echo $url;?>" title="">QL HỌC PHÍ</a></h4>
						<small class="text-muted">Thu học phí theo tín chỉ đã đăng ký hoặc theo học kỳ, In biên lai</small><br>
						<a class="btn btn-primary btn-xs pull-right" href="<?php echo $url;?>" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php } if($UserLogin->Permission('report')==true) { 
	$url = ROOTHOST."report/hoso";?>
	<div class="box col-md-3 col-xs-12">
		<div class="panel panel-warning">
			<div class="panel-body">
				<div class="media">
					<div class="icon-category">
						<a href="<?php echo $url;?>">
						<i class="media-object fa fa-bar-chart fa-3x"></i></a>
					</div>
					<div class="media-body padding-left-10">
						<h4 class="media-heading"><a href="<?php echo $url;?>" title="">THỐNG KÊ</a></h4>
						<small class="text-muted">Thống kê tổng hợp, theo khu vực, đối tác, học phí</small><br>
						<a class="btn btn-primary btn-xs pull-right" href="<?php echo $url;?>" style="margin-top:5px;"><i class="fa fa-plus fa-fw"></i>Chi tiết</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<div class="clearfix"></div>