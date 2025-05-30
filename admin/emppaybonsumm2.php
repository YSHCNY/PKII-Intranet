<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];

$groupname = $_POST['groupname'];

$found = 0;

if($loginid != "")
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid AND adminloginstat=1", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;
          
          $loginid = $myrow[0];
          $username = $myrow[1];
          $loginstatus = $myrow[5];
          $level = $myrow[6];
     }
}

if ($found == 1)
{
     echo "<h2>Personnel Bonus Pay Summary</h2>";

	echo "<table border=1 spacing=1>";
	echo "<tr><td>EmpID</td><td>LastName</td><td>FirstName</td><td>email</td><td>Bank</td><td>AcctNumber</td><td>AcctType</td><td>GrossAmount</td><td>TaxDeduction</td><td>OtherDeductions</td><td>NetAmount</td></tr>";

//	echo "vartest groupname:$groupname<br>";

     $result = mysql_query("SELECT * FROM tblemppaybonus WHERE groupname = '$groupname'", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {
	$found = 1;
	$employeeid = $myrow[1];
	$groupname1 = $myrow[2];
	$grossamt = $myrow[8];
	$taxdeduct = $myrow[9];
	$otherdeduct = $myrow[10];
	$netamt = $myrow[11];

//	echo "vartest empid:$employeeid grp:$groupname grp1:$groupname1 gross:$grossamt taxded:$taxdeduct otherded:$otherdeduct net:$netamt<br>";

	$result2 = mysql_query("SELECT employeeid, name_first, name_middle, name_last, email1 FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);

	while ($myrow2 = mysql_fetch_row($result2))
	{
		$found2 = 1;
		$employeeid2 = $myrow2[0];
		$name_first = $myrow2[1];
		$name_middle = $myrow2[2];
		$name_last = $myrow2[3];
		$email1 = $myrow2[4];

		$result3 = mysql_query("SELECT employeeid, bank_name, acct_num, acct_type FROM tblbankacct WHERE employeeid = '$employeeid'", $dbh);

		while ($myrow3 = mysql_fetch_row($result3))
		{
			$found3 = 1;
			$employeeid3 = $myrow3[0];
			$bank_name = $myrow3[1];
			$acct_num = $myrow3[2];
			$acct_type = $myrow3[3];

			$totgrossamt = $totgrossamt + $grossamt;
			$tottaxdeduct = $tottaxdeduct + $taxdeduct;
			$tototherdeduct = $tototherdeduct + $otherdeduct;
			$totnetamt = $totnetamt + $netamt;

			echo "<tr><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$email1</td><td>$bank_name</td><td>$acct_num</td><td>$acct_type</td><td align=right>$grossamt</td><td align=right>$taxdeduct</td><td align=right>$otherdeduct</td><td align=right>$netamt</td></tr>";
		}

	}
     }

	echo "<tr><td colspan=7 align=right><b>Total</b></td><td align=right><b>$totgrossamt</b></td><td align=right>$tottaxdeduct</td><td align=right>$tototherdeduct</td><td align=right><b>$totnetamt</b></td></tr>";

     echo "</table>";

     echo "</html>";
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
