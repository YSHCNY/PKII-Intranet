<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$journalid = $_GET['jid'];
$journalnumber = $_GET['jvn'];

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

//  echo "<p><font color=\"red\"><b>Deleting Journal Voucher item...</b></font></p>";

  $result11 = mysql_query("SELECT date, glcode, glnamedetails, projcode, particulars, debitamt, creditamt FROM tblfinjournal WHERE journalid=$journalid AND journalnumber=\"$journalnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $date11 = $myrow11[0];
    $glcode11 = $myrow11[1];
    $glnamedetails11 = $myrow11[2];
    $projcode11 = $myrow11[3];
    $particulars11 = $myrow11[4];
    $debitamt11 = $myrow11[5];
    $creditamt11 = $myrow11[6];
  }

  $result12 = mysql_query("DELETE FROM tblfinjournal WHERE journalid=$journalid AND journalnumber=\"$journalnumber\"", $dbh);

// recompute total
  $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfinjournal WHERE journalnumber=\"$journalnumber\"", $dbh);
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
  $result15 = mysql_query("UPDATE tblfinjournaltot SET date=\"$datenow\", debittot=$debittot, credittot=$credittot, status=\"$status\" WHERE journalnumber=\"$journalnumber\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted Journal Voucher item from JV:$cvnumber - details:$glcode11;$projcode11;$particulars11;debit:$debitamt11;credit:$creditamt11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

//  echo "<p><a href=\"finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber\">Back to Journal Voucher - Add new entry</a></p>";

  header("Location: finvouchjvnew.php?loginid=$loginid&jvn=$journalnumber");
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

