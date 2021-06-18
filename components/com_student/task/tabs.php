<?php if(!isset($cur_tab)) $cur_tab = 1; ?>
<ul class="nav nav-tabs step-form" role="tablist">
	<?php if($cur_tab == 1) { ?>
	<li class="active">
		<a href="javascript:void(0)">
			<div class="item">1. Hồ sơ</div>
		</a>
	</li>
	<li>
		<a href="<?php if($ma_hoso) echo ROOTHOST.'student/vanbang/'.$ma_hoso; else echo 'javascript:void(0)';?>">
			<div class="item">2. Văn bằng</div>
		</a>
	</li>
	<li>
		<a href="<?php if($ma_hoso) echo ROOTHOST.'student/cuocgoi/'.$ma_hoso; else echo 'javascript:void(0)';?>">
			<div class="item">3. Contact</div>
		</a>
	</li>
	<?php } else if ($cur_tab == 2) { ?>
	<li>
		<a href="<?php echo ROOTHOST;?>student/profile/<?php echo $ma_hoso;?>">
            <div class="item">1. Hồ sơ</div>
        </a>
	</li>
	<li class="active">
        <a href="<?php echo ROOTHOST;?>student/vanbang/<?php echo $ma_hoso;?>">
            <div class="item">2. Văn bằng</div>
        </a>
    </li>
	<li>
		<a href="<?php if($ma_hoso) echo ROOTHOST.'student/cuocgoi/'.$ma_hoso; else echo 'javascript:void(0)';?>">
			<div class="item">3. Contact</div>
		</a>
	</li>
	<?php } else if ($cur_tab == 3) { ?>
	<li>
		<a href="<?php echo ROOTHOST;?>student/profile/<?php echo $ma_hoso;?>">
            <div class="item">1. Hồ sơ</div>
        </a>
	</li>
	<li>
        <a href="<?php echo ROOTHOST;?>student/vanbang/<?php echo $ma_hoso;?>">
            <div class="item">2. Văn bằng</div>
        </a>
    </li>
	<li class="active">
        <a href="<?php echo ROOTHOST;?>student/cuocgoi/<?php echo $ma_hoso;?>">
            <div class="item">3. Contact</div>
        </a>
    </li>
	<?php } ?>
</ul>