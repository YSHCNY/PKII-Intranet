<?php 

// include("../admin/db1.php");
$hostname = 'localhost';
$dbname = 'maindb';
$dbuser = 'root';
// $dbuserpass = 'pkii@1111';
$dbuserpass = 'sysad';
$dbh2 = new mysqli("$hostname", "$dbuser", "$dbuserpass", "$dbname") or die ("Unable to connect to database");

include("/var/www/pkii/admin/datetimenow.php");

	// prepare mailheaders
	$from = "noreply@philkoei.com.ph";
	$cc = "";

	// set content-type to html
	$mailheader = "MIME-Version: 1.0" . "\r\n";
	$mailheader .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// additional headers
	$mailheader .= "From:" . $from . "\r\n";
	// $mailheader .= "Cc:" . $cc . "\r\n";

	echo "<pre>";

	$message = "";

$res12query="SELECT idtblscheduler, loginid, lastupdate, schedname, datefrom, dateto, details, recurring, deptcd, notifywho FROM tblscheduler WHERE notifysw = 1 AND (notifywhen=\"$datenow\" OR DATE_FORMAT(notifywhen, '%m-%d')=DATE_FORMAT('$datenow', '%m-%d'))";
$result12=""; $found12=0; $ctr12=0;
$result12 = $dbh2->query($res12query);
if($result12->num_rows>0) {
		while($myrow12 = $result12->fetch_assoc()) {
		$found12 = 1;
		$ctr12 = $ctr12+1;
		$idtblscheduler12 = $myrow12['idtblscheduler'];
		$loginid12 = $myrow12['loginid'];
		$lastupdate12 = $myrow12['lastupdate'];
		$schedname12 = $myrow12['schedname'];
		$datefrom12 = $myrow12['datefrom'];
		$dateto12 = $myrow12['dateto'];
		$details12 = $myrow12['details'];
		$recurring12 = $myrow12['recurring'];
		$deptcd12 = $myrow12['deptcd'];
		$notifywho12 = $myrow12['notifywho'];

		//	echo "".date("D Y-M-d", strtotime($datefrom12))."";

	// prepare subject
	if($deptcd12!='') {
		$deptcd12 = str_replace("|", " ", $deptcd12);
		$subject = "Scheduled notifier for " . $deptcd12 . " dept/s";
	} else {
		$subject = "Scheduled notifier";
	} // if($deptcd12!='')

	// prepare message
	$message = "";
	if($datefrom12==$dateto12) {
		$message = $message . date("D Y-M-d", strtotime($datefrom12)) . "\r\n";
	} else {
		$message = $message . date("D Y-M-d", strtotime($datefrom12)) . "&nbsp;-to-&nbsp" . date("D Y-M-d", strtotime($dateto12)) . "\r\n";
	}
	$message = $message . $schedname12 . "\r\n";
	$message = $message . $details12 . "\r\n";

	// prepare to
	if($found12 == 1) {

	// check notifywho if mailto or dept
	if(preg_match("/mailto/", "$notifywho12")) {
		$mailtoarr = explode(":", $notifywho12);
		$notifywhomailto = $mailtoarr[1];
		$notifywhodept = "";
	} else if(preg_match("/dept/", "$notifywho12")) {
		$mailtoarr = explode(":", $notifywho12);
		$notifywhodept = $mailtoarr[1];
		$notifywhomailto = "";
	} // if(preg_match("/mailto/", "$notifywho14"))

	if($notifywhomailto!='' && $notifywhodept=='') {

		$to = $notifywhomailto;
		echo "$message\n";
		$ok = "";
		$ok = mail("$to", "$subject", "$message", "$mailheader");
		if($ok) {
			echo "<p>Congratulations your email has been sent</p>";
			$processed = $processed . $message . 	"------------------------------------------------------------------------------------------------------------\n";
		} else {
			echo "<p><font color=red>Sorry, the email was not sent. Pls try again.</font></p>";
		} // if($ok)
 		echo "to:$to<hr>";
		// reset variables
		$to=""; $notifywhomailto="";


	} else if($notifywhodept!='' && $notifywhomailto=='') {

		$res14query="SELECT tblcontact.email1 FROM tblempdetails LEFT JOIN tblemployee ON tblempdetails.employeeid=tblemployee.employeeid LEFT JOIN tblcontact ON tblemployee.employeeid=tblcontact.employeeid WHERE tblempdetails.empdepartment=\"$notifywhodept\" AND tblemployee.emp_record=\"active\"";
		$result14=""; $found14=0; $ctr14=0;
		$result14 = $dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14 = $result14->fetch_assoc()) {
			$found14=1;
			$email114 = $myrow14['email1'];

			$to = $email114;

			echo "$message\n";

			$ok = "";
			$ok = mail("$to", "$subject", "$message", "$mailheader");
			if($ok) {
				echo "<p>Congratulations your email has been sent</p>";
				$processed = $processed . $message . 		"------------------------------------------------------------------------------------------------------------\n";
			} else {
				echo "<p><font color=red>Sorry, the email was not sent. Pls try again.</font></p>";
			} // if($ok)
  		echo "to:$to<hr>";

			// reset variables
			$to=""; $email114="";

			} // while($myrow14 = $result14->fetch_assoc())
		} // if($result14->num_rows>0)

	} // if($notifywhomailto!='' && $notifywhodept=='')

	} // if($found12 == 1)

	echo "</pre>";

	} // while($myrow12 = $result12->fetch_assoc())
} // if($result12->num_rows>0)
	
//
// for tblscheduleremail below
// 20200518
//

// prep date and time range for 1st version only
$datetimefrom=date('Y-m-d H:i:s', strtotime($datenow." 00:00:00"));
$datetimeto=date('Y-m-d H:i:s', strtotime($datenow." 23:59:59"));
echo "<pre>";
    $res11qry=""; $result11=""; $found11=0;
	$res11qry="SELECT emlreplyto, emlto, emlcc, emlbcc, emlsubject, emlbody FROM tblscheduleremail WHERE emldatetime BETWEEN '$datetimefrom' AND '$datetimeto'";
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$emlreplyto = $myrow11['emlreplyto'];
			$emlto = $myrow11['emlto'];
			$emlcc = $myrow11['emlcc'];
			$emlbcc = $myrow11['emlbcc'];
			$emlsubject = $myrow11['emlsubject'];
			$emlbody = $myrow11['emlbody'];
			$emlbody = nl2br($emlbody);
			
	if($found11==1) {
		$mailheader="";
	// set content-type to html
	$mailheader = "MIME-Version: 1.0" . "\r\n";
	$mailheader .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

	// additional headers
	$mailheader .= "From:" . $emlreplyto . "\r\n";
		// get previous mailheader and add below
		$mailheader .= "Cc: " . $emlcc . "\r\n";
		$mailheader .= "Bcc: " . $emlbcc . "\r\n";
		$mailheader .= "Reply-To: " . $emlreplyto . "\r\n";
		$mailheader .= "X-Mailer: PHP/" . phpversion();
		// send mail
		echo "$message\n";
		$ok = "";
		$ok = mail("$emlto", "$emlsubject", "$emlbody", "$mailheader");
		if($ok) {
			echo "<p>Congratulations your email has been sent</p>";
			$processed = $processed . $message . 		"------------------------------------------------------------------------------------------------------------\n";
		} else {
			echo "<p><font color='red'>Sorry, the email was not sent. Pls try again.</font></p>";
		} // if($ok)
		// reset vars
	    $mailheader=""; $ok="";
	} //if

		} // while
	} //if

echo "</pre>";

$dbh2->close();
?>
