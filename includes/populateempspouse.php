<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$empspousefirst = $_POST['empspousefirst'];
$empspousebirthdate = $_POST['empspousebirthdate'];

if($empspousefirst != "")
{
     $result = mysql_query("INSERT INTO tblempspouse (employeeid, empspousefirst, empspousebirthdate) VALUES ('$employeeid', '$empspousefirst', '$empspousebirthdate')", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 