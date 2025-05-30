<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$action = (isset($_GET['act'])) ? $_GET['act'] :'';
$idscheduleremail = (isset($_GET['id'])) ? $_GET['id'] :'';

$idscheduleremail1 = (isset($_POST['idscheduleremail'])) ? $_POST['idscheduleremail'] :'';
$submitemledt = (isset($_POST['submemledt'])) ? $_POST['submemledt'] :'';

if($idscheduleremail1!='') {
	$idscheduleremail=$idscheduleremail1;
} //if

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {
     include ("header.php");
     include ("sidebar.php");
// start contents here
// echo "<p>act:$action, id:$idscheduleremail, submemledt:$submitemledt</p>";
if($action=='emledt') {
	if($idscheduleremail!='') {
		
	if($submitemledt==1) {
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
				$res11qry="UPDATE tblscheduleremail SET timestamp=\"$now\", loginid=$loginid, deptcd=\"$deptcd\", emldatetime=\"$emldatetime\", emlreplyto=\"$emlreplyto\", emlto=\"$emlto\", emlcc=\"$emlcc\", emlbcc=\"$emlbcc\", emlsubject=\"$emlsubject\", emlbody=\"$emlbody\", emlfilepath=\"$emlfilepath\", emlfilename=\"$emlfilename\" WHERE idtblscheduleremail=$idscheduleremail";
				$result11=$dbh2->query($res11qry);
				// $insert_id = mysql_insert_id($dbh2);
				// insert log
				if($result11!='') {
					$msginfo="Record updated for email scheduler notifier.";
				$adminlogdetails = "$loginid:$username - record updated in manage scheduler > email scheduler notifier with subject:$emlsubject for dept:$deptcd";
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
    //
	} else {
	//
	echo "<form action='mngscheduleremailedtdel.php?loginid=$loginid&act=emledt&id=$idscheduleremail' method='POST' name='mngscheduleradd2'>";
	echo "<input type='hidden' name='idscheduleremail' value='$idscheduleremail'>";
	echo "<table class='table table-striped'>";
	echo "<tr><th colspan='2'>e-mail sender/scheduler > edit</th></tr>";
	// query tblscheduleremail based on id and display form
	$res11qry=""; $result11=""; $found11=0;
	$res11qry="SELECT deptcd, emldatetime, emlreplyto, emlto, emlcc, emlbcc, emlsubject, emlbody, emlfilepath, emlfilename FROM tblscheduleremail WHERE idtblscheduleremail=$idscheduleremail LIMIT 1";
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$deptcd = $myrow11['deptcd'];
			$emldatetime = $myrow11['emldatetime'];
			$emlreplyto = $myrow11['emlreplyto'];
			$emlto = $myrow11['emlto'];
			$emlcc = $myrow11['emlcc'];
			$emlbcc = $myrow11['emlbcc'];
			$emlsubject = $myrow11['emlsubject'];
			$emlbody = $myrow11['emlbody'];
			$emlfilepath = $myrow11['emlfilepath'];
			$emlfilename = $myrow11['emlfilename'];
		} //while
	} //if
	if($found11==1) {
	echo "<tr><th class='text-right'>department</th><td>";
	echo "<div class='form-group'>";
	echo "<select class='form-control' name='deptcd'>";
	$res11qry=""; $result11=""; $found11=0; $ctr11=0;
	$res11qry="SELECT iddeptcd, code, name FROM tbldeptcd ORDER BY iddeptcd ASC";
	$result11=$dbh2->query($res11qry);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
			$found11=1;
			$ctr11++;
			$iddeptcd11 = $myrow11['iddeptcd'];
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			if($code11==$deptcd) { $empdeptcdsel="selected"; } else { $empdeptcdsel=""; }
			echo "<option value='$code11' $empdeptcdsel>$name11</option>";
		} //while
	} //if
	echo "</select></div>";
	echo "</td></tr>";
	// split date and time
	$emldatetimearr = split(' ', $emldatetime);
	$emldate = $emldatetimearr[0];
	$emltime = date('H:i:s', strtotime($emldatetimearr[1]));
	echo "<tr><th class='text-right'>date to be sent</th><td>";
	echo "<div class='form-group'><input type='date' class='form-control' name='emldate' value='$emldate'></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>time to be sent</th><td>";
	echo "<div class='form-group'>";
	echo "<select class='form-control' name='emltime'>";
	for($tm=0; $tm<=23; $tm++) {
		$tmfin=date('H:i:s', strtotime($tm.':00:00'));
		if($tmfin==$emltime) { $emltimechecked="selected"; } else { $emltimechecked=""; }
		echo "<option value='$tmfin' $emltimechecked>$tmfin</option>";
	} //for
	echo "</select>";
	echo "</div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>from/reply-to</th><td>";
	echo "<div class='form-group'><input type='email' class='form-control' name='emlreplyto' value=\"$emlreplyto\"></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>to</th><td>";
	echo "<div class='form-group'><textarea rows='3' class='form-control' placeholder='email(s) separated by comma' name='emlto'>$emlto</textarea></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>cc</th><td>";
	echo "<div class='form-group'><textarea rows='3' class='form-control' placeholder='email(s) separated by comma' name='emlcc'>$emlcc</textarea></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>bcc</th><td>";
	echo "<div class='form-group'><textarea rows='3' class='form-control' placeholder='email(s) separated by comma' name='emlbcc'>$emlbcc</textarea></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>subject</th><td>";
	echo "<div class='form-group'><input type='text' class='form-control' placeholder='subject' name='emlsubject' value=\"$emlsubject\"></div>";
	echo "</td></tr>";
	echo "<tr><th class='text-right'>message</th><td>";
	echo "<div class='form-group'><textarea rows='4' class='form-control' placeholder='body of message' name='emlbody'>$emlbody</textarea></div>";
	echo "</td></tr>";
	echo "<tr><td colspan='2' class='text-center'><button type='submit' class='btn btn-success' name='submemledt' value='1'>Save</button></td></tr>";
    echo "</table>";
	echo "</td>";
	echo "</tbody></table>";
	echo "</form>";
	} //if

	} //if-else
		
	} // if

} elseif($action=='emldel') {
	if($idscheduleremail!='') {
		// delete query
		$res11qry=""; $result11="";
		$res11qry="DELETE FROM tblscheduleremail WHERE idtblscheduleremail=$idscheduleremail";
		$result11=$dbh2->query($res11qry);
		if($result11!='') {
			$msginfo="email scheduler record deleted.";
			// insert log
			$adminlogdetails = "$loginid:$username - record deleted in manage scheduler > email scheduler notifier with id:$idscheduleremail";
			$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$username\", adminlogdetails=\"$adminlogdetails\"";
			$result17 = $dbh2->query($res17query);
		} else {
			$msginfo="error in deleteing the email scheduler record.";
		} //if-else
		if($msginfo!='') {
			echo "<script type='text/javascript'>alert('$msginfo');</script>";
		} //if
	} //if
} //if-elseif

	//
	// redirect
	// exit(header("Location: mngscheduler.php?loginid=$loginid"));
	echo "<p><a href=\"mngscheduler.php?loginid=$loginid\" class='btn btn-default' role='button'>back</a></p>";
// end contents here
		$resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'";
    $result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
