<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$cashreceiptid = $_GET['crid'];
$cashreceiptnumber = $_GET['crvn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  $result11 = mysql_query("SELECT date, glcode, glrefver, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptid=$cashreceiptid AND cashreceiptnumber=\"$cashreceiptnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $date11 = $myrow11[0];
    $glcode11 = $myrow11[1];
    $glrefver11 = $myrow11[2];
    $glnamedetails11 = $myrow11[3];
    $projcode11 = $myrow11[4];
    $particulars11 = $myrow11[5];
    $debitamt11 = $myrow11[6];
    $creditamt11 = $myrow11[7];
  }

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th colspan=\"2\" align=\"center\">Cash Receipt details</th></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>Deleting CR property item.</td></tr>";
  echo "<tr><td colspan=\"2\">Details:<br>";
  echo "CRno:$cashreceiptnumber<br>";
  echo "GLcode:$glcode11, GLname:$glnamedetails11, ProjCode:$projcode11<br>";
  echo "Particulars:$particulars11, Debit:$debitamt11, Credit:$creditamt11</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></font></td></tr>";
  echo "<tr><td align=\"center\"><form method=\"post\" action=\"finvouchcrvpartdel2.php?loginid=$loginid&crid=$cashreceiptid&crvn=$cashreceiptnumber\">";
  echo "<input type=\"submit\" value=\"Yes\"></form></td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber\">";
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

