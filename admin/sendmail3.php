<?php

include("db1.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';

$projectname = (isset($_POST['projectname'])) ? $_POST['projectname'] :'';
$advisorytype = (isset($_POST['advisorytype'])) ? $_POST['advisorytype'] :'';
$payamount = (isset($_POST['payamount'])) ? $_POST['payamount'] :'';
$currency = (isset($_POST['currency'])) ? $_POST['currency'] :'';
$paytype = (isset($_POST['paytype'])) ? $_POST['paytype'] :'';
$bankname = (isset($_POST['bankname'])) ? $_POST['bankname'] :'';
$bankbranch = (isset($_POST['bankbranch'])) ? $_POST['bankbranch'] :'';
$acct_num = (isset($_POST['acct_num'])) ? $_POST['acct_num'] :'';
$acctname = (isset($_POST['acctname'])) ? $_POST['acctname'] :'';
$accttype = (isset($_POST['accttype'])) ? $_POST['accttype'] :'';
$datedeposited = (isset($_POST['datedeposited'])) ? $_POST['datedeposited'] :'';
$moredetails = (isset($_POST['moredetails'])) ? $_POST['moredetails'] :'';

$to = (isset($_POST['to'])) ? $_POST['to'] :'';
$subject = (isset($_POST['subject'])) ? $_POST['subject'] :'';
$messagepre = (isset($_POST['message'])) ? $_POST['message'] :'';
$mailheaderpre = (isset($_POST['mailheader'])) ? $_POST['mailheader'] :'';
$filename = (isset($_POST['filename'])) ? $_POST['filename'] :'';
$path = (isset($_POST['path'])) ? $_POST['path'] :'';
$filepath = (isset($_POST['filepath'])) ? $_POST['filepath'] :'';

$mailheadfrom = (isset($_POST['mailheadfrom'])) ? $_POST['mailheadfrom'] :'';
$mailheadcc = (isset($_POST['mailheadcc'])) ? $_POST['mailheadcc'] :'';
$mailheadbcc = (isset($_POST['mailheadbcc'])) ? $_POST['mailheadbcc'] :'';

date_default_timezone_set('Asia/Manila');
$date = date("Y-m-d H:i:s", time());

echo "<html>";
?>
<STYLE TYPE="text/css">
<!--
TD{font-family: Helvetica; font-size: 10pt;}
--->
</STYLE>
<?php

echo "<font size=2>";
echo "to: $to<br>";
echo "subj: $subject<br>";
echo "$messagepre<br>";
echo "$date<br>$employeeid<br>$projectname<br>$advisorytype<br>$payamount<br>$currency<br>$paytype<br>$bankname<br>$bankbranch<br>$acct_num<br>$acctname<br>$accttype<br>$datedeposited<br>$moredetails<br>";
echo "$mailheaderpre<br>$mailheadfrom<br>$mailheadcc<br>$mailheadbcc<br>$filename<br>";

if($filename == "") {

// send mail w/o attachment
  $ok = mail($to, $subject, $messagepre, $mailheaderpre);

  if ($ok) {
    echo "<p>Congratulations your email has been sent</p>";

    $File = "/var/www/pkii/admin/logs/". date("y-m-d_H:i:s", time()) . "_" . $to . ".txt";
    $Handle = fopen($File, 'w');
    $Data = "$messagepre"; 
    fwrite($Handle, $Data);
    fclose($Handle);

  } else {
    echo "<p><font color=red>Sorry, the email was not sent. Pls try again.</font></p>";
  }

} else {

// send mail with attachment
$bound_text =	"pkii123";
$bound =	"--".$bound_text."\n";
$bound_last =	"--".$bound_text."--\n";
 	 
$mailheader .= $mailheadfrom
	.$mailheadcc
	.$mailheadbcc
	."MIME-Version: 1.0\n"
 	."Content-Type: multipart/mixed; boundary=\"$bound_text\"";
 	 
$message .= "If you can see this MIME then your client doesn't accept MIME types!\n"
 	.$bound;
 	 
$message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n"
 	."Content-Transfer-Encoding: 7bit\n\n"
	.$messagepre."\n"
 	.$bound;
 	 
$file =	file_get_contents("$filepath");
 	 
$message .= "Content-Type: applications/pdf; name=\"$filename\"\n"
 	."Content-Transfer-Encoding: base64\n"
 	."Content-disposition: attachment; file=\"$filename\"\n\n"
 	.chunk_split(base64_encode($file))
 	.$bound;
 	
$message .= "Content-Type: text/html; charset=\"iso-8859-1\"\n"
 	."Content-Transfer-Encoding: 7bit\n\n"
        .$bound_last;	

 	
  if(mail($to, $subject, $message, $mailheader)) 
  {
     echo "<p>Congratulations your email with attachment has been sent</p>";

    $File = "/var/www/pkii/admin/logs/". date("y-m-d_H:i:s", time()) . "_" . $to . ".txt";
    $Handle = fopen($File, 'w');
    $Data = "$message"; 
    fwrite($Handle, $Data);
    fclose($Handle); 
	
	// insert logs
	$adminlogdetails = "$loginid:$username - send email from custom pay notifier for:$to sub:$subject logfile:$File";
    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
	$result17=$dbh2->query($res17query);
	
  } else { 
     echo "<p><font color=red>Sorry, the email was not sent. Pls try again.</font></p>";
  }
}

echo "<p><a href=\"emailnotifier2.php?loginid=$loginid\" class='btn btn-default' role='button'>back</a></p>";
echo "</html>";

?>

