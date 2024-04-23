<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idtblhrtapaygrp = $_GET['idpg'];
$idhrtapaygrpemplst = $_GET['idel'];
$employeeid = $_GET['eid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if($idtblhrtapaygrp != "" && $idhrtapaygrpemplst != "") {
		// query pay group name
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT paygroupname FROM tblhrtapaygrp WHERE idtblhrtapaygrp=$idtblhrtapaygrp", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$paygroupname11 = $myrow11[0];
			}
		}
			// delete employeeid on pay group emp list based on id
			$result12 = mysql_query("DELETE FROM tblhrtapaygrpemplst WHERE idtblhrtapaygrp=$idtblhrtapaygrp AND idhrtapaygrpemplst=$idhrtapaygrpemplst AND employeeid=\"$employeeid\"", $dbh);
			// create log
    	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
	    while($myrow16 = mysql_fetch_row($result16))
	    { $adminuid=$myrow16[0]; }
	    $adminlogdetails = "$loginid:$adminuid - delete empid:$idhrtapaygrpemplst, employeenumber:$employeeid on paygroupid:$idtblhrtapaygrp, paygrpname:$paygroupname11 to payroll system module";
	    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
	}

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
