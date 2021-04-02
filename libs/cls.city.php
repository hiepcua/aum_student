<?php
class CLS_CITY{
	private $pro=array( 'ID'=>'-1',
						'Name'=>'',
						'Code'=>'',
						'Order'=>'',
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
		$sql="SELECT * FROM `tbl_city` ".$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_city`  WHERE isactive=1 AND `id` = '$id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function Add_new(){
		$sql=" INSERT INTO `tbl_city`(`name`,`code`,`isactive`) VALUES";
		$sql.="('".$this->Name."','".$this->Code."','".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	public function Update(){
		$sql = "UPDATE tbl_city SET `name`='".$this->Name."',`code`='".$this->Code."',
		`isactive`='".$this->pro["isActive"]."' WHERE id='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	public function Delete($id){
		$sql="DELETE FROM `tbl_city` WHERE `id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_city` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_city` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function Order($arr_id,$arr_quan){
		$n=count($arr_id);
		for($i=0;$i<$n;$i++){
			$sql="UPDATE `tbl_city` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
			$this->objmysql->Exec($sql);
		}
	}
}
?>