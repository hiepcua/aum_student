<?php
class CLS_HE {
	private $pro=array( 
		'ID'=>'-1',
		'Type'=>'',
		'Name'=>'',
		'startDay'=>'',
		'Quan'=>0);
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
		$sql="SELECT * FROM `tbl_he` where 1=1 ".$where.' ORDER BY `id` DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getName($id){
		$sql="SELECT `name` FROM `tbl_he` where id='$id'";
		$this->objmysql->Query($sql);
		$r = $this->Fetch_Assoc();
		return $r['name'];
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
} ?>