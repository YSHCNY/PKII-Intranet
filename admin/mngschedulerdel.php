<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idscheduler = (isset($_GET['idsc'])) ? $_GET['idsc'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

	// query record
	$res14query="SELECT schedname, datefrom, dateto, details, recurring, deptcd, notifysw, notifywhen, notifywho, displaywhere, status FROM tblscheduler WHERE idtblscheduler=$idscheduler";
	$result14=""; $found14=0; $ctr14=0;
	$result14 = $dbh2->query($res14query);
	if($result14->num_rows>0) {
		while($myrow14 = $result14->fetch_assoc()) {
		$found14 = 1;
		$ctr14 = $ctr14+1;
		$schedname14 = $myrow14['schedname'];
		$datefrom14 = $myrow14['datefrom'];
		$datefrom14 = date("Y-m-d", strtotime($datefrom14));
		$dateto14 = $myrow14['dateto'];
		$dateto14 = date("Y-m-d", strtotime($dateto14));
		$details14 = $myrow14['details'];
		$recurring14 = $myrow14['recurring'];
		$deptcd14 = $myrow14['deptcd'];
		$notifysw14 = $myrow14['notifysw'];
		$notifywhen14 = $myrow14['notifywhen'];
		$notifywhen14 = date("Y-m-d", strtotime($notifywhen14));
		$notifywho14 = $myrow14['notifywho'];
		$displaywhere14 = $myrow14['displaywhere'];
		$status14 = $myrow14['status'];
		} // while($myrow14 = $result14->fetch_assoc())
	} // if($result14->num_rows>0)



	$res12query="DELETE FROM tblscheduler WHERE idtblscheduler=$idscheduler";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = $dbh2->query($res12query);

	// echo "<p>vartest $res12query</p>";

		$adminlogdetails = "$loginid:$username - deleted record in scheduler: $schedname14 $datefrom14-to-$dateto14 recurring:$recurring14 deptcd:$deptcd14 notify:$notifysw14";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect
	header("Location: mngscheduler.php?loginid=$loginid");
	exit;
	// echo "<p><a href=\"mngscheduler.php?loginid=$loginid\">back</p>";

}
else
{
     include ("logindeny.php");
}

$dbh2->close();
?>
