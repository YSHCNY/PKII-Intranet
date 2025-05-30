<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$apnumber = $_GET['apn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  $result11 = mysql_query("SELECT tblfinacctspayable.acctspayablenumber, tblfinacctspayable.payee, tblfinacctspayable.date, tblfinacctspayabletot.debittot, tblfinacctspayabletot.credittot FROM tblfinacctspayable LEFT JOIN tblfinacctspayabletot ON tblfinacctspayable.acctspayablenumber = tblfinacctspayabletot.acctspayablenumber WHERE tblfinacctspayable.acctspayablenumber=\"$apnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
//    $acctspayablenumber11 = $myrow11[0];
    $payee11 = $myrow11[1];
    $date11 = $myrow11[2];
    $debittot11 = $myrow11[3];
    $credittot11 = $myrow11[4];
  }

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th colspan=\"2\" align=\"center\">Accts Payable details</th></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>This will cancel an AP</b></font></td></tr>";
  echo "<tr><td colspan=\"2\">Details:<br>";
  echo "APno:$apnumber<br>";
  echo "Payee:$payee11<br>";
  echo "Date:$date11, DebitTotal:$debittot11, CreditTotal:$credittot11</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></td></tr>";
  echo "<tr><td align=\"center\">";

  if($accesslevel >= 4 && $accesslevel <= 5)
  {
    echo "<form method=\"post\" action=\"finvouchapcancel2.php?loginid=$loginid&apn=$apnumber\">";
    echo "<input type=\"submit\" value=\"Yes\"></form>";
  }

  echo "</td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"finvouchlist.php?loginid=$loginid&rs=ap\">";
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

