<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$policynum = $_GET['pn'];

$member = $_POST['member'];

if ($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Manage Group Insurance</font></p>";

     echo "<table border=1 cellspacing=0 cellpadding=0>";
     echo "<tr><td><b>Creating Group Members</b></td></tr>";

     include('datetimenow.php');

     $result11 = mysql_query("SELECT policynum, insurancename, effectivedate, durationfrom, durationto FROM tblinsurance WHERE policynum = \"$policynum\"", $dbh);

     while ($myrow11 = mysql_fetch_row($result11))
     {
	$policynum = $myrow11[0];
	$insurancename = $myrow11[1];
	$effectivedate = $myrow11[2];
	$durationfrom = $myrow11[3];
	$durationto = $myrow11[4];
     }

     foreach ($member as $val)
     {
	$result12 = mysql_query("SELECT employeeid, name_first, name_middle, name_last FROM tblcontact WHERE employeeid='$val'", $dbh);

	while ($myrow12 = mysql_fetch_row($result12))
	{
	  $employeeid = $myrow12[0];
	  $name_first = $myrow12[1];
	  $name_middle = $myrow12[2];
	  $name_last = $myrow12[3];

	  echo "<tr><td>Updating:$employeeid - name:$name_last, $name_first $name_middle[0]. - status:<font color=green>ok</font></td></tr>";

	  $result = mysql_query("INSERT INTO tblinsuranceemp (datestamp, policynum, insurancename, employeeid, effectivedate, durationfrom, durationto) VALUES (\"$now\", \"$policynum\", \"$insurancename\", \"$employeeid\", \"$effectivedate\", \"$durationfrom\", \"$durationto\")", $dbh);
	}
     }
     echo "<tr><td><font color=green>Finished updating.</font></td></tr>";
     echo "</table>";

     echo "<p><a href=\"personnelinsurance.php?loginid=$loginid\"><b>Back to Manage Insurance</b></a><br>";    
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
