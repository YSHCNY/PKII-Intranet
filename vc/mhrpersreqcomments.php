<?php
//
// mhrpersreqcomments.php
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
$actorempid0 = (isset($_POST['actorempid'])) ? $_POST['actorempid'] :'';

$comments = (isset($_POST['comments'])) ? $_POST['comments'] :'';

//
// notes on actors
// REQ - requestor
// END - endorser (HR mngr)
// REC - recommending approver (VP)
// APP - approver (Pres)
// 

if($idhrpersreq!='') {

	// query tblhrpersreq based on id
	include '../m/qryhrpersreqid.php';

	// query actor's name
	$actorempid=$actorempid0;
	include '../m/qryhrpersreqactor.php';
	$actorempid="";

	// compose comments post and queried comments
	$commentsfin = $name_last12 . ", " . $name_first12 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $comments . "\r\n\r\n" . $comments11;

	// update query
	include '../m/qryhrpersrequpd05.php';

	//
	// prep and send e-mails
	//

	// for requestor
	if($actor!='REQ' && $requestedbyempid11!='') {
	// query requestor's e-mail
	$actorempid=$requestedbyempid11;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";
	// compose msg to requestor
	$to = $email114;
	$subject = "HR Personnel Request from $deptcd11 dept";
	$message = "Dear ,\r\n\r\n";
	$message = $message . "A comment/clarification for the requested position: $position11 has been submitted by $name_last14, $name_first14.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the HR Personnel Request sidebar link to read the submitted comment/clarification.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII intranet system.\r\n";
	$message = $message . "Please do not reply to this email. The HR personnel request module has the facility to provide input fields for comments and/or clarifications.";
	// sendmail
	include './fncsendmail.php';
	} // if

	// for endorser
	if($actor!='END' && $endorseempid11!='') {
	// query endorser's e-mail
	$actorempid=$endorseempid11;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";
	// compose msg to requestor
	$to = $email114;
	$subject = "HR Personnel Request from $deptcd11 dept";
	$message = "Dear ,\r\n\r\n";
	$message = $message . "A comment/clarification for the requested position: $position11 has been submitted by $name_last14, $name_first14.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the HR Personnel Request sidebar link to read the submitted comment/clarification.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII intranet system.\r\n";
	$message = $message . "Please do not reply to this email. The HR personnel request module has the facility to provide input fields for comments and/or clarifications.";
	// sendmail
	include './fncsendmail.php';
	} // if

	// for recommending approvers
	if($actor!='REC') {
		if($recoappricgempid11!='') {
	// query recoappricg's e-mail
	$actorempid=$recoappricgempid11;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";
	// compose msg to requestor
	$to = $email114;
	$subject = "HR Personnel Request from $deptcd11 dept";
	$message = "Dear ,\r\n\r\n";
	$message = $message . "A comment/clarification for the requested position: $position11 has been submitted by $name_last14, $name_first14.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the HR Personnel Request sidebar link to read the submitted comment/clarification.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII intranet system.\r\n";
	$message = $message . "Please do not reply to this email. The HR personnel request module has the facility to provide input fields for comments and/or clarifications.";
	// sendmail
	include './fncsendmail.php';
		} // if
		if($recoapprdcgempid11!='') {
	// query recoappricg's e-mail
	$actorempid=$recoapprdcgempid11;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";
	// compose msg to requestor
	$to = $email114;
	$subject = "HR Personnel Request from $deptcd11 dept";
	$message = "Dear ,\r\n\r\n";
	$message = $message . "A comment/clarification for the requested position: $position11 has been submitted by $name_last14, $name_first14.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the HR Personnel Request sidebar link to read the submitted comment/clarification.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII intranet system.\r\n";
	$message = $message . "Please do not reply to this email. The HR personnel request module has the facility to provide input fields for comments and/or clarifications.";
	// sendmail
	include './fncsendmail.php';
		} // if
	} // if

	// for approvers
	if($actor!='APP' && $approveempid11!='') {
	// query recoappricg's e-mail
	$actorempid=$approveempid11;
	include '../m/qryhrpersreqactor2.php';
	$actorempid="";
	// compose msg to requestor
	$to = $email114;
	$subject = "HR Personnel Request from $deptcd11 dept";
	$message = "Dear ,\r\n\r\n";
	$message = $message . "A comment/clarification for the requested position: $position11 has been submitted by $name_last14, $name_first14.\r\n\r\n";
	$message = $message . "Please login to the PKII Intranet and click the HR Personnel Request sidebar link to read the submitted comment/clarification.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII intranet system.\r\n";
	$message = $message . "Please do not reply to this email. The HR personnel request module has the facility to provide input fields for comments and/or clarifications.";
	// sendmail
	include './fncsendmail.php';
	} // if

	//
	// prepare and log
	$logdetails = "HR personnel request comments submitted by $actorempid0 for dept:$deptcd11 requested by $requestedbyempid11 with position:$position11 and id:$idhrpersreq";
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
			<h4 class="text-success">Comments/clarification saved. E-mail notifications has been sent to all concerned.<br>Thank you.</h4>
<?php
	} else {
?>
			<h4 class="text-danger">Comments/clarifications saved. E-mail notifications all concerned has failed. Please inform them manually.<br>Sorry for the inconvenience.</h4>
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
