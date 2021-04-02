<?php
class CLS_NGANH {
	private $pro=array( 
		'ID'=>'-1',
		'Type'=>'',
		'Notes'=>'',
		'Cdate'=>'',
		'Author'=>'',
		'isActive'=>1);
	private $objmysql=NULL;
	public function __construct(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ('Can not found $proname member');
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_nganh` where 1=1 ".$where.' ORDER BY `id` DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getName($id){
		$sql="SELECT `name` FROM `tbl_nganh` where id='$id'";
		$this->objmysql->Query($sql);
		$r = $this->Fetch_Assoc();
		return $r['name'];
	}
	public function getListKhoaNganh($where='',$limit=''){
		$sql="SELECT * FROM `tbl_khoa_nganh` where 1=1 ".$where.' ORDER BY `id` DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function tonghoso_nganh(){
		$sql = "SELECT count( id_hoso) as total,id_nganh FROM tbl_dangky_tuyensinh 
			WHERE trungtuyen=1 AND nhaphoc=1 AND (malop is null OR malop=='')
			group by id_nganh";
		$obj = new CLS_MYSQL;
		$result = $obj->Query($sql);
		$arr = array();
		while ($r=$obj->Fetch_Assoc()) $arr[$r['id_nganh']]=$r['total']+0;
		return $arr;
	}
} ?>