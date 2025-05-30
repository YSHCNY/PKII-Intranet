<?php
// from itadmsuppreq.php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpersreq = (isset($_GET['idhpr'])) ? $_GET['idhpr'] :'';
$idhrpersreqcand = (isset($_POST['idhrpersreqcand'])) ? $_POST['idhrpersreqcand'] :'';
$recstepcd = (isset($_POST['recstepcd'])) ? $_POST['recstepcd'] :'';
$remarks = trim((isset($_POST['remarks'])) ? $_POST['remarks'] :'');

$found = 0;
$accesslevel11 = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

// start contents here

	if($remarks!='') {

	// query name based on loginid and empid
	$res10query="SELECT tblcontact.name_last, tblcontact.name_first FROM tbladminlogin LEFT JOIN tblcontact ON tbladminlogin.employeeid=tblcontact.employeeid WHERE tbladminlogin.adminloginid=$loginid LIMIT 1";
	$result10=""; $found10=0; $ctr10=0;
	$result10 = $dbh2->query($res10query);
	if($result10->num_rows>0) {
		while($myrow10 = $result10->fetch_assoc()) {
		$found10 = 1;
		$ctr10 = $ctr10 + 1;
		$name_last10 = $myrow10['name_last'];
		$name_first10 = $myrow10['name_first'];
		} // while$myrow10 = $result10->fetch_assoc())
	} // if($result10->num_rows>0)

	// query remarks from tblhrpersreqcand
	$res11query="SELECT tblhrpersreqcand.s1label, tblhrpersreqcand.s1remarks, tblhrpersreqcand.s1status, tblhrpersreqcand.s1stamp, tblhrpersreqcand.s2label, tblhrpersreqcand.s2remarks, tblhrpersreqcand.s2status, tblhrpersreqcand.s2stamp, tblhrpersreqcand.s3label, tblhrpersreqcand.s3remarks, tblhrpersreqcand.s3status, tblhrpersreqcand.s3stamp, tblhrpersreqcand.s4label, tblhrpersreqcand.s4remarks, tblhrpersreqcand.s4status, tblhrpersreqcand.s4stamp, tblhrpersreqcand.s5label, tblhrpersreqcand.s5remarks, tblhrpersreqcand.s5status, tblhrpersreqcand.s5stamp, tblhrpersreqcand.s6label, tblhrpersreqcand.s6remarks, tblhrpersreqcand.s6status, tblhrpersreqcand.s6stamp, tblhrpersreqcand.s7label, tblhrpersreqcand.s7remarks, tblhrpersreqcand.s7status, tblhrpersreqcand.s7stamp, tblhrpersreqcand.s8label, tblhrpersreqcand.s8remarks, tblhrpersreqcand.s8status, tblhrpersreqcand.s8stamp, tblhrpersreqcand.s9label, tblhrpersreqcand.s9remarks, tblhrpersreqcand.s9status, tblhrpersreqcand.s9stamp, tblhrpersreqcand.s10label, tblhrpersreqcand.s10remarks, tblhrpersreqcand.s10status, tblhrpersreqcand.s10stamp, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrpersreqcand LEFT JOIN tblcontact ON tblhrpersreqcand.contactid=tblcontact.contactid WHERE tblhrpersreqcand.idhrpersreqcand=$idhrpersreqcand";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$ctr11 = $ctr11 + 1;
		$s1label11 = $myrow11['s1label'];
		$s1remarks11 = $myrow11['s1remarks'];
		$s1status11 = $myrow11['s1status'];
		$s1stamp11 = $myrow11['s1stamp'];
		$s2label11 = $myrow11['s2label'];
		$s2remarks11 = $myrow11['s2remarks'];
		$s2status11 = $myrow11['s2status'];
		$s2stamp11 = $myrow11['s2stamp'];
		$s3label11 = $myrow11['s3label'];
		$s3remarks11 = $myrow11['s3remarks'];
		$s3status11 = $myrow11['s3status'];
		$s3stamp11 = $myrow11['s3stamp'];
		$s4label11 = $myrow11['s4label'];
		$s4remarks11 = $myrow11['s4remarks'];
		$s4status11 = $myrow11['s4status'];
		$s4stamp11 = $myrow11['s4stamp'];
		$s5label11 = $myrow11['s5label'];
		$s5remarks11 = $myrow11['s5remarks'];
		$s5status11 = $myrow11['s5status'];
		$s5stamp11 = $myrow11['s5stamp'];
		$s6label11 = $myrow11['s6label'];
		$s6remarks11 = $myrow11['s6remarks'];
		$s6status11 = $myrow11['s6status'];
		$s6stamp11 = $myrow11['s6stamp'];
		$s7label11 = $myrow11['s7label'];
		$s7remarks11 = $myrow11['s7remarks'];
		$s7status11 = $myrow11['s7status'];
		$s7stamp11 = $myrow11['s7stamp'];
		$s8label11 = $myrow11['s8label'];
		$s8remarks11 = $myrow11['s8remarks'];
		$s8status11 = $myrow11['s8status'];
		$s8stamp11 = $myrow11['s8stamp'];
		$s9label11 = $myrow11['s9label'];
		$s9remarks11 = $myrow11['s9remarks'];
		$s9status11 = $myrow11['s9status'];
		$s9stamp11 = $myrow11['s9stamp'];
		$s10label11 = $myrow11['s10label'];
		$s10remarks11 = $myrow11['s10remarks'];
		$s10status11 = $myrow11['s10status'];
		$s10stamp11 = $myrow11['s10stamp'];
		$name_last11 = $myrow11['name_last'];
		$name_first11 = $myrow11['name_first'];
		$name_middle11 = $myrow11['name_middle'];
		} // while($myrow11 = $result11->fetch_assoc())
	} // if($result11->num_rows>0)

	// determine step based on recstepcd and compose remarks post
	if($recstepcd=='S1') {
		$s1remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s1remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s1remarks=\"$s1remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S2') {
		$s2remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s2remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s2remarks=\"$s2remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S3') {
		$s3remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s3remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s3remarks=\"$s3remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S4') {
		$s4remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s4remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s4remarks=\"$s4remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S5') {
		$s5remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s5remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s5remarks=\"$s5remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S6') {
		$s6remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s6remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s6remarks=\"$s6remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S7') {
		$s7remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s7remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s7remarks=\"$s7remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S8') {
		$s8remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s8remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s8remarks=\"$s8remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S9') {
		$s9remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s9remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s9remarks=\"$s9remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} else if($recstepcd=='S10') {
		$s10remarksfin = $name_last10 . ", " . $name_first10 . " on ".date("Y-M-d H:i", strtotime($now)).":\r\n" . $remarks . "\r\n\r\n" . $s10remarks11;
		$res12query="UPDATE tblhrpersreqcand SET timestamp=\"$now\", loginid=$loginid, s10remarks=\"$s10remarksfin\" WHERE idhrpersreqcand=$idhrpersreqcand";
	} // if($recstepcd=='S1')
	$result12=""; $found12=0;
	// execute query
	$result12 = $dbh2->query($res12query);
	//echo "<p>res12query:$res12query</p>";

		// prepare and log		
		$logdetails = "$loginid:$username - remarks for HR Personnel request recruitment steps from $employeeid-$name_last10, $name_first10 for candidate $idhrpersreqcand-$name_last11, $name_first11 $name_middle[0] for id:$idhrpersreq remarks:$remarks";
		$res17query = "INSERT INTO tbllogs SET timestamp=\"$now\", loginid=$loginid, username=\"$username\", logdetails=\"$logdetails\"";
		$result17 = $dbh2->query($res17query);
		// echo "<br>$res17query</p>";

	} // if($remarks!='')

	// redirect
	header("Location: hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq");
	exit;

	// echo "<p><a href=\"hrpersreqdtl.php?loginid=$loginid&idhpr=$idhrpersreq\">back</a></p>";

// end contents here

     $resquery = "UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'"; 
		$result = $dbh2->query($resquery);
} else {
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
