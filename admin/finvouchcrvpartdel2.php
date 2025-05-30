<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$cashreceiptid = $_GET['crid'];
$cashreceiptnumber = $_GET['crvn'];

$status = "pending";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Deleting Cash Receipt Voucher...</b></font></p>";

  $result11 = mysql_query("SELECT cashreceiptnumber, date, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptid=$cashreceiptid AND cashreceiptnumber=\"$cashreceiptnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
//    $cashreceiptnumber11 = $myrow11[0];
    $date11 = $myrow11[1];
    $glcode11 = $myrow11[2];
    $glnamedetails11 = $myrow11[3];
    $projcode11 = $myrow11[4];
    $particulars11 = $myrow11[5];
    $debitamt11 = $myrow11[6];
    $creditamt11 = $myrow11[7];
  }

  $result12 = mysql_query("DELETE FROM tblfincashreceipt WHERE cashreceiptid=$cashreceiptid AND cashreceiptnumber=\"$cashreceiptnumber\"", $dbh);

// recompute total
  $found14 = 0;
  $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfincashreceipt WHERE cashreceiptnumber=\"$cashreceiptnumber\"", $dbh);
  while($myrow14 = mysql_fetch_row($result14))
  {
    $found14 = 1;
    $debitamt14 = $myrow14[0];
    $creditamt14 = $myrow14[1];

    $debittot = $debittot + $debitamt14;
    $credittot = $credittot + $creditamt14;

    $debitamt14 = 0;
    $creditamt14 = 0;
  }

// update total
  if($found14 == 1)
  {
    $result15 = mysql_query("UPDATE tblfincashreceipttot SET date=\"$datenow\", debittot=$debittot, credittot=$credittot, status=\"$status\" WHERE cashreceiptnumber=\"$cashreceiptnumber\"", $dbh);
  }
  else
  {
    $result15 = mysql_query("INSERT INTO tblfincashreceipttot SET cashreceiptnumber=\"$cashreceiptnumber\", date=\"$datenow\", debittot=$debittot, credittot=$credittot, status=\"$status\"", $dbh);
  }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted Cash Receipt Voucher item from CR:$cashreceiptnumber - details:$glcode11;$projcode11;$particulars11;debit:$debitamt11;credit:$creditamt11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: finvouchcrvnew.php?loginid=$loginid&crvn=$cashreceiptnumber");
  exit;

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

