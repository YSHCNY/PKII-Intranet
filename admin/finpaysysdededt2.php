<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$employeeid = $_POST['employeeid'];
$projchgpct01 = $_POST['projchgpct01'];
$projchgpctval01 = $_POST['projchgpctval01'];

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

	if($found11 == 1 && $employeeid != "" && $projchgpct01 != "" && $projchgpctval01>0) {
		// query tbl if exists then update or insert if not exists

		// insert into tblfinpaysysdeduct
		$res12query = "UPDATE tblfinpaydeduct SET timestamp=\"$now\", idlogin=$loginid, paygroupname=\"$paygroupname11\", deductname=\"$deductname\", deducttotal=\"$deducttotal\", deductamount=\"$deductamount\", deductbalance=\"$deductbalance\", datestart=\"$datestart\", dateend=\"$dateend\", status=$statusval, schedule=\"$schedule\" WHERE idtblfinpaydeduct=$idtblfinpaydeduct AND idpaygroup=$idpaygroup";
		$result12 = $dbh2->query($res12query);
		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			}
		}
		$adminlogdetails = "$loginid:$adminuid - modified deduction record for personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details name:$deductname total:$deducttotal, amt:$deductamount, bal:$deductbalance dur:$datestart-to-$dateend, sched:$schedule, status:$status";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	} // if($found11 == 1)

	// redirect
	header("Location: $filesrc.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid&tab=$tab0");
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
