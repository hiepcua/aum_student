<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');

$objuser=new CLS_USER;
if(!$objuser->isLogin()) die("E01");
$user = $objuser->getInfo('username');
$nganh = isset($_POST['nganh'])?addslashes(strip_tags($_POST['nganh'])):'';
$sql = "SELECT count( id_hoso) as total,id_nganh FROM tbl_dangky_tuyensinh 
		WHERE trungtuyen=1 AND nhaphoc=1 AND malop is null
		group by id_nganh";
$obj = new CLS_MYSQL; //echo $sql;
$result = $obj->Exec($sql);

?>