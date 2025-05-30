<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$bankacctid = $_GET['bid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Delete bank account</font></p>";

     echo "<p><font color=green><b>Delete Bank Account Record Successful!</b></font></p>";

	$result0 = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow0 = mysql_fetch_row($result0))
	{
//	  $employeeid = $myrow0[0];
	  $name_last = $myrow0[1];
	  $name_first = $myrow0[2];
	  $name_middle = $myrow0[3];
	}

	$result6 = mysql_query("SELECT * FROM tblbankacct WHERE employeeid = '$employeeid' AND bankacctid = $bankacctid", $dbh);
	while ($myrow6 = mysql_fetch_row($result6))
	{
//	  $bankacctid = $myrow6[0];
	  $bankid = $myrow6[1];
//	  $employeeid = $myrow6[2];
	  $contactid = $myrow6[3];
	  $bank_name = $myrow6[4];
	  $bank_branch = $myrow6[5];
	  $acct_name = $myrow6[6];
	  $acct_num = $myrow6[7];
	  $acct_type = $myrow6[8];
	  $bankacctremarks = $myrow6[9];
	}

	$result2 = mysql_query("DELETE FROM tblbankacct WHERE bankacctid = $bankacctid AND employeeid = '$employeeid'", $dbh);

	echo "<p><font color=red>Deleted: <b>$bank_name - $bank_branch - $acct_num - $acct_type</b></font><br>";
	echo "For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></p>";

	echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

