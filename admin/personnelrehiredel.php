<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$emprehireid14 = $_GET['rhid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete re-hire/re-employment</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Delete Re-hire or Re-employment details</b></font></td></tr>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result1 = mysql_query("SELECT daterehired, dateresigned, remarks FROM tblemprehire WHERE employeeid=\"$employeeid\" AND emprehireid=$emprehireid14", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $daterehired1 = $myrow1[0];
	  $dateresigned1 = $myrow1[1];
	  $remarks1 = $myrow1[2];
	}

	echo "<tr><td colspan=2>Delete: <b>$daterehired1 -to- $dateresigned1</b><br>";
	echo "For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></td></tr>";

	echo "<tr><td colspan=2 align=center><font color=red><b>Are you sure?</b></font></td></tr>";
	echo "<tr><td align=center><form action=\"personnelrehiredel2.php?loginid=$loginid&eid=$employeeid&rhid=$emprehireid14\" method=\"post\">";
	echo "<input type=\"submit\" value=\"Yes\"></form></td>";
	echo "<td align=center><form action=\"personneledit2.php?loginid=$loginid&pid=$employeeid\" method=\"post\">";
	echo "<input type=\"submit\" value=\"No\"></form></td></tr></table>";

     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

