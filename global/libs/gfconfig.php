<?php
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
	$isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$isSecure = true;
}
$REQUEST_PROTOCOL = $isSecure ? 'https://' : 'http://';

define('ROOTHOST','http://localhost/edaotao2/');
// define('ROOTHOST',$REQUEST_PROTOCOL.$_SERVER['HTTP_HOST'].'/');
define('WEBSITE',$REQUEST_PROTOCOL.$_SERVER['HTTP_HOST'].'/');
define('ROOTHOST_ADMIN',ROOTHOST);

define('ROOT_PATH','');
define('TEM_PATH',ROOT_PATH.'templates/');
define('COM_PATH',ROOT_PATH.'components/');
define('MOD_PATH',ROOT_PATH.'modules/');
define('LIB_PATH',ROOT_PATH.'libs/');
define('URLEDITOR',ROOTHOST.'');
define('BASEVIRTUAL0',ROOTHOST.'images/');
define('MAX_ROWS',25);
define('ASSESS_TOKEN_SMS','eokvTGERlLRVudu8uFA1-jeNvEiTWVHw');

$COM_TITLE=array('frontpage'=>'','customer'=>'CUSTOMERS','order'=>'ORDERS','config'=>'CONFIGS','store'=>'STORES','account'=>'ACCOUTS');

$STATUS_DKTS = array(
	"L0" 	=> 'L0 - Sinh viên nhập học',
	"L1" 	=> 'L1 - Không xác định',
	"L2" 	=> 'L2 - Nhập học thành công',
	"L3" 	=> 'L3 - Đã nộp tiền', // Nộp đủ, thiếu, dư
	"L4" 	=> 'L4 - Không đủ điều kiện thi',
	"L5" 	=> 'L5 - Hoãn thi',
	"L8" 	=> 'L8 - Tốt nghiệp',
	"L9A" 	=> 'L9A - Bảo lưu',
	"L9B" 	=> 'L9B - Bỏ học',
);

$STATUS_DKTS2 = array(
	"TS1" 	=> 'Hồ sơ mới',
	"TS2" 	=> 'Đang thi',
	"TS3" 	=> 'Đã thi',
	"TS4" 	=> 'Trúng tuyển',
	"TS5" 	=> 'Không trúng tuyển',
	"HS1" 	=> 'Hồ sơ nhập học(đang học)',
	"HS2" 	=> 'Tốt nghiệp',
	"HS3" 	=> 'Hồ sơ bảo lưu',
	"HS4" 	=> 'Hồ sơ hủy'
);


