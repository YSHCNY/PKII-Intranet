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
     echo "<p><font size=1>Tools >> SysAd Tools >> Ping Hosts >> Delete</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0><tr><td>";

     echo "<table width=100% border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=\"blue\" colspan=\"2\"><font color=white><b>Ping Hosts - Delete</b></font></td></tr>";

// start contents here...

  $result11 = mysql_query("SELECT sysadpingid, hostname, ipaddress, description, type FROM tblsysadping WHERE sysadpingid = '$sysadpingid'", $dbh);
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
  }

  echo "<tr><td colspan=\"2\">Deleting:</td></tr>";
  echo "<tr><td>hostname</td><td>$hostname11</td></tr>";
  echo "<tr><td>ipaddress</td><td>$ipaddress11</td></tr>";
  echo "<tr><td>description</td><td>$description11</td></tr>";
  echo "<tr><td>type</td><td>$type11</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><br><font color=\"red\"><b>Are you sure?</b></font><br></td></tr>";
  echo "<tr><td align=\"center\"><form action=\"sysadtpingdel2.php?loginid=$loginid&id=$sysadpingid\" method=\"post\"><input type=\"submit\" value=\"Yes\"></form></td>";
  echo "<td align=\"center\"><form action=\"sysadtpingconfig.php?loginid=$loginid\" method=\"post\"><input type=\"submit\" value=\"No\"></form></td></tr>";

// end contents here...

     echo "</table></td></tr></table>";

// edit body-footer
     echo "<p><a href=sysadtools.php?loginid=$loginid>Back to Sysad Tools</a></p>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
