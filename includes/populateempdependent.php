<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$dependentfirst = $_POST['dependentfirst'];
$dependentbirthdate = $_POST['dependentbirthdate'];
$dependentrelation = $_POST['dependentrelation'];

if($employeeid != "")
{
     $result = mysql_query("INSERT INTO tblempdependent (employeeid, dependentfirst, dependentbirthdate, dependentrelation) VALUES ('$employeeid', '$dependentfirst', '$dependentbirthdate', '$dependentrelation')", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 