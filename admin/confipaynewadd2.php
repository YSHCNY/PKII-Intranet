<?php 

require("db1.php");
include("datetimenow.phph");

// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

$nameadd = $_POST['nameadd'];
$addamount = $_POST['addamount'];
// $addtotalamount = $_POST['addtotalamount'];
// $addbalamount = $_POST['addbalamount'];
/*
$monthstart = $_POST['monthstart'];
$daystart = $_POST['daystart'];
$yearstart = $_POST['yearstart'];
$monthend = $_POST['monthend'];
$dayend = $_POST['dayend'];
$yearend = $_POST['yearend'];
$startadd = "$yearstart-$monthstart-$daystart";
$endadd = "$yearend-$monthend-$dayend";
*/
$startadd = date("Y-m-d", strtotime($_POST['cfpmemaddstart']));
$endadd = date("Y-m-d", strtotime($_POST['cfpmemaddend']));

$nontaxable = $_POST['nontaxable'];
$statusadd = $_POST['statusadd'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if ($startadd <= $endadd)
	{
     echo "<html>";
     echo "<head><title>Confidential Payroll</title></head>";
     echo "<body>";
     echo "<h2>New additional income created</h2>";

     if($nontaxable == 'on')
     {
	$nontaxable2 = 'yes';
     }
     else
     {
	$nontaxable2 = 'no';
     }

     if($statusadd == 'on')
     {
	$statusadd2 = 'active';
     }
     else
     {
	$statusadd2 = 'inactive';
     }

	$result = mysql_query("INSERT INTO tblconfipaymemadd (timestamp, loginid, employeeid, groupname, nameadd, addamount, startadd, endadd, nontaxable, statusadd, confipaygrpid) VALUES (\"$now\", $loginid, \"$employeeid\", \"$groupname\", \"$nameadd\", $addamount, \"$startadd\", \"$endadd\", \"$nontaxable2\", \"$statusadd2\", $confipaygrpid)", $dbh);

     echo "employeeid:$employeeid<br>";
     echo "groupname:$groupname<br>";
     echo "nameadd:$nameadd<br>";
//     echo "addtotalamount:$addtotalamount<br>";
     echo "addamount:$addamount<br>";
//     echo "addbalamount:$addbalamount<br>";
     echo "startadd:$startadd<br>";
     echo "endadd:$endadd<br>";
     echo "nontaxable:$nontaxable<br>";
//     echo "nontaxable2:$nontaxable2<br>";
     echo "statusadd:$statusadd<br>";
//     echo "statusadd2:$statusadd2<br>";

     echo "</body></html>";

	}
	else
	{
	echo "<html>";
	echo "<h2><font color=red>Date error</h2>";
	echo "<p><b>please check the dates, startdate should be lower than enddate.</b><br>";
	echo "startdate:$startadd<br>";
	echo "enddate:$endadd</font></p><br>";
	}
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
