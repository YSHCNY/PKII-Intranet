<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$wprefid = $_GET['wpid'];

$wpacctcd = trim($_POST['wpacctcd']);
$wpacctname = trim($_POST['wpacctname']);
$seq = $_POST['seq'];
$glcode = trim($_POST['glcode']);
$glrefver = $_POST['glrefver'];

$status = "active";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

  // insert glcode
    $result12 = mysql_query("UPDATE tblfinworkpaperref SET wpacctcd=\"$wpacctcd\", wpacctname=\"$wpacctname\", glcode=\"$glcode\", glrefver=$glrefver, seq=$seq, status=\"$status\" WHERE wprefid=$wprefid", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Modified working paper account:$wpacctcd-$wpacctname with glcode:$glcode, ver:$glrefver, seq:$seq, stat:$status for PKII Voucher module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  // test display only, please comment in production
  // echo "<p>vartest: $adminlogdetails</p>";

  header("Location: mngfinwpref.php?loginid=$loginid");
  exit;

//echo "<a href=\"mngfinwpref.php?loginid=$loginid\">Back</a>";
//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

