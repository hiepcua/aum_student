<?php
class CLS_TUYENSINH {
	private $pro=array( 
		'ID'=>'-1',
		'Cdate'=>'',
		'ID_Khoa'=>'',
		'ID_He'=>'',
		'ID_Nganh'=>'',
		'ID_Hoso'=>'',
		'SBD'=>'',
		'Mon1'=>'','Mon2'=>'','Mon3'=>'',
		'Trungtuyen'=>0,'Nhaphoc'=>0,
		'Author'=>''
		);
	private $objmysql=NULL;
	public function CLS_TUYENSINH(){
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
		$sql="SELECT * FROM `tbl_dangky_tuyensinh` where 1=1 ".$where.' ORDER BY `id` DESC'.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getMaSV($id_hoso){
		$sql="SELECT masv FROM tbl_dangky_tuyensinh WHERE id_hoso='$id_hoso'";
		$this->objmysql->Query($sql);
		$result=$this->Fetch_Assoc();
		return $result['masv'];
	}
	public function Trungtuyen($ids,$status=''){
        $sql="UPDATE `tbl_dangky_tuyensinh` SET `trungtuyen`='$status' WHERE `id_hoso` in ('$ids')";
        if($status=='')
            $sql="UPDATE `tbl_dangky_tuyensinh` SET `trungtuyen`=if(`trungtuyen`=1,0,1) WHERE `id_hoso` in ('$ids')";
        return $this->objmysql->Exec($sql);
    }
	public function NumberNganhByCity($id_khoa='',$id_he='',$city=''){
		$sql="select a.id_nganh,c.name,count(a.id_nganh) as num from tbl_dangky_tuyensinh as a
				inner join tbl_hocsinh as b on a.id_hoso=b.ma
				inner join tbl_nganh as c on a.id_nganh=c.id
				where 1=1 ";
		if($id_khoa!=="") $sql.=" AND a.id_khoa='$id_khoa'";	
		if($id_he!=="") $sql.=" AND a.id_he='$id_he'";	
		if($city!=="") $sql.=" AND b.city='$city'";	
		$sql.=" group by id_he,id_khoa,id_nganh";
		$this->objmysql->Query($sql);
		$str='';
		while($result=$this->Fetch_Assoc()){
			$id_nganh = $result['id_nganh'];
			$str.="<span style='width:160px;float:left'>".$result['name'].":</span>";
			$str.="<span style='width:100px;float:left;font-weight:bold;'>".number_format($result['num']+0)."</span>";
			$str.="<a target='_blank' href='".ROOTHOST."report/hoso/tonghop?khoa=$id_khoa&bac=$id_he&nganh=$id_nganh&city=$city'><i class='fa fa-info-circle'></i></a><br>";
		}
		return $str;
	}
	public function NumberNganhByPartner($partner_id='',$id_khoa='',$id_he=''){
		$sql="select a.id_nganh,c.name,count(a.id_nganh) as num from tbl_dangky_tuyensinh as a
				inner join tbl_hocsinh as b on a.id_hoso=b.ma
				inner join tbl_nganh as c on a.id_nganh=c.id
				where partner_id='$partner_id' ";
		if($id_khoa!=="") $sql.=" AND a.id_khoa='$id_khoa'";	
		if($id_he!=="") $sql.=" AND a.id_he='$id_he'";	
		$sql.=" group by id_he,id_khoa,id_nganh";
		$this->objmysql->Query($sql);
		$str='';
		while($result=$this->Fetch_Assoc()){
			$id_nganh = $result['id_nganh'];
			$str.="<span style='width:160px;float:left'>".$result['name'].":</span>";
			$str.="<span style='width:100px;float:left;font-weight:bold;'>".number_format($result['num']+0)."</span>";
			$str.="<a target='_blank' href='".ROOTHOST."report/hoso/tonghop?khoa=$id_khoa&bac=$id_he&nganh=$id_nganh&partner=$partner_id'><i class='fa fa-info-circle'></i></a><br>";
		}
		return $str;
	}
} ?>