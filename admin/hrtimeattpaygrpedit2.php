<?php

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idtblhrtapaygrp = $_GET['idpg'];

$paygroupname = $_POST['paygroupname'];
$remarks = $_POST['remarks'];

// echo "<p>vartest id:$idtblhrtapaygrp, name:$paygroupname, rem:$remarks</p>";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
		// update paygroupname & description into tblhrtapaygrp
		$result12 = mysql_query("UPDATE tblhrtapaygrp SET timestamp=\"$now\", lastmodified=$loginid, paygroupname=\"$paygroupname\", remarks=\"$remarks\" WHERE idtblhrtapaygrp=$idtblhrtapaygrp", $dbh);

		// create log
		$result16="";
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
		if($result16 != "") {
	  	while($myrow16 = mysql_fetch_row($result16))
	  	{ $adminuid=$myrow16[0]; }
		}
	  $adminlogdetails = "$loginid:$adminuid - modified paygroup:$paygroupname desc:$remarks to payroll system module";
	  $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

		// redirect back to mngdeptcd.php
	  header("Location: hrtimeattpaygrpedit.php?loginid=$loginid&idpg=$idtblhrtapaygrp");
	  exit;
}
else
{
     include ("logindeny.php");
}
mysql_close($dbh); 
?>