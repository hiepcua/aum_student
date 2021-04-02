<?php
class CLS_WALLET{
	private $pro=array(	
		'ID'=>-1,
		'WalletID'=>0,
		'CusID'=>0,
		'Total'=>0,
		'Status'=>1,
		'Money'=>'',
		'Author'=>'',
		'Cdate'=>'',
		'Mdate'=>'',
		'Note'=>''
		);
	private $objmysql=null;
	public function CLS_WALLET(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in set method of class';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in get method of class';
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where=' ',$order=' ORDER BY `id` DESC ',$limit=' '){
		$sql="SELECT * FROM `tbl_wallet` WHERE 1=1 ".$where.$order.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getInfoWallet($where=''){
		$sql="SELECT w.*,c.name,c.phone,c.address FROM `tbl_wallet` AS w 
		INNER JOIN tbl_customer AS c ON w.cus_id=c.code
		WHERE 1=1 ".$where; //echo $sql;
		return $this->objmysql->Query($sql);
	}
	public function getInfoByCusId($cusid=0){
		$sql = "SELECT * FROM tbl_wallet WHERE cus_id='$cusid'";
		$this->objmysql->Query($sql);
		return $this->objmysql->Fetch_Assoc();
	}
	public function getDetailByCusId($cusid=0){
		$sql = "SELECT * FROM tbl_wallet WHERE cus_id='$cusid'";
		$this->objmysql->Query($sql);
		return $this->objmysql->Fetch_Assoc();
	}
	public function TotalWallet($cusid=0){
		$sql = "SELECT total FROM tbl_wallet WHERE cus_id='$cusid'";
		$this->objmysql->Query($sql);
		$r = $this->objmysql->Fetch_Assoc();
		return 0+$r['total'];
	}
	public function WalletDetail($cusid=0,$strwhere=''){
		$sql = "SELECT * FROM tbl_wallet_detail WHERE cus_id='$cusid' $strwhere
		ORDER BY cdate DESC";
		return $this->objmysql->Query($sql);
	}
	// tổng tiền cọc đơn hàng
	public function TotalDeposit($cusid=""){
		$sql = "select sum(money) as total from tbl_wallet_detail where type=2 "; // dat coc
		if($cusid!=="") $sql.=" AND cus_id='$cusid'";
		$this->objmysql->Query($sql);
		$r = $this->objmysql->Fetch_Assoc();
		return 0+$r['total'];
	}
	public function TotalPaid($cusid=0,$oid=0){
		$sql = "select sum(money) as total from tbl_wallet_detail 
		where cus_id='$cusid' and type=1 and oid=$oid";
		$this->objmysql->Query($sql);
		$r = $this->objmysql->Fetch_Assoc();
		return 0+$r['total'];
	}
	// đã thành toán nhưng phải trừ tiền đã hoàn
	public function TotalPayment($cusid=""){
		$sql = "select sum(money) as total from tbl_wallet_detail WHERE (type=1 OR type=-2)";
		if($cusid!=="") $sql.=" AND cus_id='$cusid'";
		$this->objmysql->Query($sql);
		$r = $this->objmysql->Fetch_Assoc();
		return 0+$r['total'];
	}
	public function TotalAllDebt($strwhere=''){
		$sql = "select cus_id,sum(money) as total from tbl_wallet_detail 
			 $strwhere group by cus_id having total<0";
		$this->objmysql->Query($sql);
		$arr=array();
		while($r = $this->objmysql->Fetch_Assoc()) {
			$cusid=$r['cus_id']; $arr[$cusid]=$r['total'];
		}
		return $arr;
	}
	public function WalletInfo($cusid=0){
		$arr=array('thu'=>0,'chi'=>0,'rut'=>0);
		$obj = new CLS_MYSQL;
		
		$sql = "select sum(money) as total from tbl_wallet_detail where type=0 AND cus_id='$cusid'"; 
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		$arr['thu']= 0+$r['total'];
		
		$sql = "select sum(money) as total from tbl_wallet_detail WHERE (type!=0 AND type!=-3) AND cus_id='$cusid'"; 
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		$arr['chi']= 0+$r['total'];
		
		$sql = "select sum(money) as total from tbl_wallet_detail WHERE type=-3 AND cus_id='$cusid'"; 
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		$arr['rut']= 0+$r['total'];
		return $arr;
	}
	//0=nạp tiền vào ví
	public function TongThu($cusid='',$strwhere=''){
		$sql = "select sum(money) as total from tbl_wallet_detail 
		where type=0 "; 
		if($cusid!='') $sql.=" AND cus_id='$cusid'";
		$sql.= " $strwhere";
		$obj = new CLS_MYSQL;
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		return 0+$r['total'];
	}
	//-2=hoàn tiền, -3=rút ví, 1=thanh toán đơn hàng, 2=đặt cọc, 
	public function TongChi($cusid='',$strwhere=''){
		$sql = "select sum(money) as total from tbl_wallet_detail 
		where (type!=0 AND type!=-3) "; 
		if($cusid!=='') $sql.=" AND cus_id='$cusid'";
		$sql.= " $strwhere";		
		$obj = new CLS_MYSQL;
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		return 0+$r['total'];
	}
	//-3=rút ví
	public function TongRut($cusid='',$strwhere=''){
		$sql = "select sum(money) as total from tbl_wallet_detail 
		where type=-3 "; 
		if($cusid!=='') $sql.=" AND cus_id='$cusid'";
		$sql.= " $strwhere";		
		$obj = new CLS_MYSQL;
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		return 0+$r['total'];
	}
	public function TongDonTruHuy($strwhere=''){
		$sql = "SElECT count(id) AS total FROM tbl_order 
		WHERE isactive<>-1 $strwhere";
		$obj = new CLS_MYSQL;
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		return 0+$r['total'];
	}
	public function TongTienHang($strwhere=''){
		$sql = "SElECT sum(total_money) as total,sum(fee_weight*weight) AS weight 
		FROM tbl_order WHERE isactive<>-1 $strwhere";
		$obj = new CLS_MYSQL;
		$obj->Query($sql);
		$r = $obj->Fetch_Assoc();
		return $r;
	}
	public function ThongtinCongno($strwhere=''){
		$sql="SELECT DISTINCT(cus_id) FROM tbl_wallet WHERE 1=1 ".$strwhere;
		$obj=new CLS_MYSQL;
		$obj->Query($sql);
		$arr=array('CN'=>0,'SD'=>0);
		while($r=$obj->Fetch_Assoc()) {
			$cus_id = $r['cus_id'];
			$tongthu = $this->TongThu($cus_id); 
			$tongchi = $this->TongChi($cus_id);
			$tongrut = $this->TongRut($cus_id);
			$tongchi*=-1;
			$tongrut*=-1;
			$w_total = $tongthu-$tongchi-$tongrut;
			if($w_total>=0) 
				$arr['SD']+=$w_total;
			else  $arr['CN']+=$w_total;
		}
		return $arr;
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
} ?>