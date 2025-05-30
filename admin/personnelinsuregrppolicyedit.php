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

     echo "<p><font size=1>Directory >> Manage Personnel >> Manage Group Insurance</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Edit group insurance policy</b></font></td></tr>";

     echo "<FORM METHOD=\"post\" ACTION=\"personnelinsuregrppolicyedit2.php?loginid=$loginid&pn=$policynum\">";

     $found11 = 0;

     $result11 = mysql_query("SELECT policynum, effectivedate, durationfrom, durationto, insurancename, insurancedetails FROM tblinsurance WHERE policynum=\"$policynum\"", $dbh);

     while ($myrow11 = mysql_fetch_row($result11))
     {
	$found11 = 1;
	$policynum = $myrow11[0];
	$effectivedate = $myrow11[1];
	$durationfrom = $myrow11[2];
	$durationto = $myrow11[3];
	$insurancename = $myrow11[4];
	$insurancedetails = $myrow11[5];
     }

     $arraycuteffectdate = split("-", $effectivedate);
     $effectyear = $arraycuteffectdate[0];
     $effectmonth = $arraycuteffectdate[1];
     $effectday = $arraycuteffectdate[2];

     $arraycutfromdate = split("-", $durationfrom);
     $fromyear = $arraycutfromdate[0];
     $frommonth = $arraycutfromdate[1];
     $fromday = $arraycutfromdate[2];

     $arraycuttodate = split("-", $durationto);
     $toyear = $arraycuttodate[0];
     $tomonth = $arraycuttodate[1];
     $today = $arraycuttodate[2];

     echo "<tr><td align=center colspan=2>";
     echo "<i>Edit Policy Details</i></td></tr>";
     echo "<tr><td>Group Policy No.:</td><td><b>$policynum</b></td></tr>";

     echo "<tr><td>Effectivity Date</td><td>";

     include("dtpickpersonnelinsuregrpeffective.php");


     echo "<tr><td colspan=2 align=center><br>Period of Insurance</td></tr>";

     echo "<tr><td>From<br>";

     include("dtpickpersonnelinsuregrpfrom.php");

     echo "</td>";

     echo "<td>To<br>";

     include("dtpickpersonnelinsuregrpto.php");

     echo "</td></tr>";

     echo "<tr><td colspan=2><br>Insurance Vendor (Company Name)<br>";
     echo "<input name=insurancename size=50 value=\"$insurancename\"></td></tr>";

     echo "<tr><td colspan=2>Details<br>";
     echo "<textarea rows=4 cols=50 name=insurancedetails>$insurancedetails</textarea></td></tr>";

     echo "<tr><td colspan=2 align=center><INPUT TYPE=SUBMIT VALUE=\"Save\"></td></tr></table>";
     echo "</form>";

     echo "<p><a href=personnelinsurance.php?loginid=$loginid>Back to Manage Insurance</a><br>";    

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
