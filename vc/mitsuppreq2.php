<?php
//
// mitsuppreq2.php
// fr: vc/index.php
// indexlinks: $page==342x

require '../includes/config.inc';
include '../includes/genranchars.php';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$iditsupportreq = (isset($_POST['idsr'])) ? $_POST['idsr'] :'';
$approverempid = (isset($_POST['approver'])) ? $_POST['approver'] :'';
$actor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';
$requestctr = (isset($_POST['requestctr'])) ? $_POST['requestctr'] :'';
$approvectr = (isset($_POST['approvectr'])) ? $_POST['approvectr'] :'';

if($iditsupportreq=='') {
$stamprequest = (isset($_POST['stamprequest'])) ? $_POST['stamprequest'] :'';
$requestorempid = (isset($_POST['requestorempid'])) ? $_POST['requestorempid'] :'';
$deptcd = (isset($_POST['deptcd'])) ? $_POST['deptcd'] :'';
$requestcd = (isset($_POST['requestcd'])) ? $_POST['requestcd'] :'';
$details = (isset($_POST['details'])) ? $_POST['details'] :'';
$approver = (isset($_POST['approver'])) ? $_POST['approver'] :'';
} // if

//20240320
$apprdurationsw = (isset($_POST['apprdurationsw'])) ? $_POST['apprdurationsw'] :'';
$apprdurationdt = (isset($_POST['apprdurationdt'])) ? $_POST['apprdurationdt'] :'';
if($apprdurationsw=="on") { $apprdurationswfin=1; $apprdurationdtfin=$apprdurationdt; } else { $apprdurationswfin=0; $apprdurationdtfin=""; }

if($iditsupportreq!='') {

	// query tblsupportreq
	include '../m/qrymitsuppreq5.php';
	// query requestor
	include '../m/qrymitsuppreq6.php';
	// query approver
	include '../m/qrymitsuppreq8a.php';

	if($actor=="REQ") {
		if($requestctr==1) {
		$requestctrfin = $requestctr16 + $requestctr;
		// update query
		include '../m/qrymitsuppreq10a.php';
		// prep email
		// set addressee
		if($contact_gender17=='Male') {
		$directaddr="Sir"; $directaddr2="his";
		} else if($contact_gender17=="Female") {
		$directaddr="Madam"; $directaddr2="her";
		} // if
		// compose message
		$to = $email118a;
		$subject = "FF-UP: IT support request for approval from $deptcd16 dept";
		$message = "Dear $directaddr,\r\n\r\n";
		$message = $message . "A follow-up request for IT technical support from $employeeid16 - $name_last17, $name_first17 - $empposition17 is asking for your approval.\r\n\r\n";
		$message = $message . "Please login to the PKII Intranet and click the IT support request sidebar link to approve or deny the request.\r\n\r\n";
		$message = $message . "Thank you very much.\r\n\r\n";
		$message = $message . "Note:\r\nThis is an auto-generated email from PKII Intranet's IT Support Request module.\r\n";
		$message = $message . "Please do not reply to this email. The IT support request module has the facility to provide input fields for comments and/or clarifications.";
		// send e-mail to approver
		include './fncsendmail.php';
		// insert log
		$logdetails = "Ff-up request for an IT support is for approval dept:$deptcd empids:$requestorempid-to-$approver req:$requestcd tbl:tblitsupportreq id:$iditsupportreq";
		include '../m/qryinslog.php';
		} // if($resquestctr==1)

	} else if($actor=="APP") {
		if($approvectr==1) {
		// increment approvectr
		$approvectrfin = $approvectr16 + $approvectr;
		// get loginid as approveid and employeeid as approveempid, update record
		include '../m/qrymitsuppreq10b.php';
		// set addressee
		if($contact_gender18a=='Male') {
		$directaddr="Sir"; $directaddr2="his";
		} else if($contact_gender18a=="Female") {
		$directaddr="Madam"; $directaddr2="her";
		} // if
		// compose message
		$to = $email117;
		$subject = "IT support request APPROVED";
		$message = "Dear $name_last15, $name_first15,\r\n\r\n";
		$message = $message . "Your request for an IT Support: $requestctgnamefin is approved by $name_last14, $name_first14.\r\n\r\n";
		$message = $message . "Please login to the PKII Intranet and click the IT support request sidebar link to check on the status of your request.\r\n\r\n";
		$message = $message . "Thank you very much.\r\n\r\n";
		$message = $message . "Note:\r\nThis is an auto-generated email from PKII Intranet's IT Support Request module.\r\n";
		$message = $message . "Please do not reply to this email. The IT support request module has the facility to provide input fields for comments and/or clarifications.";
		// send e-mail to requestor
		include './fncsendmail.php';
		// prep email for support@philkoei.com.ph
		$to = "support@philkoei.com.ph";
		$subject = "New IT support request $employeeid16 - $deptcd16 - $now";
		$message = "Dear ITD,\r\n\r\n";
		$message = $message . "An approved IT Tech Support Request is pending. IT Support: $requestctgnamefin has been requested by $employeeid16 $name_last17, $name_first17 - $empposition17 and approved by $name_last18a, $name_first18a.\r\n\r\n";
		$message = $message . "Please login to the PKII Intranet and click the IT support request sidebar link to check on the status of your request.\r\n\r\n";
		$message = $message . "Thank you very much.\r\n\r\n";
		$message = $message . "Note:\r\nThis is an auto-generated email from PKII Intranet's IT Support Request module.\r\n";
		$message = $message . "Please do not reply to this email. The IT support request module has the facility to provide input fields for comments and/or clarifications.";
		// send e-mail to support@philkoei.com.ph
		include './fncsendmail.php';
		// insert log
		$logdetails = "IT support request APPROVED. Request: $requestctg19 - $requestctgnamefin; dept:$deptcd19 empids:$employeeid19-to-$approveempid19 tbl:tblitsupportreq id:$iditsupportreq";
		include '../m/qryinslog.php';
		} // if($approvectr==1)

	} // if

} else {
	//
	// start new support request with insert query
	//
	$requestctr=0;
	$approvectr=0;
	$approveid=0;
	$approvestamp="0000-00-00 00:00:00";
	$actionctr=0;
	$actionid=0;
	$closeticketsw=0;
	$closestamp="0000-00-00 00:00:00";

	if($requestctr==1) {
		$requestctr = $requestctr + 1;
	} // if($requestctr==1)

	// prep requestcd array
	foreach($requestcd as $val1 => $n1) {
		$requestcdfin = $requestcdfin . $requestcd[$val1] . "|";
	} // foreach
	// insert tblitsupportreq and get id
	include '../m/qrymitsuppreq7.php';
	// insert tblsession and get id
	include '../m/qrymitsuppreq14.php';

	$employeeid16=$requestorempid;
	// query requestor
	include '../m/qrymitsuppreq6.php';
	$approveempid16=$approver;
	// query approver
	include '../m/qrymitsuppreq8a.php';

	// set addressee
	if($contact_gender18a=='Male') {
	$directaddr="Sir"; $directaddr2="his";
	} else if($contact_gender18a=="Female") {
	$directaddr="Madam"; $directaddr2="her";
	} // if

	// prep email for approver
	// compose message
	$to = $email118a;
	$subject = "IT support request for approval from $deptcd dept";
	$message = "Dear $directaddr,\r\n\r\n";
	$message = $message . "A request for IT technical support from $requestorempid $name_last17, $name_first17 - $empposition17 is asking for your approval.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the IT support request sidebar link to approve or deny the request.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from PKII Intranet's IT Support Request module.\r\n";
	$message = $message . "Please do not reply to this email. The IT support request module has the facility to provide input fields for comments and/or clarifications.";
	// send e-mail to approver
	include './fncsendmail.php';
	// insert log
	$logdetails = "New IT support request has been logged and for approval dept:$deptcd empids:$requestorempid-to-$approver req:$requestcdfin tbl:tblitsupportreq id:$iditsupportreq";
	include '../m/qryinslog.php';

} // if($iditsupportreq!='')

