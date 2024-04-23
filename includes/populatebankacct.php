<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$bank_name = $_POST['bank_name'];
$acct_num = $_POST['acct_num'];
$acct_type = $_POST['acct_type'];
$bank_branch = $_POST['bank_branch'];
$acct_name = $_POST['acct_name'];

if($bank_name != "")
{
     $result = mysql_query("INSERT INTO tblbankacct (employeeid, bank_name, acct_num, acct_type, bank_branch, acct_name) VALUES ('$employeeid', '$bank_name', '$acct_num', '$acct_type', '$bank_branch', '$acct_name')", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 