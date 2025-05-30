<?php
// set get vars
$loginstat = (isset($_GET['lst'])) ? $_GET['lst'] :'';
$loginid = (isset($_GET['lid'])) ? $_GET['lid'] :'';
$session = trim((isset($_GET['sess'])) ? $_GET['sess'] :'');
$page = trim((isset($_GET['p'])) ? $_GET['p'] :'');

// set post vars
$actlogid = (isset($_POST['actlogid'])) ? $_POST['actlogid'] :'';
$idlogin = (isset($_POST['idlogin'])) ? $_POST['idlogin'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$actdate = (isset($_POST['actdate'])) ? $_POST['actdate'] :'';
$actdetails = (isset($_POST['actdetails'])) ? $_POST['actdetails'] :'';
$projcode = (isset($_POST['prjcd'])) ? $_POST['prjcd'] :'';
$currproj = (isset($_POST['currproj'])) ? $_POST['currproj'] :'';
$timestart = (isset($_POST['tmstart'])) ? $_POST['tmstart'] :'';


echo "<br> $actlogid<br>
$idlogin<br> 
$employeeid<br>$actdate<br>$actdetails<br>$projcode<br>$currpro<br>$timestart<br>";
if($timestart!='') {
	$timestartfin = date('Y-m-d H:i:s', strtotime($actdate.' '.$timestart));
} else {
	$timestartfin='0000-00-00 00:00:00';
} //if-else
$timeend = (isset($_POST['tmend'])) ? $_POST['tmend'] :'';
if($timeend!='') {
	$timeendfin = date('Y-m-d H:i:s', strtotime($actdate.' '.$timeend));
} else {
	$timeendfin='0000-00-00 00:00:00';
} //if-else

if($actdetails!='') {
	include '../m/qrymactlogedt.php';
} // if

if($result11) {

	session_start();
	$_SESSION['editsuccess'] = true;
	header('Location: index.php?lst=1&lid=' . $loginid . '&sess=' . $session . '&p=14');


} else {

	echo '<h4 class="modal-title" id="myModalLabel"><font color="red">Error in saving activity log</font>';
	// echo '<br />'.$actdate.', '.$projcode.', '.$timestart.', '.$timeend.'<br />'.$res11query.'';
	echo '</h4>';
	header('Location: index.php?lst=1&lid=' . $loginid . '&sess=' . $session . '&p=14');


} // if 

?>
