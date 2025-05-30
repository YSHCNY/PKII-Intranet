<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$pid = $_GET['pid'];
$groupname = $_GET['gn'];
$confipayaddid = $_GET['addid'];

$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];

$newdate = "$year-$month-$day";

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{

	echo "<html><body>";
	echo "<p><b>Update successful!</b></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$pid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result1 = mysql_query("SELECT tblconfipaymemadd.confipayaddid, tblconfipaymemadd.employeeid, tblconfipaymemadd.nameadd, tblconfipaymemadd.endadd FROM tblconfipaymemadd WHERE tblconfipaymemadd.confipayaddid=$confipayaddid AND tblconfipaymemadd.employeeid='$pid'", $dbh);
	while ($myrow1 = mysql_fetch_row($result1))
	{
	  $found1 = 1;
	  $confipayaddid = $myrow1[0];
          $employeeid = $myrow1[1];
	  $nameadd = $myrow1[2];
	  $endadd = $myrow1[3];
	}

	$result = mysql_query("UPDATE tblconfipaymemadd SET endadd = \"$newdate\"
		WHERE confipayaddid=$confipayaddid AND employeeid=\"$pid\"", $dbh) or die ("Couldn't execute query.".mysql_error());

	echo "endadd = $newdate<br>";
	echo "Update Record - OK<br>";

	echo "<p>End date of $nameadd was changed for: <b>$pid - $name_last, $name_first $name_middle[0]</b></p>";

  echo "<p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     echo "<p><a href=\"confipay3.php?eid=$employeeid&loginid=$loginid&gn=$groupname\">Back to personnel payroll details</a><br>";

	echo "</body></html>";

}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

