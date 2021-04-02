<?php 
@header('Content-Type: text/plain');

$from=$to=$cc=$bcc=$subject=$content='';
$mss_send=$mss_ok=$attachments=$filename='';
$array_from=$array_to=$array_cc=$array_bcc=array();
if(isset($_POST['txt_to'])) {
	//var_dump($_POST); var_dump($_FILES);
	require_once('extensions/PHPMailer/class.phpmailer.php');
	$mail = new PHPMailer(true); //true param means it will throw exceptions on errors, which we need to catch
	$mail->IsHTML(true);
	
	$from = $_name."<".$_user.">";
	$n=count($array_from);
	$array_from[$n]['address']=$_user;
	$array_from[$n]['name']=$_name;
	
	$to = $_POST['txt_to']; // ds mail cách nhau dấu ,
	$to = str_replace(";",",",$to);
	
	$cc = $_POST['txt_cc'];
	$cc = str_replace(";",",",$cc);
	
	$bcc = $_POST['txt_bcc'];
	$bcc = str_replace(";",",",$bcc);
	
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
	  
		if($cc!='') {
			$arr_cc = explode(",",$cc);
			for($i=0;$i<count($arr_cc);$i++)
				if($arr_cc[$i]!='') {
					$mail->AddCC($arr_cc[$i], '');
					$array_cc[count($array_cc)]['address']=$arr_cc[$i];
				}
		}
		if($bcc!='') {
			$arr_bcc = explode(",",$bcc);
			for($i=0;$i<count($arr_bcc);$i++)
				if($arr_bcc[$i]!='') {
					$mail->AddBCC($arr_bcc[$i], '');
					$array_bcc[count($array_bcc)]['address']=$arr_bcc[$i];
				}
		}
		
		
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
		
		if(isset($_FILES['mail_to']) && $_FILES['mail_to']['tmp_name']!='') {
			// save file on server
			$path = "attachments/temp/temp.xls";
			$myfile = fopen($path, "w") or die("Unable to open file!");
			fwrite($myfile, file_get_contents($_FILES['mail_to']['tmp_name']));
			fclose($myfile);
			
			// read file excel
			require('extensions/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
			require('extensions/spreadsheet-reader-master/SpreadsheetReader.php');
			$Reader = new SpreadsheetReader($path);
			$i=0;
			foreach ($Reader as $Row)
			{	$i++; 
				if($i>1) {
					if(filter_var($Row[3], FILTER_VALIDATE_EMAIL)) { // valid address
						$mail_to = $Row[0]." ".$Row[1]." ".$Row[2]."<".$Row[3].">";
					}
					$mail->AddAddress($Row[3],$Row[0]." ".$Row[1]." ".$Row[2]);
					
					$n=count($array_from);
					$array_to[$n]['address']=$Row[3];
					$array_to[$n]['name']=$Row[0]." ".$Row[1]." ".$Row[2];
				}
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
				$objmail->CC 	= json_encode($array_cc);
				$objmail->BCC 	= json_encode($array_bcc);
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
<script>
	function autoloadpage() {
		window.location="<?php echo ROOTHOST_ADMIN.COMS;?>";
	}
</script>
<h3>Soạn thư mới</h3>
<div class='box-white'><div class="col-md-12">
	<form name="frm_outbox" id="frm_outbox" action="#" method="POST" enctype="multipart/form-data">
		<div class="form-group clearfix"><br>
		<?php if($mss_ok!='') {
			echo '<div class="success_box">'.$mss_ok.'</div>'; 
			echo '<script>setInterval(function () { autoloadpage(); }, 5000);</script>';
		} else { if($mss_send!='') echo '<div class="err_box">'.$mss_send.'</div>'; ?>
		</div>
		<div class="form-group clearfix to_box tooltip_box">
			<input type="text" name="txt_to" id="txt_to" placeholder="Tới" class="form-control pull-left" required/>
			<div class="func_send pull-right">
				<a href="javascript:void(0)" class="load_mails" dataid="mail_to">Tải ds Email</a> | 
				<a href="javascript:void(0)" class="add_cc">Cc</a>
				<a href="javascript:void(0)" class="add_bcc">Bcc</a>
			</div>
			<input type="file" id="mail_to" name="mail_to" accept=".xls,.xlsx"/>
			<span class="tooltiptext">Danh sách email cách nhau bởi dấu ,</span>
		</div>
		<div class="form-group clearfix cc_box tooltip_box">
			<input type="text" name="txt_cc" id="txt_cc" placeholder="Cc" class="form-control pull-left"/>
			<div class="func_cc pull-right">
				<a href="javascript:void(0)" class="add_bcc">Bcc</a>
			</div>
			<input type="file" id="mail_cc" name="mail_cc" accept=".xls,.xlsx" accept=".xls,.xlsx"/>
			<span class="tooltiptext">Danh sách email cách nhau bởi dấu ,</span>
		</div>
		<div class="form-group clearfix bcc_box tooltip_box">
			<input type="text" name="txt_bcc" id="txt_bcc" placeholder="Bcc" class="form-control pull-left"/>
			<div class="func_bcc pull-right">
				<a href="javascript:void(0)" class="add_cc">Cc</a>
			</div>
			<input type="file" id="mail_bcc" name="mail_bcc" accept=".xls,.xlsx"/>
			<span class="tooltiptext">Danh sách email cách nhau bởi dấu ,</span>
		</div>
		<div class="form-group clearfix">
			<input type="text" name="txt_subject" id="txt_subject" placeholder="Tiêu đề" class="form-control" required/>
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
		<?php } ?>
	</form>
</div></div>
<script>
$(document).ready(function(){
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
	$('.to_box .add_cc').click(function(){
		$('.to_box .add_cc').css({'display':'none'});
		$('.to_box .add_bcc').css({'display':'none'});
		$('.cc_box').css({'display':'block'});
	})
	$('.to_box .add_bcc').click(function(){
		$('.to_box .add_cc').css({'display':'none'});
		$('.to_box .add_bcc').css({'display':'none'});
		$('.bcc_box').css({'display':'block'});
	})
	$('.cc_box .add_bcc').click(function(){
		$('.cc_box .add_bcc').css({'display':'none'});
		$('.bcc_box .add_cc').css({'display':'none'});
		$('.bcc_box').css({'display':'block'});
	})
	$('.bcc_box .add_cc').click(function(){
		$('.bcc_box .add_cc').css({'display':'none'});
		$('.cc_box .add_bcc').css({'display':'none'});
		$('.cc_box').css({'display':'block'});
	})
	$('.load_mails').click(function(){
		var id = $(this).attr('dataid');
		$("#"+id).click();
	})
	$('#mail_to').change(function(){
		var file = $(this)[0].files[0];
		if (file){
			var str_to =$('#txt_to').val();
			if (str_to=='') str_to = file.name;
			else str_to = str_to+';'+file.name; 
			$('#txt_to').val(str_to);
		}
	})
	$('#mail_cc').change(function(){
		var file = $(this)[0].files[0];
		if (file){
			var str_to =$('#txt_cc').val();
			if (str_to=='') str_to = file.name;
			else str_to = str_to+';'+file.name; 
			$('#txt_cc').val(str_to);
		}
	})
	$('#mail_bcc').change(function(){
		var file = $(this)[0].files[0];
		if (file){
			var str_to =$('#txt_bcc').val();
			if (str_to=='') str_to = file.name;
			else str_to = str_to+';'+file.name; 
			$('#txt_bcc').val(str_to);
		}
	})
})
</script>