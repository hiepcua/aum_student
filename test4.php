<?php
session_start();
ini_set("display_errors",1);
require_once('global/libs/gfconfig.php');
require_once('global/libs/gfinit.php');
require_once('global/libs/gffunc.php');
require_once('includes/gfconfig.php');
require_once('libs/cls.mysql.php');

$year='2021';
$str="13/04/2021 00:00	KH253970	L2	Đinh Thị Cẩm Nhung	942222211	TNU-HN,GV-TNU-HN,MKT-TNUHN	942222211@gmail.com	Ninh Bình	Nguyễn Thị Thùy Dương	19/02/2021 00:00:00	22/03/2021	Ngõ 63, Bắc Sơn, Tam Điệp, Ninh Bình	18/11/1991	Tài chính - Ngân hàng	Cao Đẳng Cùng Ngành	Nữ	02/04/2021	Đã Bàn Giao		Đủ	2	2	2				2		2	2		AUM0221HN	1	2021	1	AUM0221HNTCBC	21-2-7340201-0520		457				
30/01/2021 00:00	KH249472	L2	Đặng Đình Long	942222212	TNU-HN,GV-TNU-HN	942222212@gmail.com	Sơn La	Vũ Thị Thu Hà	22/01/2021 00:00:00	29/01/2021	TK 17, Thị trấn Hát Lót, Mai Sơn, Sơn La	07/10/1994	Tài chính - Ngân hàng	Cao Đẳng Khác Ngành	Nam	19/02/2021	Đã Bàn Giao		Đủ	2	2	2				2	2	2	2		AUM0121HN	1	2021	1	AUM0121HNTCBK	21-2-7340201-0110		271		Đang học ( Đã có QĐTT)		
09/03/2021 00:00	KH249347	L2	Nguyễn Thị Ngọc Truyền	942222213	TNU-HCM,GV-TNU-HCM,MKT-TNUHN	942222213@gmail.com	Bình Định	Nguyễn Thị Thùy Dương	22/01/2021 00:00:00	25/02/2021	Ea Wer, Buôn Đôn, Đăk Lăk	14/05/1994	Tài chính - Ngân hàng	Cao Đẳng Khác Ngành	Nữ	11/03/2021	Đã Bàn Giao		Đủ	2	2	2				2		2	2		AUM0121HC	1	2021	1	AUM0121HCTCBK	21-2-7480201-0670		458				
08/04/2021 00:00	KH245442	L2	Nguyễn Thị Dịu	942222214	TNU-HN,GV-TNU-HN,MKT-ĐL-TN-TNU	942222214@gmail.com	Sơn La	Vũ Thị Thu Hà	04/01/2021 00:00:00	11/01/2021	Tổ 8, Túc Duyên, TP Thái Nguyên	06/10/1989	Tài chính - Ngân hàng	Cao Đẳng Khác Ngành	Nữ	22/01/2021	Đã Bàn Giao	Nộp tại trường	Đủ												AUM0121HN	1	2021	1	AUM0121HNTCBK	21-2-7340201-0007		162		Đang học ( Đã có QĐTT)		
15/05/2021 00:00	KH240675	L3	Nguyễn Chí Hiếu	942222215	TNU-HCM,GV-TNU-HCM,MKT-TNUHCM	942222215@gmail.com	Tiền Giang	Vũ Thị Thu Hà	12/10/2020 00:00:00	18/12/2020	Long Hưng, Phước Thành, Mỹ Tho, Tiền Giang	16/03/1993	Tài chính - Ngân hàng	Cao Đẳng Cùng Ngành		30/12/2020	Đã Bàn Giao		Đủ		2	2				2		2	2		AUM0620HC	1	2020	1	AUM0620HCTCBC	21-2-7340201-0043		162		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	27/04/2021
18/05/2021 00:00	KH239553	L3	Nguyễn Ngọc Lân	942222216	TNU-HCM,GV-TNU-HCM,MKT-TNUHN	942222216@gmail.com	Ninh Thuận	Vũ Thị Thu Hà	05/12/2020 00:00:00	11/12/2020	Số 40, đường 16/4, Phường Tấn Tài, Tp Phan Rang Tháp Chàm, Tỉnh Ninh Thuận	23/10/1992	Tài chính - Ngân hàng	Đại Học		17/12/2020	Đã Bàn Giao	0	Đủ		2	2				2		2	2		AUM0620HC	1	2020	1	AUM0620HCTCAK	20-2-7340101-3094		2970		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	27/04/2021
18/05/2021 00:00	KH239347	L3	Hoàng Minh Tuấn	942222217	TNU-HN,GV-TNU-HN,MKT-TNUHN	942222217@gmail.com	Nghệ An	Vũ Thị Thu Hà	04/12/2020 00:00:00	07/12/2020	Số 53, Ngõ 1, Cao Bá Quát, Trường Thi, Thành phố Vinh , Nghệ An	19/05/1991	Tài chính - Ngân hàng	Trung Học Phổ thông	Nam	17/12/2020	Đã Bàn Giao	0	Đủ		2	2				2		2	2		AUM0620HN	1	2020	1	AUM0620HNTCDX	20-2-7340201-3021		2972		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	28/04/2021
07/05/2021 00:00	KH231665	L9A	Bảo Quý Trung	942222218	TNU-HCM,GV-TNU-HCM	942222218@gmail.com	Đắk Lắk	Vũ Thị Thu Hà	03/11/2020 00:00:00	04/11/2020	103 Nguyễn Trãi, P.Thành Công, TP.Buôn Ma Thuột, Đắk Lắk	11/05/1988	Tài chính - Ngân hàng	Đại Học	Nam	12/11/2020	Đã Bàn Giao		Đủ		2	2				2		2	2		AUM0520HC	1	2020	2	AUM0520HCTCAK	20-2-7340201-2469		2401		Ngưng học do bận, học khó , không có tài chính, tính chất cv	Ngưng học chưa có QĐ	03/05/2021
05/05/2021 00:00	KH228371	L3	Nguyễn Trung Hải	942222219	TNU-HN,GV-TNU-HN,MKT-TNUHN	942222219@gmail.com	Hải Dương	Vũ Thị Thu Hà	15/10/2020 00:00:00	15/10/2020	Số 16, Ngách 4, Đường Lê Trọng Tấn, Tổ 8, Phường Chiềng Sinh, Thành phố Sơn La, tỉnh Sơn La.	25/06/1980	Tài chính - Ngân hàng	Đại Học	Nam	22/10/2020	Đã Bàn Giao		Đủ		2	2				2		2	2		AUM0520HN	1	2020	2	AUM0520HNTCAC	20-2-7340201-2113	0	2278		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	
12/04/2021 00:00	KH227339	L3	Nguyễn Xuân Hiếu	942222220	MKT-TNU-HOT,TNU-HCM,GV-TNU-HCM	942222220@gmail.com	Đắk Lắk	Vũ Thị Thu Hà	10/10/2020 00:00:00	12/10/2020	97 Hà Huy Tập, TP. Buôn Ma Thuột, Tỉnh Đắk Lắk	21/02/1997	Tài chính - Ngân hàng	Trung Học Phổ thông	Nam	22/10/2020	Đã Bàn Giao		Đủ		2	2				2		2	2		AUM0520HC	1	2020	2	AUM0520HCTCDX	20-2-7340201-2152		2278		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	
07/05/2021 00:00	KH226839	L3	Nguyễn Đức Phương	942222221	MKT-TNU-HOT,TNU-HN,GV-TNU-HN	942222221@gmail.com	Bắc Giang	Vũ Thị Thu Hà	08/10/2020 00:00:00	16/10/2020	Số nhà 10, đường Hùng Vương 3, tổ dân phố Tiền Tiến, phường Hoàng Văn Thụ, thành phố Bắc Giang, tỉnh Bắc Giang	07/05/1982	Tài chính - Ngân hàng	Đại Học	Nam	22/10/2020	Đã Bàn Giao		Đủ		2	2				2		2	2		AUM0520HN	1	2020	2	AUM0520HNTCAK	20-2-7340201-2114	0	2278		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	
07/04/2021 00:00	KH223428	L9A	Nguyễn Thị Phương Thảo	942222222	TNU-HCM,GV-TNU-HCM,MKT-TNUHCM	942222222@gmail.com	Ninh Thuận	Vũ Thị Thu Hà	23/09/2020 00:00:00	29/10/2020	Thôn Láng Me, xã Bắc Sơn, huyện Thuận Bắc, tỉnh Ninh Thuận	02/08/1995	Tài chính - Ngân hàng	Cao Đẳng Cùng Ngành	Nữ	05/11/2020	Đã Bàn Giao		Đủ		2	2		2		2		2	2		AUM0520HC	1	2020	1	AUM0520HCTCBC	20-2-7340201-2416		2344		Ngưng học do bận, học khó , không có tài chính, tính chất cv	Ngưng học chưa có QĐ	29/01/2021
17/02/2021 00:00	KH215076	L3	Ngô Thị Hài	942222223	TNU-HN,GV-TNU-HN,MKT-TNUHN	942222223@gmail.com	Ninh Bình	Nguyễn Thị Thùy Dương	19/08/2020 00:00:00	20/08/2020	Thị Trấn Khánh Yên, Văn Bàn, Lào Cai	22/05/1989	Tài chính - Ngân hàng	Trung Học Phổ thông	Nữ	27/08/2020	Đã Bàn Giao		Đủ	1	2	2				2		2	2		AUM0420HN	1	2020	2	AUM0420HNTCDX	20-2-7340201-1350		1902		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	
29/03/2021 00:00	KH210092	L3	Lương Văn Đưởng	942222224	MKT-TNU-CHAT,TNU-HN,GV-TNU-HN	942222224@gmail.com	Nam Định	Vũ Thị Thu Hà	25/07/2020 00:00:00	17/08/2020	Hải Tân, Hải Hậu, Nam Định	24/07/1993	Tài chính - Ngân hàng	Trung Học Phổ thông	Nam	15/09/2020	Đã Bàn Giao		Đủ	1	2	2				2		2	2		AUM0520HN	1	2020	2	AUM0520HNTCDX	20-2-7340201-1368	0	1923		Đang học ( Đã có QĐTT)	Không Nghe Máy	
23/04/2021 00:00	KH209094	L3	Đinh Văn Thạch	942222225	MKT-TNU-CHAT,TNU-HN,GV-TNU-HN	942222225@gmail.com	Bắc Ninh	Nguyễn Thị Thùy Dương	21/07/2020 00:00:00	29/07/2020	Phù Lang, Phù Lương, Quế Võ, Bắc Ninh	18/04/1984	Tài chính - Ngân hàng	Đại Học	Nam	20/08/2020	Đã Bàn Giao		Đủ	1	4	2				2		4	2		AUM0420HN	1	2020	2	AUM0420HNTCAK	20-2-7340201-1174		1715		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	
23/04/2021 00:00	KH204926	L3	Phan Thị Đào	942222226	TNU-HN,MKT-ĐL-HC-TNU,GV-TNU-HN	942222226@gmail.com	Nghệ An	Nguyễn Thị Thùy Dương	26/06/2020 00:00:00	03/07/2020	P303CT5 KĐT Đặng Xá, tổ 03, xã Cổ Bi, huyện Gia Lâm, TP. Hà Nội	27/07/1993	Tài chính - Ngân hàng	Đại Học	Nữ	06/08/2020	Đã Bàn Giao		Đủ	1	2	2				2		2	2		AUM0420HN	1	2020	2	AUM0420HNTCAK	20-2-7340201-0996		1643		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	
17/05/2021 00:00	KH199642	L9A	Trần Nguyễn Hoàng Tuấn	942222227	MKT-TNU,TNU-HCM,GV-TNU-HCM	942222227@gmail.com	Tiền Giang	Nguyễn Thị Thùy Dương	28/05/2020 00:00:00	16/06/2020	Mỹ Trường, Mỹ Phước, Tân Phước, Tiền Giang	24/04/1996	Tài chính - Ngân hàng	Đại Học	Nam	01/07/2020	Đã Bàn Giao		Đủ	1	2	2				2		2	2		AUM0320HC	1	2020	1	AUM0320HCTCAK	20-2-7340201-0724		1378		Ngưng học do bận, học khó , không có tài chính, tính chất cv	Ngưng học chưa có QĐ	22/03/2021
18/02/2021 00:00	KH198787	L3	Trịnh Thanh Mai	942222228	CHƯA XĐ,TNU-HN,GV-TNU-HN	942222228@gmail.com	Thanh Hóa	Nguyễn Thị Thùy Dương	20/05/2020 00:00:00	28/07/2020	Định Hòa, Yên Định, Thanh Hóa	18/06/1976	Tài chính - Ngân hàng	Cao Đẳng Cùng Ngành	Nam	06/08/2020	Đã Bàn Giao		Đủ	1	2	2				2		2	2		AUM0420HN	1	2020	2	AUM0420HNTCBC	20-2-7340201-0995		1643		Đang học ( Đã có QĐTT)	Đã nộp tại AUM	
14/05/2021 00:00	KH193018	L9A	Đinh Trung Dũng	942222229	TNU-HN,MKT-ĐL-HC-TNU,GV-TNU-HN	942222229@gmail.com	Lạng Sơn	Nguyễn Thị Thùy Dương	23/04/2020 00:00:00	19/05/2020	25 khu nhà thờ, TT Lộc Bình, H.Lộc Bình, Lạng Sơn	27/09/1992	Tài chính - Ngân hàng	Cao Đẳng Cùng Ngành		07/07/2020	Đã Bàn Giao		Đủ	1	2	4				2		2	2		AUM0320HN	1	2020	1	AUM0320HNTCBC			1410		Ngưng học do bận, học khó , không có tài chính, tính chất cv	Ngưng học chưa có QĐ	22/03/2021
";

