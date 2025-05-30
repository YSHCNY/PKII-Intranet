<?php
//
// mhrlvfrmreq3.php
// fr ./mhrlvreqdetails.php or ./index.php?lst=1&lid=$loginid&sess=$session&p=368
//



$lst = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = (isset($_GET['sess'])) ? $_GET['sess'] :'';

$id = (isset($_POST['lvrid'])) ? $_POST['lvrid'] :'';
$daysapproved = (isset($_POST['daysapproved'])) ? $_POST['daysapproved'] :'';
$idhrtalvreq = (isset($_POST['idhrtalvreq'])) ? $_POST['idhrtalvreq'] :'';
$apprctr = (isset($_POST['apprctr'])) ? $_POST['apprctr'] :'';
$statusta = (isset($_POST['statusta'])) ? $_POST['statusta'] :'';
$leavedate = (isset($_POST['leavedate'])) ? $_POST['leavedate']:'';
$endleave = (isset($_POST['endleave'])) ? $_POST['endleave']:'';
$lcode = (isset($_POST['lcode'])) ? $_POST['lcode']:'';
$leaveid = (isset($_POST['leaveid'])) ? $_POST['leaveid']:'';


$leavedur = (isset($_POST['daysapproved'])) ? $_POST['daysapproved']:'';

$requestorid = (isset($_POST['requestorid'])) ? $_POST['requestorid']:'';
// echo "<h1>$leavedate - $endleave, $leavetype  $leaveid </h1>";
if($statusta==2) { $daysapproved=0; }

if($id!='') {


  // query tblhrtalvreq based on id
  include '../m/qryhrtalvreqselid.php';
  if($daysapproved=='' && $statusta!=2) {
    if($durationfrom11==$durationto11) {
      $daysapproved=1;
    } else {
      // compute days
      $daysapproved=(strtotime($durationto11) - strtotime($durationfrom11))/(60*60*24);
    } // if
  } // if
  // update query

  include '../m/qryhrtalvrequpdid.php';

  // echo "<p class='text-align: left;'>statusta:$statusta<br>qry11:$res11query<br>qry12:$res12query</p>";

	// query requestor details
	$employeeid16 = $employeeid11;
	include '../m/qrymitsuppreq6.php';

  // query hrd noters
  $deptcd16="HRD";
  include '../m/qrmitsuppreq8b.php';
  include '../m/qrmitsuppreq8c.php';
  include '../m/qrmitsuppreq8d.php';

  ?>


<div class = 'container p-5'>
	<div class = 'border shadow rounded-4 p-5 m-5'>
<?php
  if($apprctr==1) {

    if($statusta==1) {
//   echo "$lcode----$leavedur---$daysapproved";
//   echo "<h3 class='text-success'>Leave request APPROVED.</h3>";

      $logdetails="APPROVED Leave request for id:$id type:$idhrtaleavectg11 from $employeeid11, by $employeeid0. E-mails sent to requestor and noter.";

  // set emails to requestor and noter

	// reset variables
	// $to=""; $subject=""; $message=""; $emlmsg="";
	// prep email for requestor
	// $to = "$email117";
	$subject = "Approved Overtime/Leave Request";
	$message = "Dear $name_first17,\r\n\r\n";
	$message = $message . "An overtime or leave request has been approved by your supervisor/manager.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII Intranet System.\r\n";
	$message = $message . "Please do not reply to this email. The OT/Leave request module in our intranet has the facility to add comments and/or clarifications.";
	// send email
//   include './fncsendmail.php';
  //echo "<p>msg_to_req:<br>$to<rb>$subject<br>$message</p>";

	// reset variables
	// $to=""; $subject=""; $message=""; $emlmsg="";
	// prep email for noter
	$to = "$email118c, $email118d";
	$subject = "Approved OT/Leave to be Noted";
	$message = "Dear HRD,\r\n\r\n";
	$message = $message . "An overtime or leave request has been approved by the dept's supervisor/manager and needs to be NOTED to include such request on the next payroll cutoff computation.\r\n\r\n";
	$message = $message . "Thank you very much.\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII Intranet System.\r\n";
	$message = $message . "Please do not reply to this email. The OT/Leave request module in our intranet has the facility to add comments and/or clarifications.";
	// send email
	// include './fncsendmail.php';
  // echo "<p>msg_to_notr:<br>$to<rb>$subject<br>$message</p>";


$messageAppr = "Success! Leave Approved!";
$_SESSION['leaveappr'] = $messageAppr;

echo "<script>
    window.location.href = 'index.php?lst=1&lid=$loginid&sess=$session&p=36&lvid=$id';
</script>";

    } else if($statusta==2) {

//   echo "<h3 class='text-danger'>Leave request DENIED.</h3>";

      $logdetails="DISAPPROVED Leave request for id:$id type:$idhrtaleavectg11 from $employeeid11, by $employeeid0. E-mail sent to requestor";

	// reset variables
	$to=""; $subject=""; $message=""; $emlmsg="";
	// prep email for requestor
	$to = "$email117";
	$subject = "Denied Overtime/Leave Request";
	$message = "Dear $name_first17,\r\n\r\n";
	$message = $message . "Sorry, your overtime or leave request has been denied by your supervisor/manager.\r\n\r\n";
	$message = $message . "Thank you and better luck next time :)\r\n\r\n";
	$message = $message . "Note:\r\nThis is an auto-generated email from the PKII Intranet System.\r\n";
	$message = $message . "Please do not reply to this email. The OT/Leave request module in our intranet has the facility to add comments and/or clarifications.";
	// send email
	// include './fncsendmail.php';
  // echo "<p>msg_to_req:<br>$to<rb>$subject<br>$message</p>";
  $messageDenied = "Leave Denied!";
$_SESSION['warning_message'] = $messageDenied;
echo "<script>
    window.location.href = 'index.php?lst=1&lid=$loginid&sess=$session&p=36&lvid=$id';
</script>";
exit;
    } // if-else

  // insert logs
  include '../m/qryinslog.php';
  // echo "<p>logdtl:$logdetails</p>";

  } //

  echo "<script>
  window.location.href = 'index.php?lst=1&lid=$loginid&sess=$session&p=36&lvid=$id';
</script>";


}
  
?>
</div></div>