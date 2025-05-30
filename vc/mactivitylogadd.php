<?php
// set get vars
$loginstat = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = trim((isset($_GET['sess'])) ? $_GET['sess'] :'');
$page = trim((isset($_GET['p'])) ? $_GET['p'] :'');


echo $session;
// set post vars
$idlogin = (isset($_POST['idlogin'])) ? $_POST['idlogin'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$actdate = (isset($_POST['actdate'])) ? $_POST['actdate'] :'';
$endactdate = (isset($_POST['endactdate'])) ? $_POST['endactdate'] :'';

$actdetails = (isset($_POST['actdetails'])) ? $_POST['actdetails'] :'';
$projcode = trim((isset($_POST['prjcd'])) ? $_POST['prjcd'] :'');


$timestarthh = (isset($_POST['tmstarthh'])) ? $_POST['tmstarthh'] :'';
$timestartmm = (isset($_POST['tmstartmm'])) ? $_POST['tmstartmm'] :'';
$timestartampm = (isset($_POST['tmstartampm'])) ? $_POST['tmstartampm'] :'';


if($timestarthh!='') {
	// compose datetime format
	if($timestartampm=='pm') {
		if($timestarthh!='12') {
		$timestarthh=$timestarthh+12;			
		} //if
	} //if
	if($timestartmm=='') { $timestartmm='00'; }
	$timestart = date('Y-m-d H:i:s', strtotime($actdate.' '.$timestarthh.':'.$timestartmm.':00'));
} else {
	$timestart='0000-00-00 00:00:00';
} //if-else


$timeendhh = (isset($_POST['tmendhh'])) ? $_POST['tmendhh'] :'';
$timeendmm = (isset($_POST['tmendmm'])) ? $_POST['tmendmm'] :'';
$timeendampm = (isset($_POST['tmendampm'])) ? $_POST['tmendampm'] :'';
if($timeendhh!='') {
	// compose datetime format
	if($timeendampm=='pm') {
		if($timeendhh!='12') {
		$timeendhh=$timeendhh+12;			
		} //if
	} // if
	if($timeendmm=='') { $timeendmm='00'; }
	$timeend = date('Y-m-d H:i:s', strtotime($actdate.' '.$timeendhh.':'.$timeendmm.':00'));
} else {
	$timeend='0000-00-00 00:00:00';
} //if-else
if(strtotime($timestart)>strtotime($timeend)) {
	$timestart=$timestart; $timeend=$timestart;
} //if




if($actdetails!='') {
	// insert time log first


	require '../includes/dbh.php';
	$actdetails = $actdetails;

	include '../m/qrymactlogadd.php';

	// create log
	$logdetails = "$username0 add new activity log for date:$actdate";
	include '../m/qryinslog.php';
var_dump($res12query);
} // if

echo $current_date . "<br>"; 
if(isset($update_query)!='' || isset($insert_query) != '') {

	session_start();
	$_SESSION['addsuccess'] = true;
	header('Location: index.php?lst=1&lid=' . $loginid . '&sess=' . $session . '&p=14');

	$res12aquery="SELECT username FROM tbllogin WHERE loginid=$idlogin";
					
	$result12a=$dbh->query($res12aquery);
	if($result12a->num_rows>0) {
		while($myrow12a=$result12a->fetch_assoc()) {

			$username12a = $myrow12a['username'];
		} // while
	} // if

$logdetails = "add new activity log with id:$idinsert for date:$current_date";
include '../m/qryinslog.php';




} else {
	header('Location: index.php?lst=1&lid=' . $loginid . '&sess=' . $session . '&p=14');

	echo '<h4 class="modal-title" id="myModalLabel" class="text-danger"><font color="red">Error in saving activity log</font>';
	echo '</h4>';

} // if 

?>