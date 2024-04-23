<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$empdepartment = $_POST['empdepartment'];
$empposition = $_POST['empposition'];
$emppositionlevel = $_POST['emppositionlevel'];
$empsalarygrade = $_POST['empsalarygrade'];

if($employeeid != "")
{
     $result = mysql_query("INSERT INTO tblempdetails (employeeid, empdepartment, empposition, emppositionlevel, empsalarygrade) VALUES ('$employeeid', '$empdepartment', '$empposition', $emppositionlevel, $empsalarygrade)", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 