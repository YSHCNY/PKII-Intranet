<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$insuranceempid = $_GET['ieid'];

$effectiveyear = $_POST['effectiveyear'];
$effectivemonth = $_POST['effectivemonth'];
$effectiveday = $_POST['effectiveday'];
$effectivedate = $effectiveyear . "-" . $effectivemonth . "-" . $effectiveday;

$fromyear = $_POST['fromyear'];
$frommonth = $_POST['frommonth'];
$fromday = $_POST['fromday'];
$fromdate = $fromyear . "-" . $frommonth . "-" . $fromday;

$toyear = $_POST['toyear'];
$tomonth = $_POST['tomonth'];
$today = $_POST['today'];
$todate = $toyear . "-" . $tomonth . "-" . $today;

$insurancename = $_POST['insurancename'];
$emppolicynum = $_POST['emppolicynum'];
$proj_code = $_POST['proj_code'];
$location = $_POST['location'];
$coverages = $_POST['coverages'];
$remarks = $_POST['remarks'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Manage Individual Insurance</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Edit insurance policy</b></font></td></tr>";

  if ($fromdate > $todate)
  {
     echo "<tr><td colspan=2><font color=red><b>Sorry. Invalid date duration...</b></font><br>Please try again...</td></tr>";
  }
  else
  {
     echo "<tr><td colspan=2><font color=green><b>Saving edited insurance policy...</b></font></td></tr>";

     $result11 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE employeeid=\"$employeeid\"", $dbh);
     while ($myrow11 = mysql_fetch_row($result11))
     {
	$found11 = 1;
	$name_last = $myrow11[0];
	$name_first = $myrow11[1];
	$name_middle = $myrow11[2];
     }
     echo "<tr><td colspan=2>For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></td></tr>";
     echo "<tr><td colspan=2>Details:</td></tr>";

     echo "<tr><td>Vendor</td><td>$insurancename</td></tr>";
     echo "<tr><td>Group Policy</td><td>$policynum</td></tr>";
     echo "<tr><td>Individual Policy</td><td>$emppolicynum</td></tr>";
     echo "<tr><td>Effectivity</td><td>$effectivedate</td></tr>";
     echo "<tr><td>Duration</td><td>$fromdate -to- $todate</td></tr>";

     $result12 = mysql_query("SELECT proj_code, proj_sname FROM tblproject1 WHERE proj_code=\"$proj_code\"", $dbh);
     while ($myrow12 = mysql_fetch_row($result12))
     {
	$found12 = 1;
	$proj_code = $myrow12[0];
	$proj_sname = $myrow12[1];
     }
     echo "<tr><td>Project</td><td>$proj_code - $proj_sname</td></tr>";

     echo "<tr><td>Location</td><td>$location</td></tr>";
     echo "<tr><td>Coverages</td><td>$coverages</td></tr>";
     echo "<tr><td>Remarks</td><td>$remarks</td></tr>";

     include('datetimenow.php');

     $result14 = mysql_query("UPDATE tblinsuranceemp SET datestamp=\"$now\", insurancename=\"$insurancename\", emppolicynum=\"$emppolicynum\", effectivedate=\"$effectivedate\", durationfrom=\"$fromdate\", durationto=\"$todate\", proj_code=\"$proj_code\", proj_name=\"$proj_name\", location=\"$location\", coverages=\"$coverages\", remarks=\"$remarks\" WHERE insuranceempid=\"$insuranceempid\" AND employeeid=\"$employeeid\"", $dbh);

     echo "<tr><td>Status</td><td><font color=green><b>Saved</b></font></td></tr>";
  }

     echo "</table>";

     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a><br>";   

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
