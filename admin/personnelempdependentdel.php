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

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete dependent's birthdate</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Delete Dependent Record</b></font></td></tr>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

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

	echo "<tr><td colspan=2>Delete: <b>$dependentfirst $dependentmiddle $dependentlast - $dependentrelation</b><br>";
	echo "For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></td></tr>";

	echo "<tr><td colspan=2 align=center><font color=red><b>Are you sure?</b></td></font></tr>";
	echo "<tr><td align=center><form action=personnelempdependentdel2.php?loginid=$loginid&eid=$employeeid&did=$empdependentid method=post>";
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

