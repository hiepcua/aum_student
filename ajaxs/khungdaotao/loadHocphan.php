<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['nganh'])) {
	$nganh=addslashes(htmlentities(strip_tags($_POST['nganh'])));
	$obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_monhoc";
	$obj->Query($sql);
	$arrMon=array();
	while($r=$obj->Fetch_Assoc()){
		$arrMon[$r['id']]=$r;
	}
	$sql="SELECT * FROM tbl_hocphan_khung WHERE id_nganh='$nganh'";
	$obj->Query($sql);
	$stt=0;
	while($r=$obj->Fetch_Assoc()) {
		$id=$r['id'];
		$stt++;
		$hoso=0;
	?>
	<tr><td class='text-center'><?php echo $stt;?></td>
		<td><i class="fa fa-trash btn_xoa" aria-hidden="true" title='Xóa' dataid='<?php echo $id;?>'></i></td>
		<td><?php echo stripslashes($arrMon[$r['id_monhoc']]['name']);?></td>
		<td><?php echo stripslashes($r['hocky']);?></td>
		<td class='text-right'><?php echo $r['tinchi'];?></td>
		<td class='text-right'><?php echo $r['lythuyet'];?></td>
		<td class='text-right'><?php echo $r['thuchanh'];?></td>
		<td class='text-center'>
		<i class="fa fa-pencil-square-o btn_edit" aria-hidden="true" title='Sửa' dataid='<?php echo $id;?>'></i>
		</td>
	</tr>
	<?php }
}?>