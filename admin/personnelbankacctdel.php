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

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Delete Bank Account Details</b></font></td></tr>";

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

	echo "<tr><td colspan=2>Delete: <b>$bank_name - $bank_branch - $acct_num - $acct_type</b><br>";
	echo "For: <b>$employeeid - $name_last, $name_first $name_middle[0]</b></td></tr>";

	echo "<tr><td colspan=2 align=center><font color=red><b>Are you sure?</b></font></td></tr>";
	echo "<tr><td align=center><form action=personnelbankacctdel2.php?loginid=$loginid&eid=$employeeid&bid=$bankacctid method=post>";
	echo "<input type=submit value='Yes'></form></td>";
	echo "<td align=center><form action=personneledit2.php?loginid=$loginid&pid=$employeeid method=post>";
	echo "<input type=submit value='No'></form></td></tr></table>";

  echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

