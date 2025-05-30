<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$groupname = $_POST['groupname'];
$remarks = $_POST['remarks'];

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
     echo "<p><font size=1>Tools >> SysAd Tools >> Ping Hosts >> Add group</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td colspan=\"2\" bgcolor=\"blue\"><font color=\"white\"><b>Ping Hosts - Add group</b></font></td></tr>";

// start contents here...

  $found11 = 0;
  $result11 = mysql_query("SELECT groupname FROM tblsysadpinggroup WHERE groupname = \"$groupname\"", $dbh);
  if($result11 != '')
  {
    while ($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $groupname11 = $myrow11[0];
    }
  }

  if($found11 == 1) { echo "<tr><td><font color=\"red\" colspan=\"2\"><b>Sorry groupname already on list</b></font></td></tr>"; }
  else
  {
    echo "<tr><td>Details</td><td>Saving details...<br>groupname:$groupname<br>remarks:$remarks</td></tr>";

    $result12 = mysql_query("INSERT INTO tblsysadpinggroup (groupname, remarks) VALUES (\"$groupname\", \"$remarks\")", $dbh);

    echo "<tr><td colspan=\"2\" align=\"center\">";
    echo "<form action=\"sysadtpingmnggroup.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"OK\"></form></td></tr>";
  }

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=\"sysadtpingmnggroup.php?loginid=$loginid\">Back to Ping hosts - Manage groups</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
