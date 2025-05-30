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

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete dependent's record</font></p>";

	echo "<p><font color=green><b>Delete Dependent Record Successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result1 = mysql_query("SELECT * FROM tblempdependent WHERE employeeid = '$employeeid' AND empdependentid = $empdependentid", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $empdependentid = $myrow1[0];
//	  $employeeid = $myrow1[1];
	  $empdependentctr = $myrow1[2];
	  $dependentlast = $myrow1[3];
	  $dependentfirst = $myrow1[4];
	  $dependentmiddle = $myrow1[5];
	  $dependentbirthdate = $myrow1[6];
	  $dependentrelation = $myrow1[7];
	}

	$result2 = mysql_query("DELETE FROM tblempdependent WHERE empdependentid = $empdependentid AND employeeid = '$employeeid'", $dbh);

	echo "<p><font color=red><b>Deleted: $dependentfirst $dependentmiddle $dependentlast - $dependentrelation</b></font><br>";
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

