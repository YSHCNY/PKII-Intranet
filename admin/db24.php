<?php

require("config24.inc");

$dbh24 = mysql_connect("$hostname24", "$dbuser24", "$dbuserpass24") or die("Connection Error");
mysql_select_db("$dbname24", $dbh24) or die("Database Error");

//
// 20190915 req migration to mysqli
// still need the require("config24.inc"); above 
//
$dbh24b = new mysqli("$hostname24", "$dbuser24", "$dbuserpass24", "$dbname24") or die ("Unable to connect to database");


?>
