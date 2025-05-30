<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';
$idcutoff = (isset($_GET['idct'])) ? $_GET['idct'] :'';

$found = 0;

if($loginid != "") {
     include("logincheck.php");
}

if ($found == 1) {

	$res11select=""; $result11=""; $found11=0; $ctr11=0;
	$res11select="SELECT cutstart, cutend, paygroupname FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup";
	$result11 = $dbh2->query($res11select);
	if($result11->num_rows>0) {
	    while($myrow11=$result11->fetch_assoc()) {
			$found11=1; $ctr11++;
		$cutstart11 = $myrow11['cutstart'];
		$cutend11 = $myrow11['cutend'];
		$paygroupname11 = $myrow11['paygroupname'];			
		} //while
	} //if

	if($found11 == 1) {
			// delete query
			$res12query="DELETE FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup";
			$result12=$dbh2->query($res12query);
			$res14query="DELETE FROM tblhrtaemptimelog WHERE idpaygroup=$idpaygroup AND idcutoff=$idcutoff";
			$result14=$dbh2->query($res14query);
			
			// create log
		$res12query="UPDATE tblhrtacutoff SET status=0 WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup";
		$result12=$dbh2->query($res12query);
    	$res16query="SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16=$dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16=$result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];	
			} //while
		} //if
	    $adminlogdetails = "$loginid:$adminuid - deleted cutoff period $cutstart11-to-$cutend11 from paygroup:$paygroupname11 including time log records for payroll system with cutoffid:$idcutoff and paygroupid:$idpaygroup";
	    $res17query="INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17=$dbh2->query($res17query);
	} //if($found11==1)

		// redirect back to mngdeptcd.php
	  header("Location: hrtimeattcutoff.php?loginid=$loginid&idpg=$idpaygroup");
	  exit;

} else {
     include ("logindeny.php");
}

mysql_close($dbh);
$dbh2->close();
?> 
