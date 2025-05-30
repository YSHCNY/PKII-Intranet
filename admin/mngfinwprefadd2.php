<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

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

// check if wpacctcode and/or wpacctname exists
  $found11=0; $result11="";
  $result11 = mysql_query("SELECT wprefid, wpacctcd, wpacctname FROM tblfinworkpaperref WHERE glcode=\"$glcode\" AND glrefver=$glrefver", $dbh);
  if($result11 != "")
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
      $wprefid11 = $myrow11[0];
      $wpacctcode11 = $myrow11[1];
      $wpacctname11 = $myrow11[2];
    }
  }

  if($found11 != 1) {
  // insert glcode
    $result12 = mysql_query("INSERT INTO tblfinworkpaperref (wpacctcd, wpacctname, glcode, glrefver, seq, status) VALUES (\"$wpacctcd\", \"$wpacctname\", \"$glcode\", $glrefver, $seq, \"$status\")", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Add new working paper account:$wpacctcd-$wpacctname with glcode:$glcode, ver:$glrefver, seq:$seq, stat:$status for PKII Voucher module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
  // test display only, please comment in production
  // echo "<p>vartest: $adminlogdetails</p>";
  } else {
  // display account exists error message
  }

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

