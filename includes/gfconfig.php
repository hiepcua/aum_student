<?php
define("DIR_UPLOAD_FILE","uploads/");
define("partner_CODE","EEA");
$GLOBALS['ARR_SOURCE'] = array(
	//'1'=>"Viện đào tạo trực tuyến",
	//'2'=>"Chứng chỉ ngắn hạn"
);
$GLOBALS['ARR_GENDER'] = array(
	'0'=>"Nữ",
	'1'=>"Nam"
);
$GLOBALS['ARR_PTXT'] = array(
	'0'=>"Xét học bạ",
	'1'=>"Xét điểm thi THPT"
);
$GLOBALS['ARR_DIADIEM'] = array(
	'0'=>"Cơ sở 1",
	'1'=>"Cơ sở 2"
);
$GLOBALS['TRANGTHAI_HS'] = array(
	'0'=>"Đã bỏ học",
	'1'=>"Đang học",
	'2'=>"Bảo lưu"
);
$GLOBALS['TRANGTHAI_LABEL'] = array(
	'0'=>"label-danger",
	'1'=>"label-success",
	'2'=>"label-warning"
);

//PHAN  QUYEN
$GLOBALS['ARR_ACTION'] = array(
	'view'		=>1,
	'add'		=>2,
	'edit'		=>4,
	'delete'	=>8,
	'accept'	=>16
	);
$GLOBALS['ARR_ACTION_NAME'] = array(
	'view'		=>'Xem',
	'add'		=>'Thêm',
	'edit'		=>'Sửa',
	'delete'	=>'Xóa',
	'accept'	=>'Duyệt'
	);
$GLOBALS['ARR_COM'] = array(
	'config'	=>1,
	'gusers'	=>2,
	'user'		=>4,
	'partner'	=>8,
	'city'		=>16,
	'notify'	=>32,
	'edu_khoa'	=>64,
	'edu_he'	=>128,
	'edu_nganh' =>256,
	'edu_monhoc'=>512,
	'edu_hocphi'=>1024,
	'edu_hoso'	=>2048,
	'edu_khungdt'=>4096,
	'sv_hsdaotao'=>8192,
	'sv_qlhocphi'=>16384,
	'sv_qlhoctap'=>32768,
	'sv_tuyensinh'		=>65536,
	'sv_hsthi'			=>131072,
	'sv_hsdathi'		=>262144,
	'sv_hstrungtuyen'	=>524288,
	'sv_hsnhaphoc'		=>1048576,
	'sv_hsxettuyen'		=>2097152,
	'sv_hstruot'		=>4194304,
	'sv_qllop'		=>8388608,
	'sv_hoso'		=>16777216,
	'report'	=>33554432,
	);
$GLOBALS['ARR_COM_ACT'] = array(
	'config'	=>4, // edit
	'gusers'	=>15, 
	'user'		=>15, 
	'partner'	=>15, 
	'city'		=>15,
	'notify'	=>15,
	'edu_khoa'	=>15,
	'edu_he'	=>15,
	'edu_nganh'	=>15,
	'edu_monhoc'=>15,
	'edu_hocphi'=>15,
	'edu_hoso'	=>15,
	'edu_khungdt'	=>15,
	'sv_hsdaotao'	=>15,
	'sv_qlhocphi'	=>15,
	'sv_qlhoctap'	=>15,
	'sv_tuyensinh'	=>15,
	'sv_hsthi'		=>15,
	'sv_hsdathi'	=>15,
	'sv_hstrungtuyen'=>15,
	'sv_hsnhaphoc'	=>15,
	'sv_hsxettuyen'		=>15,
	'sv_hstruot'		=>15,
	'sv_qllop'		=>15,
	'sv_hoso'		=>15,
	'report'		=>15
	);
$GLOBALS['ARR_COM_NAME'] = array(
	'config'	=>'Cấu hình chung',
	'gusers'	=>'Nhóm quản trị',
	'user'		=>'Thành viên quản trị',
	'partner'	=>'Đối tác tuyển sinh', 
	'city'		=>'QL khu vực Tỉnh/thành',
	'notify'	=>'Thông báo (Lịch sử quản lý)',
	'edu_khoa'	=>'Khóa đào tạo',
	'edu_he'	=>'Bậc đào tạo',
	'edu_nganh'	=>'Ngành đào tạo',
	'edu_monhoc'=>'Danh mục môn học',
	'edu_hocphi'=>'Danh mục học phí',
	'edu_hoso'	=>'Danh mục hồ sơ',
	'edu_khungdt'	=>'Khung đào tạo',
	'sv_hsdaotao'	=>'Quản lý đào tạo',
	'sv_qlhocphi'	=>'Quản lý học phí',
	'sv_qlhoctap'	=>'Quản lý học tập',
	'sv_tuyensinh'	=>'Hồ sơ tuyển sinh mới',
	'sv_hsthi'		=>'Hồ sơ thi',
	'sv_hsdathi'	=>'Hồ sơ đã thi',
	'sv_hstrungtuyen'=>'Hồ sơ trúng tuyển',
	'sv_hsnhaphoc'	=>'Hồ sơ nhập học',
	'sv_hsxettuyen' =>'Hồ sơ xét tuyển',
	'sv_hstruot' =>'Hồ sơ không trúng tuyển',
	'sv_qllop'		=>'Quản lý lớp',
	'sv_hoso'		=>'Quản lý hồ sơ',
	'report'		=>'Báo cáo'
	);
$GLOBALS['MSG_PERMIS']='<div id="action" style="background-color:#fff; margin:10px 15px;padding:10px 0"><h3 align="center">Bạn không có quyền truy cập.</h3></div>';
?>