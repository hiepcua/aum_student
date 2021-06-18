<?php
function paging($total_rows,$max_rows,$cur_page){
    $max_pages=ceil($total_rows/$max_rows);
    $start=$cur_page-5; if($start<1)$start=1;
    $end=$cur_page+5;   if($end>$max_pages)$end=$max_pages;
    $paging='
    <form action="" method="get" name="frmpaging" id="frmpaging">
    <input type="hidden" name="page" id="txtCurnpage" value="1" />
    <ul class="pagination">';

    $paging.='<p align="center" class="paging">';
    $paging.="<strong>Total:</strong> $total_rows <strong>on</strong> $max_pages <strong>page</strong><br>";

    if($cur_page >1)
        $paging.='<li><a href="javascript:gotopage('.($cur_page-1).')"> << </a></li>';
    if($max_pages>1){
        for($i=$start;$i<=$end;$i++)
        {
            if($i!=$cur_page)
                $paging.="<li><a href=\"javascript:gotopage($i)\"> $i </a></li>";
            else
                $paging.="<li class='active'><a href=\"#\" class=\"cur_page\"> $i </a></li>";
        }
    }
    if($cur_page <$max_pages)
        $paging.='<li><a href="javascript:gotopage('.($cur_page+1).')"> » </a></li>';

    $paging.='</ul></p></form>';
    echo $paging;
}
function paging_index($total_rows,$max_rows,$cur_page){
    $max_pages=ceil($total_rows/$max_rows);
    $start=$cur_page-5; if($start<1)$start=1;
    $end=$cur_page+5;   if($end>$max_pages)$end=$max_pages;
    $paging='
    <form action="" method="post" name="frmpaging" id="frmpaging">
    <input type="hidden" name="page" id="txtCurnpage" value="1" />
    <ul class="pagination">
    ';

    $paging.='<p align="center" class="paging">';
    if($cur_page >1)
        $paging.='<li><a href="javascript:gotopage('.($cur_page-1).')"> << </a></li>';
    if($max_pages>1){
        for($i=$start;$i<=$end;$i++)
        {
            if($i!=$cur_page)
                $paging.="<li><a href=\"javascript:gotopage($i)\"> $i </a></li>";
            else
                $paging.="<li class='active'><a href=\"#\" class=\"cur_page\"> $i </a></li>";
        }
    }
    if($cur_page <$max_pages)
        $paging.='<li><a href="javascript:gotopage('.($cur_page+1).')"> » </a></li>';

    $paging.='</ul></p></form>';
    echo $paging;
}
function getCurentPage($max_pages=1){
    if($max_pages==0) $max_pages=1;
    $cur_page=isset($_GET['page'])?antiData($_GET['page'],'int'):1;
    if($cur_page<1)$cur_page=1;
    if($cur_page>$max_pages) $cur_page=$max_pages;
    return $cur_page;
}
function postCurentPage($max_pages=1){
    if($max_pages==0) $max_pages=1;
    $cur_page=isset($_POST['page'])?antiData($_POST['page'],'int'):1;
    if($cur_page<1)$cur_page=1;
    if($cur_page>$max_pages) $cur_page=$max_pages;
    return $cur_page;
}
function isMobile(){
    if(preg_match("/(iPad)/i", $_SERVER["HTTP_USER_AGENT"])) return false;
    elseif(preg_match("/(iPhone|iPod|android|blackberry|Mobile|Lumia)/i", $_SERVER["HTTP_USER_AGENT"])) return true;
    else return false;
}
function un_unicode($str){
    $marTViet=array(
        'à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
        'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
        'ì','í','ị','ỉ','ĩ',
        'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ',
        'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
        'ỳ','ý','ỵ','ỷ','ỹ',
        'đ',
        'A','B','C','D','E','F','J','G','H','I','K','L','M',
        'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
        'À','Á','Ạ','Ả','Ã','Â','Ầ','Ấ','Ậ','Ẩ','Ẫ','Ă','Ằ','Ắ','Ặ','Ẳ','Ẵ',
        'È','É','Ẹ','Ẻ','Ẽ','Ê','Ề','Ế','Ệ','Ể','Ễ',
        'Ì','Í','Ị','Ỉ','Ĩ',
        'Ò','Ó','Ọ','Ỏ','Õ','Ô','Ồ','Ố','Ộ','Ổ','Ỗ','Ơ','Ờ','Ớ','Ợ','Ở','Ỡ',
        'Ù','Ú','Ụ','Ủ','Ũ','Ư','Ừ','Ứ','Ự','Ử','Ữ',
        'Ỳ','Ý','Ỵ','Ỷ','Ỹ',
        'Đ',':',',','.','?','`','~','!','@','#','$','%','^','&','*','(',')',"'",'"',
        '&','/','|','   ','  ',' ','---','--','“','”','+','–','[',']');

    $marKoDau=array(
        'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
        'e','e','e','e','e','e','e','e','e','e','e',
        'i','i','i','i','i',
        'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
        'u','u','u','u','u','u','u','u','u','u','u',
        'y','y','y','y','y',
        'd',
        'a','b','c','d','e','f','j','g','h','i','k','l','m',
        'n','o','p','q','r','s','t','u','v','w','x','y','z',
        'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
        'e','e','e','e','e','e','e','e','e','e','e',
        'i','i','i','i','i',
        'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
        'u','u','u','u','u','u','u','u','u','u','u',
        'y','y','y','y','y',
        'd','','','','','','','','','','','','','','','','','','',
        '','','',' ',' ','-','-','-','','','','','','');

    $str = str_replace($marTViet, $marKoDau, $str);
    return $str;
}
function Substring($str,$start,$len){
    $str=str_replace("  "," ",$str);
    $arr=explode(" ",$str);
    if($start>count($arr))  $start=count($arr);
    $end=$start+$len;
    if($end>count($arr))    $end=count($arr);
    $newstr="";
    for($i=$start;$i<$end;$i++)
    {
        if($arr[$i]!="")
        $newstr.=$arr[$i]." ";
    }
    if($len<count($arr)) $newstr.="...";
    return $newstr;
}
function http_url($url){
    if(defined('SSL') && SSL==true) return str_replace('http://','https://',$url);
    else return str_replace('https://','http://',$url);
}
function encrypt($string,$key=KEY_AUTHEN_COOKIE){
    $iv = md5(uniqid(rand(), true));
    $salt =md5(uniqid(rand(), true));
    $hashKey = hash('sha256', md5($key).'|'.$salt);
    $hashKey = substr($hashKey, 0, 16);
    $iv = substr($iv, 0, 16);
    $encryptedString = openssl_encrypt($string,'AES-128-CBC', $hashKey, 0, $iv);
    $encryptedString = base64_encode($encryptedString);
    $output = ['ciphertext' => $encryptedString, 'iv' => $iv, 'salt' => $salt];
    return base64_encode(json_encode($output));
}
function decrypt($encryptedString,$key=KEY_AUTHEN_COOKIE){
    $json = json_decode(base64_decode($encryptedString), true);
    try {
        $salt = $json["salt"];
        $iv = $json["iv"];
        $cipherText = base64_decode($json['ciphertext']);
    } catch (Exception $e) {
        return null;
    }
    $hashKey = hash('sha256', md5($key).'|'.$salt);
    $hashKey = substr($hashKey, 0, 16);
    $decrypted= openssl_decrypt($cipherText ,'AES-128-CBC', $hashKey, 0, $iv);
    return $decrypted;
}
function optimizeHTML($Html) {
  $encoding = mb_detect_encoding($Html);
  $doc = new DOMDocument('', $encoding);
  @$doc->loadHTML('<html><head>'
    . '<meta http-equiv="content-type" content="text/html; charset='
    . $encoding . '"></head><body>'. trim($Html) . '</body></html>');
  $nodes = $doc->getElementsByTagName('body')->item(0)->childNodes;
  $html = '';
  $len = $nodes->length;
  for ($i = 0; $i < $len; $i++) {
    $html .= $doc->saveHTML($nodes->item($i));
  }
  return $html;
}
function antiData($data,$type='plaintext',$tag=false){
    if(empty($data)) return '';
    $data=preg_replace('/\s\s+/', ' ', $data);
    switch($type){
        case 'plaintext': 
            $data=addslashes(trim(strip_tags($data)));
            break;
        case 'html':
            // remove unopentag and unclosetags
            $data=optimizeHTML($data);
            // remove blank tags
            $pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
            $data= preg_replace($pattern,'',$data);
            $data= addslashes(trim($data));
            break;
        case 'int':
            $data=(int)trim($data);
            break;
        case 'float':
            $data=(float)trim($data);
            break;
		case 'time':
            $data=strtotime(trim($data));
            break;
        default: break;
    }
    if($tag) $data=htmlentities($data);
    return $data;
}
function getThumb($urlThumb, $class='', $alt=''){
    if($urlThumb !=''){
        return "<img src=".$urlThumb." class='".$class."' alt='".$alt."'>";
    }
    else{
        return "<img src=".ROOTHOST.THUMB_DEFAULT." class='".$class."'>";
    }
}

