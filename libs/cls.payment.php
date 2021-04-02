<?php
class CLS_PAYMENT{
	private $pro=array(
		'ID'=>'-1',
		'OrderID'=>'',
		'Type'=>1,
		'PayDate'=>'',
		'Money'=>'',
		'Cdate'=>'',
		'Author'=>'',
		'IsActive'=>''
		);
	private $objmysql=NULL;
	
	public function CLS_PAYMENT(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PAYMENT Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PAYMENT Class' );
			return '';
		}
		return $this->pro[$proname];
	}

	public function getList($where='',$order=' ',$limit=''){
		$sql="SELECT * FROM `tbl_payment` WHERE 1=1".$where.$order.$limit;
		// echo $sql;
		return $this->objmysql->Query($sql);
	}

	public function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getPaymentById($id=0){
		$sql="SELECT * FROM `tbl_payment` WHERE `id`=$id" ;
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		$tmp=array();
		$tmp['group_code']=$row['group_code'];
		$tmp['unit']=$row['unit'];
		$tmp['price']=$row['price'];
		return $tmp;
	}
	public function getPaymentByOrderId($orderid=0){
		$sql="SELECT * FROM `tbl_payment` WHERE `order_id`=$orderid ORDER BY type ASC" ;
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$tmp = array();
		while($row=$objdata->Fetch_Assoc())
		$tmp[]=$row;
		return $tmp;
	}
} ?>