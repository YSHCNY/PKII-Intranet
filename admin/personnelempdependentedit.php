<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$empdependentid = $_GET['did'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit dependents</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Edit Dependents</b></font></td></tr>";

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

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</td></tr>";

// start edit dependent

	$result2 = mysql_query("SELECT * FROM tblempdependent WHERE employeeid = '$employeeid' AND empdependentid = $empdependentid", $dbh);

	while ($myrow2 = mysql_fetch_row($result2))
	{
	  $found2 = 1;
	  $empdependentid = $myrow2[0];
//	  $employeeid = $myrow2[1];
	  $empdependentctr = $myrow2[2];
	  $dependentlast = $myrow2[3];
	  $dependentfirst = $myrow2[4];
	  $dependentmiddle = $myrow2[5];
	  $dependentbirthdate = $myrow2[6];
	  $dependentrelation = $myrow2[7];
	}

	echo "<form action=personnelempdependentedit2.php?loginid=$loginid&eid=$employeeid&did=$empdependentid method=post>";

	echo "<tr><td>Name</td><td>";
	echo "<table border=0 spacing=0><tr><td><input name=dependentfirst value='$dependentfirst'></td>";
	echo "<td><input name=dependentmiddle value='$dependentmiddle'></td><td><input name=dependentlast value='$dependentlast'></td></tr>";
	echo "<tr><td><font size=1><i>First</i></font></td><td><font size=1><i>Middle</i></font></td><td><font size=1><i>Last</i></font></td></tr></table></td></tr>";

	echo "<tr><td>Birthdate</td><td>$dependentbirthdate  <a href=personnelempdependentchgdate.php?loginid=$loginid&eid=$employeeid&did=$empdependentid&bdate=$dependentbirthdate>Change</a></td></tr>";

	echo "<tr><td>Relationship</td><td><input name=dependentrelation value='$dependentrelation'></td></tr>";

	echo "<tr><td>&nbsp;</td><td><input type=submit value='Update'></td></tr>";

     }

     echo "</table";

// end edit dependent
 
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
