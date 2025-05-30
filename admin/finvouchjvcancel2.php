<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$jvnumber = $_GET['jvn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Deleting JV record...</b></font></p>";

  $result11 = mysql_query("SELECT tblfinjournal.journalnumber, tblfinjournal.date, tblfinjournaltot.debittot, tblfinjournaltot.credittot FROM tblfinjournal LEFT JOIN tblfinjournaltot ON tblfinjournal.journalnumber = tblfinjournaltot.journalnumber WHERE tblfinjournal.journalnumber=\"$jvnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $jvnumber11 = $myrow11[0];
    $date11 = $myrow11[1];
    $debittot11 = $myrow11[2];
    $credittot11 = $myrow11[3];
  }

  if($accesslevel >= 4 && $accesslevel <= 5)
  {
    $result2 = mysql_query("UPDATE tblfinjournal SET debitamt=0, creditamt=0 WHERE journalnumber=\"$jvnumber\"", $dbh);

// delete total
    $result15 = mysql_query("UPDATE tblfinjournaltot SET date=\"$datenow\", debittot=0, credittot=0, status=\"cancelled\" WHERE journalnumber=\"$jvnumber\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Cancelled Journal Voucher No.:$jvnumber";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }

//  echo "<p><a href=\"finvouchlist.php?loginid=$loginid&rs=jv\">Back to Vouchers List</a></p>";

  header("Location: finvouchlist.php?loginid=$loginid&rs=jv");
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

