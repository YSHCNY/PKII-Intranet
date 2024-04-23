<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$loginid = $_GET['loginid'];
$employeetype = $_POST['employeetype'];
$groupname = $_POST['groupname'];

$datecreated = date("Y-m-d");

// echo "vartest group:$groupname<br>";

$found = 0;

$totgrossamt = 0;
$tottaxdeduct = 0;
$tototherdeduct = 0;
$totnetamt = 0;

if($loginid != "")
{
     $result = mysql_query("SELECT * FROM tbladminlogin WHERE adminloginid=$loginid", $dbh); 

     while ($myrow = mysql_fetch_row($result))
     {
          $found = 1;
     }
}

if ($found == 1)
{
     echo "<html>";

     echo "Please fill-up individual details...<br>";

//     echo "<form action=emppayboninfo2.php?loginid=$loginid&groupname=$groupname method=POST name=myform>";

	echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";

//	echo "<tr><td>EmpID</td><td>LastName</td><td>FirstName</td><td>email</td><td>Bank</td><td>AcctNumber</td><td>AcctType</td><td>Gross<br>Amount</td><td>Tax<br>Deduction</td><td>Other<br>Deductions</td><td>Net<br>Amount</td></tr>";

//	echo "<tr><td>EmpID</td><td>LastName</td><td>FirstName</td><td>email</td><td>AcctNumber</td><td>Gross<br>Amount</td><td>Tax<br>Deduction</td><td>Other<br>Deductions</td><td>Net<br>Amount</td><td>Action</td></tr>";

	echo "<tr><td>Count</td><td>EmpID</td><td>LastName</td><td>FirstName</td><td>email</td><td>Gross<br>Amount</td><td>Tax<br>Deduction</td><td>Other<br>Deductions</td><td>Net<br>Amount</td><td>Action</td></tr>";

//	echo "vartest groupname:$groupname<br>";

     $result = mysql_query("SELECT * FROM tblemppaybongrp WHERE groupname = '$groupname'", $dbh);

     while ($myrow = mysql_fetch_row($result))
     {
	$found = 1;
	$employeeid = $myrow[1];
	$groupname1 = $myrow[2];
//	$grossamt = $myrow[8];
//	$taxdeduct = $myrow[9];
//	$otherdeduct = $myrow[10];
//	$netamt = $myrow[11];

//	echo "vartest empid:$employeeid grp:$groupname grp1:$groupname1 gross:$grossamt taxded:$taxdeduct otherded:$otherdeduct net:$netamt<br>";

	$result2 = mysql_query("SELECT employeeid, name_first, name_middle, name_last, email1 FROM tblcontact WHERE employeeid = '$employeeid' ORDER BY name_last ASC", $dbh);

	$found2 = 0;
	$count1 = 0;

	while ($myrow2 = mysql_fetch_row($result2))
	{
		$found2 = 1;
		$employeeid2 = $myrow2[0];
		$name_first = $myrow2[1];
		$name_middle = $myrow2[2];
		$name_last = $myrow2[3];
		$email1 = $myrow2[4];

		$count1 = $count1 + $found2;

//		$result3 = mysql_query("SELECT employeeid, bank_name, acct_num, acct_type FROM tblbankacct WHERE employeeid = '$employeeid'", $dbh);

//		while ($myrow3 = mysql_fetch_row($result3))
//		{
//			$found3 = 1;
//			$employeeid3 = $myrow3[0];
//			$bank_name = $myrow3[1];
//			$acct_num = $myrow3[2];
//			$acct_type = $myrow3[3];

			$result4 = mysql_query("SELECT employeeid, groupname, grossamt, taxdeduct, otherdeduct, netamt FROM tblemppaybonus WHERE employeeid = '$employeeid' AND groupname = '$groupname'", $dbh);

			while ($myrow4 = mysql_fetch_row($result4))
			{
				$found4 = 1;
				$employeeid4 = $myrow4[0];
				$groupname4 = $myrow4[1];

				$grossamt = $myrow4[2];
				$taxdeduct = $myrow4[3];
				$otherdeduct = $myrow4[4];
				$netamt = $myrow4[5];

//			$totgrossamt = $totgrossamt + $grossamt;
//			$tottaxdeduct = $tottaxdeduct + $taxdeduct;
//			$tototherdeduct = $tototherdeduct + $otherdeduct;
//			$totnetamt = $totnetamt + $netamt;

//			echo "<tr><td>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$email1</td><td>$bank_name</td><td>$acct_num</td><td>$acct_type</td>";
//			echo "<td align=right><input name=grossamt[] value=$grossamt></td><td align=right><input name=taxdeduct[] value=$taxdeduct></td><td align=right><input name=otherdeduct[] value=$otherdeduct></td><td align=right><input name=netamt[] value=$netamt></td></tr>";

			echo "<form action=emppayboninfo3.php?loginid=$loginid&groupname=$groupname method=POST name=myform2>";
//			echo "<tr><td><input type=checkbox name=employeeid value=$employeeid checked>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$email1</td><td>$acct_num</td>";
			echo "<tr><td>$count1</td><td><input type=checkbox name=employeeid value=$employeeid checked>$employeeid</td><td>$name_last</td><td>$name_first</td><td>$email1</td>";
			echo "<td align=right><input size=10 name=grossamt value=$grossamt></td>";
			echo "<td align=right><input size=10 name=taxdeduct value=$taxdeduct></td>";
			echo "<td align=right><input size=10 name=otherdeduct value=$otherdeduct></td>";
			echo "<td align=right>$netamt</td>";
			echo "<td><input type=submit value=Update></td></tr>";
			echo "</form>";

			}
//		}

	}
     }

     $result5 = mysql_query("SELECT groupname, grossamt, taxdeduct, otherdeduct, netamt FROM tblemppaybonus WHERE groupname = '$groupname'", $dbh);

     while ($myrow5 = mysql_fetch_row($result5))
     {
	$found5 = 1;
	$groupname = $myrow5[0];
	$grossamt = $myrow5[1];
	$taxdeduct = $myrow5[2];
	$otherdeduct = $myrow5[3];
	$netamt = $myrow5[4];

	$totgrossamt = $totgrossamt + $grossamt;
	$tottaxdeduct = $tottaxdeduct + $taxdeduct;
	$tototherdeduct = $tototherdeduct + $otherdeduct;
	$totnetamt = $totnetamt + $netamt;
     }

     $result6 = mysql_query("SELECT * FROM tblemppaybontotal WHERE groupname = '$groupname'", $dbh);

     while ($myrow6 = mysql_fetch_row($result6))
     {
	$found6 = 1;
	$groupname = $myrow6[1];
     }

     if ($found6 == 1)
     {
	$result7 = mysql_query("UPDATE tblemppaybontotal SET datecreated='$datecreated', totgrossamt=$totgrossamt, tottaxdeduct=$tottaxdeduct, tototherdeduct=$tototherdeduct, totnetamt=$totnetamt WHERE groupname = '$groupname'", $dbh);
     }
     else
     {
	$result8 = mysql_query("INSERT INTO tblemppaybontotal (groupname, datecreated, totgrossamt, tottaxdeduct, tototherdeduct, totnetamt) VALUES ('$groupname', '$datecreated', $totgrossamt, $tottaxdeduct, $tototherdeduct, $totnetamt)", $dbh);
     }

     echo "<tr><td colspan=\"5\">Total</td><td>$totgrossamt</td><td>$tottaxdeduct</td><td>$tototherdeduct</td><td>$totnetamt</td></tr>";

     echo "</table>";
     echo "<p>";
//     echo "<input type=submit value=Save>";
     echo "</form>";

//     echo "<p><a href=emppayboninfo1.php?loginid=$loginid>Back</a><br>";
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
