<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$code = stripslashes((isset($_POST['code'])) ? $_POST['code'] :'');
$name = stripslashes((isset($_POST['name'])) ? $_POST['name'] :'');
$deptcd = (isset($_POST['deptcd'])) ? $_POST['deptcd'] :'';
$positionlevel = (isset($_POST['positionlevel'])) ? $_POST['positionlevel'] :'';
$salarygrade = (isset($_POST['salarygrade'])) ? $_POST['salarygrade'] :'';

if($positionlevel=='') { $positionlevel=0; }
if($salarygrade=='') { $salarygrade=0; }

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

	// check first if code or name exists
	if($code=='') {
	$res11query = "SELECT idhrpositionctg FROM tblhrpositionctg WHERE name=\"$name\"";
	} else {
	$res11query = "SELECT idhrpositionctg FROM tblhrpositionctg WHERE code=\"$code\" OR name=\"$name\"";
	}
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11 = 1;
		$idhrpositionctg11 = $myrow11['idhrpositionctg'];
		} // while($myrow11=$result11->fetch_assoc())
	} // if($result11->num_rows>0)

	if($found11 == 1) {
		echo "<p><font color=\"red\">Sorry, position code or position name exists. Please try again.</font></p>";
		echo "<p><a href=\"mnghrpositions.php?loginid=$loginid\">back</a></p>";
	} else {
		// insert into tblhrtapayshiftctg
		$res14query = "INSERT INTO tblhrpositionctg SET timestamp=\"$now\", loginid=$loginid, code=\"$code\", name=\"$name\", deptcd=\"$deptcd\", salarygrade=$salarygrade, positionlevel=$positionlevel";
		$result14=$dbh2->query($res14query);

		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16=""; $found16=0;
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16=$result16->fetch_assoc())
		} // if($result16->num_rows>0)
		$adminlogdetails = "$loginid:$adminuid - add new job position under HR categories poscd:$code, posname:$name, dept:$deptcd, sgrade:$salarygrade, poslvl:$positionlevel";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);

	// redirect
	header("Location: mnghrpositions.php?loginid=$loginid");
	exit;
	}

} else {
     include ("logindeny.php");
}
// mysql_close($dbh); 
$dbh2->close();
?>
