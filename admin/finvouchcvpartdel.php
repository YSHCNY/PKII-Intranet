<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$disbursementid = $_GET['did'];
$cvnumber = $_GET['cvn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

  $result11 = mysql_query("SELECT disbursementnumber, disbursementtype, payee, date, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfindisbursement WHERE disbursementid=$disbursementid AND disbursementnumber=\"$cvnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
//    $disbursementnumber11 = $myrow11[0];
//    $disbursementtype11 = $myrow11[1];
    $payee11 = $myrow11[2];
    $date11 = $myrow11[3];
    $glcode11 = $myrow11[4];
    $glnamedetails11 = $myrow11[5];
    $projcode11 = $myrow11[6];
    $particulars11 = $myrow11[7];
    $debitamt11 = $myrow11[8];
    $creditamt11 = $myrow11[9];
  }

  echo "<table class=\"fin\" border=\"1\" spacing=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
  echo "<tr><th colspan=\"2\" align=\"center\">Check Voucher details</th></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><font color=\"red\"><b>Deleting CV property item.</td></tr>";
  echo "<tr><td colspan=\"2\">Details:<br>";
  echo "CVno:$cvnumber<br>";
  echo "Payee:$payee11<br>";
  echo "GLcode:$glcode11, GLname:$glnamedetails11, ProjCode:$projcode11<br>";
  echo "Particulars:$particulars11, Debit:$debitamt11, Credit:$creditamt11</td></tr>";
  echo "<tr><td colspan=\"2\" align=\"center\"><h3>Are you sure?</h3></font></td></tr>";
  echo "<tr><td align=\"center\"><form method=\"post\" action=\"finvouchcvpartdel2.php?loginid=$loginid&did=$disbursementid&cvn=$cvnumber\">";
  echo "<input type=\"submit\" value=\"Yes\"></form></td>";
  echo "<td align=\"center\"><form method=\"post\" action=\"finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber\">";
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

