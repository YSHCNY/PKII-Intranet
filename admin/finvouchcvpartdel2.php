<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$disbursementid = $_GET['did'];
$cvnumber = $_GET['cvn'];

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

//  echo "<p><font color=\"red\"><b>Deleting CV particulars...</b></font></p>";

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
  $result2 = mysql_query("DELETE FROM tblfindisbursement WHERE disbursementid=$disbursementid AND disbursementnumber=\"$cvnumber\"", $dbh);

// recompute total
  $result14 = mysql_query("SELECT debitamt, creditamt FROM tblfindisbursement WHERE disbursementnumber=\"$cvnumber\"", $dbh);
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

  $result16 = mysql_query("SELECT disbursementtotid FROM tblfindisbursementtot WHERE disbursementnumber=\"$cvnumber\"", $dbh);
  while($myrow16 = mysql_fetch_row($result16))
  {
    $found16 = 1;
    $disbursementtotid16 = $myrow16[0];
  }

// update total
  if($found16 == 1)
  {
    $result15 = mysql_query("UPDATE tblfindisbursementtot SET date=\"$date11\", debittot=$debittot, credittot=$credittot, status=\"$status\" WHERE disbursementnumber=\"$cvnumber\"", $dbh);
  }
  else
  {
    $result15 = mysql_query("INSERT INTO tblfindisbursementtot SET disbursementnumber=\"$cvnumber\", date=\"$date11\", debittot=$debittot, credittot=$credittot, status=\"$status\"", $dbh);
  }

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted Check Voucher item from CV:$cvnumber - details:$glcode11;$projcode11;$particulars11;debit:$debitamt11;credit:$creditamt11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: finvouchcvnew.php?loginid=$loginid&cvn=$cvnumber");
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
