<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Manage Group Insurance</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue><font color=white><b>Manage Group Insurance</b></font></td></tr>";

     echo "<tr><td align=center>";
     echo "<FORM METHOD=post ACTION=personnelinsuregrppolicyadd.php?loginid=$loginid>";
     echo "<i>-Enter New Policy Number-</i>";
     echo "<p><INPUT NAME=policynum SIZE=30 VALUE=\"$policynum\">";
     echo "<p>";
     echo "<INPUT TYPE=SUBMIT VALUE=\"Add New\"></td></tr>";

// start display group insurance list
     echo "<tr><td align=center><i>-Group Insurance List-</i><br>";
	echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
	echo "<tr><td bgcolor=yellow><font size=1><i>Duration</i></font></td><td bgcolor=yellow><font size=1><i>Policy No.</i></font></td><td bgcolor=yellow><font size=1><i>Insurance Name</i></font></td><td bgcolor=yellow><font size=1><i>Action1</i></font></td><td bgcolor=yellow><font size=1><i>Action2</i></font></td></tr>";

     $found11 = 0;

     $result11 = mysql_query("SELECT policynum, durationfrom, durationto, insurancename FROM tblinsurance ORDER BY durationfrom DESC, durationto DESC", $dbh);

     while ($myrow11 = mysql_fetch_row($result11))
     {
	$found11 = 1;
	$policynum = $myrow11[0];
	$durationfrom = $myrow11[1];
	$durationto = $myrow11[2];
	$insurancename = $myrow11[3];

	if ($found11 == 1)
	{
	  echo "<tr><td>$durationfrom - $durationto</td><td>$policynum</td><td>$insurancename</td><td><a href=\"personnelinsuregrppolicyedit.php?loginid=$loginid&pn=$policynum\">Edit</a></td><td><a href=\"personnelinsuregrppolicydel.php?loginid=$loginid&pn=$policynum\">Delete</a></td></tr>";
	}
     }

	echo "</table>";
// end display group insurance list

     echo "</table>";

     echo "<p><a href=personneledit.php?loginid=$loginid>Back to Manage Personnel</a><br>";    

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
