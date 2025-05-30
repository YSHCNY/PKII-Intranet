<?php 

require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] :'';
$idcutoff = (isset($_POST['idcutoff'])) ? $_POST['idcutoff'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Modules >> Payroll System >> Results</font></p>";

     echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

// start contents here...

	if($idpaygroup!='' && $idcutoff!='') {

	// query tblhrtacutoff
	$res11query="SELECT cutstart, cutend, paygroupname FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup LIMIT 1";
	$result11=""; $found11=0; $ctr11=0;
	$result11=$dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11=$result11->fetch_assoc()) {
		$found11=1;
		$cutstart11 = $myrow11['cutstart'];
		$cutend11 = $myrow11['cutend'];
		$paygroupname11 = $myrow11['paygroupname'];
		} // while
	} // if

  echo "<tr><td colspan=\"2\">";
	echo "<table class=\"fin\" border=\"0\">";

//
// insert processPayroll.php codes here, incl. sql insert/update queries...
//

	echo "<tr><th colspan=\"5\">Compute payroll results</th></tr>";
	echo "<tr><td colspan=\"5\" align=\"center\">$paygroupname11&nbsp;-&nbsp;".date("Y-M-d", strtotime($cutstart11))."-to-".date("Y-M-d", strtotime($cutend11))."</td></tr>";


	echo "<tr><td colspan=\"5\">nothing follows - eof</td></tr>";
	echo "</table>";
  echo "</td></tr>";

	// insert query
	$res12query="INSERT INTO tblemppaycutoff SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$now\", createdby=$loginid, paygroupname=\"$paygroupname11\", cutstart=\"$cutstart11\", cutend=\"$cutend11\", idhrtacutoff=$idcutoff, idhrtapaygrp=$idpaygroup";
	$result12=""; $found12=0;
	// $result12=$dbh2->query($res12query); // remove remarks on prod

	// create log
	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
	$result16=""; $found16=0;
	$result16=$dbh2->query($res16query);
	if($result16->num_rows>0) {
		while($myrow16=$result16->fetch_assoc()) {
		$found16=1;
		$adminuid=$myrow16['adminuid'];
		} // while
	} // if
	$adminlogdetails = "$loginid:$adminuid - compute payroll for paygroupid:$idpaygroup, cutoffid:$idcutoff with paygroupname:$paygroupname11, $cutstart11-to-$cutend11";
	$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
	$result17=""; $found17=0;
	// $result17=$dbh2->query($res17query); // remove remarks on prod

	} // if($idpaygroup!='' && $idcutoff!='')

// end contents here...

     echo "</table>";

// edit body-footer
     echo "<p><a href=\"finpaysys.php?loginid=$loginid\">Back</a></p>";

		$resquery = "UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid";
		$result = $dbh2->query($resquery); 

     include ("footer.php");
} else {
     include("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 
