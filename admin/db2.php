<?php

require("config2att.inc");

$dbh2b = mysql_connect("$hostname", "$dbuser", "$dbuserpass") or die("Connection Error");
mysql_select_db("$dbname", $dbh2b) or die("Database Error");

?>
