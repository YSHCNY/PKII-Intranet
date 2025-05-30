<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$contactid0 = $_GET['cid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// query contactid & name
  $result11 = mysql_query("SELECT name_last, name_first, name_middle FROM tblcontact WHERE contactid=$contactid0", $dbh);
  if($result11 <> '')
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $name_last11 = $myrow11[0];
      $name_first11 = $myrow11[1];
      $name_middle11 = $myrow11[2];
    }
  }

// delete record
  $result12 = mysql_query("DELETE FROM tblcontact WHERE contactid=$contactid0", $dbh);


// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Deleted contact person: $contactid0 - $name_first11 $name_middle11 $name_last11";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: businessedit.php?loginid=$loginid");
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

