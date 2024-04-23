<?php 
include("db1.php");
// $dbh = mysql_connect("localhost", "root", "sysad") or die("Connection Error");
// mysql_select_db("maindb", $dbh) or die("Database Error");

$table = $_GET['table'];

$sql = "TRUNCATE TABLE $table";

$result = mysql_query($sql, $dbh); 

echo "ok";

mysql_close($dbh);
?> 
