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
