<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$hostname = $_POST['hostname'];
$ipaddress = $_POST['ipaddress'];
$description = $_POST['description'];
$type = $_POST['type'];


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
     echo "<tr><td colspan=\"2\" bgcolor=\"blue\"><font color=\"white\"><b>Ping Hosts - Add host</b></font></td></tr>";

// start contents here...

  $result11 = mysql_query("SELECT hostname, ipaddress, type FROM tblsysadping WHERE ipaddress = '$ipaddress'", $dbh);
  while ($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $hostname11 = $myrow11[0];
    $ipaddress11 = $myrow11[1];
    $type11 = $myrow11[2];
  }

  if($found11 == 1) { echo "<tr><td><font color=\"red\" colspan=\"2\"><b>Sorry IP Address entered is already on the list</b></font></td></tr>"; }
  else
  {
    echo "<tr><td>Details</td><td>Saving details...<br>hostname:$hostname<br>ipaddress:$ipaddress<br>desc:$description<br>type:$type</td></tr>";

    $result12 = mysql_query("INSERT INTO tblsysadping (hostname, ipaddress, description, type) VALUES (\"$hostname\", \"$ipaddress\", \"$description\", \"$type\")", $dbh);

    echo "<tr><td colspan=\"2\" align=\"center\">";
    echo "<form action=\"sysadtpingconfig.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"OK\"></form></td></tr>";
  }

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=\"sysadtpingconfig.php?loginid=$loginid\">Back to Ping hosts configuration</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
