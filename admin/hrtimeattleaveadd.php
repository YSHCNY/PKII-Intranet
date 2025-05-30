<?php
include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];

$code = $_POST['code'];
$name = $_POST['name'];
$quota = $_POST['quota'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

	// check first if code exists
	$result11=""; $found11=0; $ctr11=0;
	$result11 = mysql_query("SELECT idhrtaleavectg FROM tblhrtaleavectg WHERE code=\"$code\"", $dbh);
	if($result11 != "") {
		while($myrow11 = mysql_fetch_row($result11)) {
		$found11 = 1;
		$idhrtaleavectg11 = $myrow11[0];
		}
	}

	if($found11 == 1) {
		echo "<p><font color=\"red\">Sorry, code exists. Please try again.</p>";
		echo "<p><a href=\"hrtimeattleave.php?loginid=$loginid\">back</a></p>";
	} else {
		// insert into tblhrtapayshiftctg
		$result14 = mysql_query("INSERT INTO tblhrtaleavectg SET timestamp=\"$now\", loginid=$loginid, code=\"$code\", name=\"$name\", quota=$quota", $dbh);
		// create log
  	$result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
		while($myrow16 = mysql_fetch_row($result16))
		{ $adminuid=$myrow16[0]; }
		$adminlogdetails = "$loginid:$adminuid - add new leave category for HR T&A details: $code - $name quota:$quota";
		$result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

	// redirect
	header("Location: hrtimeattleave.php?loginid=$loginid");
	exit;
	}

}
else
{
     include ("logindeny.php");
}
mysql_close($dbh); 
?>
