<?php
//
// mhrpersreqendorse2.php
// fr: vc/mhrpersreqendorse.php
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
$endorseempid = (isset($_POST['endorseempid'])) ? $_POST['endorseempid'] :'';
$endorsectr = (isset($_POST['endorsectr'])) ? $_POST['endorsectr'] :'';
$requestedbyempid = (isset($_POST['requestedbyempid'])) ? $_POST['requestedbyempid'] :'';

$recoapprempid = (isset($_POST['recoapprempid'])) ? $_POST['recoapprempid'] :'';
$recoapprempidarr = explode('|', $recoapprempid);
$recoapprempid0 = $recoapprempidarr[0];
$recoapprempid1 = $recoapprempidarr[1];
if($recoapprempid1=="icg") {
	$recoappricgempid=$recoapprempid0; $recoapprdcgempid="";
} else if($recoapprempid1=="dcg") {
	$recoapprdcgempid=$recoapprempid0; $recoappricgempid="";
} // if

//
// notes on actors
// REQ - requestor
// END - endorser (HR mngr)
// REC - recommending approver (VP)
// APP - approver (Pres)
// 

	// prep session remarks
	$sessrem="HR personnel request endorsed by $endorseempid as requested by:$requestorempid id:$idhrpersreq\"";

if($idhrpersreq!='') {

	// query tblhrpersreq based on id
	include '../m/qryhrpersreqid.php';

	// declare variables
	$deptcd = $deptcd11;
	$endorsectr = $endorsectr11;

	if($found11==1) {

	// increment requestctr
	$endorsectr = $endorsectr + 1;

	// update query
	include '../m/qryhrpersrequpd02.php';

	} // if

	//
	// prepare and send mail notification
	//

	// query requestor
	$actorempid=$requestedbyempid;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";

	// query endorser
	$actorempid=$recoapprempid0;
	include '../m/qryhrpersreqactor.php';
	$actorempid="";

	if($contact_gender12=='Male') {
		$directaddr="Sir"; $directaddr2="his";
	} else if($contact_gender12=='Female') {
		$directaddr="Madam"; $directaddr2="her";
	} else {
		$directaddr="Sir/Madame"; $directaddr2="his/her";
	} // if

	// compose msg to requestor

	// sendmail

	//
	// query recommending approver (selected by endorser

	// compose msg to recommending approver
	$to = $email112;
	$subject = "HR Personnel Request from $deptcd dept";
	$message = "Dear $directaddr,\r\n\r\n";
	$message = $message . "A personnel requisition request by $requestorempid $name_last14, $name_first14 - $empposition14 is asking for your recommending approval after endorsement.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the HR Personnel Request sidebar link to endorse or deny the request.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII intranet system.\r\n";
	$message = $message . "Please do not reply to this email. The HR personnel request module has the facility to provide input fields for comments and/or clarifications.";
	// sendmail
	include './fncsendmail.php';

	//
	// prepare and log
	$logdetails = "Endorsed HR personnel request by $endorseempid for dept:$deptcd requested by $requestorempid with position:$positioncd and id:$idhrpersreq";
	include '../m/qryinslog.php';

} // if($idhrpersreq!='')
?>
<!-- display confirmation page -->
<?php include './header.php'; ?>
<div class="container1">
	<div class="wrapper">
		<div class="form-group">
			<h3>HR Personnel Requisition</h3>
		</div>
		<div class="form-group">
<?php
	if($ok) {
?>
			<h4 class="text-success">Endorsed. Request for recommending approval has been sent.<br>Thank you.</h4>
<?php
	} else {
?>
			<h4 class="text-danger">Endorsed. Notification to recommending approver has failed. Please inform manually.<br>Sorry for the inconvenience.</h4>
<?php
	} // if
?>
		</div>
		<div class="form-group">
			<button type="button" class="btn btn-primary" onclick="javascript:window.location='index.php?lst=1&lid=<?php echo $loginid; ?>&sess=<?php echo $session; ?>&p=352&prid=<?php echo $idhrpersreq; ?>&act=<?php echo $actor; ?>&d=<?php echo $dispsumm; ?>'">Close</button>
		</div>
<?php // echo "<div class=\"form-group\">id:$idhrpersreq, actor:$actor, ds:$dispsumm,endorseempid:$endorseempid, endorsectr:$endorsectr, reqempid:$requestedbyempid, recoapprempid:$recoapprempid<br>res11qry:$res11query<br>to:$to, subj:$subject, msg:$message</div>"; ?>
	</div>
</div>
<?php include './footer.php'; ?>
<?php

// redirect
// header("Location: index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&prid=$idhrpersreq");
// exit;

?>