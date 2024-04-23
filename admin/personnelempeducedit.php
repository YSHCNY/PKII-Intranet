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

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit education</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Edit Educational Attainment</b></font></td></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_last = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $position = $myrow[3];
	}

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</</td></tr>";

// start edit education

	$result2 = mysql_query("SELECT empeducationid, employeeid, empeducationctr, coursegraduated, yeargraduated, schoolgraduated, schooladdress, companyid FROM tblempeducation WHERE empeducationid=$empeducationid AND employeeid = '$employeeid'", $dbh);
   
	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $empeducationid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $empeducationctr = $myrow2[2];
	  $coursegraduated = $myrow2[3];
	  $yeargraduated = $myrow2[4];
	  $schoolgraduated = $myrow2[5];
	  $schooladdress = $myrow2[6];
	  $companyid = $myrow2[7];
	}

	echo "<form action=personnelempeducedit2.php?loginid=$loginid&eid=$employeeid&edid=$empeducationid method=post>";
	echo "<tr><td>Course</td><td><input name=coursegraduated value=\"$coursegraduated\"></td></tr>";
	echo "<tr><td>Year Graduated</td><td><input name=yeargraduated value=\"$yeargraduated\"></td></tr>";
	echo "<tr><td>School/University Graduated</td><td><input name=schoolgraduated value=\"$schoolgraduated\"></td></tr>";
	echo "<tr><td>Address</td><td><input name=schooladdress value=\"$schooladdress\"></td></tr>";
	echo "<tr><td>&nbsp</td><td><input type=submit value='Update Education Details'></td></tr>";
	echo "</table></form>";

// end edit education

     }
 
     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
