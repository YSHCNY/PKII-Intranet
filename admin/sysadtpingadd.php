<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$hosttype = $_POST['hosttype'];

$found = 0;
$found11 = 0;
$count11 = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// edit body-header
     echo "<p><font size=1>Tools >> SysAd Tools >> Ping Hosts >> Add host</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=\"blue\" colspan=\"2\"><font color=white><b>Ping Hosts - Add host</b></font></td></tr>";

// start contents here...

  echo "<form action=\"sysadtpingadd2.php?loginid=$loginid\" method=\"post\">";
  echo "<tr><td bgcolor=\"yellow\">HostName</td><td><input name=\"hostname\"></td></tr>";
  echo "<tr><td bgcolor=\"yellow\">IP Address</td><td><input name=\"ipaddress\"></td></tr>";
  echo "<tr><td bgcolor=\"yellow\">Description</td><td><textarea rows=\"2\" cols=\"30\" name=\"description\"></textarea></td></tr>";
  echo "<tr><td bgcolor=\"yellow\">Type</td><td>";
  echo "<select name=\"type\">";
  echo "<option value=\"others\">Select</option>";
  echo "<option value=\"server\">Server</option>";
  echo "<option value=\"router\">Router</option>";
  echo "<option value=\"printer\">Printer</option>";
  echo "<option value=\"desktop\">Desktop</option>";
  echo "<option value=\"others\">Others</option>";
  echo "</select></td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\">";
  echo "<input type=\"submit\" value=\"Submit\"></td></tr>";
  echo "</form>";

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=sysadtpingconfig.php?loginid=$loginid>Back to Ping hosts configuration</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
