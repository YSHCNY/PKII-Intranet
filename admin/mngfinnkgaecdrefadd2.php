<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$gaecd = trim($_POST['nkgaecd']);
$acctname = trim($_POST['nkgaeacctname']);
$seq = $_POST['seq'];

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
  $result11 = mysql_query("SELECT idgaenkref, gaenkacctname FROM tblfingaenkref WHERE gaenkacctname=\"$acctname\"", $dbh);
  if($result11 != "")
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
			$idgaenkref11 = $myrow11[0];
      $gaenkacctname11 = $myrow11[1];
    }
  }

  if($found11 != 1) {
  // insert glcode
    $result12 = mysql_query("INSERT INTO tblfingaenkref SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", gaenkcd=\"$gaecd\", gaenkacctname=\"$acctname\", seq=$seq", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Add new GAE (NK) ref code:$gaecd acctname:$acctname seq:$seq for PKII Voucher sub-module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  } else {
  // display account exists error message
  }

  header("Location: mngfinnkgaecdref.php?loginid=$loginid");
  exit;

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

