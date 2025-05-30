<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$idhrtaempprojpct = (isset($_POST['idhrtaempprojpct'])) ? $_POST['idhrtaempprojpct'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found == 1) {

if($idhrtaempprojpct!='') {

	// query tblhrtaempprojpct
	$res11query="SELECT employeeid, idpaygroup FROM tblhrtaempprojpct WHERE idhrtaempprojpct=$idhrtaempprojpct";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$employeeid11=$myrow11['employeeid'];
		$idpaygroup11=$myrow11['idpaygroup'];
		} // while
	} // if

	// delete query
	$res12query="DELETE FROM tblhrtaempprojpct WHERE idhrtaempprojpct=$idhrtaempprojpct";
	$result12=""; $found12=0;
	$result12=$dbh2->query($res12query);

	// prep logdetails
	$adminlogdetails = "$loginid:$adminuid - deleted HR Time & Attendance employee project percentage details id:$idhrtaempprojpct, empid:$employeeid11, paygrpid:$idpaygroup11";

	$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17="";
	$result17=$dbh2->query($res17query);

} // if

	// redirect
	header("Location: hrtimeattindivinfo.php?loginid=$loginid&idpg=$idpaygroup11&eid=$employeeid11");
	exit;

} else {
     include ("logindeny.php");
}

$dbh2->close();
?>
