<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$journalnumber = $_GET['jvn'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

//  echo "<p><font color=\"red\"><b>Deleting Journal record...</b></font></p>";

  $result11 = mysql_query("SELECT journalid, journalnumber, date, glcode, glrefver, glnamedetails, projcode, particulars FROM tblfinjournal WHERE journalnumber=\"$journalnumber\"", $dbh);
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $journalid11 = $myrow11[0];
    $journalnumber11 = $myrow11[1];
    $date11 = $myrow11[2];
    $glcode11 = $myrow11[3];
    $glrefver11 = $myrow11[4];
    $glnamedetails11 = $myrow11[5];
    $projcode11 = $myrow11[6];
    $particulars11 = $myrow11[7];
   }

  if($accesslevel >= 3 && $accesslevel <= 5)
  {
    $result2 = mysql_query("DELETE FROM tblfinjournal WHERE journalnumber=\"$journalnumber\"", $dbh);

// delete total
    $result15 = mysql_query("DELETE FROM tblfinjournaltot WHERE journalnumber=\"$journalnumber\"", $dbh);

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted Journal Voucher:$journalnumber";
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

