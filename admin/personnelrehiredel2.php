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

	echo "<p><font color=green><b>Delete Re-hire/Re-employment Successful!</b></font></p>";

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

	$result2 = mysql_query("DELETE FROM tblemprehire WHERE employeeid=\"$employeeid\" AND emprehireid=$emprehireid14", $dbh);

	echo "<p><font color=red><b>Deleted: $daterehired1 -to- $dateresigned1</b></font><br>";
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

