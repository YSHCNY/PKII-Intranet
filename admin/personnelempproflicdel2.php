<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empproflicenseid = $_GET['eplid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete professional license record</font></p>";

	echo "<p><font color=green><b>Delete Professional License Details Successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result2 = mysql_query("SELECT * FROM tblempproflicense WHERE employeeid = '$employeeid' AND empproflicenseid = $empproflicenseid", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
//	  $empproflicenseid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $regulatoryboard = $myrow2[2];
	  $profession = $myrow2[3];
	  $licensenumber = $myrow2[4];
	  $licensedate = $myrow2[5];
	}


	$result2 = mysql_query("DELETE FROM tblempproflicense WHERE empproflicenseid = $empproflicenseid AND employeeid = '$employeeid'", $dbh);

	echo "<font color=red>Deleted: <b>$regulatoryboard - $profession - $licensenumber - $licensedate</b></font><br>";
	echo "For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></p>";

	echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