//-------------------------------------------------------
function Compression($cssFiles){
	$buffer = "";
	foreach ($cssFiles as $cssFile) {
	$buffer .= file_get_contents($cssFile);
	}
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	$buffer = str_replace(': ', ':', $buffer);
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	echo($buffer);
}
function getDateMonth($str_time) {
	if($str_time<=24) $str_time.=' giờ';
	else {
		$str_time=floor($str_time/24);
		if($str_time%30==0) $str_time=($str_time/30).' tháng';
		elseif($str_time>30) {
			$month = floor($str_time/30);
			$str_time=$month.' tháng '.floor($str_time-($month*30)).' ngày';
		} else $str_time.=' ngày';
	}
	return $str_time;
}
function getStringTime($time) {
	$dau='';
	if($time<0) { $dau='- '; $time=(-1)*$time; }
	if($time<=86400) // <= 24 giờ
		$time=floor($time/3600).' giờ ';
	elseif($time<2592000) { // < 30 ngày
		$day=floor($time/86400);
		$hour=$time-($day*86400);
		$hour=floor($hour/3600);
		$time=$day.' ngày '.$hour.' giờ';
	}else{ // >= 30 ngày
		$month=floor($time/2592000);
		$day=$time-($month*2592000);
		$day=floor($day/86400);
		$time=$month.' tháng '.$day.' ngày';
	}
	return $dau.$time;
}
function readWord($input_file){	
	$kv_strip_texts = ''; 
    $kv_texts = ''; 	
	if(!$input_file || !file_exists($input_file)) return false;	
	$zip = zip_open($input_file);
	if (!$zip || is_numeric($zip)) return false;
	while ($zip_entry = zip_read($zip)) {	
		if (zip_entry_open($zip, $zip_entry) == FALSE) continue;	
		if (zip_entry_name($zip_entry) != "word/document.xml") continue;
		$kv_texts .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
		zip_entry_close($zip_entry);
	}
	zip_close($zip);	
	$kv_texts = str_replace('</w:r></w:p></w:tc><w:tc>', "|", $kv_texts);// cell
	$kv_texts = str_replace('</w:r></w:p>', "\r\n", $kv_texts);// row
	$kv_strip_texts = nl2br($kv_texts);
	return $kv_strip_texts;
}
function getTotalAmount($TK){
	$sql="SELECT sum(money) as total FROM tbl_account_histories WHERE tk_code='$TK'";
	$obj=new CLS_MYSQL;
	$obj->Query($sql);
	$r=$obj->Fetch_Assoc();
	return $r['total']+0;
}
function longTime($ftime){
	$str='';
	$now=time();
	$len=$now-$ftime;
	$day=floor($len/86400);
	$hour=floor(($len%86400)/3600);
	$minu=floor(($len%3600)/60);
	if($day>0){
		$str.="$day ngày";
	}elseif($hour>0){
		$str.="$hour giờ";
	}else{
		$str.="$minu phút";
	}
	return $str;
}
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyz012345678901234567890123456789ABCDEFGHIJKLMNOPQRSTUWXYZ012345678901234567890123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function randomNumber() {
    $alphabet = "012345678901234567890123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
//-----------------------CSDL------------------------------
function SysCount($table,$where){
    $sql="SELECT COUNT(*) as num FROM $table WHERE 1=1 $where";
    $obj=new CLS_MYSQL;
    $obj->Query($sql);
    $r=$obj->Fetch_Assoc();
    return $r['num']+0;
}
function SysGetList($table,$fields=array(),$where='',$flag=true){
    if(count($fields)==0){
        $sql="SELECT * FROM $table WHERE 1=1 $where";
    }else{
        $sql="SELECT ";
        foreach($fields as $field){
            $sql.="`$field`,";
        }
        $sql=substr($sql,0,-1)." FROM $table WHERE 1=1 $where ";
    }
    // echo $sql;
    $obj=new CLS_MYSQL;
    $obj->Query($sql);
    if($flag){
        $arr=array();
        while($r=$obj->Fetch_Assoc()){
            $arr[]=$r;
        }
        return $arr;
    }
    return $obj;
}
function SysAdd($table,$arr){
    if(!is_array($arr) || count($arr)==0) return false;
    $fields=$values='';
    foreach($arr as $key=>$val){
        $fields.="`$key`,";
        $values.="'$val',";
    }
    $sql="INSERT INTO ".$table."(".substr($fields,0,-1).") VALUES(".substr($values,0,-1).")";
    $obj=new CLS_MYSQL;
    $obj->Exec($sql);
    $id=$obj->LastInsertID();
    return $id;
}
function SysAddNotExist($table,$arr){
    if(!is_array($arr) || count($arr)==0) return false;
    $fields=$values='';
    foreach($arr as $key=>$val){
        $fields.="`$key`,";
        $values.="'$val',";
    }
    $sql="INSERT IGNORE INTO ".$table."(".substr($fields,0,-1).") VALUES(".substr($values,0,-1).")";
    $obj=new CLS_MYSQL;
    $obj->Exec($sql); //echo $sql."<br>";
    $id=$obj->LastInsertID();
    return $id;
}
function SysEdit($table,$arr,$where){
    $fields='';
    foreach($arr as $key=>$val){
        $fields.="`$key`='$val',";
    }
    $sql="UPDATE ".$table." SET ".substr($fields,0,-1)." WHERE $where";
    // echo $sql;
    $obj=new CLS_MYSQL;
    return $obj->Exec($sql);
}
function SysActive($table,$where,$status=null){
    if($status!=null) $sql="UPDATE ".$table." SET `isactive`=$status WHERE $where";
    else $sql="UPDATE ".$table." SET `isactive`=if(`isactive`=1,0,1) WHERE $where";
    $obj=new CLS_MYSQL;
    $obj->Exec($sql);
}
function SysTrash($table,$where,$status=null){
    if($status!=null) $sql="UPDATE ".$table." SET `is_trash`=$status WHERE $where";
    else $sql="UPDATE ".$table." SET `is_trash`=if(`is_trash`=1,0,1) WHERE $where";
    $obj=new CLS_MYSQL;
    $obj->Exec($sql);
}
function SysDel($table,$where){
    $sql="DELETE FROM ".$table." WHERE $where";
    // echo $sql;
    $obj=new CLS_MYSQL;
    $obj->Exec($sql);
}
function ReportRunning(){
	$data['data']=encrypt(json_encode(array('time'=>time(),'host'=>$_SERVER['HTTP_HOST'],'ip'=>$_SERVER['SERVER_ADDR'],
	'key'=>PIT_API_KEY)),PIT_API_KEY);
	Curl_Post('http://logs.aumsys.net/api/host_runing.php',json_encode($data));
}
ReportRunning();
function Curl_Post($url,$jsonBody){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonBody);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($jsonBody))                                                                       
    );                                                                                                                   
    $resp = curl_exec($curl); //var_dump($resp);
    curl_close($curl);
    return json_decode($resp,true);
}
function Curl_Get($url){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);//var_dump($resp);
    curl_close($curl);
    return json_decode($resp,true);
}
// Chia contact tự động
function chiaContactAuto($total=array(),$list_user=array(),$flag_user=''){
	// $total: mảng chứa contact,; $list_user: chứa ds user; $flag_user: chứa id user hiện đang chia
	// trả về mảng: id_user=>list_contact
	$arr=array();
	$count_list_user=count($list_user);
	$count_total=count($total);
	if($count_total>0 && $count_list_user>0){
		$i=0;
		if(in_array($flag_user, $list_user)){
			// lấy vị trí key của user đó trong ds list_user
			$cur_key=array_search($flag_user, $list_user);
			$i=$cur_key+1;
		}
		foreach ($total as $key1 => $value1) {
				if($i<$count_list_user){
					$arr[$list_user[$i]][]=$value1;
					$i++;
				}
				else if($i==$count_list_user){
					$i=0;
					$arr[$list_user[$i]][]=$value1;
					$i++;
				}
				$arr['flag_user']=$list_user[$i-1];
		}
	}
	return $arr;
}
function action_logs($code,$user,$arr_logs){
    $arr_logs['by']=$user;
    $arr=array('code'=>$code,'key'=>PIT_API_KEY,'logs'=>$arr_logs);
    $data['data']=encrypt(json_encode($arr),PIT_API_KEY);
    $result=Curl_Post('http://logs.aumsys.net/api/push_logs.php',json_encode($data));
}
?>