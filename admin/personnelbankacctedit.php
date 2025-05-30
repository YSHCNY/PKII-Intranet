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

	 $result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	 while ($myrow = mysql_fetch_row($result))
	 {
	   $found = 1;
	   $name_last = $myrow[0];
	   $name_first = $myrow[1];
	   $name_middle = $myrow[2];
	   $position = $myrow[3];
	 }
     echo "<div class='shadow border px-4 py-3'><h4>Edit Personnel's Bank Details For: $name_last, $name_first $name_middle[0] ($employeeid) - $position</h4></div>";
 
	


     if ($employeeid == '')
     {
	echo "<tr><td><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {


// start edit bank details

	echo "<form action=personnelbankacctedit2.php?loginid=$loginid&eid=$employeeid&bid=$bankacctid method=post class = 'shadow p-4 mt-4 border'>";
	echo "<table class=\"table table-striped table-hover table-bordered border\" >";

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
	  $acct_currency = $myrow6[9];
	  $bankacctremarks = $myrow6[10];
		$payrolldflt = $myrow6[11];
	}

	  echo "<tr><td align=\"right\">Bank Name</td><th align=\"left\"><input class = 'form-control' name=bank_name value=\"$bank_name\"></th></tr>";
	  echo "<tr><td align=\"right\">Branch</td><th align=\"left\"><input class = 'form-control' name=bank_branch value=\"$bank_branch\"></th></tr>";
	  echo "<tr><td align=\"right\">Account No.</td><th align=\"left\"><input class = 'form-control' name=acct_num value=\"$acct_num\"></th></tr>";

	  echo "<tr><td align=\"right\">Type</td><td>";
	  echo "<select class = 'form-select h5 py-3' name=acct_type>";
	  if ($acct_type == 'Savings')
	  {
		$savingsselected = 'selected';
	  } else if ($acct_type == 'Current')
	  {
		$currentselected = 'selected';
	  } else { $othersselected = 'selected'; }  
	  echo "<option name=Savings $savingsselected>Savings</option>";
	  echo "<option name=Current $currentselected>Current</option>";
	  echo "<option name=Others $othersselected>Others</option>";
	  echo "</select></th></tr>";

	  echo "<tr><td align=\"right\">Currency</td><th align=\"left\">";
	  echo "<select class = 'form-select h5 py-3' name=acct_currency>";
	  if ($acct_currency == 'Phil. Pesos')
	  {
		$pesoselected = 'selected';
	  } else if ($acct_currency == 'US Dollars')
	  {
		$usdselected = 'selected';
	  } else { $othersselected = 'selected'; }  
	  echo "<option name=\"Phil. Pesos\" $pesoselected>Phil. Pesos</option>";
	  echo "<option name=\"US Dollars\" $usdselected>US Dollars</option>";
	  echo "<option name=\"Others\" $othersselected>Others</option>";
	  echo "</select></th></tr>";

	  echo "<tr><td align=\"right\">Account Name</td><th align=\"left\"><input class = 'form-control'  name=acct_name value=\"$acct_name\"></th></tr>";
		if($payrolldflt==1) { $payrolldfltsel="checked"; } else if($payrolldflt==0) { $payrolldfltsel=""; }
		echo "<tr><td align=\"right\">Payroll Acct</td><th align=\"left\"><input class = '' type=\"checkbox\" name=\"payrolldflt\" $payrolldfltsel></th></tr>";
	  echo "<tr><td align=\"right\">Remarks</td><th align=\"left\"><textarea class = 'form-control' placeholder ='Remarks here ...' value=bankacctremarks>$bankacctremarks</textarea></td></tr>";
	  echo "</table>";

	  echo "<div class = 'text-end p-4'><a class = 'btn' href=personneledit2.php?loginid=$loginid&pid=$employeeid >Cancel</a><button class = 'btn bg-success text-white' type=submit >Update</button>
	
	  </div></form>";

     }


// end edit bank details
 
    //  echo "<p><a >Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
