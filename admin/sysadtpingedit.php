<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$sysadpingid = $_GET['id'];

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
     echo "<p><font size=1>Tools >> SysAd Tools >> Ping Hosts >> Edit host</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=\"blue\" colspan=\"2\"><font color=white><b>Ping Hosts - Edit</b></font></td></tr>";

// start contents here...

  $result11 = mysql_query("SELECT sysadpingid, hostname, ipaddress, description, type, groupid FROM tblsysadping WHERE sysadpingid = \"$sysadpingid\"", $dbh);
  while ($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $count11 = $count11 + 1;
    $ipaddress11 = '';
    $result = 0;

    $sysadpingid11 = $myrow11[0];
    $hostname11 = $myrow11[1];
    $ipaddress11 = $myrow11[2];
    $description11 = $myrow11[3];
    $type11 = $myrow11[4];
    $groupid11 = $myrow11[5];
  }

  echo "<form action=\"sysadtpingedit2.php?loginid=$loginid&id=$sysadpingid\" method=\"post\">";
  echo "<tr><td bgcolor=\"yellow\">HostName</td><td><input name=\"hostname\" value=\"$hostname11\"></td></tr>";
  echo "<tr><td bgcolor=\"yellow\">IP Address</td><td><input name=\"ipaddress\" value=\"$ipaddress11\"></td></tr>";
  echo "<tr><td bgcolor=\"yellow\">Description</td><td><textarea rows=\"2\" cols=\"30\" name=\"description\">$description11</textarea></td></tr>";

  echo "<tr><td bgcolor=\"yellow\">Type</td><td>";
  if($type11 == 'server') { $serverselected = "selected"; }
  else if($type11 == 'router') { $routerselected = "selected"; }
  else if($type11 == 'printer') { $printerselected = "selected"; }
  else if($type11 == 'desktop') { $desktopselected = "selected"; }
  else { $othersselected = "selected"; }
  echo "<select name=\"type\">";
  echo "<option value=\"server\" $serverselected>Server</option>";
  echo "<option value=\"router\" $routerselected>Router</option>";
  echo "<option value=\"printer\" $printerselected>Printer</option>";
  echo "<option value=\"desktop\" $desktopselected>Desktop</option>";
  echo "<option value=\"others\" $othersselected>Others</option>";
  echo "</select></td></tr>";

  echo "<tr><td bgcolor=\"yellow\">Group</td><td>";
  echo "<select name=\"groupid\">";
  if($groupid11 != '')
  {
    $found12 = 0;
    $result12 = mysql_query("SELECT sysadpinggroupid, groupname FROM tblsysadpinggroup WHERE sysadpinggroupid=$groupid11", $dbh);
    while($myrow12 = mysql_fetch_row($result12))
    {
      $found12 = 1;
      $sysadpinggroupid12 = $myrow12[0];
      $groupname12 = $myrow12[1];
      echo "<option value=$sysadpinggroupid12>$groupname12</option>";
    }
  }
  else
  {
    echo "<option>Select</option>";
  }
  $found14 = 0;
  $result14 = mysql_query("SELECT sysadpinggroupid, groupname FROM tblsysadpinggroup WHERE sysadpinggroupid<>''", $dbh);
  while($myrow14 = mysql_fetch_row($result14))
  {
    $found14 = 1;
    $sysadpinggroupid14 = $myrow14[0];
    $groupname14 = $myrow14[1];
    echo "<option value=$sysadpinggroupid14>$groupname14</option>";
  }
  echo "</select>";
  echo "</td></tr>";

  echo "<tr><td colspan=\"2\" align=\"center\">";
  echo "<input type=\"submit\" value=\"Save\"></td></tr>";
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
