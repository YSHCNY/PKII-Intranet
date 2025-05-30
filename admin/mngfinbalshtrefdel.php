<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$finbalshtrefid = $_GET['bsid'];

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
	$result11 = mysql_query("SELECT datecreated, createdby, tabpos, acctname, glcodefr, glcodeto, glrefver, seq FROM tblfinbalshtref WHERE finbalshtrefid=$finbalshtrefid", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$datecreated11 = $myrow11[0];
		$createdby11 = $myrow11[1];
		$tabpos11 = $myrow11[2];
		$acctname11 = $myrow11[3];
		$glcodefr11 = $myrow11[4];
		$glcodeto11 = $myrow11[5];
		$glrefver11 = $myrow11[6];
		$seq11 = $myrow11[7];
		}
	}

  // update glcode
    $result12 = mysql_query("DELETE FROM tblfinbalshtref WHERE finbalshtrefid=$finbalshtrefid", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - deleted balanche sheet account code. tab:$tabpos11 name:$acctname11 glcodes:$glcodefr11-to-$glcodeto11 ver:$glrefver11 seq:$seq11 for PKII Voucher module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  header("Location: mngfinbalshtref.php?loginid=$loginid&ver=$glrefver");
  exit;

//     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

