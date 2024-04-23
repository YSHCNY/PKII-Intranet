<?php 

require("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$confipaygrpid = $_GET['cpgid'];
$confipayaddid = $_GET['addid'];
$employeeid = $_POST['eid'];
$groupname = $_POST['gn'];

$nameadd = $_POST['nameadd'];
$addtotalamount = $_POST['addtotalamount'];
$addamount = $_POST['addamount'];
$addbalamount = $_POST['addbalamount'];

$startadd = date("Y-m-d", strtotime($_POST['cfpmaddstart']));
$endadd = date("Y-m-d", strtotime($_POST['cfpmaddend']));

$nontaxable = $_POST['nontaxable'];
$statusadd = $_POST['statusadd'];
$addincomevatincl = $_POST['addincomevatincl'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
	if ($startadd <= $endadd)
	{
     echo "<html><head><STYLE TYPE=\"text/css\">";
     echo "<!--";
     echo "TD{font-family: Helvetica; font-size: 10pt;}";
     echo "--->";
     echo "</STYLE></head>";
     echo "<body>";
     echo "<p><b>Other Income Updated</b></p>";

echo "employeeid:$employeeid<br>";
echo "groupname:$groupname<br>";
echo "addid:$confipayaddid<br>";
echo "nameadd:$nameadd<br>";
// echo "addtotalamount:$addtotalamount<br>";
 echo "addamount:$addamount<br>";
// echo "addbalamount:$addbalamount<br>";
echo "startadd:$startadd<br>";
echo "endadd:$endadd<br>";
echo "nontaxable:$nontaxable<br>";
echo "statusadd:$statusadd<br>";
echo "vatinclusive:$addincomevatincl<br>";

     if($nontaxable == 'on')
     {
	$nontaxable2 = 'yes';
     }
     else
     {
	$nontaxable2 = 'no';
     }

     if($addincomevatincl == "on")
     {
	$addincomevatincl = "yes";
     }
     else
     {
	$addincomevatincl = "no";
     }

     if($statusadd == 'on')
     {
	$statusadd2 = 'active';
     }
     else
     {
	$statusadd2 = 'inactive';
     }

echo "nontaxable2:$nontaxable2<br>";

//          $result = mysql_query("UPDATE tblconfipaymemadd SET nameadd='$nameadd', addtotalamount=$addtotalamount, addamount=$addamount, addbalamount=$addbalamount, startadd='$startadd', endadd='$endadd', nontaxable = '$nontaxable2', statusadd='$statusadd2' WHERE employeeid='$employeeid' AND confipayaddid=$confipayaddid", $dbh);

//          $result = mysql_query("UPDATE tblconfipaymemadd SET nameadd='$nameadd', addamount=$addamount, startadd='$startadd', endadd='$endadd', nontaxable = '$nontaxable2', statusadd='$statusadd2' WHERE employeeid='$employeeid' AND confipayaddid=$confipayaddid", $dbh);

          $result = mysql_query("UPDATE tblconfipaymemadd SET timestamp=\"$now\", loginid=$loginid, nameadd='$nameadd', addamount=$addamount, startadd=\"$startadd\", endadd=\"$endadd\", nontaxable = '$nontaxable2', statusadd='$statusadd2', addincomevatincl=\"$addincomevatincl\" WHERE confipaygrpid=$confipaygrpid AND employeeid=\"$employeeid\" AND confipayaddid=$confipayaddid AND groupname=\"$groupname\"", $dbh);

     echo "</html>";
	}
	else
	{
	echo "<html>";
	echo "<h2><font color=red>Date error</h2>";
	echo "<p><b>please check the dates, startdate should be lower than enddate.</b><br>";
	echo "startdate:$startadd<br>";
	echo "enddate:$enddadd</font></p><br>";
	}

}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