// Get all khoa đã có
$arr_khoa = array();
$res_khoa = SysGetList('tbl_khoa', array('id'), '');
if(count($res_khoa)>0){
	foreach ($res_khoa as $key => $value) {
		$arr_khoa[] = $value['id'];
	}
}

// Get all lop đã có
$arr_lop = array();
$res_lop = SysGetList('tbl_lop', array('id'), '');
if(count($res_lop)>0){
	foreach ($res_lop as $key => $value) {
		$arr_lop[] = $value['id'];
	}
}

// Get all mã hồ sơ đã có
$arr_mahoso = array();
$res_hocsinh = SysGetList('tbl_hocsinh', array('ma'), '');
if(count($res_hocsinh)>0){
	foreach ($res_hocsinh as $key => $value) {
		$arr_mahoso[] = $value['ma'];
	}
}

// Get all mã học viên đã có
$arr_masv = array();
$res_dkts = SysGetList('tbl_dangky_tuyensinh', array('masv'), '');
if(count($res_dkts)>0){
	foreach ($res_dkts as $key => $value) {
		$arr_masv[] = $value['masv'];
	}
}

/* ----------------------------------------------- */
$objmysql=new CLS_MYSQL;
$objmysql->Exec("BEGIN");
$flag1 = $flag2 = $flag3 = $flag4 = true;

