<?php
//
// mhrpersreqrerequest.php
// fr: vc/mhrpersreqdtl.php
// indexlinks: $page==352

require '../includes/config.inc';
include '../includes/genranchars.php';

$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';
$page = (isset($_GET['p'])) ? $_GET['p'] :'';

$idhrpersreq = (isset($_POST['idpr'])) ? $_POST['idpr'] :'';
$actor = (isset($_POST['actor'])) ? $_POST['actor'] :'';
$dispsumm = (isset($_POST['ds'])) ? $_POST['ds'] :'';

//
// notes on actors
// REQ - requestor
// END - endorser (HR mngr)
// REC - recommending approver (VP)
// APP - approver (Pres)
// 

	// prep session remarks
	$sessrem="HR personnel request form for re-endorsement to:$endorseempid as requested by:$requestorempid id:$idhrpersreq\"";

if($idhrpersreq!='') {

	// query tblhrpersreq based on id
	include '../m/qryhrpersreqid.php';

	// declare variables
	$deptcd=$deptcd11;
	$requestorempid=$requestedbyempid11;
	$requestctr=$requestctr11;
	$endorsectr=$endorsectr11;
	$recoappricgctr=$recoappricgctr11;
	$recoapprdcgctr=$recoapprdcgctr11;
	$approvectr=$approvectr11;
	$endorseempid=$endorseempid11;
	$endorsedate=$endorsedate11;
	$recoappricgdate=$recoappricgdate11;
	$recoapprdcgdate=$recoapprdcgdate11;
	$approvedate=$approvedate11;
	$recoappricgempid=$recoappricgempid11;
	$recoapprdcgempid=$recoapprdcgempid11;
	$approveempid=$approveempid11;
	$comments=$comments11;

	if($found11==1) {

	// increment requestctr
	$requestctr = $requestctr + 1;

	// update query
	include '../m/qryhrpersrequpd01.php';

	} // if

	//
	// prepare and send mail notification
	//

	// query requestor
	$actorempid=$requestorempid;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";

	// query endorser
	$actorempid=$endorseempid;
	include '../m/qryhpersreqactor.php';
	$actorempid="";

	if($contact_gender12=='Male') {
		$directaddr="Sir"; $directaddr2="his";
	} else if($contact_gender12=='Female') {
		$directaddr="Madam"; $directaddr2="her";
	} else {
		$directaddr="Sir/Madame"; $directaddr2="his/her";
	} // if

	// compose msg
	$to = $email112;
	$subject = "HR Personnel Request from $deptcd dept";
	$message = "Dear $directaddr,\r\n\r\n";
	$message = $message . "A personnel requisition request by $requestorempid $name_last14, $name_first14 - $empposition14 is asking for your endorsement.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the HR Personnel Request sidebar link to endorse or deny the request.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII intranet system.\r\n";
	$message = $message . "Please do not reply to this email. The HR personnel request module has the facility to provide input fields for comments and/or clarifications.";
	include './fncsendmail.php';

	//
	// prepare and log
	$logdetails = "new HR personnel request for endorsement dept:$deptcd empids:$requestorempid-to-$endorseempid position:$positioncd id:$idhrpersreq";
	include '../m/qryinslog.php';

} // if($idhrpersreq!='')
?>
<!-- display confirmation page -->
<?php include './header.php'; ?>
<div class="container1">
	<!-- <div class="wrapper"> -->
		<div class="form-group">
			<h3>HR Personnel Requisition</h3>
		</div>
		<div class="form-group">
<?php
	if($ok) {
?>
			<h4 class="text-success">Request for endorsement has been sent.<br>Thank you.</h4>
<?php
	} else {
?>
			<h4 class="text-danger">Notification to endorser has failed. Please inform manually.<br>Sorry for the inconvenience.</h4>
<?php
	} // if
?>
		</div>
		<div class="form-group">
			<?php echo "<p><button type=\"submit\" class=\"btn btn-primary\" onclick=\"javascript:window.location='index.php?lst=1&lid=$loginid&sess=$session&p=35'\">Close</button></p>"; ?>
		</div>
	<!-- </div> -->
</div>
<?php include './footer.php'; ?>
<?php

// redirect
// header("Location: index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&prid=$idhrpersreq");
// exit;

?>