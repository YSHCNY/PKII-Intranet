<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$iddeptcd = $_GET['idd'];

$deptcd = trim($_POST['deptcd']);
$deptname = trim($_POST['deptname']);
$deptremarks = trim($_POST['deptremarks']);

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if(($deptcd != "") && ($deptname != "")) {

	// query tbldeptcd details
	// for edit delete functions only
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT iddeptcd, code, name, remarks FROM tbldeptcd", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$iddeptcd11 = $myrow11[0];
		$code11 = $myrow11[1];
		$name11 = $myrow11[2];
		$remarks11 = $myrow11[3];
		}
	}

	/*
	// check first if dept code or dept name exists
	// for add function only
	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("SELECT iddeptcd, code, name, remarks FROM tbldeptcd WHERE code=\"$deptcd\" OR name=\"$deptname\"", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$iddeptcd12 = $myrow12[0];
		$code12 = $myrow12[1];
		}
	}

	if($found12 == 1) {
	// display dept code or name exists warning and display back hyperlink
	echo "<html>";
	echo "<p><font color=\"red\">sorry dept code or name exists. pls try again.</font></p>";
	echo "<p><a href=\"mngdeptcd.php?loginid=$loginid\">back</a></p>";
	echo "</html>";
	} else {

	// insert records to tbldeptcd

	// create log

	// redirect back to mngdeptcd.php

	}
	*/

	// insert records to tbldeptcd
	$result14 = mysql_query("UPDATE tbldeptcd SET code=\"$deptcd\", name=\"$deptname\", remarks=\"$deptremarks\" WHERE iddeptcd=$iddeptcd", $dbh);


	// create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Modified department in Manage Categories - Department code:$deptcd name:$deptname";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	// redirect back to mngdeptcd.php
  header("Location: mngdeptcd.php?loginid=$loginid");
  exit;


	} else {
	echo "<html>";
	// display warning or error
	echo "<p><font color=\"red\">Sorry department code or department name should not be blank</font></p>";
	// display back button or hyperlink
	echo "<p><a href=\"mngdeptcd.php?loginid=$loginid\">back</a></p>";
	echo "</html>";
	}
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh); 
?> 
