<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$policynum = $_GET['pn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete Group Insurance Policy</font></p>";

	echo "<p><font color=green>Deleting Group Insurance Policy...</font><br>";

	$result11 = mysql_query("SELECT durationfrom, durationto, insurancename FROM tblinsurance WHERE policynum=\"$policynum\"", $dbh);
	while ($myrow11 = mysql_fetch_row($result11))
	{
	  $found11 = 1;
	  $durationfrom = $myrow11[0];
	  $durationto = $myrow11[1];
	  $insurancename = $myrow11[2];
	}
	echo "Deleting <b>$durationfrom - $durationto - $policynum - $insurancename</b></p>";

	$result12 = mysql_query("DELETE FROM tblinsurance WHERE policynum=\"$policynum\"", $dbh);

	$result14 = mysql_query("SELECT policynum, employeeid, insurancename FROM tblinsuranceemp WHERE policynum=\"$policynum\" ORDER BY employeeid ASC", $dbh);
	while ($myrow14 = mysql_fetch_row($result14))
	{
	  $found14 = 1;
	  $policynum = $myrow14[0];
	  $employeeid = $myrow14[1];
	  $insurancename = $myrow14[2];

	  $result15 = mysql_query("DELETE FROM tblinsuranceemp WHERE policynum=\"$policynum\"", $dbh);
	  echo "Deleting EmpID:<b>$employeeid</b> w/ group policy:<b>$policynum</b><br>";
	}

	echo "<p><font color=\"green\"><b>Delete Successful!</b></font></p>";

	echo "<p><a href=\"personnelinsurance.php?loginid=$loginid\">Back</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

