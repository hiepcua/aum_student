<?php
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
	$isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$isSecure = true;
}
$REQUEST_PROTOCOL = $isSecure ? 'https://' : 'http://';

define('ROOTHOST',$REQUEST_PROTOCOL.$_SERVER['HTTP_HOST'].'/');
define('WEBSITE',$REQUEST_PROTOCOL.$_SERVER['HTTP_HOST'].'/');
define('ROOTHOST_ADMIN',ROOTHOST);
define('DOCUMENT_ROOT',$_SERVER['DOCUMENT_ROOT'].'/');

define('ROOT_PATH','');
define('TEM_PATH',ROOT_PATH.'templates/');
define('COM_PATH',ROOT_PATH.'components/');
define('MOD_PATH',ROOT_PATH.'modules/');
define('LIB_PATH',ROOT_PATH.'libs/');
define('URLEDITOR',ROOTHOST.'');
define('BASEVIRTUAL0',ROOTHOST.'images/');
define('MAX_ROWS',25);
define('KEY_AUTHEN_COOKIE','BNB_260584');
define('ASSESS_TOKEN_SMS','eokvTGERlLRVudu8uFA1-jeNvEiTWVHw');
define('APP_SECRET','dd0b6d3fb803ca2a51601145a74fd9a8');

define('SCHOOL_CODE','TNU');
define('HOCPHI_AUTO','no');

define('PIT_API_KEY','6b73412dd2037b6d2ae3b2881b5073bc');
define('API_CONTACT_L8','http://crm.aumsys.net/api/student8');
define('API_CONTACT_L8_UPDATE','http://crm.aumsys.net/api/student8_update');
define('API_STAFF','http://uid.aumsys.net/api/user-list');

$_AUTO_UPDATE_SCORE = 0;

$_HOST_LIST=array('loichoi.com','wallet.aumsys.net','uid.aumsys.net','student.aumsys.net','edu.aumsys.net');

$COM_TITLE=array('frontpage'=>'','customer'=>'CUSTOMERS','order'=>'ORDERS','config'=>'CONFIGS','store'=>'STORES','account'=>'ACCOUTS');

// tình trạng bàn giao hồ sơ
$_GLOBALS['STATUS_BAN_GIAO_HO_SO']=array(
	'chua_ban_giao'	=>'Chưa bàn giao',
	'cho_ban_giao'	=>'Chờ bàn giao',
	'da_ban_giao'	=>'Đã bàn giao',
	'khong_ban_giao'=>'Không bàn giao',
);
$_GLOBALS['STATUS_TINH_TRANG_HO_SO']=array(
	'thieu'			=> "<span class='label label-danger'>Thiếu</span>",
	'du_toi_thieu'	=> "<span class='label label-warning'>Đủ tối thiểu</span>",
	'du'			=> "<span class='label label-success'>Đủ</span>"
);

$PERMISSION_ACCESS = array('G04','G01');
$PERMISSION_FULL = array('G04_TP','G04_PP','G01_TP','G01_NV');

include('gffunc.php');
include(DOCUMENT_ROOT.'libs/cls.mysql.php');

if(!isset($_SESSION['LEVEL_STUDENT'])) $_SESSION['LEVEL_STUDENT'] = array();
if(!isset($_SESSION['STATUS_CALL'])) $_SESSION['STATUS_CALL'] = array();
if(!isset($_SESSION['STATUS_CALL_HP'])) $_SESSION['STATUS_CALL_HP'] = array();
if(!isset($_SESSION['STATUS_SV'])) $_SESSION['STATUS_SV'] = array();
if(!isset($_SESSION['STATUS_HOCPHI'])) $_SESSION['STATUS_HOCPHI'] = array();
if(!isset($_SESSION['STATUS_HOCTAP'])) $_SESSION['STATUS_HOCTAP'] = array();

//---- Get config status ---------
if(!$_SESSION['LEVEL_STUDENT'] || !$_SESSION['LEVEL_STUDENT'] || !$_SESSION['LEVEL_STUDENT'] || !$_SESSION['LEVEL_STUDENT'] || !$_SESSION['LEVEL_STUDENT'] || !$_SESSION['LEVEL_STUDENT']){
	$url='http://uid.aumsys.net/api/status_all';
	$json = array();
	$json['key'] = PIT_API_KEY;
	$jsondata = encrypt(json_encode($json, JSON_UNESCAPED_UNICODE), PIT_API_KEY);
	$params = json_encode(array('data'=>$jsondata));
	$res_data = Curl_Post($url, $params);
	$res_conf_status = $res_data['data'];

	if(is_array($res_conf_status) && count($res_conf_status)>0){
		if(isset($res_conf_status["LEVEL_STUDENT"])) {
			foreach ($res_conf_status["LEVEL_STUDENT"] as $key => $value) {
				$_SESSION['LEVEL_STUDENT'][$key] = $value['name'];
			}
		}
		if(isset($res_conf_status["STATUS_CALL"])) {
			foreach ($res_conf_status["STATUS_CALL"] as $key => $value) {
				$_SESSION['STATUS_CALL'][$key] = $value['name'];
			}
		}
		if(isset($res_conf_status["STATUS_CALL_HP"])) {
			foreach ($res_conf_status["STATUS_CALL_HP"] as $key => $value) {
				$_SESSION['STATUS_CALL_HP'][$key] = $value['name'];
			}
		}
		if(isset($res_conf_status["STATUS_SV"])) {
			foreach ($res_conf_status["STATUS_SV"] as $key => $value) {
				$_SESSION['STATUS_SV'][$key] = $value['name'];
			}
		}
		if(isset($res_conf_status["STATUS_HOCPHI"])) {
			foreach ($res_conf_status["STATUS_HOCPHI"] as $key => $value) {
				$_SESSION['STATUS_HOCPHI'][$key] = $value['name'];
			}
		}
		if(isset($res_conf_status["STATUS_HOCTAP"])) {
			foreach ($res_conf_status["STATUS_HOCTAP"] as $key => $value) {
				$_SESSION['STATUS_HOCTAP'][$key] = $value['name'];
			}
		}
	}
}

$LEVEL_STUDENT=$_SESSION['LEVEL_STUDENT'];
$STATUS_CALL=$_SESSION['STATUS_CALL'];
$STATUS_CALL_HP=$_SESSION['STATUS_CALL_HP'];
$STATUS_SV=$_SESSION['STATUS_SV'];
$STATUS_HOCPHI=$_SESSION['STATUS_HOCPHI'];
$STATUS_HOCTAP=$_SESSION['STATUS_HOCTAP'];
