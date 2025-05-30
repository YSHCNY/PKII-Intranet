<?php

require("config.inc");

$dbh = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $dbh) or die("Database Error");


//
// 20170125 req migration to mysqli
// still need the require("config.inc"); above 
//
$dbh2 = new mysqli("$hostname", "$dbuser", "$dbuserpass", "$dbname") or die ("Unable to connect to database");
// $dbh2 = new mysqli("$hostname", "$dbuser", "$dbuserpass", "$dbname") or die ("Unable to connect to database");

?>
