<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idhrtapayshiftctg = $_GET['idsc'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if($idhrtapayshiftctg != "") {
		// query pay group name
		$result11=""; $found11=0; $ctr11=0;
		$result11 = mysql_query("SELECT shiftin, shiftout FROM tblhrtapayshiftctg WHERE idhrtapayshiftctg=$idhrtapayshiftctg", $dbh);
		if($result11 != "") {
			while($myrow11 = mysql_fetch_row($result11)) {
			$found11 = 1;
			$shiftin11 = $myrow11[0];
			$shiftout11 = $myrow11[1];
			}
		}
			// delete shift categ based on id
			$result12 = mysql_query("DELETE FROM tblhrtapayshiftctg WHERE idhrtapayshiftctg=$idhrtapayshiftctg", $dbh);
			// create log
    	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
	    while($myrow16 = mysql_fetch_row($result16))
	    { $adminuid=$myrow16[0]; }
	    $adminlogdetails = "$loginid:$adminuid - delete shift category for payroll system with $shiftin11 -to- $shiftout11";
	    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
	}

		// redirect back to mngdeptcd.php
	  header("Location: mnghrempshiftctg.php?loginid=$loginid");
	  exit;

}
else
{
     include ("logindeny.php");
}

mysql_close($dbh); 
?> 