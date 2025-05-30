<?php
require("db1.php");
include("datetimenow.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

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

	// check timein and timeout if existing in tblhrtapayshiftctg
	$res11query = "SELECT idhrtapayshiftctg, datecreated, in, out FROM tblhrtapayshiftctg WHERE shiftin=\"$timein\" AND shiftout=\"$timeout\"";
	$result11=""; $found11=0; $ctr11=0;
	$result11 = $dbh2->query($res11query);
	if($result11->num_rows>0) {
		while($myrow11 = $result11->fetch_assoc()) {
		$found11 = 1;
		$idhrtapayshiftctg11 = $myrow11['idhrtapayshiftctg'];
		}
	}

	if($found11 == 1) {
		echo "<p><font color=\"red\">Sorry, timein and timeout exists. Please try again.</p>";
		echo "<p><a href=\"mnghrempshiftctg.php?loginid=$loginid\">back</a></p>";

	} else {
		// insert into tblhrtapayshiftctg
		$res14query = "INSERT INTO tblhrtapayshiftctg SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastlogin=$loginid, shiftin=\"$timein\", shiftout=\"$timeout\", lunchstart=\"$lunchstart\", lunchend=\"$lunchend\"";
		$result14 = $dbh2->query($res14query);
		// create log
  	$res16query = "SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid";
		$result14 = $dbh2->query($res16query);
		if($result14->num_rows>0) {
			while($myrow16 = mysql_fetch_row($result16)) {
			$adminuid=$myrow16['adminuid'];
			} // while($myrow16 = mysql_fetch_row($result16))
		} // if($result14->num_rows>0)
		$adminlogdetails = "$loginid:$adminuid - add new shift category for payroll system timein:$timein timeout:$timeout lunchbrk:$lunchstart-to-$lunchend";
		$res17query = "INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"";
		$result17 = $dbh2->query($res17query);

	// redirect
	header("Location: mnghrempshiftctg.php?loginid=$loginid");
	exit;
	}

// echo "<p>vartest in:$timein out:$timeout</p>";

}
else
{
     include ("logindeny.php");
}
// mysql_close($dbh);
$dbh2->close(); 
?>
