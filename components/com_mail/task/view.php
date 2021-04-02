<?php 
$from=$to=$subject=$content='';
$mss_send=$mss_ok=$attachments=$filename='';
$array_from=$array_to=array();
if(isset($_POST['txt_to'])) {
	//var_dump($_POST); var_dump($_FILES);die;
	require_once('extensions/PHPMailer/class.phpmailer.php');
	$mail = new PHPMailer(true); //true param means it will throw exceptions on errors, which we need to catch
	$mail->IsHTML(true);
	
	$from = $_name."<".$_user.">";
	$n=count($array_from);
	$array_from[$n]['address']=$_user;
	$array_from[$n]['name']=$_name;
	
	$to = $_POST['txt_to']; // ds mail cách nhau dấu ,
	$to = str_replace(";",",",$to);
	
	$subject = $_POST['txt_subject'];
	$content = $_POST['txt_content'];
	
	try {
		$mail->Host = $_host; // SMTP server
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Port = $_port;
		
		$mail->Username = $_user;  
		$mail->Password = $_pass;   

		$mail->SetFrom($_user,utf8_decode($_name));
		$mail->AddReplyTo($_user,$_name);
		$mail->CharSet = "UTF-8";
		$mail->Subject = $subject;
		$mail->MsgHTML($content);
		
		// preparing attachments
		if(isset($_FILES['attach'])) {
			$maxsize = 2 * 1024 * 1024; // 2 MB
			// allowed mime-types
			$array_type=array('image/jpg','image/jpeg','image/gif','image/png','image/x-png','application/x-shockwave-flash',
		'audio/x-ms-wma','audio/mpeg3','video/avi','application/octet-stream','video/x-ms-wmv','text/plain','application/rar',
		'application/pdf','application/vnd.ms-excel','application/octet-stream','application/msword','text/html',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.ms-powerpoint',
		'application/vnd.openxmlformats-officedocument.presentationml.presentation','');
		
			for($i=0; $i < count($_FILES['attach']['name']); $i++){
				$ftype      = $_FILES['attach']['type'][$i];
				$fname      = basename($_FILES['attach']['name'][$i]);
				$fsize      = $_FILES['attach']['size'][$i];
				$ftmp       = $_FILES['attach']['tmp_name'][$i];
					
				if($fname!='') {
					if($fsize < $maxsize){
						if(in_array($ftype,$array_type)){
							// save file into server
							$folder = "attachments/files/";
							if(!is_dir($folder)) mkdir($folder);
							$filename = "./". $folder ."/".$fname;
							@copy($ftmp,$filename);
			
							$mail->AddAttachment($filename,$fname);      // attachment
							$attachments.=$filename.';';
						}else $mss_send.='Kiểu file '.$ftype.' này không được phép<br>';
					}else $mss_send.='File đính kèm '.$fname.' có dung lượng '.round($fsize/(1024*1024),2).'Mb vượt quá 2Mb cho phép<br>';
				}
			}
			if($mss_send==''){
				$total_size=0;
				for($i=0; $i < count($_FILES['attach']['name']); $i++){
					$total_size+= $_FILES['attach']['size'][$i];
				}
				if($total_size > $maxsize)
					$mss_send.='Tổng dung lượng file đính kèm là '.round($total_size/(1024*1024),2).'Mb vượt quá 2Mb cho phép<br>';
			}
		}
		// Send mail
		$arr_to = explode(",",$to);
		for ($i=0;$i<count($arr_to);$i++) {
			if (isset($_FILES['mail_to']) && $_FILES['mail_to']['name']==$arr_to[$i]) 
				continue;

			$mail->AddAddress($arr_to[$i],"");
			$array_to[count($array_to)]['address']=$arr_to[$i];
		}
		//echo"<pre>";print_r($mail);echo"</pre>";die;
		if($mss_send=='') {
			$mail->Send();
			if($mail->ErrorInfo!='') 
				$mss_send.=$mail->ErrorInfo.'<br>';
			if($mss_send==''){
				// save info into table tbl_boxes
				require_once('libs/cls.mailbox.php');
				$objmail = new CLS_MAILBOX;
				$objmail->Type=2;
				$objmail->Viewed=1;
				$objmail->From 	= json_encode($array_from); 
				$objmail->To 	= json_encode($array_to);
				$objmail->Encoding = "UTF-8";
				$objmail->SubjectEncoding = "UTF-8";
				$objmail->Subject = addslashes($subject);
				$objmail->Content = addslashes($content);
				$objmail->CreateDate = date("Y/m/d H:i:s");	
				$objmail->Attachments = $attachments;
				$objmail->Add_new();		
				
				$mss_ok.='Gửi thư thành công.<br>Hệ thống tự động quay lại Hộp thư đến sau 5s.';
			}
		}
	}catch (phpmailerException $e) {
		$mss_send.="Error ".$e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
		$mss_send.="Error ".$e->getMessage(); //Boring error messages from anything else!
	}
}
?>
<div class="row"><h3 class="col-md-6">Chi tiết thư </h3>
<div class="col-md-6 p_top10">
	<a href="<?php echo ROOTHOST_ADMIN;?>mail"><button class="btn btn-default pull-right">
		<i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Quay lại hộp thư đến
	</button></a>
