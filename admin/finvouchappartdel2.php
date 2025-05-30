<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$acctspayableid = $_GET['apid'];
$apnumber = $_GET['apn'];

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

//  echo "<p><font color=\"red\"><b>Deleting AP item...</b></font></p>";

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

  $result2 = mysql_query("DELETE FROM tblfinacctspayable WHERE acctspayableid=$acctspayableid AND acctspayablenumber=\"$apnumber\"", $dbh);

// recompute total
  $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\"", $dbh);
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
  $result15 = mysql_query("UPDATE tblfinacctspayabletot SET debittot=$debittot, credittot=$credittot, status=\"$status\" WHERE acctspayablenumber=\"$apnumber\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted Accts Payable item from AP:$apnumber - details:$glcode11;$projcode11;$particulars11;debit:$debitamt11;credit:$creditamt11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

//  echo "<p><a href=\"finvouchapnew.php?loginid=$loginid&apn=$apnumber\">Back to Accts Payable - Add new entry</a></p>";

  header("Location: finvouchapnew.php?loginid=$loginid&apn=$apnumber");
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

