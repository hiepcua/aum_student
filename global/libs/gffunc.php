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
function showIconFun($fun,$value){
    $filename="noimage.gif";
    $title="no image"; $icon="";
    switch($fun){
        case "menuitem":
            $title="Menu Item";
			$icon="fa-list-alt";
            $filename="menuitem.png";
            break;
        case "delete":
            $title='Xóa'; $icon="fa-times-circle cred";
            $filename="delete.png";
            break;
        case "edit":
            $title='Sửa'; $icon="fa-edit";
            $filename="icon_edit.png";
            break;
        case "publish":
            if($value==1){
                $title='active'; $icon="fa-check cgreen";
                $filename="publish.png";
            }
            else{
                $title='Un active';$icon="fa-times-circle-o cred";
                $filename="unpublish.png";
            }
            break;
        case "show":
            if($value==1){
                $title="Show"; $icon="fa-check cgreen";
                $filename="publish.png";
            }
            else{
                $title="Hidden";$icon="fa-times-circle-o cred";
                $filename="icon_nodefault.png";
            }
            break;
        case "isfronpage":
            if($value==1) {
                $title="Front page";
                $filename="icon_isfront.png";
            }else{
                $title="Admin";
                $filename="icon_nofront.png";
            }
            break;
        case "isdefault":
            if($value==1) {
                $title="Default";
                $filename="icon_default.png";
            }
            else {
                $title="Not default";
                $filename="icon_nodefault.png";
            }
            break;
    }
	if($icon!='')
		echo "<i class='fa ".$icon."' aria-hidden='true'></i>";
    else 
		echo "<img border=0 height=\"16\" src=\"".ROOTHOST_ADMIN.IMG_PATH."$filename\" title=\"$title\"/>";
}
function LoadPosition(){
    $doc = new DOMDocument();
    $doc->load(ROOTHOST_ADMIN.'template.xml');
    $options = $doc->getElementsByTagName("position");

    foreach( $options as $option )
    { 
        $opts = $option->getElementsByTagName("option");
        foreach($opts as $opt)
        {
            echo "<option value=\"".$opt->nodeValue."\">".$opt->nodeValue."</option>";
        }
    }
}
function LoadModBrow($mod_name){
    $path='../'.MOD_PATH.$mod_name."/brow";
    var_dump($path);
    if(!is_dir($path))
        return;
    $objdir=dir($path);
    while($file=$objdir->read()){
        if(is_file($path."/".$file) && $file!="." && $file!=".." ){
            $file=substr($file,0,strlen($file)-4);
            echo "<option value=\"".$file."\">".$file."</option>";
        }
    }
    return ;
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
        default: break;
    }
    if($tag) $data=htmlentities($data);
    return $data;
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
function getThumb($urlThumb, $class='', $alt=''){
    if($urlThumb !=''){
        return "<img src=".$urlThumb." class='".$class."' alt='".$alt."'>";
    }
    else{
        return "<img src=".ROOTHOST.THUMB_DEFAULT." class='".$class."'>";
    }
}
function __link($page,$link_full){
    return str_replace('{page}', $page,$link_full);
}
function conver_to_par($par){
    $str="?";
    $key=array_keys($par);
    for($i=0;$i<count($par);$i++){
        $str=$str.$key[$i].'='.$par[$key[$i]]."&";
    }
    $str=substr($str,0,strlen($str)-1);
    return $str;
}
function paging0($total_rows,$max_rows,$cur_page,$link_full){
    $max_pages=ceil($total_rows/$max_rows);
    $start=$cur_page-5; if($start<1)$start=1;
    $end=$cur_page+5;   if($end>$max_pages)$end=$max_pages;
    $paging='<div class="paging">
    <nav>
        <ul class="pager">
            <input type="hidden" name="txtCurnpage" id="txtCurnpage" value="'.$cur_page.'" />';
            $paging.="";
            if($cur_page == 1 && $max_pages==1){
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">&laquo; Trang trước</span></li>';
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">Trang sau &raquo;</span></li>';
            }elseif($cur_page <=1){
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">&laquo; Trang trước</span></li>';
                $paging.='<li><a href="'.__link($cur_page+1,$link_full).'" aria-label="Next"><span aria-hidden="true">Trang sau &raquo;</span></a></li>';
            }elseif($cur_page >=$max_pages){
                $paging.='<li><a href="'.__link($cur_page-1,$link_full).'" class="cur_page" aria-label="Preview"> <span aria-hidden="true">&laquo; Trang trước</span></a></li>';
                $paging.='<li><span aria-hidden="true" style="background: #f5f5f5;">Trang sau &raquo;</span></li>';
            }else{
                $paging.='<li><a href="'.__link($cur_page-1,$link_full).'" class="cur_page" aria-label="Preview"> <span aria-hidden="true">&laquo; Trang trước</span></a></li>';
                $paging.='<li><a href="'.__link($cur_page+1,$link_full).'" aria-label="Next"><span aria-hidden="true">Trang sau &raquo;</span></a></li>';
            }
            $paging.='</ul>
        </nav>
    </div>';
    echo $paging;
}
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
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    echo $sql;
    $obj=new CLS_MYSQL;
    $obj->Exec($sql);
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
    $resp = curl_exec($curl);//var_dump($resp);
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
?>