<?php
// from itadmsuppreqdtl.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$iditsupportreq = (isset($_GET['its'])) ? $_GET['its'] :'';
$ticketnum = (isset($_POST['ticketnum'])) ? $_POST['ticketnum'] :'';
$emailreq = (isset($_POST['emailreq'])) ? $_POST['emailreq'] :'';

$closeticketsw = 1;

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

	/*
	// query name based on loginid and empid
	$res10query="SELECT tblcontact.name_last, tblcontact.name_first FROM tbllogin LEFT JOIN tblcontact ON tbllogin.employeeid=tblcontact.employeeid WHERE tbllogin.loginid=$loginid AND tbllogin.employeeid=\"$employeeid0\"";
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
	*/

	// query ticketnum from tblitsupportreq
	$res11query="SELECT tblitsupportreq.ticketnum, tblitsupportreq.actionctg FROM tblitsupportreq WHERE tblitsupportreq.ticketnum<>0 ORDER BY tblitsupportreq.ticketnum DESC LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11 + 1;
		$ticketnum11 = $myrow11['ticketnum'];
		$actionctg11 = $myrow11['actionctg'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

	// update query
	$res12query="UPDATE tblitsupportreq SET timestamp=\"$now\", loginid=$loginid, actionid=$loginid, actionempid=\"$employeeid0\", closeticketsw=$closeticketsw, closestamp=\"$now\" WHERE iditsupportreq=$iditsupportreq";
	$result12 = $dbh2->query($res12query);
	// echo "<p>res12query:$res12query</p>";

	// prepare email and send
	// compose message
		$to = $emailreq;
		$subject = "IT support request $ticketnum CLOSED";
		$message = "Dear $emailreq,\r\n\r\n";
		$message = $message . "The IT Support Request No. $ticketnum is now CLOSED.\r\n\r\n";
		if($actionctg11=='acc') {
		$message = $message . "Please don't forget to rate this support ticket by logging in again to the PKII Intranet > IT Support request and select the said ticket.\r\n\r\n";
		} else {
		$message = $message . "Please login to the PKII Intranet and click the IT support request sidebar link to check the details.\r\n\r\n";
		} // if($actionctg11=='acc')
		$message = $message . "Thank you very much.\r\n\r\n";
		$message = $message . "Note:\r\nThis is an auto-generated email from PKII Intranet's IT Support Request module.\r\n";
		$message = $message . "Please do not reply to this email.";

		include("itadmsuppreqsendmail.php");

	// echo "</pre></html>";

		// display result to requestor
		if($ok) {
			echo "<p>An e-mail notification was sent to: $to.</p>";
		} // if()

		// prepare and log		
		$logdetails = "$loginid:$username - IT support request - CLOSE ticket no. $ticketnum11 for support id:$iditsupportreq ctg:$requestctg11 details:$details11";
		$res17query = "INSERT INTO tbladminlogs SET timestamp=\"$now\", loginid=$loginid, adminuid=\"$username\", adminlogdetails=\"$logdetails\"";
		$result17 = $dbh2->query($res17query);
		// echo "<br>$res17query</p>";

	// redirect
	//header("Location: itsuppreq.php?loginid=$loginid");
	// exit;

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
