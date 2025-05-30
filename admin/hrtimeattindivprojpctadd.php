<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$projcode = (isset($_POST['projcode'])) ? $_POST['projcode'] :'';
$projpercent = (isset($_POST['projpercent'])) ? $_POST['projpercent'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($projcode!='' && $projpercent>0) {

	// qry tblhrtaempprojpct, check if total <= 100%
	$res11query="SELECT projpercent FROM tblhrtaempprojpct WHERE idcutoff=$idcutoff AND idpaygroup=$idpaygroup AND employeeid=\"$employeeid\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$projpercent11 = $myrow11['projpercent'];
		$projpct = $projpct + $projpercent11;
		} // while
	} // if

	// add new projpercent value
	$projpcttot = $projpct + $projpercent;

	if($projpcttot<=100) {

	// insert query
	$res12query="INSERT INTO tblhrtaempprojpct SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, employeeid=\"$employeeid\", projcode=\"$projcode\", projpercent=\"$projpercent\", idcutoff=$idcutoff, idpaygroup=$idpaygroup";
	$result12=""; $found12=0;
	$result12=$dbh2->query($res12query);

	// prep logdetails
	$adminlogdetails = "$loginid:$adminuid - add new HR Time & Attendance employee project percentage details, id:$idhrtaempprojpct11 eid:$employeeid projcd:$projcode pct:$projpercent paygrpid:$idpaygroup cutoffid:$idcutoff";

	$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17="";
	$result17=$dbh2->query($res17query);

	} // if

} // if

	// redirect
	header("Location: hrtimeattindivinfo.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid");
	exit;

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
