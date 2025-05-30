<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Bonus Notifier >> Sendmail</font></p>";

     echo "<p><a href=\"emppaybon01.php?loginid=$loginid\">Back to Bonus Notifier Menu</a></p>";

     echo "<p><b>Personnel Bonus Notifier - Send email</b></font></p>";

     $result0 = mysql_query("SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
     while ($myrow0 = mysql_fetch_row($result0))
     {
	$found0 = 1;
	$employeeid = $myrow0[0];
	$accesslevel = $myrow0[1];
     }

     echo "Select Payroll Group:";

     echo "<form action=\"emppaybonsend1.php?loginid=$loginid\" method=\"POST\" target=\"frame\">";
     echo "<select name=\"groupname\">";

  if ($accesslevel >= 4)
  {
     $result = mysql_query("SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp", $dbh);
     while ($myrow = mysql_fetch_row($result))
     {
	$found = 1;
	$groupname = $myrow[0];
	$datecreated = $myrow[1];
	echo "<option value=\"$groupname\">$groupname - $datecreated</option>";
     }
  }
  else if ($accesslevel == 3)
  {
     $result2 = mysql_query("SELECT DISTINCT groupname, datecreated FROM tblemppaybongrp WHERE accesslevel=\"3\"", $dbh);
     while ($myrow2 = mysql_fetch_row($result2))
     {
	$found2 = 1;
	$groupname = $myrow2[0];
	$datecreated = $myrow2[1];
	echo "<option value=\"$groupname\">$groupname - $datecreated</option>";
     }
  }
     echo "</select>";
     echo "<input type=\"submit\" value=\"Go\"><br>";

     echo "Check All<input type=\"checkbox\" name=\"checkall\" value=\"yes\" CHECKED>";

     echo "</form>";

     echo "<iframe src=blank3.htm width=100% height=300 name=frame><iframe>";

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
