<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$month11 = $_GET['gd'];

$cutarrmonth11 = split("-", $month11);
$cutarryear = $cutarrmonth11[0];
$cutarrmonth = $cutarrmonth11[1];

$cutarrmonthname = date("F", mktime(0, 0, 0, $cutarrmonth));

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
  echo "<tr><th colspan=\"2\" align=\"center\">PKII Voucher Working Paper - Delete processed month</th></tr>";

  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>Deleting: <b>$cutarryear $cutarrmonthname</b></td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></font></td></tr>";
  echo "<tr><td align=\"center\"><form method=\"post\" action=\"finvouchworkpgendel2.php?loginid=$loginid&gd=$month11\">";
  echo "<input type=\"submit\" value=\"Yes\"></form></td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"finvouchworkpgen.php?loginid=$loginid\">";
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

