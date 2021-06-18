<?php
$id = time();
$startdate = date("Y-m-d");
?>
<div class="panel panel-default">
	<div class="panel-heading"  data-toggle="collapse" data-target="#panel-<?php echo $id;?>">
		Tương tác sinh viên
		<a href="javascript:void(0)" class="remove_tuongtac" onclick="remove_tuongtac(this)"><i class="fa fa-times" aria-hidden="true"></i></a>
	</div>
	<div class="panel-body collapse in" id="panel-<?php echo $id;?>" data-parent="#list-tuongtac">
		<div class="el">
			<div class="form-group">
				<span class="text">Ngày: </span>
				<div class="content">
					<input type="date" class="form-control required" name="startdate[]" value="<?php echo $startdate;?>">
				</div>
			</div>

			<div class="form-group">
				<span class="text">Nội dung: </span>
				<div class="content">
					<textarea class="form-control required" name="noidung[]" placeholder="Nội dung tương tác"></textarea>
				</div>
			</div>

			<div classs="form-group">
				<span class="text">Tình trạng: </span>
				<div class="content">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" name="finish[]" id="finish<?php echo $id;?>" value="1">
						<label class="form-check-label" for="finish<?php echo $id;?>">Hoàn thành</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>