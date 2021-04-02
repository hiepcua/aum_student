<?php
function create_masv($khoa,$he,$nganh,$stt){
	$masv=substr($khoa,-2).$he.$nganh.$stt;
	return $masv;
}
function create_sbd($so,$num_char) {
	$end = ''; $stt="";
	for($i=0;$i<$num_char;$i++) $end .=9; 
	if(strlen($so)<$num_char) {
		for($i=0;$i<($num_char-strlen($so));$i++) $stt.=0; 
		$stt.=$so;
	}
	return $stt;
}
function getHe(){
	$obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_he";
	$obj->Query($sql); 
	$arr=array();
	while($r=$obj->Fetch_Assoc()){
		$arr[$r['id']]=$r;
	}
	return $arr;
}
function getMon(){
	$obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_monhoc";
	$obj->Query($sql); 
	$arr=array();
	while($r=$obj->Fetch_Assoc()){
		$arr[$r['id']]=$r;
	}
	return $arr;
}
function getHocphikhac($he,$nganh){
	$obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_dmhocphi WHERE (id_he='$he' AND id_nganh='$nganh') OR `all`=1";
	$obj->Query($sql);
	$arr=array();
	while($r=$obj->Fetch_Assoc()){
		$arr[]=$r;
	}
	return $arr;
}
function getHocphan($he,$nganh){
	$obj=new CLS_MYSQL;
	$sql="SELECT * FROM tbl_hocphan_khung WHERE id_he='$he' AND id_nganh='$nganh'";
	$obj->Query($sql);
	$arr=array();
	while($r=$obj->Fetch_Assoc()){
		$arr[$r['id_monhoc']]=$r;
	}
	return $arr;
}
function innit_hocphi_khac($masv,$arr_hocphi){ // $data là danh sách học phí.
	$obj=new CLS_MYSQL;
	if(is_array($arr_hocphi) && count($arr_hocphi)>0){
		foreach($arr_hocphi as $item){
			$hocky=1;
			$hocphi=$item['hocphi'];
			$ma_hp=$item['id'];
			$type_hp='khac';
			$ten_hp=$item['name'];
			$sql="INSERT INTO tbl_hocphi(`masv`,`hocky`,`hocphi`,`ma_hp`,`ten_hp`,`type_hp`,`ispay`) 
			VAlUES('$masv','$hocky','$hocphi','$ma_hp','$ten_hp','$type_hp','0')";
			$obj->Exec($sql);
		}
	}
}
function innit_hocphi($masv,$arr_hocphan,$arr_he){ // $data là danh sách học phí.
	$obj=new CLS_MYSQL;
	if(is_array($arr_hocphan) && count($arr_hocphan)>0){
		foreach($arr_hocphan as $item){
			$hocky=$item['hocky'];
			$hocphi=$item['tinchi']*$arr_he['hocphi']; //6 tin chi x 300.000d
			$ma_hp=$item['id_monhoc'];
			$type_hp='hoc_phan';
			$ten_hp='hoc chinh';
			$sql="INSERT INTO tbl_hocphi(`masv`,`hocky`,`hocphi`,`ma_hp`,`ten_hp`,`type_hp`,`ispay`) 
			VAlUES('$masv','$hocky','$hocphi','$ma_hp','$ten_hp','$type_hp','0')";
			$obj->Exec($sql);
		}
	}
}
function innit_chuong_trinh_hoc($masv,$arr_hocphan){
	$obj=new CLS_MYSQL;
	if(is_array($arr_hocphan) && count($arr_hocphan)>0){
		foreach($arr_hocphan as $item){
			$hocky=$item['hocky'];
			$id_monhoc=$item['id_monhoc'];
			$tinchi=$item['tinchi'];
			$status='';
			$sql="INSERT INTO tbl_hoctap(`masv`,`id_monhoc`,`tinchi`,`status`) 
			VAlUES('$masv','$id_monhoc','$tinchi','$status')";
			$obj->Exec($sql);
		}
	}
}
function checkPass($diem,$data){ // xét việc pass một môn nào đó
	
}

function getMaSV($lop){
	$obj=new CLS_MYSQL;
	$sql="SELECT masv FROM tbl_dangky_tuyensinh WHERE malop='$lop'";
	$obj->Query($sql); 
	$arr=array();
	while($r=$obj->Fetch_Assoc()){
		$arr[]=$r['masv'];
	}
	return $arr;
}