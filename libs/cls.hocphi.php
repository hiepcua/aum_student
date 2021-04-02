<?php
class CLS_HOCPHI {
	private $pro=array( 
		'ID'=>'-1',
		'Name'=>'',
		'ID_Nganh'=>'',
		'GVCN'=>'',
		'Permission'=>'');
	private $objmysql=NULL;
	public function CLS_HOCPHI(){
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
		$sql="SELECT * FROM `tbl_hocphi` where 1=1 ".$where.' ORDER BY `id` DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getNameByIds($ids){
		$sql="SELECT * FROM tbl_monhoc";
		$this->objmysql->Query($sql);
		$arrMon=array();
		while($r=$this->objmysql->Fetch_Assoc()){
			$arrMon[$r['id']]=$r;
		} 
		$ids = str_replace(",","','",$ids);
		$sql="SELECT * FROM `tbl_hocphi` where id IN ('$ids')";
		$this->objmysql->Query($sql);
		$str='';$i=1;
		while ($hp = $this->objmysql->Fetch_Assoc()) {
			$hocphi=$hp['hocphi']; 
			$type_hocphi=$hp['type_hp'];
			$ten_hp = stripslashes($hp['ten_hp']);
			if($type_hocphi=="hoc_phan" && isset($arrMon[$hp['ma_hp']]['name'])) $ten_hp = $arrMon[$hp['ma_hp']]['name'];
			$str.="<div><span>$i. $ten_hp</span><span class='pull-right'>".number_format($hocphi)."</span></div>";
			$i++;
		}
		return $str;
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
} ?>