<?php 

require("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$confipaydeductid = $_GET['deductid'];
$confipaygrpid = $_POST['cpgid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

$namededuct = $_POST['namededuct'];
$deducttotalamount = $_POST['deducttotalamount'];
$deductamount = $_POST['deductamount'];
$deductbalamount = $_POST['deductbalamount'];
$startdeduct = $_POST['startdeduct'];
$enddeduct = $_POST['enddeduct'];
$statusdeduct = $_POST['statusdeduct'];
$deducttaxable = $_POST['deducttaxable'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>";
     echo "<body>";
     echo "<p><b>Other Deductions Updated</b></p>";

echo "employeeid:$employeeid<br>";
echo "groupname:$groupname<br>";
echo "deductid:$confipaydeductid<br>";
echo "namededuct:$namededuct<br>";
echo "deducttotalamount:$deducttotalamount<br>";
echo "deductamount:$deductamount<br>";
echo "deductbalamount:$deductbalamount<br>";
echo "startdeduct:$startdeduct<br>";
echo "enddeduct:$enddeduct<br>";
echo "statusdeduct:$statusdeduct<br>";
echo "taxable:$deducttaxable<br>";

    if($statusdeduct == 'on')
    {
	$statusdeductval = "active";
    }
    else
    {
	$statusdeductval = "inactive";
    }

    if($deducttaxable == "on")
    {
	$deducttaxableval = "yes";
    }
    else
    {
	$deducttaxableval = "no";
    }

		$result = mysql_query("UPDATE tblconfipaymemdeduct SET timestamp=\"$now\", loginid=$loginid, namededuct=\"$namededuct\", deducttotalamount=$deducttotalamount, deductamount=$deductamount, deductbalamount=$deductbalamount, startdeduct=\"$startdeduct\", enddeduct=\"$enddeduct\", statusdeduct=\"$statusdeductval\", confipaygrpid=$confipaygrpid WHERE employeeid=\"$employeeid\" AND confipaydeductid=$confipaydeductid");
     
     echo "</html>";
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?>
