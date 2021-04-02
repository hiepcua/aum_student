<?php

$obj=new CLS_QUESTIONS();

/* connect to server */
$hostname = '{timhieuphapluat.vn:143/imap/novalidate-cert}INBOX';
$username = 'lienhe@timhieuphapluat.vn';
$password = 'Vinh123';
// $hostname = '{imap.gmail.com:993/imap/novalidate-cert}INBOX';
// $username = 'vinhnq2016@gmail.com';
// $password = 'vinh2016';
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to server: ' . imap_last_error());
$emails = imap_search($inbox,'UNSEEN');
$message=$part="";
if($emails) {
    $output = '';
    rsort($emails);


    foreach($emails as $email_number) {
        $overview = imap_fetch_overview($inbox,$email_number,0);
        $structure = imap_fetchstructure($inbox, $email_number);
        $header = imap_headerinfo($inbox, $email_number);
	

        if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
            $part = $structure->parts[1];
            $message = imap_fetchbody($inbox,$email_number,2);

            if($part->encoding == 3) {
                $message = imap_base64($message);
            } else if($part->encoding == 1) {
                $message = imap_8bit($message);
            } else {
                $message = imap_qprint($message);
            }
        }
        $fromName=mb_decode_mimeheader($overview[0]->from);
        $fromAddress = $header->from[0]->mailbox."@".$header->from[0]->host;
        $date=strtotime(utf8_decode(imap_utf8($overview[0]->date)));
        $subject=mb_decode_mimeheader($overview[0]->subject);

        // $output.= '<div class="toggle'.($overview[0]->seen ? 'read' : 'unread').'">';
        // $output.= '<span class="from">From: '.$from.'</span>';
        // $output.= '<span class="date">on '.$date.'</span>';
        // $output.= '<br /><span class="subject">Subject('.$part->encoding.'): '.$subject.'</span> ';
        // $output.= '</div>';
        // $output.= '<div class="body">'.$message.'</div><hr />';

        // echo $from." ".$fromaddr."<br/>";
        $check=$obj->checkEmailCustomer($fromAddress);
        if($check !=0){
           $obj->IdCustomer=$check;
           $obj->Title=$subject;
          $obj->TextQuestion=$message;
          $obj->Creatdate=$date;
          $obj->isActive=0;
          $obj->isEmail=1;
          $obj->addNewFromMail();

        }
        else {
        
           $objdata=new CLS_MYSQL();
          // $objdata->Query("BEGIN");
          $sql="INSERT INTO `tbl_customer` (`name`,`email`,`creatdate`,`isactive`) VALUES ";
          $sql.="('".$fromName."','".$fromAddress."','".$date."','1')";
          // echo $sql."<br/>";
          $result=$objdata->Query($sql);
          $ids=$objdata->LastInsertID();
            $sql1="INSERT INTO `tbl_question` (`id_customer`,`title`,`text_question`,`creatdate`,`isactive`,`isemail`) VALUES";
          $sql1.="('$ids','".$subject."','".$message."','".$date."','0','1')";
          // echo $sql."<br/>";
         $result1=$objdata->Query($sql1);

         // if($result && $result1 )
         // {
         //  $objdata->Query('COMMIT');
         //  return $result;
         // } else 
         // {
         //  $objdata->Query('ROLLBACK');
         //  }

        }
       
    }
    // echo $output;
}
imap_close($inbox);
echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&task=list_transfermail'</script>";
?>

