<?php 

$dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
mysql_select_db("maindb", $dbh) or die("Database Error");

$employeeid = $_POST['employeeid'];
$coursegraduated = $_POST['coursegraduated'];

if($coursegraduated != "")
{
     $result = mysql_query("INSERT INTO tblempeducation (employeeid, coursegraduated) VALUES ('$employeeid', '$coursegraduated')", $dbh); 
}

echo "ok";

mysql_close($dbh);
?> 