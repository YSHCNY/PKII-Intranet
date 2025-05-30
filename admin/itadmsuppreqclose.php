<?php
// from itadmsuppreqdtl.php
session_start();
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
	
		// if($actionctg11=='acc') {
		// $textthis = "Please don't forget to rate this support ticket by logging in again to the PKII Intranet > IT Support request and select the said ticket.";
		// } else {
		// $textthis = "Please login to the PKII Intranet and click the IT support request sidebar link to check the details.";
		// } // if($actionctg11=='acc')
	

		$message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body style='font-family: Arial, sans-serif; background-color: #1a2a4a; color: white; margin: 0; padding: 0; text-align: center;'>

    <div style='background: linear-gradient(to bottom, #314263, #283A60, #0D1F46); padding: 20px; border-radius: 10px; width: 60%; margin: auto; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);'>

        <table width='100%' cellspacing='0' cellpadding='0' style='border-spacing: 0;'>
            <tr>
                <td style='padding: 20px; text-align: left; vertical-align: middle;'>
                    <p>Intranet Ticket <strong>#$ticketnum</strong> closed.</p>
                    <p style='font-size: 1.5em; font-weight: bolder; background: linear-gradient(90deg, #FBFBFB, #99D2F5, #7E96F6, #7BA6FE, #ccb0f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent;'>Hello $emailreq,</p>
                    
                    <p>Kindly take a moment to rate this support ticket by logging into the PKII Intranet:</p>
                    <p><a href='http://intranet.philkoei.com.ph' style='color: lightblue; text-decoration: none; font-weight: bold;'>intranet.philkoei.com.ph</a></p>
                    <p>Your feedback helps us improve our service.</p>
                    <p>Thank you for your time and support.</p>
                </td>

                <td style='text-align: center; vertical-align: middle; padding: 20px;'>
                    <img src='https://www.philkoei.com.ph/wp-content/uploads/2020/09/PKII-LOGO.png' alt='PKII Logo' style='max-width: 100%; height: auto;'>
                </td>
            </tr>
        </table>

        <p style='font-size: 12px; color: #fff; margin-top: 20px; font-style: italic; text-align: center;'>Note: This is an auto-generated email from the PKII Intranet IT Support Request module.</p>
    </div>

</body>
</html>";

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

	
	$message = "<b>Ticket Succesfully Closed</b>";
	$_SESSION['message'] = $message;


	echo '<script>';
	echo 'window.location.href = "itadmsuppreqdtl.php?loginid=' . $loginid . '&its=' . $iditsupportreq . '";';
	echo '</script>';
		exit; 

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
