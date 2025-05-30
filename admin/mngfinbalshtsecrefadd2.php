<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$code = trim($_POST['code']);
$name = trim($_POST['name']);
$remarks = trim($_POST['remarks']);

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

// check if wpacctcode and/or wpacctname exists
  $found11=0; $result11="";
  $result11 = mysql_query("SELECT code, name FROM tblfinbalshtsecref WHERE code=\"$code\" OR name=\"$name\"", $dbh);
  if($result11 != "")
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $code11 = $myrow11[0];
			$name11 = $myrow11[1];
    }
  }

  if($found11 != 1) {
  // insert glcode
    $result12 = mysql_query("INSERT INTO tblfinbalshtsecref SET timestamp=\"$now\", loginid=$loginid, code=\"$code\", name=\"$name\", remarks=\"$remarks\"", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Add new balanche sheet category: code:$code name:$name rem:$remarks for PKII Voucher - Balance Sheet management module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  } else {
  // display account exists error message
  }

  header("Location: mngfinbalshtsecref.php?loginid=$loginid");
  exit;

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

