<?php

require("config23.inc");

$db23 = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $db23) or die("Database Error");

?>
