<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
if(isset($_POST['khoa'])) {
	$khoa=addslashes(htmlentities(strip_tags($_POST['khoa'])));
	$obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_khoa_nganh WHERE id_khoa='$khoa'";
	$obj->Query($sql);
	while($r=$obj->Fetch_Assoc()){
	?>
	<option value='<?php echo $r['id'];?>'>
		<?php echo $r['name']." (".$r['id_he'].") ";?>
	</option>
	<?php }
}?>