<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];

// $bankid = $_POST['bankid'];
// $contactid = $_POST['contactid'];
$bank_name = $_POST['bank_name'];
$bank_branch = $_POST['bank_branch'];
$acct_name = $_POST['acct_name'];
$acct_num = $_POST['acct_num'];
$acct_type = $_POST['acct_type'];
$acct_currency = $_POST['acct_currency'];
$bankacctremarks = $_POST['bankacctremarks'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

//      echo "<p><font size=1>Directory >> Manage Personnel >> Add new bank account</font></p>";

//   echo "<p><font color=green><b>Add new bank account details successful!</b></font></p>";

  $result = mysql_query("SELECT employeeid, name_last, name_first, name_middle FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
  while ($myrow = mysql_fetch_row($result))
  {    
	$found = 1;
	$name_last = $myrow[1];
	$name_first = $myrow[2];
	$name_middle = $myrow[3];
  }
  echo "For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b></p>";

  if ($acct_type == 'Savings')
  {  $acct_type1 = 'Savings';  }
  else if ($acct_type == 'Current')
  {  $acct_type1 = 'Current';  }
  else if ($acct_type == 'Others')
  { $acct_type1 = 'Others';  }
  else {  $acct_type1 = 'Others';  }

  if ($acct_currency == 'Phil. Pesos')
  {  $acct_currency1 = 'Phil. Pesos';  }
  else if ($acct_currency == 'US Dollars')
  {  $acct_currency1 = 'US Dollars';  }
  else if ($acct_currency == 'Others')
  {  $acct_currency1 = 'Others';  }
  else {  $acct_currency1 = 'Others';  }

  $result2 = mysql_query("INSERT INTO tblbankacct (employeeid, bank_name, bank_branch, acct_name, acct_num, acct_type, acct_currency, bankacctremarks) VALUES ('$employeeid', '$bank_name', '$bank_branch', '$acct_name', '$acct_num', '$acct_type1', '$acct_currency1', '$bankacctremarks')", $dbh) or die("Couldn't execute query.".mysql_error());

  $message = "Bank Details Added!";
  $_SESSION['success_message'] = $message;
?>

<script>
			const pid = encodeURIComponent("<?php echo $employeeid; ?>");
			const loginid = encodeURIComponent("<?php echo $loginid; ?>");
			window.location.href = `personneledit2.php?pid=${pid}&loginid=${loginid}`;
		</script>
<?php

//   echo "Details:<br>";
//   echo "bankname:$bank_name<br>";
//   echo "bankbranch:$bank_branch<br>";
//   echo "acctname:$acct_name<br>";
//   echo "acctnum:$acct_num<br>";
//   echo "accttype:$acct_type<br>";
//   echo "acctcurrency:$acct_currency<br>";
//   echo "bankacctremarks:$bankacctremarks<br>";
//   echo "Update Record - OK<br>";

//   echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back to Edit Personnel Info</a></p>";

// create log
    include('datetimenow.php');
    $result16 = mysql_query("SELECT adminuid FROM tbladminlogin WHERE adminloginid=$loginid", $dbh);
    while($myrow16 = mysql_fetch_row($result16))
    { $adminuid=$myrow16[0]; }
    $adminlogdetails = "$loginid:$adminloginuid -Added bank account record of:$employeeid - $name_last, $name_first, $name_middle[0]. Details: bank_name = $bank_name, bank_branch = $bank_branch, acct_name = $acct_name, acct_num = $acct_num, acct_type = $acct_type1, acct_currency = $acct_currency1', bankacctremarks = $bankacctremarks";
    $result17 = mysql_query("INSERT INTO tbladminlogs SET adminloginid=$loginid, timestamp=\"$now\", adminuid=\"$adminuid\", adminlogdetails=\"$adminlogdetails\"", $dbh);

  $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

  
     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 

