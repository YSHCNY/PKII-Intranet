<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$groupname = $_GET['groupname'];

$employeeid = $_POST['employeeid'];

$datecreated = date("Y-m-d");

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if(($groupname != "") && ($employeeid != "")) {
	// query tblemppaybongrp details
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT datecreated, accesslevel FROM tblemppaybongrp WHERE groupname=\"$groupname\" ORDER BY emppaybongrpid ASC LIMIT 1", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$datecreated11 = $myrow11[0];
		$accesslevel11 = $myrow11[1];
		}
	}

	// check first if employeeid exists from tblemppaybongrp
	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("SELECT emppaybongrpid, employeeid FROM tblemppaybongrp WHERE groupname=\"$groupname\" AND employeeid=\"$employeeid\"", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$emppaybongrpid12 = $myrow12[0];
		$employeeid12 = $myrow12[1];
		}
	}

	if($found12 == 1) {
	// display empid exists warning and display back hyperlink
	echo "<html>";
	echo "<p><font color=\"red\">sorry employeeid selected exists. pls try again.</font></p>";
	echo "<p><a href=\"emppayboninfo1.php?loginid=$loginid&groupname=$groupname\">back</a></p>";
	echo "</html>";
	} else {

	// insert records to tblemppaybongrp
	$result14 = mysql_query("INSERT INTO tblemppaybongrp SET employeeid=\"$employeeid\", groupname=\"$groupname\", datecreated=\"$datecreated11\", status=\"active\", accesslevel=$accesslevel;", $dbh);


	// query tblemppaybonus details
	$result15=""; $found15=0; $ctr15=0;
	$result15 = mysql_query("SELECT date FROM tblemppaybonus WHERE groupname=\"$groupname\" ORDER BY emppaybonusid ASC LIMIT 1", $dbh);
	if($result15 != "") {
		while($myrow15 = mysql_fetch_row($result15)) {
		$found15 = 1;
		$date15 = $myrow15[0];
		}
	}

	// insert records to tblemppaybonus
	$result16 = mysql_query("INSERT INTO tblemppaybonus SET employeeid=\"$employeeid\", groupname=\"$groupname\", date=\"$date15\", grossamt=0, taxdeduct=0, otherdeduct=0, netamt=0;", $dbh);

	// create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Additional EmpID:$employeeid inserted for Special Pay Notifier group:$groupname";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	// redirect back to emppayboninfo1.php
  header("Location: emppayboninfo1.php?loginid=$loginid&groupname=$groupname");
  exit;



	}

	} else {
	echo "<html>";
	// display warning or error
	echo "<p><font color=\"red\">Sorry no groupname or emplo</font></p>";
	// display back button or hyperlink
	echo "<p><a href=\"emppayboninfo1.php?loginid=$loginid&groupname=$groupname\">back</a></p>";
	echo "</html>";
	}
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh); 
?> 
