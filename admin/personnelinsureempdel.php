<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$insuranceempid = $_GET['ieid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete Individual Insurance Policy</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Delete Individual Insurance Policy</b></font></td></tr>";

	$found11 = 0;

	$result11 = mysql_query("SELECT insuranceempid, policynum, insurancename, emppolicynum, durationfrom, durationto, location FROM tblinsuranceemp WHERE insuranceempid=$insuranceempid AND employeeid=\"$employeeid\"", $dbh);
	while ($myrow11 = mysql_fetch_row($result11))
	{
	  $insuranceempid = $myrow11[0];
	  $policynum = $myrow11[1];
	  $insurancename = $myrow11[2];
	  $emppolicynum = $myrow11[3];
	  $durationfrom = $myrow11[4];
	  $durationto = $myrow11[5];
	  $location = $myrow11[6];
	}

     $result0 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
     while($myrow0 = mysql_fetch_row($result0))
     {
	$name_last = $myrow0[0];
	$name_first = $myrow0[1];
	$name_middle = $myrow0[2];
     }


	echo "<tr><td colspan=2 align=center>Deleting<br><b>$policynum - $emppolicynum<br>$insurancename<br>$durationfrom - $durationto</b><br>";
	echo "For <b>$employeeidid - $name_last, $name_first $name_middle</b></td></tr>";

	echo "<tr><td align=center><form action=\"personnelinsureempdel2.php?loginid=$loginid&eid=$employeeid&ieid=$insuranceempid\" method=\"post\">";
	echo "<input type=submit value='Yes'></form></td>";
	echo "<td align=center><form action=\"personneledit2.php?loginid=$loginid&pid=$employeeid\" method=\"post\">";
	echo "<input type=submit value='No'></form></td></tr></table>";

     echo "<p><a href=\"personneledit2.php?loginid=$loginid&pid=$employeeid\">Back</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

