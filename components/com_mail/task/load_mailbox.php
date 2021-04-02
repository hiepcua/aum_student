<?php
require_once('libs/cls.mailbox.php');
$objmail = new CLS_MAILBOX;
require_once('extensions/POP3/mime_parser.php');
require_once('extensions/POP3/rfc822_addresses.php');
require_once("extensions/POP3/pop3.php");

stream_wrapper_register('mlpop3', 'pop3_stream');  /* Register the pop3 stream handler class */

$pop3=new pop3_class;
$pop3->hostname=$_host;      /* POP 3 server host name                      */
$pop3->port=$_port;                         /* POP 3 server host port,
											usually 110 but some servers use other ports
											Gmail uses 995                              */
$pop3->tls=0;                            /* Establish secure connections using TLS      */
$user=$_user;           				 /* Authentication user name                    */
$password=$_pass;	                     /* Authentication password                     */
$pop3->realm="";                         /* Authentication realm or domain              */
$pop3->workstation="";                   /* Workstation for NTLM authentication         */
$apop=0;                                 /* Use APOP authentication                     */
$pop3->authentication_mechanism="USER";  /* SASL authentication mechanism               */
$pop3->debug=1;                          /* Output debug information                    */
$pop3->html_debug=1;                     /* Debug information is in HTML                */
$pop3->join_continuation_header_lines=1; /* Concatenate headers split in multiple lines */

if(($error=$pop3->Open())=="")
{
	if(($error=$pop3->Login($user,$password,$apop))=="")
	{
		if(($error=$pop3->Statistics($messages,$size))=="")
		{
			//echo "<PRE>There are $messages messages in the mail box with a total of $size bytes.</PRE>\n";
			if($messages>0)
			{
				$pop3->GetConnectionName($connection_name);
				$message=0;
				for($message=$messages;$message>=1;$message--) {
					$message_file='mlpop3://'.$connection_name.'/'.$message;
					$mime=new mime_parser_class;
					/*Set to 0 for not decoding the message bodies*/
					$mime->decode_bodies = 1;

					$parameters=array(
						'File'=>$message_file,
						/* Read a message from a string instead of a file */
						/* 'Data'=>'My message data string',              */
						/* Save the message body parts to a directory     */
						/* 'SaveBody'=>'/tmp',                            */
						/* Do not retrieve or save message body parts     */
							'SkipBody'=>0,
					);
					$success=$mime->Decode($parameters, $decoded);

					if($success) {
						if($mime->Analyze($decoded[0], $results))
						{
							//echo '<pre>'; var_dump($results); echo '</pre>';
							
							$from = array_values($results['From']);
							$to = array_values($results['To']);
							$objmail->From = addslashes(json_encode($from)); 
							$objmail->To = addslashes(json_encode($to));
							$objmail->Encoding = $results['Encoding'];
							if(isset($results['SubjectEncoding'])) 
								$objmail->SubjectEncoding = addslashes($results['SubjectEncoding']);
							$objmail->Subject = addslashes($results['Subject']);
							$objmail->Content = addslashes($results['Data']);
							$objmail->CreateDate = date("Y/m/d H:i:s",strtotime($results['Date']));
							
							$objmail->CheckAdd(); // Check message before add
							if($objmail->Num_rows()==0) {
								if(isset($results['Attachments'])) {
									//echo '<pre>'; var_dump($results['Attachments']); echo '</pre>';
									$Attachments = array_values($results['Attachments']);
									$arr_url='';
									for($i=0;$i<count($Attachments);$i++) {
										$filename 	= pathinfo($Attachments[$i]['FileName']);
										$type 		= $filename['extension'];
										$filename 	= un_unicode($filename['filename']);
										$filetype	= $Attachments[$i]['Type'];
										$data		= $Attachments[$i]['Data'];

										$folder = "attachments";
										if(!is_dir($folder))
										{
											mkdir($folder);
										}
										/* Save the downloaded in the 'attachments' folder. */
										$path = "./". $folder ."/". ($i+1) . "-" . $filename.'.'.$type;
										$fp = fopen($path, "w+");
										fwrite($fp,$data);
										$arr_url.=$path.';';
									}
									$objmail->Attachments = $arr_url;
								} else $objmail->Attachments = '';
								
								if($objmail->Add_new()) {
									$result = $pop3->ListMessages("",1);
									$unique = $result[Key($result)];
									if(($error=$pop3->DeleteMessage($unique))=="")
										echo "<PRE>Marked message 1 for deletion.</PRE>\n";
									}
								}
						}
						else
							echo 'MIME message analyse error: '.$mime->error."\n";
					}
				}
			}
		}
	}
}
?>