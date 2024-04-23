<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$emp_salary = $_POST['emp_salary'];
$deduction = $_POST['deduction'];
$net_pay = $_POST['net_pay'];
$cut_start = $_POST['cut_start'];
$cut_end = $_POST['cut_end'];

$result = mysql_query("INSERT INTO tblemppayroll (employeeid, emp_salary, deduction, net_pay, cut_start, cut_end) VALUES ('$employeeid', $emp_salary, $deduction, $net_pay, '$cut_start', '$cut_end')", $dbh); 

$id = mysql_insert_id();

//echo "$id";
echo "$employeeid";

mysql_close($dbh);
?> 