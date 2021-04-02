<?php
class CLS_CONFIG{
	private $pro=array(
		'ID'=>'-1',			
		'Title'=>'',
		'CompanyName'=>'',	
		'Thilai'=>100000,
		'ThiCT'=>100000,		
		'Hoclai'=>200000,
		'HocCT'=>300000,
		'HocCD'=>300000,
		'BVluanvan'=>4000000,
		'ChuanTH'=>1000000,
		'ChuanTA'=>800000,
		'ThilaiTN'=>500000
		);
	private $objmysql=null;
	public function CLS_CONFIG(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_USERS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_USERS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList(){
		$sql="SELECT * FROM `tbl_configsite` WHERE `config_id`=1";
		return $this->objmysql->Query($sql); 
	}
	public function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Update(){
		$sql = "UPDATE tbl_configsite SET ";
		$sql .="title='".$this->Title."',";
		$sql .="company_name='".$this->CompanyName."',";
		$sql .="thilai='".$this->Thilai."',";
		$sql .="thicaithien='".$this->ThiCT."',";
		$sql .="hoclai='".$this->Hoclai."',";
		$sql .="hoccaithien='".$this->HocCT."',";
		$sql .="hocchuyendoi='".$this->HocCD."',";
		$sql .="bvluanvan='".$this->BVluanvan."',";
		$sql .="chuantinhoc='".$this->ChuanTH."',";
		$sql .="chuantienganh='".$this->ChuanTA."',";
		$sql .="thilaitotnghiep='".$this->ThilaiTN."'";
		$sql .=" WHERE config_id=1";
		return $this->objmysql->Query($sql);
	}
} ?>