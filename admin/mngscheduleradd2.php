<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$submremind = (isset($_POST['submremind'])) ? $_POST['submremind'] :'';
$submemail = (isset($_POST['submemail'])) ? $_POST['submemail'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

	//
	//
    if($submremind==1) {
		// get post vars
		$schedname = (isset($_POST['schedname'])) ? trim($_POST['schedname']) :'';
		$datefrom = (isset($_POST['datefrom'])) ? $_POST['datefrom'] :'';
		$dateto = (isset($_POST['dateto'])) ? $_POST['dateto'] :'';
		$details = (isset($_POST['details'])) ? trim($_POST['details']) :'';
		$recurring = (isset($_POST['recurring'])) ? $_POST['recurring'] :'';
		$depts = (isset($_POST['depts'])) ? $_POST['depts'] :'';
		$notifysw = (isset($_POST['notifysw'])) ? $_POST['notifysw'] :'';
		$notifywhen = (isset($_POST['notifywhen'])) ? $_POST['notifywhen'] :'';
		$notifywho = (isset($_POST['notifywho'])) ? $_POST['notifywho'] :'';
		
	if($schedname!='') {

	$datefrom = date("Y-m-d", strtotime($datefrom));
	$dateto = date("Y-m-d", strtotime($dateto));

	if($recurring=="on") {
		$recurringfin=1;
	} else { // if($recurring=="On")
		$recurringfin=0;
	} // if($recurring=="On")

	if(is_array($depts)) {
		$deptsfin='';
		foreach($depts as $val1 => $n1) {
			$deptsfin = $deptsfin . $depts[$val1] . "|";
		}
	} else { // if($depts=='Array')
		$deptsfin = $depts;
	} // if($depts=='Array')

	if($notifysw=="on") {
		$notifyswfin=1;
		$notifywhen = date("Y-m-d", strtotime($notifywhen));
		if (filter_var($notifywho, FILTER_VALIDATE_EMAIL)) {
  		$notifywhofin = "mailto:$notifywho";
		} else { // if (filter_var($notifywho, FILTER_VALIDATE_EMAIL))
  		$notifywhofin = "dept:$notifywho";
		} // if (filter_var($notifywho, FILTER_VALIDATE_EMAIL))
	} else { // if($notifysw=="On")
		$notifyswfin=0; $notifywhen=''; $notifywho='';
	} // if($notifysw=="On")

	$res12query="INSERT INTO tblscheduler SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, schedname=\"$schedname\", datefrom=\"$datefrom\", dateto=\"$dateto\", details=\"$details\", recurring=$recurringfin, deptcd=\"$deptsfin\", notifysw=$notifyswfin, notifywhen=\"$notifywhen\", notifywho=\"$notifywhofin\", displaywhere='', status=''";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);

	// echo "<p>vartest $res12query</p>";

		$adminlogdetails = "$loginid:$username - add new item in scheduler: $schedname $datefrom-to-$dateto recurring:$recurringfin deptcd:$deptsfin notify:$notifyswfin";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	} // if($schedname!='')

	// echo "<p>vartest $res17query</p>";

	// echo "<h2><font color=\"red\">Sorry scheduler name and date exist on record. Pls try a different name.</font></h2>";
	// echo "<p><a href=\"mngscheduler.php?loginid=$loginid\">back</a></p>";

	//
	//
	} elseif($submemail==1) {
		// post vars
		$deptcd = trim((isset($_POST['deptcd'])) ? $_POST['deptcd'] :'');
		$emldate = trim((isset($_POST['emldate'])) ? $_POST['emldate'] :'');
		$emltime = trim((isset($_POST['emltime'])) ? $_POST['emltime'] :'');
		$emlreplyto = trim((isset($_POST['emlreplyto'])) ? $_POST['emlreplyto'] :'');
		$emlto = trim((isset($_POST['emlto'])) ? $_POST['emlto'] :'');
		$emlcc = trim((isset($_POST['emlcc'])) ? $_POST['emlcc'] :'');
		$emlbcc = trim((isset($_POST['emlbcc'])) ? $_POST['emlbcc'] :'');
		$emlsubject = trim((isset($_POST['emlsubject'])) ? $_POST['emlsubject'] :'');
		$emlbody = trim((isset($_POST['emlbody'])) ? $_POST['emlbody'] :'');
		$emlfilepath = trim((isset($_POST['emlfilepath'])) ? $_POST['emlfilepath'] :'');
		$emlfilename = trim((isset($_POST['emlfilename'])) ? $_POST['emlfilename'] :'');
		// set datetime
		$emldatetime = date('Y-m-d H:i:s', strtotime($emldate.' '.$emltime));
		if($emlto!='' || $emlcc!='' || $emlbcc!='') {
			if($emlsubject!='' && $emlbody!='') {
				// insert query
				$res11qry=""; $result11="";
				$res11qry="INSERT INTO tblscheduleremail SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, deptcd=\"$deptcd\", emldatetime=\"$emldatetime\", emlreplyto=\"$emlreplyto\", emlto=\"$emlto\", emlcc=\"$emlcc\", emlbcc=\"$emlbcc\", emlsubject=\"$emlsubject\", emlbody=\"$emlbody\", emlfilepath=\"$emlfilepath\", emlfilename=\"$emlfilename\"";
				$result11=$dbh2->query($res11qry);
				$insert_id = mysql_insert_id($dbh2);
				// insert log
				if($insert_id!='') {
					$msginfo="New record saved for email scheduler notifier.";
				$adminlogdetails = "$loginid:$username - add new entry in manage scheduler > email scheduler notifier with subject:$emlsubject for dept:$deptcd";
				$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
				$result17 = $dbh2->query($res17query);
				}
			} else {
				$msginfo="subject or body of message should not be blank.";
			} //if-elseif
		} else {
			$msginfo="email recipients in to or cc or bcc should not be blank.";
		} //if-else
		if($msginfo!='') {
			echo "<script type='text/javascript'>alert('$msginfo');</script>";
		} //if
	} //if-elseif
// echo "<p>tests submremind:$submremind submemail:$submemail<br>r11q: $res11qry<br>r12q: $res12query</p>";
	//
	// redirect
	exit(header("Location: mngscheduler.php?loginid=$loginid"));
	// echo "<p><a href=\"mngscheduler.php?loginid=$loginid\">back</p>";

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
