<?php session_start();
ini_set("display_errors",1);
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$cur_page=isset($_POST['page'])?(int)$_POST['page']:1;
$obj = new CLS_MYSQL;

//---------------------------------------
$sql="SELECT * FROM tbl_nganh";
$obj->Query($sql);
$_NGANH=array();
while($r=$obj->Fetch_Assoc()){
	$_NGANH['N'.$r['id']]=$r['name'];
}

$sql = "SELECT a.*,b.ma,b.ho_dem,b.name,b.gioitinh,b.ngaysinh,b.diachi,b.dienthoai 
FROM tbl_dangky_tuyensinh AS a 
RIGHT JOIN tbl_hocsinh AS b ON a.id_hoso=b.ma ";

$nganh = isset($_SESSION['THIS_NGANH']) ? $_SESSION['THIS_NGANH'] : '';
$ten = isset($_POST['ten']) ? addslashes(strip_tags($_POST['ten'])) : '';
$cmt = isset($_POST['cmt']) ? addslashes(strip_tags($_POST['cmt'])) : '';
$ns = isset($_POST['ns']) ? addslashes(strip_tags($_POST['ns'])) : '';
$dc = isset($_POST['dc']) ? addslashes(strip_tags($_POST['dc'])) : '';
$sbd = isset($_POST['sbd']) ? addslashes(strip_tags($_POST['sbd'])) : '';
$diem = isset($_POST['diem']) ? (float)$_POST['diem'] : '';

if($ten!='') $sql.=" AND (b.ho_dem LIKE '%$ten%' OR b.name LIKE '%$ten%')";
if($cmt!='') $sql.=" AND b.cmt LIKE '%$cmt%'";
if($ns!='') {
	$ns = strtotime($ns);
	$sql.=" AND b.ngaysinh LIKE '%$ns%'";
}
if($dc!='') $sql.=" AND b.diachi LIKE '%$dc%'";
if($nganh!='') $sql.=" AND a.id_nganh='$nganh'";
if($sbd!='') $sql.=" AND a.sbd LIKE '%$sbd%'";

$sql.=" ORDER BY b.cdate DESC,a.id_nganh ASC ";
$obj->Query($sql); // echo $sql;
$total_rows = $obj->Num_rows();
$start=0; if($cur_page>1) $start = ($cur_page-1)*MAX_ROWS;
$obj->Query($sql." LIMIT $start,".MAX_ROWS);
?>
<table class="list table table-striped table-bordered">
	<thead><tr class="header">
		<th class="text-center">STT</th>
		<th>Mã HS</th>
		<th>Họ tên</th>
		<th class="text-center">Giới tính</th>
		<th class="text-center">Ngày sinh</th>
		<th class="text-center">Số ngành</th>
		<th class="text-center"></th>
		<th class="text-center">Trạng thái</th>
	</tr></thead>
	<tbody>
		<?php $i=$start;
		while($r=$obj->Fetch_Assoc()) { 
			$i++;
			$id=$r['id']; $id_hoso = $r['ma']; $sbd=$r['sbd']; $tongdiem=''; $mon1=$mon2=$mon3=null;
			if(isset($r['mon1']) && $r['mon1']>=0 && $r['mon2']>=0 && $r['mon3']>=0) {
				$mon1 = $r['mon1']; $mon2 = $r['mon2']; $mon3 = $r['mon3'];
				$tongdiem = $r['mon1']+$r['mon2']+$r['mon3'];
			}
			$trungtuyen=$r['trungtuyen'];
			$nhaphoc=$r['nhaphoc'];
			$isactive=$r['isactive'];
			$status='';
			if($sbd=='' || $sbd==null || $trungtuyen==null) 
				$status='<label class="label label-default">Hồ sơ mới</label>';
			elseif($sbd!=='' && ($mon1==null || $mon2==null || $mon3==null)) 
				$status='<label class="label label-warning">Hồ sơ thi</label>';
			elseif( $sbd!=='' && $mon1>=0 && $mon2>=0 && $mon3>=0) 
				$status='<label class="label label-info">Hồ sơ đã thi</label>';
			if($trungtuyen==1 && ($nhaphoc==null || $nhaphoc==0))
				$status='<label class="label label-primary">Hồ sơ trúng tuyển</label>';
			if($trungtuyen==0)
				$status='<label class="label label-danger">Hồ sơ chưa trúng tuyển</label>'; 
			if($nhaphoc==1)
				$status='<label class="label label-success">Hồ sơ đã nhập học</label>';
			if($id==null) 
				$status='<label class="label label-default">Hồ sơ chưa ĐK ngành</label>';
			?>
			<tr dataid="<?php echo $id_hoso;?>">
				<td align="center"><?php echo $i;?></td>
				<td dataid="<?php echo $id_hoso;?>">
					<a href="<?php echo ROOTHOST;?>student/profile/<?php echo $id_hoso;?>"><?php echo stripslashes($id_hoso);?></a>
				</td>
				<td dataid="<?php echo $id_hoso;?>">
					<a href="<?php echo ROOTHOST;?>student/profile/<?php echo $id_hoso;?>"><?php echo stripslashes($r['ho_dem']).' '.stripslashes($r['name']);?></a>
				</td>
				<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo $GLOBALS['ARR_GENDER'][$r['gioitinh']];?></td>
				<td dataid="<?php echo $id_hoso;?>" class="text-center"><?php echo date("d/m/y",$r['ngaysinh']);?></td>

				<?php $count_nganh = SysCount('tbl_dangky_tuyensinh', 'AND id_hoso="'.$r['id_hoso'].'"');?>

				<td dataid="<?php echo $id_hoso;?>" class="text-center">
					<?php echo $count_nganh;?>
				</td>

				<td class="text-center">
					<a href="<?php echo ROOTHOST;?>student/soyeulylich/<?php echo $id_hoso;?>" class='btn btn-default'>Sơ yếu lý lịch</a>
				</td>

				<td align="center"><?php echo $status;?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
	<tr><td align="center">
		<?php paging($total_rows,MAX_ROWS,$cur_page); ?>
	</td></tr>
</table>
<script>
	$(".dk_nganh").click(function(){
		var ma = $(this).attr('dataid');
		frm_dangky(ma);
	})
	function frm_dangky(ma){
		var url = "<?php echo ROOTHOST;?>ajaxs/tuyensinh/dangky.php";
		$.post(url,{'ma':ma},function(req){
			$('#myModalPopup .modal-dialog').removeClass('modal-sm');
			$('#myModalPopup .modal-dialog').addClass('modal-lg');
			$('#myModalPopup .modal-title').html('Đăng ký ngành học');
			$('#myModalPopup .modal-body').html(req);
			$('#myModalPopup').modal('show');
		})
	}
</script>