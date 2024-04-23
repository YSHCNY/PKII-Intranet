<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$acctspayableid = $_GET['apid'];
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

  $result11 = mysql_query("SELECT acctspayablenumber, payee, date, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinacctspayable WHERE acctspayableid=$acctspayableid AND acctspayablenumber=\"$apnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
//    $acctspayablenumber11 = $myrow11[0];
    $payee11 = $myrow11[1];
    $date11 = $myrow11[2];
    $glcode11 = $myrow11[3];
    $glnamedetails11 = $myrow11[4];
    $projcode11 = $myrow11[5];
    $particulars11 = $myrow11[6];
    $debitamt11 = $myrow11[7];
    $creditamt11 = $myrow11[8];
  }

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th colspan=\"2\" align=\"center\">Accts Payable details</th></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>Deleting AP property item.</td></tr>";
  echo "<tr><td colspan=\"2\">Details:<br>";
  echo "APno:$apnumber<br>";
  echo "Payee:$payee11<br>";
  echo "GLcode:$glcode11, GLname:$glnamedetails11, ProjCode:$projcode11<br>";
  echo "Particulars:$particulars11, Debit:$debitamt11, Credit:$creditamt11</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></font></td></tr>";
  echo "<tr><td align=\"center\"><form method=\"post\" action=\"finvouchappartdel2.php?loginid=$loginid&apid=$acctspayableid&apn=$apnumber\">";
  echo "<button type=\"submit\" class=\"btn btn-success\">Yes</button></form></td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber\">";
  echo "<button type=\"submit\" class=\"btn btn-danger\">No</button></form></td></tr>";
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

