<?php
class CLS_MEMBER{
	var $pro_mem=array(
					  "ID"=>"-1",
					  "UserName"=>"",
					  "Password"=>"",
					  "FirstName"=>"",
					  "LastName"=>"",
					  "Brithday"=>"",
					  "Gender"=>"",
					  "Address"=>"",
					  "Location"=>"",
					  "Phone"=>"",
					  "Mobile"=>"",
					  "Email"=>"",
					  "Joindate"=>"",
					  "LastLogin"=>"",
					  "Gmember"=>"Admin",
					  "isActive"=>"1"
					  );
 	var $num_rows;
	function CLS_MEMBER()
	{
		$this->Joindate=date("Y-m-d h:i:s");
		$this->LastLogin=date("Y-m-d h:i:s");
	}
	// property set value
	function __set($proname,$value)
	{
		if(!isset($this->pro_mem[$proname]))
		{
			echo "Error";
			return;
		}
		$this->pro_mem[$proname]=$value;
	}
	function __get($proname)
	{
		if(!isset($this->pro_mem[$proname]))
		{
			$this->callmess("$proname ". IS_NOT_MEMBER_IN_CLASS_MYSQL. " " );
			return;
		}
		return $this->pro_mem[$proname];
	}
	function LOGIN($user,$pass){
		$flag=true;
		$user=str_replace(" ","",$user);
		$user=str_replace("'","",$user);
		$pass=md5(sha1($pass));
		if($user=="" || $pass=="")
			$flag=false;
		
		/*if($opt==1) $tbl ='tbl_students';
		else $tbl = 'tbl_teachers';*/
		$sql="SELECT * FROM `tbl_member` WHERE `username`='$user'";
		//echo $sql;die;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0)
		{
			$rows=$objdata->FetchArray();
			if($rows["password"]!=$pass)
			{
				$flag=false;
			}
		}
		else{
			$flag=false;
		}
		if($flag==true)
		{
			$_SESSION["IGFISLOGIN"]=true;
			$_SESSION["IGFUSERLOGIN"]=$user;
			
			$_SESSION["IGFUSERID"]=$rows["mem_id"];
			$_SESSION["IGFUSERNAME"]=$rows["username"];
			$this->updateLogin($user,1);
		}
		return $flag;
	}
	function isLogin(){
		if(isset($_SESSION["IGFISLOGIN"]))
			$this->autoLogout($_SESSION["IGFUSERLOGIN"]);
		if(isset($_SESSION["IGFISLOGIN"]) && $_SESSION["IGFISLOGIN"]==true)
		{
			$this->updateLogin($_SESSION["IGFUSERLOGIN"],1);
			return true;
		}
		else
			return false;
	}
	function LOGOUT(){
		$this->updateLogin($_SESSION["IGFUSERLOGIN"],0);
		$_SESSION["IGFISLOGIN"]=false;
		unset($_SESSION["IGFISLOGIN"]);
		unset($_SESSION["IGFUSERLOGIN"]);
		unset($_SESSION["UUSEROPT"]);
		unset($_SESSION["IGFUSERID"]);
		unset($_SESSION["IGFUSERNAME"]);
	}
	function updateLogin($user,$flag){
		$value="";
		if($flag==1)
			$value=date("Y-m-d h:i:s");
		$sql="UPDATE `tbl_member` SET `lastLogin`='$value' WHERE `username`='$user'";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
	}
	function autoLogout($user){
		if(!isset($user)||$user=="")
			return;
		$sql="SELECT `lastlogin` FROM `tbl_member` WHERE `username`=\"$user\" ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rows=$objdata->FetchArray();
		if($rows["lastlogin"]=="")
			return;
		$s=date("i")-date("i",strtotime($rows["lastlogin"]));
		//echo ($s);
		if($s>=60 || $s<-60){
			$this->LOGOUT();
			echo "<p align=\"center\">Hệ thống tự động đăng xuất sau 60 phút. Bạn vui lòng đăng nhập lại.</p>";
		}
		return;
	}
	function getMemberByID($memid){
		$sql="SELECT * FROM `tbl_member` WHERE `mem_id`=\"$memid\" ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0)
		{
			$rows=$objdata->FetchArray();
			$this->pro_mem["ID"]=$rows["mem_id"];
			$this->pro_mem["UserName"]=$rows["username"];
			$this->pro_mem["Password"]=$rows["password"];
			$this->pro_mem["FirstName"]=$rows["firstname"];
			$this->pro_mem["LastName"]=$rows["lastname"];
			$this->pro_mem["Birthday"]=$rows["birthday"];
			$this->pro_mem["Gender"]=$rows["gender"];
			$this->pro_mem["Address"]=$rows["address"];
			$this->pro_mem["Location"]=$rows["location"];
			$this->pro_mem["Phone"]=$rows["phone"];
			$this->pro_mem["Mobile"]=$rows["mobile"];
			$this->pro_mem["Email"]=$rows["email"];
			$this->pro_mem["Joindate"]=$rows["joindate"];
			$this->pro_mem["LastLogin"]=$rows["lastlogin"];
			$this->pro_mem["Gmember"]=$rows["gmember"];
			$this->pro_mem["isActive"]=$rows["isactive"];
		}
	}
	function getAllList($where=""){
		$sql="SELECT * FROM `tbl_member` ".$where;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$this->num_rows=$objdata->Numrows();
	}
	function listTableMember($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT * FROM `tbl_member` ".$strwhere ." LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->FetchArray())
		{	$i++;
			$memid=$rows["mem_id"];$username=$rows["username"];$name=$rows["lastname"]." ".$rows["firstname"];
			$gender=$rows["gender"];$gmember=$rows["gmember"]; $email=$rows["email"];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"checkid\" id=\"checkid\" onclick=\"docheckonce('checkid');\" value=\"$memid\" />";
			echo "</label></td>";
			echo "<td width=\"100\">$username</td>";
			echo "<td nowrap=\"nowrap\">$name</td>";
			echo "<td width=\"100\" align=\"center\">$gender</td>";
			echo "<td nowrap=\"nowrap\">$email</td>";
			echo "<td nowrap=\"nowrap\" align=\"center\">$gmember</td>";
			echo "<td width=\"50\" align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;memid=$memid\">";
			showIconFun('publish',$rows["isactive"]);
			echo "</a>";
			
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
			
			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;memid=$memid\">";
			showIconFun('edit','');
			echo "</a>";
			
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
			
			echo "<a href=\"index.php?com=".COMS."&amp;task=delete&amp;memid=$memid\">";
			showIconFun('delete','');
			echo "</a>";
			
			echo "</td>";
		  	echo "</tr>";
		}
	}
	function Numrows() { 
		return $this->num_rows;
	}
	function Add_new(){
		$sql="INSERT INTO `tbl_member`(`username`,`password`,`firstname`,`lastname`,`birthday`,`gender`,`address`,`location`,`phone`,`mobile`,`email`,`joindate`,`gmember`,`isactive`) VALUES ";
		$sql.=" (\"".$this->pro_mem["UserName"]."\",\"".md5(sha1($this->pro_mem["Password"]))."\",\"".$this->pro_mem["FirstName"]."\",\"".$this->pro_mem["LastName"]."\",\"".$this->pro_mem["Brithday"]."\",\"".$this->pro_mem["Gender"]."\",\"".$this->pro_mem["Address"]."\",\"".$this->pro_mem["Location"]."\",\"".$this->pro_mem["Phone"]."\",\"".$this->pro_mem["Mobile"]."\",\"".$this->pro_mem["Email"]."\",\"".$this->pro_mem["Joindate"]."\",\"".$this->pro_mem["Gmember"]."\",\"".$this->pro_mem["isActive"]."\") ";
		
		//echo $sql;die;
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}

	function Update(){
		$sql="UPDATE `tbl_member` SET `username`=\"".$this->pro_mem["UserName"]."\",`password`=\"".$this->pro_mem["Password"]."\",`firstname`=\"".$this->pro_mem["FirstName"]."\",`lastname`=\"".$this->pro_mem["LastName"]."\",`birthday`=\"".$this->pro_mem["Brithday"]."\",`gender`=\"".$this->pro_mem["Gender"]."\",`address`=\"".$this->pro_mem["Address"]."\",`location`=\"".$this->pro_mem["Location"]."\",`phone`=\"".$this->pro_mem["Phone"]."\",`mobile`=\"".$this->pro_mem["Mobile"]."\",`email`=\"".$this->pro_mem["Email"]."\",`gmember`=\"".$this->pro_mem["Gmember"]."\",`isactive`=\"".$this->pro_mem["isActive"]."\" ";
		$sql.=" WHERE `mem_id`=\"".$this->pro_mem["ID"]."\"";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function ChangePass(){
		$sql="UPDATE `tbl_member` SET `password`='".md5(sha1($this->pro_mem["Password"]))."'";
		$sql.=" WHERE `mem_id`=\"".$this->pro_mem["ID"]."\"";
		echo $sql;die();
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
	}
	function ActiveOnce($memid){
		$sql="UPDATE `tbl_member` SET `isactive` = IF(isactive=1,0,1) WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Publish($memid){
		$sql="UPDATE `tbl_member` SET `isactive` = \"1\" WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function UnPublish($memid){
		$sql="UPDATE `tbl_member` SET `isactive` = \"0\" WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Delete($memid){
		$sql="DELETE FROM `tbl_member` WHERE `mem_id` in ('$memid')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
}
?>