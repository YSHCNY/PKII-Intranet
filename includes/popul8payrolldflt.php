<?php

// this script will query maindb.tblbankacct for single record of an employeeid and shall update to mark as payroll default

// require('../admin/db1.php');
$hostname = 'localhost';
$dbname = 'maindb';
$dbuser = 'root';
$dbuserpass = '';

$dbh = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $dbh) or die("Database Error");

include('../admin/datetimenow.php');

?>
<html>
<head><title></title></head>
<body>
<table border=1>
<?php

$res11query="SELECT DISTINCT tblbankacct.employeeid, tblcontact.name_first, tblcontact.name_last FROM tblbankacct LEFT JOIN tblcontact ON tblbankacct.employeeid=tblcontact.employeeid WHERE tblbankacct.bank_name LIKE \"%BPI%\" AND tblcontact.contact_type=\"personnel\" ORDER BY tblbankacct.employeeid ASC";
$result11=""; $found11=0; $ctr11=0;
$result11 = mysql_query("$res11query", $dbh);
if($result11 != "") {
	while($myrow11 = mysql_fetch_row($result11)) {
	$found11 = 1;
	$ctr11 = $ctr11 + 1;
	$employeeid11 = $myrow11[0];
	$name_first11 = $myrow11[1];
	$name_last11 = $myrow11[2];
	echo "<tr><td>$ctr11</td><td>$employeeid11</td><td>$name_last11, $name_first11</td>";
	$res12query="SELECT count(bankacctid) FROM tblbankacct WHERE bank_name LIKE \"%BPI%\" AND employeeid=\"$employeeid11\"";
	$result12=""; $found12=0; $ctr12=0;
	$result12 = mysql_query("$res12query", $dbh);
	if($result12 != "") {
		while($myrow12 = mysql_fetch_row($result12)) {
		$found12 = 1;
		$idctr12 = $myrow12[0];
		if($idctr12==1) {
			$res14query="SELECT bankacctid, bank_name, bank_branch, acct_type, payrolldflt FROM tblbankacct WHERE bank_name LIKE \"%BPI%\" AND employeeid=\"$employeeid11\"";
			$result14=""; $found14=0; $ctr14=0;
			$result14 = mysql_query("$res14query", $dbh);
			if($result14 != "") {
				while($myrow14 = mysql_fetch_row($result14)) {
				$found14 = 1;
				$bankacctid14 = $myrow14[0];
				$bank_name14 = $myrow14[1];
				$bank_branch14 = $myrow14[2];
				$acct_type14 = $myrow14[3];
				$payrolldflt14 = $myrow14[4];
				echo "<td>$bankacctid14</td><td>$bank_name14</td><td>$bank_branch14</td><td>$acct_type14</td><td>$payrolldflt14</td>";
				$result15 = mysql_query("UPDATE tblbankacct SET payrolldflt=1 WHERE bankacctid=$bankacctid14 AND employeeid=\"$employeeid11\" AND bank_name LIKE \"%BPI%\"", $dbh);
				$res16query="SELECT payrolldflt FROM tblbankacct WHERE bankacctid=$bankacctid14 AND employeeid=\"$employeeid11\" AND bank_name LIKE \"%BPI%\"";
				$result16=""; $found16=0; $ctr16=0;
				$result16 = mysql_query("$res16query", $dbh);
				if($result16 != "") {
					while($myrow16 = mysql_fetch_row($result16)) {
					$found16 = 1;
					$payrolldflt16 = $myrow16[0];
					echo "<td>vs</td><th><font color=\"green\">$payrolldflt16</font></th>";
					}
				}
				}
			}
		}
		}
	}
	echo "</tr>";
	}
}
?>
</table></body></html>
<?php
mysql_close($dbh);
?>
