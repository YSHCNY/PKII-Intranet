<?php 

require("db1.php");
include("clsmcrypt.php");

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

     echo "<p><font size=1>Modules >> Custom Payroll System >> Individual data</font></p>";

     echo "<p><a href=confipay.php?loginid=$loginid>Back to Custom Payroll Menu</a></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th>Custom Payroll - Personnel Data</th></tr>";

  if(substr($level, -6, 1) == 1)
  {
     $result0 = mysql_query("SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
     while ($myrow0 = mysql_fetch_row($result0))
     {
	$found0 = 1;
	$employeeid = $myrow0[0];
	$accesslevel = $myrow0[1];
     }

     echo "<tr><td>Select Payroll Group:";

     echo "<form action=\"confipay2.php?loginid=$loginid\" method=\"POST\" target=\"frame\">";
     echo "<select name=\"groupname\">";

    if($accesslevel == "5")
    {
     $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel <= \"5\"", $dbh);
    }
    else if($accesslevel <= "4")
    {
     $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel <= \"4\"", $dbh);
    }
     while ($myrow1 = mysql_fetch_row($result1))
     {
        $found1 = 1;
        $groupname1 = $myrow1[0];
        $datecreated1 = $myrow1[1];
				$confiaccesslevel1 = $myrow1[2];
			if($confiaccesslevel1 >= 5 && $accesslevel >= 5) {
				// decrypt groupname
				$decrypted = $mcrypt->decrypt($groupname1);
				$decgrpnm = $decrypted;
				echo "<option value=\"$groupname1\">$decgrpnm - $datecreated1</option>";				
			} else if($confiaccesslevel1 <= 4) {
				echo "<option value=\"$groupname1\">$groupname1 - $datecreated1</option>";
			}
     }
     echo "</select>";
     echo "<input type=\"submit\" value=\"Go\">";
     echo "</form></td></tr></table>";

     echo "<p>";
     echo "<iframe src=blank3.htm width=1000 height=600 name=frame><iframe>";
  }
  else
  {
    echo "<tr><td><font color=\"red\">Sorry, you don't have access to this page.</font></td></tr>";
  }
     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 