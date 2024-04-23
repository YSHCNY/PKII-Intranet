<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idtblfinpaydeduct = (isset($_GET['fpdid'])) ? $_GET['fpdid'] :'';
$employeeid = (isset($_GET['eid'])) ? $_GET['eid'] :'';
$filesrc = (isset($_GET['fsrc'])) ? $_GET['fsrc'] :'';
$tab = (isset($_GET['tab'])) ? $_GET['tab'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if($idtblfinpaydeduct != "") {
		// query pay group name
		$res11query = "SELECT tblfinpaydeduct.paygroupname, tblfinpaydeduct.deductname, tblfinpaydeduct.deducttotal, tblfinpaydeduct.deductamount, tblfinpaydeduct.datestart, tblfinpaydeduct.dateend, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblfinpaydeduct LEFT JOIN tblcontact ON tblfinpaydeduct.employeeid=tblcontact.employeeid WHERE tblfinpaydeduct.employeeid=\"$employeeid\" AND idtblfinpaydeduct=$idtblfinpaydeduct AND tblcontact.contact_type=\"personnel\"";
		$result11=""; $found11=0; $ctr11=0;
		/*
		$result11 = mysql_query("", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
		*/
		$result11 = $dbh2->query($res11query);
		if($result11->num_rows>0) {
			while($myrow11 = $result11->fetch_assoc()) {
			$found11 = 1;
			$paygroupname11 = $myrow11['paygroupname'];
			$deductname11 = $myrow11['deductname'];
			$deducttotal11 = $myrow11['deducttotal'];
			$deductamount11 = $myrow11['deductamount'];
			$datestart11 = $myrow11['datestart'];
			$dateend11 = $myrow11['dateend'];
			$name_last11 = $myrow11['name_last'];
			$name_first11 = $myrow11['name_first'];
			$name_middle11 = $myrow11['name_middle'];
			}
		}
			// delete query
			$res12query = "DELETE FROM tblfinpaydeduct WHERE idtblfinpaydeduct=$idtblfinpaydeduct";
			$result12 = $dbh2->query($res12query);
			// create log
    	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
			$result16 = $dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16 = $result16->fetch_assoc()) {
				$adminuid=$myrow16['adminuid'];
				}
			}
	    $adminlogdetails = "$loginid:$adminuid - delete deduction record for payroll system with details id:$idtblfinpaydeduct name:$deductname11 amt:$deductamount11 dur:$datestart11-to-$dateend11, idpaygroup:$idpaygroup for $employeeid - $name_last11, $name_first11 $name_middle11";
	    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
			$result17 = $dbh2->query($res17query);
	}

		// redirect back to mngdeptcd.php
	  header("Location: $filesrc.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=$tab");
	  exit;

}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close(); 
?> 
