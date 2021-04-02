<?php
require_once('../../extensions/POP3/mime_parser.php');
require_once('../../extensions/POP3/rfc822_addresses.php');
require_once("../../extensions/POP3/pop3.php");

$_host = isset($_POST['host'])?addslashes($_POST['host']):'';
$_port = isset($_POST['port'])?(int)$_POST['port']:'';
$_user = isset($_POST['user'])?addslashes($_POST['user']):'';
$_pass = isset($_POST['pass'])?addslashes($_POST['pass']):'';

//echo $_host.'<br>'.$_port.'<br>'.$_user.'<br>'.$_pass.'<br>';
stream_wrapper_register('mlpop3', 'pop3_stream');  /* Register the pop3 stream handler class */

$pop3=new pop3_class;
$pop3->hostname=$_host;      			/* POP 3 server host name                      */
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
		echo "Kết nối thành công tới tài khoản ".$user;
	} else echo "LỖI! Không kết nối được tới tài khoản ".$user;
}else echo "Kết nối không thành công";
?>