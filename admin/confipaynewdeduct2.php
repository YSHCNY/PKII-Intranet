<?php 

require("db1.php");
include("datetimenow.php");

// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

$namededuct = $_POST['namededuct'];
$deductamount = $_POST['deductamount'];
$deducttotalamount = $_POST['deducttotalamount'];
$deductbalamount = $_POST['deductbalamount'];
$startdeduct = $_POST['startdeduct'];
$enddeduct = $_POST['enddeduct'];
$statusdeduct = $_POST['statusdeduct'];

if($statusdeduct=="on") {
	$statusval="active";
} else {
	$statusval="incative";
}

$found = 0;

if($loginid != "")
{
	include("logincheck.php");
}

if ($found == 1)
{
     echo "<html>";
     echo "<body>";
     echo "<h2>New other deduction created</h2>";

	$result = mysql_query("INSERT INTO tblconfipaymemdeduct (timestamp, loginid, employeeid, groupname, namededuct, deducttotalamount, deductamount, deductbalamount, startdeduct, enddeduct, statusdeduct, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$namededuct\", $deducttotalamount, $deductamount, $deductbalamount, \"$startdeduct\", \"$enddeduct\", \"$statusval\", $confipaygrpid)", $dbh);

		echo "cpgid:$confipaygrpid<br>";
     echo "employeeid:$employeeid<br>";
     echo "namededuct:$namededuct<br>";
     echo "deducttotalamount:$deducttotalamount<br>";
     echo "deductamount:$deductamount<br>";
     echo "deductbalamount:$deductbalamount<br>";
     echo "startdeduct:$startdeduct<br>";
     echo "enddeduct:$enddeduct<br>";
     echo "statusdeduct:$statusdeduct<br>";

     echo "</body></html>";
}
else
{
     echo "<html>";
     
     echo "You are not logged in<br>";
     echo "<a href=login.htm>Login</a><br>";

     echo "</html>";
}

mysql_close($dbh);
?> 
