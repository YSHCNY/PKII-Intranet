<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
// $empeducationid = $_GET['edid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add Professional License</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add New Professional License</b></font></td></tr>";

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

// start add education

	echo "<form action=personnelempproflicedit2.php?loginid=$loginid&eid=$employeeid method=post>";
	echo "<tr><td>Regulatory Board</td><td><input name=regulatoryboard></td></tr>";
	echo "<tr><td>Profession</td><td><input name=profession></td></tr>";
	echo "<tr><td>License Number</td><td><input name=licensenumber></td></tr>";
	echo "<tr><td>License Date</td><td><input name=licensedate></td></tr>";
	echo "<tr><td>&nbsp</td><td><input type=submit value='Add Professional License'></td></tr>";
	echo "</table></form>";

// end add education

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
