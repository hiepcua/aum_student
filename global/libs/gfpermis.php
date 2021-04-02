<?php
	$GLOBALS['ARR_ACTION'] = array(
		'view'		=>1,
		'add'		=>2,
		'edit'		=>4,
		'delete'	=>8
		);
	$GLOBALS['ARR_ACTION_NAME'] = array(
		'view'		=>'Xem',
		'add'		=>'Thêm',
		'edit'		=>'Sửa',
		'delete'	=>'Xóa',
		);
	$GLOBALS['ARR_COM'] = array(
		'customers'	=>1,
		'orders'	=>2,
		'alert'		=>4,
		'calendar'	=>8,
		'services'	=>16,
		'products'	=>32,
		'wallet'	=>64,
		'config'	=>128,
		'users'		=>256,
		'gusers'	=>512,
		);
	$GLOBALS['ARR_COM_ACT'] = array(
		'customers'	=>15,
		'orders'	=>15,
		'alert'		=>15,
		'calendar'	=>15,
		'services'	=>15,
		'products'	=>15,
		'wallet'	=>15,
		'config'	=>4,// edit
		'users'		=>15,
		'gusers'	=>15,
		);
	$GLOBALS['ARR_COM_NAME'] = array(
		'customers'	=>"Khách hàng",
		'orders'	=>"Đơn hàng",
		'alert'		=>"Dịch vụ sắp hết",
		'calendar'	=>"Lịch biểu",
		'services'	=>"Dịch vụ",
		'products'	=>"Sản phẩm",
		'wallet'	=>"Doanh số",
		'config'	=>"Cấu hình",
		'users'		=>"Thành viên",
		'gusers'	=>"Nhóm thành viên",
		);
	$GLOBALS['MSG_PERMIS']='<div id="action" style="background-color:#fff; margin:10px 15px;"><h3 align="center">Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h3></div>';
?>