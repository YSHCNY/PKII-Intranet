<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$proj_name = $_POST['proj_name'];
$durationfrom = $_POST['durationfrom'];
$durationto = $_POST['durationto'];
$salary = $_POST['salary'];

if($proj_name != "")
{
     $result = mysql_query("INSERT INTO tblprojassign (employeeid, proj_name, durationfrom, durationto, salary) VALUES ('$employeeid', '$proj_name', '$durationfrom', '$durationto', $salary)", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 