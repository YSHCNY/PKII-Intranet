<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$projassignid = $_GET['prjid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete project assignment</font></p>";

	echo "<p><font color=green><b>Delete Project Assignment Successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result1 = mysql_query("SELECT proj_code, proj_name FROM tblprojassign WHERE projassignid = $projassignid", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $proj_code = $myrow1[0];
	  $proj_name = $myrow1[1];
	}

	$result2 = mysql_query("DELETE FROM tblprojassign WHERE projassignid = $projassignid AND employeeid = '$employeeid'", $dbh);

	echo "<p><font color=red><b>Deleted: $proj_code - $proj_name</b></font><br>";
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

