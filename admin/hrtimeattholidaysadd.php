<?php
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$holidate = $_POST['holidate'];
$holidayname = $_POST['holidayname'];
$holitype = $_POST['holitype'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

	/*
	// compile time
	$timein = date("H:i:s", strtotime((sprintf("%02d", $inhh).":".sprintf("%02d", $inmm))));
	$timeout = date("H:i:s", strtotime((sprintf("%02d", $outhh).":".sprintf("%02d", $outmm))));
	*/

	// check date and type if existing in tblhrtapayshiftctg
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT idhrtaholidays FROM tblhrtaholidays WHERE applic_date=\"$holidate\" AND holidaytype=\"$holitype\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$idhrtaholidays11 = $myrow11[0];
		}
	}

	if($found11 == 1) {
		echo "<p><font color=\"red\">Sorry, holiday entered exists. Please try again.</p>";
		echo "<p><a href=\"hrtimeattholidays.php?loginid=$loginid\">back</a></p>";

	} else {
		// insert into tblhrtaholidays
		$result14 = mysql_query("INSERT INTO tblhrtaholidays SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastupdate=$loginid, applic_date=\"$holidate\", holidayname=\"$holidayname\", holidaytype=\"$holitype\", shiftin=\"$starttime\", shiftout=\"$endtime\"", $dbh);
		// create log
  	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
		while($myrow16 = mysql_fetch_row($result16))
		{ $adminuid=$myrow16[0]; }
		$adminlogdetails = "$loginid:$adminuid - add new holiday for payroll system date:$holidate, name:$holidayname, type:$holitype, $starttime-to-$endtime";
		$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	// redirect
	header("Location: hrtimeattholidays.php?loginid=$loginid");
	exit;
	}

// echo "<p>vartest in:$timein out:$timeout</p>";

}
else
{
     include ("logindeny.php");
}
mysql_close($dbh); 
?>