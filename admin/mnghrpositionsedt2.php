<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpositionctg = (isset($_GET['idp'])) ? $_GET['idp'] :'';

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

	if($idhrpositionctg!='') {

		// insert into tblhrtapayshiftctg
		$res14query = "UPDATE tblhrpositionctg SET timestamp=\"$now\", loginid=$loginid, code=\"$code\", name=\"$name\", deptcd=\"$deptcd\", positionlevel=$positionlevel,  salarygrade=$salarygrade WHERE idhrpositionctg=$idhrpositionctg";
		$result14="";
		$result14=$dbh2->query($res14query);

		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16=""; $found16=0;
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$found16=1;
			$adminuid=$myrow16['adminuid'];
			} // 
		} // 
		$adminlogdetails = "$loginid:$adminuid - modified job position for HR category id:$idhrpositionctg, poscd:$code, posname:$name, dept:$deptcd, s.grade:$salarygrade, poslevel:$positionlevel";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);

	// redirect
	header("Location: mnghrpositions.php?loginid=$loginid");
	exit;

	} // if($idhrpositionctg!='')

} else {
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>
