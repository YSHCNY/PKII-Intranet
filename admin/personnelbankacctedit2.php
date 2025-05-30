<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];
$bankacctid = $_GET['bid'];

// $bankid = $_POST['bankid'];
// $contactid = $_POST['contactid'];
$bank_name = $_POST['bank_name'];
$bank_branch = $_POST['bank_branch'];
$acct_name = $_POST['acct_name'];
$acct_num = $_POST['acct_num'];
$acct_type = $_POST['acct_type'];
$acct_currency = $_POST['acct_currency'];
$bankacctremarks = $_POST['bankacctremarks'];
$payrolldflt = $_POST['payrolldflt'];

if($payrolldflt=="on") { $payrolldfltfin=1; } else if($payrolldflt=="") { $payrolldfltfin=0; }

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Edit bank account details</font></p>";

  echo "<p><font color=green><b>Bank account details updated!</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  echo "<p>For: $employeeid - $name_last, $name_first $name_middle[0]</p>";

  $result2 = mysql_query("UPDATE tblbankacct SET bank_name=\"$bank_name\", bank_branch=\"$bank_branch\", acct_name=\"$acct_name\",
	acct_num=\"$acct_num\", acct_type=\"$acct_type\", acct_currency=\"$acct_currency\", bankacctremarks=\"$bankacctremarks\", payrolldflt=$payrolldfltfin	WHERE employeeid=\"$employeeid\" AND bankacctid=$bankacctid", $dbh);

  echo "Details:<br>";
  echo "bankname:$bank_name<br>";
  echo "bankbranch:$bank_branch<br>";
  echo "acctname:$acct_name<br>";
  echo "acctnum:$acct_num<br>";
  echo "accttype:$acct_type<br>";
  echo "acctcurrency:$acct_currency<br>";
  echo "bankacctremarks:$bankacctremarks<br>";
	echo "payrolldefault:$payrolldfltfin<br>";

	// check if multiple bank accts and payroll default is active, then disable payroll default from other bank acct records
	echo "otherid:";
	$res3query="SELECT bankacctid FROM tblbankacct WHERE employeeid=\"$employeeid\" AND bankacctid<>$bankacctid";
	$result3=""; $found3=0; $ctr3=0;
	$result3 = mysql_query("$res3query", $dbh);
	if($result3!="") {
		while($myrow3 = mysql_fetch_row($result3)) {
		$found3 = 1;
		$bankacctid3 = $myrow3[0];
		if($found3 == 1) {
			$result4 = mysql_query("UPDATE tblbankacct SET payrolldflt=0 WHERE bankacctid=$bankacctid3", $dbh);
			echo "$bankacctid3=0&nbsp;";
		}
		}
	}
  echo "<br>Record updated - OK";

  echo "<p>";

  echo "<a href=personnelbankacctedit.php?loginid=$loginid&eid=$employeeid&bid=$bankacctid>Back to Edit Bank Account</a><br>";

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

