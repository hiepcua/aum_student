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
	$nganh = isset($_POST['nganh'])?addslashes(strip_tags($_POST['nganh'])):'';
	$sql = "SELECT id from tbl_lop WHERE 1=1 ";
	if($he!='') $sql.=" AND id_he='$he'";
	if($nganh!='') $sql.=" AND id_nganh='$nganh'";
	$obj->Query($sql); 
?>
<option value=''>Lớp</option>
<?php while($r=$obj->Fetch_Assoc()) echo "<option value='".$r['id']."'>".$r['id']."</option>";
} ?>