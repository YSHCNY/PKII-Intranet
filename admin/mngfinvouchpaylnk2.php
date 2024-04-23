<?php 

include("db1.php");

$loginid = $_GET['loginid'];

$vouchpayname = trim($_POST['vouchpayname']);
$vouchpaysw = $_POST['vouchpaysw'];
$vouchpaycompanyid = $_POST['vouchpaycompanyid'];
$vouchpaycontactid = $_POST['vouchpaycontactid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
//     include ("sidebar.php");

	echo "<table class=\"fin\">";
  echo "<tr><th colspan=\"8\">Linking payor/payee...</th></tr>";
	echo "<tr><th>ctr</th><th>id</th><th>date</th><th>vouchnumber</th><th>payname</th><th></th><th>company</th><th>contactperson</th></tr>";

  if($accesslevel >= 4 && $accesslevel <= 5) {
		$ctr=0;
		if($vouchpaysw=="company") {
		// query company name
			$result10=""; $found10=0;
			$result10 = mysql_query("SELECT company, branch, company_type FROM tblcompany WHERE companyid=$vouchpaycompanyid", $dbh);
			if($result10 != "") {
				while($myrow10 = mysql_fetch_row($result10)) {
				$found10 = 1;
				$company10 = $myrow10[0];
				$branch10 = $myrow10[1];
				$company_type10 = $myrow10[2];
				}
			}
		// query related records in tblfindisbursement
			$result11=""; $found11=0;
			$result11 = mysql_query("SELECT disbursementid, disbursementnumber, payee, date FROM tblfindisbursement WHERE payee LIKE \"%$vouchpayname%\" ORDER BY date DESC", $dbh);
			if($result11 != "") {
				while($myrow11 = mysql_fetch_row($result11)) {
				$found11=1;
				$disbursementid11 = $myrow11[0];
				$disbursementnumber11 = $myrow11[1];
				$payee11 = $myrow11[2];
				$date11 = $myrow11[3];
				$ctr = $ctr + 1;
				echo "<tr><td>$ctr</td><td>$disbursementid11</td><td>$date11</td><td>$disbursementnumber11</td><td>$vouchpayname</td><td>to</td><td>$vouchpaycompanyid-$company10&nbsp;$branch10-$company_type10</td><td>0</td></tr>";
				// update records in tblfindisbursement
				$result12 = mysql_query("UPDATE tblfindisbursement SET companyid=$vouchpaycompanyid, contactid=0 WHERE disbursementid=$disbursementid11 AND disbursementnumber=\"$disbursementnumber11\" AND payee LIKE \"%$vouchpayname%\" AND (companyid IS NULL OR companyid='')", $dbh);
				}
			}
		// query related records in tblfincashreceipt
			$result12=""; $found12=0;
			$result12 = mysql_query("SELECT cashreceiptid, cashreceiptnumber, payor, date FROM tblfincashreceipt WHERE payor LIKE \"%$vouchpayname%\" ORDER BY date DESC", $dbh);
			if($result12 != "") {
				while($myrow12 = mysql_fetch_row($result12)) {
				$found12=1;
				$cashreceiptid12 = $myrow12[0];
				$cashreceiptnumber12 = $myrow12[1];
				$payor12 = $myrow12[2];
				$date12 = $myrow12[3];
				$ctr = $ctr + 1;
				echo "<tr><td>$ctr</td><td>$cashreceiptid12</td><td>$date12</td><td>$cashreceiptnumber12</td><td>$vouchpayname</td><td>to</td><td>$vouchpaycompanyid-$company10&nbsp;$branch10-$company_type10</td><td>0</td></tr>";
				// update records in tblfincashreceipt
				$result14 = mysql_query("UPDATE tblfincashreceipt SET companyid=$vouchpaycompanyid, contactid=0 WHERE cashreceiptid=$cashreceiptid12 AND cashreceiptnumber=\"$cashreceiptnumber12\" AND payor LIKE \"%$vouchpayname%\" AND (companyid IS NULL OR companyid='')", $dbh);
				}
			}
		} else if($vouchpaysw=="contactperson") {
		// query name of contact person
			$result10=""; $found10=0;
			$result10 = mysql_query("SELECT companyid, employeeid, name_last, name_first, name_middle FROM tblcontact WHERE contactid=$vouchpaycontactid", $dbh);
			if($result10 != "") {
				while($myrow10 = mysql_fetch_row($result10)) {
				$found10=1;
				$companyid10 = $myrow10[0];
				$employeeid10 = $myrow10[1];
				$name_last10 = $myrow10[2];
				$name_first10 = $myrow10[3];
				$name_middle10 = $myrow10[4];
				}
			}
		// query related records in tblfindisbursement
			$result11=""; $found11=0;
			$result11 = mysql_query("SELECT disbursementid, disbursementnumber, payee, date FROM tblfindisbursement WHERE payee LIKE \"%$vouchpayname%\" ORDER BY date DESC", $dbh);
			if($result11 != "") {
				while($myrow11 = mysql_fetch_row($result11)) {
				$found11=1;
				$disbursementid11 = $myrow11[0];
				$disbursementnumber11 = $myrow11[1];
				$payee11 = $myrow11[2];
				$date11 = $myrow11[3];
				$ctr = $ctr + 1;
				echo "<tr><td>$ctr</td><td>$disbursementid11</td><td>$date11</td><td>$disbursementnumber11</td><td>$vouchpayname</td><td>to</td><td>0</td><td>$vouchpaycontactid-$emp$employeeid10-$name_first10&nbsp;$name_middle10[0]&nbsp;$name_last10</td></tr>";
				// update records in tblfindisbursement
				$result12 = mysql_query("UPDATE tblfindisbursement SET companyid=0, contactid=$vouchpaycontactid WHERE disbursementid=$disbursementid11 AND disbursementnumber=\"$disbursementnumber11\" AND payee LIKE \"%$vouchpayname%\" AND (contactid IS NULL OR contactid='')", $dbh);
				}
			}
		// query related records in tblfincashreceipt
			$result12=""; $found12=0;
			$result12 = mysql_query("SELECT cashreceiptid, cashreceiptnumber, payor, date FROM tblfincashreceipt WHERE payor LIKE \"%$vouchpayname%\" ORDER BY date DESC", $dbh);
			if($result12 != "") {
				while($myrow12 = mysql_fetch_row($result12)) {
				$found12=1;
				$cashreceiptid12 = $myrow12[0];
				$cashreceiptnumber12 = $myrow12[1];
				$payor12 = $myrow12[2];
				$date12 = $myrow12[3];
				$ctr = $ctr + 1;
				echo "<tr><td>$ctr</td><td>$cashreceiptid12</td><td>$date12</td><td>$cashreceiptnumber12</td><td>$vouchpayname</td><td>to</td><td>0</td><td>$vouchpaycontactid-$emp$employeeid10-$name_first10&nbsp;$name_middle10[0]&nbsp;$name_last10</td></tr>";
				// update records in tblfincashreceipt
				$result14 = mysql_query("UPDATE tblfincashreceipt SET companyid=0, contactid=$vouchpaycontactid WHERE cashreceiptid=$cashreceiptid12 AND cashreceiptnumber=\"$cashreceiptnumber12\" AND payor LIKE \"%$vouchpayname%\" AND (contactid IS NULL OR contactid='')", $dbh);
				}
			}
		}

		// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid - Linked payor/payee from $vouchpayname to compid:$vouchpaycompanyid or contactid:$vouchpaycontactid-$emp$employeeid10-$name_first10&nbsp;$name_middle10[0]&nbsp;$name_last10, $ctr records modified";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

		echo "<tr><th colspan=\"7\">$adminlogdetails</th></tr>";
  }
		echo "</table>";

  // header("Location: finvouchlist.php?loginid=$loginid");
  // exit;
	echo "<p><a href=\"mngfinvouchpaylnk.php?loginid=$loginid\">back</a></p>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh);

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?>
