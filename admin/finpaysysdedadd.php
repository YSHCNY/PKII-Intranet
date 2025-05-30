<?php
		session_start();

include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';
$filesrc = (isset($_POST['filesrc'])) ? $_POST['filesrc'] :'';
$deductname = (isset($_POST['deductname'])) ? $_POST['deductname'] :'';
$deducttotal = (isset($_POST['deducttotal'])) ? $_POST['deducttotal'] :'';
$deductamount = (isset($_POST['deductamount'])) ? $_POST['deductamount'] :'';
$deductbalance = (isset($_POST['deductbalance'])) ? $_POST['deductbalance'] :'';
$datestart = (isset($_POST['datestart'])) ? date("Y-m-d", strtotime($_POST['datestart'])) :'';
$dateend = (isset($_POST['dateend'])) ? date("Y-m-d", strtotime($_POST['dateend'])) :'';
$schedule = (isset($_POST['schedule'])) ? $_POST['schedule'] :'';
$status = (isset($_POST['status'])) ? $_POST['status'] :'';
if($status=="on") { $statusval=1; } else { $statusval=0; }

$tabinctyp = (isset($_POST['tabinctyp'])) ? $_POST['tabinctyp'] :'';
if($tabinctyp=="list") { $tab0="l"; } else if($tabinctyp=="add") { $tab0="a"; }

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	// query paygroupname
	$res11query = "SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idpaygroup";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$paygroupname11 = $myrow11['paygroupname'];
		}
	}

	// query personnel name
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contactid FROM tblhrtapaygrpemplst INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
	$result14=""; $found14=0;
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$name_last14 = $myrow14['name_last'];
		$name_first14 = $myrow14['name_first'];
		$name_middle14 = $myrow14['name_middle'];
		$contact_gender14 = $myrow14['contact_gender'];
		$contactid14 = $myrow14['contactid'];
		}
	}

	if($found11 == 1 && $employeeid != "" && $deductname != "" && $deductamount>0 && $dateend>=$datestart) {
		// insert into tblfinpaysysdeduct
		$res12query = "INSERT INTO tblfinpaydeduct SET timestamp=\"$now\", idlogin=$loginid, datecreated=\"$datenow\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", deductname=\"$deductname\", deducttotal=\"$deducttotal\", deductamount=\"$deductamount\", deductbalance=\"$deductbalance\", datestart=\"$datestart\", dateend=\"$dateend\", status=$statusval, schedule=\"$schedule\", idpaygroup=$idpaygroup, contactid=$contactid14";
		$result12 = $dbh2->query($res12query);
		if ($result12 == TRUE){
			$_SESSION['success'] = 'SUCCESS! New Deduction Added.';

	header("Location: finpaysysded.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=$tab0");
} else {
	$_SESSION['error'] = 'ERROR! Something is Wrong.';
	header("Location: finpaysysded.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=$tab0");
}
		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			}
		}
		$adminlogdetails = "$loginid:$adminuid - add new deduction for personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with deduction:$deductname total:$deducttotal, amt:$deductamount, bal:$deductbalance dur:$datestart-to-$dateend, sched:$schedule, status:$status";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	} // if($found11 == 1)

	// redirect
	

	exit;

	// echo "<p>vartest1 query: timestamp=\"$now\", idlogin=$loginid, datecreated=\"$datenow\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", deductname=\"$deductname\", deducttotal=\"$deducttotal\", deductamount=\"$deductamount\", deductbalance=\"$deductbalance\", datestart=\"$datestart\", dateend=\"$dateend\", status=$statusval, schedule=\"$schedule\", idpaygroup=$idpaygroup, contactid=$contactid14</p>";
	// echo "<p>vartest2 fsrc:$filesrc, query: $adminlogdetails</p>";

}
else
{
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>