</div></div>
<div class='box-white'>
	<div class="mailbox">
	<?php 
	$id=isset($_GET['id'])?(int)$_GET['id']:0; 
	$objdata= new CLS_MYSQL;				
	$sql="SELECT * FROM tbl_boxes WHERE id=$id";
	$objdata->Query($sql);
	if($objdata->Num_Rows()==0) echo "Dữ liệu trống";
	else { 
		$mail = $objdata->Fetch_Assoc(); 
		$type = $mail['type'];
		if($type==1) {
			// mask viewed this mail
			$sql="UPDATE tbl_boxes SET viewed=1 WHERe id=$id"; 
			$objdata->Query($sql); 
		}
		// info
		$txt_to='';
		$from = json_decode($mail['from'],true);
		$str_from='';
		for($i=0;$i<count($from);$i++) {
			if(isset($from[$i]['name'])){
				$str_from.='<strong>'.$from[$i]['name'].'</strong> ';
			}
			$str_from.=htmlentities('<').$from[$i]['address'].htmlentities('>');
			if($type==1) $txt_to=$from[$i]['address'];
		}
		$to = json_decode($mail['to'],true);
		$str_to='';
		for($i=0;$i<count($to);$i++) {
			if(isset($to[$i]['name'])) {
				$str_to.='<strong>'.$to[$i]['name'].'</strong> ';
			}
			$str_to.=htmlentities('<').$to[$i]['address'].htmlentities('>');
			if($type==2) $txt_to=$to[$i]['address'];
		}
		$date = strtotime($mail['create_date']);
		if(date("d/m/Y",$date)==date("d/m/Y")) $date = date("H:i",$date);
		elseif(date("Y",$date)==date("Y")) $date = date("d/m",$date);
		else $date = date("d/m/Y",$date);
		
		$attachment = $mail['attachment']; $arr_attach=array();$attach='';
		if($attachment!='') {
			$arr_attach = explode(";",$attachment);
			$attach='<i class="fa fa-paperclip" aria-hidden="true"></i>';
		} ?>
		<div class="mail_subject"><?php echo stripslashes($mail['subject']);?></div>
		<div class="mail_from pull-left">
			<div class="avar pull-left"><i class="fa fa-user" aria-hidden="true"></i></div>
			<div class="from pull-left"><?php echo $str_from;?><br>
				tới <?php if($type==1) echo "tôi"; else echo $str_to;?> 
				<i class="fa fa-caret-down" aria-hidden="true"></i>
			</div>
		</div>
		<div class="mail_date pull-right">
			<button class="btn btn-down pull-right dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-caret-down" aria-hidden="true"></i>
			</button>
			<button class="btn btn-reply pull-right"><i class="fa fa-reply" aria-hidden="true"></i></button>
			<ul class="dropdown-menu">
				<li>Trả lời</li>
			</ul>
			<div class="pull-right"><i class="fa fa-star-o" aria-hidden="true"></i></div>
			<div class="date pull-right"><?php echo $date;?></div>
			<div class="mail_attach pull-right"><?php echo $attach;?></div>
		</div>
		<div class="clearfix"></div>
		<div class="mail_content"><?php echo stripslashes($mail['content']);?></div>
		<div class="clearfix"></div>
		<?php if($attachment!='') { ?>
		<div class="attachments">
			<div><strong><?php echo count($arr_attach)-1;?> Tệp đính kèm</strong></div>
			<?php for($i=0;$i<count($arr_attach)-1;$i++) { 
			$filename 	= $arr_attach[$i];
			$size		= filesize($filename);
			$file	 	= pathinfo($filename);
			$ext 		= $file['extension'];
			$name 		= $file['filename'];
			
			// images
			$arr_img = array('png','jpe','jpeg','jpg','gif','bmp','ico','tiff','tif','svg','svgz');
			// file
			$arr_file = array('txt','htm','html','php','css','js','json','xml','swf','flv');
			// office
			$arr_ms = array('doc','docx','xls','xlsx','rtf','ppt','pptx','odt','ods');
			// archives
			$arr_zip = array('zip','rar','exe','msi','cab');
			// audio/video
			$arr_video = array('mp3','mp4','qt','mov');
			// adobe
			$arr_adobe = array('pdf','psd','ai','eps','ps');
			?>
			<div class="file_item">
				<div class="file_view" dataid="<?php echo base64_encode($filename);?>" dataname="<?php echo $name.'.'.$ext;?>">
					<?php if (in_array($ext, $arr_img)) echo "<img src='".ROOTHOST_ADMIN.$filename."' class='img-responsive'/>"; 
					else echo '<div class="name"><strong>'.$name.'.'.$ext.'</strong><br>'.formatSizeUnits($size).'</div>'; ?>
				</div>
				<div class="file_download" dataid="<?php echo base64_encode($filename);?>">
					<button class="btn btn-default">
						<i class="fa fa-download" aria-hidden="true"></i> Tải về
					</button>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div><hr>
	<?php if($mss_ok!='') {
		echo '<div class="p_30 success_box">'.$mss_ok.'</div>'; 
		echo '<script>setInterval(function () { autoloadpage(); }, 5000);</script>';
	} else { if($mss_send!='') echo '<div class="err_box">'.$mss_send.'</div>'; ?>
	<div class="reply_box" name="reply">
		<form name="frm_reply" id="frm_reply" action="#" method="POST" enctype="multipart/form-data">
			<div class="form-group clearfix to_box">
				<input type="text" name="txt_to" id="txt_to" placeholder="Tới" class="form-control pull-left" value="<?php echo $txt_to;?>" required/>
				<input type="hidden" name="txt_subject" id="txt_subject" value="<?php echo "RE: ".stripslashes($mail['subject']);?>" required/>
			</div>
			<div class="form-group">
				<textarea name="txt_content" id="txt_content" class="form-control"></textarea>
				<script language="javascript">
					var oEdit1=new InnovaEditor("oEdit1");
					oEdit1.width="100%";
					oEdit1.height="200";
					oEdit1.REPLACE("txt_content");
				</script>
			</div>
			<div class="form-group clearfix attach_box"></div>
			<div class="form-group clearfix save_box">
				<div class="pull-left">
					<button class="btn btn-primary pull-left"> Gửi </button>
					<div class="attach_file pull-left"><i class="fa fa-paperclip"></i></div>
				</div>
				<div class="pull-right icon_trash"><i class="fa fa-trash-o"></i></div>
			</div>
			
		</form>
	</div>
	<?php } ?>
	<?php } ?>
</div>
<script>
$(document).ready(function(){
	$('.attachments .file_item').hover(function(){
		$('.attachments .file_download').css({'display':'none'});
		$(this).children('.file_download').css({'display':'block'});
	})

	$('.attachments .file_view').click(function(){
		var path=$(this).attr('dataid');
		var name=$(this).attr('dataname');
		$('#myModalPopup .modal-dialog').removeClass('modal-sm');
		$('#myModalPopup .modal-dialog').removeClass('modal-lg');
		$('#myModalPopup .modal-dialog').addClass('modal-lg');
		$('#myModalPopup .modal-header .modal-title').html(''+name);
		$('#myModalPopup .modal-body').html('<p>Loadding...</p>');
		var url='<?php echo ROOTHOST_ADMIN;?>ajaxs/<?php echo COMS;?>/view_attach.php'; 
		$.get(url,{'path':path},function(req){
			if(req=='E01'){showMess('Bạn chưa đăng nhập, xin vui lòng đăng nhập!','error');}
			else{
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			}
		})
	})
	$('.attachments .file_download').click(function(req){
		var path=$(this).attr('dataid'); 
		var url='<?php echo ROOTHOST_ADMIN.COMS;?>/download/'+path;
		window.open(url,'_blank'); 
	})

	$('.mail_date').click(function(){
		$('.mail_date .dropdown-menu').toggle();
	})
	$('.mail_date .dropdown-menu li').click(function(){
		$('.reply_box').css({"display":"block"});
		$('#txt_to').focus();
	})
	$('.attach_file').click(function(e){
		e.preventDefault();
		var attach = $('input[name="attach'+'[]'+'"]'); 
		var num = attach.length;
		$( "<input name='attach[]' id='attach_"+num+"' type='file'/>" ).appendTo( ".attach_box" );
	})
	$('.icon_trash').click(function(){
		window.location='<?php echo ROOTHOST_ADMIN.COMS;?>';
		showMess('Thư của bạn đã bị hủy','');
	})
})
function autoloadpage() {
	window.location="<?php echo ROOTHOST_ADMIN.COMS;?>";
}
</script>