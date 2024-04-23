<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$finbalshtsecrefid = $_GET['bssrid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if($found == 1)
{
//     include ("header.php");
//     include ("sidebar.php");

	$result11=""; $found11=0;
	$result11 = mysql_query("SELECT code, name FROM tblfinbalshtsecref WHERE finbalshtsecrefid=$finbalshtsecrefid", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$code11 = $myrow11[0];
		$name11 = $myrow11[1];
		}
	}

  // update glcode
    $result12 = mysql_query("DELETE FROM tblfinbalshtsecref WHERE finbalshtsecrefid=$finbalshtsecrefid", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - deleted balanche sheet category. code:$code11 name:$name11 for PKII Voucher module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

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

