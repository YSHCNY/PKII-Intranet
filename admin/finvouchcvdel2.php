<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$disbursementnumber = $_GET['cvn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Deleting CV record...</b></font></p>";

  $result11 = mysql_query("SELECT disbursementnumber, disbursementtype, payee, date FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
//    $disbursementnumber11 = $myrow11[0];
//    $disbursementtype11 = $myrow11[1];
    $payee11 = $myrow11[2];
    $date11 = $myrow11[3];
  }

  if($accesslevel >= 3 && $accesslevel <= 5)
  {
    $result2 = mysql_query("DELETE FROM tblfindisbursement WHERE disbursementnumber=\"$disbursementnumber\"", $dbh);

// delete total
    $result15 = mysql_query("DELETE FROM tblfindisbursementtot WHERE disbursementnumber=\"$disbursementnumber\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted Check Voucher:$disbursementnumber";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }

//  echo "<p><a href=\"finvouchlist.php?loginid=$loginid&rs=cv\">Back to Vouchers List</a></p>";

  header("Location: finvouchlist.php?loginid=$loginid&rs=cv");
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

