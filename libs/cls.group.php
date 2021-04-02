<?php
class CLS_GROUP{
	public function CLS_GROUP(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function ListOption($id=''){
		$file = "jsons/categories.json";
		$json = json_decode(file_get_contents($file),true); 
		foreach($json as $key=>$val) {
			$cls=''; if($id==$key) $cls="selected";
			if($val['isactive']==1)
				echo "<option value='".$key."' ".$cls.">".$val['name']."</option>";
		}
	}
}

?>