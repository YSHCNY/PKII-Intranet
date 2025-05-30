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

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Delete Group Insurance Policy</b></font></td></tr>";

	$found11 = 0;

	$result11 = mysql_query("SELECT durationfrom, durationto, insurancename FROM tblinsurance WHERE policynum=\"$policynum\"", $dbh);
	while ($myrow11 = mysql_fetch_row($result11))
	{
	  $found11 = 1;
	  $durationfrom = $myrow11[0];
	  $durationto = $myrow11[1];
	  $insurancename = $myrow11[2];
	}

	echo "<tr><td colspan=2 align=center>Deleting<br><b>$policynum<br>$insurancename<br>$durationfrom - $durationto</b><br>";

	echo "<tr><td colspan=2 align=center><font color=red>Note: This will also delete the insurance details of personnels under this policy<br><b>Are you sure?</b></font></td></tr>";
	echo "<tr><td align=center><form action=\"personnelinsuregrppolicydel2.php?loginid=$loginid&pn=$policynum\" method=\"post\">";
	echo "<input type=submit value='Yes'></form></td>";
	echo "<td align=center><form action=\"personnelinsurance.php?loginid=$loginid\" method=\"post\">";
	echo "<input type=submit value='No'></form></td></tr></table>";

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

