<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';
$idhrtapayshiftctg = (isset($_GET['idsc'])) ? $_GET['idsc'] :'';

$inhh = (isset($_POST['inhh'])) ? $_POST['inhh'] :'';
$inmm = (isset($_POST['inmm'])) ? $_POST['inmm'] :'';
$outhh = (isset($_POST['outhh'])) ? $_POST['outhh'] :'';
$outmm = (isset($_POST['outmm'])) ? $_POST['outmm'] :'';
$lunchstarthh = (isset($_POST['lunchstarthh'])) ? $_POST['lunchstarthh'] :'';
$lunchstartmm = (isset($_POST['lunchstartmm'])) ? $_POST['lunchstartmm'] :'';
$lunchendhh = (isset($_POST['lunchendhh'])) ? $_POST['lunchendhh'] :'';
$lunchendmm = (isset($_POST['lunchendmm'])) ? $_POST['lunchendmm'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

	// compile time
	$timein = date("H:i:s", strtotime((sprintf("%02d", $inhh).":".sprintf("%02d", $inmm))));
	$timeout = date("H:i:s", strtotime((sprintf("%02d", $outhh).":".sprintf("%02d", $outmm))));
	$lunchstart = date("H:i:s", strtotime((sprintf("%02d", $lunchstarthh).":".sprintf("%02d", $lunchstartmm))));
	$lunchend = date("H:i:s", strtotime((sprintf("%02d", $lunchendhh).":".sprintf("%02d", $lunchendmm))));

		// insert into tblhrtapayshiftctg
		$res14query = "UPDATE tblhrtapayshiftctg SET timestamp=\"$now\", lastlogin=$loginid, shiftin=\"$timein\", shiftout=\"$timeout\", lunchstart=\"$lunchstart\", lunchend=\"$lunchend\" WHERE idhrtapayshiftctg=$idhrtapayshiftctg";
		$result14 = $dbh2->query($res14query);
		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result16 = $dbh2->query($res16query);
		if($result16->num_rows>0) {
			while($myrow16 = $result16->fetch_assoc()) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16 = $result16->fetch_assoc())
		} // if($result16->num_rows>0)
		$adminlogdetails = "$loginid:$adminuid - modified shift category for payroll system timein:$timein timeout:$timeout lunchbk:$lunchstart-to-$lunchend";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect
	header("Location: mnghrempshiftctg.php?loginid=$loginid");
	exit;

// echo "<p>vartest id:$idhrtapayshiftctg in:$timein out:$timeout lunchbrk:$lunchstart-to-$lunchend</p>";

}
else
{
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close();
?>
