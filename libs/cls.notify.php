<?php
class CLS_NOTIFY {
	private $pro=array( 
		'ID'=>'-1',
		'Type'=>'',
		'Notes'=>'',
		'Cdate'=>'',
		'Author'=>'',
		'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_NOTIFY(){
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
		$sql="SELECT * FROM `tbl_notify` where 1=1 ".$where.' ORDER BY `id` DESC '.$limit; 
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_notify` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_notify` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_notify` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setRead($ids,$status=''){
		$sql="UPDATE `tbl_notify` SET `isread`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_notify` SET `isread`=if(`isread`=1,0,1) WHERE `id` in ('$ids')";
		// echo $sql;
		return $this->objmysql->Exec($sql);
	}
}
?>