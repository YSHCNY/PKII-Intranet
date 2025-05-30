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
     echo "<p><font size=1>Tools >> SysAd Tools >> Ping Hosts</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=8><font color=white><b>Ping Hosts</b></font></td></tr>";

// start contents here...

    echo "<tr><td colspan=\"8\" align=\"center\">";
    echo "<table width=\"100%\" border=\"0\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td align=\"center\"><form action=\"sysadtpingadd.php?loginid=$loginid\" method=\"post\">";
    echo "<input type=\"submit\" value=\"Add new host\"></form></td>";
    echo "<td align=\"center\"><form action=\"sysadtpingmnggroup.php?loginid=$loginid\" method=\"post\">";
    echo "<input type=\"submit\" value=\"Manage Groups\"></form></td>";
    echo "</tr></table>";
    echo "</td></tr>";

  echo "<tr><td bgcolor=\"yellow\"><i>Count</i></td><td bgcolor=\"yellow\"><i>HostName</i></td><td bgcolor=\"yellow\"><i>IP Address</i></td><td bgcolor=\"yellow\"><i>Description</i></td><td bgcolor=\"yellow\"><i>Type</i></td><td bgcolor=\"yellow\"><i>Group</i></td><td bgcolor=\"yellow\" colspan=\"2\" align=\"center\"><i>Action</i></td></tr>";

  $result11 = mysql_query("SELECT tblsysadping.sysadpingid, tblsysadping.hostname, tblsysadping.ipaddress, tblsysadping.description, tblsysadping.type, tblsysadping.groupid, tblsysadpinggroup.groupname FROM tblsysadping LEFT JOIN tblsysadpinggroup ON tblsysadping.groupid = tblsysadpinggroup.sysadpinggroupid WHERE tblsysadping.sysadpingid <> '' ORDER BY tblsysadping.ipaddress ASC", $dbh);
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
    $groupname11 = $myrow11[6];

    echo "<tr><td>$count11</td><td>$hostname11</td><td>$ipaddress11</td><td>$description11</td><td>$type11</td><td>$groupname11</td>";
    echo "<td><form action=\"sysadtpingdel.php?loginid=$loginid&id=$sysadpingid11\" method=\"post\">";
    echo "<input type=\"submit\" value=\"Del\"></form></td>";
    echo "<td><form action=\"sysadtpingedit.php?loginid=$loginid&id=$sysadpingid11\" method=\"post\">";
    echo "<input type=\"submit\" value=\"Edit\"></form></td>";
    echo "</tr>";

    $groupid11 = 0;
    $result12 = 0;
    $sysadpinggroupid12 = '';
  }

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=sysadtools.php?loginid=$loginid>Back</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
