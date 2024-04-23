<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idtblhrtapaygrp = $_GET['idpg'];

$paygroupname = $_POST['paygroupname'];
$remarks = $_POST['remarks'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if($paygroupname != "") {
		// query tblhrtapaygrp if paygroupname exists
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT idtblhrtapaygrp, datecreated FROM tblhrtapaygrp WHERE paygroupname=\"$paygroupname\"", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$idtblhrtapaygrp11 = $myrow11[0];
			$datecreated11 = $myrow11[1];
			}
		}

		if($found11 == 1) {
			// display duplicate name error
			echo "<p><font color=\"red\">Sorry paygroupname exists on database. Pls try again.</font></p>";
				echo "<p><a href=\"hrtimeattpaygrp.php?loginid=$loginid\">back</a></p>";
		} else {
			// insert paygroupname into tblhrtapaygrp
			$result12 = mysql_query("INSERT INTO tblhrtapaygrp SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", lastmodified=$loginid, paygroupname=\"$paygroupname\", remarks=\"$remarks\"", $dbh);
			// create log
    	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
	    while($myrow16 = mysql_fetch_row($result16))
	    { $adminuid=$myrow16[0]; }
	    $adminlogdetails = "$loginid:$adminuid - add new paygroup: $paygroupname to payroll system module";
	    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

		// redirect back to mngdeptcd.php
	  header("Location: hrtimeattpaygrp.php?loginid=$loginid");
	  exit;
		}

	} else {
		echo "<p><font color=\"red\">Sorry, no pay group name was entered. Pls try again.</font></p>";
		echo "<p><a href=\"hrtimeattpaygrp.php?loginid=$loginid\">back</a></p>";

	}

}
else
{
     include ("logindeny.php");
}

mysql_close($dbh); 
?> 
