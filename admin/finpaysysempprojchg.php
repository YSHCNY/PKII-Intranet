<?php
include("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idpaygroup = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';

$projchgpct01 = (isset($_POST['projchgpct01'])) ? $_POST['projchgpct01'] :'';
if($projchgpct01=='') { $projchgpct01=NULL; }
$projchgpctval01 = (isset($_POST['projchgpctval01'])) ? $_POST['projchgpctval01'] :'';

$projchgpct02 = (isset($_POST['projchgpct02'])) ? $_POST['projchgpct02'] :'';
if($projchgpct02=='') { $projchgpct02=NULL; }
$projchgpctval02 = (isset($_POST['projchgpctval02'])) ? $_POST['projchgpctval02'] :'';

$projchgpct03 = (isset($_POST['projchgpct03'])) ? $_POST['projchgpct03'] :'';
if($projchgpct03=='') { $projchgpct03=NULL; }
$projchgpctval03 = (isset($_POST['projchgpctval03'])) ? $_POST['projchgpctval03'] :'';

$projchgpct04 = (isset($_POST['projchgpct04'])) ? $_POST['projchgpct04'] :'';
if($projchgpct04=='') { $projchgpct04=NULL; }
$projchgpctval04 = (isset($_POST['projchgpctval04'])) ? $_POST['projchgpctval04'] :'';

$projchgpct05 = (isset($_POST['projchgpct05'])) ? $_POST['projchgpct05'] :'';
if($projchgpct05=='') { $projchgpct05=NULL; }
$projchgpctval05 = (isset($_POST['projchgpctval05'])) ? $_POST['projchgpctval05'] :'';

$set = (isset($_POST['set'])) ? $_POST['set'] :'';

$filesrc = (isset($_POST['filesrc'])) ? $_POST['filesrc'] :'';

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
	$res14query = "SELECT tblcontact.name_last, tblcontact.name_first, tblcontact.name_middle, tblcontact.contact_gender, tblcontact.contactid, tblhrtapaygrpemplst.idhrtapaygrpemplst FROM tblhrtapaygrpemplst INNER JOIN tblcontact ON tblhrtapaygrpemplst.contactid=tblcontact.contactid WHERE tblhrtapaygrpemplst.employeeid=\"$employeeid\" AND tblcontact.contact_type=\"personnel\"";
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
		$idhrtapaygrpemplst14 = $myrow14['idhrtapaygrpemplst'];
		}
	}

	if($found11 == 1 && $employeeid != "") {
		// query tblfinpayprojchg if exists then update or insert if not exists
		$res15query = "SELECT idfinpayprojchg FROM tblfinpayprojchg WHERE employeeid=\"$employeeid\" AND idpaygroup=$idpaygroup";
		$result15=""; $found15=0; $ctr15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1;
			$idfinpayprojchg15 = $myrow15['idfinpayprojchg'];
			}
		}

		if($found15 == 0) {
			if($set==1) {
			// update tblfinpayprojchg
			$res12query = "INSERT INTO tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", projpct01=\"$projchgpct01\", projpctval01=$projchgpctval01, idpaygroup=$idpaygroup, contactid=$contactid14, idhrtapaygrpemplst=$idhrtapaygrpemplst14";
			$adminlogdetails = "$loginid:$adminuid - add project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct01:$projchgpct01 val:$projchgpctval01";
			} else if($set==2) {
			// update tblfinpayprojchg
			$res12query = "INSERT INTO tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", projpct02=\"$projchgpct02\", projpctval02=$projchgpctval02, idpaygroup=$idpaygroup, contactid=$contactid14, idhrtapaygrpemplst=$idhrtapaygrpemplst14";
			$adminlogdetails = "$loginid:$adminuid - add project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct01:$projchgpct02 val:$projchgpctval02";
			} else if($set==3) {
			// update tblfinpayprojchg
			$res12query = "INSERT INTO tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", projpct03=\"$projchgpct03\", projpctval03=$projchgpctval03, idpaygroup=$idpaygroup, contactid=$contactid14, idhrtapaygrpemplst=$idhrtapaygrpemplst14";
			$adminlogdetails = "$loginid:$adminuid - add project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct03:$projchgpct03 val:$projchgpctval03";
			} else if($set==4) {
			// update tblfinpayprojchg
			$res12query = "INSERT INTO tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", projpct04=\"$projchgpct04\", projpctval04=$projchgpctval04, idpaygroup=$idpaygroup, contactid=$contactid14, idhrtapaygrpemplst=$idhrtapaygrpemplst14";
			$adminlogdetails = "$loginid:$adminuid - add project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct04:$projchgpct04 val:$projchgpctval04";
			} else if($set==5) {
			// update tblfinpayprojchg
			$res12query = "INSERT INTO tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", createdby=$loginid, paygroupname=\"$paygroupname11\", employeeid=\"$employeeid\", projpct05=\"$projchgpct05\", projpctval05=$projchgpctval05, idpaygroup=$idpaygroup, contactid=$contactid14, idhrtapaygrpemplst=$idhrtapaygrpemplst14";
			$adminlogdetails = "$loginid:$adminuid - add project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct05:$projchgpct05 val:$projchgpctval05";
			}
		} else if($found15 == 1) {
			if($set==1) {
			// insert into tblfinpayprojchg
			$res12query = "UPDATE tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, projpct01=\"$projchgpct01\", projpctval01=$projchgpctval01 WHERE idfinpayprojchg=$idfinpayprojchg15 AND idpaygroup=$idpaygroup AND employeeid=\"$employeeid\"";
			$adminlogdetails = "$loginid:$adminuid - modified project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct01:$projchgpct01 val:$projchgpctval01";
			} else if($set==2) {
			// insert into tblfinpayprojchg
			$res12query = "UPDATE tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, projpct02=\"$projchgpct02\", projpctval02=$projchgpctval02 WHERE idfinpayprojchg=$idfinpayprojchg15 AND idpaygroup=$idpaygroup AND employeeid=\"$employeeid\"";
			$adminlogdetails = "$loginid:$adminuid - modified project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct02:$projchgpct02 val:$projchgpctval02";
			} else if($set==3) {
			// insert into tblfinpayprojchg
			$res12query = "UPDATE tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, projpct03=\"$projchgpct03\", projpctval03=$projchgpctval03 WHERE idfinpayprojchg=$idfinpayprojchg15 AND idpaygroup=$idpaygroup AND employeeid=\"$employeeid\"";
			$adminlogdetails = "$loginid:$adminuid - modified project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct03:$projchgpct03 val:$projchgpctval03";
			} else if($set==4) {
			// insert into tblfinpayprojchg
			$res12query = "UPDATE tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, projpct04=\"$projchgpct04\", projpctval04=$projchgpctval04 WHERE idfinpayprojchg=$idfinpayprojchg15 AND idpaygroup=$idpaygroup AND employeeid=\"$employeeid\"";
			$adminlogdetails = "$loginid:$adminuid - modified project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct04:$projchgpct04 val:$projchgpctval04";
			} else if($set==5) {
			// insert into tblfinpayprojchg
			$res12query = "UPDATE tblfinpayprojchg SET timestamp=\"$now\", loginid=$loginid, projpct05=\"$projchgpct05\", projpctval05=$projchgpctval05 WHERE idfinpayprojchg=$idfinpayprojchg15 AND idpaygroup=$idpaygroup AND employeeid=\"$employeeid\"";
			$adminlogdetails = "$loginid:$adminuid - modified project percentage charge to personnel: $employeeid - $name_last14, $name_first14 $name_middle14 under paygroup:$idpaygroup-$paygroupname11 in payroll system with details projpct05:$projchgpct05 val:$projchgpctval05";
			}
		} // if($found15 == 1)

		// execute query
		$result12 = $dbh2->query($res12query);

		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			}
		}
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	} // if($found11 == 1)

	// redirect
	header("Location: $filesrc.php?loginid=$loginid&idpg=$idpaygroup&eid=$employeeid");
	exit;

	// echo "<p>vartest query:$res12query | f11:$found11, f14:$found14, f15:$found15, set:$set</p>";
	// echo "<p>vartest2 fsrc:$filesrc, query: $adminlogdetails</p>";

}
else
{
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>
