<?php 

require("db1.php");
include("clsmcrypt.php");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$found = 0;

$mcrypt = new MCrypt($pin);

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Custom Payroll System >> Add group</font></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th>Confidential Payroll - Add Payroll Group</th></tr>";

  if(substr($level, -6, 1) == 1)
  {
     $result0 = mysql_query("SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
     while ($myrow0 = mysql_fetch_row($result0))
     {
	$found0 = 1;
	$employeeid = $myrow0[0];
	$accesslevel = $myrow0[1];
     }

    if($accesslevel == 5)
    {
     $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel<=5", $dbh);
    }
    else
    {
     $result1 = mysql_query("SELECT DISTINCT groupname, datecreated, accesslevel FROM tblconfipaygrp WHERE accesslevel<=3", $dbh);
    }

     echo "<tr><td align=center><i>-List of Available Payroll Groups-</i></td></tr>";
     echo "<tr><td align=center>";
     echo "<p>";

     while ($myrow1 = mysql_fetch_row($result1))
     {
	$found1 = 1;
        $groupname1 = $myrow1[0];
        $datecreated1 = $myrow1[1];
				$confiaccesslevel1 = $myrow1[2];
			if($confiaccesslevel1 >= 5 && $accesslevel >= 5) {
				// decrypt groupname
				$decrypted = $mcrypt->decrypt($groupname1);
				$groupname1 = $decrypted;
				echo "<b>$groupname1</b> - $datecreated1<br>";
			} else if($confiaccesslevel1 <= 4) {
				echo "<b>$groupname1</b> - $datecreated1<br>";
			}
     }
     echo "</td></tr>";

     echo "<tr><td>&nbsp;</td></tr>";

     echo "<tr><td align=center>";
     echo "<FORM METHOD=\"post\" ACTION=\"configrpadd2.php?loginid=$loginid\">";
     echo "<i>-Enter new payroll group name-</i>";
     echo "<p><INPUT NAME=\"groupname\"><br>";
     echo "<select name=\"confiaccesslevel\">";
      echo "<option value=\"3\">Level 3 : Standard</option>";
		if($accesslevel==5) {
      echo "<option value=\"5\">Level 5 : Confidential</option>";
		}
     echo "</select>";
     echo "<p>";
     echo "<INPUT TYPE=\"SUBMIT\" VALUE=\"Submit\"></FORM></td></tr>";
  }
  else
  {
    echo "<tr><td><font color=\"red\">Sorry, you don't have access to this page.</font></td></tr>";
  }

     echo "</table>";

     echo "<p><a href=confipay.php?loginid=$loginid>Back to Custom Payroll Menu</a><br>";    

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?> 
