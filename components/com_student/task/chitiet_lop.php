<?php
defined('ISHOME') or die("You can't access this page!");
$id_he=$id_nganh=$id_khoa='';
$obj=new CLS_MYSQL;
$id_lop=isset($_GET['id'])?addslashes(strip_tags($_GET['id'])):'';
$sql="SELECT * FROM tbl_lop WHERE id='$id_lop'";
$obj->Query($sql);
$rLop=$obj->Fetch_Assoc();

$id_he=$rLop['id_he'];
$id_nganh=$rLop['id_nganh'];
$id_khoa=$rLop['id_khoa'];

$sql="SELECT * FROM tbl_he";
$obj->Query($sql);
$arrHe=array();
while($r=$obj->Fetch_Assoc()){
	$arrHe[$r['id']]=$r;
}
$sohocky = $id_he!=='' ? $arrHe[$id_he]['sohocky'] : 0;

$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$arrNganh=array();
while($r=$obj->Fetch_Assoc()){
	$arrNganh[$r['id']]=$r;
}

$sql="SELECT * FROM tbl_khoa";
$obj->Query($sql);
$arrKhoa=array();
while($r=$obj->Fetch_Assoc()){
	$arrKhoa[$r['id']]=$r;
}

$sql="SELECT * FROM tbl_chuongtrinhhoc WHERE id_lop='$id_lop' ";
$obj->Query($sql);
$arrCTH=array();
while($r=$obj->Fetch_Assoc()){
	$arrCTH[$r['id']]=$r;
}
$sql="SELECT * FROM tbl_monhoc";
$obj->Query($sql);
$arrHP=array();
while($r=$obj->Fetch_Assoc()){
	$arrHP[$r['id']]=$r;
}

$sql="SELECT * FROM tbl_monhoc WHERE id IN (SELECT id_monhoc FROM tbl_hocphan_khung WHERE id_nganh='$id_nganh' AND id_he='$id_he') AND id NOT IN (SELECT id_monhoc FROM tbl_chuongtrinhhoc WHERE id_lop='$id_lop')";
$obj->Query($sql); 
$arrMonhoc=array();
while($r=$obj->Fetch_Assoc()){
	if(!isset($arrCTH[$r['id']]))
		$arrMonhoc[$r['id']]=$r;
}
//tong so hoc sinh
$sql = "select count(id) as total FROM tbl_dangky_tuyensinh WHERE malop='$id_lop'";
$obj->Query($sql); $r = $obj->Fetch_Assoc(); 
$siso = $r['total'];
?>
<div class='body profile_view'>
	<div class="page-bar">
		<div class="page-title-breadcrumb">
			<div class="pull-left">
				<div class="page-title">Quản lý lớp</div>
			</div>
		</div>
	</div>
	<div class="search_box panel panel-warning"><div class="panel-body"><div class="media row">
		<div class="form-group">
			<div class='col-md-6'>Lớp: <label><?php echo $id_lop;?></label></div>
			<div class='col-md-6'>Ngành: <label><?php echo $arrNganh[$id_nganh]['name'];?></label></div>
			<div class='col-md-6'>Bậc: <label><?php echo $id_he!=='' ? $arrHe[$id_he]['name'] : '';?></label></div>
			<div class='col-md-6'>Khóa học: <label><?php echo $id_khoa!=='' ? $arrKhoa[$id_khoa]['name'] : '';?></label></div>
			<div class='col-md-6'>Sĩ số: <label><?php echo number_format($siso);?></label></div>
		</div>
	</div></div></div>
	<h3 class='text-center'>Chương trình học</h3>
	<table class="table table-striped table-bordered">
		<thead>
			<tr class="">
				<th class="text-center">STT</th>
				<th class="text-center">Học phần</th>
				<th class="text-center">Học kỳ</th>
				<th class="text-center">Tín chỉ</th>
				<th class="text-center"></th>
				<th class="text-center"></th>
			</tr>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">
					<select id='cbo_add_monhoc' class='form-control'>
						<?php foreach($arrMonhoc as $key =>$val){
							echo "<option value='$key'>".$val['name']."</option>";
						}?>
					</select>
				</th>
				<th class="text-center">
					<select id='txthocky' class='form-control'>
						<?php for($i=1;$i<=$sohocky;$i++){
							echo "<option value='$i'>Học kỳ $i</option>";
						}?>
					</select>
				</th>
				<th class="text-center" width='100'>
					<input type='number' size=4 id='txt_tinchi' class='form-control text-center' value='3' max=6 min=1/>
				</th>
				<th class="text-center"></th>
				<th class="text-center">
					<button type='button' id='btn_add_hp' class='btn btn-primary'>Thêm học phần</button>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1;
			foreach($arrCTH as $key=>$r){
				?>
				<tr dataid="<?php echo $r['id'];?>"><td align="center"><?php echo $i;?></td>
					<td><?php echo stripslashes($arrHP[$r['id_monhoc']]['name']);?></td>
					<td class="text-center"><?php echo stripslashes($r['hocky']);?></td>
					<td class="text-center"><?php echo $r['tinchi'];?></td>
					<td align="center"><a href="<?php echo ROOTHOST.'?com=student&task=qlhoctap&mamon='.$r['id_monhoc'].'&malop='.$id_lop;?>" target="_blank">Ql học tập</a></td>
					<td class="text-center"><a href='javascript:void(0);' class='cmd_del_hp' dataid='<?php echo $r['id'];?>' datalop='<?php echo $r['id_lop'];?>' datamon='<?php echo $r['id_monhoc'];?>'>Xóa</a></td>
				</tr>
				<?php $i++;
			} ?>
		</tbody>
	</table>
</div>
<script>
	$("#btn_add_hp").click(function(){
		if(confirm('Thêm học phần')){
			showLoading();
			var flag=true;
			var mon = $('#cbo_add_monhoc option:selected').val();
			var hk = $("#txthocky option:selected").val();
			var tc = $("#txt_tinchi").val();
			if(tc=="" || tc==undefined) {
				$("#txt_tinchi").focus(); 
				alert('Nhập số tín chỉ'); 
				flag=false;
			}
			if(mon=="" || mon==undefined) {
				$("#cbo_add_monhoc").focus();
				alert('Chọn học phần!'); 
				flag=false;
			}
			if(hk=="" || hk==undefined) {
				$("#txthocky").focus(); 
				alert('Nhập học kỳ'); 
				flag=false;
			}
			if(flag==true){
				var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_add_hp.php";
				$.post(url,{'he':'<?php echo $id_he;?>','nganh':'<?php echo $id_nganh;?>','lop':'<?php echo $id_lop;?>','mon':mon,'hk':hk,'tc':tc},function(req){
					hideLoading();
					if(req=="nodata") alert("Vui lòng nhập dữ liệu");
					else {
						window.location.reload();
					}
				})
			}
			hideLoading();
		}
	});
	$(".cmd_del_hp").click(function(){
		if(confirm("Bạn có chắc muốn xóa học phần này không?")){
			showLoading();
			var id = $(this).attr('dataid');
			var lop = $(this).attr('datalop');
			var mon = $(this).attr('datamon');
			var url = "<?php echo ROOTHOST;?>ajaxs/lop/process_del_hp.php";
			$.post(url,{'id':id,'lop':lop,'mon':mon},function(req){
				console.log(req);
				hideLoading();
				if(req=="empty") alert("Dữ liệu trống.");
				if(req=="notdel") alert("Chương trình học này không được phép xóa.");
				else {
					window.location.reload();
				}
			})
		}
	})
</script>