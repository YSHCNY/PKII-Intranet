<?php

require("config24.inc");

$db24 = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $db24) or die("Database Error");

?>
