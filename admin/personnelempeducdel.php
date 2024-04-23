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

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete education</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Delete Educational Attainment Record</b></font></td></tr>";

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

	echo "<tr><td colspan=2>Delete: <b>$coursegraduated - $yeargraduated - $schoolgraduated</b><br>";
	echo "For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></td></tr>";

	echo "<tr><td colspan=2 align=center><font color=red><b>Are you sure?</b></td></font></tr>";
	echo "<tr><td align=center><form action=personnelempeducdel2.php?loginid=$loginid&eid=$employeeid&edid=$empeducationid method=post>";
	echo "<input type=submit value='Yes'></form></td>";
	echo "<td align=center><form action=personneledit2.php?loginid=$loginid&pid=$employeeid method=post>";
	echo "<input type=submit value='No'></form></td></tr></table>";

     echo "<p><a href = personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

