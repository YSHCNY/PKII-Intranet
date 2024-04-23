<?php 

include("db1.php");

$loginid = $_GET['loginid'];
$employeeid = $_GET['eid'];

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

     echo "<p><font size=1>Directory >> Manage Personnel >> Add new bank account</font></p>";

     echo "<table border=1 spacing=0 cellspacing=0 cellpadding=0>";
     echo "<tr><td bgcolor=blue colspan=2><font color=white><b>Add new bank account details</b></font></td></tr>";

     if ($employeeid == '')
     {
	echo "<tr><td colspan=2><font color=red><b>Sorry. No data available</b></font></td></tr>";
     }
     else
     {

	$result = mysql_query("SELECT name_last, name_first, name_middle, position FROM tblcontact WHERE employeeid = '$employeeid'", $dbh);
	while ($myrow = mysql_fetch_row($result))
	{
	  $found = 1;
	  $name_last = $myrow[0];
	  $name_first = $myrow[1];
	  $name_middle = $myrow[2];
	  $position = $myrow[3];
	}

	echo "<tr><td colspan=2>For: $employeeid - <b>$name_last, $name_first $name_middle[0]</b> - $position</td></tr>";

// start add bank details

	echo "<form action=personnelbankacctadd2.php?loginid=$loginid&eid=$employeeid method=post>";

	echo "<tr><td>Bank Name</td><td><input name=bank_name></td></tr>";
	echo "<tr><td>Branch</td><td><input name=bank_branch></td></tr>";
	echo "<tr><td>Account No.</td><td><input name=acct_num></td></tr>";

	echo "<tr><td>Type</td><td>";
	echo "<select name=acct_type>";
	echo "<option name=savings selected>Savings</option>";
	echo "<option name=current>Current</option>";
	echo "<option name=others>Others</option>";
	echo "</select></td></tr>";

	echo "<tr><td>Currency</td><td>";
	echo "<select name=acct_currency>";
	echo "<option name=\"Phil. Pesos\" selected>Phil. Pesos</option>";
	echo "<option name=\"US Dollars\">US Dollars</option>";
	echo "<option name=\"Others\">Others</option>";
	echo "</select></td></tr>";

	echo "<tr><td>Account Name</td><td><input size=50 name=acct_name value=\"$acct_name\"></td></tr>";
	echo "<tr><td>Remarks</td><td><textarea cols=50 rows=3 value=bankacctremarks>$bankacctremarks</textarea></td></tr>";

	echo "<tr><td>&nbsp;</td><td><input type=submit value=\"Add new record\"></td></tr></form>";

     }

     echo "</table>";

// end add bank details
 
     echo "<p><a href=personneledit2.php?loginid=$loginid&pid=$employeeid>Back</a><br>";

     $result = mysql_query("UPDATE tbladminlogin SET login_status=1 WHERE adminloginid=$loginid", $dbh); 

     include ("footer.php");
}
else
{
     include("logindeny.php");
}

mysql_close($dbh);
?> 
