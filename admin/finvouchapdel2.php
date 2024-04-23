<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$acctspayablenumber = $_GET['apn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Deleting AP record...</b></font></p>";

  $result11 = mysql_query("SELECT acctspayablenumber, payee, date FROM tblfinacctspayable WHERE acctspayablenumber=\"$acctspayablenumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
//    $acctspayablenumber11 = $myrow11[0];
    $payee11 = $myrow11[1];
    $date11 = $myrow11[2];
  }

  if($accesslevel >= 3 && $accesslevel <= 5)
  {
    $result2 = mysql_query("DELETE FROM tblfinacctspayable WHERE acctspayablenumber=\"$acctspayablenumber\"", $dbh);

// delete total
    $result15 = mysql_query("DELETE FROM tblfinacctspayabletot WHERE acctspayablenumber=\"$acctspayablenumber\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted Accts Payable:$acctspayablenumber";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  }

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

