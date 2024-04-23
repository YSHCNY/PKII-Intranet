<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$wprefid0 = $_GET['wpid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// check if details
  $result11 = mysql_query("SELECT glcode, glname, glrefver FROM tblfinworkpaperref WHERE wprefid=$wprefid0", $dbh);
  if($result11 != '')
  {
    while($myrow11=mysql_fetch_row($result11))
    {
      $found11 = 1;
      $glcode11 = $myrow11[0];
      $glname11 = $myrow11[1];
      $glrefver11 = $myrow11[2];
    }
  }

// delete record
  $result12 = mysql_query("DELETE FROM tblfinworkpaperref WHERE wprefid=$wprefid0", $dbh);

// create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Delete acct code:$glcode11-$glname11 ver:$glrefver11 of Working Paper from PKII Voucher module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: mngfinwpref.php?loginid=$loginid");
  exit;


//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

