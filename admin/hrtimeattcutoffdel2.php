<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idpaygroup = $_GET['idpg'];
$idcutoff = $_GET['idct'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

	$res11select="SELECT cutstart, cutend, paygroupname FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("$res11select", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$cutstart11 = $myrow11[0];
		$cutend11 = $myrow11[1];
		$paygroupname11 = $myrow11[2];
		}
	}

	if($found11 == 1) {
			// delete query
			// $result12 = mysql_query("DELETE FROM tblhrtacutoff WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup", $dbh);
			// $result14 = mysql_query("DELETE FROM tblhrtaemptimelog WHERE idpaygroup=$idpaygroup AND idcutoff=$idcutoff", $dbh);
			// create log

		$result12 = mysql_query("UPDATE tblhrtacutoff SET status=0 WHERE idhrtacutoff=$idcutoff AND idhrtapaygrp=$idpaygroup", $dbh);
    	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
	    while($myrow16 = mysql_fetch_row($result16))
	    { $adminuid=$myrow16[0]; }
	    $adminlogdetails = "$loginid:$adminuid - deleted cutoff period $cutstart11-to-$cutend11 from paygroup:$paygroupname11 including time log records for payroll system with cutoffid:$idcutoff and paygroupid:$idpaygroup";
	    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
	}

		// redirect back to mngdeptcd.php
	  header("Location: hrtimeattcutoff.php?loginid=$loginid&idpg=$idpaygroup");
	  exit;

}
else
{
     include ("logindeny.php");
}

mysql_close($dbh); 
?> 
