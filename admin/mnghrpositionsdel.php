<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrpositionctg = (isset($_GET['idp'])) ? $_GET['idp'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if($found==1) {

	if($idhrpositionctg!='') {
		// query job position
		$res11query = "SELECT code, name, deptcd FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg";
		$result11=""; $found11=0; $ctr11=0;
		$result11=$dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11=$result11->fetch_assoc()) {
			$found11 = 1;
			$code11 = $myrow11['code'];
			$name11 = $myrow11['name'];
			$deptcd11 = $myrow11['deptcd'];
			} // while($myrow11=$result11->fetch_assoc())
		} // if($result11->num_rows>0)

		// delete query
		$res12query = "DELETE FROM tblhrpositionctg WHERE idhrpositionctg=$idhrpositionctg";
		$result12="";
		$result12=$dbh2->query($res12query);

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
    $adminlogdetails = "$loginid:$adminuid - deleted job position for HR category id:$idhrpositionctg, poscd:$code11, posname:$name11, dept:$deptcd11";
    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17="";
		$result17=$dbh2->query($res17query);

	} // if($idhpositionctg!='')

		// redirect back to mngdeptcd.php
	  header("Location: mnghrpositions.php?loginid=$loginid");
	  exit;

} else {
     include ("logindeny.php");
}
//mysql_close($dbh);
$dbh2->close();
?>