include "../m/qrymitsuppreq5.php";

// Convert $apprdurationsw to DateTime object
$approvalDateTime = new DateTime($apprdurationdt);

// Calculate expiration date
$expirationDate = clone $approvalDateTime;
$expirationDate->modify('+2 days');
$currentDate = new DateTime();

// Compare expiration date with current date
$twoDaysBeforeExpiration = clone $expirationDate;
$twoDaysBeforeExpiration->modify('-2 days');

if ($currentDate >= $twoDaysBeforeExpiration) {
    // If current date is less than two days before expiration, send email notification
    $to = "support@philkoei.com.ph";
    $subject = "IT support request approval date";
	$message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>
<body style='font-family: Arial, sans-serif; background-color: #4A1A1A; color: white; margin: 0; padding: 0; text-align: center;'>

    <div style='background: linear-gradient(to bottom,  #6C3737, #602828, #320505); padding: 20px; border-radius: 10px; width: 60%; margin: auto; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);'>

        <table width='100%' cellspacing='0' cellpadding='0' style='border-spacing: 0;'>
            <tr>
                <td style='padding: 20px; text-align: left; vertical-align: middle;'>
                    <p>Tech Support Ticket Expiry.</p>
                    <p style='font-size: 1.5em; font-weight: bolder; background: linear-gradient(90deg, #FBFBFB, #99D2F5, #7E96F6, #7BA6FE, #ccb0f3); -webkit-background-clip: text; -webkit-text-fill-color: transparent;'>Reminder for IT Department.</p>
                    
                    <p>An IT Support request from <strong>($requestorempid) $name_last17, $name_first17 - $empposition17</strong> is about to expire on <strong>" . $approvalDateTime->format('Y-m-d') . "</strong>.</p> 
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
  


    // Send email using your existing function or method
    include './fncsendmail.php'; // You can reuse this code for sending emails
    // sendMail($to, $subject, $message);
	  // $message = "Dear ITD,\r\n\r\n";
    // $message .= "An IT Support request is about to expire. Please review Ticket number $ticketnum16. Date: " . $approvalDateTime->format('Y-m-d') . ".\r\n\r\n";
    // $message .= "Thank you very much.\r\n\r\n";
    // $message .= "Note:\r\nThis is an auto-generated email from PKII Intranet's IT Support Request module.\r\n";
    // $message .= "Please do not reply to this email. The IT support request module has the facility to provide input fields for comments and/or clarifications.";
}

// redirect
// header("Location: index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&srid=$iditsupportreq");
// exit;
	echo "<p>$res20bquery<br>";
  // echo "lst:$lst,lid:$loginid,sess:$session,pg:$page,idsr:$iditsupportreq,appeid:$approverempid,actor:$actor,reqctr:$requestctr,appctr:$approvectr,reqeml:$email117<br>";
	// if($ok!='') {	echo "$ok<br>"; }
	// echo "$emlmsg<br>";
	// echo "to:$to, subj:$subject, msg:$message, mlhdr:$mailheader<br>";


	// redirect

	header("Location: index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&srid=$iditsupportreq&approved=true");
	exit;

?>