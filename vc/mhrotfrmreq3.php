<?php
//
// mhrotfrmreq3.php
// fr: vc/mhrotreqdetails.php
// indexlinks: $page==363

require '../includes/config.inc';
include '../includes/genranchars.php';
require '../includes/dbh.php';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';
$now = date('Y-m-d H:i:s');

// start modify all src codes below for hr otfrmreq2.
$idhrtaotreq = (isset($_POST['idhrtaotreq'])) ? $_POST['idhrtaotreq'] :'';
$reqctr = $_POST['reqctr'];
$apprctr = $_POST['apprctr'];

$approverempid = (isset($_POST['approver'])) ? $_POST['approver'] :'';
$actor = (isset($_POST['ctgactor'])) ? $_POST['ctgactor'] :'';
$requestctr = (isset($_POST['requestctr'])) ? $_POST['requestctr'] :'';
$approvectr = (isset($_POST['approvectr'])) ? $_POST['approvectr'] :'';

$requestorempid = (isset($_POST['requestorempid'])) ? $_POST['requestorempid'] :'';
$deptcd = (isset($_POST['deptcd'])) ? $_POST['deptcd'] :'';
$requestcd = (isset($_POST['requestcd'])) ? $_POST['requestcd'] :'';
$details = (isset($_POST['details'])) ? $_POST['details'] :'';
$approver = (isset($_POST['approver'])) ? $_POST['approver'] :'';
$dateapplic = date('Y-m-d H:i:s' , strtotime($_POST['dateapplic']));
$dateotreq = date('Y-m-d' , strtotime($_POST['stamprequest']));
$durationFrom0 = $dateotreq.' '.$_POST['durationFrom'].':'.$_POST['durationFrom1'].':00';
$durationTo0 = $dateotreq.' '.$_POST['durationTo'].':'.$_POST['durationTo1'].':00';
$durationFrom = date('Y-m-d H:i:s', strtotime($durationFrom0));
$durationTo = date('Y-m-d H:i:s', strtotime($durationTo0));
$idHrCutoff = 0;
$requestctr = 1;
$approverid = 0;



// close database
// var_dump($res18cquery);

	// insert query
	// $res12query="INSERT INTO tblhrtaotreq SET loginid=$loginid, timestamp=\"$now\", datecreated=\"$now\", createdby=\"$loginid\", 
	// dateotreq='".$dateotreq."', 
	// durationfrom='".$durationFrom."',
	// durationto='".$durationTo."',
	// requestorid='".$loginid."',
	// employeeid='".$requestorempid."',
	// deptcd='".$deptcd."',
	// reason='".$details."',
	// requestctr='".$requestctr."',
	// requeststamp='".$now."',
	// approverid='".$approverid."',
	// approverempid='".$approver."',
	// statusta=0";
	// idhrtaemptimelog=";

	$result12=""; $found12=0; $ctr12=0;
	$result12=$dbh->query($res12query);

	// query requestor details
	$employeeid16 = $requestorempid;
	include '../m/qrymitsuppreq6.php';

	// query approver details
	$approveempid16=$approver;
	include '../m/qrymitsuppreq8a.php';
	$emlapprover=$email118a;

	// set addressee
	if($contact_gender18a=="Male") {
		$directaddr="Sir"; $directaddr2="his";
	} else if($contact_gender18a=="Female") {
		$directaddr="Madame"; $directaddr2="her";
	} else {
		$directaddr="Sir/Madame"; $directaddr2="his/her";
	} // if

	// prep email fields and its contents for the approver
	$to = "$emlapprover";
	$subject = "Overtime/Leave Request for Approval";
	$message = "Dear $directaddr,\r\n\r\n";
	$message = $message . "An overtime or leave request has been filed by $employeeid16 - $name_last17, $name_first17 $name_middle17[0] - $empposition17 for your approval.\r\n";
	$message = $message . "Please login to the PKII Intranet and click on the OT/Leave request submenu link to approve or deny the request.\r\n\r\n";
	$message = $message . "Intranet link:\r\nhttps://intranet.philkoei.com.ph\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII Intranet System.\r\n";
	$message = $message . "Please do not reply to this email. The OT/Leave request module has the facility to add comments and/or clarifications.";

	// send email
	include './fncsendmail.php';
	$emlmsgstat1=$emlmsg;

	// reset variables
	$to=""; $subject=""; $message=""; $emlmsg="";

	// prep email for requestor
	$to = "$email117";
	$subject = "Overtime/Leave Request for Approval";
	$message = "Dear $name_first17,\r\n\r\n";
	$message = $message . "An overtime or leave request has been logged and for approval by your supervisor/manager.\r\n";
	$message = $message . "Please monitor the status of your request through the PKII Intranet system and also through e-mail notification.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII Intranet System.\r\n";
	$message = $message . "Please do not reply to this email. The OT/Leave request module has the facility to add comments and/or clarifications.";

	// send email
	include './fncsendmail.php';
	$emlmsgstat2=$emlmsg;

	// insert log
	$logdetails = "An OT/Leave request has been filed by $employeeid16 - $name_last17, $name_first17 $name_middle17 - $empposition17, and for approval by $name_last18a, $name_first18a $name_middle18a[0] - $empposition18a; sent e-mails to $email117 and $emlapprover";
	include '../m/qryinslog.php';		

// var_dump($res12query);

echo "Request for overtime submitted.<br>";
// echo "f18a:$found18a|addr:$directaddr|$emlmsgstat1 to approver<br>$emlmsgstat2 to requestor<br>";
// echo "$durationFrom0,$durationTo0<br>";
echo "<a class='btn btn-success' href=\"index.php?lst=1&lid=$loginid&sess=$session&p=36\"> Back</a>";

// close database
$dbh->close();
?>