<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$contactid0 = $_GET['cid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th colspan=\"2\" align=\"center\">Manage Business Contact - Delete contact person</th></tr>";

  $result11 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid0", $dbh);
  if($result11 <> '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $name_last11 = $myrow11[0];
      $name_first11 = $myrow11[1];
      $name_middle11 = $myrow11[2];
    }
  }

  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>Deleting contact person: <b>$name_first11 $name_middle11[0] $name_last11</b></td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></font></td></tr>";
  echo "<tr><td align=\"center\"><form method=\"post\" action=\"businesspersdel2.php?loginid=$loginid&cid=$contactid0\">";
  echo "<input type=\"submit\" value=\"Yes\"></form></td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"businessedit.php?loginid=$loginid\">";
  echo "<input type=\"submit\" value=\"No\"></form></td></tr>";
  echo "</table>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

