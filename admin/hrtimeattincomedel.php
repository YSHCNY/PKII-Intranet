<?php 

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtaempincome = (isset($_GET['empincid'])) ? $_GET['empincid'] :'';
$filesrc = (isset($_GET['fsrc'])) ? $_GET['fsrc'] :'';
$tab = (isset($_GET['tab'])) ? $_GET['tab'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if($idhrtaempincome != "") {
		// query pay group name
		$res11query = "SELECT tblhrtaempincome.paygroupname, tblhrtaempincome.employeeid, tblhrtaempincome.name, tblhrtaempincome.amount, tblhrtaempincome.datestart, tblhrtaempincome.dateend, tblhrtaempincome.idpaygroup, tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle FROM tblhrtaempincome INNER JOIN tblcontact ON tblhrtaempincome.employeeid=tblcontact.employeeid WHERE idhrtaempincome=$idhrtaempincome AND tblcontact.contact_type=\"personnel\"";
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
			$employeeid11 = $myrow11['employeeid'];
			$name11 = $myrow11['name'];
			$amount11 = $myrow11['amount'];
			$datestart11 = $myrow11['datestart'];
			$dateend11 = $myrow11['dateend'];
			$idpaygroup11 = $myrow11['idpaygroup'];
			$name_last11 = $myrow11['name_last'];
			$name_first11 = $myrow11['name_first'];
			$name_middle11 = $myrow11['name_middle'];
			}
		}
			// delete query
			$res12query = "DELETE FROM tblhrtaempincome WHERE idhrtaempincome=$idhrtaempincome";
			$result12 = $dbh2->query($res12query);
			// create log
    	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
			$result16 = $dbh2->query($res16query);
			if($result16->num_rows>0) {
				while($myrow16 = $result16->fetch_assoc()) {
				$adminuid=$myrow16['adminuid'];
				}
			}
	    $adminlogdetails = "$loginid:$adminuid - delete additional income for payroll system with details id:$idhrtaempincome name:$name11 amt:$amount11 dur:$datestart11-to-$dateend11, idpaygroup:$idpaygroup11 for $employeeid11 - $name_last11, $name_first11 $name_middle11";
	    $res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
			$result17 = $dbh2->query($res17query);
	}

		// redirect back to mngdeptcd.php
	  header("Location: $filesrc.php?loginid=$loginid&idpg=$idpaygroup11&eid=$employeeid11&tab=$tab");
	  exit;

}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close(); 
?> 
