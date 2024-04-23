<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idtblhrtapaygrp = (isset($_GET['idpg'])) ? $_GET['idpg'] :'';

$employeeid = (isset($_POST['employeeid'])) ? $_POST['employeeid'] :'';

$projchgtyp = (isset($_POST['projchgtyp'])) ? $_POST['projchgtyp'] :'';

$activesw = (isset($_POST['activesw'])) ? $_POST['activesw'] :'';
if($activesw == "on") { $activeswval="1"; } else { $activeswval="0"; }

// echo "<p>vartest idhrtapg:$idtblhrtapaygrp, eid:$employeeid, projchgtyp:$projchgtyp, active:$activeswval</p>";

$idcutoff=0;

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
		// query paygroupname
		$res14query = "SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idtblhrtapaygrp";
		$result14=""; $found14=0; $ctr14=0;
		$result14 = $dbh2->query($res14query);
		if($result14->num_rows>0) {
			while($myrow14 = $result14->fetch_assoc()) {
			$found14 = 1;
			$paygroupname14 = $myrow14['paygroupname'];
			} // while($myrow14 = mysql_fetch_row($result14))
		} // if($result14 != "")
		// echo "<p>vartest fnd:$found, paygrpnm:$paygroupname14</p>";

		// check tblhrtapaygrpemplst if employeeid exists and update
		$res15query = "SELECT idhrtapaygrpemplst FROM tblhrtapaygrpemplst WHERE idtblhrtapaygrp=$idtblhrtapaygrp AND employeeid=\"$employeeid\"";
		$result15=""; $found15=0; $ctr15=0;
		$result15 = $dbh2->query($res15query);
		if($result15->num_rows>0) {
			while($myrow15 = $result15->fetch_assoc()) {
			$found15 = 1;
			$idhrtapaygrpemplst15 = $myrow15['idhrtapaygrpemplst'];
			} // while($myrow15 = mysql_fetch_row($result15))
		} // if($result15 != "")

		if($found15 == 1) {
		// update tblhrtapaygrpemplst
		$res14select="UPDATE tblhrtapaygrpemplst SET timestamp=\"$now\", lastlogin=$loginid, projchgtyp=\"$projchgtyp\", activesw=$activeswval WHERE idhrtapaygrpemplst=$idhrtapaygrpemplst15 AND employeeid=\"$employeeid\"";
		$result14 = $dbh2->query($res14select);
		} // if($found15 == 1)

		// create log
		$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16 = $result16->fetch_assoc())
		} // if($result16->num_rows>0)
		$adminlogdetails = "$loginid:$adminuid - modified paygroup member with empid:$employeeid, paygroupid:$idtblhrtapaygrp paygrpemplstid:$idhrtapaygrpemplst15, projchgtype:$projchgtyp, active=$activeswval of payroll system";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect back to mngdeptcd.php
	header("Location: finpaysysempinfo.php?loginid=$loginid&idpg=$idtblhrtapaygrp&eid=$employeeid");
	exit;
	// echo "<p>vartest $adminlogdetails</p";
	
}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?>
