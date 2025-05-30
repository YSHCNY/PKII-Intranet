<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$idfingaeref = $_GET['gaeid'];

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
	$result11 = mysql_query("SELECT datecreated, gaecd, gaename, glcodefr, glcodeto, seq, version FROM tblfingaeref WHERE idfingaeref=$idfingaeref", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$datecreated11 = $myrow11[0];
		$gaecd11 = $myrow11[1];
		$gaename11 = $myrow11[2];
		$glcodefr11 = $myrow11[3];
		$glcodeto11 = $myrow11[4];
		$seq11 = $myrow11[5];
		$version11 = $myrow11[6];
		}
	}

  // delete gae ref record
    $result12 = mysql_query("DELETE FROM tblfingaeref WHERE idfingaeref=$idfingaeref", $dbh);

  // create log
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminuid - deleted GAE ref code. cd:$gaecd11 name:$gaename11 glcodes:$glcodefr11-to-$glcodeto11 ver:$version11 seq:$seq11 for PKII Voucher - GAE module";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

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

