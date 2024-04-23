<?php
// set get vars
$loginstat = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = trim((isset($_GET['sess'])) ? $_GET['sess'] :'');
$page = trim((isset($_GET['p'])) ? $_GET['p'] :'');

// set post vars
$idlogin = (isset($_POST['idlogin'])) ? $_POST['idlogin'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$actdate = (isset($_POST['actdate'])) ? $_POST['actdate'] :'';
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
	$actdetails = 'Logged:'.date('H:i', strtotime("now")).'&nbsp;-&nbsp;'.$actdetails;

	include '../m/qrymactlogadd.php';

	// create log
	// $logdetails = "$username0 add new activity log for date:$actdate";
	// include '../m/qryinslog.php';
// var_dump($res12query);
} // if

if(isset($result11)!='') {

	session_start();
	$_SESSION['addsuccess'] = true;


} else {

	echo '<h4 class="modal-title" id="myModalLabel" class="text-danger"><font color="red">Error in saving activity log</font>';
	// echo '<br>'.$res11query.'|'.$idinsert.'|'.$timestarthh.':'.$timestartmm.$timestartampm.'-to-'.$timeendhh.':'.$timeendmm.$timeendampm.'<br>'.$timestart.' -to- '.$timeend.'';
	echo '</h4>';

} // if 

?>