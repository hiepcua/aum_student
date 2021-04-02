<?php
class CLS_MESSAGE {
	private $pro=array( 
		'ID'=>'-1',
		'UserSend'=>'',
		'UserGet'=>'',
		'TitleSend'=>'',
		'ContentSend'=>'',
		'Senddate'=>'',
		'Type'=>'',
		'isRead'=>0,
		'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_MESSAGE(){
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
		$sql="SELECT * FROM `tbl_message` where 1=1 ".$where.' ORDER BY `id` '.$limit;
		return $this->objmysql->Query($sql);
	}


	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getFullName($username){
		$objmysql=new CLS_MYSQL;
		$sql="SELECT `firstname`,`lastname` FROM `tbl_user` WHERE `username`='$username' AND isactive=1 ";
		$objmysql->Query($sql);
		$row=$objmysql->Fetch_Assoc();
		return $row['firstname']." ".$row['lastname'];
	}

	public function listTable($strwhere="",$page=1){
			$star=0; if($page>1) $star=($page-1)*MAX_ROWS;
			$leng=MAX_ROWS;
			$sql="SELECT * FROM `tbl_message`WHERE 1=1 ".$strwhere." ORDER BY `id` DESC LIMIT $star,$leng";
			// echo $sql;
			$objdata=new CLS_MYSQL();
			$objdata->Query($sql);
			$i=0;
			while($rows=$objdata->Fetch_Assoc())
			{	$i++;
				$id=$rows['id'];
				$user=$this->getFullName($rows['user_get']);
				$title=$rows['title_send'];
				$content=$rows['content_send'];
				// $order=$rows['order'];
				echo "<tr name='trow'>";
				echo "<td width='30' align='center'>$i</td>";
				echo "<td width='30' align='center'><label>";
				echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
				echo "</label></td>";
				echo "<td>$user &nbsp;</td>";
				echo "<td>$title &nbsp;</td>";
				echo "<td>$content &nbsp;</td>";
				// echo "<td align=\"center\"><input type='text' value='".$order."' name='txt_order'/></td>";
				echo "<td width='50' align='center'>";
					echo "<a href='index.php?com=".COMS."&amp;task=isread&amp;id=$id'>";
					showIconFun('publish',$rows["isread"]);
					echo "</a>";
				echo "</td>";

				echo "<td width='50' align='center'>";
					echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
					showIconFun('publish',$rows["isactive"]);
					echo "</a>";
				echo "</td>";
				echo "<td width='50' align='center'>";
					echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
					showIconFun('edit','');
					echo "</a>";
				echo "</td>";
				echo "<td width='50' align='center'>";
					echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
					showIconFun('delete','');
					echo "</a>";
				echo "</td>";
			  	echo "</tr>";
			}
		}

	public function getListUser($username=''){
		$objmysql=new CLS_MYSQL;
		$sql="SELECT `username`,`firstname`,`lastname` FROM `tbl_user`  WHERE `isactive`=1 ORDER BY `firstname`";
		$objmysql->Query($sql);
		while ($row=$objmysql->Fetch_Assoc()) {
			if($row['username']==$username) $str=" selected='selected'"; else $str='';
			$fullname=$row['firstname'];
			echo "<option value='".$row['username']."' $str>".$fullname." </option>";
		}
	}

	public function Add_new(){
		$sql="INSERT INTO `tbl_message` (`user_get`,`title_send`,`content_send`,`send_date`,`isactive`) VALUES ";
		$sql.="('".$this->UserGet."','".$this->TitleSend."','".$this->ContentSend."','".$this->Senddate."','".$this->isActive."')";		
		// echo $sql;
		return $this->objmysql->Exec($sql);
	}

	
	public function sendNewMessage(){
		$sql="INSERT INTO `tbl_message` (`user_get`,`title_send`,`content_send`,`send_date`,`isactive`) VALUES ";
		$sql.="('".$this->UserGet."','".$this->TitleSend."','".$this->ContentSend."','".$this->Senddate."','".$this->isActive."')";		
		// echo $sql;
		return $this->objmysql->Exec($sql);
	}

	// public function feedbackMessage($id){
	// 	$sql="UPDATE `tbl_message` SET  
	// 	`title_back`='".$this->TitleBack."',
	// 	`content_back`='".$this->ContentBack."',	
	// 	`backdate`='".$this->Backdate."',	
	// 	WHERE `id`='".$this->ID."'";
	// 	return $this->objmysql->Exec($sql);
	// }


	public function Update(){
		$sql="UPDATE `tbl_message` SET  
			`user_get`='".$this->UserGet."',
			`title_send`='".$this->TitleSend."',	
			`content_send`='".$this->ContentSend."',	
			`isactive`='".$this->isActive."' 
			WHERE `id`='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}

	public function Delete($ids){
		$sql="DELETE FROM `tbl_message` WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}

	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_message` SET `isactive`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_message` SET `isactive`=if(`isactive`=1,0,1) WHERE `id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}

	public function setRead($ids,$status=''){
		$sql="UPDATE `tbl_message` SET `isread`='$status' WHERE `id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_message` SET `isread`=if(`isread`=1,0,1) WHERE `id` in ('$ids')";
		// echo $sql;
		return $this->objmysql->Exec($sql);
	}

	public function Order($arr_id,$arr_quan){
		$n=count($arr_id); 
		for($i=0;$i<$n;$i++){
			$sql="UPDATE `tbl_message` SET `order`='".$arr_quan[$i]."' WHERE `id` = '".$arr_id[$i]."' ";
			$this->objmysql->Exec($sql);
		}
	}
	public function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
}
?>