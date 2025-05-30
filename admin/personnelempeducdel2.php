<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empeducationid = $_GET['edid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete education record</font></p>";

	echo "<p><font color=green><b>Delete Educational Attainment Record Successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result2 = mysql_query("SELECT * FROM tblempeducation WHERE employeeid = '$employeeid' AND empeducationid = $empeducationid", $dbh);
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
//	  $empeducationid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $empeducationctr = $myrow2[2];
	  $coursegraduated = $myrow2[3];
	  $yeargraduated = $myrow2[4];
	  $schoolgraduated = $myrow2[5];
	  $schooladdress = $myrow2[6];
	  $companyid = $myrow2[7];
	}


	$result2 = mysql_query("DELETE FROM tblempeducation WHERE empeducationid = $empeducationid AND employeeid = '$employeeid'", $dbh);

	echo "<font color=red>Deleted: <b>$coursegraduated - $yeargraduated - $schoolgraduated</b></font><br>";
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

