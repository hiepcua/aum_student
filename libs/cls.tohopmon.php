<?php
class CLS_TOHOPMON {
	private $pro=array( 
		'ID'=>'-1',
		'ID_nganh'=>'',
		'ID_Tohop'=>'',
		'Tohopmon'=>'',
		'Tongdiem'=>'',
		'Cdate'=>'',
		'Mdate'=>'',
		'Author'=>'',
		'isActive'=>''
		);
	private $objmysql=NULL;
	public function CLS_TOHOPMON(){
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
		$sql="SELECT * FROM `tbl_config_monthi` where 1=1 ".$where.' ORDER BY `id` DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
} ?>