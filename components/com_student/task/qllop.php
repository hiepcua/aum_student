<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa='';
$cur_page=isset($_GET['page'])?(int)$_GET['page']:1;
$cur_page=isset($_POST['txtCurnpage'])?(int)$_POST['txtCurnpage']:1;

$khoa 	= isset($_SESSION['THIS_YEAR']) ? $_SESSION['THIS_YEAR'] : '';
$he 	= isset($_SESSION['THIS_BAC']) ? $_SESSION['THIS_BAC'] : '';
$nganh 	= isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';

$obj=new CLS_MYSQL;
//---------------------------------------
$sql="SELECT * FROM tbl_khoa";
$obj->Query($sql);
$_KHOA=array();
while($r=$obj->Fetch_Assoc()){
	$_KHOA['K'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$_HE=array();
while($r=$obj->Fetch_Assoc()){
	$_HE['H'.$r['id']]=$r['name'];
}
//---------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH['N'.$r['id']]=$r['name'];
}

$strWhere='';
if($khoa!='') $strWhere.=" AND id_khoa='$khoa'";
if($he!='') $strWhere.=" AND id_he='$he'";
if($nganh!='') $strWhere.=" AND id_nganh='$nganh'";

$sql="SELECT count(*) as num FROM tbl_lop WHERE 1=1 $strWhere";
$obj->Query($sql);
$r=$obj->Fetch_Assoc();

$total_rows=$r['num']+1;
$max_pages = ceil($total_rows/MAX_ROWS);
$cur_page = postCurentPage($max_pages);
$start = ($cur_page - 1) * MAX_ROWS;
$limit = ' LIMIT '.$start.','. MAX_ROWS;

$sql="SELECT * FROM tbl_lop WHERE 1=1 $strWhere";
$obj->Query($sql.$limit);
$arr_lop = array(); $str_lop = '';
while($r = $obj->Fetch_Assoc()) {
	$lop = $r['id'];
	$r['siso']=0;
	$arr_lop["$lop"]=$r;
	$str_lop .= $lop."','";
} 

// tổng số học sinh
if($str_lop!='') {
	$str_lop = substr($str_lop,0,-3);
	$sql = "select count(id) as total,malop FROM tbl_dangky_tuyensinh 
	WHERE malop IN ('$str_lop')
	group by malop";
	$obj->Query($sql);
	while($r=$obj->Fetch_Assoc()){
		$malop = $r['malop'];
		if(isset($arr_lop["$malop"])) $arr_lop["$malop"]['siso'] = $r['total'];
	}
}?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý lớp</div>
			</div>
			<div class="box-function pull-right">
				<button type="button" class="btn btn-primary" id="btn_add"><i class="fa fa-plus"></i> Thêm mới</button>
			</div>
		</div>
	</div>

	<table class="list table table-striped table-bordered">
		<thead>
			<tr class="header">
				<th class="text-center">STT</th>
				<th class="text-center">Mã Lớp</th>
				<th class="text-center">Chương trình học</th>
				<th class="text-center">Ngành</th>
				<th class="text-center">Hệ</th>
				<th class="text-center">Khóa</th>
				<th class="text-center">sĩ số</th>
				<th class="text-center">Chương trình</th>
				<th class="text-center">Ngày tạo</th>
				<th class="text-center">Chi tiết</th>
				<th class="text-center">Tác vụ</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;
			foreach($arr_lop as $r){
				$siso=0+$r['siso'];
				?>
				<tr dataid="<?php echo $r['id'];?>">
					<td align="center"><?php echo $i;?></td>
					<td class="text-center"><?php echo stripslashes($r['id']);?></td>
					<td class="text-center" dataid="<?php echo $r['id'];?>">
						<a class="btn btn-info" href="<?php echo ROOTHOST;?>?com=student&task=chitiet_lop&id=<?php echo $r['id'];?>">
						Chương trình học</a>
					</td>
					<td class="text-center"><?php echo strlen($r['id_nganh'])>0 ? $_NGANH['N'.$r['id_nganh']] : '';?></td>
					<td class="text-center"><?php echo strlen($r['id_he'])>0 ? $_HE['H'.$r['id_he']] : '';?></td>
					<td class="text-center"><?php echo strlen($r['id_khoa'])>0 ? $_KHOA['K'.$r['id_khoa']] : '';?></td>
					<td class="text-center"><?php echo $siso;?></td>
					<td class="text-center"><i class='fa fa-check cgreen' aria-hidden='true'></i></td>
					<td class="text-center"><?php echo date('d/m/Y',$r['cdate']);?></td>
					<td class="text-center">
						<a class="btn btn-success" href="<?php echo ROOTHOST;?>hsdaotao?khoa=<?= $r['id_khoa']?>&he=<?= $r['id_he']?>&nganh=<?= $r['id_nganh']?>&malop=<?= $r['id']?>">
						Danh sách lớp</a>
					</td>
					<td class="text-center">
						<i class='fa fa-trash cgray btn_delete' dataid='<?php echo $r['id'];?>' datass='<?php echo $siso;?>' aria-hidden='true'></i>
					</td>
				</tr>
				<?php $i++;
			} ?>
		</tbody>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
		<tr><td align="center">
			<?php  paging_index($total_rows,MAX_ROWS,$cur_page); ?>
		</td></tr>
	</table>
</div>
<script>
	$(document).ready(function(){
		$("#btn_add").click(function(){
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/frm_add.php";
			$.post(url,function(req) {
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-title').html('Phân lớp');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			})
		})
		$(".btn_delete").click(function(){
			var id = $(this).attr('dataid');
			var siso = parseInt($(this).attr('datass'));
			if(siso > 0) alert('Lớp đã có dữ liệu, vui lòng không xóa.');
			else {
				if(confirm("Bạn có chắc muốn xóa lớp?")){
					var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_delete.php";
					$.post(url,{'id':id},function(req) {
						if(req=="success"){
							showMess("Đã xóa lớp thành công.");
							setTimeout(function(){window.location.reload();},3000);
						}else if(req=="notdel") {
							showMess("Lớp đã có dữ liệu, không được phép xóa.");
							setTimeout(function(){window.location.reload();},3000);
						}
					})
				}
			}
		})
	})
</script>