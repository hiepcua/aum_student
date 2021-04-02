<?php 
$id_khoa=$id_nganh=$id_he=$id_lop='';
?>
<div class="frmsearch panel panel-warning"><div class="panel-body"><div class="media row">
	<div class="form-group">
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_masv" id="tk_masv" value="" placeholder="Mã SV" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_hoten" id="tk_hoten" value="" placeholder="Họ tên/tên" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_sdt" id="tk_sdt" value="" placeholder="SĐT" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_ns" id="tk_ns" value="" placeholder="Ngày sinh" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-6">
			<input type="text" name="tk_dc" id="tk_dc" value="" placeholder="Địa chỉ" class="form-control"/> 
		</div>
		<div class="col-md-2 col-xs-12">
			<button type="button" name="tk_btnsearch" id="tk_btnsearch" class="btn btn-primary form-control">
			<i class="fa fa-search"></i> Lọc</button>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-2 col-xs-6">
			<select name="tk_khoa" id="tk_khoa" class="form-control">
				<option value="" selected>Chọn khóa</option>
				<?php 
				$objkhoa = new CLS_KHOA;
				$objkhoa->getList("");
				while($r=$objkhoa->Fetch_Assoc()) { ?>
				<option value="<?php echo $r['id'];?>" <?php if($id_khoa==$r['id']) echo "selected";?>>
				<?php echo $GLOBALS['ARR_SOURCE'][$r['type']]." - ".$r['name'];?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-2 col-xs-6">
			<select name="tk_bac" id="tk_bac" class="form-control">
			<option value="" selected>Chọn bậc ĐT</option>
			<?php $objhe = new CLS_HE;
			$objhe->getList(); 
			while($r=$objhe->Fetch_Assoc()) { ?>
			<option value="<?php echo $r['id'];?>" <?php if($id_he==$r['id']) echo "selected";?>>
			<?php echo $r['name'];?></option>
			<?php } ?>
			</select>
		</div>
		<div class="col-md-2 col-xs-12">
			<select name="tk_nganh" id="tk_nganh" class="form-control">
			<option value="" selected>Chọn Ngành</option>
			<?php $objng = new CLS_NGANH;
			$objng->getList(); 
			while($r=$objng->Fetch_Assoc()) { ?>
			<option value="<?php echo $r['id'];?>" <?php if($id_nganh==$r['id']) echo "selected";?>>
			<?php echo $r['id']." - ".$r['name'];?></option>
			<?php } ?>
			</select>
		</div>
		<div class="col-md-2 col-xs-12">
			<select name="tk_lop" id="tk_lop" class="form-control">
			<option value="" selected>Chọn Lớp</option>
			<?php $objlop = new CLS_LOP;
			$objlop->getList(); 
			while($r=$objlop->Fetch_Assoc()) { ?>
			<option value="<?php echo $r['id'];?>" <?php if($id_lop==$r['id']) echo "selected";?>>
			<?php echo $r['id']." - ".$r['name'];?></option>
			<?php } ?>
			</select>
		</div>
		<div class="col-md-2 col-xs-12">
			<input type="text" name="tk_gvcn" id="tk_gvcn" value="" placeholder="GV chủ nhiệm" class="form-control"/> 
		</div>
	</div>
</div></div></div>