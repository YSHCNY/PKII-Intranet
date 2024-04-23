<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$empposition = $_POST['empposition'];

if($employeeid != "")
{
     $result = mysql_query("INSERT INTO tblempdetails (employeeid, empposition) VALUES ('$employeeid', '$empposition')", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 