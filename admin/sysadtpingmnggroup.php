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
     echo "<p><font size=1>Tools >> SysAd Tools >> Ping Hosts >> Manage Groups</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=\"blue\" colspan=\"2\"><font color=white><b>Ping Hosts - Manage groups</b></font></td></tr>";

// start contents here...

  echo "<tr><td align=\"center\"><form action=\"sysadtpingmnggroupadd.php?loginid=$loginid\" method=\"post\">";
  echo "<input type=\"submit\" value=\"Add new group\"></form></td></tr>";
  echo "<tr><td colspan=\"2\" bgcolor=\"yellow\" align=\"center\">Available groups</td></tr>";
  echo "<tr><td>";
    echo "<table border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    echo "<tr><td>Id</td><td>GroupName</td><td>Remarks</td><td colspan=\"2\">Action</td></tr>";

  $found11 = 0;
  $result11 = mysql_query("SELECT sysadpinggroupid, groupname, remarks FROM tblsysadpinggroup WHERE sysadpinggroupid<>'' ORDER BY sysadpinggroupid ASC", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $sysadpinggroupid11 = $myrow11[0];
    $groupname11 = $myrow11[1];
    $remarks11 = $myrow11[2];

    echo "<tr><td align=\"right\">$sysadpinggroupid11</td><td><b>$groupname11</b></td><td>$remarks11</td>";
    echo "<td><a href=\"sysadtpingmnggroupdel.php?loginid=$loginid&gid=$sysadpinggroupid11\">Del</a></td>";
    echo "<td><a href=\"sysadtpingmnggroupedit.php?loginid=$loginid&gid=$sysadpinggroupid11\">Edit</a></td></tr>";
  }

    echo "</table>";

  echo "</td></tr>";

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
