<?php 

require("db1.php");
include("datetimenow.php");
include("clsmcrypt.php");

$loginid = (isset($_GET['loginid'])) ? $_GET['loginid'] :'';

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Modules >> Confi-payroll >> Individual data</font></p>";

     echo "<p><a href=\"confipay.php?loginid=$loginid\">Back to ConfiPay Menu</a></p>";

     echo "<table class=\"fin\" border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><th>Confidential Payroll - Process Payroll Period</th></tr>";

  if(substr($level, -6, 1) == 1)
  {
		/*
     $result0 = mysql_query("", $dbh);
     while ($myrow0 = mysql_fetch_row($result0))
     {
		*/
		$res0query="SELECT employeeid, accesslevel FROM tbladminlogin WHERE adminloginid=$loginid";
		$result0=""; $found0=0; $ctr0=0;
		$result0 = $dbh2->query($res0query);
		if($result0->num_rows>0) {
			while($myrow0 = $result0->fetch_assoc()) {
	$found0 = 1;
	$employeeid = $myrow0['employeeid'];
	$accesslevel = $myrow0['accesslevel'];
			} // while
		} // if

     echo "<tr><td>Select Payroll Group:";

     echo "<form action=\"confipayrun2.php?loginid=$loginid\" method=\"POST\" target=\"frame\">";
     echo "<select name=\"groupname\">";

    if($accesslevel == "5")
    {
     $resquery = "SELECT DISTINCT groupname, accesslevel FROM tblconfipaygrp WHERE accesslevel <= \"5\"";
    }
    else if($accesslevel <= "4")
    {
     $resquery = "SELECT DISTINCT groupname, accesslevel FROM tblconfipaygrp WHERE accesslevel <= \"4\"";
    }
		$result = $dbh2->query($resquery);
		if($result->num_rows>0) {
			while($myrow = $result->fetch_assoc()) {
			$groupname = $myrow['groupname'];
			$confiaccesslevel = $myrow['accesslevel'];

		if($confiaccesslevel >= 5 && $accesslevel >= 5) {
			echo "<option value=\"$groupname\">";
			include("mcryptdec.php");
			echo "$groupname";
			include("mcryptenc.php");
			echo "</option>";
		} else if($confiaccesslevel <= 4) {
			echo "<option value=\"$groupname\">$groupname</option>";
		}

     } // while
		} // if
     echo "</select>";
     echo "<input type=\"submit\" value=\"Go\">";
     echo "</form>";

     echo "<iframe src=blank3.htm width=1000 height=600 name=frame><iframe>";
     echo "</td></tr>";
  }
  else
  {
    echo "<tr><td><font color=\"red\">Sorry, you don't have access to this page.</font></td></tr>";
  }

     echo "</table>";

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

// mysql_close($dbh);
$dbh2->close();
?> 