$rows=explode("\n",$str);
foreach($rows as $r){
	if($r=='') continue;
	$cols=explode("\t",$r);

	/*Bảng học sinh*/
	$hodem = $name = '';
	$ma_hoso 	= isset($cols[1]) && $cols[1]!='' ? antiData($cols[1]) : '';
	$fullname 	= isset($cols[3]) && $cols[3]!='' ? antiData($cols[3]) : '';
	if($fullname!=''){
		$arr_name = explode(' ', $fullname);
		$name = end($arr_name);
		$num = count($arr_name);
		foreach ($arr_name as $key => $value) {
			if($key < $num - 1){
				$hodem.= $value.'  ';
			}
			$hodem = substr($hodem, 0, strlen($hodem) - 1);
		}
	}

	$dienthoai 	= isset($cols[4]) && $cols[4]!='' ? antiData($cols[4]) : '';
	$email 		= isset($cols[6]) && $cols[6]!='' ? antiData($cols[6]) : '';
	$noisinh 	= isset($cols[7]) && $cols[7]!='' ? antiData($cols[7]) : '';
	$ngaytao 	= isset($cols[9]) && $cols[9]!='' ? strtotime($cols[9]) : '';
	$hktt 		= isset($cols[11]) && $cols[11]!='' ? antiData($cols[11]) : '';
	$ngaysinh 	= isset($cols[12]) && $cols[12]!='' ? strtotime($cols[12]) : '';
	$gioitinh 	= isset($cols[15]) && $cols[15]!='' && antiData($cols[15])=='Nam' ? 'nam' : 'nu';
	$ngayBG 		= isset($cols[16]) && $cols[16]!='' ? strtotime($cols[16]) : '';
	$tinhtrangBG 	= isset($cols[17]) && $cols[17]!='' ? antiData($cols[17]) : '';
	$lydoBG 		= isset($cols[18]) && $cols[18]!='' ? antiData($cols[18]) : '';
	// var_dump($noisinh); echo '<br>'; 
	// echo strtotime($cols[12]).' | '.strtotime('18/11/1991').'<br>';

	// echo $ngaysinh.'<br>';
	/* Kiểm tra nếu đã tồn tại mã hồ sơ hay chưa nếu chưa thì thêm mới */
	if(!in_array($ma_hoso, $arr_mahoso)){
		$sql="INSERT INTO tbl_hocsinh (
		`ma`,`ho_dem`,`name`,`ngaysinh`,`noisinh`,
		`gioitinh`,`diachi`,`dienthoai`,`nguyenquan`,`hktt`,`email`,`cdate`,
		`ngayBG`,`tinhtrangBG`,`lydoBG`
		) VALUES (
		'$ma_hoso','$hodem','$name','$ngaysinh','$noisinh',
		'$gioitinh','$hktt','$dienthoai','$noisinh','$hktt','$email','$ngaytao',
		'$ngayBG','$tinhtrangBG','$lydoBG')";
		
		$result1 = $objmysql->Exec($sql);
		if(!$result1) {
			$flag1 = false;
			echo $sql;
		}
	}else{
		echo 'Mã hồ sơ '.$ma_hoso.' đã tồn tại</br>';
		$flag1 = false;
	}
	
	/*Bảng đăng ký tuyen sinh*/
	$khoa 				= isset($cols[31]) && $cols[31]!='' ? antiData($cols[31]) : '';
	$nganhdangky 		= isset($cols[13]) && $cols[13]!='' ? antiData($cols[13]) : '';
	$malop 				= isset($cols[35]) && $cols[35]!='' ? antiData($cols[35]) : '';
	$masv				= isset($cols[36]) && $cols[36]!='' ? antiData($cols[36]) : '';
	$status 			= isset($cols[2]) && $cols[2]!='' ? antiData($cols[2]) : 'L0';
	
	$nhomkhachhang 		= isset($cols[5]) && $cols[5]!='' ? antiData($cols[5]) : '';
	$id_staff 			= isset($cols[8]) && $cols[8]!='' ? antiData($cols[8]) : '';
	$date_level_up 		= isset($cols[10]) && $cols[10]!='' ? strtotime($cols[10]) : '';
	$namnhaphoc 		= isset($cols[33]) && $cols[33]!='' ? antiData($cols[33]) : '';
	$kyhoc 				= isset($cols[34]) && $cols[34]!='' ? antiData($cols[34]) : '';

	$hs_tinhtrang 		= isset($cols[19]) && $cols[19]!='' ? antiData($cols[19]) : '';
	$hs_vo 				= isset($cols[20]) && $cols[20]!='' ? antiData($cols[20]) : '';
	$hs_anh 			= isset($cols[21]) && $cols[21]!='' ? antiData($cols[21]) : '';
	$hs_bang 			= isset($cols[22]) && $cols[22]!='' ? antiData($cols[22]) : '';
	
	$hs_cn_totnghiep 	= isset($cols[23]) && $cols[23]!='' ? antiData($cols[23]) : '';
	$hs_bangdiem 		= isset($cols[24]) && $cols[24]!='' ? antiData($cols[24]) : '';
	$hs_hocba 			= isset($cols[25]) && $cols[25]!='' ? antiData($cols[25]) : '';
	$hs_pdk 			= isset($cols[26]) && $cols[26]!='' ? antiData($cols[26]) : '';
	
	$hs_giay_ks 		= isset($cols[27]) && $cols[27]!='' ? antiData($cols[27]) : '';
	$hs_cmt 			= isset($cols[28]) && $cols[28]!='' ? antiData($cols[28]) : '';
	$hs_mota 			= isset($cols[29]) && $cols[29]!='' ? antiData($cols[29]) : '';
	$dotnhaphoc 		= isset($cols[32]) && $cols[32]!='' ? antiData($cols[32]) : '';

	$qd_trungtuyen 		= isset($cols[38]) && $cols[38]!='' ? antiData($cols[38]) : '';
	$qd_congnhansv 		= isset($cols[39]) && $cols[39]!='' ? antiData($cols[39]) : '';
	$tinhtrang_sv 		= isset($cols[40]) && $cols[40]!='' ? antiData($cols[40]) : '';
	$tinhtrang_hocphi 	= isset($cols[41]) && $cols[41]!='' ? antiData($cols[41]) : '';
	$last_contact 		= isset($cols[0]) && $cols[0]!='' ? strtotime($cols[0]) : 0;
	$hetotnghiep 		= isset($cols[14]) && $cols[14]!='' ? antiData($cols[14]) : '';

	/* Fix dữ liệu demo */
	$nganhdangky = 'TCNH';
	$he = 'AUM'; 
	$id_staff = $nguoiphutrach = 'NV001';
	$cdate = time();
	$nhaphoc = 1; /* Bắt buộc */

	if(!in_array($masv, $arr_masv)){
		$sql2="INSERT INTO tbl_dangky_tuyensinh (
		`id_khoa`,`id_he`,`id_nganh`,`malop`,`masv`,`status`,
		`id_hoso`,`cdate`,`nhaphoc`,`nhomkhachhang`,`id_staff`,
		`date_level_up`,`namnhaphoc`,`kyhoc`,
		`hs_tinhtrang`,`hs_vo`,`hs_anh`,`hs_bang`,
		`hs_cn_totnghiep`,`hs_bangdiem`,`hs_hocba`,`hs_pdk`,
		`hs_giay_ks`,`hs_cmt`,`hs_mota`,`dotnhaphoc`,`hetotnghiep`,
		`qd_trungtuyen`,`qd_congnhansv`,`tinhtrang_sv`,`tinhtrang_hocphi`,`last_contact`
		) VALUES (
		'$khoa','$he','$nganhdangky','$malop','$masv','$status',
		'$ma_hoso','$cdate','$nhaphoc','$nhomkhachhang','$id_staff',
		'$date_level_up','$namnhaphoc','$kyhoc',
		'$hs_tinhtrang','$hs_vo','$hs_anh','$hs_bang',
		'$hs_cn_totnghiep','$hs_bangdiem','$hs_hocba','$hs_pdk',
		'$hs_giay_ks','$hs_cmt','$hs_mota','$dotnhaphoc','$hetotnghiep',
		'$qd_trungtuyen','$qd_congnhansv','$tinhtrang_sv','$tinhtrang_hocphi','$last_contact')";

		$result2 = $objmysql->Exec($sql2);
		if(!$result2) {
			$flag2 = false;
			echo $sql2;
		}
	}else{
		echo 'Mã sinh viên '.$masv.' đã tồn tại</br>';
		$flag2 = false;
	}

	/* Bảng khóa */
	if(!in_array($khoa, $arr_khoa)){
		$sql3="INSERT INTO tbl_khoa (`id`,`name`) VALUES ('$khoa','$khoa')";
		$result3 = $objmysql->Exec($sql3);
	}

	/* Bảng lớp */
	if(!in_array($malop, $arr_lop)){
		$sql4="INSERT INTO tbl_lop (`id`,`id_nganh`,`id_he`,`id_khoa`,`name`,`cdate`) VALUES 
		('$malop','$nganhdangky','$he','$khoa','$malop','$cdate')";
		$result4 = $objmysql->Exec($sql4);
	}
}
if($flag1 && $flag2) {
	$objmysql->Exec("COMMIT"); echo "success";
}else { 
	$objmysql->Exec("ROLLBACK"); echo "error";
}
?>