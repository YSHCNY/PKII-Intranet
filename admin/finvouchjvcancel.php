<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$jvnumber = $_GET['jvn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  $result11 = mysql_query("SELECT tblfinjournal.journalnumber, tblfinjournal.date, tblfinjournaltot.debittot, tblfinjournaltot.credittot FROM tblfinjournal LEFT JOIN tblfinjournaltot ON tblfinjournal.journalnumber = tblfinjournaltot.journalnumber WHERE tblfinjournal.journalnumber=\"$jvnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $jvnumber11 = $myrow11[0];
    $date11 = $myrow11[1];
    $debittot11 = $myrow11[2];
    $credittot11 = $myrow11[3];
  }

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th colspan=\"2\" align=\"center\">Journal Voucher details</th></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>This will cancel a Journal Voucher</b></font></td></tr>";
  echo "<tr><td colspan=\"2\">Details:<br>";
  echo "CVno:$jvnumber<br>";
  echo "Date:$date11, DebitTotal:$debittot11, CreditTotal:$credittot11</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></td></tr>";
  echo "<tr><td align=\"center\">";

  if($accesslevel >= 4 && $accesslevel <= 5)
  {
    echo "<form method=\"post\" action=\"finvouchjvcancel2.php?loginid=$loginid&jvn=$jvnumber\">";
    echo "<input type=\"submit\" value=\"Yes\"></form>";
  }

  echo "</td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"finvouchjvnew.php?loginid=$loginid&jvn=$jvnumber\">";
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

