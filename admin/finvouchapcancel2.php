<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$apnumber = $_GET['apn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Cancelling CV record...</b></font></p>";

  $result11 = mysql_query("SELECT acctspayablenumber, payee, date FROM tblfinacctspayable WHERE acctspayablenumber=\"$apnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
//    $acctspayablenumber11 = $myrow11[0];
    $payee11 = $myrow11[1];
    $date11 = $myrow11[2];
  }

  if($accesslevel >= 4 && $accesslevel <= 5)
  {
    $result2 = mysql_query("UPDATE tblfinacctspayable SET payee=\"Cancelled\", debitamt=0, creditamt=0 WHERE acctspayablenumber=\"$apnumber\"", $dbh);

// delete total
    $result15 = mysql_query("UPDATE tblfinacctspayabletot SET date=\"$datenow\", debittot=0, credittot=0, status=\"cancelled\" WHERE acctspayablenumber=\"$apnumber\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Cancelled AP:$apnumber";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }

//  echo "<p><a href=\"finvouchlist.php?loginid=$loginid&rs=ap\">Back to Vouchers List</a></p>";

  header("Location: finvouchlist.php?loginid=$loginid&rs=ap");
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

