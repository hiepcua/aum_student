<?php
class CLS_MAILBOX{
	private $pro=array(
		'Id'=>0,
		'Type'=>1,
		'From'=>'',
		'To'=>'',
		'CC'=>'',
		'BCC'=>'',
		'Subject'=>'',
		'Content'=>'',
		'Encoding'=>'',
		'SubjectEncoding'=>'',
		'CreateDate'=>'',
		'Size'=>0,
		'Attachments'=>'',
		'Priority'=>'',
		'Viewed'=>0,
	);
	private $objmysql=NULL;
	public function CLS_MAILBOX(){
		$this->objmysql=new CLS_MYSQL;
		$this->CreateDate = date("d/m/Y H:i:s");
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
		$sql="SELECT * FROM `tbl_boxes` ".$where.' ORDER BY `create_date` DESC '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function CheckAdd() {
		// Check message before add
		$sql="SELECT * FROM tbl_boxes WHERE `from`='".$this->From."' AND `subject`='".$this->Subject;
		$sql.="' AND `content`='".$this->Content."' AND `create_date`='".$this->CreateDate."'";
		return $this->objmysql->Query($sql);
	}
	public function Add_new(){
		$sql=" INSERT INTO `tbl_boxes`(`type`,`from`,`to`,`cc`,`bcc`,`subject`,`content`,`encoding`,";
		$sql.="`subject_encoding`,`create_date`,`size`,`attachment`,`priority`,`viewed`) VALUES";
		$sql.="('".$this->Type."',N'".$this->From."',N'".$this->To."',N'".$this->CC."',N'".$this->BCC."',N'";
		$sql.=$this->Subject."',N'".$this->Content."','".$this->Encoding."','".$this->SubjectEncoding."','";
		$sql.=$this->CreateDate."','".$this->Size."',N'".$this->Attachments."','".$this->Priority."','".$this->Viewed."')";
		return $this->objmysql->Exec($sql);
	}
	public function Delete($id){
		$sql="DELETE FROM `tbl_boxes` WHERE `id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
	public function setView($ids,$status=''){
		$sql="UPDATE `tbl_boxes` SET `viewed`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_boxes` SET `viewed`=if(`viewed`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
}