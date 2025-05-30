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
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add new group insurance policy number</b></font></td></tr>";

  if ($fromdate > $todate)
  {
     echo "<tr><td colspan=2><font color=red><b>Sorry. Invalid date duration...</b></font><br>Please try again...</td></tr>";

  }
  else
  {

    if(!checkdate($effectmonth,$effectday,$effectyear))
    {
      echo "<tr><td colspan=2><font color=red><b>Sorry. Invalid effectivity date...</b></font><br>Please try again...</td></tr>";
    }
    else if(!checkdate($frommonth,$fromday,$fromyear))
    {
      echo "<tr><td colspan=2><font color=red><b>Sorry. Invalid date in duration from</b></font><br>Please try again...</td></tr>";
    }
    else if(!checkdate($tomonth,$today,$toyear))
    {
      echo "<tr><td colspan=2><font color=red><b>Sorry. Invalid date in duration to</b></font><br>Please try again...</td></tr>";
    }
    else
    {

     echo "<tr><td colspan=2><font color=green><b>Saving new group insurance policy number...</b></font></td></tr>";
     echo "<tr><td colspan=2>Details:</td></tr>";

     echo "<tr><td>Vendor</td><td><b>$insurancename</b></td></tr>";
     echo "<tr><td>Policy</td><td><b>$policynum</b></td></tr>";
     echo "<tr><td>Effectivity</td><td>$effectivedate</td></tr>";
     echo "<tr><td>Duration</td><td>$fromdate -to- $todate</td></tr>";
     echo "<tr><td>Details</td><td>$insurancedetails</td></tr>";

     include('datetimenow.php');

     $result1 = mysql_query("INSERT INTO tblinsurance (datestamp, policynum, insurancename, effectivedate, durationfrom, durationto, insurancedetails) VALUES (\"$now\", \"$policynum\", \"$insurancename\", \"$effectivedate\", \"$fromdate\", \"$todate\", \"$insurancedetails\")", $dbh);

     echo "<tr><td>Status</td><td><font color=green><b>Saved</b></font></td></tr>";
     echo "</table>";

     echo "<FORM action=\"personnelinsuregrppolicyadd3.php?loginid=$loginid&pn=$policynum\" method=\"POST\">";

     echo "<table border=1 cellspacing=0 cellpadding=0><tr><td>";
     echo "<tr><td colspan=5 bgcolor=yellow><p><b>Select members for this policy.</b><br>Displaying all active employees & consultants:</p></td></tr>";

     $count11 = 0;

     $result11 = mysql_query("SELECT tblcontact.employeeid, tblcontact.name_first, tblcontact.name_last, tblcontact.name_middle FROM tblcontact JOIN tblemployee ON tblcontact.employeeid = tblemployee.employeeid WHERE tblcontact.contact_type = 'personnel' AND tblemployee.term_resign = '0000-00-00' ORDER BY tblcontact.name_last ASC, tblcontact.employeeid ASC", $dbh);

     while ($myrow11 = mysql_fetch_row($result11))
     {
	$count11 = $count11 + 1;
	$employeeid = $myrow11[0];
	$name_first = $myrow11[1];
	$name_last = $myrow11[2];
	$name_middle = $myrow11[3];

	echo "<tr><td><input type=checkbox name=member[] value=$employeeid></td><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$name_middle[0]</td></tr>";
     }
     echo "<tr><td colspan=5 align=center><INPUT TYPE=SUBMIT></td></tr>";
     echo "</table><br></FORM>";

    }
  }
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
