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

$idhrpersreq = (isset($_POST['idpr'])) ? $_POST['idpr'] :'';
$requestdate = (isset($_POST['requestdate'])) ? $_POST['requestdate'] :'';
$emptyp = (isset($_POST['emptyp'])) ? $_POST['emptyp'] :'';
$emptypothr = (isset($_POST['emptypothr'])) ? $_POST['emptypothr'] :'';
$positioncd = (isset($_POST['positioncd'])) ? $_POST['positioncd'] :'';
$deptcd = (isset($_POST['deptcd'])) ? $_POST['deptcd'] :'';
$reportstoposcd = (isset($_POST['reportstoposcd'])) ? $_POST['reportstoposcd'] :'';
$posfillempid = (isset($_POST['posfillempid'])) ? $_POST['posfillempid'] :'';
$posfilltyp = (isset($_POST['posfilltyp'])) ? $_POST['posfilltyp'] :'';
$posfillothr = (isset($_POST['posfillothr'])) ? $_POST['posfillothr'] :'';
$staffneeded = (isset($_POST['staffneeded'])) ? $_POST['staffneeded'] :'';
$jobdescresp = (isset($_POST['jobdescresp'])) ? $_POST['jobdescresp'] :'';
$jobdescduties = (isset($_POST['jobdescduties'])) ? $_POST['jobdescduties'] :'';
$dateneedtyp = (isset($_POST['dateneedtyp'])) ? $_POST['dateneedtyp'] :'';
$dateneeded = (isset($_POST['dateneeded'])) ? $_POST['dateneeded'] :'';
$remarks = (isset($_POST['remarks'])) ? $_POST['remarks'] :'';
$requestorempid = (isset($_POST['requestorempid'])) ? $_POST['requestorempid'] :'';
$endorseempid = (isset($_POST['endorseempid'])) ? $_POST['endorseempid'] :'';
$actor = (isset($_POST['actor'])) ? $_POST['actor'] :'';

if($dateneedtyp=='asap') {
	$dateneededfin="";
} else if($dateneedtyp=='date') {
	$dateneededfin=date("Y-m-d H:i:s", strtotime($dateneeded));
} // if($dateneedtyp=='asap')

// convert integer to varchar
$positioncd = strval($positioncd);

//
// notes on actors
// REQ - requestor
// END - endorser (HR mngr)
// REC - recommending approver (VP)
// APP - approver (Pres)
// 

	// prep session remarks
	$sessrem="HR personnel request form for endorsement to:$endorseempid requested by:$requestorempid position:$positioncd id:$idhrpersreq\"";

if($idhrpersreq!='') {

	// query tblhrpersreq based on id
	include '../m/qryhrpersreqid.php';

	// declare variables
	$requestctr=$requestctr11;
	$endorsectr=$endorsectr11;
	$recoappricgctr=$recoappricgctr11;
	$recoapprdcgctr=$recoapprdcgctr11;
	$approvectr=$approvectr11;
	$endorsedate=$endorsedate11;
	$recoappricgdate=$recoappricgdate11;
	$recoapprdcgdate=$recoapprdcgdate11;
	$approvedate=$approvedate11;
	$recoappricgempid=$recoappricgempid11;
	$recoapprdcgempid=$recoapprdcgempid11;
	$approveempid=$approveempid11;
	$comments=$comments11;

	// increment requestctr
	$requestctr = $requestctr + 1;

	// update query
	include '../m/qryhrpersrequpd.php';

} else { // if($idhrpersreq!='')

// set now
$nowfin = "$datenow 00:00:00";
if(strtotime($requestdate)>=strtotime($nowfin)) {

	// declare and reset variables
	$requestctr=0;
	$endorsectr=0;
	$recoappricgctr=0;
	$recoapprdcgctr=0;
	$approvectr=0;
	$endorsedate="0000-00-00 00:00:00";
	$recoappricgdate="0000-00-00 00:00:00";
	$recoapprdcgdate="0000-00-00 00:00:00";
	$approvedate="0000-00-00 00:00:00";
	$recoappricgempid='';
	$recoapprdcgempid='';
	$approveempid='';
	$comments='';

	// log session
	include '../m/qrysessins.php';

	// increment requestctr
	$requestctr = $requestctr + 1;

	// insert query
	include '../m/qryhrpersreqins.php';

} // if($idhrpersreq!='')

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

} // if

// redirect
header("Location: index.php?lst=$lst&lid=$loginid&sess=$session&p=$page&prid=$idhrpersreq");
exit;

// echo "<p>vartest nw:".date("Y-M-d H:i:s", strtotime($now))." | reqdt:".date("Y-M-d H:i:s", strtotime($requestdate))." | dtnw:".date("Y-M-d H:i:s", strtotime($datenow))." | nwfn:".date("Y-M-d H:i:s", strtotime($nowfin))." </p>";

?>
