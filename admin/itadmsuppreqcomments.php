<?php
// from itadmsuppreq.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_POST['iditsupportreq'])) ? $_POST['iditsupportreq'] :'';
$ctgactor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';
$comments = (isset($_POST['comments'])) ? $_POST['comments'] :'';

$found = 0;
$accesslevel11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

	if($comments!='') {

	// query name based on loginid and empid
	$res10query="SELECT tblcontact.name_last, tblcontact.name_first FROM tbladminlogin LEFT JOIN tblcontact ON tbladminlogin.employeeid=tblcontact.employeeid WHERE tbladminlogin.adminloginid=$loginid LIMIT 1";
	$result10=""; $found10=0; $ctr10=0;
	$result10 = $dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10 = $result10->fetch_assoc()) {
		$found10 = 1;
		$ctr10 = $ctr10 + 1;
		$name_last10 = $myrow10['name_last'];
		$name_first10 = $myrow10['name_first'];
		} // while$myrow10 = $result10->fetch_assoc())
	} // if($result10->num_rows>0)

	// query comments from tblitsupportreq
	$res11query="SELECT tblitsupportreq.employeeid, tblitsupportreq.deptcd, tblitsupportreq.requestctg, tblitsupportreq.details, tblitsupportreq.comments, tblcontact.email1 FROM tblitsupportreq LEFT JOIN tblcontact ON tblitsupportreq.employeeid=tblcontact.employeeid WHERE tblitsupportreq.iditsupportreq=$iditsupportreq";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11 + 1;
		$employeeid11 = $myrow11['employeeid'];
		$deptcd11 = $myrow11['deptcd'];
		$requestctg11 = $myrow11['requestctg'];
		$details11 = $myrow11['details'];
		$comments11 = $myrow11['comments'];
		$email111 = $myrow11['email1'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

	// compose comments post and queried comments
	$commentsfin = $name_last10 . ", " . $name_first10 . " on $now:\r\n" . $comments . "\r\n\r\n" . $comments11;

	// update query
	$res12query="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, comments=\"$commentsfin\" WHERE iditsupportreq=$iditsupportreq";
	$result12 = $dbh2->query($res12query);
	// echo "<p>res12query:$res12query</p>";

	// prepare and sendmail
	// echo "<pre>";
		// prepare mailheaders
		$from = "noreply@philkoei.com.ph";
		$cc = "";
		// set content-type to html
		$mailheader = "MIME-Version: 1.0" . "\r\n";
		$mailheader .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		// additional headers
		$mailheader .= "From:" . $from . "\r\n";
		$mailheader .= "Cc:" . $cc . "\r\n";
		// compose message
		$to = $email111;
		$subject = "IT support request comment/clarification";
		// $message = "Dear $directaddr,\r\n\r\n";
		$message = $message . "A comment/clarification to your IT technical support request was sent by $name_last10, $name_first10.\r\n\r\n";
		$message = $message . "Please login to the PKII Intranet, click the IT support request sidebar link and select 'Details' to the support request item to view the comments/clarifications.\r\n\r\n";
		$message = $message . "Thank.\r\n\r\n\r\n";
		$message = $message . "Note: This is an auto-generated email from PKII Intranet's IT Support Request module.\r\n";
		$message = $message . "Please do not reply to this email. The IT support request module has the facility to provide input fields for comments and/or clarifications.\r\n\r\n";

		// echo "$mailheader\n";
		// echo "from:$from\n";
		// echo "to:$to\n";
		// echo "$message\n";
		$ok = "";
		$ok = mail("$to", "$subject", "$message", "$mailheader");
	// echo "</pre>";
		if($ok) {
			$emlmsg = "Congratulations your email has been sent";
			$processed = $processed . $message . 	"------------------------------------------------------------------------------------------------------------\n";
		} else {
			$emlmsg = "Sorry, the email was not sent. Pls try again.";
		} // if($ok)

		// display result to requestor
		echo "<p><font color=\"green\">Note:<br>Your comment/clarification has been logged.";
		if($ok) { echo "&nbsp;An e-mail notification was sent."; }
		echo "&nbsp;Thank you.</font></p>";

		// prepare and log		
		$logdetails = "$loginid:$username - IT support request comment/clarification logged from $employeeid-$name_last10, $name_first10 for support id:$iditsupportreq ctg:$requestctg11 details:$details11";
		$res17query = "INSERT INTO tbllogs SET timestamp=\"$now\", loginid=$loginid, username=\"$username\", logdetails=\"$logdetails\"";
		$result17 = $dbh2->query($res17query);
		// echo "<br>$res17query</p>";

	// redirect
	//header("Location: itsuppreq.php?loginid=$loginid");
	// exit;

	} // if($comments!='')

	echo "<p><a href=\"itadmsuppreq.php?loginid=$loginid\">back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
