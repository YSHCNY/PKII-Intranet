<?php 

include("db1.php");
include("datetimenow.php");

$loginid = $_GET['loginid'];
$wpgendate = $_GET['gd'];

$glcode0 = $_POST['glcode'];
$debitamt0 = $_POST['debitamt'];
$creditamt0 = $_POST['creditamt'];

$cutarrgendate = split("-", $wpgendate);
$cutarrgenyyyy = $cutarrgendate[0];
$cutarrgenmonth = $cutarrgendate[1];

$cutarrgenmonthname = date("F", mktime(0, 0, 0, $cutarrgenmonth));

$result11 = mysql_query("SELECT version FROM tblfinglrefdefault WHERE defaultval=\"on\"", $dbh);
if($result11 != '')
{
  while($myrow11 = mysql_fetch_row($result11))
  {
    $found11 = 1;
    $version11 = $myrow11[0];
  }
}
$glrefver = $version11;

$found = 0;

if($loginid != "")
{
     include("logincheck.php");
}  

if ($found == 1)
{
     include ("header.php");
     include ("sidebar.php");

// start contents here

echo "<table class=\"fin\" border=\"1\">";

// display labels
echo "<tr><th colspan=\"16\">PKII Working Paper - $cutarrgenyyyy-$cutarrgenmonthname</th></tr>";
echo "<tr><th colspan=\"2\">Account</th><th colspan=\"2\">Beginning Balance</th><th colspan=\"2\">Cash Disbursement</th><th colspan=\"2\">Cash Receipt</th><th colspan=\"2\">Journal Book</th><th colspan=\"2\">Trial Balance</th><th colspan=\"2\">Balance Sheet</th><th colspan=\"2\">Income Statement</th></tr>";
echo "<tr><th>Acct Code</th><th>Acct Name</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th><th>Debit</th><th>Credit</th></tr>";

if($glrefver == 1)
{
// query beginning balances from previous month
  foreach($glcode as $value)
  {

  }

// query tblfindisbursement glcodes and compute month total

// query tblfincashreceipt glcodes and compute month total

// query tblfinjournal glcodes and compute month total

// compute trial balance

// compute balance sheet

// income statement

// insert record to tblfinworkpaper

// insert log
}
else if($glrefver == 2)
{
// query beginning balances from previous month

// query tblfindisbursement glcodes and compute month total

// query tblfincashreceipt glcodes and compute month total

// query tblfinjournal glcodes and compute month total

// compute trial balance

// compute balance sheet

// income statement

// insert record to tblfinworkpaper

// insert log
}
echo "</table>";

echo "<p><a href=\"finvouchmain.php?loginid=$loginid\">Back</a></p>";



// end contents here

     $result = mysql_query("UPDATE tbladminlogin SET adminloginstat=1 WHERE adminuid='$username'", $dbh); 

     include ("footer.php");
}
else
{
     include ("logindeny.php");
}

mysql_close($dbh);
?>
