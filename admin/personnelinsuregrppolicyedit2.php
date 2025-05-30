<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$policynum = $_GET['pn'];

$effectyear = $_POST['effectyear'];
$effectmonth = $_POST['effectmonth'];
$effectday = $_POST['effectday'];
$effectivedate = $effectyear . "-" . $effectmonth . "-" . $effectday;

$fromyear = $_POST['fromyear'];
$frommonth = $_POST['frommonth'];
$fromday = $_POST['fromday'];
$fromdate = $fromyear . "-" . $frommonth . "-" . $fromday;

$toyear = $_POST['toyear'];
$tomonth = $_POST['tomonth'];
$today = $_POST['today'];
$todate = $toyear . "-" . $tomonth . "-" . $today;

$insurancename = $_POST['insurancename'];
$insurancedetails = $_POST['insurancedetails'];

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
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Edit group insurance policy number</b></font></td></tr>";

  if ($fromdate > $todate)
  {
     echo "<tr><td colspan=2><font color=red><b>Sorry. Invalid date duration...</b></font><br>Please try again...</td></tr>";
  }
  else
  {
     echo "<tr><td colspan=2><font color=green><b>Saving edited group insurance policy...</b></font></td></tr>";
     echo "<tr><td colspan=2>Details:</td></tr>";

     echo "<tr><td>Vendor</td><td>$insurancename</td></tr>";
     echo "<tr><td>Policy</td><td>$policynum</td></tr>";
     echo "<tr><td>Effectivity</td><td>$effectivedate</td></tr>";
     echo "<tr><td>Duration</td><td>$fromdate -to- $todate</td></tr>";
     echo "<tr><td>Details</td><td>$insurancedetails</td></tr>";

     include('datetimenow.php');

     $result1 = mysql_query("UPDATE tblinsurance SET datestamp=\"$now\", insurancename=\"$insurancename\", effectivedate=\"$effectivedate\", durationfrom=\"$fromdate\", durationto=\"$todate\", insurancedetails=\"$insurancedetails\" WHERE policynum=\"$policynum\"", $dbh);

     echo "<tr><td>Status</td><td><font color=green><b>Saved</b></font></td></tr>";
  }

     echo "</table>";

     echo "<p><a href=\"personnelinsurance.php?loginid=$loginid\">Back to Manage Insurance</a><br>";    

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
