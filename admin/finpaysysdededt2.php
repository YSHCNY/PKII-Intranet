<?php
session_start();
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_POST['idpg'])) ? $_POST['idpg'] :'';

$idtblfinpaydeduct = (isset($_GET['fpdid'])) ? $_GET['fpdid'] :'';
$tab = (isset($_POST['tab'])) ? $_POST['tab'] :'';


$employeeid = $_POST['employeeid'];
$projchgpct01 = $_POST['projchgpct01'];
$projchgpctval01 = $_POST['projchgpctval01'];




$tab = (isset($_POST['tab'])) ? $_POST['tab'] : '';
$idpaygroup = (isset($_POST['idpaygroup'])) ? $_POST['idpaygroup'] : '';
$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] : '';
$filesrc = (isset($_POST['filesrc'])) ? $_POST['filesrc'] : '';
$tabinctyp = (isset($_POST['tabinctyp'])) ? $_POST['tabinctyp'] : '';
$deductname = (isset($_POST['deductname'])) ? $_POST['deductname'] : '';
$deducttotal = (isset($_POST['deducttotal'])) ? $_POST['deducttotal'] : '';
$deductamount = (isset($_POST['deductamount'])) ? $_POST['deductamount'] : '';
$deductbalance = (isset($_POST['deductbalance'])) ? $_POST['deductbalance'] : '';
$datestart = (isset($_POST['datestart'])) ? $_POST['datestart'] : '';
$dateend = (isset($_POST['dateend'])) ? $_POST['dateend'] : '';
$schedule = (isset($_POST['schedule'])) ? $_POST['schedule'] : '';
$status = (isset($_POST['status'])) ? $_POST['status'] : '1'; 

if($status == ''){
	$cbox = 1;
} else {
	$cbox = 0;
}

echo "<h1>$cbox</h1>";

echo "Tab: $tab<br>";
echo "Pay Group ID: $idpaygroup<br>";
echo "Employee ID: $employeeid<br>";
echo "File Source: $filesrc<br>";
echo "Tab Inc Type: $tabinctyp<br>";
echo "Deduction Name: $deductname<br>";
echo "Total Deduction: $deducttotal<br>";
echo "Deduction Amount: $deductamount<br>";
echo "Deduction Balance: $deductbalance<br>";
echo "Start Date: $datestart<br>";
echo "End Date: $dateend<br>";
echo "Schedule: $schedule<br>";
echo "Status: $status<br>";
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

	if($found11 == 1 && $employeeid != "") {
		// query tbl if exists then update or insert if not exists

		// insert into tblfinpaysysdeduct
		$res12query = "UPDATE tblfinpaydeduct SET timestamp=\"$now\", idlogin=$loginid, paygroupname=\"$paygroupname11\", deductname=\"$deductname\", deducttotal=\"$deducttotal\", deductamount=\"$deductamount\", deductbalance=\"$deductbalance\", datestart=\"$datestart\", dateend=\"$dateend\", status='$cbox', schedule=\"$schedule\" WHERE idtblfinpaydeduct=$idtblfinpaydeduct AND idpaygroup=$idpaygroup";
		$result12 = $dbh2->query($res12query);
		// create log
		if ($result12 == TRUE){
			$_SESSION['success'] = 'SUCCESS! Deduction Updated.';

			header("Location: finpaysysdededt.php?loginid=$loginid&&fpdid=$idtblfinpaydeduct&fsrc=finpaysysdeda&idpg=$idpaygroup&eid=$employeeid&tab=$tab");

} else {
	$_SESSION['error'] = 'ERROR! Something is Wrong.';
	header("Location: finpaysysdededt.php?loginid=$loginid&&fpdid=$idtblfinpaydeduct&fsrc=finpaysysdeda&idpg=$idpaygroup&eid=$employeeid&tab=$tab");

}
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
