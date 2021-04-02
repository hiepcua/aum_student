<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$obj = new CLS_MYSQL; 
$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');

if(isset($_POST['he'])) {
	$he = isset($_POST['he'])?addslashes(strip_tags($_POST['he'])):'';
	$nganh = isset($_POST['nganh']) && $_POST['nganh']!=0 ? addslashes(strip_tags($_POST['nganh'])) : '';
	$mon = isset($_POST['mon'])?addslashes(strip_tags($_POST['mon'])):'';
	$sql = "SELECT a.*,b.name AS ten_mon from tbl_hocphan_khung AS a
			INNER JOIN tbl_monhoc AS b ON a.id_monhoc=b.id 
			WHERE 1=1 ";
	if($he!='') $sql.=" AND id_he='$he'";
	if($nganh!='') $sql.=" AND id_nganh='$nganh'";
	$obj->Query($sql); 
?>
<option value=''>Môn học</option>
<?php while($r=$obj->Fetch_Assoc()) 
	if($r['id_monhoc']==$mon) 
		echo "<option value='".$r['id_monhoc']."' selected>".$r['ten_mon']."</option>";
	else echo "<option value='".$r['id_monhoc']."'>".$r['ten_mon']."</option>";
} ?>