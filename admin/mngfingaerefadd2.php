<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$gaecd = trim($_POST['gaecd']);
$acctname = trim($_POST['acctname']);
$seq = $_POST['seq'];
$glcodefr = trim($_POST['glcodefr']);
$glcodeto = trim($_POST['glcodeto']);
$version = $_POST['version'];
$status = $_POST['status'];
$remarks = $_POST['remarks'];

if($status == '') { $statusfin='active'; }
if($remarks == '') { $remarksfin=''; }

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
/*
  $found11=0; $result11="";
  $result11 = mysql_query("SELECT gaecd, gaename, glcodefr, glcodeto FROM tblfingaeref WHERE gaecd=\"$gaecd\" OR gaename=\"$acctname\"", $dbh);
  if($result11 != "")
  {
    while($myrow11 = mysql_fetch_row($result11))
    {
      $found11 = 1;
			$gaecd11 = $myrow11[0];
      $gaename11 = $myrow11[1];
			$glcodefr11 = $myrow11[2];
			$glcodeto11 = $myrow11[3];
    }
  }
*/

//  if($found11 != 1) {
  // insert glcode
    $result12 = mysql_query("INSERT INTO tblfingaeref SET timestamp=\"$now\", loginid=$loginid, datecreated=\"$datenow\", gaecd=\"$gaecd\", gaename=\"$acctname\", glcodefr=\"$glcodefr\", glcodeto=\"$glcodeto\", version=$version, seq=$seq, status=\"$statusfin\", remarks=\"$remarksfin\"", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - Add new GAE ref code: cd:$gaecd acctname:$acctname glcodes:$glcodefr-to-$glcodeto ver:$version seq:$seq for PKII Voucher sub-module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);
//  }

  header("Location: mngfingaeref.php?loginid=$loginid&ver=$glrefver");
  exit;

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

