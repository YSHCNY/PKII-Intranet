<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = $_GET['loginid'];
$employeeid = $_POST['employeeid'];
$groupname = $_POST['groupname'];
$confiaccesslevel = $_POST['confiaccesslevel'];
$member = $_POST['member'];
$name_first = $_POST['name_first'];
$name_middle = $_POST['name_middle'];
$name_last = $_POST['name_last'];

$found = 0;
$exist = 0;
$datecreated = date("Y-m-d");

$mcrypt = new MCrypt($pin);

if ($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Custom Payroll System >> Add group</font></p>";

     echo "<p><b>Creating Group Members</b></p>";

foreach ($member as $val) {

	$result0 = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid=\"$val\"", $dbh);

	while ($myrow0 = mysql_fetch_row($result0)) {
	  echo "Updating:$groupname - $myrow0[0] - $myrow0[1] $myrow0[2] $myrow0[3] - datecreated:$datecreated - status:active<br>";

		if($confiaccesslevel==5) {

		// encrypt necessary fields before insert
		$employeeid = $val;
		$encrypted = $mcrypt->encrypt($employeeid);
		$encempid = $encrypted;
		$encrypted="";

		$encrypted = $mcrypt->encrypt($groupname);
		$encgrpnm = $encrypted;
		$encrypted="";

		$result = mysql_query("INSERT INTO tblconfipaygrp (timestamp, loginid, employeeid, groupname, datecreated, accesslevel, status) VALUES (\"$now\", $loginid, \"$encempid\", \"$encgrpnm\", \"$datecreated\", $accesslevel, \"active\")");
		// echo "<p>$now, $loginid, $encempid, $encgrpnm, $datecreated, $accesslevel</p>";

		} else if($confiaccesslevel==3) {

		$result = mysql_query("INSERT INTO tblconfipaygrp (timestamp, loginid, employeeid, groupname, datecreated, accesslevel, status) VALUES (\"$now\", $loginid, \"$val\", \"$groupname\", \"$datecreated\", $accesslevel, \"active\")");

		}

	}

}
     echo "<p><font color=green><b>Finished updating...</b></p>";

     echo "<p><a href=confipay.php?loginid=$loginid>Back to Custom Payroll Menu</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);

?>
